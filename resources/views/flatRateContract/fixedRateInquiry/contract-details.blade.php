<div class="content-bottom-top">
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="ml-3 mr-3">
                <div class="bottom-top-title" style="margin: 10px 10px; ">
                    契約内容
                </div>
            </div>
        </div>
    </div>
</div>
<div class="content-head-section">
    <div class="container">
        <div class="row order_entry_topcontent">
            <div class="ml-3" style="min-width: 1319px !important;">
                <div class="content-head-bottom" style="padding:13px 0;">
                    <div class="row">
                        <div class="ml-3 mr-3">
                            <table class="table custom-form custom-table" style="border: none!important;width: 100% !important;">
                                <tbody>
                                <tr>
                                    <td style="width: 23px!important;padding: 0!important;border:0!important;">
                                        <div class="line-icon-box"></div>
                                    </td>
                                    <td style="border: none!important;width: 83px !important;">商品CD</td>
                                    <td style="border: none!important; width: 142px !important; width: 55px !important;">
                                        <div class="input-group input-group-sm position-relative">
                                            <input type="text" class="form-control" value="{{$fixed_rate_inquiry->product_cd}}"  readonly="">
                                        </div>
                                    </td>
                                    <td style="border: none !important;">
                                        <div class="input-group">
                                            <input  type="text" class="form-control" value="{{$fixed_rate_inquiry->product_name}}"  readonly="" style="width: 462px !important;">
                                        </div>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="ml-3 mr-3">
                            <table class="table custom-form custom-table">
                                <tbody>
                                <tr>
                                    <td style="width: 23px!important;padding: 0!important;border:0!important;">
                                        <div class="line-icon-box"></div>
                                    </td>
                                    <td style=" border: none!important;width: 53px!important;">数量</td>
                                    <td style="border: none!important;">
                                        <input type="text" class="form-control" value="{{$fixed_rate_inquiry->quantity}}"  readonly="" style="width: 85px;">
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="ml-3 mr-3">
                            <table class="table custom-form custom-table">
                                <tbody>
                                <tr>
                                    <td style="width: 23px!important;padding: 0!important;border:0!important;">
                                        <div class="line-icon-box"></div>
                                    </td>
                                    <td style=" border: none!important;width: 53px!important;">単価</td>
                                    <td style="border: none!important;">
                                        <input type="text" class="form-control" value="{{number_format($fixed_rate_inquiry->unit_price)}}"  readonly="" style="width: 115px;">
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
                                    <td style=" border: none!important;width: 53px!important;">契約金額</td>
                                    <td style="border: none!important; width: 160px;">
                                        <input type="text" class="form-control" value="{{number_format($fixed_rate_inquiry->contract_amount)}}"  readonly="">
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="ml-3 mr-3">
                            <table class="table custom-form" style="width: auto;margin-bottom: 2px!important;">
                                <tbody>
                                <tr>
                                    <td style="border: none!important;text-align: left;width: 107px !important;padding:0px !important;">
                                        <div class="line-icon-box float-left"></div>契約期間
                                    </td>
                                    <td style="border: none!important; width: 96px;">
                                        <div class="input-group">
                                            <input type="text" class="form-control" id=""  readonly=""
                                                   maxlength="10" autocomplete="off" placeholder="年/月/日" value="{{$fixed_rate_inquiry->contract_period_start}}">
                                            {{-- <input type="hidden" class="datePickerHidden">--}}
                                        </div>
                                    </td>
                                    <td style="border: none!important;">
                                        <div class="input-group">
                                            <input type="text" class="form-control input_field" value="{{$fixed_rate_inquiry->contract_month}}" readonly="" placeholder="12" style="width: 42px!important;">
                                        </div>
                                    </td>
                                    <td style="width: 30px!important;border:0!important;text-align: center;">
                                        ～
                                    </td>
                                    <td style="border: none!important; width: 96px;">
                                        <div class="input-group">
                                            <input id="" type="text" class="form-control input_field" readonly="" value="{{$fixed_rate_inquiry->contract_period_end}}">
                                        </div>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="mr-3">
                            <table class="table custom-form custom-table" style="border: none!important;width: auto;">
                                <tbody>
                                <tr>
                                    <td style="width: 23px!important;padding: 0!important;border:0!important;">
                                        <div class="line-icon-box"></div>
                                    </td>
                                    <td style=" border: none!important; width: 78px!important;">自動継続</td>
                                    <td style=" border: none!important; width: 136px;">
                                        <input type="text" class="form-control" value="{{$fixed_rate_inquiry->automatic_continution}}" readonly="" >
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="ml-3 mr-3">
                            <table class="table custom-form" style="border: none!important;width: 660px;">
                                <tbody>
                                <tr>
                                    <td style="width: 23px!important;padding: 0!important;border:0!important;">
                                        <div class="line-icon-box"></div>
                                    </td>
                                    <td style=" border: none!important;width: 52px!important;">保守条件</td>
                                    <td style=" border: none!important; width: 170px;">
                                        <div class="input-group input-group-sm" style="cursor: pointer;">
                                            <button id="igroup1" onkeydown="stepup(event);" class="btn c_hover" style="background: #4D82C6;color: #fff!important;border:1px solid #4D82C6;width:130px; border-radius: 4px 0 0 4px;line-height: 26px;text-align: center;font-size: 13px;">
                                                保守条件
                                            </button>
                                            <div class="input-group-append">
                                                <button class="input-group-text btn" data-toggle="modal" data-target="#maintenanceCondition"><i class="fas fa-arrow-left"></i></button>
                                            </div>
                                        </div>
                                    </td>
                                    <td style="width: 23px!important;padding: 0!important;border:0!important; padding-left: 9px !important;">
                                        <div class="line-icon-box"></div>
                                    </td>
                                    <td style=" border: none!important;width: 53px!important;">SE</td>
                                    <td style=" border: none!important;">
                                        <input type="text" class="form-control input_field" value="{{$fixed_rate_inquiry->se}}" readonly="">
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="ml-3 mr-3" style="margin-right: 97px !important;">
                            <table class="table custom-form custom-table" style="border: none!important;width: auto;">
                                <tbody>
                                <tr>
                                    <td style="width: 23px!important;padding: 0!important;border:0!important;">
                                        <div class="line-icon-box"></div>
                                    </td>
                                    <td style=" border: none!important;width: 83px!important;">無償期間</td>
                                    <td style=" border: none!important; width: 142px;">
                                        <input type="text" name="" class="form-control" readonly="" value="{{$fixed_rate_inquiry->free_period_months}}" maxlength="40">
                                    </td>
                                    <td style=" border: none!important;">ヶ月</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="ml-3 mr-3">
                            <table class="table custom-form custom-table" style="border: none!important;width: auto;">
                                <tbody>
                                <tr>
                                    <td style="width: 23px!important;padding: 0!important;border:0!important;">
                                        <div class="line-icon-box"></div>
                                    </td>
                                    <td style=" border: none!important;width: 53px!important; padding-left: 4px !important;">請求サイクル</td>
                                    <td style=" border: none!important; width: 136px;">
                                        <input type="text" name="" class="form-control" readonly="" value="{{$fixed_rate_inquiry->billing_cycle}}" >
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="ml-3 mr-3">
                            <table class="table custom-form custom-table" style="border: none!important;width: auto; margin-left: 1px;">
                                <tbody>
                                <tr>
                                    <td style="width: 23px!important;padding: 0!important;border:0!important;">
                                        <div class="line-icon-box"></div>
                                    </td>
                                    <td style=" border: none!important;width: 53px!important;">請求月度</td>
                                    <td style=" border: none!important; width: 148px;">
                                        <input type="text" name="" class="form-control" readonly="" value="{{$fixed_rate_inquiry->billing_month}}">
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="ml-3 mr-3">
                            <table class="table custom-form custom-inpur-field" style="border: none!important;width: auto;">
                                <tbody>
                                <tr>
                                    <td style="width: 23px!important;padding: 0!important;border:0!important;">
                                        <div class="line-icon-box"></div>
                                    </td>
                                    <td style=" border: none!important;width: 53px!important;">伝票統合</td>
                                    <td class="border-line-area" style="border: none!important;">
                                        <input type="text" class="form-control" value="{{$fixed_rate_inquiry->voucher_registration}}" readonly="" style="width: 61px;">
                                    </td>

                                    <td style="width: 23px!important;padding: 0!important;border:0!important; padding-left: 27px !important;">
                                        <div class="line-icon-box"></div>
                                    </td>
                                    <td style="border: none!important;width: 53px!important;">発注出荷</td>
                                    <td style="border: none!important;width: 45%;">
                                        <div class="input-group input-group-sm" style="cursor: pointer;">
                                            <button id="igroup1" onkeydown="stepup(event);" class="btn c_hover" style="background: #4D82C6;color: #fff!important;border:1px solid #4D82C6;width:125px; border-radius: 4px 0 0 4px;line-height: 26px;text-align: center;font-size: 13px;">
                                                発注出荷
                                            </button>
                                            <div class="input-group-append">
                                                <button class="input-group-text btn" data-toggle="modal" data-target="#orderShipping"><i class="fas fa-arrow-left"></i></button>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="ml-3 mr-3">
                            <div class="row">
                                <div class="ml-3 mr-3">
                                    <table class="table custom-form custom-table" style="width: auto;margin-bottom: 2px!important;">
                                        <tbody>
                                        <tr>
                                            <td style="border: none!important;text-align: left;width: 106px !important;padding: 0px !important;">
                                                <div class="line-icon-box float-left"></div>有償期間
                                            </td>
                                            <td style="border: none!important;width: 143px;">
                                                <div class="input-group">
                                                    <input type="text" class="form-control" readonly="" id="" maxlength="10" autocomplete="off" placeholder="年/月/日"
                                                           style="width: 96px!important;" value="{{$fixed_rate_inquiry->paid_period_start}}">
                                                        {{--<input type="hidden" class="datePickerHidden">--}}
                                                </div>
                                            </td>
                                            <td style="width: 30px!important;border:0!important;text-align: center;">
                                                ～
                                            </td>
                                            <td style="border: none!important;width: 151px;">
                                               <div class="input-group">
                                                    <input type="text" class="form-control" readonly="" id="" maxlength="10" autocomplete="off" style="width: 96px!important;" value="{{$fixed_rate_inquiry->paid_period_end}}">
                                                        {{--<input type="hidden" class="datePickerHidden">--}}
                                                </div> 
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>

                                </div>
                            </div>
                            <div class="row">
                                <div class="ml-3 mr-3">
                                    <table class="table custom-form custom-table" style="border: none!important;width: auto;">
                                        <tbody>
                                        <tr>
                                            <td style="width: 23px!important;padding: 0!important;border:0!important;">
                                                <div class="line-icon-box"></div>
                                            </td>
                                            <td style="border: none!important;width: 83px!important;">計上日</td>
                                            <td style="border: none!important; width: 142px;">
                                                <input type="text" name="" class="form-control" readonly="" value="{{$fixed_rate_inquiry->accounting_date}}">
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="mr-3" style="margin-left: 127px !important;">
                                    <table class="table custom-form" style="border: none!important;width: auto;">
                                        <tbody>
                                        <tr>
                                            <td style="width: 23px!important;padding: 0!important;border:0!important;">
                                                <div class="line-icon-box"></div>
                                            </td>
                                            <td style="border: none!important;width: 76px;">自動売上</td>
                                            <td style="border: none!important;width: 138px;">
                                                <input type="text" name="" class="form-control" readonly="" value="{{$fixed_rate_inquiry->automatic_sales}}"/>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>

                                </div>
                            </div>
                        </div>
                        <div class="mr-3" style="margin-left: 15px !important;">
                            <table class="table custom-form " style="border: none!important;width: auto;">
                                <tbody>
                                <tr>
                                    <td style="width: 23px!important;padding: 0!important;border:0!important;">
                                        <div class="line-icon-box"></div>
                                    </td>
                                    <td style=" border: none!important;width: 53px!important;">伝票備考</td>
                                    <td style=" border: none!important;width: 582px;">
                                        <input type="text" name="" class="form-control" readonly="" value="{{$fixed_rate_inquiry->voucher_remarks}}" maxlength="40">
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width: 23px!important;padding: 0!important;border:0!important;">
                                        <div class="line-icon-box"></div>
                                    </td>
                                    <td style=" border: none!important;width: 53px!important;">社内備考</td>
                                    <td style=" border: none!important;width: 582px;">
                                        <input type="text" name="" class="form-control" readonly="" value="{{$fixed_rate_inquiry->in_house_remarks}}"  maxlength="40">
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="ml-3 mr-3">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col" style="max-width: 97.5% !important;">
                            <div style="border-top:1px solid #E1E1E1;margin-block: 10px;"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="ml-3 mr-3">
                            <table class="table custom-table custom-form custom-inpur-field" style="border: none!important;width: auto;">
                                <tbody>
                                <tr>
                                    <td style="width: 23px!important;padding: 0!important;border:0!important;">
                                        <div class="line-icon-box"></div>
                                    </td>
                                    <td style=" border: none!important;width: 83px!important;">営業粗利</td>
                                    <td style="border: none!important; width: 143px;">
                                        <input style="text-align: right" type="text" class="form-control" readonly="" value="{{number_format($fixed_rate_inquiry->gross_operating_profits)}}">
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="ml-3 mr-3">
                            <table class="table custom-table custom-form custom-inpur-field" style="border: none!important;width: auto;">
                                <tbody>
                                <tr>
                                    <td style="width: 23px!important;padding: 0!important;border:0!important;">
                                        <div class="line-icon-box"></div>
                                    </td>
                                    <td style=" border: none!important;width: 53px!important;">SE</td>
                                    <td style="border: none!important; width: 160px;">
                                        <input style="text-align: right" type="text" class="form-control" readonly=""value="{{number_format($fixed_rate_inquiry->se_1)}}">
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="ml-3 mr-3">
                            <table class="table custom-table custom-form custom-inpur-field" style="border: none!important;width: auto;">
                                <tbody>
                                <tr>
                                    <td style="width: 23px!important;padding: 0!important;border:0!important;">
                                        <div class="line-icon-box"></div>
                                    </td>
                                    <td style=" border: none!important;width: 53px!important;">研究所</td>
                                    <td style="border: none!important; width: 160px;">
                                        <input style="text-align: right" type="text" class="form-control" readonly="" value="{{number_format($fixed_rate_inquiry->laboratory)}}">
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="ml-3 mr-3">
                            <table class="table custom-table custom-form custom-inpur-field" style="border: none!important;width: auto;">
                                <tbody>
                                <tr>
                                    <td style="width: 23px!important;padding: 0!important;border:0!important;">
                                        <div class="line-icon-box"></div>
                                    </td>
                                    <td style=" border: none!important;width: 53px!important;">コール</td>
                                    <td style="border: none!important; width: 160px;">
                                        <input style="text-align: right" type="text" class="form-control" readonly="" value="{{number_format($fixed_rate_inquiry->call_1)}}"/>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="ml-3 mr-3">
                            <table class="table custom-form custom-inpur-field" style="border: none!important;width: auto;">
                                <tbody>
                                <tr>
                                    <td style="width: 23px!important;padding: 0!important;border:0!important;">
                                        <div class="line-icon-box"></div>
                                    </td>
                                    <td style=" border: none!important;width: 53px!important;">仕入金額</td>
                                    <td style="border: none!important; width: 159px;">
                                        <input style="text-align: right" type="text" class="form-control" readonly="" value="{{number_format($fixed_rate_inquiry->purchase_amount)}}">
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
