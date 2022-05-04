<div class="content-head-section">
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
        <div  class="common_error" id="error_msg_div">@if(isset($purchaseOrderError)&& $purchaseOrderError!=null){{$purchaseOrderError}} @elseif(Session::has('error_msg')) {!! session()->pull('error_msg')  !!} @endif</div>
        {{-- Error Message Ends Here --}}
        <div class="order_entry_topcontent purchase-order inner-top-content" style="margin-right: -15px;">
            <form id="firstSearch" action="{{ route('purchaseOrder') }}" method="post">
                @csrf
                <input type="hidden" name="firstButton" value="topSearch">
                <input type="hidden" id="userId" name="userId" value="{{$bango}}">
                <input type="hidden" id="allChkBxFlag" name="allChkBxFlag" value="0">
                <input type="hidden" id="defaultSrc_h" name="defaultSrc_h" @if(Session::has('defaultSrc')) value="{{session()->pull('defaultSrc')}}" value="0" @else  @endif >
                <div class="col pl-0">
                <div class="content-head-top">
                    <div class="row">
                        <div class="col-7">
                            @include('layout.commonOfficeDeptGroup')
                        </div>
                        @if($privileged_user==true)
                            <div class="col-2">
                                <label class="checkbox_container header-checkbox" style="padding-left: 22px!important;">訂正・削除データ表示
                                   <input type="hidden" id="correction_checkbox_h" name="correction_checkbox_h" value="{{isset($fsReqData['correction_checkbox_h'])?$fsReqData['correction_checkbox_h'] : 1}}">
                                   <input class="checkAllCheckbox" type="checkbox" id="correction_checkbox" name="correction_checkbox" @if(isset($fsReqData['correction_checkbox_h'])) @if($fsReqData['correction_checkbox_h']=='1'){{'checked'}} @endif @else {{'checked'}} @endif>
                                   <span class="checkmark" style="top: 1px;"></span>
                               </label>
                           </div>
                        @endif
                       <div class="col-3"></div>
                    </div>


                    <div class="row mb-4" style="padding-top: 0px; max-width: 1349px !important;">
                        <div class="col" style="width: 674px !important; max-width: 674px !important;">
                            <table class="table custom-form" style="margin-bottom: 2px!important;width: auto;margin-left:-2px!important;">
                                <tbody>
                                <tr>
                                    <td style="border: none!important;text-align: left;color: black;width: 97px !important;">
                                        <div class="line-icon-box float-left mr-3"></div>担当
                                    </td>
                                    <td style="width: 270px!important;text-align: center;border: none!important;">
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
                            <table class="table custom-form" style="width: auto;margin-bottom: 2px!important;margin-left:-2px!important;">
                                <tbody>
                                <tr>
                                    <td style="border: none!important;text-align: left;color: black;width: 97px !important;">
                                        <div class="line-icon-box float-left mr-3"></div>発注日
                                    </td>
                                    <td style="border: none!important;width: 120px;">
                                        <div class="input-group">
                                            <input name="orderDateFrom" id="datepicker1"

                                                   oninput="this.value = this.value.replace(/[^\d^\/]/g, '').replace(/([\d]{4}\/?)([\d]{2}\/?)([\d]{2})/g, '$1$2$3').replace(/([\d]{8})([\d]{1,2})?/g, '$1');"
                                                   onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))"
                                                   maxlength="8" value="{{isset($fsReqData['orderDateFrom'])?$fsReqData['orderDateFrom']:$beforeSystemDate}}" type="text" class="form-control input_field" autocomplete="off"
                                                   placeholder="年/月/日" style="width: 96px!important;">
                                            <input type="hidden" class="datePickerHidden" id="datepicker1_h">
                                        </div>
                                    </td>
                                    <td style="width: 30px!important;border:0!important;text-align: center;">
                                        ～
                                    </td>
                                    <td style="border: none!important;width: 120px;">
                                        <div class="input-group">
                                            <input name="orderDateTo" id="datepicker2"

                                                   oninput="this.value = this.value.replace(/[^\d^\/]/g, '').replace(/([\d]{4}\/?)([\d]{2}\/?)([\d]{2})/g, '$1$2$3').replace(/([\d]{8})([\d]{1,2})?/g, '$1');"
                                                   onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))"
                                                   maxlength="8" value="{{isset($fsReqData['orderDateTo'])?$fsReqData['orderDateTo']:$systemDate}}" type="text" class="form-control input_field" autocomplete="off"
                                                   placeholder="年/月/日" style="width: 96px!important;">
                                            <input type="hidden" class="datePickerHidden" id="datepicker2_h">
                                        </div>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                            <table class="table custom-form" style="width: auto;margin-bottom: 2px!important;margin-left:-2px!important;">
                                <tbody>
                                <tr>
                                    <td style="border: none!important;text-align: left;color: black;width:97px !important;">
                                        <div class="line-icon-box float-left mr-3"></div>発注番号
                                    </td>
                                    <td style="border: none!important;width: 269px;">
                                        <div class="input-group">
                                            <input type="text"  style="width: 96px!important;padding-left: 0px !important;" maxlength="10" class="form-control" placeholder="" name="orderNo" id="orderNo" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1').replace(/\./g, '');" value="{{isset($fsReqData['orderNo'])?$fsReqData['orderNo'] : null}}" >
                                        </div>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col" style="width: 674px !important; max-width: 674px !important;">
                            <table class="table custom-form" style="margin-bottom: 0px!important;" id="tbl-supplier">
                                <tbody>
                                <tr>
                                    <td class="text-render" style="border: none!important;color: black;width: 95px !important;">
                                        <div style="width: 91px;">
                                            <div class="line-icon-box float-left mr-3"></div>仕入先
                                        </div>
                                    </td>
                                    <td style=" border: none!important;width: 443px;">
                                        <div>
                                            <div class="input-group input-group-sm custom_modal_input">
                                                <input type="text" name="information1_text" id="tsearch_information1_v2" value="{{isset($fsReqData['information1_text'])?$fsReqData['information1_text']:null}}" class="form-control custom_modal_input" readonly="" style="padding: 0!important;">
                                                <input name="information1_short" id="tsearch_information1_db" value="{{isset($fsReqData['information1_short'])?$fsReqData['information1_short']:null}}" type="hidden" >
                                                <div class="input-group-append" >
                                                  <button onclick="supplierSelectionModalOpener_2('tsearch_information1_v2','tsearch_information1_db','1','nullable','r16cd',event.preventDefault())" class="input-group-text btn"><i class="fas fa-arrow-left"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-render" style="border: none!important;color: black;width: 95px !important;">
                                        <div style="width: 91px;">
                                            <div class="line-icon-box float-left mr-3"></div>受注先
                                        </div>
                                    </td>
                                    <td style=" border: none!important;">
                                        <div>
                                            <div class="input-group input-group-sm custom_modal_input">
                                                <input name="information2_text" id="tsearch_information2" value="{{isset($fsReqData['information2_text'])?$fsReqData['information2_text']:null}}" type="text" class="form-control custom_modal_input" readonly="" style="padding: 0!important;">
                                                <input name="information2_short" id="tsearch_information2_db" value="{{isset($fsReqData['information2_short'])?$fsReqData['information2_short']:null}}" type="hidden" >
                                                <div class="input-group-append" >
                                                  <button onclick="supplierSelectionModalOpener_2('tsearch_information2','tsearch_information2_db','1','nullable','r16cd',event.preventDefault())" class="input-group-text btn"><i class="fas fa-arrow-left"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-render" style="border: none!important;color: black;width: 95px !important;">
                                        <div style="width: 91px;">
                                            <div class="line-icon-box float-left mr-3"></div>最終顧客
                                        </div>
                                    </td>
                                    <td style=" border: none!important;">
                                        <div>
                                            <div class="input-group input-group-sm custom_modal_input">
                                                <input name="information3_text" id="tsearch_information3" value="{{isset($fsReqData['information3_text'])?$fsReqData['information3_text']:null}}" type="text" class="form-control custom_modal_input" readonly="" style="padding: 0!important;">
                                                <input name="information3_short" id="tsearch_information3_db" value="{{isset($fsReqData['information3_short'])?$fsReqData['information3_short']:null}}" type="hidden" >
                                                <div class="input-group-append" >
                                                  <button onclick="supplierSelectionModalOpener_2('tsearch_information3','tsearch_information3_db','0','nullable','r16cd',event.preventDefault())" class="input-group-text btn"><i class="fas fa-arrow-left"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-1"></div>
                    </div>
                </div>

                <div class="content-head-top">
                    <div class="row mt-4">
                        <div class="col-7">
                            <div class="radio-rounded custom-table-oh d-inline-block">
                                <div class="custom-control custom-radio custom-control-inline"
                                     style="padding-left:11px!important;">
                                    <input type="radio" class="custom-control-input" id="customRadio" name="rd1" value="2" @if(isset($fsReqData['rd1'])&& $fsReqData['rd1']=="2"){{"checked"}}@endif checked="">
                                    <label class="custom-control-label" for="customRadio"
                                           style="font-size: 12px!important;cursor:pointer;">未作成</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline"
                                     style="padding-left:20px!important;">
                                    <input type="radio" class="custom-control-input" id="customRadio2" name="rd1" value="1" @if(isset($fsReqData['rd1'])&& $fsReqData['rd1']=="1"){{"checked"}}@endif>
                                    <label class="custom-control-label" for="customRadio2"
                                           style="font-size: 12px!important;cursor:pointer;"> 作成済</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline"
                                     style="padding-left:20px!important;">
                                    <input type="radio" class="custom-control-input" id="customRadio3" name="rd1" value="0" @if(isset($fsReqData['rd1'])&& $fsReqData['rd1']=="0"){{"checked"}}@endif>
                                    <label class="custom-control-label" for="customRadio3"
                                           style="font-size: 12px!important;cursor:pointer;">すべて</label>
                                </div>
                            </div>

                            <div class="radio-rounded d-inline-block">
                                <div class="custom-control custom-radio custom-control-inline"
                                     style="padding-left: 26px!important;">
                                    <input type="radio" class="custom-control-input" id="customRadio4" name="rd2" value="2" @if(isset($fsReqData['rd2'])&& $fsReqData['rd2']=="2"){{"checked"}}@endif checked="">
                                    <label class="custom-control-label" for="customRadio4"
                                           style="font-size: 12px!important;cursor:pointer;"> 未検印</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline"
                                     style="padding-left:20px!important;">
                                    <input type="radio" class="custom-control-input" id="customRadio5" name="rd2" value="1" @if(isset($fsReqData['rd2'])&& $fsReqData['rd2']=="1"){{"checked"}}@endif>
                                    <label class="custom-control-label" for="customRadio5"
                                           style="font-size: 12px!important;cursor:pointer;"> 検印済</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline"
                                     style="padding-left:20px!important;">
                                    <input type="radio" class="custom-control-input" id="customRadio6" name="rd2" value="0" @if(isset($fsReqData['rd2'])&& $fsReqData['rd2']=="0"){{"checked"}}@endif>
                                    <label class="custom-control-label" for="customRadio6"
                                           style="font-size: 12px!important;cursor:pointer;">すべて</label>
                                </div>
                            </div>

                        </div>
                        <div class="col-5">
                            <div class="d-inline-block mb-4 float-right">
                                {{--{{dd($privileged_user)}}--}}
                                <a class="btn btn-info uskc-button" id="topSearchBtn" style="width: 130px;">表示</a>
                                @if(($tantousya->innerlevel!=19) && ($tantousya->innerlevel!=20))
                                    <button class="btn btn-info uskc-button" style="width: 130px;" id="stampButton"
                                            @if(isset($fsReqData))
                                            @if($privileged_user==false) @else @if(isset($fsReqData['correction_checkbox_h'])) @if($fsReqData['correction_checkbox_h']=='1') disabled="disabled" @endif @endif  @endif
                                            @else
                                            @if($privileged_user==false) @else disabled="disabled"@endif
                                        @endif>検印</button>
                                    @endif
                                <button id="customprogress" class="btn btn-info uskc-button"
                                        @if(isset($fsReqData))
                                            @if($privileged_user==false) @else @if(isset($fsReqData['correction_checkbox_h'])) @if($fsReqData['correction_checkbox_h']=='1') disabled="disabled" @endif @endif  @endif
                                        @else
                                            @if($privileged_user==false) @else disabled="disabled"@endif
                                        @endif>発注書作成</button>
                                <button class="btn btn-info uskc-button" data-toggle="modal" data-target="#confirm_email_transmission_modal" id="emailSendingButton"
                                        @if(isset($fsReqData))
                                            @if($privileged_user==false) @else @if(isset($fsReqData['correction_checkbox_h'])) @if($fsReqData['correction_checkbox_h']=='1') disabled="disabled" @endif @endif  @endif
                                        @else
                                            @if($privileged_user==false) @else disabled="disabled"@endif
                                        @endif>メール送信</button>
                            </div>
                        </div>
                        <div style="display: flex; justify-content: flex-end; width: 100%;">
                            <div class="progress" style="width: 348px; display: none; margin-right: 15px;">
                                <div id="progress-bar" class="progress-bar progress-bar-striped bg-primary" role="progressbar" style="width: 0%"
                                    aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>
