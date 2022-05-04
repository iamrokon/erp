<!-- ============================new moda1 end here ======================= -->
  <div class="modal custom-modal" data-keyboard="false" data-backdrop="static" id="setting_display_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-bind="nextFieldOnEnter:true">
    <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 575px !important;">
      <div class="modal-content">
        <div class="modal-header">
          <h6 class="modal-title" id="exampleModalLabel"></h6>
          <span type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
          </span>
        </div>
        <div class="modal-body pb-0">
          <div class="row">
            <div class="col-lg-4">
              <!--     <a href="#" class="btn btn-info " onclick="table3SelectAll()" id=""style="background-color:#4D82C6
                !important;margin-top: 2px;margin-bottom: 20px;" data-toggle="modal" data-target="#">全選択</a>  -->
              <button class="checkall btn btn-info" autofocus="" style="margin-bottom: 10px;background: #4D82C6 !important;border: 1px solid #4D82C6 !important;">全選択</button>
              <button class="uncheck btn btn-info" style="margin-bottom: 10px;background: #4D82C6 !important;border: 1px solid #4D82C6 !important;">全解除</button>
            </div>
            <div class="col-lg-4">
            </div>
            <div class="col-lg-4">
              <button class="btn btn-info " style="margin-bottom: 10px;float: right;background: #4D82C6 !important;border: 1px solid #4D82C6 !important;">デフォルト</button>
            </div>
          </div>
          <!-- Check uncheck for table settings -->
          <script type="text/javascript">
            var state = false; // desecelted
            
            $('.checkall').click(function() {
              $('.customCheckBox').each(function() {
                if (!state) {
                  this.checked = true;
                }
              });
            });
            
            //Unchecked....
            $('.uncheck').click(function() {
              $('.customCheckBox').each(function() {
                if (!state) {
                  this.checked = false;
                  $("input[type='tel']").val("");
                }
              });
            });
          </script>
          <div class="row mt-3">
            <div class="col-lg-6">
              <div class="table-responsive setting_header">
                <table class="table modal-table-blue table-striped  table-bordered">
                  <tbody class="">
                    <tr>
                      <td class="line-title">
                        <div class="custom-control custom-checkbox custom-control-inline">
                          <input type="checkbox" id="th1" class="custom-control-input customCheckBox" checked="">
                          <label class="custom-control-label margin_btn_17" for="th1"></label>
                        </div>
                      </td>
                      <td class="line-title" style="width:60px!important;">
                        <input type="tel" class="form-control" value="0"
                          onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                      </td>
                      <td class="line-title text-left">
                        <span class="mt-1 text-left text-white">プロジェクト番号</span>
                      </td>
                    </tr>
                    <tr>
                      <td class="line-title">
                        <div class="custom-control custom-checkbox custom-control-inline">
                          <input type="checkbox" id="th2" class="custom-control-input customCheckBox">
                          <label class="custom-control-label margin_btn_17" for="th2"></label>
                        </div>
                      </td>
                      <td class="line-title" style="width:60px!important;">
                        <input type="tel" class="form-control" value="1"
                          onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                      </td>
                      <td class="line-title text-left">
                        <span class="mt-1 text-left text-white">プロジェクト名称 </span>
                      </td>
                    </tr>
                    <tr>
                      <td class="line-title">
                        <div class="custom-control custom-checkbox custom-control-inline">
                          <input type="checkbox" id="th3" class="custom-control-input customCheckBox">
                          <label class="custom-control-label margin_btn_17" for="th3"></label>
                        </div>
                      </td>
                      <td class="line-title" style="width:60px!important;">
                        <input type="tel" class="form-control" value="2"
                          onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                      </td>
                      <td class="line-title text-left">
                        <span class="mt-1 text-left text-white">受注先 </span>
                      </td>
                    </tr>
                    <tr>
                      <td class="line-title">
                        <div class="custom-control custom-checkbox custom-control-inline">
                          <input type="checkbox" id="th4" class="custom-control-input customCheckBox">
                          <label class="custom-control-label margin_btn_17" for="th4"></label>
                        </div>
                      </td>
                      <td class="line-title" style="width:60px!important;">
                        <input type="tel" class="form-control"
                          onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                      </td>
                      <td class="line-title text-left">
                        <span class="mt-1 text-left text-white">最終顧客</span>
                      </td>
                    </tr>
                    <tr>
                      <td class="line-title">
                        <div class="custom-control custom-checkbox custom-control-inline">
                          <input type="checkbox" id="th5" class="custom-control-input customCheckBox">
                          <label class="custom-control-label margin_btn_17" for="th5"></label>
                        </div>
                      </td>
                      <td class="line-title" style="width:60px!important;">
                        <input type="tel" class="form-control"
                          onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                      </td>
                      <td class="line-title text-left">
                        <span class="mt-1 text-left text-white">営業</span>
                      </td>
                    </tr>
                    <tr>
                      <td class="line-title">
                        <div class="custom-control custom-checkbox custom-control-inline">
                          <input type="checkbox" id="th6" class="custom-control-input customCheckBox">
                          <label class="custom-control-label margin_btn_17" for="th6"></label>
                        </div>
                      </td>
                      <td class="line-title" style="width:60px!important;">
                        <input type="tel" class="form-control"
                          onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                      </td>
                      <td class="line-title text-left">
                        <span class="mt-1 text-left text-white">SE</span>
                      </td>
                    </tr>
                    <tr>
                      <td class="line-title">
                        <div class="custom-control custom-checkbox custom-control-inline">
                          <input type="checkbox" id="th7" class="custom-control-input customCheckBox">
                          <label class="custom-control-label margin_btn_17" for="th7"></label>
                        </div>
                      </td>
                      <td class="line-title" style="width:60px!important;">
                        <input type="tel" class="form-control"
                          onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                      </td>
                      <td class="line-title text-left">
                        <span class="mt-1 text-left text-white">開始年月</span>
                      </td>
                    </tr>
                    <tr>
                      <td class="line-title">
                        <div class="custom-control custom-checkbox custom-control-inline">
                          <input type="checkbox" id="th8" class="custom-control-input customCheckBox">
                          <label class="custom-control-label margin_btn_17" for="th8"></label>
                        </div>
                      </td>
                      <td class="line-title" style="width:60px!important;">
                        <input type="tel" class="form-control"
                          onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                      </td>
                      <td class="line-title text-left">
                        <span class="mt-1 text-left text-white">終了年月</span>
                      </td>
                    </tr>
                    <tr>
                      <td class="line-title">
                        <div class="custom-control custom-checkbox custom-control-inline">
                          <input type="checkbox" id="th8" class="custom-control-input customCheckBox">
                          <label class="custom-control-label margin_btn_17" for="th8"></label>
                        </div>
                      </td>
                      <td class="line-title" style="width:60px!important;">
                        <input type="tel" class="form-control"
                          onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                      </td>
                      <td class="line-title text-left">
                        <span class="mt-1 text-left text-white">備考</span>
                      </td>
                    </tr>
                    <tr>
                      <td class="line-title">
                        <div class="custom-control custom-checkbox custom-control-inline">
                          <input type="checkbox" id="th8" class="custom-control-input customCheckBox">
                          <label class="custom-control-label margin_btn_17" for="th8"></label>
                        </div>
                      </td>
                      <td class="line-title" style="width:60px!important;">
                        <input type="tel" class="form-control"
                          onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                      </td>
                      <td class="line-title text-left">
                        <span class="mt-1 text-left text-white">登録年月日</span>
                      </td>
                    </tr>
                    <tr>
                      <td class="line-title">
                        <div class="custom-control custom-checkbox custom-control-inline">
                          <input type="checkbox" id="th8" class="custom-control-input customCheckBox">
                          <label class="custom-control-label margin_btn_17" for="th8"></label>
                        </div>
                      </td>
                      <td class="line-title" style="width:60px!important;">
                        <input type="tel" class="form-control"
                          onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                      </td>
                      <td class="line-title text-left">
                        <span class="mt-1 text-left text-white">登録時刻</span>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="table-responsive setting_header">
                <table class="table modal-table-blue table-striped  table-bordered">
                  <tbody class="">
                    <tr>
                      <td class="line-title">
                        <div class="custom-control custom-checkbox custom-control-inline">
                          <input type="checkbox" id="th1" class="custom-control-input customCheckBox" checked="">
                          <label class="custom-control-label margin_btn_17" for="th1"></label>
                        </div>
                      </td>
                      <td class="line-title" style="width:60px!important;">
                        <input type="tel" class="form-control" value="0"
                          onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                      </td>
                      <td class="line-title text-left">
                        <span class="mt-1 text-left text-white">更新年月日</span>
                      </td>
                    </tr>
                    <tr>
                      <td class="line-title">
                        <div class="custom-control custom-checkbox custom-control-inline">
                          <input type="checkbox" id="th2" class="custom-control-input customCheckBox">
                          <label class="custom-control-label margin_btn_17" for="th2"></label>
                        </div>
                      </td>
                      <td class="line-title" style="width:60px!important;">
                        <input type="tel" class="form-control" value="1"
                          onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                      </td>
                      <td class="line-title text-left">
                        <span class="mt-1 text-left text-white">更新時刻 </span>
                      </td>
                    </tr>
                    <tr>
                      <td class="line-title">
                        <div class="custom-control custom-checkbox custom-control-inline">
                          <input type="checkbox" id="th3" class="custom-control-input customCheckBox">
                          <label class="custom-control-label margin_btn_17" for="th3"></label>
                        </div>
                      </td>
                      <td class="line-title" style="width:60px!important;">
                        <input type="tel" class="form-control" value="2"
                          onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                      </td>
                      <td class="line-title text-left">
                        <span class="mt-1 text-left text-white">更新時端末IP </span>
                      </td>
                    </tr>
                    <tr>
                      <td class="line-title">
                        <div class="custom-control custom-checkbox custom-control-inline">
                          <input type="checkbox" id="th4" class="custom-control-input customCheckBox">
                          <label class="custom-control-label margin_btn_17" for="th4"></label>
                        </div>
                      </td>
                      <td class="line-title" style="width:60px!important;">
                        <input type="tel" class="form-control"
                          onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                      </td>
                      <td class="line-title text-left">
                        <span class="mt-1 text-left text-white">更新者</span>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-info" data-dismiss="modal" style="border: 1px solid #4D82C6 !important;background: #4D82C6 !important;"><i class="fas fa-save"
            style="margin-right: 5px;"></i>保存 </button>
        </div>
      </div>
    </div>
  </div>