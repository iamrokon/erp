<div class="modal" data-keyboard="false" data-backdrop="static" id="setting_display_modal" role="dialog"
  aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 800px;">
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
        <div id="input_boxwrap_sett1" class="input_boxwrap_p1" data-bind="nextFieldOnEnter:true">
          <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6">
              <div class="table-responsive setting_header">
                <table class="table table-striped  table-bordered">
                  <tbody class="">
                    <tr>
                      <td>
                        <div class="custom-control custom-checkbox custom-control-inline">
                          <input type="checkbox" id="th1" class="custom-control-input " checked="" dislabed>
                          <label class="custom-control-label margin_btn_17" for="th1"></label>
                        </div>
                      </td>
                      <td style="width:60px!important;">
                        <input type="text" class="form-control" value="0" readonly
                          onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                      </td>
                      <td class="text-left">
                        <span class="mt-1 text-left">サブ区分</span>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="custom-control custom-checkbox custom-control-inline">
                          <input type="checkbox" id="th31" class="custom-control-input customCheckBox">
                          <label class="custom-control-label margin_btn_17" for="th31"></label>
                        </div>
                      </td>
                      <td style="width:60px!important;">
                        <input type="tel" class="form-control" value=""
                          onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))"
                          autofocus>
                      </td>
                      <td class="text-left">
                        <span class="mt-1 text-left">取引先</span>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="custom-control custom-checkbox custom-control-inline">
                          <input type="checkbox" id="th32" class="custom-control-input customCheckBox">
                          <label class="custom-control-label margin_btn_17" for="th32"></label>
                        </div>
                      </td>
                      <td style="width:60px!important;">
                        <input type="tel" class="form-control" value=""
                          onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                      </td>
                      <td class="text-left">
                        <span class="mt-1 text-left">データ種</span>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="custom-control custom-checkbox custom-control-inline">
                          <input type="checkbox" id="th33" class="custom-control-input customCheckBox">
                          <label class="custom-control-label margin_btn_17" for="th33"></label>
                        </div>
                      </td>
                      <td style="width:60px!important;">
                        <input type="tel" class="form-control" value=""
                          onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))"
                          onkeydown="firstTab(event);">
                      </td>
                      <td class="text-left">
                        <span class="mt-1 text-left">バージョン区分</span>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="custom-control custom-checkbox custom-control-inline">
                          <input type="checkbox" id="th2" class="custom-control-input customCheckBox">
                          <label class="custom-control-label margin_btn_17" for="th2"></label>
                        </div>
                      </td>
                      <td style="width:60px!important;">
                        <input type="tel" class="form-control" value=""
                          onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                      </td>
                      <td class="text-left">
                        <span class="mt-1 text-left">商品サブCD</span>
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
                        <span class="mt-1 text-left">商品サブ名称</span>

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
                        <span class="mt-1 text-left">商品サブ名称カナ名</span>
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
                        <span class="mt-1 text-left">商品サブ分類１</span>
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
                        <span class="mt-1 text-left">商品サブ分類２</span>
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
                        <span class="mt-1 text-left">商品サブ分類３</span>
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
                        <span class="mt-1 text-left">作成事業部</span>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="custom-control custom-checkbox custom-control-inline">
                          <input type="checkbox" id="th10" class="custom-control-input customCheckBox">
                          <label class="custom-control-label margin_btn_17" for="th10"></label>
                        </div>
                      </td>
                      <td style="width:60px!important;">
                        <input type="tel" class="form-control"
                          onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                      </td>
                      <td class="text-left">
                        <span class="mt-1 text-left">作成部</span>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="custom-control custom-checkbox custom-control-inline">
                          <input type="checkbox" id="th11" class="custom-control-input customCheckBox">
                          <label class="custom-control-label margin_btn_17" for="th11"></label>
                        </div>
                      </td>
                      <td style="width:60px!important;">
                        <input type="tel" class="form-control"
                          onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                      </td>
                      <td class="text-left">
                        <span class="mt-1 text-left">作成グループ</span>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="custom-control custom-checkbox custom-control-inline">
                          <input type="checkbox" id="th12" class="custom-control-input customCheckBox">
                          <label class="custom-control-label margin_btn_17" for="th12"></label>
                        </div>
                      </td>
                      <td style="width:60px!important;">
                        <input type="tel" class="form-control"
                          onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                      </td>
                      <td class="text-left">
                        <span class="mt-1 text-left">作成者</span>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="custom-control custom-checkbox custom-control-inline">
                          <input type="checkbox" id="th13" class="custom-control-input customCheckBox">
                          <label class="custom-control-label margin_btn_17" for="th13"></label>
                        </div>
                      </td>
                      <td style="width:60px!important;">
                        <input type="tel" class="form-control"
                          onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                      </td>
                      <td class="text-left">
                        <span class="mt-1 text-left">データ区分</span>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="custom-control custom-checkbox custom-control-inline">
                          <input type="checkbox" id="th14" class="custom-control-input customCheckBox">
                          <label class="custom-control-label margin_btn_17" for="th14"></label>
                        </div>
                      </td>
                      <td style="width:60px!important;">
                        <input type="tel" class="form-control"
                          onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                      </td>
                      <td class="text-left">
                        <span class="mt-1 text-left">作成ステータス</span>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="custom-control custom-checkbox custom-control-inline">
                          <input type="checkbox" id="th15" class="custom-control-input customCheckBox">
                          <label class="custom-control-label margin_btn_17" for="th15"></label>
                        </div>
                      </td>
                      <td style="width:60px!important;">
                        <input type="tel" class="form-control"
                          onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                      </td>
                      <td class="text-left">
                        <span class="mt-1 text-left">上市開始日</span>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="custom-control custom-checkbox custom-control-inline">
                          <input type="checkbox" id="th16" class="custom-control-input customCheckBox">
                          <label class="custom-control-label margin_btn_17" for="th16"></label>
                        </div>
                      </td>
                      <td style="width:60px!important;">
                        <input type="tel" class="form-control"
                          onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                      </td>
                      <td class="text-left">
                        <span class="mt-1 text-left">終売日</span>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="custom-control custom-checkbox custom-control-inline">
                          <input type="checkbox" id="th17" class="custom-control-input customCheckBox">
                          <label class="custom-control-label margin_btn_17" for="th17"></label>
                        </div>
                      </td>
                      <td style="width:60px!important;">
                        <input type="tel" class="form-control"
                          onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                      </td>
                      <td class="text-left">
                        <span class="mt-1 text-left">入力区分</span>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="custom-control custom-checkbox custom-control-inline">
                          <input type="checkbox" id="th18" class="custom-control-input customCheckBox">
                          <label class="custom-control-label margin_btn_17" for="th18"></label>
                        </div>
                      </td>
                      <td style="width:60px!important;">
                        <input type="tel" class="form-control"
                          onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                      </td>
                      <td class="text-left">
                        <span class="mt-1 text-left">サブCD桁数</span>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="custom-control custom-checkbox custom-control-inline">
                          <input type="checkbox" id="th20" class="custom-control-input customCheckBox">
                          <label class="custom-control-label margin_btn_17" for="th20"></label>
                        </div>
                      </td>
                      <td style="width:60px!important;">
                        <input type="tel" class="form-control"
                          onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                      </td>
                      <td class="text-left">
                        <span class="mt-1 text-left">対応バージョン</span>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6">
              <div class="table-responsive setting_header">
                <table class="table table-striped  table-bordered">
                  <tbody class="">
                    <tr>
                      <td>
                        <div class="custom-control custom-checkbox custom-control-inline">
                          <input type="checkbox" id="th22" class="custom-control-input customCheckBox">
                          <label class="custom-control-label margin_btn_17" for="th22"></label>
                        </div>
                      </td>
                      <td style="width:60px!important;">
                        <input type="tel" class="form-control"
                          onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                      </td>
                      <td class="text-left">
                        <span class="mt-1 text-left">小売業略称</span>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="custom-control custom-checkbox custom-control-inline">
                          <input type="checkbox" id="th23" class="custom-control-input customCheckBox">
                          <label class="custom-control-label margin_btn_17" for="th23"></label>
                        </div>
                      </td>
                      <td style="width:60px!important;">
                        <input type="tel" class="form-control"
                          onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                      </td>
                      <td class="text-left">
                        <span class="mt-1 text-left">小売業部門</span>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="custom-control custom-checkbox custom-control-inline">
                          <input type="checkbox" id="th24" class="custom-control-input customCheckBox">
                          <label class="custom-control-label margin_btn_17" for="th24"></label>
                        </div>
                      </td>
                      <td style="width:60px!important;">
                        <input type="tel" class="form-control"
                          onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                      </td>
                      <td class="text-left">
                        <span class="mt-1 text-left">小売業メッセージ種</span>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="custom-control custom-checkbox custom-control-inline">
                          <input type="checkbox" id="th25" class="custom-control-input customCheckBox">
                          <label class="custom-control-label margin_btn_17" for="th25"></label>
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
                          <input type="checkbox" id="th26" class="custom-control-input customCheckBox">
                          <label class="custom-control-label margin_btn_17" for="th26"></label>
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
                          <input type="checkbox" id="th27" class="custom-control-input customCheckBox">
                          <label class="custom-control-label margin_btn_17" for="th27"></label>
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
                          <input type="checkbox" id="th28" class="custom-control-input customCheckBox">
                          <label class="custom-control-label margin_btn_17" for="th28"></label>
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
                          <input type="checkbox" id="th29" class="custom-control-input customCheckBox">
                          <label class="custom-control-label margin_btn_17" for="th29"></label>
                        </div>
                      </td>
                      <td style="width:60px!important;">
                        <input type="tel" class="form-control" value="0"
                          onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                      </td>
                      <td class="text-left">
                        <span class="mt-1 text-left">更新時端末IP</span>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="custom-control custom-checkbox custom-control-inline">
                          <input type="checkbox" id="th30" class="custom-control-input customCheckBox">
                          <label class="custom-control-label margin_btn_17" for="th30"></label>
                        </div>
                      </td>
                      <td style="width:60px!important;">
                        <input type="tel" class="form-control" value="1"
                          onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
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
        <button type="button" class="btn btn-info" data-dismiss="modal">
          <i class="fas fa-save" style="margin-right: 5px;"></i>保存 
        </button>
      </div>
    </div>
  </div>
</div>