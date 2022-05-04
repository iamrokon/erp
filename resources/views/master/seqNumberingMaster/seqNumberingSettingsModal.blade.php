<form id="tableSetting" action="{{ route('seqNumberingMasterTableSetting',$bango) }}">
  @csrf
  <input type="hidden" name="redirect_path" value="seqNumberingMasterReload">
  <div class="modal fade" data-keyboard="false" data-backdrop="static" id="setting_display_modal" role="dialog"
    aria-labelledby="exampleModalCenterTitle" style="display: none;" aria-hidden="true">
    <div class="modal-dialog " role="document" style="">
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
          {{--                    </script>--}}
          <div id="errorShow">

          </div>
          <div id="setting_input_boxwrap_seq" data-bind="nextFieldOnEnter:true">
            <div class="row">
              <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="table-responsive setting_header">
                  <table class="table table-striped  table-bordered">
                    <tbody class="">
                      <tr>
                        <td>
                          <div class="custom-control custom-checkbox custom-control-inline"
                            style="margin-left: 11px!important;">
                            <input type="checkbox" id="check_kokyakusyouhinbango" class="custom-control-input"
                              checked="checked" disabled="disabled">
                            <input type="hidden" name="check_kokyakusyouhinbango" value="on">
                            <label class="custom-control-label margin_btn_17" for="check_kokyakusyouhinbango"></label>

                          </div>
                        </td>
                        <td style="width:60px!important;">
                          <input type="text" name="kokyakusyouhinbango" id="setting_kokyakusyouhinbango"
                            class="form-control text-right" maxlength="2" value="0" readonly="readonly"
                            autocomplete="off"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                        </td>
                        <td class="text-left">
                          <span class="mt-1 text-left">番号区分</span>
                        </td>
                      </tr>

                      <tr>
                        <td>
                          <div class="custom-control custom-checkbox custom-control-inline"
                            style="margin-left: 11px!important;">
                            <input type="checkbox" name="check_orderbango" id="check_orderbango"
                              class="custom-control-input customCheckBox">
                            <label class="custom-control-label margin_btn_17" for="check_orderbango"></label>
                          </div>
                        </td>
                        <td style="width:60px!important;">
                          <input type="tel" name="orderbango" id="setting_orderbango" class="form-control text-right"
                            maxlength="2" value="" autocomplete="off"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                        </td>
                        <td class="text-left">
                          <span class="mt-1 text-left">番号</span>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <div class="custom-control custom-checkbox custom-control-inline"
                            style="margin-left: 11px!important;">
                            <input type="checkbox" name="check_mobile_flag" id="check_mobile_flag"
                              class="custom-control-input customCheckBox">
                            <label class="custom-control-label margin_btn_17" for="check_mobile_flag"></label>
                          </div>
                        </td>
                        <td style="width:60px!important;">
                          <input type="tel" name="mobile_flag" id="setting_mobile_flag" class="form-control text-right"
                            maxlength="2" autocomplete="off"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                        </td>
                        <td class="text-left">
                          <span class="mt-1 text-left">番号総桁数</span>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <div class="custom-control custom-checkbox custom-control-inline"
                            style="margin-left: 11px!important;">
                            <input type="checkbox" type="checkbox" name="check_created_date" id="check_created_date"
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
                          <div class="custom-control custom-checkbox custom-control-inline"
                            style="margin-left: 11px!important;">
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
                          <div class="custom-control custom-checkbox custom-control-inline"
                            style="margin-left: 11px!important;">
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
                          <div class="custom-control custom-checkbox custom-control-inline"
                            style="margin-left: 11px!important;">
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
                          <div class="custom-control custom-checkbox custom-control-inline"
                            style="margin-left: 11px!important;">
                            <input type="checkbox" name="check_size" id="check_size"
                              class="custom-control-input customCheckBox">
                            <label class="custom-control-label margin_btn_17" for="check_size"></label>
                          </div>
                        </td>
                        <td style="width:60px!important;">
                          <input type="tel" name="size" id="setting_size" class="form-control text-right" maxlength="2"
                            autocomplete="off"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                        </td>
                        <td class="text-left">
                          <span class="mt-1 text-left">更新時端末IP</span>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <div class="custom-control custom-checkbox custom-control-inline"
                            style="margin-left: 11px!important;">
                            <input type="checkbox" name="check_user_name" id="check_user_name"
                              class="custom-control-input customCheckBox">
                            <label class="custom-control-label margin_btn_17" for="check_user_name"></label>
                          </div>
                        </td>
                        <td style="width:60px!important;">
                          <input type="tel" name="user_name" id="setting_user_name" class="form-control text-right"
                            maxlength="2" autocomplete="off"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');"
                            onkeydown="lastTab1_product(event)">
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
          <a type="button" id="tableSettingSubmit" class="btn btn-info"><i class="fas fa-save"
              style="margin-right: 5px;"></i>保存
          </a>
        </div>
      </div>
    </div>
  </div>
</form>

<script src="https://ajax.aspnetcdn.com/ajax/knockout/knockout-2.2.1.js" type="text/javascript"></script>

<script type="text/javascript">
  function lastTab1_product(event) {
        if (event.keyCode == 13) {
            document.getElementById("check_orderbango").focus();
            event.preventDefault();
        }
    }

    document.onkeydown = function (event) {
        if (event.shiftKey && event.keyCode == 13) {
            return false;
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