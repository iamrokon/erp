<form id="tableSetting" action="{{ route('nameMasterTableSetting',$bango) }}" method="post">
  @csrf
  <input type="hidden" name="redirect_path" value="nameMasterReload">
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
            <div class="col-lg-4">
            </div>
            <div class="col-lg-4">
              <a class="btn btn-info " style="margin-bottom: 10px;float: right;">デフォルト</a>
            </div>
          </div>
          <div id="errorShow">
          </div>
          <div id="input_boxwrap_nSett" class="input_boxwrap_nSett" data-bind="nextFieldOnEnter:true">
            <div class="row">
              <div class="col-lg-12">
                <div class="table-responsive setting_header">
                  <table class="table table-striped  table-bordered">
                    <tbody class="">
                      <tr>
                        <td>
                          <div class="custom-control custom-checkbox custom-control-inline">
                            <input type="checkbox" id="th1" class="custom-control-input" name="check_category1" checked
                              disabled>
                            <label class="custom-control-label margin_btn_17" for="th1"></label>
                          </div>
                        </td>
                        <td style="width:60px!important;">
                          <input type="text" name="category1" id="setting_category1" class="form-control text-right"
                            maxlength="2" value="0" readonly="readonly" autocomplete="off" autocomplete="off"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                        </td>
                        <td class="text-left">
                          <span class="mt-1 text-left">名称CD</span>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <div class="custom-control custom-checkbox custom-control-inline">
                            <input type="checkbox" id="th2" class="custom-control-input customCheckBox"
                              name="check_category2">
                            <label class="custom-control-label margin_btn_17" for="th2"></label>
                          </div>
                        </td>
                        <td style="width:60px!important;">
                          <input type="text" name="category2" id="setting_category2" class="form-control text-right"
                            maxlength="2" value="0" readonly="readonly" autocomplete="off" autocomplete="off"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                        </td>
                        <td class="text-left">
                          <span class="mt-1 text-left">分類CD</span>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <div class="custom-control custom-checkbox custom-control-inline">
                            <input type="checkbox" id="th3" class="custom-control-input customCheckBox"
                              name="check_category3">
                            <label class="custom-control-label margin_btn_17" for="th3"></label>
                          </div>
                        </td>
                        <td style="width:60px!important;">
                          <input type="text" name="category3" id="setting_category3" class="form-control text-right"
                            maxlength="2" value="0" readonly="readonly" autocomplete="off" autocomplete="off"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                        </td>
                        <td class="text-left">
                          <span class="mt-1 text-left">名称名</span>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <div class="custom-control custom-checkbox custom-control-inline">
                            <input type="checkbox" id="th4" class="custom-control-input customCheckBox"
                              name="check_category4">
                            <label class="custom-control-label margin_btn_17" for="th4"></label>
                          </div>
                        </td>
                        <td style="width:60px!important;">
                          <input type="text" name="category4" id="setting_category4" class="form-control text-right"
                            maxlength="2" value="0" readonly="readonly" autocomplete="off" autocomplete="off"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                        </td>
                        <td class="text-left">
                          <span class="mt-1 text-left">分類名</span>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <div class="custom-control custom-checkbox custom-control-inline">
                            <input type="checkbox" id="th5" class="custom-control-input customCheckBox"
                              name="check_category5">
                            <label class="custom-control-label margin_btn_17" for="th5"></label>
                          </div>
                        </td>
                        <td style="width:60px!important;">
                          <input type="text" name="category5" id="setting_category5" class="form-control text-right"
                            maxlength="2" value="0" readonly="readonly" autocomplete="off" autocomplete="off"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                        </td>
                        <td class="text-left">
                          <span class="mt-1 text-left">名称名略称</span>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <div class="custom-control custom-checkbox custom-control-inline">
                            <input type="checkbox" id="th6" class="custom-control-input customCheckBox"
                              name="check_groupbango">
                            <label class="custom-control-label margin_btn_17" for="th6"></label>
                          </div>
                        </td>
                        <td style="width:60px!important;">
                          <input type="text" name="groupbango" id="setting_groupbango" class="form-control text-right"
                            maxlength="2" value="0" readonly="readonly" autocomplete="off" autocomplete="off"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                        </td>
                        <td class="text-left">
                          <span class="mt-1 text-left">分類名略称</span>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <div class="custom-control custom-checkbox custom-control-inline">
                            <input type="checkbox" id="th7" class="custom-control-input customCheckBox"
                              name="check_osusume">
                            <label class="custom-control-label margin_btn_17" for="th7"></label>
                          </div>
                        </td>
                        <td style="width:60px!important;">
                          <input type="text" name="osusume" id="setting_osusume" class="form-control text-right"
                            maxlength="2" value="0" readonly="readonly" autocomplete="off" autocomplete="off"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                        </td>
                        <td class="text-left">
                          <span class="mt-1 text-left">分類CD桁数</span>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <div class="custom-control custom-checkbox custom-control-inline">
                            <input type="checkbox" id="th8" class="custom-control-input customCheckBox"
                              name="check_suchi1">
                            <label class="custom-control-label margin_btn_17" for="th8"></label>
                          </div>
                        </td>
                        <td style="width:60px!important;">
                          <input type="text" name="suchi1" id="setting_suchi1" class="form-control text-right"
                            maxlength="2" value="0" readonly="readonly" autocomplete="off" autocomplete="off"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                        </td>
                        <td class="text-left">
                          <span class="mt-1 text-left">表示順</span>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <div class="custom-control custom-checkbox custom-control-inline">
                            <input type="checkbox" id="th9" class="custom-control-input customCheckBox"
                              name="check_created_date">
                            <label class="custom-control-label margin_btn_17" for="th9"></label>
                          </div>
                        </td>
                        <td style="width:60px!important;">
                          <input type="text" name="created_date" id="setting_created_date"
                            class="form-control text-right" maxlength="2" value="0" readonly="readonly"
                            autocomplete="off" autocomplete="off"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                        </td>
                        <td class="text-left">
                          <span class="mt-1 text-left">登録年月日</span>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <div class="custom-control custom-checkbox custom-control-inline">
                            <input type="checkbox" id="th10" class="custom-control-input customCheckBox"
                              name="check_created_time">
                            <label class="custom-control-label margin_btn_17" for="th10"></label>
                          </div>
                        </td>
                        <td style="width:60px!important;">
                          <input type="text" name="created_time" id="setting_created_time"
                            class="form-control text-right" maxlength="2" value="0" readonly="readonly"
                            autocomplete="off" autocomplete="off"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                        </td>
                        <td class="text-left">
                          <span class="mt-1 text-left">登録時刻</span>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <div class="custom-control custom-checkbox custom-control-inline">
                            <input type="checkbox" id="th11" class="custom-control-input customCheckBox"
                              name="check_edited_date">
                            <label class="custom-control-label margin_btn_17" for="th11"></label>
                          </div>
                        </td>
                        <td style="width:60px!important;">
                          <input type="text" name="edited_date" id="setting_edited_date" class="form-control text-right"
                            maxlength="2" value="0" readonly="readonly" autocomplete="off" autocomplete="off"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                        </td>
                        <td class="text-left">
                          <span class="mt-1 text-left">更新年月日</span>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <div class="custom-control custom-checkbox custom-control-inline">
                            <input type="checkbox" id="th12" class="custom-control-input customCheckBox"
                              name="check_edited_time">
                            <label class="custom-control-label margin_btn_17" for="th12"></label>
                          </div>
                        </td>
                        <td style="width:60px!important;">
                          <input type="text" name="edited_time" id="setting_edited_time" class="form-control text-right"
                            maxlength="2" value="0" readonly="readonly" autocomplete="off" autocomplete="off"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                        </td>
                        <td class="text-left">
                          <span class="mt-1 text-left">更新時刻</span>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <div class="custom-control custom-checkbox custom-control-inline">
                            <input type="checkbox" id="th13" class="custom-control-input customCheckBox"
                              name="check_image3">
                            <label class="custom-control-label margin_btn_17" for="th13"></label>
                          </div>
                        </td>
                        <td style="width:60px!important;">
                          <input type="text" name="image3" id="setting_image3" class="form-control text-right"
                            maxlength="2" value="0" readonly="readonly" autocomplete="off" autocomplete="off"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                        </td>
                        <td class="text-left">
                          <span class="mt-1 text-left">更新時端末IP</span>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <div class="custom-control custom-checkbox custom-control-inline">
                            <input type="checkbox" id="th14" class="custom-control-input customCheckBox"
                              name="check_user_name">
                            <label class="custom-control-label margin_btn_17" for="th14"></label>
                          </div>
                        </td>
                        <td style="width:60px!important;">
                          <input type="text" name="user_name" id="setting_user_name" class="form-control text-right"
                            maxlength="2" value="0" readonly="readonly" autocomplete="off" autocomplete="off"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
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
          <button type="button" class="btn btn-info" id="tableSettingSubmit"><i class="fas fa-save"
              style="margin-right: 5px;"></i>保存 </button>
        </div>
      </div>
    </div>
  </div>
</form>

<script src="https://ajax.aspnetcdn.com/ajax/knockout/knockout-2.2.1.js" type="text/javascript"></script>
<script type="text/javascript">
  function lastTab1_name(event) {
        if (event.keyCode == 13) {
            document.getElementById("check_category2").focus();
            event.preventDefault();
        }
    }
    
    
</script>
<script>
  $("textarea").keydown(function (event) {
        if (event.keyCode == 13 && !e.shiftKey) {
            event.preventDefault();
    
        }
    });
</script>