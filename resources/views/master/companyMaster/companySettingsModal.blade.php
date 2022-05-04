<form id="tableSetting" action="{{ route('companyMasterTableSetting',$bango) }}">
  @csrf
  <input type="hidden" name="redirect_path" value="companyMasterReload">
  <div class="modal" data-keyboard="false" data-backdrop="static" id="setting_display_modal" role="dialog"
    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 1050px;">
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

              <!--     <a href="#" class="btn btn-info " onclick="table3SelectAll()" id=""style="background-color:#3e6ec1!important;margin-top: 2px;margin-bottom: 20px;" data-toggle="modal" data-target="#">全選択</a>  -->

              <a class="checkall btn btn-info " style="margin-bottom: 10px;">全選択</a>
              <a class="uncheck btn btn-info" style="margin-bottom: 10px;">全解除</a>

            </div>

            <div class="col-lg-4">


            </div>
            <div class="col-lg-4">
              <a class="btn btn-info " style="margin-bottom: 10px;float: right;">デフォルト</a>

            </div>
          </div>


          <!-- <script type="text/javascript">
                    var state = false; // desecelted

                    $('.checkall').click(function () {

                        $('.customCheckBox').each(function() {
                          if(!state) {
                              this.checked = true;
                            }
                        });

                        //switch
                        if (state) {
                          state = false;
                        }

                    });
                    </script> -->

          {{--                    <script type="text/javascript">--}}
          {{--                        var state = false; // desecelted--}}

          {{--                        $('.checkall').click(function () {--}}
          {{--                            $('.customCheckBox').each(function () {--}}
          {{--                                if (!state) {--}}
          {{--                                    this.checked = true;--}}
          {{--                                }--}}
          {{--                            });--}}


          {{--                        });--}}


          {{--                        //Unchecked....--}}
          {{--                        $('.uncheck').click(function () {--}}
          {{--                            $('.customCheckBox').each(function () {--}}
          {{--                                if (!state) {--}}
          {{--                                    this.checked = false;--}}

          {{--                                    $("input[type='tel']").val("");--}}
          {{--//$("input[type=text], textarea").val("");--}}
          {{--                                }--}}
          {{--                            });--}}


          {{--                        });--}}


          {{--                        // // Check All--}}
          {{--                        //   $('.checkall').click(function() {--}}
          {{--                        //     $(".customCheckBox").attr("checked", true);--}}
          {{--                        //   });--}}

          {{--                        //   // Uncheck All--}}
          {{--                        //   $('.uncheck').click(function() {--}}
          {{--                        //     $(".customCheckBox").attr("checked", false);--}}
          {{--                        //     $("#check_yobi12").attr("checked", true);--}}
          {{--                        //     $("input[type='tel']").val("");--}}
          {{--                        //   });--}}
          {{--                    </script>--}}


          <div id="errorShow">

          </div>
          <div id="input_boxwrap_compsettingmodal" data-bind="nextFieldOnEnter:true">
            <div class="row">

              <div class="col-lg-4 col-md-6 col-sm-6">
                <div class="table-responsive setting_header">
                  <table class="table table-striped  table-bordered">
                    <tbody class="">


                      <tr>
                        <td>
                          <div class="custom-control custom-checkbox custom-control-inline" style="">

                            <input type="checkbox" id="check_yobi12" class=" custom-control-input" checked="checked"
                              disabled="disabled">
                            <input type="hidden" name="check_yobi12" value="on">
                            <label class="custom-control-label margin_btn_17" for="check_yobi12"></label>

                          </div>
                        </td>
                        <td style="width:60px!important;">
                          <input type="text" name="yobi12" id="setting_yobi12" class="form-control text-right"
                            maxlength="2" value="0" readonly="readonly" autocomplete="off"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                        </td>
                        <td class="text-left">
                          <span class="mt-1 text-left">会社CD</span>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <div class="custom-control custom-checkbox custom-control-inline" style="">
                            <input type="checkbox" name="check_name" id="check_name"
                              class="custom-control-input customCheckBox">
                            <label class="custom-control-label margin_btn_17" for="check_name"></label>
                          </div>
                        </td>
                        <td style="width:60px!important;">
                          <input type="tel" name="name" id="setting_name" class="form-control text-right" maxlength="2"
                            value="1" autocomplete="off"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                        </td>
                        <td class="text-left">
                          <span class="mt-1 text-left">会社名 </span>
                        </td>
                      </tr>

                      <tr>
                        <td>
                          <div class="custom-control custom-checkbox custom-control-inline" style="">
                            <input type="checkbox" name="check_address" id="check_address"
                              class="custom-control-input customCheckBox">
                            <label class="custom-control-label margin_btn_17" for="check_address"></label>
                          </div>
                        </td>
                        <td style="width:60px!important;">
                          <input type="tel" name="address" id="setting_address" class="form-control text-right"
                            maxlength="2" autocomplete="off"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                        </td>
                        <td class="text-left">
                          <span class="mt-1 text-left">会社名略称 </span>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <div class="custom-control custom-checkbox custom-control-inline" style="">
                            <input type="checkbox" name="check_furigana" id="check_furigana"
                              class="custom-control-input customCheckBox">
                            <label class="custom-control-label margin_btn_17" for="check_furigana"></label>
                          </div>
                        </td>
                        <td style="width:60px!important;">
                          <input type="tel" name="furigana" id="setting_furigana" class="form-control text-right"
                            maxlength="2" autocomplete="off"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                        </td>
                        <td class="text-left">
                          <span class="mt-1 text-left">会社名カナ</span>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <div class="custom-control custom-checkbox custom-control-inline" style="">
                            <input type="checkbox" name="check_yubinbango" id="check_yubinbango"
                              class="custom-control-input customCheckBox">
                            <label class="custom-control-label margin_btn_17" for="check_yubinbango"></label>
                          </div>
                        </td>
                        <td style="width:60px!important;">
                          <input type="tel" name="yubinbango" id="setting_yubinbango" class="form-control text-right"
                            maxlength="2" autocomplete="off"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                        </td>
                        <td class="text-left">
                          <span class="mt-1 text-left">入力区分</span>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <div class="custom-control custom-checkbox custom-control-inline" style="">
                            <input type="checkbox" name="check_yobi13" id="check_yobi13"
                              class="custom-control-input customCheckBox ">
                            <label class="custom-control-label margin_btn_17" for="check_yobi13"></label>
                          </div>
                        </td>
                        <td style="width:60px!important;">
                          <input type="tel" name="yobi13" id="setting_yobi13" class="form-control text-right"
                            maxlength="2" autocomplete="off"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                        </td>
                        <td class="text-left">
                          <span class="mt-1 text-left">帝国ﾃﾞｰﾀﾊﾞﾝｸ信用録PDF</span>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <div class="custom-control custom-checkbox custom-control-inline" style="">
                            <input type="checkbox" name="check_tel" id="check_tel"
                              class="custom-control-input customCheckBox">
                            <label class="custom-control-label margin_btn_17" for="check_tel"></label>
                          </div>
                        </td>
                        <td style="width:60px!important;">
                          <input type="tel" name="tel" id="setting_tel" class="form-control text-right" maxlength="2"
                            autocomplete="off"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                        </td>
                        <td class="text-left">
                          <span class="mt-1 text-left">帝国ﾃﾞｰﾀﾊﾞﾝｸ取得年月日</span>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <div class="custom-control custom-checkbox custom-control-inline" style="">
                            <input type="checkbox" name="check_fax" id="check_fax"
                              class="custom-control-input customCheckBox">
                            <label class="custom-control-label margin_btn_17" for="check_fax"></label>
                          </div>
                        </td>
                        <td style="width:60px!important;">
                          <input type="tel" name="fax" id="setting_fax" class="form-control text-right" maxlength="2"
                            autocomplete="off"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                        </td>
                        <td class="text-left">
                          <span class="mt-1 text-left">帝国ﾃﾞｰﾀﾊﾞﾝｸ企業CD</span>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <div class="custom-control custom-checkbox custom-control-inline" style="">
                            <input type="checkbox" name="check_torihikisakibango" id="check_torihikisakibango"
                              class="custom-control-input customCheckBox">
                            <label class="custom-control-label margin_btn_17" for="check_torihikisakibango"></label>
                          </div>
                        </td>
                        <td style="width:60px!important;">
                          <input type="tel" name="torihikisakibango" id="setting_torihikisakibango"
                            class="form-control text-right" maxlength="2" autocomplete="off"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                        </td>
                        <td class="text-left">
                          <span class="mt-1 text-left">帝国ﾃﾞｰﾀﾊﾞﾝｸ評点</span>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <div class="custom-control custom-checkbox custom-control-inline" style="">
                            <input type="checkbox" name="check_tantousya_detail" id="check_tantousya_detail"
                              class="custom-control-input customCheckBox">
                            <label class="custom-control-label margin_btn_17" for="check_tantousya_detail"></label>
                          </div>
                        </td>
                        <td style="width:60px!important;">
                          <input type="tel" name="tantousya_detail" id="setting_tantousya_detail"
                            class="form-control text-right" maxlength="2" autocomplete="off"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                        </td>
                        <td class="text-left">
                          <span class="mt-1 text-left">経済産業省業種区分1</span>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <div class="custom-control custom-checkbox custom-control-inline" style="">
                            <input type="checkbox" name="check_kcode1_detail" id="check_kcode1_detail"
                              class="custom-control-input customCheckBox">
                            <label class="custom-control-label margin_btn_17" for="check_kcode1_detail"></label>
                          </div>
                        </td>
                        <td style="width:60px!important;">
                          <input type="tel" name="kcode1_detail" id="setting_kcode1_detail"
                            class="form-control text-right" maxlength="2" autocomplete="off"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                        </td>
                        <td class="text-left">
                          <span class="mt-1 text-left">経済産業省業種区分2</span>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <div class="custom-control custom-checkbox custom-control-inline" style="">
                            <input type="checkbox" name="check_kcode2_detail" id="check_kcode2_detail"
                              class="custom-control-input customCheckBox">
                            <label class="custom-control-label margin_btn_17" for="check_kcode2_detail"></label>
                          </div>
                        </td>
                        <td style="width:60px!important;">
                          <input type="tel" name="kcode2_detail" id="setting_kcode2_detail"
                            class="form-control text-right" maxlength="2" autocomplete="off"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                        </td>
                        <td class="text-left">
                          <span class="mt-1 text-left">基本業種</span>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <div class="custom-control custom-checkbox custom-control-inline" style="">
                            <input type="checkbox" name="check_kensakukey" id="check_kensakukey"
                              class="custom-control-input customCheckBox">
                            <label class="custom-control-label margin_btn_17" for="check_kensakukey"></label>
                          </div>
                        </td>
                        <td style="width:60px!important;">
                          <input type="tel" name="kensakukey" id="setting_kensakukey" class="form-control text-right "
                            maxlength="2" autocomplete="off"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                        </td>
                        <td class="text-left">
                          <span class="mt-1 text-left">社内備考（会社）</span>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <div class="custom-control custom-checkbox custom-control-inline" style="">
                            <input type="checkbox" name="check_kcode3" id="check_kcode3"
                              class="custom-control-input customCheckBox">
                            <label class="custom-control-label margin_btn_17" for="check_kcode3"></label>
                          </div>
                        </td>
                        <td style="width:60px!important;">
                          <input type="tel" name="kcode3" id="setting_kcode3" class="form-control text-right"
                            maxlength="2" autocomplete="off"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                        </td>
                        <td class="text-left">
                          <span class="mt-1 text-left">即時区分</span>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <div class="custom-control custom-checkbox custom-control-inline" style="">
                            <input type="checkbox" name="check_ytoiawsestart_detail" id="check_ytoiawsestart_detail"
                              class="custom-control-input customCheckBox">
                            <label class="custom-control-label margin_btn_17" for="check_ytoiawsestart_detail"></label>
                          </div>
                        </td>
                        <td style="width:60px!important;">
                          <input type="tel" name="ytoiawsestart_detail" id="setting_ytoiawsestart_detail"
                            class="form-control text-right" maxlength="2" autocomplete="off"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                        </td>
                        <td class="text-left">
                          <span class="mt-1 text-left">請求締め日</span>
                        </td>
                      </tr>


                      <tr>
                        <td>
                          <div class="custom-control custom-checkbox custom-control-inline" style="">
                            <input type="checkbox" name="check_ytoiawseend_detail" id="check_ytoiawseend_detail"
                              class="custom-control-input customCheckBox">
                            <label class="custom-control-label margin_btn_17" for="check_ytoiawseend_detail"></label>
                          </div>
                        </td>
                        <td style="width:60px!important;">
                          <input type="tel" name="ytoiawseend_detail" id="setting_ytoiawseend_detail"
                            class="form-control text-right" maxlength="2" autocomplete="off"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                        </td>
                        <td class="text-left">
                          <span class="mt-1 text-left">入金方法</span>
                        </td>
                      </tr>

                      <tr>
                        <td>
                          <div class="custom-control custom-checkbox custom-control-inline" style="">
                            <input type="checkbox" name="check_ytoiawsesaiban" id="check_ytoiawsesaiban"
                              class="custom-control-input customCheckBox">
                            <label class="custom-control-label margin_btn_17" for="check_ytoiawsesaiban"></label>
                          </div>
                        </td>
                        <td style="width:60px!important;">
                          <input type="tel" name="ytoiawsesaiban" id="setting_ytoiawsesaiban"
                            class="form-control text-right" maxlength="2" autocomplete="off"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                        </td>
                        <td class="text-left">
                          <span class="mt-1 text-left">回収月 </span>
                        </td>
                      </tr>

                      <tr>
                        <td>
                          <div class="custom-control custom-checkbox custom-control-inline" style="">
                            <input type="checkbox" name="check_yetoiawsestart" id="check_yetoiawsestart"
                              class="custom-control-input customCheckBox">
                            <label class="custom-control-label margin_btn_17" for="check_yetoiawsestart"></label>
                          </div>
                        </td>
                        <td style="width:60px!important;">
                          <input type="tel" name="yetoiawsestart" id="setting_yetoiawsestart"
                            class="form-control text-right" maxlength="2" autocomplete="off"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                        </td>
                        <td class="text-left">
                          <span class="mt-1 text-left">回収日</span>
                        </td>
                      </tr>

                      <tr>
                        <td>
                          <div class="custom-control custom-checkbox custom-control-inline" style="">
                            <input type="checkbox" name="check_yetoiawseend" id="check_yetoiawseend"
                              class="custom-control-input customCheckBox">
                            <label class="custom-control-label margin_btn_17" for="check_yetoiawseend"></label>
                          </div>
                        </td>
                        <td style="width:60px!important;">
                          <input type="tel" name="yetoiawseend" id="setting_yetoiawseend"
                            class="form-control text-right" maxlength="2" autocomplete="off"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                        </td>
                        <td class="text-left">
                          <span class="mt-1 text-left">回収日休日設定</span>
                        </td>
                      </tr>

                      <tr>
                        <td>
                          <div class="custom-control custom-checkbox custom-control-inline" style="">
                            <input type="checkbox" name="check_yetoiawsesaiban" id="check_yetoiawsesaiban"
                              class="custom-control-input customCheckBox">
                            <label class="custom-control-label margin_btn_17" for="check_yetoiawsesaiban"></label>
                          </div>
                        </td>
                        <td style="width:60px!important;">
                          <input type="tel" name="yetoiawsesaiban" id="setting_yetoiawsesaiban"
                            class="form-control text-right" maxlength="2" autocomplete="off"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                        </td>
                        <td class="text-left">
                          <span class="mt-1 text-left">入金時手数料設定</span>
                        </td>
                      </tr>

                      <tr>
                        <td>
                          <div class="custom-control custom-checkbox custom-control-inline" style="">
                            <input type="checkbox" name="check_denpyostart" id="check_denpyostart"
                              class="custom-control-input customCheckBox">
                            <label class="custom-control-label margin_btn_17" for="check_denpyostart"></label>
                          </div>
                        </td>
                        <td style="width:60px!important;">
                          <input type="tel" name="denpyostart" id="setting_denpyostart" class="form-control text-right"
                            maxlength="2" autocomplete="off"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                        </td>
                        <td class="text-left">
                          <span class="mt-1 text-left">与信限度額</span>
                        </td>
                      </tr>

                      <tr>
                        <td>
                          <div class="custom-control custom-checkbox custom-control-inline" style="">
                            <input type="checkbox" name="check_mail_soushin" id="check_mail_soushin"
                              class="custom-control-input customCheckBox">
                            <label class="custom-control-label margin_btn_17" for="check_mail_soushin"></label>
                          </div>
                        </td>
                        <td style="width:60px!important;">
                          <input type="tel" name="mail_soushin" id="setting_mail_soushin"
                            class="form-control text-right" maxlength="2" autocomplete="off"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                        </td>
                        <td class="text-left">
                          <span class="mt-1 text-left">請求先CD</span>
                        </td>
                      </tr>

                      <tr>
                        <td>
                          <div class="custom-control custom-checkbox custom-control-inline" style="">
                            <input type="checkbox" name="check_mail_jyushin" id="check_mail_jyushin"
                              class="custom-control-input customCheckBox">
                            <label class="custom-control-label margin_btn_17" for="check_mail_jyushin"></label>
                          </div>
                        </td>
                        <td style="width:60px!important;">
                          <input type="tel" name="mail_jyushin" id="setting_mail_jyushin"
                            class="form-control text-right" maxlength="2" autocomplete="off"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                        </td>
                        <td class="text-left">
                          <span class="mt-1 text-left">請求書送付日</span>
                        </td>
                      </tr>

                      <tr>
                        <td>
                          <div class="custom-control custom-checkbox custom-control-inline" style="">
                            <input type="checkbox" name="check_mail_nouhin" id="check_mail_nouhin"
                              class="custom-control-input customCheckBox">
                            <label class="custom-control-label margin_btn_17" for="check_mail_nouhin"></label>
                          </div>
                        </td>
                        <td style="width:60px!important;">
                          <input type="tel" name="mail_nouhin" id="setting_mail_nouhin" class="form-control text-right"
                            maxlength="2" autocomplete="off"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                        </td>
                        <td class="text-left">
                          <span class="mt-1 text-left">請求書メール区分</span>
                        </td>
                      </tr>


                    </tbody>
                  </table>
                </div>
              </div>

              <div class="col-lg-4 col-md-6 col-sm-6">
                <div class="table-responsive setting_header">
                  <table class="table table-striped  table-bordered">
                    <tbody class="">
                      <tr>
                        <td>
                          <div class="custom-control custom-checkbox custom-control-inline" style="">
                            <input type="checkbox" name="check_mail_toiawase" id="check_mail_toiawase"
                              class="custom-control-input customCheckBox">
                            <label class="custom-control-label margin_btn_17" for="check_mail_toiawase"></label>
                          </div>
                        </td>
                        <td style="width:60px!important;">
                          <input type="tel" name="mail_toiawase" id="setting_mail_toiawase"
                            class="form-control text-right" maxlength="2" autocomplete="off"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                        </td>
                        <td class="text-left">
                          <span class="mt-1 text-left">請求書メール宛先</span>
                        </td>
                      </tr>

                      <tr>
                        <td>
                          <div class="custom-control custom-checkbox custom-control-inline" style="">
                            <input type="checkbox" name="check_mail_soushin_mb" id="check_mail_soushin_mb"
                              class="custom-control-input customCheckBox">
                            <label class="custom-control-label margin_btn_17" for="check_mail_soushin_mb"></label>
                          </div>
                        </td>
                        <td style="width:60px!important;">
                          <input type="tel" name="mail_soushin_mb" id="setting_mail_soushin_mb"
                            class="form-control text-right" maxlength="2" autocomplete="off"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                        </td>
                        <td class="text-left">
                          <span class="mt-1 text-left">請求書UIS</span>
                        </td>
                      </tr>

                      <tr>
                        <td>
                          <div class="custom-control custom-checkbox custom-control-inline" style="">
                            <input type="checkbox" name="check_mail_jyushin_mb" id="check_mail_jyushin_mb"
                              class="custom-control-input customCheckBox">
                            <label class="custom-control-label margin_btn_17" for="check_mail_jyushin_mb"></label>
                          </div>
                        </td>
                        <td style="width:60px!important;">
                          <input type="tel" name="mail_jyushin_mb" id="setting_mail_jyushin_mb"
                            class="form-control text-right" maxlength="2" autocomplete="off"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                        </td>
                        <td class="text-left">
                          <span class="mt-1 text-left">請求書郵送</span>
                        </td>
                      </tr>

                      <tr>
                        <td>
                          <div class="custom-control custom-checkbox custom-control-inline" style="">
                            <input type="checkbox" name="check_mail_nouhin_mb" id="check_mail_nouhin_mb"
                              class="custom-control-input customCheckBox">
                            <label class="custom-control-label margin_btn_17" for="check_mail_nouhin_mb"></label>
                          </div>
                        </td>
                        <td style="width:60px!important;">
                          <input type="tel" name="mail_nouhin_mb" id="setting_mail_nouhin_mb"
                            class="form-control text-right" maxlength="2" autocomplete="off"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                        </td>
                        <td class="text-left">
                          <span class="mt-1 text-left">請求書郵送先</span>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <div class="custom-control custom-checkbox custom-control-inline" style="">
                            <input type="checkbox" name="check_mail_toiawase_mb_detail"
                              id="check_mail_toiawase_mb_detail" class="custom-control-input customCheckBox">
                            <label class="custom-control-label margin_btn_17"
                              for="check_mail_toiawase_mb_detail"></label>
                          </div>
                        </td>
                        <td style="width:60px!important;">
                          <input type="tel" name="mail_toiawase_mb_detail" id="setting_mail_toiawase_mb_detail"
                            class="form-control text-right" maxlength="2" autocomplete="off"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                        </td>
                        <td class="text-left">
                          <span class="mt-1 text-left">請求税区分</span>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <div class="custom-control custom-checkbox custom-control-inline" style="">
                            <input type="checkbox" name="check_mallsoukobango1_detail" id="check_mallsoukobango1_detail"
                              class="custom-control-input customCheckBox">
                            <label class="custom-control-label margin_btn_17"
                              for="check_mallsoukobango1_detail"></label>
                          </div>
                        </td>
                        <td style="width:60px!important;">
                          <input type="tel" name="mallsoukobango1_detail" id="setting_mallsoukobango1_detail"
                            class="form-control text-right" maxlength="2" autocomplete="off"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                        </td>
                        <td class="text-left">
                          <span class="mt-1 text-left">請求税端数区分</span>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <div class="custom-control custom-checkbox custom-control-inline" style="">
                            <input type="checkbox" name="check_mallsoukobango2" id="check_mallsoukobango2"
                              class="custom-control-input customCheckBox">
                            <label class="custom-control-label margin_btn_17" for="check_mallsoukobango2"></label>
                          </div>
                        </td>
                        <td style="width:60px!important;">
                          <input type="tel" name="mallsoukobango2" id="setting_mallsoukobango2"
                            class="form-control text-right" maxlength="2" autocomplete="off"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                        </td>
                        <td class="text-left">
                          <span class="mt-1 text-left">専伝区分</span>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <div class="custom-control custom-checkbox custom-control-inline" style="">
                            <input type="checkbox" name="check_mallsoukobango3" id="check_mallsoukobango3"
                              class="custom-control-input customCheckBox">
                            <label class="custom-control-label margin_btn_17" for="check_mallsoukobango3"></label>
                          </div>
                        </td>
                        <td style="width:60px!important;">
                          <input type="tel" name="mallsoukobango3" id="setting_mallsoukobango3"
                            class="form-control text-right" maxlength="2" autocomplete="off"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                        </td>
                        <td class="text-left">
                          <span class="mt-1 text-left">指定納品書帳票CD</span>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <div class="custom-control custom-checkbox custom-control-inline" style="">
                            <input type="checkbox" name="check_kcode4" id="check_kcode4"
                              class="custom-control-input customCheckBox">
                            <label class="custom-control-label margin_btn_17" for="check_kcode4"></label>
                          </div>
                        </td>
                        <td style="width:60px!important;">
                          <input type="tel" name="kcode4" id="setting_kcode4" class="form-control text-right"
                            maxlength="2" autocomplete="off"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                        </td>
                        <td class="text-left">
                          <span class="mt-1 text-left">ユーザー区分</span>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <div class="custom-control custom-checkbox custom-control-inline" style="">
                            <input type="checkbox" name="check_kcode5_detail" id="check_kcode5_detail"
                              class="custom-control-input customCheckBox">
                            <label class="custom-control-label margin_btn_17" for="check_kcode5_detail"></label>
                          </div>
                        </td>
                        <td style="width:60px!important;">
                          <input type="tel" name="kcode5_detail" id="setting_kcode5_detail"
                            class="form-control text-right" maxlength="2" autocomplete="off"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                        </td>
                        <td class="text-left">
                          <span class="mt-1 text-left">データソース</span>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <div class="custom-control custom-checkbox custom-control-inline" style="">
                            <input type="checkbox" name="check_domain_detail" id="check_domain_detail"
                              class="custom-control-input customCheckBox">
                            <label class="custom-control-label margin_btn_17" for="check_domain_detail"></label>
                          </div>
                        </td>
                        <td style="width:60px!important;">
                          <input type="tel" name="domain_detail" id="setting_domain_detail"
                            class="form-control text-right" maxlength="2" autocomplete="off"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                        </td>

                        <td class="text-left">
                          <span class="mt-1 text-left">販売ランク</span>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <div class="custom-control custom-checkbox custom-control-inline" style="">
                            <input type="checkbox" name="check_domain2_detail" id="check_domain2_detail"
                              class="custom-control-input customCheckBox">
                            <label class="custom-control-label margin_btn_17" for="check_domain2_detail"></label>
                          </div>
                        </td>
                        <td style="width:60px!important;">
                          <input type="tel" name="domain2_detail" id="setting_domain2_detail"
                            class="form-control text-right" maxlength="2" autocomplete="off"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                        </td>
                        <td class="text-left">
                          <span class="mt-1 text-left">顧客深耕層別化</span>
                        </td>
                      </tr>
                      <!--                                                     <tr>
                                                                                    <td>
                                                                                        <div class="custom-control custom-checkbox custom-control-inline">
                                                                                            <input type="checkbox" id="th37" class="custom-control-input customCheckBox">
                                                                                            <label class="custom-control-label margin_btn_17" for="th37"></label>
                                                                                        </div>
                                                                                    </td>
                                                                                       <td style="width:60px!important;">
                                                                                        <input type="tel" class="form-control" autocomplete="off" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                                                                                    </td>
                                                                                    <td class="text-left">
                                                                                        <span class="mt-1 text-left">得意先分類３</span>
                                                                                    </td>
                                                                                </tr>-->


                      <!--                                            <tr>
                                                                                    <td>
                                                                                        <div class="custom-control custom-checkbox custom-control-inline">
                                                                                            <input type="checkbox" id="th38" class="custom-control-input customCheckBox">
                                                                                            <label class="custom-control-label margin_btn_17" for="th38"></label>
                                                                                        </div>
                                                                                    </td>
                                                                                       <td style="width:60px!important;">
                                                                                        <input type="tel" class="form-control" autocomplete="off" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                                                                                    </td>
                                                                                    <td class="text-left">
                                                                                        <span class="mt-1 text-left">得意先分類４</span>
                                                                                    </td>
                                                                                </tr>-->
                      <!--            <tr>
                                                                                    <td>
                                                                                        <div class="custom-control custom-checkbox custom-control-inline">
                                                                                            <input type="checkbox" id="th39" class="custom-control-input customCheckBox">
                                                                                            <label class="custom-control-label margin_btn_17" for="th39"></label>
                                                                                        </div>
                                                                                    </td>
                                                                                       <td style="width:60px!important;">
                                                                                        <input type="tel" class="form-control" autocomplete="off" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                                                                                    </td>
                                                                                    <td class="text-left">
                                                                                        <span class="mt-1 text-left">得意先分類５</span>
                                                                                    </td>
                                                                                </tr>-->
                      <!--                                          <tr>
                                                                                    <td>
                                                                                        <div class="custom-control custom-checkbox custom-control-inline">
                                                                                            <input type="checkbox" id="th40" class="custom-control-input customCheckBox">
                                                                                            <label class="custom-control-label margin_btn_17" for="th40"></label>
                                                                                        </div>
                                                                                    </td>
                                                                                       <td style="width:60px!important;">
                                                                                        <input type="tel" class="form-control" autocomplete="off" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                                                                                    </td>
                                                                                    <td class="text-left">
                                                                                        <span class="mt-1 text-left">得意先分類６</span>
                                                                                    </td>
                                                                                </tr>-->
                      <tr>
                        <td>
                          <div class="custom-control custom-checkbox custom-control-inline" style="">
                            <input type="checkbox" name="check_stoiawsestart_detail" id="check_stoiawsestart_detail"
                              class="custom-control-input customCheckBox">
                            <label class="custom-control-label margin_btn_17" for="check_stoiawsestart_detail"></label>
                          </div>
                        </td>
                        <td style="width:60px!important;">
                          <input type="tel" name="stoiawsestart_detail" id="setting_stoiawsestart_detail"
                            class="form-control text-right" maxlength="2" autocomplete="off"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                        </td>
                        <td class="text-left">
                          <span class="mt-1 text-left">年商</span>
                        </td>
                      </tr>

                      <tr>
                        <td>
                          <div class="custom-control custom-checkbox custom-control-inline" style="">
                            <input type="checkbox" name="check_stoiawseend_detail" id="check_stoiawseend_detail"
                              class="custom-control-input customCheckBox">
                            <label class="custom-control-label margin_btn_17" for="check_stoiawseend_detail"></label>
                          </div>
                        </td>
                        <td style="width:60px!important;">
                          <input type="tel" name="stoiawseend_detail" id="setting_stoiawseend_detail"
                            class="form-control text-right" maxlength="2" autocomplete="off"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                        </td>
                        <td class="text-left">
                          <span class="mt-1 text-left">従業員</span>
                        </td>
                      </tr>

                      <tr>
                        <td>
                          <div class="custom-control custom-checkbox custom-control-inline" style="">
                            <input type="checkbox" name="check_stoiawsesaiban_detail" id="check_stoiawsesaiban_detail"
                              class="custom-control-input customCheckBox">
                            <label class="custom-control-label margin_btn_17" for="check_stoiawsesaiban_detail"></label>
                          </div>
                        </td>
                        <td style="width:60px!important;">
                          <input type="tel" name="stoiawsesaiban_detail" id="setting_stoiawsesaiban_detail"
                            class="form-control text-right" maxlength="2" autocomplete="off"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                        </td>
                        <td class="text-left">
                          <span class="mt-1 text-left">資本金</span>
                        </td>
                      </tr>
                      <!--        <tr>
                                                                                    <td>
                                                                                        <div class="custom-control custom-checkbox custom-control-inline">
                                                                                            <input type="checkbox" id="th44" class="custom-control-input customCheckBox">
                                                                                            <label class="custom-control-label margin_btn_17" for="th44"></label>
                                                                                        </div>
                                                                                    </td>
                                                                                       <td style="width:60px!important;">
                                                                                        <input type="tel" class="form-control" autocomplete="off" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                                                                                    </td>
                                                                                    <td class="text-left">
                                                                                        <span class="mt-1 text-left">会社分類5</span>
                                                                                    </td>
                                                                                </tr>-->

                      <tr>
                        <td>
                          <div class="custom-control custom-checkbox custom-control-inline" style="">
                            <input type="checkbox" name="check_kaiinbango" id="check_kaiinbango"
                              class="custom-control-input customCheckBox">
                            <label class="custom-control-label margin_btn_17" for="check_kaiinbango"></label>
                          </div>
                        </td>
                        <td style="width:60px!important;">
                          <input type="tel" name="kaiinbango" id="setting_kaiinbango" class="form-control text-right"
                            maxlength="2" autocomplete="off"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                        </td>
                        <td class="text-left">
                          <span class="mt-1 text-left">取引開始日 東直</span>
                        </td>
                      </tr>


                      <tr>
                        <td>
                          <div class="custom-control custom-checkbox custom-control-inline" style="">
                            <input type="checkbox" name="check_zokugara" id="check_zokugara"
                              class="custom-control-input customCheckBox">
                            <label class="custom-control-label margin_btn_17" for="check_zokugara"></label>
                          </div>
                        </td>
                        <td style="width:60px!important;">
                          <input type="tel" name="zokugara" id="setting_zokugara" class="form-control text-right"
                            maxlength="2" autocomplete="off"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                        </td>
                        <td class="text-left">
                          <span class="mt-1 text-left">取引開始日 東流</span>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <div class="custom-control custom-checkbox custom-control-inline" style="">
                            <input type="checkbox" name="check_haisoujouhou_name" id="check_haisoujouhou_name"
                              class="custom-control-input customCheckBox">
                            <label class="custom-control-label margin_btn_17" for="check_haisoujouhou_name"></label>
                          </div>
                        </td>
                        <td style="width:60px!important;">
                          <input type="tel" name="haisoujouhou_name" id="setting_haisoujouhou_name"
                            class="form-control text-right" maxlength="2" autocomplete="off"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                        </td>
                        <td class="text-left">
                          <span class="mt-1 text-left">取引開始日 西直</span>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <div class="custom-control custom-checkbox custom-control-inline" style="">
                            <input type="checkbox" name="check_haisoujouhou_yubinbango"
                              id="check_haisoujouhou_yubinbango" class="custom-control-input customCheckBox">
                            <label class="custom-control-label margin_btn_17"
                              for="check_haisoujouhou_yubinbango"></label>
                          </div>
                        </td>
                        <td style="width:60px!important;">
                          <input type="tel" name="haisoujouhou_yubinbango" id="setting_haisoujouhou_yubinbango"
                            class="form-control text-right" maxlength="2" autocomplete="off"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                        </td>
                        <td class="text-left">
                          <span class="mt-1 text-left">取引開始日 西流</span>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <div class="custom-control custom-checkbox custom-control-inline" style="">
                            <input type="checkbox" name="check_haisoujouhou_address_detail"
                              id="check_haisoujouhou_address_detail" class="custom-control-input customCheckBox">
                            <label class="custom-control-label margin_btn_17"
                              for="check_haisoujouhou_address_detail"></label>
                          </div>
                        </td>
                        <td style="width:60px!important;">
                          <input type="tel" name="haisoujouhou_address_detail" id="setting_haisoujouhou_address_detail"
                            class="form-control text-right" maxlength="2" autocomplete="off"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                        </td>
                        <td class="text-left">
                          <span class="mt-1 text-left">単価設定区分</span>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <div class="custom-control custom-checkbox custom-control-inline" style="">
                            <input type="checkbox" name="check_haisoujouhou_tel_detail"
                              id="check_haisoujouhou_tel_detail" class="custom-control-input customCheckBox">
                            <label class="custom-control-label margin_btn_17"
                              for="check_haisoujouhou_tel_detail"></label>
                          </div>
                        </td>
                        <td style="width:60px!important;">
                          <input type="tel" name="haisoujouhou_tel_detail" id="setting_haisoujouhou_tel_detail"
                            class="form-control text-right" maxlength="2" autocomplete="off"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                        </td>
                        <td class="text-left">
                          <span class="mt-1 text-left">支払締め日</span>
                        </td>
                      </tr>

                      <tr>
                        <td>
                          <div class="custom-control custom-checkbox custom-control-inline" style="">
                            <input type="checkbox" name="check_mail" id="check_mail"
                              class="custom-control-input customCheckBox">
                            <label class="custom-control-label margin_btn_17" for="check_mail"></label>
                          </div>
                        </td>
                        <td style="width:60px!important;">
                          <input type="tel" name="mail" id="setting_mail" class="form-control text-right" maxlength="2"
                            autocomplete="off"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                        </td>
                        <td class="text-left">
                          <span class="mt-1 text-left">支払月</span>
                        </td>
                      </tr>

                      <tr>
                        <td>
                          <div class="custom-control custom-checkbox custom-control-inline" style="">
                            <input type="checkbox" name="check_sex" id="check_sex"
                              class="custom-control-input customCheckBox">
                            <label class="custom-control-label margin_btn_17" for="check_sex"></label>
                          </div>
                        </td>
                        <td style="width:60px!important;">
                          <input type="tel" name="sex" id="setting_sex" class="form-control text-right" maxlength="2"
                            autocomplete="off"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                        </td>
                        <td class="text-left">
                          <span class="mt-1 text-left">支払日</span>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <div class="custom-control custom-checkbox custom-control-inline" style="">
                            <input type="checkbox" name="check_bunrui1" id="check_bunrui1"
                              class="custom-control-input customCheckBox">
                            <label class="custom-control-label margin_btn_17" for="check_bunrui1"></label>
                          </div>
                        </td>
                        <td style="width:60px!important;">
                          <input type="tel" name="bunrui1" id="setting_bunrui1" class="form-control text-right"
                            maxlength="2" autocomplete="off"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                        </td>
                        <td class="text-left">
                          <span class="mt-1 text-left">支払日休日設定</span>
                        </td>
                      </tr>


                      <!--                                        <tr>
                                                                                    <td>
                                                                                        <div class="custom-control custom-checkbox custom-control-inline">
                                                                                            <input type="checkbox" id="th56" class="custom-control-input customCheckBox">
                                                                                            <label class="custom-control-label margin_btn_17" for="th56"></label>
                                                                                        </div>
                                                                                    </td>
                                                                                       <td style="width:60px!important;">
                                                                                        <input type="tel" class="form-control" autocomplete="off" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                                                                                    </td>
                                                                                    <td class="text-left">
                                                                                        <span class="mt-1 text-left">振込銀行</span>
                                                                                    </td>
                                                                                </tr>-->
                      <!--                                        <tr>
                                                                                    <td>
                                                                                        <div class="custom-control custom-checkbox custom-control-inline">
                                                                                            <input type="checkbox" id="th57" class="custom-control-input customCheckBox">
                                                                                            <label class="custom-control-label margin_btn_17" for="th57"></label>
                                                                                        </div>
                                                                                    </td>
                                                                                       <td style="width:60px!important;">
                                                                                        <input type="tel" class="form-control" autocomplete="off" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                                                                                    </td>
                                                                                    <td class="text-left">
                                                                                        <span class="mt-1 text-left">振込支店</span>
                                                                                    </td>
                                                                                </tr>-->
                      <!--                                        <tr>
                                                                                    <td>
                                                                                        <div class="custom-control custom-checkbox custom-control-inline">
                                                                                            <input type="checkbox" id="th58" class="custom-control-input customCheckBox">
                                                                                            <label class="custom-control-label margin_btn_17" for="th58"></label>
                                                                                        </div>
                                                                                    </td>
                                                                                       <td style="width:60px!important;">
                                                                                        <input type="tel" class="form-control" autocomplete="off" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                                                                                    </td>
                                                                                    <td class="text-left">
                                                                                        <span class="mt-1 text-left">預金種別</span>
                                                                                    </td>
                                                                                </tr>-->
                      <!--                                        <tr>
                                                                                    <td>
                                                                                        <div class="custom-control custom-checkbox custom-control-inline">
                                                                                            <input type="checkbox" id="th59" class="custom-control-input customCheckBox">
                                                                                            <label class="custom-control-label margin_btn_17" for="th59"></label>
                                                                                        </div>
                                                                                    </td>
                                                                                       <td style="width:60px!important;">
                                                                                        <input type="tel" class="form-control" autocomplete="off" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                                                                                    </td>
                                                                                    <td class="text-left">
                                                                                        <span class="mt-1 text-left">口座番号</span>
                                                                                    </td>
                                                                                </tr>-->
                      <!--                                        <tr>
                                                                                    <td>
                                                                                        <div class="custom-control custom-checkbox custom-control-inline">
                                                                                            <input type="checkbox" id="th60" class="custom-control-input customCheckBox">
                                                                                            <label class="custom-control-label margin_btn_17" for="th60"></label>
                                                                                        </div>
                                                                                    </td>
                                                                                       <td style="width:60px!important;">
                                                                                        <input type="tel" class="form-control" autocomplete="off" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                                                                                    </td>
                                                                                    <td class="text-left">
                                                                                        <span class="mt-1 text-left">口座名義人</span>
                                                                                    </td>
                                                                                </tr>-->


                    </tbody>
                  </table>
                </div>
              </div>


              <div class="col-lg-4 col-md-6 col-sm-6">
                <div class="table-responsive setting_header">
                  <table class="table table-striped  table-bordered">
                    <tbody class="">
                      <tr>
                        <td>
                          <div class="custom-control custom-checkbox custom-control-inline" style="">
                            <input type="checkbox" name="check_bunrui2" id="check_bunrui2"
                              class="custom-control-input customCheckBox">
                            <label class="custom-control-label margin_btn_17" for="check_bunrui2"></label>
                          </div>
                        </td>
                        <td style="width:60px!important;">
                          <input type="tel" name="bunrui2" id="setting_bunrui2" class="form-control text-right"
                            maxlength="2" autocomplete="off"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                        </td>
                        <td class="text-left">
                          <span class="mt-1 text-left">支払振込手数料設定 </span>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <div class="custom-control custom-checkbox custom-control-inline" style="">
                            <input type="checkbox" name="check_bunrui3_detail" id="check_bunrui3_detail"
                              class="custom-control-input customCheckBox">
                            <label class="custom-control-label margin_btn_17" for="check_bunrui3_detail"></label>
                          </div>
                        </td>
                        <td style="width:60px!important;">
                          <input type="tel" name="bunrui3_detail" id="setting_bunrui3_detail"
                            class="form-control text-right" maxlength="2" autocomplete="off"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                        </td>
                        <td class="text-left">
                          <span class="mt-1 text-left">支払方法</span>
                        </td>
                      </tr>
                      <!--               <tr>
                                                                                    <td>
                                                                                        <div class="custom-control custom-checkbox custom-control-inline">
                                                                                            <input type="checkbox" id="th61" class="custom-control-input customCheckBox">
                                                                                            <label class="custom-control-label margin_btn_17" for="th61"></label>
                                                                                        </div>
                                                                                    </td>
                                                                                       <td style="width:60px!important;">
                                                                                        <input type="tel" class="form-control" autocomplete="off" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                                                                                    </td>
                                                                                    <td class="text-left">
                                                                                        <span class="mt-1 text-left">仕向銀行</span>
                                                                                    </td>
                                                                                </tr>-->

                      <!--                                                 <tr>
                                                                                    <td>
                                                                                        <div class="custom-control custom-checkbox custom-control-inline">
                                                                                            <input type="checkbox" id="th62" class="custom-control-input customCheckBox">
                                                                                            <label class="custom-control-label margin_btn_17" for="th62"></label>
                                                                                        </div>
                                                                                    </td>
                                                                                       <td style="width:60px!important;">
                                                                                        <input type="tel" class="form-control" autocomplete="off" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                                                                                    </td>
                                                                                    <td class="text-left">
                                                                                        <span class="mt-1 text-left">仕向支店</span>
                                                                                    </td>
                                                                                </tr>-->
                      <tr>
                        <td>
                          <div class="custom-control custom-checkbox custom-control-inline" style="">
                            <input type="checkbox" name="check_syukeiki_detail" id="check_syukeiki_detail"
                              class="custom-control-input customCheckBox">
                            <label class="custom-control-label margin_btn_17" for="check_syukeiki_detail"></label>
                          </div>
                        </td>
                        <td style="width:60px!important;">
                          <input type="tel" name="syukeiki_detail" id="setting_syukeiki_detail"
                            class="form-control text-right" maxlength="2" autocomplete="off"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                        </td>
                        <td class="text-left">
                          <span class="mt-1 text-left">仕向銀行</span>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <div class="custom-control custom-checkbox custom-control-inline" style="">
                            <input type="checkbox" name="check_bunrui4_detail" id="check_bunrui4_detail"
                              class="custom-control-input customCheckBox">
                            <label class="custom-control-label margin_btn_17" for="check_bunrui4_detail"></label>
                          </div>
                        </td>
                        <td style="width:60px!important;">
                          <input type="tel" name="bunrui4_detail" id="setting_bunrui4_detail"
                            class="form-control text-right" maxlength="2" autocomplete="off"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                        </td>
                        <td class="text-left">
                          <span class="mt-1 text-left">支払税区分</span>
                        </td>
                      </tr>

                      <tr>
                        <td>
                          <div class="custom-control custom-checkbox custom-control-inline" style="">
                            <input type="checkbox" name="check_bunrui5_detail" id="check_bunrui5_detail"
                              class="custom-control-input customCheckBox">
                            <label class="custom-control-label margin_btn_17" for="check_bunrui5_detail"></label>
                          </div>
                        </td>
                        <td style="width:60px!important;">
                          <input type="tel" name="bunrui5_detail" id="setting_bunrui5_detail"
                            class="form-control text-right" maxlength="2" autocomplete="off"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                        </td>
                        <td class="text-left">
                          <span class="mt-1 text-left">支払税端数区分</span>
                        </td>
                      </tr>

                      <tr>
                        <td>
                          <div class="custom-control custom-checkbox custom-control-inline" style="">
                            <input type="checkbox" name="check_bunrui6" id="check_bunrui6"
                              class="custom-control-input customCheckBox">
                            <label class="custom-control-label margin_btn_17" for="check_bunrui6"></label>
                          </div>
                        </td>
                        <td style="width:60px!important;">
                          <input type="tel" name="bunrui6" id="setting_bunrui6" class="form-control text-right"
                            maxlength="2" autocomplete="off"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                        </td>
                        <td class="text-left">
                          <span class="mt-1 text-left">源泉区分</span>
                        </td>
                      </tr>


                      <!--                                        <tr>
                                                                                    <td>
                                                                                        <div class="custom-control custom-checkbox custom-control-inline">
                                                                                            <input type="checkbox" id="th66" class="custom-control-input customCheckBox">
                                                                                            <label class="custom-control-label margin_btn_17" for="th66"></label>
                                                                                        </div>
                                                                                    </td>
                                                                                       <td style="width:60px!important;">
                                                                                        <input type="tel" class="form-control" autocomplete="off" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                                                                                    </td>
                                                                                    <td class="text-left">
                                                                                        <span class="mt-1 text-left">支払先分類1</span>
                                                                                    </td>
                                                                                </tr>-->

                      <!--                                                 <tr>
                                                                                    <td>
                                                                                        <div class="custom-control custom-checkbox custom-control-inline">
                                                                                            <input type="checkbox" id="th67" class="custom-control-input customCheckBox">
                                                                                            <label class="custom-control-label margin_btn_17" for="th67"></label>
                                                                                        </div>
                                                                                    </td>
                                                                                       <td style="width:60px!important;">
                                                                                        <input type="tel" class="form-control" autocomplete="off" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                                                                                    </td>
                                                                                    <td class="text-left">
                                                                                        <span class="mt-1 text-left">支払先分類2</span>
                                                                                    </td>
                                                                                </tr>-->


                      <tr>
                        <td>
                          <div class="custom-control custom-checkbox custom-control-inline" style="">
                            <input type="checkbox" name="check_bunrui9" id="check_bunrui9"
                              class="custom-control-input customCheckBox">
                            <label class="custom-control-label margin_btn_17" for="check_bunrui9"></label>
                          </div>
                        </td>
                        <td style="width:60px!important;">
                          <input type="tel" name="bunrui9" id="setting_bunrui9" class="form-control text-right"
                            autocomplete="off"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                        </td>
                        <td class="text-left">
                          <span class="mt-1 text-left">手形決済月</span>
                        </td>
                      </tr>


                      <tr>
                        <td>
                          <div class="custom-control custom-checkbox custom-control-inline" style="">
                            <input type="checkbox" name="check_bunrui10" id="check_bunrui10"
                              class="custom-control-input customCheckBox">
                            <label class="custom-control-label margin_btn_17" for="check_bunrui10"></label>
                          </div>
                        </td>
                        <td style="width:60px!important;">
                          <input type="tel" name="bunrui10" id="setting_bunrui10" class="form-control text-right"
                            maxlength="2" autocomplete="off"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                        </td>
                        <td class="text-left">
                          <span class="mt-1 text-left">手形決済日</span>
                        </td>
                      </tr>


                      <tr>
                        <td>
                          <div class="custom-control custom-checkbox custom-control-inline" style="">
                            <input type="checkbox" name="check_netusername" id="check_netusername"
                              class="custom-control-input customCheckBox">
                            <label class="custom-control-label margin_btn_17" for="check_netusername"></label>
                          </div>
                        </td>
                        <td style="width:60px!important;">
                          <input type="tel" name="netusername" id="setting_netusername" class="form-control text-right"
                            maxlength="2" autocomplete="off"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                        </td>
                        <td class="text-left">
                          <span class="mt-1 text-left">保守更新案内有無</span>
                        </td>
                      </tr>


                      <tr>
                        <td>
                          <div class="custom-control custom-checkbox custom-control-inline" style="">
                            <input type="checkbox" name="check_netuserpasswd" id="check_netuserpasswd"
                              class="custom-control-input customCheckBox">
                            <label class="custom-control-label margin_btn_17" for="check_netuserpasswd"></label>
                          </div>
                        </td>
                        <td style="width:60px!important;">
                          <input type="tel" name="netuserpasswd" id="setting_netuserpasswd"
                            class="form-control text-right" maxlength="2" autocomplete="off"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                        </td>
                        <td class="text-left">
                          <span class="mt-1 text-left">ライセンス証書有無</span>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <div class="custom-control custom-checkbox custom-control-inline" style="">
                            <input type="checkbox" name="check_netlogin_detail" id="check_netlogin_detail"
                              class="custom-control-input customCheckBox">
                            <label class="custom-control-label margin_btn_17" for="check_netlogin_detail"></label>
                          </div>
                        </td>
                        <td style="width:60px!important;">
                          <input type="tel" name="netlogin_detail" id="setting_netlogin_detail"
                            class="form-control text-right" maxlength="2" autocomplete="off"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                        </td>
                        <td class="text-left">
                          <span class="mt-1 text-left">検収条件</span>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <div class="custom-control custom-checkbox custom-control-inline" style="">
                            <input type="checkbox" name="check_kounyusu" id="check_kounyusu"
                              class="custom-control-input customCheckBox">
                            <label class="custom-control-label margin_btn_17" for="check_kounyusu"></label>
                          </div>
                        </td>
                        <td style="width:60px!important;">
                          <input type="tel" name="kounyusu" id="setting_kounyusu" class="form-control text-right"
                            maxlength="2" autocomplete="off"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                        </td>
                        <td class="text-left">
                          <span class="mt-1 text-left">法人マイナンバー </span>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <div class="custom-control custom-checkbox custom-control-inline" style="">
                            <input type="checkbox" name="check_syukeitukikijun" id="check_syukeitukikijun"
                              class="custom-control-input customCheckBox">
                            <label class="custom-control-label margin_btn_17" for="check_syukeitukikijun"></label>
                          </div>
                        </td>
                        <td style="width:60px!important;">
                          <input type="tel" name="syukeitukikijun" id="setting_syukeitukikijun"
                            class="form-control text-right" autocomplete="off"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                        </td>
                        <td class="text-left">
                          <span class="mt-1 text-left">会計取引先CD</span>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <div class="custom-control custom-checkbox custom-control-inline" style="">
                            <input type="checkbox" name="check_syukeituki" id="check_syukeituki"
                              class="custom-control-input customCheckBox">
                            <label class="custom-control-label margin_btn_17" for="check_syukeituki"></label>
                          </div>
                        </td>
                        <td style="width:60px!important;">
                          <input type="tel" name="syukeituki" id="setting_syukeituki" class="form-control text-right"
                            maxlength="2" autocomplete="off"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                        </td>
                        <td class="text-left">
                          <span class="mt-1 text-left">売上区分</span>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <div class="custom-control custom-checkbox custom-control-inline" style="">
                            <input type="checkbox" name="check_syukeikikijun" id="check_syukeikikijun"
                              class="custom-control-input customCheckBox">
                            <label class="custom-control-label margin_btn_17" for="check_syukeikikijun"></label>
                          </div>
                        </td>
                        <td style="width:60px!important;">
                          <input type="tel" name="syukeikikijun" id="setting_syukeikikijun"
                            class="form-control text-right" maxlength="2" autocomplete="off"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                        </td>
                        <td class="text-left">
                          <span class="mt-1 text-left">仕入区分</span>
                        </td>
                      </tr>


                      <tr>
                        <td>
                          <div class="custom-control custom-checkbox custom-control-inline" style="">
                            <input type="checkbox" name="check_datatxt0050" id="check_datatxt0050"
                              class="custom-control-input customCheckBox">
                            <label class="custom-control-label margin_btn_17" for="check_datatxt0050"></label>
                          </div>
                        </td>
                        <td style="width:60px!important;">
                          <input type="tel" name="datatxt0050" id="setting_datatxt0050" class="form-control text-right"
                            maxlength="2" autocomplete="off"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                        </td>
                        <td class="text-left">
                          <span class="mt-1 text-left">会社名カナ入金消込用</span>
                        </td>
                      </tr>

                      <tr>
                        <td>
                          <div class="custom-control custom-checkbox custom-control-inline" style="">
                            <input type="checkbox" name="check_datatxt0051" id="check_datatxt0051"
                              class="custom-control-input customCheckBox">
                            <label class="custom-control-label margin_btn_17" for="check_datatxt0051"></label>
                          </div>
                        </td>
                        <td style="width:60px!important;">
                          <input type="tel" name="datatxt0051" id="setting_datatxt0051" class="form-control text-right"
                            maxlength="2" autocomplete="off"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                        </td>
                        <td class="text-left">
                          <span class="mt-1 text-left">請求消費税計算区分</span>
                        </td>
                      </tr>

                      <tr>
                        <td>
                          <div class="custom-control custom-checkbox custom-control-inline" style="">
                            <input type="checkbox" name="check_datatxt0052" id="check_datatxt0052"
                              class="custom-control-input customCheckBox">
                            <label class="custom-control-label margin_btn_17" for="check_datatxt0052"></label>
                          </div>
                        </td>
                        <td style="width:60px!important;">
                          <input type="tel" name="datatxt0052" id="setting_datatxt0052" class="form-control text-right"
                            maxlength="2" autocomplete="off"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                        </td>
                        <td class="text-left">
                          <span class="mt-1 text-left">仕入消費税計算区分</span>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <div class="custom-control custom-checkbox custom-control-inline" style="">
                            <input type="checkbox" name="check_created_date" id="check_created_date"
                              class="custom-control-input customCheckBox">
                            <label class="custom-control-label margin_btn_17" for="check_created_date"></label>
                          </div>
                        </td>
                        <td style="width:60px!important;">
                          <input type="tel" name="created_date" id="setting_created_date"
                            class="form-control text-right" maxlength="2" autocomplete="off"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                        </td>
                        <td class="text-left">
                          <span class="mt-1 text-left">登録年月日</span>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <div class="custom-control custom-checkbox custom-control-inline" style="">
                            <input type="checkbox" name="check_created_time" id="check_created_time"
                              class="custom-control-input customCheckBox">
                            <label class="custom-control-label margin_btn_17" for="check_created_time"></label>
                          </div>
                        </td>
                        <td style="width:60px!important;">
                          <input type="tel" name="created_time" id="setting_created_time"
                            class="form-control text-right" maxlength="2" autocomplete="off"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                        </td>
                        <td class="text-left">
                          <span class="mt-1 text-left">登録時刻</span>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <div class="custom-control custom-checkbox custom-control-inline" style="">
                            <input type="checkbox" name="check_edited_date" id="check_edited_date"
                              class="custom-control-input customCheckBox">
                            <label class="custom-control-label margin_btn_17" for="check_edited_date"></label>
                          </div>
                        </td>
                        <td style="width:60px!important;">
                          <input type="tel" name="edited_date" id="setting_edited_date" class="form-control text-right"
                            maxlength="2" autocomplete="off"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                        </td>
                        <td class="text-left">
                          <span class="mt-1 text-left">更新年月日</span>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <div class="custom-control custom-checkbox custom-control-inline" style="">
                            <input type="checkbox" name="check_edited_time" id="check_edited_time"
                              class="custom-control-input customCheckBox">
                            <label class="custom-control-label margin_btn_17" for="check_edited_time"></label>
                          </div>
                        </td>
                        <td style="width:60px!important;">
                          <input type="tel" name="edited_time" id="setting_edited_time" class="form-control text-right"
                            maxlength="2" autocomplete="off"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                        </td>
                        <td class="text-left">
                          <span class="mt-1 text-left">更新時刻</span>
                        </td>
                      </tr>

                      <tr>
                        <td>
                          <div class="custom-control custom-checkbox custom-control-inline" style="">
                            <input type="checkbox" name="check_sekessaihouhou" id="check_sekessaihouhou"
                              class="custom-control-input customCheckBox">
                            <label class="custom-control-label margin_btn_17" for="check_sekessaihouhou"></label>
                          </div>
                        </td>
                        <td style="width:60px!important;">
                          <input type="tel" name="sekessaihouhou" id="setting_sekessaihouhou"
                            class="form-control text-right" maxlength="2" autocomplete="off"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                        </td>
                        <td class="text-left">
                          <span class="mt-1 text-left">更新時端末IP</span>
                        </td>
                      </tr>

                      <tr>
                        <td>
                          <div class="custom-control custom-checkbox custom-control-inline" style="">
                            <input type="checkbox" name="check_user_name" id="check_user_name"
                              class="custom-control-input customCheckBox">
                            <label class="custom-control-label margin_btn_17" for="check_user_name"></label>
                          </div>
                        </td>
                        <td style="width:60px!important;">
                          <input type="tel" name="user_name" id="setting_user_name" class="form-control text-right"
                            maxlength="2" autocomplete="off"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');"
                            onkeydown="lastTab1_comptbl_setting(event)">
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

          <div class="modal-footer">
            <a id="tableSettingSubmit" type="button" class="btn btn-info"><i class="fas fa-save"
                style="margin-right: 5px;"></i>保存
            </a>
          </div>
        </div>


      </div>
    </div>
  </div>
</form>

<script type="text/javascript">
  // Settings Modal
    $('#setting_display_modal').on('shown.bs.modal', function () {
        $("#setting_name").focus();
    });
</script>

<script src="https://ajax.aspnetcdn.com/ajax/knockout/knockout-2.2.1.js" type="text/javascript"></script>

<script type="text/javascript">
  function lastTab1_comptbl_setting(event) {
        if (event.keyCode == 13) {
            document.getElementById("check_name").focus();
            event.preventDefault();
        }
    }

    // document.onkeydown = function (event) {
    //   if(event.shiftKey && event.keyCode == 13)
    //   {
    //     return false;
    //   }
    // }


</script>
<script>
  $("textarea").keydown(function (event) {
        if (event.keyCode == 13 && !e.shiftKey) {
            event.preventDefault();

        }


    });
</script>
<script>
  ko.bindingHandlers.nextFieldOnEnter = {
        init: function (element, valueAccessor, allBindingsAccessor) {
            $(element).on('keydown', 'input,textarea, select', function (e) {
                var self = $(this)
                    , form = $(element)
                    , focusable
                    , next
                ;

                if (e.keyCode == 13 && !e.shiftKey) {
                    focusable = form.find('input,a,select,textarea,button').filter(':visible');
                    var nextIndex = focusable.index(this) == focusable.length - 1 ? 0 : focusable.index(this) + 1;
                    next = focusable.eq(nextIndex);
                    next.focus();
                    return false;
                }
                if (e.keyCode == 9) {
                    e.preventDefault();
                }
            });
        }
    };

    ko.applyBindings({});

</script>
<script type="text/javascript">
  $(document).ready(function () {
        $('#tableSetting').attr('autocomplete', 'off');
    });
</script>