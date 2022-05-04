{{-- Setting Display Modal Starts Here --}}
<div class="modal custom-modal" data-keyboard="false" data-backdrop="static" id="setting_display_modal" role="dialog" 
  aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-bind="nextFieldOnEnter:true">
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
            <!--     <a href="#" class="btn btn-info " onclick="table3SelectAll()" id=""style="background-color:#3e6ec1!important;margin-top: 2px;margin-bottom: 20px;" data-toggle="modal" data-target="#">全選択</a>  -->
            <button class="checkall btn btn-info " autofocus="" style="margin-bottom: 10px;">全選択</button>
            <button class="uncheck btn btn-info" style="margin-bottom: 10px;">全解除</button>
          </div>
          <div class="col-lg-4">
          </div>
          <div class="col-lg-4">
            <button class="btn btn-info " style="margin-bottom: 10px;float: right;">デフォルト</button>
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
        <div class="row">
          <div class="col-lg-6">
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
                      <span class="mt-1 text-left">受注区分</span>
                    </td>
                  </tr>

                  <tr>
                    <td>
                      <div class="custom-control custom-checkbox custom-control-inline">
                        <input type="checkbox" id="th19" class="custom-control-input customCheckBox" checked="">
                        <label class="custom-control-label margin_btn_17" for="th19"></label>
                      </div>
                    </td>
                    <td style="width:60px!important;">
                      <input type="tel" class="form-control" value="1"
                        onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                    </td>
                    <td class="text-left">
                      <span class="mt-1 text-left">作成区分</span>
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
                      <span class="mt-1 text-left"> 担　当</span>
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
                      <span class="mt-1 text-left">受注番号</span>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <div class="custom-control custom-checkbox custom-control-inline">
                        <input type="checkbox" id="th18" class="custom-control-input customCheckBox" checked="">
                        <label class="custom-control-label margin_btn_17" for="th18"></label>
                      </div>
                    </td>
                    <td style="width:60px!important;">
                      <input type="tel" class="form-control" value="2"
                        onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                    </td>
                    <td class="text-left">
                      <span class="mt-1 text-left">訂正回数</span>
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
                      <span class="mt-1 text-left">受注件名</span>
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
                      <span class="mt-1 text-left">受注先</span>
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
                      <span class="mt-1 text-left">売上請求先</span>
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
                      <span class="mt-1 text-left">最終顧客</span>
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
                      <span class="mt-1 text-left">売上請求担当者</span>
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
                      <span class="mt-1 text-left">受注金額</span>
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
                      <span class="mt-1 text-left">粗利</span>
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
                      <span class="mt-1 text-left">受注日</span>
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
                      <span class="mt-1 text-left">売上日</span>
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
                      <span class="mt-1 text-left">入金日</span>
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
                      <span class="mt-1 text-left">[最終顧客]ﾃﾞｰﾀｿｰｽ</span>
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
                      <span class="mt-1 text-left">[最終顧客]ﾕｰｻﾞｰ</span>
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
                      <span class="mt-1 text-left">[最終顧客]取引開始日</span>
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
                      <span class="mt-1 text-left">[受注先]取引開始日</span>
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
                      <span class="mt-1 text-left">プロジェクト番号</span>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <div class="custom-control custom-checkbox custom-control-inline">
                        <input type="checkbox" id="th21" class="custom-control-input customCheckBox">
                        <label class="custom-control-label margin_btn_17" for="th21"></label>
                      </div>
                    </td>
                    <td style="width:60px!important;">
                      <input type="tel" class="form-control"
                        onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                    </td>
                    <td class="text-left">
                      <span class="mt-1 text-left">客先注番</span>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
          <div class="col-lg-6">
            <div class="table-responsive setting_header">
              <table class="table table-striped modal-table-blue line-transparent table-bordered">
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
                      <span class="mt-1 text-left">代理店１</span>
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
                      <span class="mt-1 text-left">代理店２</span>
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
                      <span class="mt-1 text-left">請求書送付先</span>
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
                      <span class="mt-1 text-left">入金方法</span>
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
                      <span class="mt-1 text-left">即時区分</span>
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
                      <span class="mt-1 text-left">検収条件</span>
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
                      <span class="mt-1 text-left">注文書書類保管番号</span>
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
                      <input type="tel" class="form-control"
                        onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                    </td>
                    <td class="text-left">
                      <span class="mt-1 text-left">検収確認書書類保管番号</span>
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
                      <input type="tel" class="form-control"
                        onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                    </td>
                    <td class="text-left">
                      <span class="mt-1 text-left">売上指示・検印譜フェーズ</span>
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
                      <input type="tel" class="form-control"
                        onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                    </td>
                    <td class="text-left">
                      <span class="mt-1 text-left">売上指示者</span>
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
                      <input type="tel" class="form-control"
                        onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                    </td>
                    <td class="text-left">
                      <span class="mt-1 text-left">売上検印者</span>
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
                      <input type="tel" class="form-control"
                        onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                    </td>
                    <td class="text-left">
                      <span class="mt-1 text-left">伝票作成フラグ</span>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <div class="custom-control custom-checkbox custom-control-inline">
                        <input type="checkbox" id="th34" class="custom-control-input customCheckBox">
                        <label class="custom-control-label margin_btn_17" for="th34"></label>
                      </div>
                    </td>
                    <td style="width:60px!important;">
                      <input type="tel" class="form-control"
                        onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                    </td>
                    <td class="text-left">
                      <span class="mt-1 text-left">伝票作成者</span>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <div class="custom-control custom-checkbox custom-control-inline">
                        <input type="checkbox" id="th35" class="custom-control-input customCheckBox">
                        <label class="custom-control-label margin_btn_17" for="th35"></label>
                      </div>
                    </td>
                    <td style="width:60px!important;">
                      <input type="tel" class="form-control"
                        onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                    </td>
                    <td class="text-left">
                      <span class="mt-1 text-left">検収書確認フラグ</span>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <div class="custom-control custom-checkbox custom-control-inline">
                        <input type="checkbox" id="th36" class="custom-control-input customCheckBox">
                        <label class="custom-control-label margin_btn_17" for="th36"></label>
                      </div>
                    </td>
                    <td style="width:60px!important;">
                      <input type="tel" class="form-control"
                        onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                    </td>
                    <td class="text-left">
                      <span class="mt-1 text-left">検収書確認者</span>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <div class="custom-control custom-checkbox custom-control-inline">
                        <input type="checkbox" id="th37" class="custom-control-input customCheckBox">
                        <label class="custom-control-label margin_btn_17" for="th37"></label>
                      </div>
                    </td>
                    <td style="width:60px!important;">
                      <input type="tel" class="form-control"
                        onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                    </td>
                    <td class="text-left">
                      <span class="mt-1 text-left">受注実績作成フラグ</span>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <div class="custom-control custom-checkbox custom-control-inline">
                        <input type="checkbox" id="th38" class="custom-control-input customCheckBox">
                        <label class="custom-control-label margin_btn_17" for="th38"></label>
                      </div>
                    </td>
                    <td style="width:60px!important;">
                      <input type="tel" class="form-control"
                        onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                    </td>
                    <td class="text-left">
                      <span class="mt-1 text-left">売上伝票メール送信フラグ</span>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <div class="custom-control custom-checkbox custom-control-inline">
                        <input type="checkbox" id="th39" class="custom-control-input customCheckBox">
                        <label class="custom-control-label margin_btn_17" for="th39"></label>
                      </div>
                    </td>
                    <td style="width:60px!important;">
                      <input type="tel" class="form-control"
                        onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                    </td>
                    <td class="text-left">
                      <span class="mt-1 text-left">売上伝票PDFダウンロードフラグ</span>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <div class="custom-control custom-checkbox custom-control-inline">
                        <input type="checkbox" id="th40" class="custom-control-input customCheckBox">
                        <label class="custom-control-label margin_btn_17" for="th40"></label>
                      </div>
                    </td>
                    <td style="width:60px!important;">
                      <input type="tel" class="form-control"
                        onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                    </td>
                    <td class="text-left">
                      <span class="mt-1 text-left">最終顧客／販売ランク</span>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <div class="custom-control custom-checkbox custom-control-inline">
                        <input type="checkbox" id="th41" class="custom-control-input customCheckBox">
                        <label class="custom-control-label margin_btn_17" for="th41"></label>
                      </div>
                    </td>
                    <td style="width:60px!important;">
                      <input type="tel" class="form-control"
                        onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                    </td>
                    <td class="text-left">
                      <span class="mt-1 text-left">最終顧客／顧客深耕層別化</span>
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
{{-- Setting Display Modal Ends Here --}}

{{-- Search Modal Starts Here --}}
<div class="modal custom-modal" data-backdrop="static" id="search_modal4" role="dialog"
  aria-labelledby="exampleModalCenterTitle" aria-hidden="true" style="padding-right:0px !important;">
  <div class="modal-dialog" role="document" style="max-width: 1330px!important;overflow-x: visible;width: 1330px;">
    <div class="modal-content" data-bind="nextFieldOnEnter:true">

      <div class="modal-header" style="height: 68px;padding: 23px 28px;">
        <h5 class="modal-title">取引先</h5>
        <span class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </span>
      </div>

      <div class="modal-body" style="padding: 0px 29px 0px 30px;">
        <div class="row">
          <div class="col-6 pr-0">
            <div style="height:90px;padding:29px 0px;">
              <table class="table" style="border: none!important;width: auto;margin-bottom:0px !important;">
                <tbody>
                  <tr>
                    <td style="width: 23px!important;padding: 0!important;border:0!important;">
                      <div class="line-box-icon mr-3"></div>
                    </td>
                    <td style=" border: none!important;width: 40px!important;color: #fff;">
                      検索（絞込）</td>
                    <td style=" width: 100%; border: none!important;"><input type="text" autofocus class="form-control"
                        id="lastname" placeholder="検索ワード"
                        style="border-top-left-radius: 4px !important;border-bottom-left-radius: 4px !important;">
                    </td>
                    <td style=" border: none!important;">
                      <button type="button" class="btn text-white btn_search" id="searchButton"
                        style="border-radius: 0px;margin-left: -6px;"><i class="fas fa-search"></i>
                      </button>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
            <script type="text/javascript">
              $(function () {
                  $('.show_office_master_info').click(function (event) {
                    $('.show_office_master_info').not(this).removeClass('add_border');
                    $(this).addClass('add_border');
                    $("#office_master_content_div").show();
                  });
                });
            </script>
          </div>
          <div class="col-6">
            <div
              style="margin-left:15px;background: #aec7e7;font-size: 14px;color: #000;line-height: 27px;padding: 0px 10px;margin-top:32px;">
              Error Message .........
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-6 pr-0">
            <div class="table_wrap">
              <div class=" page4_table_design table_hover  table-head-only">

                <div id="initial_content">
                  <div class="border-line" style="margin-bottom:0px;"></div>
                  <div style="height:77px;padding:29px 0px;">
                    <h4><span class="ml-2">会社マスタ　（会社CD/会社名）</span></h4>
                  </div>
                  <div class="modal-table-white search-scroll"
                    style="height: 225px;width: 100%;cursor: pointer;overflow-y:scroll">
                    <div class="first-table">
                      <table class="table" id="table-basic">
                        <tbody class="">
                          <tr tabindex="0" class=" show_office_master_info table_hover2 grid trfocus"
                            style="height:40px;">
                            <td>999999</td>
                            <td>株式会社サンプル</td>
                          </tr>
                          <tr tabindex="0" class=" show_office_master_info table_hover2 gridAlternada trfocus"
                            style="height:40px;">
                            <td style="width: 50px;">999999</td>
                            <td> 株式会社サンプル </td>
                          </tr>
                          <tr tabindex="0" class=" show_office_master_info table_hover2 grid trfocus"
                            style="height:40px;">
                            <td style="width: 50px;">999999 </td>
                            <td> 株式会社サンプル
                            </td>
                          </tr>
                          <tr tabindex="0" class=" show_office_master_info table_hover2 gridAlternada trfocus "
                            style="height:40px;">

                            <td style="width: 50px;">999999</td>
                            <td>株式会社サンプル
                            </td>

                          </tr>
                          <tr tabindex="0" class=" show_office_master_info table_hover2 gridAlternada trfocus "
                            style="height:40px;">

                            <td style="width: 50px;">999999</td>
                            <td>株式会社サンプル
                            </td>

                          </tr>
                          <tr tabindex="0" class=" show_office_master_info table_hover2 gridAlternada trfocus "
                            style="height:40px;">

                            <td style="width: 50px;">999999</td>
                            <td>株式会社サンプル
                            </td>

                          </tr>
                          <tr tabindex="0" class=" show_office_master_info table_hover2 gridAlternada trfocus "
                            style="height:40px;">

                            <td style="width: 50px;">999999</td>
                            <td>株式会社サンプル
                            </td>

                          </tr>
                          <tr tabindex="0" class=" show_office_master_info table_hover2 gridAlternada trfocus "
                            style="height:40px;">

                            <td style="width: 50px;">999999</td>
                            <td>株式会社サンプル
                            </td>

                          </tr>
                          <tr tabindex="0" class=" show_office_master_info table_hover2 gridAlternada trfocus "
                            style="height:40px;">

                            <td style="width: 50px;">999999</td>
                            <td>株式会社サンプル
                            </td>

                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
                <script type="text/javascript">
                  $(function () {
                      $('#searchButton').click(function (event) {
                        $("#initial_content").show();
                      });
                    });
                </script>

                <div id="office_master_content_div">
                  <!-- 2nd modal content -->
                  <div style="height:75px;padding:29px 0px;">
                    <h4 style=""> 事業所マスタ &nbsp;&nbsp;&nbsp;(事業所CD/事業所名/住所)</h4>
                  </div>
                  <div class="modal-table-white" style="height: 164px;width: 100%;cursor: pointer;">
                    <div class="second-table">
                      <table class="table ">
                        <thead class="header text-center" id="myHeader">

                        </thead>
                        <tbody>
                          <tr tabindex="0" class="show_personal_master_info trfocus" style="height: 40px;">
                            <td>01</td>
                            <td>北海道支社</td>
                            <td>北海道札幌市中央区北1…</td>
                          </tr>
                          <tr tabindex="0" class="show_personal_master_info trfocus" style="height: 40px;">
                            <td style="width:50px;">02</td>
                            <td>東北支社</td>
                            <td>宮城県仙台市青葉区…</td>
                          </tr>

                          <tr tabindex="0" class="show_personal_master_info trfocus" style="height: 40px;">
                            <td style="width:50px;">03</td>
                            <td>東京本社
                            </td>
                            <td>東京都中央区銀座…</td>
                          </tr>
                          <tr tabindex="0" class="show_personal_master_info trfocus" style="height: 40px;">
                            <td style="width:50px;">04</td>
                            <td>大阪支社
                            </td>
                            <td>大阪府高槻市…</td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>

                <div id="personal_master_content_div">
                  <div style="height:78px;padding:30px 0px;">
                    <h4>個人マスタ　(個人CD/個人名/部署)</h4>
                  </div>
                  <div class=" modal-table-white" style="width: 100%; height: 123px;cursor: pointer;">
                    <div class="third-table">
                      <table class="table">
                        <tbody>
                          <tr tabindex="0" class="show_content_last trfocus" style="height: 40px;">
                            <td>001</td>
                            <td>鈴木　一郎</td>
                            <td>経営企画部</td>
                          </tr>
                          <tr tabindex="0" class="show_content_last trfocus" style="height: 40px;">
                            <td style="width:50px;">002</td>
                            <td>田中　二郎</td>
                            <td>営業部</td>
                          </tr>
                          <tr tabindex="0" class="show_content_last trfocus" style="height: 40px;">
                            <td style="width:50px;">003</td>
                            <td>山田　三郎</td>
                            <td>総務部</td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>

          </div>
          <div class="col-6">
            <div id="office_content_div_last" style="margin-top: 33px;padding-left:17px;">
              <div>
                <div class="heading"></div>
                <h4 class="b-color" style="margin-bottom: 25px;margin-top: 10px;"> 取引先情報</h4>
                <table class="table modal-table-blue" id="table-basic"
                  style="height:665px;margin-bottom:0px !important;">
                  <tbody>
                    <tr>
                      <td style="width: 112px;">番号</td>
                      <td style="width: 300px;"> 99999999999</td>
                    </tr>
                    <tr>
                      <td style="width: 112px;">会社名</td>
                      <td style="width: 300px;">株式会社サンプル </td>
                    </tr>
                    <tr>
                      <td style="width: 112px;">事業所名</td>
                      <td style="width: 300px;">東京本社</td>
                    </tr>
                    <tr>
                      <td style="width: 112px;">部署</td>
                      <td style="width: 300px;">営業部 </td>
                    </tr>
                    <tr>
                      <td style="width: 112px;">役職
                      </td>
                      <td style="width: 300px;">部長</td>
                    </tr>
                    <tr>
                      <td style="width: 112px;">氏名</td>
                      <td style="width: 300px;"> 田中　二郎</td>
                    </tr>
                    <tr>
                      <td style="width: 112px;">メールアドレス</td>
                      <td style="width: 300px;">sample@xxxx.co.jp</td>
                    </tr>
                    <tr>
                      <td style="width: 112px;">電話番号</td>
                      <td style="width: 300px;"> 00-0000-0000</td>
                    </tr>
                    <tr>
                      <td style="width: 112px;">帝国DB信用録PDF</td>
                      <td style="width: 300px;">sample-sinyo.pdf</td>
                    </tr>
                    <tr>
                      <td style="width: 112px;">帝国DB評点</td>
                      <td style="width: 300px;">59</td>
                    </tr>
                    <tr>
                      <td style="width: 112px;">与信限度額</td>
                      <td style="width: 300px;">3,000,000／残 750,000</td>
                    </tr>
                    <tr>
                      <td style="width: 112px;">入金日</td>
                      <td style="width: 300px;">10日締 翌々月 20日</td>
                    </tr>
                    <tr>
                      <td style="width: 112px;">請求書方式</td>
                      <td style="width: 300px;">1 郵送／1 PDFメール送信</td>
                    </tr>
                    <tr>
                      <td style="width: 112px;">社内備考（会社）</td>
                      <td style="width: 300px;">社内備考</td>
                    </tr>
                    <tr style="border:none;">
                      <td class="line-title" style="border-bottom:none !important;width: 112px;height: 30px;">
                      </td>
                      <td style="border-bottom:none !important;width: 300px;"></td>
                    </tr>
                    <tr>
                      <td class="line-title" style="border-bottom:none !important;width: 112px;height: 30px;">
                      </td>
                      <td style="border-bottom:none !important;width: 300px;"></td>
                    </tr>
                    <tr>
                      <td class="line-title" style="border-bottom:none !important;width: 112px;height: 30px;">
                      </td>
                      <td style="border-bottom:none !important;width: 300px;"></td>
                    </tr>
                  </tbody>
                </table>
              </div>

            </div>

          </div>
        </div>
        <!-- 2nd modal content end -->

        <!-- 3rd modal content  -->
        <script type="text/javascript">
          $(function () {
              $('.show_personal_master_info').click(function (event) {
                $('.show_personal_master_info').not(this).removeClass('add_border');
                $(this).addClass('add_border');
                $("#personal_master_content_div").show();
              });
            });

        </script>
        <div class="row">
          <div class="col-lg-6"> </div>
          <!-- 3rd modal content end  -->
          <!-- 4th modal content end  -->
          <script type="text/javascript">
            $(function () {
                $('.show_content_last').click(function (event) {
                  $('.show_content_last').not(this).removeClass('add_border');
                  $(this).addClass('add_border');
                  $("#office_content_div_last").show();
                });
              });
          </script>
        </div>
        <!-- 4th modal content end  -->
        <!-- modal content enddd   -->

      </div>
      <div class="modal-footer pl-4 pr-4" style="height:86px;padding:32px 29px;">
        <button type="button" id="" class="btn text-white bg-teal3 uskc-button" data-dismiss="modal"> <i class=""
            aria-hidden="true" style="margin-right: 5px;"></i>親画面をクリア
        </button>
        <button type="button" id="" class="btn text-white  bg-default uskc-button" data-dismiss="modal"> <i class=""
            aria-hidden="true" style="margin-right: 5px;"></i>キャンセル
        </button>
        <button type="button" id="choice_button" class="btn  bg-teal text-white ml-2 uskc-button" data-dismiss="modal">
          入力する
        </button>
      </div>
    </div>
  </div>
</div>
{{-- Search Modal Starts Here --}}

{{-- Example Modal 3 Modal Starts Here --}}
<div class="modal custom-modal" data-backdrop="static" id="exampleModal3" role="dialog"
  aria-labelledby="exampleModalLabel3" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content bg-blue">
      <div class="modal-header p-2 pl-4 border-bottom-0" style="background: #fff;height: 69px;padding: 24px 28px;">
        <h5 class="modal-title" id="exampleModalLabel"><strong>番号検索</strong></h5>
        <span type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </span>
      </div>
      <div class="modal-body pt-0 pr-1 pl-1" style="border: 2px solid #fff;" data-bind="nextFieldOnEnter:true">
        <div class="pl-4 pr-4" style="margin-top: 30px;">
          <div class=" row row_data mb-1">
            <div class="col-7">

              <div class="radio-rounded d-inline-block">
                <div class="custom-control custom-radio custom-control-inline" style="padding-left:11px!important;">
                  <input type="radio" class="custom-control-input" id="customRadio8" name="rd1" value="" autofocus=""
                    checked="">
                  <label class="custom-control-label text-white" for="customRadio8"
                    style="font-size: 12px!important;cursor:pointer;">受注</label>
                </div>
                <div class="custom-control custom-radio custom-control-inline" style="padding-left:11px!important;">
                  <input type="radio" class="custom-control-input" id="customRadio9" name="rd1" value="">
                  <label class="custom-control-label text-white" for="customRadio9"
                    style="font-size: 12px!important;cursor:pointer;"> 発注</label>
                </div>
              </div>
            </div>

          </div>

        </div>
        <div class="pl-4 pr-4" style="margin-top: 16px;">
          <div style="border-top: 1px solid #141855;padding-bottom: 15px;">
            <div class="row mt-2">
              <div class="col-lg-8">
                <div class="mt-2 mb-2" style="overflow-x:auto; overflow-y:auto; height: auto;">
                  <table class="custom-table-pagination table_hover2_pagi table-nohover  gridAlternada w_680">
                    <tbody>
                      <tr>
                        <td class="" style="padding-left:0px!important;">
                          <div class="pagi">
                            <div class="nav_mview">
                              <nav aria-label="Page navigation example ">
                                <ul class="pagination">
                                  <li class="page-item">
                                    <a class="page-link" href="#" aria-label="Previous"
                                      style="margin-right: 10px;border-top-right-radius: 4px;border-bottom-right-radius: 4px;color: black !important;height: 30px;">
                                      <span aria-hidden="true"><i class="fa fa-angle-left"
                                          style="line-height: 18px;font-size: 20px;"></i></span>
                                      <span class="sr-only">Previous</span>
                                    </a>
                                  </li>
                                  <li class="w_50 ">
                                    <input type="text" name="page" id="paginate"
                                      class="form-control intLimitTextBox text-center input_pagi" value="6"
                                      style=" margin-top: 0px;border-left: 0px!important;height: 27px!important;width: 40px;margin-right: 10px;border-radius: 4px !important;text-align: left !important;padding-left: 2px !important;height: 30px !important;">
                                  </li>
                                  <li class="page-item"><a class="page-link" href="#"
                                      style="line-height: 18px !important;color: black !important;border-radius: 4px;margin-right: 10px; width: 30px;font-weight: 600;">=</a>
                                  </li>
                                  <li class="page-item">
                                    <a class="page-link" href="#" aria-label="Next"
                                      style="line-height: 12px !important;color: black !important;border-top-left-radius: 4px;border-bottom-left-radius: 4px;height: 30px;">
                                      <span aria-hidden="true"><i class="fa fa-angle-right"
                                          style="line-height: 18px;font-size: 20px;"></i></span>
                                      <span class="sr-only">Next</span>
                                    </a>
                                  </li>
                                </ul>
                              </nav>
                            </div>
                          </div>
                        </td>
                        <td class="">
                          <div class="pagi_border-_none_text_wrap text-white">
                            <table class="ml-3">
                              <tbody>
                                <tr class="table_hover2_pagi  grid">
                                  <td class="p-2 pl-2 pr-2" style="border:none!important;color:white !important;">
                                    情報総数</td>
                                  <td class="p-2 pl-2 pr-2" style="border:none!important;color:white !important;">
                                    203
                                  </td>
                                  <td class="p-2 pl-2 pr-2" style="border:none!important;color:white !important;">
                                    表示範囲
                                  </td>
                                  <td class="p-2 pl-2 pr-2" style="border:none!important;color:white !important;">
                                    101～120</td>
                                  <td class="p-2 pl-2 pr-2" style="border:none!important;color:white !important;">
                                    ページ数
                                  </td>
                                  <td class="p-2 pl-2 pr-2" style="border:none!important;color:white !important;">
                                    11
                                  </td>
                                </tr>
                              </tbody>
                            </table>

                          </div>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
              <!-- new pagination row ends here -->
              <style type="text/css">
                @media only screen and (min-width:768px) and (max-width:992px) {
                  #tbl_border_none {
                    width: 100%;
                    margin-bottom: 10px;
                    float: right;
                  }
                }

                #tbl_border_none {
                  float: right;
                }

                @media only screen and (max-width:767px) {
                  #tbl_border_none {
                    margin-left: 0px;
                    float: none !important;
                  }
                }
              </style>
              <div class="col-lg-4">
                <div class="ml-auto pt-3 text-right">
                  <button type="button" id="choice_button" class="btn bg-teal w-145 text-white" style="width: 145px;">
                    検索
                  </button>
                  <button type="button" id="" class="btn text-white bg-default w-145 mr-2" style="width: 145px;"> <i
                      class="" aria-hidden="true" style="margin-right: 5px;"></i> 一覧
                  </button>
                </div>
              </div>
            </div>
          </div>
          <div class="table-scroll-area table-responsive">

            <div class="reference-table" style="margin-top: 20px;margin-bottom: 17px;">
              <div class="">
                <table class="table modal-inner modal-table-white text-dark bg-white"
                  style="margin-bottom: 0px !important;cursor: pointer;">
                  <thead>
                    <tr>
                      <th class="text-white" style="background: #363A81 !important;">番号</th>
                      <th class="text-white" style="background: #363A81 !important;">担当</th>
                      <th class="text-white" style="background: #363A81 !important;">受注先</th>
                      <th class="text-white" style="background: #363A81 !important;">最終顧客</th>
                      <th class="text-white" style="background: #363A81 !important;">受注・見積額
                      </th>
                      <th class="text-white" style="background: #363A81 !important;">受注件名・見積件名
                      </th>
                      <th class="text-white" style="background: #363A81 !important;">売上・見積日
                      </th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td class="line-title" style="height: 30px;background: white;margin-right: 1px;">
                        <input type="text" class="form-control"
                          style="width: 64px !important;border: 1px solid #E1E1E1 !important;border-radius: 4px !important;">
                      </td>
                      <td class="line-title" style="height: 30px;background: white;margin-right: 1px;">
                        <input type="text" class="form-control"
                          style="width: 52px !important;border: 1px solid #E1E1E1 !important;border-radius: 4px !important;">
                      </td>
                      <td class="line-title" style="height: 30px;background: white;margin-right: 1px;">
                        <input type="text" class="form-control"
                          style="width: 136px !important;border: 1px solid #E1E1E1 !important;border-radius: 4px !important;">
                      </td>
                      <td class="line-title" style="height: 30px;background: white;margin-right: 1px;">
                        <input type="text" class="form-control"
                          style="width: 133px !important;border: 1px solid #E1E1E1 !important;border-radius: 4px !important;">
                      </td>
                      <td class="line-title" style="height: 30px;background: white;margin-right: 1px;">
                        <input type="text" class="form-control"
                          style="width: 112px !important;border: 1px solid #E1E1E1 !important;border-radius: 4px !important;">
                      </td>
                      <td class="line-title" style="height: 30px;background: white;margin-right: 1px;">
                        <input type="text" class="form-control"
                          style="width: 249px !important;border: 1px solid #E1E1E1 !important;border-radius: 4px !important;">
                      </td>
                      <td class="line-title" style="height: 30px;background: white;">
                        <input type="text" class="form-control"
                          style="width: 109px !important;border: 1px solid #E1E1E1 !important;border-radius: 4px !important;">
                      </td>
                    </tr>
                    <tr tabindex="0" class="show_personal_master_info trfocused trfocus">
                      <td>99999999</td>
                      <td>NNN</td>
                      <td>NNNNNNNNNN</td>
                      <td>NNNNNNNNNN</td>
                      <td>999999999</td>
                      <td>NNNNNNNNNNNNNNNNNNNN</td>
                      <td>2020/00/00</td>

                    </tr>
                    <tr tabindex="0" class="show_personal_master_info add_border trfocus">
                      <td>99999999</td>
                      <td>NNN</td>
                      <td>NNNNNNNNNN</td>
                      <td>NNNNNNNNNN</td>
                      <td>999999999</td>
                      <td>NNNNNNNNNNNNNNNNNNNN</td>
                      <td>2020/00/00</td>
                    </tr>

                    <tr tabindex="0" class="show_personal_master_info trfocus">
                      <td>99999999</td>
                      <td>NNN</td>
                      <td>NNNNNNNNNN</td>
                      <td>NNNNNNNNNN</td>
                      <td>999999999</td>
                      <td>NNNNNNNNNNNNNNNNNNNN</td>
                      <td>2020/00/00</td>
                    </tr>
                    <tr tabindex="0" class="show_personal_master_info trfocus">
                      <td>99999999</td>
                      <td>NNN</td>
                      <td>NNNNNNNNNN</td>
                      <td>NNNNNNNNNN</td>
                      <td>999999999</td>
                      <td>NNNNNNNNNNNNNNNNNNNN</td>
                      <td>2020/00/00</td>
                    </tr>
                    <tr tabindex="0" class="show_personal_master_info trfocus">
                      <td>99999999</td>
                      <td>NNN</td>
                      <td>NNNNNNNNNN</td>
                      <td>NNNNNNNNNN</td>
                      <td>999999999</td>
                      <td>NNNNNNNNNNNNNNNNNNNN</td>
                      <td>2020/00/00</td>
                    </tr>
                    <tr tabindex="0" class="show_personal_master_info trfocus">
                      <td>99999999</td>
                      <td>NNN</td>
                      <td>NNNNNNNNNN</td>
                      <td>NNNNNNNNNN</td>
                      <td>999999999</td>
                      <td>NNNNNNNNNNNNNNNNNNNN</td>
                      <td>2020/00/00</td>
                    </tr>
                    <tr tabindex="0" class="show_personal_master_info trfocus">
                      <td>99999999</td>
                      <td>NNN</td>
                      <td>NNNNNNNNNN</td>
                      <td>NNNNNNNNNN</td>
                      <td>999999999</td>
                      <td>NNNNNNNNNNNNNNNNNNNN</td>
                      <td>2020/00/00</td>
                    </tr>
                    <tr tabindex="0" class="show_personal_master_info trfocus">
                      <td>99999999</td>
                      <td>NNN</td>
                      <td>NNNNNNNNNN</td>
                      <td>NNNNNNNNNN</td>
                      <td>999999999</td>
                      <td>NNNNNNNNNNNNNNNNNNNN</td>
                      <td>2020/00/00</td>
                    </tr>
                    <tr tabindex="0" class="show_personal_master_info trfocus">
                      <td>99999999</td>
                      <td>NNN</td>
                      <td>NNNNNNNNNN</td>
                      <td>NNNNNNNNNN</td>
                      <td>999999999</td>
                      <td>NNNNNNNNNNNNNNNNNNNN</td>
                      <td>2020/00/00</td>
                    </tr>
                    <tr tabindex="0" class="show_personal_master_info trfocus">
                      <td>99999999</td>
                      <td>NNN</td>
                      <td>NNNNNNNNNN</td>
                      <td>NNNNNNNNNN</td>
                      <td>999999999</td>
                      <td>NNNNNNNNNNNNNNNNNNNN</td>
                      <td>2020/00/00</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer border-top-0 pl-4 pr-4">
          <button type="button" id="" class="btn text-white bg-default  w-145" data-dismiss="modal"> <i class=""
              aria-hidden="true" style="margin-right: 5px;"></i>キャンセル
          </button>
          <button type="button" id="choice_button" class="btn  w-145 bg-teal text-white ml-2" data-dismiss="modal">
            入力する
          </button>
        </div>
      </div>
    </div>
  </div>
</div>
{{-- Example Modal 3 Modal Starts Here --}}

{{-- Example Modal 2 Modal Starts Here --}}
<div class="modal custom-modal" data-backdrop="static" id="exampleModal2" role="dialog"
  aria-labelledby="exampleModalLabel2" aria-hidden="true">
  <div class="modal-dialog" role="document" style="max-width: 700px;width:700px;">
    <div class="modal-content bg-blue">
      <div class="modal-header border-bottom-0" style="background: #fff;height:69px;padding:24px 28px;">
        <h5 class="modal-title" id="exampleModalLabel"><strong>商品</strong></h5>
        <span type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </span>
      </div>
      <div class="modal-body square-title pt-0" style="border: 2px solid #fff;padding:0px 30px;"
        data-bind="nextFieldOnEnter:true">
        <div class="modal-data-box">
          <table class="table text-white" id="table-basic" style="margin-bottom:0px !important;">
            <tbody class="">
              <tr style="height: 90px;">
                <td
                  style="width:128px !important;border-left: 0px !important;padding-left: 0px !important;border-right: 0px !important;">
                  <div class="line-icon-box"></div>品目群
                </td>
                <td style="border-left: 0px !important;border-right: 0px !important;padding: 20px 0px !important;">
                  <div class="custom-arrow">
                    <select class="form-control" autofocus>
                      <option value="0">99　NNNNNNNNNNNNNNNNNNNN</option>
                    </select>
                  </div>
                </td>
              </tr>
              <tr style="height: 85px;">
                <td style="border-left: 0px !important;padding-left: 0px !important;border-right: 0px !important;">
                  <div class="line-icon-box"></div>製品区分
                </td>
                <td style="border-left: 0px !important;border-right: 0px !important;padding: 20px 0px !important;">
                  <div class="custom-arrow">
                    <select class="form-control">
                      <option value="0">製品区分を選択</option>
                    </select>
                  </div>
                </td>
              </tr>
              <tr style="height: 85px;">
                <td
                  style="border-left: 0px !important;border-right: 0px !important;padding-left: 0px !important;padding-top: 17px;">
                  <div class="line-icon-box"></div>品目区分
                </td>
                <td style="border-left: 0px !important;border-right: 0px !important;padding: 20px 0px !important;">
                  <div class="custom-arrow">
                    <select class="form-control">
                      <option value="0">品目区分を選択</option>
                    </select>
                  </div>
                </td>
              </tr>
              <tr style="height: 85px;">
                <td style="border-left: 0px !important;border-right: 0px !important;padding-left: 0px;">
                  <div class="line-icon-box"></div>販売形態
                </td>
                <td style="border-left: 0px !important;border-right: 0px !important;padding: 20px 0px !important;">
                  <div class="custom-arrow">
                    <select class="form-control">
                      <option value="0">販売形態を選択</option>
                    </select>
                  </div>
                </td>
              </tr>
              <tr style="height: 85px;">
                <td style="border-left: 0px !important;border-right: 0px !important;padding-left: 0px;">
                  <div class="line-icon-box"></div>バージョン区分
                </td>
                <td style="border-left: 0px !important;border-right: 0px !important;padding: 20px 0px !important;">
                  <div class="custom-arrow">
                    <select class="form-control">
                      <option value="0">バージョン区分を選択</option>
                    </select>
                  </div>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
        <div>
          <div style="height:81px;padding:32px 0px;">
            <h6 class="text-white">
              <div class="line-icon-box"></div>商品選択（商品CD/商品名）
            </h6>
          </div>
          <div class="scrollbararea" style="height: 184px; overflow-y: scroll; cursor: pointer;">
            <table class="table modal-inner modal-table-white text-dark bg-white"
              style="margin-bottom: 0px !important;">
              <thead class="header text-center" id="myHeader">
              </thead>
              <tbody>
                <tr class="show_personal_master_info" style="height: 41px;">
                  <td>99999</td>
                  <td>NNNNNNNNNNNNNNNNNNNN</td>
                </tr>
                <tr class="show_personal_master_info add_border" style="height: 41px;">
                  <td style="width:50px;">99999</td>
                  <td>NNNNNNNNNNNNNNNNNNNN</td>
                </tr>

                <tr class="show_personal_master_info" style="height: 41px;">
                  <td style="width:50px;">99999</td>
                  <td>NNNNNNNNNNNNNNNNNNNN</td>
                </tr>
                <tr class="show_personal_master_info" style="height: 41px;">
                  <td style="width:50px;">99999</td>
                  <td>NNNNNNNNNNNNNNNNNNNN</td>
                </tr>
                <tr class="show_personal_master_info" style="height: 41px;">
                  <td style="width:50px;">99999</td>
                  <td>NNNNNNNNNNNNNNNNNNNN</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
        <div class="modal-footer border-top-0" style="height: 87px;padding:0px !important;">
          <button type="button" id="" class="btn text-white uskc-button bg-default" data-dismiss="modal">
            <i class="" aria-hidden="true" style="margin-right: 5px;"></i>キャンセル
          </button>
          <button type="button" id="choice_button" class="btn uskc-button bg-teal text-white ml-2" data-dismiss="modal">
            入力する
          </button>
        </div>
      </div>
    </div>
  </div>
</div>
{{-- Example Modal 2 Modal Starts Here --}}