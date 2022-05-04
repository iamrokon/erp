
<div class="modal custom-data-modal" data-backdrop="static" id="delivery_destination_Modal" tabindex="-1" role="dialog"
aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document" style="max-width: 700px;height: 480px;width: 700px;">
  <div class="modal-content bg-blue">
    <div class="modal-header border-bottom-0" style="background: #fff;height: 69px;padding: 24px 31px;">
      <h5 class="modal-title" id="exampleModalLabel"><strong>納品先選択</strong></h5>
      <span type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </span>
    </div>
    <div class="modal-body pt-0 pr-1 pl-1" style="border: 2px solid #fff;" data-bind="nextFieldOnEnter:true">
      <div class="modal-data-box pl-4 pr-4">
        <table class="table text-white custom-form" id="table-basic">
          <tbody class="pl-4 pr-4">
            <tr>
              <td class="border-left-0"
                style="width: 130px !important;padding-left: 0px !important; border-right: 0px !important;border-left: 0px !important;">
                <div class="line-icon-box"></div>
                社内入れ
              </td>
              <td
                style="border-left: 0px !important;border-right: 0px !important;width: 840px;padding: 20px 0px !important;">
                <div class="radio-rounded custom-table-oh d-inline-block">
                  <div class="custom-control custom-radio custom-control-inline" style="padding-left:11px!important;">
                    <input type="radio" class="custom-control-input" id="delicustomRadio" name="delrd" value="Yes" autofocus=""
                      checked="">
                    <label class="custom-control-label text-white" for="delicustomRadio"
                      style="font-size: 12px!important;cursor:pointer;">有</label>
                  </div>
                  <div class="custom-control custom-radio custom-control-inline" style="padding-left:11px!important;">
                    <input type="radio" class="custom-control-input" id="delicustomRadio2" name="delrd" value="No">
                    <label class="custom-control-label text-white" for="delicustomRadio2"
                      style="font-size: 12px!important;cursor:pointer;"> 無</label>
                  </div>
                </div>
              </td>
            </tr>
            <tr>
              <td
                style="border-left: 0px !important;width: 130px;padding-left: 0px !important;border-right: 0px !important;">
                <div class="line-icon-box"></div>
                社内入れ担当
              </td>
              <td
                style="border-left: 0px !important;border-right: 0px !important;width: 840px;padding: 20px 0px !important;">
                <div class="custom-arrow">
                <input type='hidden' id="houseEntryCharge" name="houseEntryCharge" value="{{$tantousya->name}}" />
                  <select id="deliveryDesitanationModalName" name="houseEntryChargeName" class="form-control">
                    @foreach ($name as $tanto)
                        <option value="{{ $tanto->name}}" {{ ( $tanto->name == $tantousya->name) ? 'selected' : '' }}>
                            {{ $tanto->name }}
                            
                        </option>
                    @endforeach
                  </select>
                </div>
              </td>
            </tr>
            <tr>
              <td
                style="border-left: 0px !important;width: 130px;padding-left: 0px !important;border-right: 0px !important;">
                <div class="line-icon-box"></div>
                納品先
              </td>
              <td
                style="border-left: 0px !important;border-right: 0px !important;width: 840px;padding: 20px 0px !important;">
                <div class="input-group input-group-sm">
                  <!-- <input type="text" class="form-control" placeholder="" readonly="" style="padding: 0!important;"> -->
                  
                    <input type="text" class="form-control deliveryDest"
                        id="deliveryDest"placeholder="納品先" name="nouhinsaki" readonly="">
                    <input type="hidden" id="deliveryDest_db" name="deliveryDest"
                        class="db_hidden_field deliveryDest">
                  <div class="input-group-append">
                    <button onclick="supplierSelectionModalOpener(getSpecificIdForSoldModal($(this)).visibleId, getSpecificIdForSoldModal($(this)).hiddenId ,'0','required','r17_3',1,event.preventDefault())"
                         class="input-group-text btn sold_to_modal_opener"><i class="fas fa-arrow-left"></i></button>
                  </div>
                </div>
              </td>
            </tr>
            <tr>
              <td
                style="border-left: 0px !important;width: 130px;padding-left: 0px !important;border-right: 0px !important;">
                <div class="line-icon-box"></div>
                明細備考
              </td>
              <td
                style="border-left: 0px !important;border-right: 0px !important;width: 840px;padding: 20px 0px !important;">
                <div class="">
                  <textarea class="form-control" rows="5" name="comment2" id="comment2" style=" resize: none;height: 90px;white-space:normal;border-radius:4px!important;" placeholder=" 明細備考を入力（全角60文字まで）" maxlength="60"></textarea>
                </div>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="modal-footer border-top-0 pl-4 pr-4" id="deliveryDestinationModalButton">
        <button type="button" id="" class="btn text-white w-145 bg-default" data-dismiss="modal"> <i class=""
            aria-hidden="true" style="margin-right: 5px;"></i>キャンセル
        </button>
        <button type="button" id="destinationSelect" class="btn w-145 bg-teal text-white ml-2" >
        入力する
        </button>
      </div>
    </div>
  </div>
</div>
</div>