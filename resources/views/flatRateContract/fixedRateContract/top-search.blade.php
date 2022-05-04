<div class="content-head-section">
    <div class="container" style="position: relative;">
        <form id="firstSearch" action="{{ route('fixedRateContract') }}" method="post">
            <input type="hidden" name="Button" id="firstButton"
                value="{{ isset($old['Button']) ? $old['Button'] : null }}">
            <!--<input type="hidden" id="fs_sortField" name="sortField"
                value="{{-- isset($old['sortField']) ? $old['sortField'] : null --}}">
            <input type="hidden" id="fs_sortType" name="sortType"
                value="{{-- isset($old['sortType']) ? $old['sortType'] : null --}}">-->
            <input type="hidden" id="fs_userId" name="userId" value="{{ $bango }}">
            <input type="hidden" id="first_csrf" value="{{ csrf_token() }}" name="_token" disabled>
            <input type="hidden" id="source" value="fixedRateContract" />
            @csrf

            <!-- Error Message Starts Here -->
            <div id="error_data" class="common_error"></div>
            
            @if (isset($exceedFixedRateContact))
                <p id="no_found_data" class="common_error">{{ $exceedFixedRateContact }}</p>
            @endif
            <!-- Error Message Ends Here -->

            <div class="row order_entry_topcontent">
                <div class="col">
                    
                    <div class="content-head-top inner-top-content" style="border-bottom: 0px;">
                        {{-- @include('layout.commonOfficeDeptGroup') --}}
                        <div class="row mb-4" style="padding-top: 0px;margin-bottom:25px;">
                            <div class="col-4">
                                <table class="table custom-form" style="margin-bottom: 2px!important;width: auto;">
                                    <tbody>
                                        <tr>
                                            <td
                                                style="padding-left: 0px !important; border: none!important;text-align: left;color: black;width: 94px !important;">
                                                <div class="line-icon-box float-left mr-3"></div>担当
                                            </td>
                                            <td style="width: 220px!important;text-align: center;border: none!important;">
                                                <div class="custom-arrow">
                                                    <select class="form-control" name="incharge" id="incharge" autofocus="">
                                                        @foreach ($incharges as $user)
                                                            @if (isset($fsReqData['incharge']))
                                                                <option value="{{ $user->bango }}" @if ($user->bango == $fsReqData['incharge']) {{ 'selected' }} @endif>
                                                                    {{ $user->bango . ' ' . $user->name }}
                                                                </option>
                                                            @else
                                                                @if (isset($fsReqData) && count($fsReqData) > 0)
                                                                    <option value="{{ $user->bango }}">
                                                                        {{ $user->bango . ' ' . $user->name }}
                                                                    </option>
                                                                @else
                                                                    <option value="{{ $user->bango }}" @if ($user->bango == $bango) {{ 'selected' }} @endif>
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
                                <table class="table custom-form" style="margin-bottom: 2px!important;width: auto;">
                                    <tbody>
                                        <tr>
                                            <td
                                                style="padding-left: 0px !important; border: none!important;text-align: left;color: black;width: 94px !important;">
                                                <div class="line-icon-box float-left mr-3"></div>表示内容
                                            </td>
                                            <td style="width: 70%!important;text-align: center;border: none!important;">
                                                <div class="custom-arrow">
                                                    <select class="form-control" name="creation_category"
                                                        id="creation_category">
                                                        {{-- <option value="">-</option> --}}
                                                        @foreach ($categorykanriesJ3 as $categoryKanri)
                                                            @if (isset($fsReqData['creation_category']))
                                                                <option
                                                                    value="{{ $categoryKanri->category1 . $categoryKanri->category2 }}"
                                                                    @if ($fsReqData['creation_category'] == $categoryKanri->category1 . $categoryKanri->category2) selected @endif>
                                                                    {{ $categoryKanri->category2 . ' ' . $categoryKanri->category4 }}
                                                                </option>
                                                            @else
                                                                <option
                                                                    value="{{ $categoryKanri->category1 . $categoryKanri->category2 }}"
                                                                    @if ($categoryKanri->category1 . $categoryKanri->category2 == 'J310') selected @endif>
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
                            <div class="ml-3 mr-3">
                                <table class="table custom-form" style="margin-bottom: 0px!important;"
                                    id="tbl-supplier">
                                    <tbody>
                                        <tr>
                                            <td class="text-render"
                                                style="border: none!important;color: black;width: 95px !important;">
                                                <div style="width: 91px;">
                                                    <div class="line-icon-box float-left mr-3"></div>受注先
                                                </div>
                                            </td>
                                            <td style=" border: none!important;">
                                                <div style="">
                                                    <div class="input-group input-group-sm">
                                                        <input type="text" name="contractor_text" id="contractor"
                                                            class="form-control custom_modal_input"
                                                            value="{{ isset($fsReqData['contractor_text']) ? $fsReqData['contractor_text'] : null }}"
                                                            placeholder="受注先（コード入力/絞込入力）" readonly=""
                                                            style="padding: 0!important;">
                                                        <input type="hidden" id="contractor_db" name="contractor"
                                                            class="db_hidden_field"
                                                            value="{{ isset($fsReqData['contractor']) ? $fsReqData['contractor'] : null }}" style="width:93%;">
                                                        <div class="input-group-append">
                                                            <button type="button" class="input-group-text btn"
                                                                style="cursor: pointer;"
                                                                onclick="supplierSelectionModalOpener_2('contractor','contractor_db','1','required','r16cd',2,event.preventDefault());">
                                                                <i class="fas fa-arrow-left"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-render"
                                                style="border: none!important;color: black;width: 95px !important;">
                                                <div style="width: 91px;">
                                                    <div class="line-icon-box float-left mr-3"></div>売上請求先
                                                </div>
                                            </td>
                                            <td style=" border: none!important;">
                                                <div>
                                                    <div class="input-group input-group-sm">
                                                        <input type="text" id="billing_address"
                                                            name="billing_address_text" class="form-control custom_modal_input"
                                                            value="{{ isset($fsReqData['billing_address_text']) ? $fsReqData['billing_address_text'] : null }}"
                                                            placeholder="売上請求先（コード入力/絞込入力）" readonly=""
                                                            style="padding: 0!important;">
                                                        <input type="hidden" id="billing_address_db"
                                                            name="billing_address" class="db_hidden_field"
                                                            value="{{ isset($fsReqData['billing_address']) ? $fsReqData['billing_address'] : null }}">
                                                        <div class="input-group-append">
                                                            <button type="button" class="input-group-text btn"
                                                                style="cursor: pointer;"
                                                                onclick="supplierSelectionModalOpener_2('billing_address','billing_address_db','1','required','r16cd',2,event.preventDefault());"><i
                                                                    class="fas fa-arrow-left"></i></button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-render"
                                                style="border: none!important;color: black;width: 95px !important;">
                                                <div style="width: 91px;">
                                                    <div class="line-icon-box float-left mr-3"></div>最終顧客
                                                </div>
                                            </td>
                                            <td style=" border: none!important;">
                                                <div>
                                                    <div class="input-group input-group-sm">
                                                        <input type="text" id="end_customer" name="end_customer_text"
                                                            class="form-control custom_modal_input"
                                                            value="{{ isset($fsReqData['end_customer_text']) ? $fsReqData['end_customer_text'] : null }}"
                                                            placeholder="最終顧客（コード入力/絞込入力）" readonly=""
                                                            style="padding: 0!important;">
                                                        <input type="hidden" name="end_customer" id="end_customer_db"
                                                            value="{{ isset($fsReqData['end_customer']) ? $fsReqData['end_customer'] : null }}"
                                                            class="db_hidden_field">
                                                        <div class="input-group-append">
                                                            <button type="button" class="input-group-text btn"
                                                                style="cursor: pointer;"
                                                                onclick="supplierSelectionModalOpener_2('end_customer','end_customer_db','1','required','r16cd',2,event.preventDefault());"><i
                                                                    class="fas fa-arrow-left"></i></button>
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
                        <div class="row mb-2">
                            
                                <div class="col-12">
                                    <div style="border-bottom: 1px solid #E1E1E1; border-top: 1px solid #E1E1E1;">
                                    <div class="buttom-btn text-right mt-4 mb-4">
                                        <button type="button"
                                            onclick="firstSearch('{{ route('fixedRateContract') }}',event.preventDefault())"
                                            class="btn btn-info  uskc-button">表示</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="content-head-bottom">
                        <div class="row mb-2 mt-2">
                            <div class="col">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
