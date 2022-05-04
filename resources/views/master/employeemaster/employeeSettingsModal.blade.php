<style>
    /* settings checkbox postion fixing */
    /*.custom-control {
          margin-left: 21px !important;
          margin-top: 3px !important;
        }*/
</style>
<!-- ============================new moda1 end here ======================= -->
<form id="tableSetting" action="{{ route('employeeMasterTableSetting',$bango) }}">
    @csrf
    <input type="hidden" name="redirect_path" value="employeeMasterReload">
    <div class="modal" data-keyboard="false" data-backdrop="static" id="setting_display_modal" tabindex="-1"
         role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog" role="document" style="max-width: 800px;">

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
                    {{--<script type="text/javascript">--}}
                    {{--var state = false; // desecelted--}}

                    {{--$('.checkall').click(function () {--}}
                    {{--$('.customCheckBox').each(function () {--}}
                    {{--if (!state) {--}}
                    {{--this.checked = true;--}}
                    {{--}--}}
                    {{--});--}}


                    {{--});--}}


                    {{--//Unchecked....--}}
                    {{--$('.uncheck').click(function () {--}}
                    {{--$('.customCheckBox').each(function () {--}}
                    {{--if (!state) {--}}
                    {{--this.checked = false;--}}
                    {{--$("input[type='tel']").val("");--}}
                    {{--//$("input[type=text], textarea").val("");--}}
                    {{--}--}}
                    {{--});--}}


                    {{--});--}}
                    {{--</script>--}}
                    <div id="errorShow">

                    </div>
                    <!-- <div id="emp_tbl_setting" > -->

                    <div class="row" data-bind="nextFieldOnEnter:true">
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="table-responsive setting_header">
                                <table class="table table-striped  table-bordered">
                                    <tbody class="">

                                    <tr>
                                        <td>
                                            <div class="custom-control custom-checkbox custom-control-inline"
                                                 style="margin-left: 21px !important;">
                                                <input type="checkbox" id="check_bango" class="custom-control-input"
                                                       checked="checked" disabled="disabled">
                                                <input type="hidden" name="check_bango" value="on">
                                                <label class="custom-control-label margin_btn_17"
                                                       for="check_bango"></label>

                                            </div>
                                        </td>
                                        <td style="width:60px!important;">
                                            <input type="text" name="bango" id="setting_bango"
                                                   class="form-control text-right" maxlength="2" value="0"
                                                   readonly="readonly" autocomplete="off" autocomplete="off"
                                                   oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                                        </td>
                                        <td class="text-left">
                                            <span class="mt-1 text-left">社員CD</span>
                                        </td>
                                    </tr>


                                    <tr>
                                        <td>
                                            <div class="custom-control custom-checkbox custom-control-inline"
                                                 style="margin-left: 21px !important;">
                                                <input type="checkbox" name="check_name" id="check_name"
                                                       class="custom-control-input customCheckBox">
                                                <label class="custom-control-label margin_btn_17"
                                                       for="check_name"></label>
                                            </div>
                                        </td>
                                        <td style="width:60px!important;">
                                            <input type="tel" name="name" id="setting_name"
                                                   class="form-control text-right" maxlength="2" value=""
                                                   autocomplete="off"
                                                   oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                                        </td>
                                        <td class="text-left">
                                            <span class="mt-1 text-left">社員名</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="custom-control custom-checkbox custom-control-inline"
                                                 style="margin-left: 21px !important;">
                                                <input type="checkbox" name="check_htanka" id="check_htanka"
                                                       class="custom-control-input customCheckBox">
                                                <label class="custom-control-label margin_btn_17"
                                                       for="check_htanka"></label>
                                            </div>
                                        </td>
                                        <td style="width:60px!important;">
                                            <input type="tel" name="htanka" id="setting_htanka"
                                                   class="form-control text-right" maxlength="2" autocomplete="off"
                                                   oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                                        </td>
                                        <td class="text-left">
                                            <span class="mt-1 text-left">給与社員CD</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="custom-control custom-checkbox custom-control-inline"
                                                 style="margin-left: 21px !important;">
                                                <input type="checkbox" name="check_ztanka" id="check_ztanka"
                                                       class="custom-control-input customCheckBox">
                                                <label class="custom-control-label margin_btn_17"
                                                       for="check_ztanka"></label>
                                            </div>
                                        </td>
                                        <td style="width:60px!important;">
                                            <input type="tel" name="ztanka" id="setting_ztanka"
                                                   class="form-control text-right" maxlength="2" autocomplete="off"
                                                   oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                                        </td>
                                        <td class="text-left">
                                            <span class="mt-1 text-left">事業年度（期）</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="custom-control custom-checkbox custom-control-inline"
                                                 style="margin-left: 21px !important;">
                                                <input type="checkbox" name="check_company_1" id="check_company_1"
                                                       class="custom-control-input customCheckBox">
                                                <label class="custom-control-label margin_btn_17"
                                                       for="check_company_1"></label>
                                            </div>
                                        </td>
                                        <td style="width:60px!important;">
                                            <input type="tel" name="company_1" id="setting_company_1"
                                                   class="form-control text-right" maxlength="2" autocomplete="off"
                                                   oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                                        </td>
                                        <td class="text-left">
                                            <span class="mt-1 text-left">事業部</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="custom-control custom-checkbox custom-control-inline"
                                                 style="margin-left: 21px !important;">
                                                <input type="checkbox" name="check_company_2" id="check_company_2"
                                                       class="custom-control-input customCheckBox">
                                                <label class="custom-control-label margin_btn_17"
                                                       for="check_company_2"></label>
                                            </div>
                                        </td>
                                        <td style="width:60px!important;">
                                            <input type="tel" name="company_2" id="setting_company_2"
                                                   class="form-control text-right" maxlength="2" autocomplete="off"
                                                   oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                                        </td>
                                        <td class="text-left">
                                            <span class="mt-1 text-left">部</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="custom-control custom-checkbox custom-control-inline"
                                                 style="margin-left: 21px !important;">
                                                <input type="checkbox" name="check_company_3" id="check_company_3"
                                                       class="custom-control-input customCheckBox">
                                                <label class="custom-control-label margin_btn_17"
                                                       for="check_company_3"></label>
                                            </div>
                                        </td>
                                        <td style="width:60px!important;">
                                            <input type="tel" name="company_3" id="setting_company_3"
                                                   class="form-control text-right" maxlength="2" autocomplete="off"
                                                   oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                                        </td>
                                        <td class="text-left">
                                            <span class="mt-1 text-left">グループ</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="custom-control custom-checkbox custom-control-inline"
                                                 style="margin-left: 21px !important;">
                                                <input type="checkbox" name="check_syozoku" id="check_syozoku"
                                                       class="custom-control-input customCheckBox">
                                                <label class="custom-control-label margin_btn_17"
                                                       for="check_syozoku"></label>
                                            </div>
                                        </td>
                                        <td style="width:60px!important;">
                                            <input type="tel" name="syozoku" id="setting_syozoku"
                                                   class="form-control text-right" maxlength="2" autocomplete="off"
                                                   oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                                        </td>
                                        <td class="text-left">
                                            <span class="mt-1 text-left">事業所</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="custom-control custom-checkbox custom-control-inline"
                                                 style="margin-left: 21px !important;">
                                                <input type="checkbox" name="check_passwd" id="check_passwd"
                                                       class="custom-control-input customCheckBox">
                                                <label class="custom-control-label margin_btn_17"
                                                       for="check_passwd"></label>
                                            </div>
                                        </td>
                                        <td style="width:60px!important;">
                                            <input type="tel" name="passwd" id="setting_passwd"
                                                   class="form-control text-right" maxlength="2" autocomplete="off"
                                                   oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                                        </td>
                                        <td class="text-left">
                                            <span class="mt-1 text-left">パスワード</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="custom-control custom-checkbox custom-control-inline"
                                                 style="margin-left: 21px !important;">
                                                <input type="checkbox" name="check_mail4" id="check_mail4"
                                                       class="custom-control-input customCheckBox">
                                                <label class="custom-control-label margin_btn_17"
                                                       for="check_mail4"></label>
                                            </div>
                                        </td>
                                        <td style="width:60px!important;">
                                            <input type="tel" name="mail4" id="setting_mail4"
                                                   class="form-control text-right" maxlength="2" autocomplete="off"
                                                   oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                                        </td>
                                        <td class="text-left">
                                            <span class="mt-1 text-left">権限CD</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="custom-control custom-checkbox custom-control-inline"
                                                 style="margin-left: 21px !important;">
                                                <input type="checkbox" name="check_mail2" id="check_mail2"
                                                       class="custom-control-input customCheckBox">
                                                <label class="custom-control-label margin_btn_17"
                                                       for="check_mail2"></label>
                                            </div>
                                        </td>
                                        <td style="width:60px!important;">
                                            <input type="tel" name="mail2" id="setting_mail2"
                                                   class="form-control text-right" maxlength="2" autocomplete="off"
                                                   oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                                        </td>
                                        <td class="text-left">
                                            <span class="mt-1 text-left">電話番号</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="custom-control custom-checkbox custom-control-inline"
                                                 style="margin-left: 21px !important;">
                                                <input type="checkbox" name="check_mail3" id="check_mail3"
                                                       class="custom-control-input customCheckBox">
                                                <label class="custom-control-label margin_btn_17"
                                                       for="check_mail3"></label>
                                            </div>
                                        </td>
                                        <td style="width:60px!important;">
                                            <input type="tel" name="mail3" id="setting_mail3"
                                                   class="form-control text-right" maxlength="2" autocomplete="off"
                                                   oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                                        </td>
                                        <td class="text-left">
                                            <span class="mt-1 text-left">携帯番号</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="custom-control custom-checkbox custom-control-inline"
                                                 style="margin-left: 21px !important;">
                                                <input type="checkbox" name="check_mail" id="check_mail"
                                                       class="custom-control-input customCheckBox">
                                                <label class="custom-control-label margin_btn_17"
                                                       for="check_mail"></label>
                                            </div>
                                        </td>
                                        <td style="width:60px!important;">
                                            <input type="tel" name="mail" id="setting_mail"
                                                   class="form-control text-right" maxlength="2" autocomplete="off"
                                                   oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                                        </td>
                                        <td class="text-left">
                                            <span class="mt-1 text-left">メールアドレス</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="custom-control custom-checkbox custom-control-inline"
                                                 style="margin-left: 21px !important;">
                                                <input type="checkbox" name="check_datatxt0030" id="check_datatxt0030"
                                                       class="custom-control-input customCheckBox">
                                                <label class="custom-control-label margin_btn_17"
                                                       for="check_datatxt0030"></label>
                                            </div>
                                        </td>
                                        <td style="width:60px!important;">
                                            <input type="tel" name="datatxt0030" id="setting_datatxt0030"
                                                   class="form-control text-right" maxlength="2" autocomplete="off"
                                                   oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                                        </td>
                                        <td class="text-left">
                                            <span class="mt-1 text-left">入力者1</span>
                                        </td>
                                    </tr>


                                    <tr>
                                        <td>
                                            <div class="custom-control custom-checkbox custom-control-inline"
                                                 style="margin-left: 21px !important;">
                                                <input type="checkbox" name="check_datatxt0031" id="check_datatxt0031"
                                                       class="custom-control-input customCheckBox">
                                                <label class="custom-control-label margin_btn_17"
                                                       for="check_datatxt0031"></label>
                                            </div>
                                        </td>
                                        <td style="width:60px!important;">
                                            <input type="tel" name="datatxt0031" id="setting_datatxt0031"
                                                   class="form-control text-right" maxlength="2" autocomplete="off"
                                                   oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                                        </td>
                                        <td class="text-left">
                                            <span class="mt-1 text-left">入力者2</span>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <div class="custom-control custom-checkbox custom-control-inline"
                                                 style="margin-left: 21px !important;">
                                                <input type="checkbox" name="check_datatxt0032" id="check_datatxt0032"
                                                       class="custom-control-input customCheckBox">
                                                <label class="custom-control-label margin_btn_17"
                                                       for="check_datatxt0032"></label>
                                            </div>
                                        </td>
                                        <td style="width:60px!important;">
                                            <input type="tel" name="datatxt0032" id="setting_datatxt0032"
                                                   class="form-control text-right" maxlength="2" autocomplete="off"
                                                   oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                                        </td>
                                        <td class="text-left">
                                            <span class="mt-1 text-left">入力者3</span>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <div class="custom-control custom-checkbox custom-control-inline"
                                                 style="margin-left: 21px !important;">
                                                <input type="checkbox" name="check_datatxt0033" id="check_datatxt0033"
                                                       class="custom-control-input customCheckBox">
                                                <label class="custom-control-label margin_btn_17"
                                                       for="check_datatxt0033"></label>
                                            </div>
                                        </td>
                                        <td style="width:60px!important;">
                                            <input type="tel" name="datatxt0033" id="setting_datatxt0033"
                                                   class="form-control text-right" maxlength="2" autocomplete="off"
                                                   oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                                        </td>
                                        <td class="text-left">
                                            <span class="mt-1 text-left">入力者４</span>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <div class="custom-control custom-checkbox custom-control-inline"
                                                 style="margin-left: 21px !important;">
                                                <input type="checkbox" name="check_datatxt0034" id="check_datatxt0034"
                                                       class="custom-control-input customCheckBox">
                                                <label class="custom-control-label margin_btn_17"
                                                       for="check_datatxt0034"></label>
                                            </div>
                                        </td>
                                        <td style="width:60px!important;">
                                            <input type="tel" name="datatxt0034" id="setting_datatxt0034"
                                                   class="form-control text-right" maxlength="2" autocomplete="off"
                                                   oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                                        </td>
                                        <td class="text-left">
                                            <span class="mt-1 text-left">決裁者１</span>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <div class="custom-control custom-checkbox custom-control-inline"
                                                 style="margin-left: 21px !important;">
                                                <input type="checkbox" name="check_datatxt0035" id="check_datatxt0035"
                                                       class="custom-control-input customCheckBox">
                                                <label class="custom-control-label margin_btn_17"
                                                       for="check_datatxt0035"></label>
                                            </div>
                                        </td>
                                        <td style="width:60px!important;">
                                            <input type="tel" name="datatxt0035" id="setting_datatxt0035"
                                                   class="form-control text-right" maxlength="2" autocomplete="off"
                                                   oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                                        </td>
                                        <td class="text-left">
                                            <span class="mt-1 text-left">決裁者２</span>
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
                                            <div class="custom-control custom-checkbox custom-control-inline"
                                                 style="margin-left: 21px !important;">
                                                <input type="checkbox" name="check_datatxt0036" id="check_datatxt0036"
                                                       class="custom-control-input customCheckBox">
                                                <label class="custom-control-label margin_btn_17"
                                                       for="check_datatxt0036"></label>
                                            </div>
                                        </td>
                                        <td style="width:60px!important;">
                                            <input type="tel" name="datatxt0036" id="setting_datatxt0036"
                                                   class="form-control text-right" maxlength="2" autocomplete="off"
                                                   oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                                        </td>
                                        <td class="text-left">
                                            <span class="mt-1 text-left">決裁者３</span>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <div class="custom-control custom-checkbox custom-control-inline"
                                                 style="margin-left: 21px !important;">
                                                <input type="checkbox" name="check_datatxt0037" id="check_datatxt0037"
                                                       class="custom-control-input customCheckBox">
                                                <label class="custom-control-label margin_btn_17"
                                                       for="check_datatxt0037"></label>
                                            </div>
                                        </td>
                                        <td style="width:60px!important;">
                                            <input type="tel" name="datatxt0037" id="setting_datatxt0037"
                                                   class="form-control text-right" maxlength="2" autocomplete="off"
                                                   oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                                        </td>
                                        <td class="text-left">
                                            <span class="mt-1 text-left">決裁者４</span>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <div class="custom-control custom-checkbox custom-control-inline"
                                                 style="margin-left: 21px !important;">
                                                <input type="checkbox" name="check_datatxt0029" id="check_datatxt0029"
                                                       class="custom-control-input customCheckBox">
                                                <label class="custom-control-label margin_btn_17"
                                                       for="check_datatxt0029"></label>
                                            </div>
                                        </td>
                                        <td style="width:60px!important;">
                                            <input type="tel" name="datatxt0029" id="setting_datatxt0029"
                                                   class="form-control text-right" maxlength="2" autocomplete="off"
                                                   oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                                        </td>
                                        <td class="text-left">
                                            <span class="mt-1 text-left">社員印影</span>
                                        </td>
                                    </tr>
                                     <tr>
                                        <td>
                                            <div class="custom-control custom-checkbox custom-control-inline"
                                                 style="margin-left: 21px !important;">
                                                <input type="checkbox" name="check_innerlevel1" id="check_innerlevel1"
                                                       class="custom-control-input customCheckBox">
                                                <label class="custom-control-label margin_btn_17"
                                                       for="check_innerlevel1"></label>
                                            </div>
                                        </td>
                                        <td style="width:60px!important;">
                                            <input type="tel" name="innerlevel" id="setting_innerlevel"
                                                   class="form-control text-right" maxlength="2" autocomplete="off"
                                                   oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                                        </td>
                                        <td class="text-left">
                                            <span class="mt-1 text-left">写真</span>
                                        </td>
                                    </tr>

      								  <tr>
                                        <td>
                                            <div class="custom-control custom-checkbox custom-control-inline"
                                                 style="margin-left: 21px !important;">
                                                <input type="checkbox" name="check_innerlevel" id="check_innerlevel"
                                                       class="custom-control-input customCheckBox">
                                                <label class="custom-control-label margin_btn_17"
                                                       for="check_innerlevel"></label>
                                            </div>
                                        </td>
                                        <td style="width:60px!important;">
                                            <input type="tel" name="innerlevel" id="setting_innerlevel"
                                                   class="form-control text-right" maxlength="2" autocomplete="off"
                                                   oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                                        </td>
                                        <td class="text-left">
                                            <span class="mt-1 text-left">権限レベル</span>
                                        </td>
                                    </tr>


                                    <tr>
                                        <td>
                                            <div class="custom-control custom-checkbox custom-control-inline"
                                                 style="margin-left: 21px !important;">
                                                <input type="checkbox" name="check_created_date" id="check_created_date"
                                                       class="custom-control-input customCheckBox">
                                                <label class="custom-control-label margin_btn_17"
                                                       for="check_created_date"></label>
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
                                                 style="margin-left: 21px !important;">
                                                <input type="checkbox" name="check_created_time" id="check_created_time"
                                                       class="custom-control-input customCheckBox">
                                                <label class="custom-control-label margin_btn_17"
                                                       for="check_created_time"></label>
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
                                                 style="margin-left: 21px !important;">
                                                <input type="checkbox" name="check_edited_date" id="check_edited_date"
                                                       class="custom-control-input customCheckBox">
                                                <label class="custom-control-label margin_btn_17"
                                                       for="check_edited_date"></label>
                                            </div>
                                        </td>
                                        <td style="width:60px!important;">
                                            <input type="tel" name="edited_date" id="setting_edited_date"
                                                   class="form-control text-right" maxlength="2" autocomplete="off"
                                                   oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                                        </td>
                                        <td class="text-left">
                                            <span class="mt-1 text-left">更新年月日</span>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <div class="custom-control custom-checkbox custom-control-inline"
                                                 style="margin-left: 21px !important;">
                                                <input type="checkbox" name="check_edited_time" id="check_edited_time"
                                                       class="custom-control-input customCheckBox">
                                                <label class="custom-control-label margin_btn_17"
                                                       for="check_edited_time"></label>
                                            </div>
                                        </td>
                                        <td style="width:60px!important;">
                                            <input type="tel" name="edited_time" id="setting_edited_time"
                                                   class="form-control text-right" maxlength="2" autocomplete="off"
                                                   oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                                        </td>
                                        <td class="text-left">
                                            <span class="mt-1 text-left">更新時刻</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="custom-control custom-checkbox custom-control-inline"
                                                 style="margin-left: 21px !important;">
                                                <input type="checkbox" name="check_syounin" id="check_syounin"
                                                       class="custom-control-input customCheckBox">
                                                <label class="custom-control-label margin_btn_17"
                                                       for="check_syounin"></label>
                                            </div>
                                        </td>
                                        <td style="width:60px!important;">
                                            <input type="tel" name="syounin" id="setting_syounin"
                                                   class="form-control text-right" maxlength="2" autocomplete="off"
                                                   oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                                        </td>
                                        <td class="text-left">
                                            <span class="mt-1 text-left">更新時端末IP</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="custom-control custom-checkbox custom-control-inline"
                                                 style="margin-left: 21px !important;">
                                                <input type="checkbox" name="check_user_name" id="check_user_name"
                                                       class="custom-control-input customCheckBox">
                                                <label class="custom-control-label margin_btn_17"
                                                       for="check_user_name"></label>
                                            </div>
                                        </td>
                                        <td style="width:60px!important;">
                                            <input type="tel" name="user_name" id="setting_user_name"
                                                   class="form-control text-right" maxlength="2"
                                                   onkeydown="lastTab(event)" onkeydown="lastTab(event)"
                                                   autocomplete="off"
                                                   oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');"
                                                   onkeydown="lastTab1_emp(event)">
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
                    <!-- </div> -->


                </div>
                <div class="modal-footer">
                    <a type="button" class="btn btn-info" id="tableSettingSubmit"><i class="fas fa-save"
                                                                                     style="margin-right: 5px;"></i>変更</a>
                </div>
            </div>

        </div>
    </div>
</form>


<script src="https://ajax.aspnetcdn.com/ajax/knockout/knockout-2.2.1.js" type="text/javascript"></script>

<script type="text/javascript">

    function lastTab1_emp(event) {
        if (event.keyCode == 13) {
            document.getElementById("check_name").focus();
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


