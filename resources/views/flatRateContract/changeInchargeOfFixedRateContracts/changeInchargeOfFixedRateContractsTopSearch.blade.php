<div class="content-head-section custom-mb" style="padding: 13px 0 0;">
    <div class="container position-relative">
        <form id="firstSearch" action="{{ route('changeInchargeOfFixedRateContract') }}" method="post">
            <input type="hidden" name="Button" id="firstButton" value="{{isset($old['Button'])?$old['Button']:null}}">
            <!--<input type="hidden" id="fs_sortField" name="sortField" value="{{--isset($old['sortField'])?$old['sortField']:null--}}">
        <input type="hidden" id="fs_sortType" name="sortType" value="{{--isset($old['sortType'])?$old['sortType']:null--}}">-->
            <input type="hidden" id="fs_userId" name="userId" value="{{$bango}}">
            <input type="hidden" id="first_csrf" value="{{csrf_token()}}" name="_token" disabled>
            <input type="hidden" id="source" value="changeInchargeOfFixedRateContract" />
            @csrf

            {{-- Success Message Starts Here --}}

            @if(Session::has('update_msg'))
                @php
                $update_msgs = session()->get('update_msg');
                @endphp
                <div id="update-success-msg" class="row success-msg-box" style="position: relative; z-index: 1;">
                  <div class="col-12">
                    <div class="alert alert-primary alert-dismissible">
                      <button type="button" class="close" data-dismiss="alert" autofocus
                      onclick="$('#incharge').focus();">&times;</button>
                      @foreach($update_msgs as $key=>$val)
                      <strong>{{$val}}</strong><br>
                      @endforeach
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
                    @if(isset($exceedChangeInchargeOfFixedRateContract))
                    <p id="no_found_data" class="common_error">{{$exceedChangeInchargeOfFixedRateContract}}</p>
                    @endif
                </div>
            </div>
            {{-- Error Message Ends Here --}}
            <div class="row pay_history_list_top_content change_inchargeOf_fixedRateContracts_top">
                <div class="col">
                    {{-- Top Contents Starts Here --}}
                    <div class="content-head-top">
                        <div class="row mb-4">

                            {{-- Top Left Side Contents Starts Here --}}
                            <div class="ml-3 mr-5" style="width: auto;">
                                <table class="table custom-form" style="width:auto;;margin-bottom:2px!important;">
                                    <tbody>
                                        <tr>
                                            <td
                                                style="border: none!important;text-align: left;color: black;width:95px !important;padding-left: 0px!important;">
                                                <div class="line-icon-box float-left mr-3"></div> 担当
                                            </td>
                                            <td style="border: none!important;width:220px;">
                                                <div class="custom-arrow">
                                                    <select class="form-control" name="incharge" id="incharge" autofocus="">
                                                        <option value="1">-</option>
                                                        @foreach ($incharges as $user)
                                                        @if (isset($fsReqData['incharge']))
                                                        <option value="{{ $user->bango }}" @if ($user->bango ==
                                                            $fsReqData['incharge']) {{ 'selected' }} @endif>
                                                            {{ $user->bango . ' ' . $user->name }}
                                                        </option>
                                                        @else
                                                        @if (isset($fsReqData) && count($fsReqData) > 0)
                                                        <option value="{{ $user->bango }}">
                                                            {{ $user->bango . ' ' . $user->name }}
                                                        </option>
                                                        @else
                                                        <option value="{{ $user->bango }}" @if ($user->bango == $bango)
                                                            {{ 'selected' }} @endif>
                                                            {{ $user->bango . ' ' . $user->name }}
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
                                <table class="table custom-form" style="width:auto;margin-bottom:2px!important;">
                                    <tbody>

                                        <tr>
                                            <td
                                                style="border: none!important;text-align: left;color: black;width:95px !important;padding-left: 0px!important;">
                                                <div class="line-icon-box float-left mr-3"></div> 売上請求先
                                            </td>
                                            <td style="border: none!important;width: 537px;">
                                                <div class="input-group input-group-sm custom_modal_input"
                                                    style="margin-bottom: 4px;">
                                                    <input type="text" name="billing_address_text" id="billing_address_text" class="form-control"
                                                    value="{{ isset($fsReqData['billing_address_text']) ? $fsReqData['billing_address_text'] : null }}"
                                                    placeholder="売上請求先" readonly="">
                                                   
                                                    <input type="hidden" id="billing_address_text_db" name="billing_address_text_db" class="db_hidden_field"
                                                    value="{{ isset($fsReqData['billing_address_text_db']) ? $fsReqData['billing_address_text_db'] : null }}" style="width:93%;">
                                                     
                                                    <div class="input-group-append" data-toggle="modal"
                                                        data-target="#search_modal4">
                                                        <button type="button" class="input-group-text btn"
                                                                style="cursor: pointer;"
                                                                onclick="supplierSelectionModalOpener_3('billing_address_text','billing_address_text_db','1','nullable','address',event.preventDefault());">
                                                                <i class="fas fa-arrow-left"></i>
                                                            </button>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td
                                                style="border: none!important;text-align: left;color: black;width:95px !important;padding-left: 0px!important;">
                                                <div class="line-icon-box float-left mr-3"></div> 受注先
                                            </td>
                                            <td style="border: none!important;width: 537px;">
                                                <div class="input-group input-group-sm custom_modal_input"
                                                    style="margin-bottom: 4px;">
                                                    <input type="text" name="contractor_text" id="contractor_text" class="form-control"
                                                    value="{{ isset($fsReqData['contractor_text']) ? $fsReqData['contractor_text'] : null }}"                                           
                                                     placeholder="受注先" readonly="">
                                                     
                                                    <input type="hidden" id="contractor_text_db" name="contractor_text_db" class="db_hidden_field"
                                                    value="{{ isset($fsReqData['contractor_text_db']) ? $fsReqData['contractor_text_db'] : null }}" style="width:93%;">
                                                  
                                                    <div class="input-group-append" data-toggle="modal"
                                                        data-target="#search_modal4">
                                                        <button type="button" class="input-group-text btn"
                                                                style="cursor: pointer;"
                                                                onclick="supplierSelectionModalOpener_3('contractor_text','contractor_text_db','1','nullable','address',event.preventDefault());">
                                                        <i class="fas fa-arrow-left"></i></button>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td
                                                style="border: none!important;text-align: left;color: black;width:95px !important;padding-left: 0px!important;">
                                                <div class="line-icon-box float-left mr-3"></div> 最終顧客
                                            </td>
                                            <td style="border: none!important;width: 537px;">
                                                <div class="input-group input-group-sm custom_modal_input"
                                                    style="margin-bottom: 4px;">
                                                    <input type="text" name="end_customer_text" id="end_customer_text" class="form-control"
                                                     value="{{ isset($fsReqData['end_customer_text']) ? $fsReqData['end_customer_text'] : null }}"                                           
                                                     placeholder="最終顧客" readonly="">
                                                      
                                                        <input type="hidden" id="end_customer_text_db" name="end_customer_text_db" class="db_hidden_field"
                                                       value="{{ isset($fsReqData['end_customer_text_db']) ? $fsReqData['end_customer_text_db'] : null }}" style="width:93%;">
                                                 
                                                    <div class="input-group-append" data-toggle="modal"
                                                        data-target="#search_modal4">
                                                        <button type="button" class="input-group-text btn"
                                                                style="cursor: pointer;"
                                                                onclick="supplierSelectionModalOpener_3('end_customer_text','end_customer_text_db','1','nullable','address',event.preventDefault());">
                                                       <i class="fas fa-arrow-left"></i></button>
                                                    </div>
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
                    <div class="content-head-top"
                        style="margin-bottom: 5px;border-top:1px solid #E1E1E1;border-bottom:1px solid #E1E1E1">
                        <div class="row mb-4 mt-4">
                            <div class="col-8">
                            </div>
                            <div class="col-4">
                                <div class="d-inline-block float-right">
                                    <!-- <button style="width: 150px;height:30px;line-height:30px;"
                                    onclick="firstSearch('{{ route('changeInchargeOfFixedRateContract') }}',event.preventDefault())" type="submit" class="btn btn-info">表示</button>
                                     -->
                                     <button onclick="firstSearch('{{route('changeInchargeOfFixedRateContract')}}',event.preventDefault())" type="submit" style="width: 150px;height:30px;line-height:30px;" class="btn btn-info">表示</button>
                                     <button id="updateButton" onclick="updateChangeInchargeOfFixedRateContract('{{route('updateChangeInchargeOfFixedRateContract')}}',event.preventDefault())" type="submit" style="width: 150px;height:30px;line-height:30px;" class="btn btn-info">更新</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- Checkbox with Button Ends Here --}}

                </div>
            </div>
    </div>
    </form>
</div>