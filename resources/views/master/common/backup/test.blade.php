<div class="modal" data-keyboard="false" data-backdrop="static" id="setting_display_modal" role="dialog"
  aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document" style="">
    <div class="modal-content">
      <div class="modal-header">
        <h6 class="modal-title" id="exampleModalLabel"></h6>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-lg-4">
            <a class="checkall btn btn-info " style="margin-bottom: 10px;">全選択</a>
            <a class="uncheck btn btn-info" style="margin-bottom: 10px;">全解除</a>
          </div>
          <div class="col-lg-4"></div>
          <div class="col-lg-4">
            <a class="btn btn-info " style="margin-bottom: 10px;float: right;">デフォルト</a>
          </div>
        </div>

        <div id="input_boxwrap_seqsett" class="input_boxwrap_seqsett" data-bind="nextFieldOnEnter:true">
          <div class="row">
            <div class="col-lg-12">
              <div class="table-responsive setting_header">
                <table class="table table-striped  table-bordered">
                  <tbody class="">
                    <tr>
                      <td>
                        <div class="custom-control custom-checkbox custom-control-inline">
                          <input type="checkbox" id="th1" class="custom-control-input " checked="" disabled>
                          <label class="custom-control-label margin_btn_17" for="th1"></label>

                        </div>
                      </td>
                      <td style="width:60px!important;">
                        <input type="text" class="form-control" value="0" readonly
                          onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                      </td>
                      <td class="text-left">
                        <span class="mt-1 text-left">番号区分</span>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="custom-control custom-checkbox custom-control-inline">
                          <input type="checkbox" id="numchk" class="custom-control-input customCheckBox">
                          <label class="custom-control-label margin_btn_17" for="numchk"></label>
                        </div>
                      </td>
                      <td style="width:60px!important;">
                        <input type="tel" class="form-control" value="" autofocus
                          onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                      </td>
                      <td class="text-left">
                        <span class="mt-1 text-left">番号</span>
                      </td>
                    </tr>

                    <tr>
                      <td>
                        <div class="custom-control custom-checkbox custom-control-inline">
                          <input type="checkbox" id="th3" class="custom-control-input customCheckBox">
                          <label class="custom-control-label margin_btn_17" for="th3"></label>
                        </div>
                      </td>
                      <td style="width:60px!important;">
                        <input type="tel" class="form-control" value=""
                          onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                      </td>
                      <td class="text-left">
                        <span class="mt-1 text-left">番号総桁数</span>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="custom-control custom-checkbox custom-control-inline">
                          <input type="checkbox" id="th4" class="custom-control-input customCheckBox">
                          <label class="custom-control-label margin_btn_17" for="th4"></label>
                        </div>
                      </td>
                      <td style="width:60px!important;">
                        <input type="tel" class="form-control"
                          onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                      </td>
                      <td class="text-left">
                        <span class="mt-1 text-left">登録年月日</span>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="custom-control custom-checkbox custom-control-inline">
                          <input type="checkbox" id="th5" class="custom-control-input customCheckBox">
                          <label class="custom-control-label margin_btn_17" for="th5"></label>
                        </div>
                      </td>
                      <td style="width:60px!important;">
                        <input type="tel" class="form-control"
                          onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                      </td>
                      <td class="text-left">
                        <span class="mt-1 text-left">登録時刻</span>
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
                        <span class="mt-1 text-left">更新年月日</span>
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
                        <span class="mt-1 text-left">更新時刻</span>
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
                        <span class="mt-1 text-left">更新時端末IP</span>
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
                          onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))"
                          onkeydown="firstTab(event);">
                      </td>
                      <td class="text-left">
                        <span class="mt-1 text-left">更新者</span>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
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