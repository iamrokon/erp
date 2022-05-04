<!-- ============================new moda1 end here ======================= -->
<form id="tableSetting" action="{{ route('creditMasterTableSetting',$bango) }}">
    @csrf
    <input type="hidden" name="redirect_path" value="creditMasterReload">
<div class="modal fade" data-keyboard="false" data-backdrop="static" id="setting_display_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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

         <!--        <script type="text/javascript">
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

{{--                <script type="text/javascript">--}}
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

                <div class="row">
                    <div class="col-lg-12">
                        <div id="errorShow"></div>
                        <div class="table-responsive setting_header">
                            <table class="table table-striped  table-bordered">
                                <tbody class="">
                                <tr>
                                    <td>
                                        <div class="custom-control custom-checkbox custom-control-inline" style="margin-left: 21px!important;">
                                            <input type="checkbox" id="check_point" class="custom-control-input" checked="checked" disabled="disabled">
                                            <input type="hidden" name="check_point" value="on">
                                            <label class="custom-control-label margin_btn_17" for="check_point"></label>

                                        </div>
                                    </td>
                                    <td style="width:60px!important;">
                                        <input type="text" name="point" id="setting_point" class="form-control" value="0" readonly="readonly" autocomplete="off" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                                    </td>
                                    <td class="text-left">
                                        <span class="mt-1 text-left">会社CD</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="custom-control custom-checkbox custom-control-inline"  style="margin-left: 21px!important;">
                                            <input type="checkbox" name="check_kokyaku1_name" id="check_kokyaku1_name" class="custom-control-input customCheckBox">
                                            <label class="custom-control-label margin_btn_17" for="check_kokyaku1_name"></label>
                                        </div>
                                    </td>
                                    <td style="width:60px!important;">
                                        <input type="tel" name="kokyaku1_name" id="setting_kokyaku1_name" class="form-control" value="" autocomplete="off" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                                    </td>
                                    <td class="text-left">
                                        <span class="mt-1 text-left">会社名</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="custom-control custom-checkbox custom-control-inline"  style="margin-left: 21px!important;">
                                            <input type="checkbox" name="check_kounyusu" id="check_kounyusu" class="custom-control-input customCheckBox">
                                            <label class="custom-control-label margin_btn_17" for="check_kounyusu"></label>
                                        </div>
                                    </td>
                                    <td style="width:60px!important;">
                                        <input type="tel" name="kounyusu" id="setting_kounyusu" class="form-control" value="" autocomplete="off" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                                    </td>
                                    <td class="text-left">
                                        <span class="mt-1 text-left">年月</span>
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <div class="custom-control custom-checkbox custom-control-inline"  style="margin-left: 21px!important;">
                                            <input type="checkbox" name="check_denpyostart" id="check_denpyostart" class="custom-control-input customCheckBox">
                                            <label class="custom-control-label margin_btn_17" for="check_denpyostart"></label>
                                        </div>
                                    </td>
                                    <td style="width:60px!important;">
                                        <input type="tel" name="denpyostart" id="setting_denpyostart" class="form-control" value="" autocomplete="off" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                                    </td>
                                    <td class="text-left">
                                        <span class="mt-1 text-left">与信限度額</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="custom-control custom-checkbox custom-control-inline" style="margin-left: 21px!important;">
                                            <input type="checkbox" name="check_syukei1" id="check_syukei1" class="custom-control-input customCheckBox">
                                            <label class="custom-control-label margin_btn_17" for="check_syukei1"></label>
                                        </div>
                                    </td>
                                    <td style="width:60px!important;">
                                        <input type="tel" name="syukei1" id="setting_syukei1" class="form-control" autocomplete="off" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                                    </td>
                                    <td class="text-left">
                                        <span class="mt-1 text-left">前月与信残高金額</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="custom-control custom-checkbox custom-control-inline"  style="margin-left: 21px!important;">
                                            <input type="checkbox" name="check_syukei2" id="check_syukei2" class="custom-control-input customCheckBox">
                                            <label class="custom-control-label margin_btn_17" for="th5check_syukei2"></label>
                                        </div>
                                    </td>
                                    <td style="width:60px!important;">
                                        <input type="tel" name="syukei2" id="setting_syukei2" class="form-control" autocomplete="off" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                                    </td>
                                    <td class="text-left">
                                        <span class="mt-1 text-left">当月受注金額</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="custom-control custom-checkbox custom-control-inline"  style="margin-left: 21px!important;">
                                            <input type="checkbox" name="check_syukei3" id="check_syukei3" class="custom-control-input customCheckBox">
                                            <label class="custom-control-label margin_btn_17" for="check_syukei3"></label>
                                        </div>
                                    </td>
                                    <td style="width:60px!important;">
                                        <input type="tel" name="syukei3" id="setting_syukei3" class="form-control" autocomplete="off" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                                    </td>
                                    <td class="text-left">
                                        <span class="mt-1 text-left">当月売上金額</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="custom-control custom-checkbox custom-control-inline"  style="margin-left: 21px!important;">
                                            <input type="checkbox" name="check_syukei4" id="check_syukei4" class="custom-control-input customCheckBox">
                                            <label class="custom-control-label margin_btn_17" for="check_syukei4"></label>
                                        </div>
                                    </td>
                                    <td style="width:60px!important;">
                                        <input type="tel" name="syukei4" id="setting_syukei4" class="form-control" autocomplete="off" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                                    </td>
                                    <td class="text-left">
                                        <span class="mt-1 text-left">当月入金金額</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="custom-control custom-checkbox custom-control-inline"  style="margin-left: 21px!important;">
                                            <input type="checkbox" name="check_syukei5" id="check_syukei5" class="custom-control-input customCheckBox">
                                            <label class="custom-control-label margin_btn_17" for="check_syukei5"></label>
                                        </div>
                                    </td>
                                    <td style="width:60px!important;">
                                        <input type="tel" name="syukei5" id="setting_syukei5" class="form-control" autocomplete="off" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                                    </td>
                                    <td class="text-left">
                                        <span class="mt-1 text-left">当月与信残高金額</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="custom-control custom-checkbox custom-control-inline"  style="margin-left: 21px!important;">
                                            <input type="checkbox" name="check_mail11" id="check_mail11" class="custom-control-input customCheckBox">
                                            <label class="custom-control-label margin_btn_17" for="check_mail11"></label>
                                        </div>
                                    </td>
                                    <td style="width:60px!important;">
                                        <input type="tel" name="mail11" id="setting_mail11" class="form-control" autocomplete="off" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                                    </td>
                                    <td class="text-left">
                                        <span class="mt-1 text-left">登録年月日</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="custom-control custom-checkbox custom-control-inline"  style="margin-left: 21px!important;">
                                            <input type="checkbox" name="check_mail12" id="check_mail12" class="custom-control-input customCheckBox">
                                            <label class="custom-control-label margin_btn_17" for="check_mail12"></label>
                                        </div>
                                    </td>
                                    <td style="width:60px!important;">
                                        <input type="tel" name="mail12" id="setting_mail12" class="form-control" autocomplete="off" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                                    </td>
                                    <td class="text-left">
                                        <span class="mt-1 text-left">登録時刻</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="custom-control custom-checkbox custom-control-inline"  style="margin-left: 21px!important;">
                                            <input type="checkbox" name="check_mail21" id="check_mail21" class="custom-control-input customCheckBox">
                                            <label class="custom-control-label margin_btn_17" for="check_mail21"></label>
                                        </div>
                                    </td>
                                    <td style="width:60px!important;">
                                        <input type="tel" name="mail21" id="setting_mail21" class="form-control" autocomplete="off" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                                    </td>
                                    <td class="text-left">
                                        <span class="mt-1 text-left">更新年月日</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="custom-control custom-checkbox custom-control-inline"  style="margin-left: 21px!important;">
                                            <input type="checkbox" name="check_mail22" id="check_mail22" class="custom-control-input customCheckBox">
                                            <label class="custom-control-label margin_btn_17" for="check_mail22"></label>
                                        </div>
                                    </td>
                                    <td style="width:60px!important;">
                                        <input type="tel" name="mail22" id="setting_mail22" class="form-control" autocomplete="off" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                                    </td>
                                    <td class="text-left">
                                        <span class="mt-1 text-left">更新時刻</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="custom-control custom-checkbox custom-control-inline"  style="margin-left: 21px!important;">
                                            <input type="checkbox" name="check_name" id="check_name" class="custom-control-input customCheckBox">
                                            <label class="custom-control-label margin_btn_17" for="check_name"></label>
                                        </div>
                                    </td>
                                    <td style="width:60px!important;">
                                        <input type="tel" name="name" id="setting_name" class="form-control" autocomplete="off" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                                    </td>
                                    <td class="text-left">
                                        <span class="mt-1 text-left">更新時端末IP</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="custom-control custom-checkbox custom-control-inline"  style="margin-left: 21px!important;">
                                            <input type="checkbox" name="check_kaka" id="check_kaka" class="custom-control-input customCheckBox">
                                            <label class="custom-control-label margin_btn_17" for="check_kaka"></label>
                                        </div>
                                    </td>
                                    <td style="width:60px!important;">
                                        <input type="tel" name="kaka" id="setting_kaka" class="form-control" autocomplete="off" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
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
                <a type="button" class="btn btn-info" id="tableSettingSubmit"><i class="fas fa-save" style="margin-right: 5px;"></i>保存 </a>
            </div>
        </div>
    </div>
</div>
</form>
