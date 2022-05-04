<div class="content-head-section" >
    <div class="container">
        <div class="row order_entry_topcontent inner-top-content">
            <div class="col">
                <div class="content-head-top" style="margin-bottom:25px;border-bottom:0px;">
                    <div class="row">
                        {{-- <div class="col-7">
                            <div class="row"> --}}
                                <div class="ml-3 mr-3">
                                    <table class="table custom-form custom-table" style="border: none!important;width: auto;">
                                        <tbody>
                                        <tr>
                                            <td style="width: 23px!important;padding: 0!important;border:0!important;">
                                                <div class="line-icon-box"></div>
                                            </td>
                                            <td style=" border: none!important;width: 53px!important;">定期ｻﾌﾞｽｸ区分</td>
                                            <td style=" border: none!important;width: 178px;">
                                                <input type="text" class="form-control" readonly="" autofocus value="{{$fixed_rate_inquiry->subscription_classification}}">
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="ml-3 mr-3">
                                    <table class="table custom-form custom-table" style="border: none!important;">
                                        <tbody>
                                        <tr>
                                            <td style="width: 23px!important;padding: 0!important;border:0!important;">
                                                <div class="line-icon-box"></div>
                                            </td>
                                            <td style=" border: none!important;width: 53px!important;">作成区分</td>
                                            <td style=" border: none!important;min-width: 250px">
                                                <input type="text" name="creation_category" class="form-control" readonly="" placeholder="" value="{{$fixed_rate_inquiry->creation_category}}">
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            {{-- </div>
                        </div> --}}
                        {{-- <div class="col">
                            <div class="row"> --}}
                               
                                {{-- <div class="col-3">
                                    <table class="table custom-form custom-table " style="border: none!important;width: auto;">
                                        <tbody>
                                        <tr>
                                            <td style="width: 23px!important;padding: 0!important;border:0!important;">
                                                <div class="line-icon-box"></div>
                                            </td>
                                            <td style=" border: none!important;width: 53px!important;">定期定額契約番号</td>
                                            <td style=" border: none!important;width: 178px;">
                                                <input type="text" name="" class="form-control" value="{{$fixed_rate_inquiry->flat_rate_contract_number}}" readonly>
                                            </td>
                                            <td style=" border: none!important;width: 50px;">
                                                <input type="text" name="" class="form-control" value="{{$fixed_rate_inquiry->number_of_contracts}}" readonly>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div> --}}
                                <div class="ml-3 mr-3">
                                    <table class="table custom-form" style="border: none!important;width: auto; margin-left: 3px !important;">
                                        <tbody>
                                        <tr>
                                            <td style="width: 23px!important;padding: 0!important;border:0!important;">
                                                <div class="line-icon-box"></div>
                                            </td>
                                            <td style=" border: none!important;width: 53px!important;">定期定額契約番号</td>
                                            <td style=" border: none!important;width: 349px;">
                                                <input type="text" name="" class="form-control" value="{{$fixed_rate_inquiry->flat_rate_contract_number}}" readonly>
                                            </td>
                                            <td style=" border: none!important;width: 50px;">
                                                <input type="text" name="" class="form-control" value="{{$fixed_rate_inquiry->number_of_contracts}}" readonly>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                                {{-- <div class="col-2"></div> --}}
                            {{-- </div>
                        </div> --}}


                    </div>
                    <div class="row">
                        <div class="ml-3 mr-3">
                            <div class="row">
                                <div class="ml-3 mr-3">
                                    <table class="table custom-form" style="width:auto;">
                                        <tbody>
                                        <tr>
                                            <td style="width: 23px!important;padding: 0!important;border:0!important;">
                                                <div class="line-icon-box"></div>
                                            </td>
                                            <td style=" border: none!important;width: 83px!important;">元受注番号
                                            </td>
                                            <td style=" border: none!important;width: 178px!important;">
                                                <input type="text" name="" class="form-control" readonly="" value="{{$fixed_rate_inquiry->order_number}}">
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="ml-3 mr-3">
                                    <table class="table custom-form">
                                        <tbody>
                                        <tr>
                                            <td style="width: 23px!important;padding: 0!important;border:0!important;">
                                                <div class="line-icon-box"></div>
                                            </td>
                                            <td style="border: none!important;width: 53px!important;">行</td>
                                            <td style="border: none!important;width: 65px;">
                                                <input type="text" name="" class="form-control" readonly="" value="{{$fixed_rate_inquiry->line}}">
                                            </td>
                                            <td style="border: none!important; width: 50px!important;"></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="ml-3 mr-3">
                                    <table class="table custom-form">
                                        <tbody>
                                        <tr>
                                            <td style="width: 23px!important;padding: 0!important;border:0!important;">
                                                <div class="line-icon-box"></div>
                                            </td>
                                            <td style=" border: none!important;width: 15px!important;">枝
                                            </td>
                                            <td style=" border: none!important;width: 65px;">
                                                <input type="text" name="" class="form-control" readonly="" value="{{$fixed_rate_inquiry->branch}}">
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="ml-3 mr-3">
                            <table class="table custom-form" style="border: none!important;width: auto; margin-left: 2px !important;">
                                <tbody>
                                    <tr>
                                        <td style="width: 23px!important;padding: 0!important;border:0!important;">
                                            <div class="line-icon-box"></div>
                                        </td>
                                        <td style=" border: none!important;width: 100px !important;">契約状態</td>
                                        <td style=" border: none!important;width: 400px;">
                                            <input type="text" name="" class="form-control" readonly="" value="{{$fixed_rate_inquiry->contract_status}}">
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-3"></div>
                        <div class="col-2"></div>
                    </div>
                    <div class="row">
                        <div class="ml-3 mr-3">
                            <table class="table custom-form custom-table-1" style="border: none!important;">
                                <tbody>
                                <tr>
                                    <td style="width: 23px!important;padding: 0!important;border:0!important;">
                                        <div class="line-icon-box"></div>
                                    </td>
                                    <td style="border: none!important;width: 83px!important;">売上請求先</td>
                                    <td style="border: none!important; width: 538px;">
                                        <div class="input-group">
                                            <input type="text" class="form-control" value="{{$fixed_rate_inquiry->billing_address}}" readonly>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width: 23px!important;padding: 0!important;border:0!important;">
                                        <div class="line-icon-box"></div>
                                    </td>
                                    <td style="border: none!important;width: 83px!important;">受注先</td>
                                    <td style="border: none!important;">
                                        <div class="input-group">
                                            <input type="text" class="form-control" value="{{$fixed_rate_inquiry->contractor}}" readonly>

                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width: 23px!important;padding: 0!important;border:0!important;">
                                        <div class="line-icon-box"></div>
                                    </td>
                                    <td style="border: none!important;width: 83px!important;">最終顧客</td>
                                    <td style="border: none!important;">
                                        <div class="input-group">
                                            <input type="text" class="form-control" value="{{$fixed_rate_inquiry->end_customer}}"readonly>
                                        </div>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="ml-3 mr-3">
                            <table class="table custom-form" style="border: none!important;width: auto;">
                                <tbody>
                                <tr>
                                    <td style="width: 23px!important;padding: 0!important;border:0!important;">
                                        <div class="line-icon-box"></div>
                                    </td>
                                    <td style=" border: none!important;width: 100px !important;">請求書送付先</td>
                                    <td style=" border: none!important; width: 400px;">
                                        <div class="input-group">
                                            <input type="text" class="form-control" value="{{$fixed_rate_inquiry->end_to}}" readonly>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width: 23px!important;padding: 0!important;border:0!important;">
                                        <div class="line-icon-box"></div>
                                    </td>
                                    <td style=" border: none!important;width: 100px!important;">PJ</td>
                                    <td style=" border: none!important;">
                                        <div class="input-group">
                                            <input type="text" class="form-control" value="{{$fixed_rate_inquiry->pj}}" readonly>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width: 23px!important;padding: 0!important;border:0!important;">
                                        <div class="line-icon-box"></div>
                                    </td>
                                    <td style=" border: none!important;width: 100px!important;">文書種類</td>
                                    <td style=" border: none!important;">
                                        <div class="input-group">
                                            <input type="text" class="form-control" value="{{$fixed_rate_inquiry->document_type}}" readonly>
                                        </div>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="ml-3 mr-3">
                            <table class="table custom-form custom-table custom-inpur-field" style="border: none!important;">
                                <tbody>
                                <tr>
                                    <td style="width: 23px!important;padding: 0!important;border:0!important;">
                                        <div class="line-icon-box"></div>
                                    </td>
                                    <td style=" border: none!important;width: 83px!important;">担当</td>
                                    <td style="border: none!important;">
                                        <input type="text" class="form-control" value="{{$fixed_rate_inquiry->in_charge}}" readonly style="width: 174px;">
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="ml-3 mr-3">
                            <table class="table custom-form custom-table custom-inpur-field" style="width: 330px !important;">
                                <tbody>
                                <tr>
                                    <td style="width: 23px!important; padding: 0!important;border:0!important;">
                                        <div class="line-icon-box"></div>
                                    </td>
                                    <td style="border: none!important; width: 53px !important;">取引条件</td>
                                    <td style="border: none!important;">
                                        <div class="input-group input-group-sm" style="cursor: pointer;">
                                            <button id="igroup1" onkeydown="stepup(event);" class="btn c_hover" style="background: #4D82C6;color: #fff!important;border:1px solid #4D82C6;width:96px; border-radius: 4px 0 0 4px;line-height: 26px;text-align: center;font-size: 13px;">
                                                取引条件
                                            </button>
                                            <div class="input-group-append">
                                                <button class="input-group-text btn" data-toggle="modal" data-target="#transactionTerm"><i class="fas fa-arrow-left"></i></button>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="ml-3 mr-3">
                            <table class="table custom-form" style="border: none!important;margin-top:6px;">
                                <tbody>
                                <tr>
                                    <td style="width: 23px!important;padding: 0!important;border:0!important;">
                                        <div class="line-icon-box"></div>
                                    </td>
                                    <td style=" border: none!important;width: 85px!important;">契約書</td>
                                    <td style=" border: none!important;width: 53px!important;"></td>
                                    <td style=" border: none!important;min-width: 187px;">
                            <span>
                                @php
                                $pdfPath = 'uploads/flat_rate_entry/'.$fixed_rate_inquiry->contract_pdf_show;
                                $isFileExits = $fixed_rate_inquiry->contract_pdf_show ?  file_exists(public_path($pdfPath)) : false;
                                $target_attribute = $isFileExits ?   'target="_blank"'  : '';
                                $pdfFile = $isFileExits ? asset($pdfPath) : '#'
                                @endphp
                                <a
                                    href="{{ $pdfFile  }}" {{$target_attribute}}
                                    style="color:blue;text-decoration:underline;">
                                    {{$fixed_rate_inquiry->contract_pdf}}
                                </a>

                            </span>
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
</div>
