@if (isset($deposit_input_details) && $deposit_input_details)
    @php
        function numberFormat($value)
        {
            return gettype($value) == 'double' ? number_format($value, 2) : number_format($value);
        }
    @endphp
    @foreach ($deposit_input_details as $deposit_input_detail)
        @php
            $paymentMethodReq = $deposit_input_detail->soufusakiname ?? null;
            $type1 = ['A901', 'A902', 'A903', 'A904'];
            $type2 = ['A905'];
            $isSelectDisable = !in_array($paymentMethodReq, $type1) ? 'pointer-events: none;' : '';
            $isInputDisable = !in_array($paymentMethodReq, $type2) ? 'readonly' : '';
            $isInputDisableStyle = !in_array($paymentMethodReq, $type2) ? 'pointer-events: none;' : '';
        @endphp
        <div class="row mt-2 lineItem" id="lineItem-{{ $loop->index }}">
            <input type="hidden" value="{{ $deposit_input_detail->shinkurokokyakugroup }}"
                class="shinkurokokyakugroup" name="shinkurokokyakugroup[]"
                id="shinkurokokyakugroup-{{ $loop->index }}" />
            <div class="col-12">
                <div class="data-wrapper-content" style="width: 100%;">
                    <div class="data-box-content"
                        style="width: 10%; float: left;background-color:#666666;text-align: center;color:#fff;height: 37px;vertical-align: middle;border-radius: 5px 0px 5px;">
                        <div style="padding: 8px 0px;height: 37px;">
                            <div style="width:100%;float:left;">
                                <div style="text-align: center;width:20%;float:left;color: #fff;">
                                    <span id="serial-{{ $loop->index }}"
                                        class="serial">{{ $deposit_input_detail->shinkurokokyakugroup }}</span>
                                    <input type="hidden" class="serial-input" id="serial-input-{{ $loop->index }}"
                                        name="serial[]" value="{{ $deposit_input_detail->shinkurokokyakugroup }}">
                                </div>
                                <div style="width:40%;margin-top: -2px;float:left;color: #fff;">
                                    <button class="btn repeat_btn"
                                        style="border-radius: 10px;border:0;padding: 0 9px;height: 23px;line-height: 25px;font-size:12px;background-color: #4EBDD9;color: #fff;cursor: pointer;">
                                        <i class="fa fa-plus" aria-hidden="true"></i></button>
                                </div>
                                <div style="width:40%;float:left;margin-top: -2px;">
                                    <button type="button" class="btn delete_btn"
                                        style="background-color: #FF6666;color: #fff;border-radius: 10px;border:0;padding: 0 9px;height: 23px;line-height: 23px;font-size:12px;cursor: pointer;">
                                        <i class="fa fa-trash" aria-hidden="true"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="data-box-content2 custom-form text-center orderentry-databox"
                        style="width: 90%;float: left;background: white;">
                        <div style="width: 100%;float: left;">
                            <div class="data-box float-left" style="padding: 5px; width: 11%;">
                                <div class="custom-arrow">
                                    <select class="form-control left_select payment_method"
                                        id="payment_method-{{ $loop->index }}" name="payment_method[]">
                                        @foreach ($paymentMethods as $categoryKanri)
                                            <option @if ($deposit_input_detail->soufusakiname == $categoryKanri->category1 . $categoryKanri->category2) selected @endif
                                                value="{{ $categoryKanri->category1 . $categoryKanri->category2 }}">
                                                {{ $categoryKanri->category2 . ' ' . $categoryKanri->category4 }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="data-box float-left"
                                style="padding: 5px; width: 11%; {{ $isSelectDisable }}">
                                <div class="custom-arrow">
                                    <select class="form-control left_select deposit_bank"
                                        id="deposit_bank-{{ $loop->index }}"
                                        {{ $isSelectDisable ? ' readonly ' : '' }} name="deposit_bank[]" onchange="depositBranchSelection($(this))">
                                        <option value="{{ null }}">-</option>
                                        @foreach ($depositBanks as $categoryKanri)
                                            <option @if ($deposit_input_detail->soufusakiyubinbango == $categoryKanri->category1 . $categoryKanri->category2) selected
{{-- @elseif(!$deposit_input_detail->soufusakiyubinbango  && $bankCategory2 && $bankCategory2 == $categoryKanri->category1.$categoryKanri->category2) selected --}} @endif value="{{ $categoryKanri->category1 . $categoryKanri->category2 }}">
                                                {{ $categoryKanri->category2 . ' ' . $categoryKanri->category4 }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="data-box float-left"
                                style="padding: 5px; width: 11%;{{ $isSelectDisable }}">
                                <div class="custom-arrow">
                                    <!-- <select class="form-control left_select deposit_branch"
                                        id="deposit_branch-{{ $loop->index }}"
                                        {{ $isSelectDisable ? ' readonly ' : '' }} name="deposit_branch[]"> -->
                                    <select class="form-control left_select deposit_branch"
                                        id="deposit_branch-{{ $loop->index }}"
                                        readonly name="deposit_branch[]" style="background-image: none !important">
                                        <option value="{{ null }}"></option>
                                        @foreach ($depositBranches as $categoryKanri)
                                            <option @if ($deposit_input_detail->unsoumei == $categoryKanri->category1 . $categoryKanri->category2) selected
{{-- @elseif( !$deposit_input_detail->unsoumei && $branchCategory2 && $branchCategory2 == $categoryKanri->category1.$categoryKanri->category2) selected --}} @endif value="{{ $categoryKanri->category1 . $categoryKanri->category2 }}">
                                                {{ $categoryKanri->category2 . ' ' . $categoryKanri->category4 }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="data-box float-left" style="padding: 5px; width:10%;">
                                <div class="input-group">
                                    <input type="text" onblur="callforComma(this)" onfocus="callToRemoveComma(this)"
                                        maxlength="9" class="form-control deposit_amount text-right"
                                        name="deposit_amount[]"
                                        value="{{ $deposit_input_detail->nyukingaku ? numberFormat($deposit_input_detail->nyukingaku) : '' }}"
                                        id="deposit_amount-{{ $loop->index }}"
                                        oninput="this.value = this.value.replace(/[^0-9-.]/g, '').replace(/(\..*)\./g, '$1').replace(/\./g, '');">
                                </div>
                            </div>
                            @php
                                $formattedDate = $deposit_input_detail->chumondate1 ?? null;
                                if ($formattedDate) {
                                    $year = substr($formattedDate, 0, 4);
                                    $month = substr($formattedDate, 4, 2);
                                    $day = substr($formattedDate, 6, 2);
                                    $formattedDate = $year . '/' . $month . '/' . $day;
                                }

                            @endphp
                            <div class="data-box float-left"
                                style="padding: 5px; width: 10%;{{ $isInputDisableStyle }}">
                                <div class="input-group">
                                    <input autofocus="" type="text" class="form-control datePicker bill_settlement_date"
                                        id="bill_settlement_date-{{ $loop->index }}" name="bill_settlement_date[]"
                                        oninput="this.value = this.value.replace(/[^\d^\/]/g, '').replace(/([\d]{4}\/?)([\d]{2}\/?)([\d]{2})/g, '$1$2$3').replace(/([\d]{8})([\d]{1,2})?/g, '$1');"
                                        onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))"
                                        maxlength="10" {{ $isInputDisable }} autocomplete="off" placeholder="年/月/日"
                                        style="width: 96px!important;" value="{{ $formattedDate }}">
                                    <input type="hidden" class="datePickerHidden"
                                        value="{{ $deposit_input_detail->chumondate1 }}">
                                </div>
                            </div>
                            <div class="data-box float-left" style="padding: 5px; width: 47%;">
                                <div class="input-group">
                                    {{-- <input type="text" disabled style="position: absolute; border: 1px solid transparent !important;"> --}}
                                    <input type="text" class="form-control remarks" id="remarks-{{ $loop->index }}"
                                        name="remarks[]" value="{{ $deposit_input_detail->toiawasebango }}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@else
    <div class="row mt-2 lineItem" id="lineItem">
        <input type="hidden" value="{{ null }}" class="shinkurokokyakugroup" name="shinkurokokyakugroup[]"
            id="shinkurokokyakugroup" />
        <div class="col-12">
            <div class="data-wrapper-content" style="width: 100%;">
                <div class="data-box-content"
                    style="width: 10%; float: left;background-color:#666666;text-align: center;color:#fff;height: 37px;vertical-align: middle;border-radius: 5px 0px 5px;">
                    <div style="padding: 8px 0px;height: 37px;">
                        <div style="width:100%;float:left;">
                            <div style="text-align: center;width:20%;float:left;color: #fff;">
                                <span id="serial" class="serial">1</span>
                                <input type="hidden" class="serial-input" id="serial-input" name="serial[]" value="1">
                            </div>
                            <div style="width:40%;margin-top: -2px;float:left;color: #fff;">
                                <button class="btn repeat_btn"
                                    style="border-radius: 10px;border:0;padding: 0 9px;height: 23px;line-height: 25px;font-size:12px;background-color: #4EBDD9;color: #fff;cursor: pointer;">
                                    <i class="fa fa-plus" aria-hidden="true"></i></button>
                            </div>
                            <div style="width:40%;float:left;margin-top: -2px;">
                                <button type="button" class="btn delete_btn"
                                    style="background-color: #FF6666;color: #fff;border-radius: 10px;border:0;padding: 0 9px;height: 23px;line-height: 23px;font-size:12px;cursor: pointer;">
                                    <i class="fa fa-trash" aria-hidden="true"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="data-box-content2 custom-form text-center orderentry-databox"
                    style="width: 90%;float: left;background: white;">
                    <div style="width: 100%;float: left;">
                        <div class="data-box float-left" style="padding: 5px; width: 11%;">
                            <div class="custom-arrow">
                                <select class="form-control left_select payment_method" id="payment_method"
                                    name="payment_method[]">
                                    @foreach ($paymentMethods as $categoryKanri)
                                        <option value="{{ $categoryKanri->category1 . $categoryKanri->category2 }}">
                                            {{ $categoryKanri->category2 . ' ' . $categoryKanri->category4 }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="data-box float-left" style="padding: 5px; width: 11%;">
                            <div class="custom-arrow">
                                <select class="form-control left_select deposit_bank" id="deposit_bank" onchange="depositBranchSelection($(this))"
                                    name="deposit_bank[]">
                                    <option value="{{ null }}">-</option>
                                    @foreach ($depositBanks as $categoryKanri)
                                        <option value="{{ $categoryKanri->category1 . $categoryKanri->category2 }}">
                                            {{ $categoryKanri->category2 . ' ' . $categoryKanri->category4 }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="data-box float-left" style="padding: 5px; width: 11%;">
                            <div class="custom-arrow">
                                <select class="form-control left_select deposit_branch" id="deposit_branch" readonly style="pointer-events:none; background-image: none !important;"
                                    name="deposit_branch[]">
                                    <option value="{{ null }}"></option>
                                    @foreach ($depositBranches as $categoryKanri)
                                        <option value="{{ $categoryKanri->category1 . $categoryKanri->category2 }}">
                                            {{ $categoryKanri->category2 . ' ' . $categoryKanri->category4 }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="data-box float-left" style="padding: 5px; width: 10%;">
                            <div class="input-group">
                                <input type="text" class="form-control deposit_amount text-right"
                                    name="deposit_amount[]" maxlength="9" value="" onblur="callforComma(this)"
                                    onfocus="callToRemoveComma(this)"
                                    oninput="this.value = this.value.replace(/[^0-9-.]/g, '').replace(/(\..*)\./g, '$1').replace(/\./g, '');"
                                    id="deposit_amount">
                            </div>
                        </div>

                        <div class="data-box float-left" style="padding: 5px; width: 10%;pointer-events: none">
                            <div class="input-group">
                                <input autofocus="" type="text" class="form-control datePicker bill_settlement_date"
                                    id="bill_settlement_date" name="bill_settlement_date[]"
                                    oninput="this.value = this.value.replace(/[^\d^\/]/g, '').replace(/([\d]{4}\/?)([\d]{2}\/?)([\d]{2})/g, '$1$2$3').replace(/([\d]{8})([\d]{1,2})?/g, '$1');"
                                    onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))"
                                    maxlength="10" readonly autocomplete="off" placeholder="年/月/日"
                                    style="width: 96px!important;" value="">
                                <input type="hidden" class="datePickerHidden">
                            </div>
                        </div>
                        <div class="data-box float-left" style="padding: 5px; width: 47%;">
                            <div class="input-group">
                                {{-- <input type="text" disabled style="position: absolute; border: 1px solid transparent !important;"> --}}
                                <input type="text" class="form-control remarks" id="remarks" name="remarks[]" value="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
