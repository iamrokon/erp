<!-- ============================new moda1 end here ======================= -->
<form id="tableSetting" action="{{ route('officeMasterTableSetting',$bango) }}">
  @csrf
  <input type="hidden" name="redirect_path" value="officeMasterReload">
  <div class="modal" data-keyboard="false" data-backdrop="static" id="setting_display_modal" role="dialog"
    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog" role="document" style="max-width: 900px;">

      <div class="modal-content">
        <div class="modal-header">
          <h6 class="modal-title" id="exampleModalLabel"></h6>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body" data-bind="nextFieldOnEnter:true">


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

          {{--                    <script type="text/javascript">--}}
          {{--                        var state = false; // desecelted--}}

          {{--                        $('.checkall').click(function () {--}}

          {{--                            $('.customCheckBox').each(function () {--}}
          {{--                                if (!state) {--}}
          {{--                                    this.checked = true;--}}
          {{--                                }--}}
          {{--                            });--}}

          {{--                            //switch--}}
          {{--                            if (state) {--}}
          {{--                                state = false;--}}
          {{--                            }--}}

          {{--                        });--}}

          {{--                        //Unchecked....--}}
          {{--                        $('.uncheck').click(function () {--}}
          {{--                            $('.customCheckBox').each(function () {--}}
          {{--                                if (!state) {--}}
          {{--                                    this.checked = false;--}}
          {{--                                    $("input[type='tel']").val("");--}}
          {{--                                }--}}
          {{--                            });--}}
          {{--                        });--}}

          {{--                    </script>--}}
          <div id="errorShow">

          </div>
          <div id="setting_input_boxwrap_office" data-bind="nextFieldOnEnter:true">
            <div class="row">
              <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="table-responsive setting_header">
                  <table class="table table-striped  table-bordered">
                    <tbody class="">

                      <tr>
                        <td>
                          <div class="custom-control custom-checkbox custom-control-inline" style="  ">
                            <input type="checkbox" id="check_shikibetsucodename" class="custom-control-input"
                              checked="checked" disabled="disabled">
                            <input type="hidden" name="check_shikibetsucodename" value="on">
                            <label class="custom-control-label margin_btn_17" for="check_shikibetsucodename"></label>

                          </div>
                        </td>
                        <td style="width:60px!important;">
                          <input type="text" name="shikibetsucodename" id="setting_shikibetsucodename"
                            class="form-control text-right" value="0" maxlength="2" readonly="readonly"
                            autocomplete="off"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                        </td>
                        <td class="text-left">
                          <span class="mt-1 text-left">会社CD</span>
                        </td>
                      </tr>


                      <tr>
                        <td>
                          <div class="custom-control custom-checkbox custom-control-inline" style="  ">
                            <input type="checkbox" name="check_torihikisakibango" id="check_torihikisakibango"
                              class="custom-control-input customCheckBox">
                            <label class="custom-control-label margin_btn_17" for="check_torihikisakibango"></label>
                          </div>
                        </td>
                        <td style="width:60px!important;">
                          <input type="tel" name="torihikisakibango" id="setting_torihikisakibango"
                            class="form-control text-right" maxlength="2" value="" autocomplete="off"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                        </td>
                        <td class="text-left">
                          <span class="mt-1 text-left">事業所CD</span>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <div class="custom-control custom-checkbox custom-control-inline" style="  ">
                            <input type="checkbox" name="check_name" id="check_name"
                              class="custom-control-input customCheckBox">
                            <label class="custom-control-label margin_btn_17" for="check_name"></label>
                          </div>
                        </td>
                        <td style="width:60px!important;">
                          <input type="tel" name="name" id="setting_name" class="form-control text-right" maxlength="2"
                            autocomplete="off"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                        </td>
                        <td class="text-left">
                          <span class="mt-1 text-left">事業所名</span>
                        </td>
                      </tr>
                      <!--  <tr>
                                           <td>
                                               <div class="custom-control custom-checkbox custom-control-inline">
                                                   <input type="checkbox" name="check_haisoumoji1" id="check_haisoumoji1" class="custom-control-input customCheckBox">
                                                   <label class="custom-control-label margin_btn_17" for="check_haisoumoji1"></label>
                                               </div>
                                           </td>
                                              <td style="width:60px!important;">
                                               <input type="tel" name="haisoumoji1" id="setting_haisoumoji1" class="form-control" autocomplete="off" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                                           </td>
                                           <td class="text-left">
                                               <span class="mt-1 text-left">事業所名略称</span>
                                           </td>
                                       </tr> -->
                      <tr>
                        <td>
                          <div class="custom-control custom-checkbox custom-control-inline" style="  ">
                            <input type="checkbox" name="check_haisoumoji1" id="check_haisoumoji1"
                              class="custom-control-input customCheckBox">
                            <label class="custom-control-label margin_btn_17" for="check_haisoumoji1"></label>
                          </div>
                        </td>
                        <td style="width:60px!important;">
                          <input type="tel" name="haisoumoji1" id="setting_haisoumoji1" class="form-control text-right"
                            maxlength="2" autocomplete="off"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                        </td>
                        <td class="text-left">
                          <span class="mt-1 text-left">事業所名略称</span>
                        </td>
                      </tr>

                      <tr>
                        <td>
                          <div class="custom-control custom-checkbox custom-control-inline" style="  ">
                            <input type="checkbox" name="check_torihikisakirank1jouhou"
                              id="check_torihikisakirank1jouhou" class="custom-control-input customCheckBox">
                            <label class="custom-control-label margin_btn_17"
                              for="check_torihikisakirank1jouhou"></label>
                          </div>
                        </td>
                        <td style="width:60px!important;">
                          <input type="tel" name="torihikisakirank1jouhou" id="setting_torihikisakirank1jouhou"
                            class="form-control text-right" maxlength="2" autocomplete="off"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                        </td>
                        <td class="text-left">
                          <span class="mt-1 text-left">入力区分</span>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <div class="custom-control custom-checkbox custom-control-inline" style="  ">
                            <input type="checkbox" name="check_syukeitukikijunwithname"
                              id="check_syukeitukikijunwithname" class="custom-control-input customCheckBox">
                            <label class="custom-control-label margin_btn_17"
                              for="check_syukeitukikijunwithname"></label>
                          </div>
                        </td>
                        <td style="width:60px!important;">
                          <input type="tel" name="syukeitukikijunwithname" id="setting_syukeitukikijunwithname"
                            class="form-control text-right" maxlength="2" autocomplete="off"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                        </td>
                        <td class="text-left">
                          <span class="mt-1 text-left">担当SA1</span>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <div class="custom-control custom-checkbox custom-control-inline" style="  ">
                            <input type="checkbox" name="check_syukeitukiwithname" id="check_syukeitukiwithname"
                              class="custom-control-input customCheckBox">
                            <label class="custom-control-label margin_btn_17" for="check_syukeitukiwithname"></label>
                          </div>
                        </td>
                        <td style="width:60px!important;">
                          <input type="tel" name="syukeitukiwithname" id="setting_syukeitukiwithname"
                            class="form-control text-right" maxlength="2" autocomplete="off"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                        </td>
                        <td class="text-left">
                          <span class="mt-1 text-left">担当SA2</span>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <div class="custom-control custom-checkbox custom-control-inline" style="  ">
                            <input type="checkbox" name="check_syukeikikijunwithname" id="check_syukeikikijunwithname"
                              class="custom-control-input customCheckBox">
                            <label class="custom-control-label margin_btn_17" for="check_syukeikikijunwithname"></label>
                          </div>
                        </td>
                        <td style="width:60px!important;">
                          <input type="tel" name="syukeikikijunwithname" id="setting_syukeikikijunwithname"
                            class="form-control text-right" maxlength="2" autocomplete="off"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                        </td>
                        <td class="text-left">
                          <span class="mt-1 text-left">担当SE1</span>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <div class="custom-control custom-checkbox custom-control-inline" style="  ">
                            <input type="checkbox" name="check_syukeinenkijunwithname" id="check_syukeinenkijunwithname"
                              class="custom-control-input customCheckBox">
                            <label class="custom-control-label margin_btn_17"
                              for="check_syukeinenkijunwithname"></label>
                          </div>
                        </td>
                        <td style="width:60px!important;">
                          <input type="tel" name="syukeinenkijunwithname" id="setting_syukeinenkijunwithname"
                            class="form-control text-right" maxlength="2" autocomplete="off"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                        </td>
                        <td class="text-left">
                          <span class="mt-1 text-left">担当SE2</span>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <div class="custom-control custom-checkbox custom-control-inline" style="  ">
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
                          <span class="mt-1 text-left">郵便番号</span>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <div class="custom-control custom-checkbox custom-control-inline" style="  ">
                            <input type="checkbox" name="check_address1" id="check_address1"
                              class="custom-control-input customCheckBox">
                            <label class="custom-control-label margin_btn_17" for="check_address1"></label>
                          </div>
                        </td>
                        <td style="width:60px!important;">
                          <input type="tel" name="address1" id="setting_address1" class="form-control text-right"
                            maxlength="2" autocomplete="off"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                        </td>
                        <td class="text-left">
                          <span class="mt-1 text-left">都道府県名</span>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <div class="custom-control custom-checkbox custom-control-inline" style="  ">
                            <input type="checkbox" name="check_address2" id="check_address2"
                              class="custom-control-input customCheckBox">
                            <label class="custom-control-label margin_btn_17" for="check_address2"></label>
                          </div>
                        </td>
                        <td style="width:60px!important;">
                          <input type="tel" name="address2" id="setting_address2" class="form-control text-right"
                            maxlength="2" autocomplete="off"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                        </td>
                        <td class="text-left">
                          <span class="mt-1 text-left">市区町村名</span>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <div class="custom-control custom-checkbox custom-control-inline" style="  ">
                            <input type="checkbox" name="check_address3" id="check_address3"
                              class="custom-control-input customCheckBox">
                            <label class="custom-control-label margin_btn_17" for="check_address3"></label>
                          </div>
                        </td>
                        <td style="width:60px!important;">
                          <input type="tel" name="address3" id="setting_address3" class="form-control text-right"
                            maxlength="2" autocomplete="off"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                        </td>
                        <td class="text-left">
                          <span class="mt-1 text-left">町域名</span>
                        </td>
                      </tr>


                      <tr>
                        <td>
                          <div class="custom-control custom-checkbox custom-control-inline" style="  ">
                            <input type="checkbox" name="check_address4" id="check_address4"
                              class="custom-control-input customCheckBox">
                            <label class="custom-control-label margin_btn_17" for="check_address4"></label>
                          </div>
                        </td>
                        <td style="width:60px!important;">
                          <input type="tel" name="address4" id="setting_address4" class="form-control text-right"
                            maxlength="2" autocomplete="off"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                        </td>
                        <td class="text-left">
                          <span class="mt-1 text-left">番地・建物名</span>
                        </td>
                      </tr>

                      <tr>
                        <td>
                          <div class="custom-control custom-checkbox custom-control-inline" style="  ">
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
                          <span class="mt-1 text-left">TEL</span>
                        </td>
                      </tr>

                      <tr>
                        <td>
                          <div class="custom-control custom-checkbox custom-control-inline" style="  ">
                            <input type="checkbox" name="check_torihikisakirank2" id="check_torihikisakirank2"
                              class="custom-control-input customCheckBox">
                            <label class="custom-control-label margin_btn_17" for="check_torihikisakirank2"></label>
                          </div>
                        </td>
                        <td style="width:60px!important;">
                          <input type="tel" name="torihikisakirank2" id="setting_torihikisakirank2"
                            class="form-control text-right" maxlength="2" autocomplete="off"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                        </td>
                        <td class="text-left">
                          <span class="mt-1 text-left">FAX</span>
                        </td>
                      </tr>

                      <tr>
                        <td>
                          <div class="custom-control custom-checkbox custom-control-inline" style="  ">
                            <input type="checkbox" name="check_yobi1" id="check_yobi1"
                              class="custom-control-input customCheckBox">
                            <label class="custom-control-label margin_btn_17" for="check_yobi1"></label>
                          </div>
                        </td>
                        <td style="width:60px!important;">
                          <input type="tel" name="yobi1" id="setting_yobi1" class="form-control text-right"
                            maxlength="2" autocomplete="off"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                        </td>
                        <td class="text-left">
                          <span class="mt-1 text-left">JIS市区町村ｺｰﾄ</span>
                        </td>
                      </tr>

                      <tr>
                        <td>
                          <div class="custom-control custom-checkbox custom-control-inline" style="  ">
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
                          <span class="mt-1 text-left">メールアドレス</span>
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
                          <div class="custom-control custom-checkbox custom-control-inline" style="  ">
                            <input type="checkbox" name="check_syukeiki" id="check_syukeiki"
                              class="custom-control-input customCheckBox">
                            <label class="custom-control-label margin_btn_17" for="check_syukeiki"></label>
                          </div>
                        </td>
                        <td style="width:60px!important;">
                          <input type="tel" name="syukeiki" id="setting_syukeiki" class="form-control text-right"
                            maxlength="2" autocomplete="off"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                        </td>
                        <td class="text-left">
                          <span class="mt-1 text-left">請求先ｺｰﾄﾞ</span>
                        </td>
                      </tr>

                      <tr>
                        <td>
                          <div class="custom-control custom-checkbox custom-control-inline" style="  ">
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
                          <div class="custom-control custom-checkbox custom-control-inline" style="  ">
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
                          <div class="custom-control custom-checkbox custom-control-inline" style="  ">
                            <input type="checkbox" name="check_updated_date" id="check_updated_date"
                              class="custom-control-input customCheckBox">
                            <label class="custom-control-label margin_btn_17" for="check_updated_date"></label>
                          </div>
                        </td>
                        <td style="width:60px!important;">
                          <input type="tel" name="updated_date" id="setting_updated_date"
                            class="form-control text-right" maxlength="2" autocomplete="off"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                        </td>
                        <td class="text-left">
                          <span class="mt-1 text-left">更新年月日</span>
                        </td>
                      </tr>

                      <tr>
                        <td>
                          <div class="custom-control custom-checkbox custom-control-inline" style="  ">
                            <input type="checkbox" name="check_updated_time" id="check_updated_time"
                              class="custom-control-input customCheckBox">
                            <label class="custom-control-label margin_btn_17" for="check_updated_time"></label>
                          </div>
                        </td>
                        <td style="width:60px!important;">
                          <input type="tel" name="updated_time" id="setting_updated_time"
                            class="form-control text-right" maxlength="2" autocomplete="off"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                        </td>
                        <td class="text-left">
                          <span class="mt-1 text-left">更新時刻</span>
                        </td>
                      </tr>

                      <tr>
                        <td>
                          <div class="custom-control custom-checkbox custom-control-inline" style="  ">
                            <input type="checkbox" name="check_netlogin" id="check_netlogin"
                              class="custom-control-input customCheckBox">
                            <label class="custom-control-label margin_btn_17" for="check_netlogin"></label>
                          </div>
                        </td>
                        <td style="width:60px!important;">
                          <input type="tel" name="netlogin" id="setting_netlogin" class="form-control text-right"
                            maxlength="2" autocomplete="off"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                        </td>
                        <td class="text-left">
                          <span class="mt-1 text-left">更新時端末IP</span>
                        </td>
                      </tr>

                      <tr>
                        <td>
                          <div class="custom-control custom-checkbox custom-control-inline" style="  ">
                            <input type="checkbox" name="check_user_name" id="check_user_name"
                              class="custom-control-input customCheckBox">
                            <label class="custom-control-label margin_btn_17" for="check_user_name"></label>
                          </div>
                        </td>
                        <td style="width:60px!important;">
                          <input type="tel" name="user_name" id="setting_user_name" class="form-control text-right"
                            maxlength="2" onkeydown="lastTab1_office(event)" autocomplete="off"
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
          <a type="button" class="btn btn-info" id="tableSettingSubmit"><i class="fas fa-save"
              style="margin-right: 5px;"></i>保存</a>
        </div>
      </div>

    </div>
  </div>
</form>

<script type="text/javascript">
  function lastTab1_office(event) {
        if (event.keyCode == 13) {
            document.getElementById("check_torihikisakibango").focus();
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
<script src="https://ajax.aspnetcdn.com/ajax/knockout/knockout-2.2.1.js" type="text/javascript"></script>


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