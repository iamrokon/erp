  <!-- ================ modal 3 start here ===========-->
  <div class="modal custom-data-modal" data-backdrop="static" id="tradingConditionModal" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document" style="max-width: 700px;height: 480px;width: 700px;">
      <div class="modal-content bg-blue">
        <div class="modal-header border-bottom-0" style="background: #fff;height: 69px;padding: 24px 31px;">
          <h5 class="modal-title" id="exampleModalLabel"><strong>取引条件</strong></h5>
          <span type="button" class="close" data-dismiss="modal" aria-label="Close">
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
                    仕入基準
                  </td>
                  <td
                    style="border-left: 0px !important;border-right: 0px !important;width: 840px;padding: 20px 0px !important;">
                    <div class="custom-arrow">
                      <select name="payment_criteria" id="reg_criteria" class="form-control" autofocus>
                      <option value="">-</option>
                      @foreach($A9Data as $A9Dt)
                          <option value="{{$A9Dt->category1}}{{$A9Dt->category2}}">{{$A9Dt->category2.' '}}{{$A9Dt->category4}}</option>
                      @endforeach
                      </select>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td
                    style="border-left: 0px !important;width: 130px;padding-left: 0px !important;border-right: 0px !important;">
                    <div class="line-icon-box"></div>
                    支払方法
                  </td>
                  <td
                    style="border-left: 0px !important;border-right: 0px !important;width: 840px;padding: 20px 0px !important;">
                    <input type="text" class="form-control" name="payment_method" id="reg_kessaihouhou" placeholder="01 現金振込" readonly>
                  </td>
                </tr>
                <tr>
                  <td
                    style="border-left: 0px !important;width: 130px;padding-left: 0px !important;border-right: 0px !important;">
                    <div class="line-icon-box"></div>
                    支払締日
                  </td>
                  <td
                    style="border-left: 0px !important;border-right: 0px !important;width: 840px;padding: 20px 0px !important;">
                    <input type="text" class="form-control" name="acceptance_condition" id="reg_chumonsyajouhou"  placeholder="20" readonly>
                  </td>
                </tr>
                <tr>
                  <td
                    style="border-left: 0px !important;width: 130px;padding-left: 0px !important;border-right: 0px !important;">
                    <div class="line-icon-box"></div>
                    支払月
                  </td>
                  <td
                    style="border-left: 0px !important;border-right: 0px !important;width: 840px;padding: 20px 0px !important;">
                    <input type="text" class="form-control" name="sales_standard" id="reg_soufusakijouhou" placeholder="1" readonly>
                  </td>
                </tr>
                <tr>
                  <td
                    style="border-left: 0px !important;width: 130px;padding-left: 0px !important;border-right: 0px !important;">
                    <div class="line-icon-box"></div>
                    支払日
                  </td>
                  <td
                    style="border-left: 0px !important;border-right: 0px !important;width: 840px;padding: 20px 0px !important;">
                    <input type="text" class="form-control" name="immediate_version" id="reg_housoukubun" placeholder="20" readonly>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
          <div class="modal-footer border-top-0 pl-4 pr-4">
            <button type="button" id="close_trading_condition" class="btn text-white w-145 bg-default closeTradingConditionModal" data-dismiss="modal"> <i class=""
                aria-hidden="true" style="margin-right: 5px;"></i>キャンセル
            </button>
            <button type="button" id="select_trading_condition" class="btn w-145 bg-teal text-white ml-2" data-dismiss="modal">
           入力する
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- ================ modal 3 end here ===========-->