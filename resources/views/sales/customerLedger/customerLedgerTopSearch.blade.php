<div class="content-head-section">
    <div class="container">
        <div class="row customer-ledger" >
            <div class="col-lg-12">
                <input type="hidden" id="page_name" value="customer_ledger">
                <input type="hidden" id="customerLedgerSupplierDbHiddenVal" value="">
                {{-- Error Message Starts Here --}}
                <div id="msgDiv" class="common_error"></div>
                @if(isset($customerLedgerError)&& $customerLedgerError!=null)
                <p class="common_error">{{$customerLedgerError}}</p>
                @endif
                {{-- Error Message Ends Here --}}

                <div class="" style="">
                    <div class="wrap-100"
                         style="background-color: #fff;box-sizing: border-box; overflow: hidden;height: auto;">
                        <!-- product content row starts here -->
                        <form id="topSearch" action="{{route('customer_ledger')}}" method="POST">
                            @csrf
                            <input type="hidden" name="firstButton" value="topSearch">
                            <input type="hidden" name="userId" value="{{$bango}}">
                            <div class="row inner-top-content">
                                <div class="col-12">
                                    <!-- box design for table view -->
                                    <div class="row">
                                        <div class="col-5">
                                            <table class="table custom-form " style="border: none!important;width: auto; margin-top: 2px;">
                                                <tbody>
                                                <tr>
                                                    <td style="border: none!important;text-align: left;color: black;width: 94px !important;padding: 0px !important;">
                                                        <div class="line-icon-box float-left mr-3"></div>
                                                        年月
                                                    </td>
                                                    <td style="border: none!important;width: 115px;">
                                                        <input type="text" name="start_date" class="form-control datePicker datePicker1_1" autocomplete="off"
                                                               @if (isset($fsReqData['start_date'])) value="{{$fsReqData['start_date']}}" @else value="{{$thismonth}}" @endif placeholder="年/月" id="dateFrom"
                                                               oninput="this.value = this.value.replace(/[^\d^\/]/g, '').replace(/([\d]{4}\/?)([\d]{2})/g, '$1$2').replace(/([\d]{6})([\d]{1,2})?/g, '$1');"
                                                                onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))"
                                                                maxlength="7" autofocus>
                                                        <input type="hidden" class="datePickerHidden"  @if (isset($fsReqData['start_date'])) value="{{$fsReqData['start_date']}}" @else value="{{$thismonth}}" @endif>
                                                    </td>
                                                    <td style="width: 30px!important;border:0!important;text-align: center;">
                                                        ～
                                                    </td>
                                                    <td style="border: none!important;width: 115px;">
                                                        <input type="text" name="end_date" class="form-control datePicker datePicker1_2" autocomplete="off"
                                                               @if (isset($fsReqData['end_date'])) value="{{$fsReqData['end_date']}}" @else value="{{$thismonth}}" @endif placeholder="年/月" id="dateTo"
                                                               oninput="this.value = this.value.replace(/[^\d^\/]/g, '').replace(/([\d]{4}\/?)([\d]{2})/g, '$1$2').replace(/([\d]{6})([\d]{1,2})?/g, '$1');"
                                                                onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))"
                                                                maxlength="7">
                                                        <input type="hidden" class="datePickerHidden" @if (isset($fsReqData['end_date'])) value="{{$fsReqData['end_date']}}" @else value="{{$thismonth}}" @endif>
                                                    </td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-12">
                                            <table class="table custom-form" style="width:auto;">
                                                <tbody>
                                                <tr>
                                                    <td style="border: none!important;text-align: left;color: black;width:95px !important;padding: 0px !important;">
                                                        <div class="line-icon-box float-left mr-3"></div>
                                                        売上請求先
                                                    </td>
                                                    <td style="border: none!important;">
                                                        <div class="input-group input-group-sm position-relative">
                                                            <input type="text" id="customerLedgerSupplier" name="customerLedgerSupplier" readonly="" class="form-control custom_modal_input" placeholder="売上請求先"  style="padding: 0!important;" value="{{isset($fsReqData['customerLedgerSupplier'])? $fsReqData['customerLedgerSupplier'] : "売上請求先"}}">
                                                            <input type="hidden" name="customerLedgerSupplier_db" id="customerLedgerSupplier_db" value="{{isset($fsReqData['customerLedgerSupplier_db'])? $fsReqData['customerLedgerSupplier_db'] : null}}">
                                                            <div class="input-group-append" data-toggle="modal" data-target="">
                                                                <button onclick="supplierSelectionModalOpener_2('customerLedgerSupplier','customerLedgerSupplier_db','1','required','r16cd',event.preventDefault())" class="input-group-text btn"><i class="fas fa-arrow-left"></i></button>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="row content-button-section" style="border-top: 1px solid #E1E1E1;border-bottom: 1px solid #E1E1E1;padding-top: 25px;margin-top: 22px;padding-bottom: 25px;margin-bottom: 52px;">
                                        <div class="col">
                                            <div class="text-right" >
                                                <a id="topSearchBtn" class="btn btn-info btn-m-view uskc-button">表示</a>
                                            </div>
                                        </div>
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

