<div class="modal custom-data-modal" data-backdrop="static" id="transactionTermsModal" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document" style="max-width: 700px;">
      <div class="modal-content bg-blue">
        <div class="modal-header p-2 pl-4 border-bottom-0" style="background: #fff;">
          <h5 class="modal-title" id="exampleModalLabel"><strong>取引条件</strong></h5>
          <span type="button" onclick="transactionDataCancellation()" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </span>
        </div>
        <div class="modal-body pt-0 pr-1 pl-1" style="border: 2px solid #fff;" data-bind="nextFieldOnEnter:true">
          <div class="modal-data-box pl-4 pr-4">
            
            <!--initial value status-->
            <input type="hidden" id="transaction_initial_val_status" value=""/>
            
            <table class="table text-white custom-form" id="table-basic">
              <tbody class="pl-4 pr-4">
                <tr>
                  <td class="border-left-0"
                    style="width: 130px !important;padding-left: 0px !important; border-right: 0px !important;border-left: 0px !important;">
                    <div class="line-icon-box"></div>入金方法
                  </td>
                  <td
                    style="border-left: 0px !important;border-right: 0px !important;width: 840px;padding: 20px 0px !important;">
                    <div class="custom-arrow">
                      <select name="kessaihouhou" id="reg_kessaihouhou" class="form-control"  autofocus>
                        @foreach($catA9Data as $A9Dt)
                            <option value="{{$A9Dt->category1}}{{$A9Dt->category2}}">{{$A9Dt->category2.' '}}{{$A9Dt->category4}}</option>
                        @endforeach
                      </select>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td
                    style="border-left: 0px !important;width: 130px;padding-left: 0px !important;border-right: 0px !important;">
                    <div class="line-icon-box"></div>入金月
                  </td>
                  <td style="border-left: 0px !important;border-right: 0px !important;padding: 20px 0px !important;">
                    <div class="custom-arrow" style="width: 85%;display: inline-block;">
                        <select name="datatxt0116" id="reg_deposit_month" class="form-control" style="">
                            @for($i=0;$i<=9;$i++)
                            <option value="{{$i}}">{{$i}}</option>
                            @endfor
                      </select>
                    </div>
                    <div style="width: 15%;display: inline-block;text-align: center;">ヵ月後</div>
                  </td>

                </tr>
                <tr>
                  <td
                    style="border-left: 0px !important;border-right: 0px !important;width: 130px;padding-left: 0px !important;padding-top: 17px;">
                    <div class="line-icon-box"></div>入金日
                  </td>
                  <td
                    style="border-left: 0px !important;border-right: 0px !important;width: 840px;padding: 20px 0px !important;">
                    <div class="custom-arrow">
                        <select name="datatxt0117" id="payment_day" class="form-control" style="width: 85%;">
                            @for($i=1;$i<=30;$i++)
                            <option value="{{$i}}">{{$i}}</option>
                            @endfor
                            <option value="31">末日</option>
                      </select>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td
                    style="border-left: 0px !important;border-right: 0px !important;width: 130px;padding-left: 0px;">
                    <div class="line-icon-box"></div>即時区分
                  </td>
                  <td
                    style="border-left: 0px !important;border-right: 0px !important;width: 840px;padding: 20px 0px 20px !important;">
                    <div class="custom-arrow">
                      <select name="housoukubun" id="reg_housoukubun" class="form-control" >
                        @foreach($housoukubun as $housoukbn)
                            <option value="{{$housoukbn->syouhinbango}}">
                              {{$housoukbn->syouhinbango.' '}}{{$housoukbn->jouhou}}</option>
                        @endforeach
                      </select>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td
                    style="border-left: 0px !important;border-right: 0px !important;width: 130px;padding-left: 0px;">
                    <div class="line-icon-box"></div>請求課税区分
                  </td>
                  <td
                    style="border-left: 0px !important;border-right: 0px !important;width: 840px;padding: 20px 0px 20px !important;">
                    <div class="custom-arrow">
                        <input type="hidden" id="hiddenOtodoketime" value="" />
                        <select name="otodoketime" id="billing_tax_classification" class="form-control" >
                        @foreach($catB1Data as $catB1Dt)
                            <option value="{{$catB1Dt->category1}}{{$catB1Dt->category2}}">{{$catB1Dt->category2.' '}}{{$catB1Dt->category4}}</option>
                        @endforeach
                      </select>
                    </div>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
          <div class="modal-footer border-top-0 pl-4 pr-4">
            <button type="button" id="" onclick="transactionDataCancellation()" class="btn text-white w-145 bg-default" data-dismiss="modal"> <i class=""
                aria-hidden="true" style="margin-right: 5px;"></i>キャンセル
            </button>
            <button type="button" id="choice_button" class="btn w-145 bg-teal text-white ml-2" data-dismiss="modal">
              入力する
            </button>
          </div>

        </div>
      </div>
    </div>
</div>