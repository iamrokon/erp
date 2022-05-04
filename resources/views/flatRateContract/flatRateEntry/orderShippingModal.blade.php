<div class="modal custom-data-modal" data-backdrop="static" id="orderShippingModal" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel1" aria-hidden="true">
    <div class="modal-dialog" role="document" style="max-width: 700px;">
      <div class="modal-content bg-blue">
        <div class="modal-header p-2 pl-4 border-bottom-0" style="background: #fff;">
          <h5 class="modal-title" id="exampleModalLabel"><strong>発注出荷</strong></h5>
          <span type="button" onclick="shippingDataCancellation()" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </span>
        </div>
        <div class="modal-body pt-0 pr-1 pl-1" style="border: 2px solid #fff;" data-bind="nextFieldOnEnter:true">
          <div class="modal-data-box pl-4 pr-4">
              
            <!-- Error Message Starts Here -->
            <div id="shipping_order_error_data" style="padding-top: 10px;"></div>
            <!-- Error Message Ends Here -->
            
            <input type="hidden" name="syouhin1_data52" id="syouhin1_data52" />
              
            <table class="table text-white custom-form" id="shipping-table">
              <tbody class="pl-4 pr-4">
                <tr>
                  <td class="border-left-0"
                    style="width: 150px !important;padding-left: 0px !important; border-right: 0px !important;border-left: 0px !important;">
                    <div class="line-icon-box"></div>メーカー品番
                  </td>
                  <td style="border-left: 0px !important;border-right: 0px !important;width: 840px;padding: 20px 0px !important;">
                      <input name="datachar03" id="reg_datachar03" type="text" class="form-control" placeholder="（メーカー品番）" autofocus=""  style="border-radius: 4px !important;">
                  </td>
                </tr>
                <tr>
                  <td
                    style="border-left: 0px !important;width: 150px;padding-left: 0px !important;border-right: 0px !important;">
                    <div class="line-icon-box"></div>メーカー品名
                  </td>
                  <td style="border-left: 0px !important;border-right: 0px !important;width: 840px;padding: 20px 0px !important;">
                    <div class="">
                        <textarea name="datachar04" id="reg_datachar04" class="form-control" rows="5" style=" resize: none;height: 75px;white-space:normal;border-radius:4px!important;" placeholder=""></textarea>
                       <!-- id="comment2" -->
                    </div>
                  </td>
                </tr>
                <tr>
                  <td style="border-left: 0px !important;border-right: 0px !important;border-bottom:0px !important;width: 150px;padding-left: 0px;">
                    <div class="line-icon-box"></div>仕入先
                  </td>
                  <td style="border-left: 0px !important;border-right: 0px !important;width: 840px;padding: 20px 0px !important;">
                    <div class="input-group input-group-sm">
                      <input name="db_supplier" id="db_reg_supplier" type="hidden">
                      <input name="supplier" id="reg_supplier" readonly type="text" class="form-control" placeholder="">
                      <div class="input-group-append" data-toggle="modal" data-target="">
                          <button onclick="supplierSelectionModalOpener('reg_supplier','db_reg_supplier','2','nullable','r17_3cd',event.preventDefault())" id="shipping_sub_btn1" class="input-group-text btn"><i class="fas fa-arrow-left"></i></button>
                      </div>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td
                    style="border-left: 0px !important;border-right: 0px !important;width: 150px;padding-left: 0px !important;padding-top: 17px;">
                    <div class="line-icon-box"></div>発注日
                  </td>
                  <td style="border-left: 0px !important;border-right: 0px !important;width: 840px;padding: 20px 0px !important;">
                    <!-- <input type="text" class="form-control" placeholder="yyyy/mm/dd" style="border-radius: 4px !important;"> -->
                    <div class="input-group">
                      <input name="dataint09" type="text" class="form-control" id="datepicker7_oen" oninput="this.value = this.value.replace(/[^\d^\/]/g, '').replace(/([\d]{4}\/?)([\d]{2}\/?)([\d]{2})/g, '$1$2$3').replace(/([\d]{8})([\d]{1,2})?/g, '$1');"
                        onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))"
                        maxlength="8" autocomplete="off" placeholder="年/月/日" style="width: 96px!important;" value="">
                      <input type="hidden" class="datePickerHidden">
                    </div>
                  </td>
                </tr>
                <tr>
                  <td
                    style="border-left: 0px !important;border-right: 0px !important;width: 150px;padding-left: 0px;">
                    <div class="line-icon-box"></div>個別納期
                  </td>
                   <td style="border-left: 0px !important;border-right: 0px !important;width: 840px;padding: 20px 0px !important;">
                      <!-- <input type="text" class="form-control" placeholder="yyyy/mm/dd" style="border-radius: 4px !important;"> -->
                      <div class="input-group">
                      <input name="dataint10" type="text" class="form-control" id="datepicker8_oen" oninput="this.value = this.value.replace(/[^\d^\/]/g, '').replace(/([\d]{4}\/?)([\d]{2}\/?)([\d]{2})/g, '$1$2$3').replace(/([\d]{8})([\d]{1,2})?/g, '$1');"
                        onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))"
                        maxlength="8"
                        autocomplete="off" placeholder="年/月/日"
                        style="width: 96px!important;" value="">
                      <input type="hidden" class="datePickerHidden">
                    </div>
                  </td>
                </tr>
                <tr>
                  <td style="border-left: 0px !important;border-right: 0px !important;border-bottom:0px !important;width: 150px;padding-left: 0px;">
                    <div class="line-icon-box"></div>納品先
                  </td>
                  <td style="border-left: 0px !important;border-right: 0px !important;width: 840px;padding: 20px 0px !important;">
                      <div class="input-group input-group-sm" id="delivery_destination_err">
                      <input name="db_datachar06" id="db_reg_delivery_destination" type="hidden">
                      <input name="datachar06" id="reg_delivery_destination" readonly type="text" class="form-control" placeholder="">
                      <div class="input-group-append" data-toggle="modal" data-target="">
                          <button onclick="supplierSelectionModalOpener('reg_delivery_destination','db_reg_delivery_destination','0','required','r17_3cd',event.preventDefault())" id="shipping_sub_btn2" class="input-group-text btn"><i class="fas fa-arrow-left"></i></button>
                      </div>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td
                    style="border-left: 0px !important;border-right: 0px !important;border-bottom:0px !important;width: 150px;padding-left: 0px;padding-top: 24px !important;">
                    <div class="line-icon-box"></div>発注出荷指示備考
                  </td>
                  <td
                    style="border-left: 0px !important;border-right: 0px !important;border-bottom:0px !important;width: 840px;padding: 20px 0px 0px !important;">
                    <div class="">
                        <textarea name="datachar07" id="reg_datachar07" class="form-control" rows="5" 
                        style=" resize: none;height: 75px;white-space:normal;border-radius:4px!important;"
                        placeholder=""></textarea>
                        <!-- id="comment2" -->
                    </div>
                  </td>
                </tr>
                <tr>
                  <td
                    style="border-left: 0px !important;border-right: 0px !important;border-bottom:0px !important;width: 150px;padding-left: 0px;padding-top: 24px !important;">
                    <div class="line-icon-box"></div>納品方法
                  </td>
                  <td
                    style="border-left: 0px !important;border-right: 0px !important;border-bottom:0px !important;width: 840px;padding: 20px 0px 0px !important;">
                   <div class="custom-arrow">
                       <select name="datachar09" id="deliveryMethod" class="form-control" >
                        @foreach($catG3Data as $catG3Dt)
                            <option value="{{$catG3Dt->category1}}{{$catG3Dt->category2}}">{{$catG3Dt->category2.' '}}{{$catG3Dt->category4}}</option>
                        @endforeach
                      </select>
                    </div>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
          <div class="modal-footer border-top-0 pl-4 pr-4">
            <button type="button" id="" onclick="shippingDataCancellation()" class="btn text-white w-145 bg-default" data-dismiss="modal"> <i class=""
                aria-hidden="true" style="margin-right: 5px;"></i>キャンセル
            </button>
            <button type="button" id="orderShippingSubmit" class="btn w-145 bg-teal text-white ml-2">
              <!--  <i class="fa fa-hand-paper-o" aria-hidden="true" style="margin-right: 5px;"></i> -->入力する
            </button>
          </div>
        </div>
      </div>
    </div>
</div>
