{{-- Table Settings Modal Starts Here --}}
<div class="modal custom-modal" data-keyboard="false" data-backdrop="static" id="setting_display_modal" tabindex="-1"
role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-bind="nextFieldOnEnter:true">
<div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 800PX;">
  <div class="modal-content">
    <div class="modal-header">
      <h6 class="modal-title" id="exampleModalLabel"></h6>
      <span type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">×</span>
      </span>
    </div>
    <div class="modal-body">
      <div class="row">
        <div class="col-lg-4">
          <button class="checkall btn btn-info " autofocus="" style="margin-bottom: 10px;">全選択</button>
          <button class="uncheck btn btn-info" style="margin-bottom: 10px;">全解除</button>
        </div>
        <div class="col-lg-4">
        </div>
        <div class="col-lg-4">
          <button class="btn btn-info " style="margin-bottom: 10px;float: right;">デフォルト</button>
        </div>
      </div>
               

      {{-- Table Settings Contents Starts Here --}}
      <div class="row">
        
        {{-- Table Settings Left Column Starts Here --}}
        <div class="col-lg-6">
          <div class="table-responsive setting_header">
            <table class="table table-striped modal-table-blue line-transparent table-bordered">
              <tbody>
                <tr>
                  <td>
                    <div class="custom-control custom-checkbox custom-control-inline">
                      <input type="checkbox" id="header1" class="custom-control-input customCheckBox" checked="">
                      <label class="custom-control-label margin_btn_17" for="header1"></label>
                    </div>
                  </td>
                  <td style="width:60px!important;">
                    <input type="tel" class="form-control" value="0" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                  </td>
                  <td class="text-left">
                    <span class="mt-1 text-left">受注番号</span>
                  </td>
                </tr>
                <tr>
                  <td>
                    <div class="custom-control custom-checkbox custom-control-inline">
                      <input type="checkbox" id="header2" class="custom-control-input customCheckBox">
                      <label class="custom-control-label margin_btn_17" for="header2"></label>
                    </div>
                  </td>
                  <td style="width:60px!important;">
                    <input type="tel" class="form-control" value="0" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                  </td>
                  <td class="text-left">
                    <span class="mt-1 text-left">受注先</span>
                  </td>
                </tr>
                <tr>
                  <td>
                    <div class="custom-control custom-checkbox custom-control-inline">
                      <input type="checkbox" id="header3" class="custom-control-input customCheckBox">
                      <label class="custom-control-label margin_btn_17" for="header3"></label>
                    </div>
                  </td>
                  <td style="width:60px!important;">
                    <input type="tel" class="form-control" value="0" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                  </td>
                  <td class="text-left">
                    <span class="mt-1 text-left">最終顧客</span>
                  </td>
                </tr>
                <tr>
                  <td>
                    <div class="custom-control custom-checkbox custom-control-inline">
                      <input type="checkbox" id="header4" class="custom-control-input customCheckBox">
                      <label class="custom-control-label margin_btn_17" for="header4"></label>
                    </div>
                  </td>
                  <td style="width:60px!important;">
                    <input type="tel" class="form-control" value="0" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                  </td>
                  <td class="text-left">
                    <span class="mt-1 text-left">受注金額</span>
                  </td>
                </tr>
                <tr>
                  <td>
                    <div class="custom-control custom-checkbox custom-control-inline">
                      <input type="checkbox" id="header5" class="custom-control-input customCheckBox">
                      <label class="custom-control-label margin_btn_17" for="header5"></label>
                    </div>
                  </td>
                  <td style="width:60px!important;">
                    <input type="tel" class="form-control" value="0" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                  </td>
                  <td class="text-left">
                    <span class="mt-1 text-left">売上日</span>
                  </td>
                </tr>
                <tr>
                  <td>
                    <div class="custom-control custom-checkbox custom-control-inline">
                      <input type="checkbox" id="header6" class="custom-control-input customCheckBox">
                      <label class="custom-control-label margin_btn_17" for="header6"></label>
                    </div>
                  </td>
                  <td style="width:60px!important;">
                    <input type="tel" class="form-control" value="0" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                  </td>
                  <td class="text-left">
                    <span class="mt-1 text-left">売</span>
                  </td>
                </tr>
                <tr>
                  <td>
                    <div class="custom-control custom-checkbox custom-control-inline">
                      <input type="checkbox" id="header7" class="custom-control-input customCheckBox">
                      <label class="custom-control-label margin_btn_17" for="header7"></label>
                    </div>
                  </td>
                  <td style="width:60px!important;">
                    <input type="tel" class="form-control" value="0" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                  </td>
                  <td class="text-left">
                    <span class="mt-1 text-left">仕入予定</span>
                  </td>
                </tr>
                <tr>
                  <td>
                    <div class="custom-control custom-checkbox custom-control-inline">
                      <input type="checkbox" id="header8" class="custom-control-input customCheckBox">
                      <label class="custom-control-label margin_btn_17" for="header8"></label>
                    </div>
                  </td>
                  <td style="width:60px!important;">
                    <input type="tel" class="form-control" value="0" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                  </td>
                  <td class="text-left">
                    <span class="mt-1 text-left">仕入実績</span>
                  </td>
                </tr>
                <tr>
                  <td>
                    <div class="custom-control custom-checkbox custom-control-inline">
                      <input type="checkbox" id="header9" class="custom-control-input customCheckBox">
                      <label class="custom-control-label margin_btn_17" for="header9"></label>
                    </div>
                  </td>
                  <td style="width:60px!important;">
                    <input type="tel" class="form-control" value="0" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                  </td>
                  <td class="text-left">
                    <span class="mt-1 text-left">内作予定</span>
                  </td>
                </tr>
                <tr>
                  <td>
                    <div class="custom-control custom-checkbox custom-control-inline">
                      <input type="checkbox" id="header10" class="custom-control-input customCheckBox">
                      <label class="custom-control-label margin_btn_17" for="header10"></label>
                    </div>
                  </td>
                  <td style="width:60px!important;">
                    <input type="tel" class="form-control" value="0" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                  </td>
                  <td class="text-left">
                    <span class="mt-1 text-left">内作実績</span>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
        {{-- Table Settings Left Column Ends Here --}}

        {{-- Table Settings Right Column Starts Here --}}
        <div class="col-lg-6">
          <div class="table-responsive setting_header">
            <table class="table table-striped modal-table-blue line-transparent table-bordered">
              <tbody>
                
                <tr>
                  <td>
                    <div class="custom-control custom-checkbox custom-control-inline">
                      <input type="checkbox" id="header11" class="custom-control-input customCheckBox">
                      <label class="custom-control-label margin_btn_17" for="header11"></label>
                    </div>
                  </td>
                  <td style="width:60px!important;">
                    <input type="tel" class="form-control" value="0" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                  </td>
                  <td class="text-left">
                    <span class="mt-1 text-left">実績合計</span>
                  </td>
                </tr>
                <tr>
                  <td>
                    <div class="custom-control custom-checkbox custom-control-inline">
                      <input type="checkbox" id="header12" class="custom-control-input customCheckBox">
                      <label class="custom-control-label margin_btn_17" for="header12"></label>
                    </div>
                  </td>
                  <td style="width:60px!important;">
                    <input type="tel" class="form-control" value="0" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                  </td>
                  <td class="text-left">
                    <span class="mt-1 text-left">仕入差額</span>
                  </td>
                </tr>
                <tr>
                  <td>
                    <div class="custom-control custom-checkbox custom-control-inline">
                      <input type="checkbox" id="header13" class="custom-control-input customCheckBox">
                      <label class="custom-control-label margin_btn_17" for="header13"></label>
                    </div>
                  </td>
                  <td style="width:60px!important;">
                    <input type="tel" class="form-control" value="0" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                  </td>
                  <td class="text-left">
                    <span class="mt-1 text-left">完了指検</span>
                  </td>
                </tr>
                <tr>
                  <td>
                    <div class="custom-control custom-checkbox custom-control-inline">
                      <input type="checkbox" id="header14" class="custom-control-input customCheckBox">
                      <label class="custom-control-label margin_btn_17" for="header14"></label>
                    </div>
                  </td>
                  <td style="width:60px!important;">
                    <input type="tel" class="form-control" value="0" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                  </td>
                  <td class="text-left">
                    <span class="mt-1 text-left">仕入完了日</span>
                  </td>
                </tr>
                <tr>
                  <td>
                    <div class="custom-control custom-checkbox custom-control-inline">
                      <input type="checkbox" id="header15" class="custom-control-input customCheckBox">
                      <label class="custom-control-label margin_btn_17" for="header15"></label>
                    </div>
                  </td>
                  <td style="width:60px!important;">
                    <input type="tel" class="form-control" value="0" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                  </td>
                  <td class="text-left">
                    <span class="mt-1 text-left">仕入完了計算フラグ</span>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
        {{-- Table Settings Right Column Ends Here --}}
        
      </div>
      {{-- Table Settings Contents Ends Here --}}

    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-info" data-dismiss="modal"><i class="fas fa-save" style="margin-right: 5px;"></i>保存</button>
    </div>
    
  </div>
</div>
</div>
{{-- Table Settings Modal Starts Here --}}