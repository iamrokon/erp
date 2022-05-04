  <!-- Setting modal start -->
  <div class="modal custom-modal" data-keyboard="false" data-backdrop="static" id="setting_display_modal" tabindex="-1" role="dialog"
  aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 400px;">
      <div class="modal-content" data-bind="nextFieldOnEnter:true">
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
          <div class="row">
            <div class="col">
              <div class="table-responsive setting_header">
                <table class="table table-striped modal-table-blue line-transparent table-bordered">
                  <tbody class="">
                    <tr>
                      <td>
                        <div class="custom-control custom-checkbox custom-control-inline">
                          <input type="checkbox" id="th1" class="custom-control-input customCheckBox" checked="">
                          <label class="custom-control-label margin_btn_17" for="th1"></label>
                        </div>
                      </td>
                      <td style="width:60px!important;">
                        <input type="tel" class="form-control" value="0"
                        onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                      </td>
                      <td class="text-left">
                        <span class="mt-1 text-left">発注予定日</span>
                      </td>
                    </tr>

                    <tr>
                      <td>
                        <div class="custom-control custom-checkbox custom-control-inline">
                          <input type="checkbox" id="th2" class="custom-control-input customCheckBox" checked="">
                          <label class="custom-control-label margin_btn_17" for="th2"></label>
                        </div>
                      </td>
                      <td style="width:60px!important;">
                        <input type="tel" class="form-control" value="1"
                        onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                      </td>
                      <td class="text-left">
                        <span class="mt-1 text-left"> 個別納期</span>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="custom-control custom-checkbox custom-control-inline">
                          <input type="checkbox" id="th3" class="custom-control-input customCheckBox" checked="">
                          <label class="custom-control-label margin_btn_17" for="th3"></label>
                        </div>
                      </td>
                      <td style="width:60px!important;">
                        <input type="tel" class="form-control" value="1"
                        onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                      </td>
                      <td class="text-left">
                        <span class="mt-1 text-left">仕入先</span>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="custom-control custom-checkbox custom-control-inline">
                          <input type="checkbox" id="th4" class="custom-control-input customCheckBox" checked="">
                          <label class="custom-control-label margin_btn_17" for="th4"></label>
                        </div>
                      </td>
                      <td style="width:60px!important;">
                        <input type="tel" class="form-control" value="2"
                        onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                      </td>
                      <td class="text-left">
                        <span class="mt-1 text-left">品名</span>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="custom-control custom-checkbox custom-control-inline">
                          <input type="checkbox" id="th5" class="custom-control-input customCheckBox" checked="">
                          <label class="custom-control-label margin_btn_17" for="th5"></label>
                        </div>
                      </td>
                      <td style="width:60px!important;">
                        <input type="tel" class="form-control" value="2"
                        onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                      </td>
                      <td class="text-left">
                        <span class="mt-1 text-left">数量</span>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="custom-control custom-checkbox custom-control-inline">
                          <input type="checkbox" id="th6" class="custom-control-input customCheckBox">
                          <label class="custom-control-label margin_btn_17" for="th6"></label>
                        </div>
                      </td>
                      <td style="width:60px!important;">
                        <input type="tel" class="form-control"
                        onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                      </td>
                      <td class="text-left">
                        <span class="mt-1 text-left">単価</span>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="custom-control custom-checkbox custom-control-inline">
                          <input type="checkbox" id="th7" class="custom-control-input customCheckBox">
                          <label class="custom-control-label margin_btn_17" for="th7"></label>
                        </div>
                      </td>
                      <td style="width:60px!important;">
                        <input type="tel" class="form-control"
                        onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                      </td>
                      <td class="text-left">
                        <span class="mt-1 text-left">金額</span>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="custom-control custom-checkbox custom-control-inline">
                          <input type="checkbox" id="th8" class="custom-control-input customCheckBox">
                          <label class="custom-control-label margin_btn_17" for="th8"></label>
                        </div>
                      </td>
                      <td style="width:60px!important;">
                        <input type="tel" class="form-control"
                        onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                      </td>
                      <td class="text-left">
                        <span class="mt-1 text-left">発注作成</span>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="custom-control custom-checkbox custom-control-inline">
                          <input type="checkbox" id="th9" class="custom-control-input customCheckBox">
                          <label class="custom-control-label margin_btn_17" for="th9"></label>
                        </div>
                      </td>
                      <td style="width:60px!important;">
                        <input type="tel" class="form-control"
                        onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                      </td>
                      <td class="text-left">
                        <span class="mt-1 text-left">受注番号行番号枝番</span>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-info" data-dismiss="modal"><i class="fas fa-save"
          style="margin-right: 5px;"></i>保存 </button>
        </div>
      </div>
    </div>
  </div>

  <!-- Just for design. This should be common -->
  <div class="modal custom-modal" data-keyboard="false" data-backdrop="static" id="setting_display_modal_next" tabindex="-1" role="dialog"
  aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 400px;">
      <div class="modal-content" data-bind="nextFieldOnEnter:true">
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
          <div class="row">
            <div class="col">
              <div class="table-responsive setting_header">
                <table class="table table-striped modal-table-blue line-transparent table-bordered">
                  <tbody class="">
                    <tr>
                      <td>
                        <div class="custom-control custom-checkbox custom-control-inline">
                          <input type="checkbox" id="th1" class="custom-control-input customCheckBox" checked="">
                          <label class="custom-control-label margin_btn_17" for="th1"></label>
                        </div>
                      </td>
                      <td style="width:60px!important;">
                        <input type="tel" class="form-control" value="0"
                        onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                      </td>
                      <td class="text-left">
                        <span class="mt-1 text-left">仕入番号行番号</span>
                      </td>
                    </tr>

                    <tr>
                      <td>
                        <div class="custom-control custom-checkbox custom-control-inline">
                          <input type="checkbox" id="th2" class="custom-control-input customCheckBox" checked="">
                          <label class="custom-control-label margin_btn_17" for="th2"></label>
                        </div>
                      </td>
                      <td style="width:60px!important;">
                        <input type="tel" class="form-control" value="1"
                        onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                      </td>
                      <td class="text-left">
                        <span class="mt-1 text-left"> 仕入日</span>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="custom-control custom-checkbox custom-control-inline">
                          <input type="checkbox" id="th3" class="custom-control-input customCheckBox" checked="">
                          <label class="custom-control-label margin_btn_17" for="th3"></label>
                        </div>
                      </td>
                      <td style="width:60px!important;">
                        <input type="tel" class="form-control" value="1"
                        onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                      </td>
                      <td class="text-left">
                        <span class="mt-1 text-left">仕入先</span>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="custom-control custom-checkbox custom-control-inline">
                          <input type="checkbox" id="th4" class="custom-control-input customCheckBox" checked="">
                          <label class="custom-control-label margin_btn_17" for="th4"></label>
                        </div>
                      </td>
                      <td style="width:60px!important;">
                        <input type="tel" class="form-control" value="2"
                        onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                      </td>
                      <td class="text-left">
                        <span class="mt-1 text-left">納品書番号</span>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="custom-control custom-checkbox custom-control-inline">
                          <input type="checkbox" id="th5" class="custom-control-input customCheckBox" checked="">
                          <label class="custom-control-label margin_btn_17" for="th5"></label>
                        </div>
                      </td>
                      <td style="width:60px!important;">
                        <input type="tel" class="form-control" value="2"
                        onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                      </td>
                      <td class="text-left">
                        <span class="mt-1 text-left">品名</span>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="custom-control custom-checkbox custom-control-inline">
                          <input type="checkbox" id="th6" class="custom-control-input customCheckBox">
                          <label class="custom-control-label margin_btn_17" for="th6"></label>
                        </div>
                      </td>
                      <td style="width:60px!important;">
                        <input type="tel" class="form-control"
                        onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                      </td>
                      <td class="text-left">
                        <span class="mt-1 text-left">数量</span>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="custom-control custom-checkbox custom-control-inline">
                          <input type="checkbox" id="th7" class="custom-control-input customCheckBox">
                          <label class="custom-control-label margin_btn_17" for="th7"></label>
                        </div>
                      </td>
                      <td style="width:60px!important;">
                        <input type="tel" class="form-control"
                        onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                      </td>
                      <td class="text-left">
                        <span class="mt-1 text-left">単価</span>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="custom-control custom-checkbox custom-control-inline">
                          <input type="checkbox" id="th8" class="custom-control-input customCheckBox">
                          <label class="custom-control-label margin_btn_17" for="th8"></label>
                        </div>
                      </td>
                      <td style="width:60px!important;">
                        <input type="tel" class="form-control"
                        onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                      </td>
                      <td class="text-left">
                        <span class="mt-1 text-left">金額</span>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="custom-control custom-checkbox custom-control-inline">
                          <input type="checkbox" id="th9" class="custom-control-input customCheckBox">
                          <label class="custom-control-label margin_btn_17" for="th9"></label>
                        </div>
                      </td>
                      <td style="width:60px!important;">
                        <input type="tel" class="form-control"
                        onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                      </td>
                      <td class="text-left">
                        <span class="mt-1 text-left">発注番号行番号</span>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="custom-control custom-checkbox custom-control-inline">
                          <input type="checkbox" id="th9" class="custom-control-input customCheckBox">
                          <label class="custom-control-label margin_btn_17" for="th9"></label>
                        </div>
                      </td>
                      <td style="width:60px!important;">
                        <input type="tel" class="form-control"
                        onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                      </td>
                      <td class="text-left">
                        <span class="mt-1 text-left">発注金額分類</span>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-info" data-dismiss="modal"><i class="fas fa-save"
          style="margin-right: 5px;"></i>保存 </button>
        </div>
      </div>
    </div>
  </div>