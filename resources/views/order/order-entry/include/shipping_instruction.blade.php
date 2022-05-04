<div class="modal custom-data-modal" data-backdrop="static" id="shippingInstructionModal" tabindex="-1" role="dialog"
     aria-labelledby="exampleModalLabel1" aria-hidden="true">
    <div class="modal-dialog" role="document" style="max-width: 700px;width:700px;">
        <div class="modal-content bg-blue">
            <input type="hidden" id="shippingTargetElm">
            <input type="hidden" id="issueNoteElm">
            <input type="hidden" id="deliveryMethodElm">
            <input type="hidden" id="continutionCategoryElm">
            <input type="hidden" id="newVupElm">
            <input type="hidden" id="vupCategoryElm">
            <input type="hidden" id="statementRemarksElm">
            <input type="hidden" id="shyohinColor4Elm">
            <input type="hidden" id="shyohin1TokuchouElm">
            <input type="hidden" id="shyohinData22Elm">
            <input type="hidden" id="shyohinData51Elm">
            <input type="hidden" id="productIdShip">
            <input type="hidden" id="flatRateContractId">
            <input type="hidden" id="lineFromId">


            <div class="modal-header" style="background: #fff;height: 72px;padding: 25px 31px;">
                <h5 class="modal-title" id="exampleModalLabel"><strong>出荷指示</strong></h5>
                <span type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </span>
            </div>
            <div class="modal-body" style="padding:0px 29px;border: 2px solid #fff;" data-bind="nextFieldOnEnter:true">
                
                {{-- Error Message Starts Here --}}
                <div id="shippingErrorData" style="margin-top: 30px; margin-left: -10px;"></div>
                {{-- Error Message Ends Here --}}

                <div class="modal-data-box">
                    <table class="table text-white" id="table-basic" style="margin-bottom: 0px !important;">
                        <tbody class="">
                        <tr style="height: 141px;">
                            <td class="border-left-0"
                                style="width: 127px !important;padding-left: 0px !important; border-right: 0px !important;border-left: 0px !important;">
                                <div class="line-icon-box"></div>
                                発出備考
                            </td>
                            <td style="width: 510px !important;border-left: 0px !important;border-right: 0px !important;padding: 20px 0px !important;">
                                <div class="">
                                    <textarea class="form-control" autofocus rows="5" id="departure_remarks"
                                              style=" resize: none;height: 90px;white-space:normal;border-radius:4px!important;"
                                              placeholder="発出備考を入力（全角60文字まで）"></textarea>
                                </div>
                            </td>
                        </tr>
                        <tr style="height: 87px;">
                            <td style="width: 127px !important;border-left: 0px !important;padding-left: 0px !important;border-right: 0px !important;">
                                <div class="line-icon-box"></div>
                                納品方法
                            </td>
                            <td style="width: 510px !important;border-left: 0px !important;border-right: 0px !important;padding: 20px 0px !important;">
                                <div class="custom-arrow">
                                    <select class="form-control" id="delivery_method">
                                        <option value=""> 選択なし</option>
                                        @foreach($deliveryMethods as $categoryKanri)
                                            <option data-category2="{{$categoryKanri->category2 }}"
                                                    value="{{$categoryKanri->category1.$categoryKanri->category2}}">{{$categoryKanri->category2 .' '.$categoryKanri->category4}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </td>
                        </tr>
                        <tr style="height: 85px;">
                            <td style="width: 127px !important;border-left: 0px !important;border-right: 0px !important;padding-left: 0px !important;padding-top: 17px;">
                                <div class="line-icon-box"></div>
                                継続区分
                            </td>
                            <td style="width: 510px !important;border-left: 0px !important;border-right: 0px !important;padding: 20px 0px !important;">
                                <div class="custom-arrow">
                                    <select class="form-control" id="continution_category">
                                        <option value=""> 選択なし</option>
                                        @foreach($continutionCategories as $request)
                                            <option data-req="{{$request->syouhinbango}}"
                                                value="{{$request->syouhinbango}}">{{$request->syouhinbango.' '.$request->jouhou}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </td>
                        </tr>
                        <tr style="height: 83px;">
                            <td style="width: 127px !important;border-left: 0px !important;border-right: 0px !important;padding-left: 0px;padding-top: 8px !important;">
                                <div class="line-icon-box"></div>
                                新規VUP
                            </td>
                            <td style="width: 510px !important;border-left: 0px !important;border-right: 0px !important;padding: 20px 0px !important;">
                                <div class="custom-arrow">
                                    <select class="form-control" id="new_vup">
                                        <option value="">選択なし</option>
                                        @foreach($newVups as $request)
                                            <option data-req="{{$request->syouhinbango}}"
                                                value="{{$request->syouhinbango}}">{{$request->syouhinbango.' '.$request->jouhou}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </td>
                        </tr>
                        <tr style="height: 81px;">
                            <td style="width: 127px !important;border-left: 0px !important;border-right: 0px !important;padding-left: 0px;padding-top: 8px !important;">
                                <div class="line-icon-box"></div>
                                VUP区分
                            </td>
                            <td style="width: 510px !important;border-left: 0px !important;border-right: 0px !important;padding: 20px 0px 0px !important;">
                                <div class="custom-arrow" style="padding-bottom: 20px">
                                    <select class="form-control" id="vup_category">
                                        <option value="">選択なし</option>
                                        @foreach($vupCategories as $request)
                                            <option data-req="{{$request->syouhinbango}}"
                                                value="{{$request->syouhinbango}}">{{$request->syouhinbango.' '.$request->jouhou}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </td>
                        </tr>
                        <tr style="height: 120px;">
                            <td style="width: 127px !important;border-left: 0px !important;border-right: 0px !important;padding-left: 0px;padding-top: 24px !important;">
                                <div class="line-icon-box"></div>
                                明細備考
                            </td>
                            <td style="width: 510px !important;border-left: 0px !important;border-right: 0px !important;padding-left: 0px;padding-top: 3px !important;">
                                <div class="">
                                    <textarea class="form-control" rows="5" id="statement_remarks"
                                              style="resize: none;height: 90px;white-space:normal;border-radius:4px!important;"
                                              placeholder="明細備考を入力（全角40文字まで）"></textarea>
                                </div>
                            </td>
                        </tr>

                        </tbody>
                    </table>
                    <table class="table" style="margin-bottom: 12px !important;">
                        <tbody>
                            <tr>
                                <td style="width:180px !important;padding-top:26px !important;border-bottom:0px !important;border-left: 0px !important;border-right: 0px !important;">
                                    <div class="line-icon-box"><span style="padding-left:23px;color:white;">作成済定期定額契約番号</span></div>

                                </td>
                                <td style="padding-top:32px !important;;border-bottom:0px !important;border-left: 0px !important;border-right: 0px !important;padding-left: 0px;">
                                <input type="text" id="flat_rate_contract_number" readonly class="form-control" value="" style="vertical-align:bottom !important;">
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer border-top-0" style="height:62px;padding:0px !important;">
                    <button type="button" id="close_shipping_instruction" class="btn text-white uskc-button bg-default">
                        <i class="" aria-hidden="true" style="margin-right: 5px;"></i>キャンセル
                    </button>
                    <button type="button" id="select_shipping_instruction" class="btn uskc-button bg-teal text-white ml-2">
                        入力する
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
