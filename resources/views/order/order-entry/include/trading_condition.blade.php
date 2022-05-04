<div class="modal custom-data-modal" data-backdrop="static" id="tradingConditionModal" tabindex="-1" role="dialog"
     aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document" style="max-width: 700px;">
        <div class="modal-content bg-blue">
            <div class="modal-header p-2 pl-4 border-bottom-0" style="background: #fff;">
                <h5 class="modal-title" id="exampleModalLabel"><strong>取引条件</strong></h5>
                <span type="button" class="close closeTradingConditionModal"   aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </span>
            </div>
            <div class="modal-body pt-0 pr-1 pl-1" style="border: 2px solid #fff;" data-bind="nextFieldOnEnter:true">
                <div class="modal-data-box pl-4 pr-4">
                    <table class="table text-white" id="table-basic">
                        <tbody class="pl-4 pr-4">
                        <tr>
                            <td class="border-left-0"
                                style="width: 130px !important;padding-left: 0px !important; border-right: 0px !important;border-left: 0px !important;">
                                <div class="line-icon-box"></div>
                                入金方法
                            </td>
                            <td style="border-left: 0px !important;border-right: 0px !important;width: 840px;padding: 20px 0px !important;">
                                <div class="custom-arrow">
                                    <select name="payment_method" id="reg_kessaihouhou" class="form-control" autofocus>
                                        <!-- <option value="">入金方法を選択</option> -->
                                        @foreach($A9Data as $A9Dt)
                                            <option value="{{$A9Dt->category1}}{{$A9Dt->category2}}">{{$A9Dt->category2.' '}}{{$A9Dt->category4}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td style="border-left: 0px !important;width: 130px;padding-left: 0px !important;border-right: 0px !important;">
                                <div class="line-icon-box"></div>
                                検収条件
                            </td>
                            <td style="border-left: 0px !important;border-right: 0px !important;width: 840px;padding: 20px 0px !important;">
                                <div class="custom-arrow">
                                    <select name="acceptance_condition" id="reg_chumonsyajouhou" class="form-control">
                                        <!-- <option value="">検収条件を選択</option> -->
                                        @foreach($U2Data as $U2Dt)
                                            <option value="{{$U2Dt->category1}}{{$U2Dt->category2}}">{{$U2Dt->category2.' '}}{{$U2Dt->category4}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td style="border-left: 0px !important;border-right: 0px !important;width: 130px;padding-left: 0px !important;padding-top: 17px;">
                                <div class="line-icon-box"></div>
                                売上基準
                            </td>
                            <td style="border-left: 0px !important;border-right: 0px !important;width: 840px;padding: 20px 0px !important;">
                                <div class="custom-arrow">
                                    <select name="sales_standard" id="reg_soufusakijouhou" class="form-control">
                                        <!-- <option value="">売上基準を選択</option> -->
                                        @foreach($U3Data as $U3Dt)
                                            <option value="{{$U3Dt->category1}}{{$U3Dt->category2}}">{{$U3Dt->category2.' '}}{{$U3Dt->category4}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td style="border-left: 0px !important;border-right: 0px !important;border-bottom:0px !important;width: 130px;padding-left: 0px;padding-top: 24px !important;">
                                <div class="line-icon-box"></div>
                                即時区分
                            </td>
                            <td style="border-left: 0px !important;border-right: 0px !important;border-bottom:0px !important;width: 840px;padding: 20px 0px 0px !important;">
                                <div class="custom-arrow">
                                    <select name="immediate_version" id="reg_housoukubun" class="form-control">
                                        <!-- <option value="">即時区分を選択</option> -->
                                        @foreach($housoukubun as $housoukbn)
                                        <option value="{{$housoukbn->syouhinbango}}">
                                          {{$housoukbn->syouhinbango.' '}}{{$housoukbn->jouhou}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer border-top-0 pl-4 pr-4">
                    <button type="button"  class="btn text-white w-145 bg-default closeTradingConditionModal" >
                        <i class="" aria-hidden="true" style="margin-right: 5px;"></i>
                        キャンセル
                    </button>
                    <button type="button"  id="select_trading_condition" class="btn w-145 bg-teal text-white ml-2">
                        入力する
                    </button>
                </div>

            </div>
        </div>
    </div>
</div>
