 <div class="modal custom-data-modal" data-backdrop="static" id="exampleModal" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document" style="max-width: 700px;">
      <div class="modal-content bg-blue">
        <div class="modal-header p-2 pl-4 border-bottom-0" style="background: #fff;">
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
                    入金方法
                  </td>
                  <td
                    style="border-left: 0px !important;border-right: 0px !important;width: 840px;padding: 20px 0px !important;">
                    <input value="@if(isset($orderInquiryInfo[0]->kessaihouhou_detail)){{$orderInquiryInfo[0]->kessaihouhou_detail}}@endif" type="text" class="form-control" placeholder="" readonly="" autofocus="">
                  </td>
                </tr>
                <tr>
                  <td
                    style="border-left: 0px !important;width: 130px;padding-left: 0px !important;border-right: 0px !important;">
                    <div class="line-icon-box"></div>
                    検収条件
                  </td>
                  <td
                    style="border-left: 0px !important;border-right: 0px !important;width: 840px;padding: 20px 0px !important;">
                    <input value="@if(isset($orderInquiryInfo[0]->chumonsyajouhou_detail)){{$orderInquiryInfo[0]->chumonsyajouhou_detail}}@endif" type="text" class="form-control" placeholder="" readonly="">
                  </td>
                </tr>
                <tr>
                  <td
                    style="border-left: 0px !important;border-right: 0px !important;width: 130px;padding-left: 0px !important;padding-top: 17px;">
                    <div class="line-icon-box"></div>
                    売上基準
                  </td>
                  <td
                    style="border-left: 0px !important;border-right: 0px !important;width: 840px;padding: 20px 0px !important;">
                    <input value="@if(isset($orderInquiryInfo[0]->soufusakijouhou_detail)){{$orderInquiryInfo[0]->soufusakijouhou_detail}}@endif" type="text" class="form-control" placeholder="" readonly="">
                  </td>
                </tr>
                <tr>
                  <td
                    style="border-left: 0px !important;border-right: 0px !important;border-bottom:0px !important;width: 130px;padding-left: 0px;padding-top: 24px !important;">
                    <div class="line-icon-box"></div>
                    即時区分
                  </td>
                  <td
                    style="border-left: 0px !important;border-right: 0px !important;border-bottom:0px !important;width: 840px;padding: 20px 0px 0px !important;">
                    <input value="@if(isset($orderInquiryInfo[0]->housoukubun_detail)){{$orderInquiryInfo[0]->housoukubun_detail}}@endif" type="text" class="form-control" placeholder="" readonly="">
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
          <div class="modal-footer border-top-0 pl-4 pr-4">
          </div>
        </div>
      </div>
    </div>
</div>