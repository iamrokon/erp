<div class="modal custom-data-modal" data-backdrop="static" id="maintenanceConditionsModal" tabindex="0" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document" style="max-width: 700px;">
      <div class="modal-content bg-blue">
        <div class="modal-header p-2 pl-4 border-bottom-0" style="background: #fff;">
          <h5 class="modal-title" id="exampleModalLabel"><strong>保守条件</strong></h5>
          <span type="button" onclick="maintenanceDataCancellation()" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </span>
        </div>
        <div class="modal-body pt-0 pr-1 pl-1" style="border: 2px solid #fff;" data-bind="nextFieldOnEnter:true">
          <div class="modal-data-box pl-4 pr-4">
              
            <!-- Error Message Starts Here -->
            <div id="maintenance_error_data" style="padding-top: 10px;"></div>
            <!-- Error Message Ends Here -->
            
            <!--initial value status-->
            <input type="hidden" id="initial_info2_status" value=""/>
            <input type="hidden" id="initial_product_status" value=""/>
            <input type="hidden" id="initial_maintenance_status" value=""/>
            <input type="hidden" id="initial_shipping_status" value=""/>
            <input type="hidden" id="initial_datachar03_status" value=""/>
            <input type="hidden" id="initial_datachar04_status" value=""/>
              
            <table class="table text-white custom-form" id="maintenance-table">
              <tbody class="pl-4 pr-4">
                <tr>
                  <td class="border-left-0"
                    style="width: 130px !important;padding-left: 0px !important; border-right: 0px !important;border-left: 0px !important;">
                    <div class="line-icon-box"></div>保守窓口
                  </td>
                  <td style="border-left: 0px !important;border-right: 0px !important;width: 840px;padding: 20px 0px !important;">
                    <div class="input-group input-group-sm" id="maintenance_window_err">
                      <input name="db_datatxt0124" id="db_reg_maintenance_window" type="hidden">
                      <input name="datatxt0124" id="reg_maintenance_window" type="text" readonly class="form-control" autofocus="" placeholder="（保守窓口）">
                      <div class="input-group-append" data-toggle="modal" data-target="">
                          <button onclick="supplierSelectionModalOpener('reg_maintenance_window','db_reg_maintenance_window','0','required','r17_3cd',event.preventDefault())" id="maintenance_sub_btn1" class="input-group-text btn"><i class="fas fa-arrow-left"></i></button>
                      </div>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td
                    style="border-left: 0px !important;border-right: 0px !important;width: 130px;padding-left: 0px !important;padding-top: 17px;">
                    <div class="line-icon-box"></div>窓口数
                  </td>
                  <td style="border-left: 0px !important;border-right: 0px !important;width: 840px;padding: 20px 0px !important;">
                      <input name="numericmax" id="reg_numericmax" type="text" value="1" class="form-control" placeholder="">
                  </td>
                </tr>
                <tr>
                  <td
                    style="border-left: 0px !important;border-right: 0px !important;width: 130px;padding-left: 0px;">
                    <div class="line-icon-box"></div>保守会社
                  </td>
                  <td style="border-left: 0px !important;border-right: 0px !important;width: 840px;padding: 20px 0px !important;">
                      <div class="input-group input-group-sm" id="maintenance_company_err">
                      <input name="db_datatxt0123" id="db_reg_maintenance_company" type="hidden">
                      <input name="datatxt0123" id="reg_maintenance_company" type="text" readonly class="form-control" placeholder="（保守窓口）">
                      <div class="input-group-append" data-toggle="modal" data-target="">
                        <button onclick="supplierSelectionModalOpener('reg_maintenance_company','db_reg_maintenance_company','0','required','r17_3cd',event.preventDefault())" id="maintenance_sub_btn2" class="input-group-text btn"><i class="fas fa-arrow-left"></i></button>
                      </div>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td
                    style="border-left: 0px !important;border-right: 0px !important;width: 130px;padding-left: 0px;">
                    <div class="line-icon-box"></div>保証書番号
                  </td>
                  <td style="border-left: 0px !important;border-right: 0px !important;width: 840px;padding: 20px 0px !important;">
                   
                        <input name="datatxt0120" id="reg_datatxt0120" type="text" class="form-control" placeholder="" style="border-radius: 4px !important;">
                    
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
          <div class="modal-footer border-top-0 pl-4 pr-4">
            <button type="button" id="" onclick="maintenanceDataCancellation()" class="btn text-white w-145 bg-default" data-dismiss="modal"> <i class=""
                aria-hidden="true" style="margin-right: 5px;"></i>キャンセル
            </button>
              <button type="button" onclick="validateMaintenance()" id="maintenance_submit_button" class="btn w-145 bg-teal text-white ml-2">
              入力する
            </button>
          </div>

        </div>
      </div>
    </div>
</div>