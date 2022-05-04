<div class="content-head-section">
    <div class="container">
        <form id="firstSearch" action="{{ route('billingLedger') }}" method="post">
<!--            <input id='page_name' value='billingLedger' type='hidden'/>-->
            <input type="hidden" name="Button" id="firstButton"
                value="{{ isset($old['Button']) ? $old['Button'] : null }}">
            <input type="hidden" id="fs_sortField" name="sortField"
                value="{{ isset($old['sortField']) ? $old['sortField'] : null }}">
            <input type="hidden" id="fs_sortType" name="sortType"
                value="{{ isset($old['sortType']) ? $old['sortType'] : null }}">
            <input type="hidden" id="fs_userId" name="userId" value="{{ $bango }}">
            <input type="hidden" id="first_csrf" value="{{ csrf_token() }}" name="_token" disabled>
            <input type="hidden" id="source" value="billingLedger" />
            @csrf
            <div class="row customer-ledger">
                <div class="col-lg-12">

                    <!-- Error Message Starts Here -->
                    <div id="error_data" class="common_error"></div>
                    @if (isset($exceedBillingLedger))
                        <p id="no_found_data" class="common_error">{{ $exceedBillingLedger }}</p>
                    @endif
                    <!-- Error Message Ends Here -->


                    <div class="" style="">
                        <div class="wrap-100"
                            style="background-color: #fff;box-sizing: border-box; overflow: hidden;height: auto;">
                            <div class="row inner-top-content">
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-5">
                                            @php
                                                $_ledger_year_start = now()
                                                    ->subMonth()
                                                    ->startOfMonth()
                                                    ->format('Y/m');
                                                $_ledger_year_end = now()->format('Y/m');
                                            @endphp
                                            <table class="table custom-form "
                                                style="border: none!important;width: auto; margin-top: 2px;">
                                                <tbody>
                                                    <tr>
                                                        <td
                                                            style="border: none!important;text-align: left;color: black;width: 95px !important;padding: 0px !important;">
                                                            <div class="line-icon-box float-left"></div>
                                                            年月
                                                        </td>
                                                        <td style="border: none!important;width: 115px;">
                                                            <input type="text" name="ledger_year_start"
                                                                id="ledger_year_start"
                                                                class="form-control datePicker datePicker1_1"
                                                                autocomplete="off" placeholder="年/月"
                                                                oninput="this.value = this.value.replace(/[^\d^\/]/g, '').replace(/([\d]{4}\/?)([\d]{2})/g, '$1$2').replace(/([\d]{6})([\d]{1,2})?/g, '$1');"
                                                                onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))"
                                                                maxlength="7" autofocus value="{{ isset($fsReqData['ledger_year_start']) ? $fsReqData['ledger_year_start'] : $_ledger_year_end }}">
                                                            <input type="hidden" class="datePickerHidden"
                                                                value="{{ isset($fsReqData['ledger_year_start']) ? $fsReqData['ledger_year_start'] : $_ledger_year_end }}" />
                                                        </td>
                                                        <td
                                                            style="width: 30px!important;border:0!important;text-align: center;">
                                                            ～
                                                        </td>
                                                        <td style="border: none!important;width: 115px;">
                                                            <input type="text" name="ledger_year_end"
                                                                id="ledger_year_end"
                                                                class="form-control datePicker datePicker1_2"
                                                                autocomplete="off" placeholder="年/月"
                                                                oninput="this.value = this.value.replace(/[^\d^\/]/g, '').replace(/([\d]{4}\/?)([\d]{2})/g, '$1$2').replace(/([\d]{6})([\d]{1,2})?/g, '$1');"
                                                                onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))"
                                                                maxlength="7" value="{{ isset($fsReqData['ledger_year_end']) ? $fsReqData['ledger_year_end'] : $_ledger_year_end }}">
                                                            <input type="hidden" class="datePickerHidden" value="{{ isset($fsReqData['ledger_year_end']) ? $fsReqData['ledger_year_end'] : $_ledger_year_end }}">
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <table class="table custom-form" style="width:auto;">
                                                <tbody>
                                                    <tr>
                                                        <td
                                                            style="border: none!important;text-align: left;color: black;width:95px !important;padding: 0px !important;">
                                                            <div class="line-icon-box float-left"></div>
                                                            売上請求先
                                                        </td>
                                                        <td style="border: none!important;">
                                                            <div class="input-group input-group-sm position-relative">
                                                                <input type="text" class="form-control custom_modal_input"
                                                                    id="billing_address" placeholder="売上請求先"
                                                                    name="billing_address_text" readonly=""
                                                                    value="{{ isset($fsReqData['billing_address_text']) ? $fsReqData['billing_address_text'] : null }}"
                                                                    style="padding-left: 0px !important;">
                                                                <input type="hidden" id="billing_address_db"
                                                                    name="billing_address" class="db_hidden_field"
                                                                    value="{{ isset($fsReqData['billing_address']) ? $fsReqData['billing_address'] : null }}"
                                                                    style="width:93%;">
                                                                <div class="input-group-append">
                                                                    <button type="button" class="input-group-text btn"
                                                                        style="cursor: pointer;"
                                                                        onclick="supplierSelectionModalOpener_2('billing_address','billing_address_db','1','required','r16cd',null,event.preventDefault());">
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
                                    <div class="row">
                                        <div class="col">
                                            <div class="text-right content-button-section" style="margin-top: 17px;margin-bottom: 47px;margin-right: 12px;border-top: 1px solid #e1e1e1;border-bottom: 1px solid #e1e1e1;padding-top: 25px;padding-bottom: 25px;">
                                                <button onclick="firstSearch('{{ route('billingLedger') }}',event.preventDefault())" class="btn btn-info btn-m-view uskc-button">表示</button>
                                                <!-- <button style="width: 150px;height:30px;line-height:30px;" href="#" class="btn btn-info" id="pdfCreationBtn" 
                                                    @php
                                                        if(isset($allBillingLedger)){
                                                            if(count($allBillingLedger) < 1){
                                                                echo "disabled";
                                                            }
                                                        }else{
                                                            echo "disabled";
                                                        }
                                                    @endphp>
                                                    PDF作成
                                                </button> -->
                                                <button style="width: 150px;height:30px;line-height:30px;" href="#" class="btn btn-info" id="pdfCreationBtn">
                                                    PDF作成
                                                </button>
                                                <div id="progress" class="progress" style="width: 348px; float: right;position: absolute;right: 25px;bottom: 35px;display: none;">
                                                    <div id="progress-bar" class="progress-bar progress-bar-striped bg-primary" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
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
