<div class="content-head-section">
    <div class="container position-relative">
        <form id="firstSearch" action="{{ route('depositHistoryList') }}" method="post">
            <input type="hidden" name="Button" id="firstButton"
                value="{{ isset($old['Button']) ? $old['Button'] : null }}">
            <input type="hidden" id="fs_sortField" name="sortField"
                value="{{ isset($old['sortField']) ? $old['sortField'] : null }}">
            <input type="hidden" id="fs_sortType" name="sortType"
                value="{{ isset($old['sortType']) ? $old['sortType'] : null }}">
            <input type="hidden" id="fs_userId" name="userId" value="{{ $bango }}">
            <input type="hidden" id="first_csrf" value="{{ csrf_token() }}" name="_token" disabled>
            <input type="hidden" id="source" value="depositHistoryList" />

            @csrf
            <div class="row">
                <div class="col-lg-12">
                    <!-- Error Message Starts Here -->
                    <div id="error_data" class="common_error"></div>
                    <!-- Error Message Ends Here -->

                    @if (isset($exceedDepositHistoryList))
                    <p id="no_found_data" class="common_error">{{ $exceedDepositHistoryList }}</p>
                    @endif

                    @php
                    $_payment_day_start = now()
                    ->subMonth()
                    ->startOfMonth()
                    ->format('Y/m/d');
                    $_payment_day_end = now()->format('Y/m/d');
                    $_disposal_day_start = now()
                    ->subMonth()
                    ->startOfMonth()
                    ->format('Y/m/d');
                    $_disposal_day_end = now()->format('Y/m/d');
                    @endphp
                    <div style="">
                        <div class="wrap-100"
                            style="background-color: #fff;box-sizing: border-box; overflow: hidden;height: auto;padding-top:0px;">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="row">
                                        <div class="col">
                                            <div class="content-head-top inner-top-content"
                                                style="padding-bottom: 10px;">
                                                <div class="row">
                                                    <div class="col-4">
                                                        <table class="table custom-form">
                                                            <tbody>
                                                                <tr>
                                                                    <td
                                                                        style="width: 23px!important;padding: 0!important;border:0!important;">
                                                                        <div class="line-icon-box"></div>
                                                                    </td>
                                                                    <td style="border: none !important;width: 71px;">処理日
                                                                    </td>
                                                                    <td style="border: none!important;">
                                                                        <input type="text" id="disposal_day_start"
                                                                            name="disposal_day_start"
                                                                            value="{{ isset($fsReqData['disposal_day_start']) ? $fsReqData['disposal_day_start'] : $_disposal_day_start }}"
                                                                            class="form-control datePicker datePicker2_1"
                                                                            autocomplete="off" value=""
                                                                            placeholder="年/月/日"
                                                                            oninput="this.value = this.value.replace(/[^\d^\/]/g, '').replace(/([\d]{4}\/?)([\d]{2}\/?)([\d]{2})/g, '$1$2$3').replace(/([\d]{8})([\d]{1,2})?/g, '$1');"
                                                                            onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))"
                                                                            maxlength="10" autofocus>
                                                                        <input type="hidden"
                                                                            value="{{ isset($fsReqData['disposal_day_start']) ? $fsReqData['disposal_day_start'] : $_disposal_day_start }}"
                                                                            class="datePickerHidden">
                                                                    </td>
                                                                    <td
                                                                        style="border: none!important;width: 38px!important;text-align: center;">
                                                                        ～
                                                                    </td>
                                                                    <td style="border: none!important;">
                                                                        <input type="text" id="disposal_day_end"
                                                                            name="disposal_day_end"
                                                                            value="{{ isset($fsReqData['disposal_day_end']) ? $fsReqData['disposal_day_end'] : $_disposal_day_end }}"
                                                                            class="form-control datePicker datePicker2_2"
                                                                            autocomplete="off" value=""
                                                                            placeholder="年/月/日"
                                                                            oninput="this.value = this.value.replace(/[^\d^\/]/g, '').replace(/([\d]{4}\/?)([\d]{2}\/?)([\d]{2})/g, '$1$2$3').replace(/([\d]{8})([\d]{1,2})?/g, '$1');"
                                                                            onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))"
                                                                            maxlength="10" >
                                                                        <input type="hidden"
                                                                            value="{{ isset($fsReqData['disposal_day_end']) ? $fsReqData['disposal_day_end'] : $_disposal_day_end }}"
                                                                            class="datePickerHidden">
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-4">
                                                        <table class="table custom-form">
                                                            <tbody>

                                                                <tr>
                                                                    <td
                                                                        style="width: 23px!important;padding: 0!important;border:0!important;">
                                                                        <div class="line-icon-box"></div>
                                                                    </td>
                                                                    <td style="border: none !important;width: 71px;">入金日
                                                                    </td>
                                                                    <td style="border: none!important;">

                                                                        <input name="payment_day_start"
                                                                            id="payment_day_start"
                                                                            value="{{ isset($fsReqData['payment_day_start']) ? $fsReqData['payment_day_start'] : $_payment_day_start }}"
                                                                            type="text"
                                                                            class="form-control datePicker datePicker1_1"
                                                                            autocomplete="off" placeholder="年/月/日"
                                                                            oninput="this.value = this.value.replace(/[^\d^\/]/g, '').replace(/([\d]{4}\/?)([\d]{2}\/?)([\d]{2})/g, '$1$2$3').replace(/([\d]{8})([\d]{1,2})?/g, '$1');"
                                                                            onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))"
                                                                            maxlength="10">
                                                                        <input type="hidden"
                                                                            value="{{ isset($fsReqData['payment_day_start']) ? $fsReqData['payment_day_start'] : $_payment_day_start }}"
                                                                            class="datePickerHidden">
                                                                    </td>
                                                                    <td
                                                                        style="border: none!important;width: 38px!important;text-align: center;">
                                                                        ～
                                                                    </td>
                                                                    <td style="border: none!important;">
                                                                        <input name="payment_day_end"
                                                                            id="payment_day_end"
                                                                            value="{{ isset($fsReqData['payment_day_end']) ? $fsReqData['payment_day_end'] : $_payment_day_end }}"
                                                                            type="text"
                                                                            class="form-control datePicker datePicker1_2"
                                                                            autocomplete="off" value=""
                                                                            placeholder="年/月/日"
                                                                            oninput="this.value = this.value.replace(/[^\d^\/]/g, '').replace(/([\d]{4}\/?)([\d]{2}\/?)([\d]{2})/g, '$1$2$3').replace(/([\d]{8})([\d]{1,2})?/g, '$1');"
                                                                            onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))"
                                                                            maxlength="10">
                                                                        <input type="hidden"
                                                                            value="{{ isset($fsReqData['payment_day_end']) ? $fsReqData['payment_day_end'] : $_payment_day_end }}"
                                                                            class="datePickerHidden">
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>

                                                <div class="row mb-2">
                                                    <div class="ml-3 mr-3">
                                                        <table class="table custom-form"
                                                            style="margin-bottom: 0px!important;" id="tbl-supplier">
                                                            <tbody>
                                                                <tr>
                                                                    <td
                                                                        style="width: 23px!important;padding: 0!important;border:0!important;">
                                                                        <div class="line-icon-box"></div>
                                                                    </td>
                                                                    <td
                                                                        style="width: 71px !important;border: none!important;text-align: left!important;color: black;">
                                                                        売上請求先
                                                                    </td>
                                                                    <td style=" border: none!important;">
                                                                        <div class="input-group input-group-sm">
                                                                            <input type="text"
                                                                                class="form-control billing_address custom_modal_input"
                                                                                name="billing_address_text"
                                                                                value="{{ isset($fsReqData['billing_address_text']) ? $fsReqData['billing_address_text'] : null }}"
                                                                                id="billing_address" readonly=""
                                                                                placeholder="売上請求先"
                                                                                style="padding: 0!important;">
                                                                            <input type="hidden"
                                                                                class="billing_address_db"
                                                                                name="top_billing_address"
                                                                                value="{{ isset($fsReqData['top_billing_address']) ? $fsReqData['top_billing_address'] : null }}"
                                                                                id="billing_address_db">
                                                                            <div class="input-group-append">
                                                                                <button type="button"
                                                                                    class="input-group-text btn"
                                                                                    onclick="supplierSelectionModalOpener_2('billing_address','billing_address_db','1','nullable','r16cd',null,event.preventDefault())">
                                                                                    <i class="fas fa-arrow-left"></i>
                                                                                </button>
                                                                            </div>
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
                                    <div class="content-head-middle">
                                        <div class="row d-flex align-items-center">
                                            <div class="col-8">
                                                <div class="radio-rounded d-inline-block">
                                                    <div class="custom-control custom-radio custom-control-inline"
                                                        style="padding-left:11px!important;">
                                                        @php
                                                        $firstRadioChecked = false;
                                                        $secondRadioChecked = false;
                                                        $thirdRadioChecked = false;
                                                        if (isset($fsReqData['unsoutesuryou'])) {
                                                        if ($fsReqData['unsoutesuryou'] == 1) {
                                                        $firstRadioChecked = true;
                                                        }
                                                        if ($fsReqData['unsoutesuryou'] == 2) {
                                                        $secondRadioChecked = true;
                                                        }
                                                        if ($fsReqData['unsoutesuryou'] == 3) {
                                                        $thirdRadioChecked = true;
                                                        }
                                                        } else {
                                                        $firstRadioChecked = true;
                                                        }
                                                        @endphp
                                                        <input type="radio" class="custom-control-input"
                                                            id="customRadio1" name="unsoutesuryou" value="1"
                                                            {{ $firstRadioChecked ? 'checked' : '' }}>
                                                        <label class="custom-control-label" for="customRadio1"
                                                            style="font-size: 12px!important;cursor:pointer;">通常</label>
                                                    </div>
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input type="radio" class="custom-control-input"
                                                            id="customRadio2" name="unsoutesuryou" value="2"
                                                            {{ $secondRadioChecked ? 'checked' : '' }}>
                                                        <label class="custom-control-label" for="customRadio2"
                                                            style="font-size: 12px!important;cursor:pointer;">前受</label>
                                                    </div>
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input type="radio" class="custom-control-input"
                                                            id="customRadio3" name="unsoutesuryou" value="3"
                                                            {{ $thirdRadioChecked ? 'checked' : '' }}>
                                                        <label class="custom-control-label" for="customRadio3"
                                                            style="font-size: 12px!important;cursor:pointer;">前受振替</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="d-inline-block float-right">
                                                    <button
                                                        onclick="firstSearch('{{ route('depositHistoryList') }}',event.preventDefault())"
                                                        type="button" class="btn btn-info uskc-button">表示</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>