{{--<style>--}}

{{--.custom-control {--}}
{{--    --}}
{{--}--}}
{{--</style>--}}

<form id="tableSetting" action="{{ route('customerProductManagementTableSetting',$bango) }}">
    @csrf
    <input type="hidden" name="redirect_path" value="customerProductReload">
    <div class="modal" data-keyboard="false" data-backdrop="static" id="setting_display_modal" tabindex="-1"
         role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="exampleModalLabel"></h6>
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-lg-12 ">
                        <div class="row">
                            <div class="col-lg-4">
                                <a class="checkall btn btn-info" style="margin-bottom: 10px;">全選択</a>
                                <a class="uncheck btn btn-info" style="margin-bottom: 10px;">全解除</a>
                            </div>
                            <div class="col-lg-4">


                            </div>
                            <div class="col-lg-4">
                                <a class="btn btn-info " style="margin-bottom: 10px;float: right;">デフォルト</a>

                            </div>

                           </div>
                        <div id="errorShow"></div>
                        <div class="table-responsive setting_header" data-bind="nextFieldOnEnter:true">
                            <table class="table table-striped  table-bordered">
                                <tbody class="">
                                <tr>
                                    <td>
                                        <div class="custom-control custom-checkbox custom-control-inline"
                                             style="">
                                            <input type="checkbox" id="check_company_name" class="custom-control-input "
                                                   checked="checked" disabled="disabled">
                                            <input type="hidden" name="check_company_name" value="on">
                                            <label class="custom-control-label margin_btn_17"
                                                   for="check_company_name"></label>

                                        </div>
                                    </td>
                                    <td style="width:60px!important;">
                                        <input type="text" name="company_name" id="setting_company_name" class="form-control text-right" maxlength="2" value="0" placeholder="0" readonly="readonly" autocomplete="off"
                                               autocomplete="off"
                                               oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                                    </td>
                                    <td class="text-left">
                                        <span class="mt-1 text-left">会社CＤ</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="custom-control custom-checkbox custom-control-inline"
                                             style="">
                                            <input type="checkbox" name="check_product_name" id="check_product_name"
                                                   class="custom-control-input customCheckBox">
                                            <label class="custom-control-label margin_btn_17"
                                                   for="check_product_name"></label>
                                        </div>
                                    </td>
                                    <td style="width:60px!important;">
                                        <input type="tel" class="form-control text-right" maxlength="2"
                                               name="product_name" id="setting_product_name"
                                               autocomplete="off"
                                               oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                                    </td>
                                    <td class="text-left">
                                        <span class="mt-1 text-left">商品ＣＤ</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="custom-control custom-checkbox custom-control-inline"
                                             style="">
                                            <input type="checkbox" name="check_icon" id="check_icon"
                                                   class="custom-control-input customCheckBox">
                                            <label class="custom-control-label margin_btn_17" for="check_icon"></label>
                                        </div>
                                    </td>
                                    <td style="width:60px!important;">
                                        <input type="tel" class="form-control text-right" maxlength="2" name="icon"
                                               id="setting_icon"
                                               autocomplete="off"
                                               oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                                    </td>
                                    <td class="text-left">
                                        <span class="mt-1 text-left">単価区分</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="custom-control custom-checkbox custom-control-inline"
                                             style="">
                                            <input type="checkbox" name="check_kakaku" id="check_kakaku"
                                                   class="custom-control-input customCheckBox">
                                            <label class="custom-control-label margin_btn_17"
                                                   for="check_kakaku"></label>
                                        </div>
                                    </td>
                                    <td style="width:60px!important;">
                                        <input type="tel" class="form-control text-right" maxlength="2" name="kakaku"
                                               id="setting_kakaku"
                                               autocomplete="off"
                                               oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                                    </td>
                                    <td class="text-left">
                                        <span class="mt-1 text-left">基本販売価格</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="custom-control custom-checkbox custom-control-inline"
                                             style="">
                                            <input type="checkbox" name="check_hanbaisu" id="check_hanbaisu"
                                                   class="custom-control-input customCheckBox">
                                            <label class="custom-control-label margin_btn_17"
                                                   for="check_hanbaisu"></label>
                                        </div>
                                    </td>
                                    <td style="width:60px!important;">
                                        <input type="tel" class="form-control text-right" maxlength="2" name="hanbaisu"
                                               id="setting_hanbaisu"
                                               autocomplete="off"
                                               oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                                    </td>
                                    <td class="text-left">
                                        <span class="mt-1 text-left">ＰＢ販売価格</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="custom-control custom-checkbox custom-control-inline"
                                             style="">
                                            <input type="checkbox" name="check_jyougensu" id="check_jyougensu"
                                                   class="custom-control-input customCheckBox">
                                            <label class="custom-control-label margin_btn_17"
                                                   for="check_jyougensu"></label>
                                        </div>
                                    </td>
                                    <td style="width:60px!important;">
                                        <input type="tel" class="form-control text-right" maxlength="2" name="jyougensu"
                                               id="setting_jyougensu"
                                               autocomplete="off"
                                               oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                                    </td>
                                    <td class="text-left">
                                        <span class="mt-1 text-left">営業粗利</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="custom-control custom-checkbox custom-control-inline"
                                             style="">
                                            <input type="checkbox" name="check_yoyaku" id="check_yoyaku"
                                                   class="custom-control-input customCheckBox">
                                            <label class="custom-control-label margin_btn_17"
                                                   for="check_yoyaku"></label>
                                        </div>
                                    </td>
                                    <td style="width:60px!important;">
                                        <input type="tel" class="form-control text-right" maxlength="2" name="yoyaku"
                                               id="setting_yoyaku"
                                               autocomplete="off"
                                               oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                                    </td>
                                    <td class="text-left">
                                        <span class="mt-1 text-left">ＰＢ営業粗利</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="custom-control custom-checkbox custom-control-inline"
                                             style="">
                                            <input type="checkbox" name="check_yoyakusu" id="check_yoyakusu"
                                                   class="custom-control-input customCheckBox">
                                            <label class="custom-control-label margin_btn_17"
                                                   for="check_yoyakusu"></label>
                                        </div>
                                    </td>
                                    <td style="width:60px!important;">
                                        <input type="tel" class="form-control text-right" maxlength="2" name="yoyakusu"
                                               id="setting_yoyakusu"
                                               autocomplete="off"
                                               oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                                    </td>
                                    <td class="text-left">
                                        <span class="mt-1 text-left">仕入価格</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="custom-control custom-checkbox custom-control-inline"
                                             style="">
                                            <input type="checkbox" name="check_yoyakukanousu" id="check_yoyakukanousu"
                                                   class="custom-control-input customCheckBox">
                                            <label class="custom-control-label margin_btn_17"
                                                   for="check_yoyakukanousu"></label>
                                        </div>
                                    </td>
                                    <td style="width:60px!important;">
                                        <input type="tel" class="form-control text-right" maxlength="2"
                                               name="yoyakukanousu" id="setting_yoyakukanousu"
                                               autocomplete="off"
                                               oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                                    </td>
                                    <td class="text-left">
                                        <span class="mt-1 text-left">仕切（SE）</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="custom-control custom-checkbox custom-control-inline"
                                             style="">
                                            <input type="checkbox" name="check_sortbango" id="check_sortbango"
                                                   class="custom-control-input customCheckBox">
                                            <label class="custom-control-label margin_btn_17"
                                                   for="check_sortbango"></label>
                                        </div>
                                    </td>
                                    <td style="width:60px!important;">
                                        <input type="tel" class="form-control text-right" maxlength="2" name="sortbango"
                                               id="setting_sortbango"
                                               autocomplete="off"
                                               oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                                    </td>
                                    <td class="text-left">
                                        <span class="mt-1 text-left">仕切（研究所）</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="custom-control custom-checkbox custom-control-inline"
                                             style="">
                                            <input type="checkbox" name="check_dataint01" id="check_dataint01"
                                                   class="custom-control-input customCheckBox">
                                            <label class="custom-control-label margin_btn_17"
                                                   for="check_dataint01"></label>
                                        </div>
                                    </td>
                                    <td style="width:60px!important;">
                                        <input type="tel" class="form-control text-right" maxlength="2" name="dataint01"
                                               id="setting_dataint01"
                                               autocomplete="off"
                                               oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                                    </td>
                                    <td class="text-left">
                                        <span class="mt-1 text-left">仕切（出荷ｾﾝﾀｰ）</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="custom-control custom-checkbox custom-control-inline"
                                             style="">
                                            <input type="checkbox" name="check_datachar01" id="check_datachar01"
                                                   class="custom-control-input customCheckBox">
                                            <label class="custom-control-label margin_btn_17"
                                                   for="check_datachar01"></label>
                                        </div>
                                    </td>
                                    <td style="width:60px!important;">
                                        <input type="tel" class="form-control text-right" maxlength="2"
                                               name="datachar01" id="setting_datachar01"
                                               autocomplete="off"
                                               oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                                    </td>
                                    <td class="text-left">
                                        <span class="mt-1 text-left">入力区分1</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="custom-control custom-checkbox custom-control-inline"
                                             style="">
                                            <input type="checkbox" name="check_datachar02" id="check_datachar02"
                                                   class="custom-control-input customCheckBox">
                                            <label class="custom-control-label margin_btn_17"
                                                   for="check_datachar02"></label>
                                        </div>
                                    </td>
                                    <td style="width:60px!important;">
                                        <input type="tel" class="form-control text-right" maxlength="2"
                                               name="datachar02" id="setting_datachar02"
                                               autocomplete="off"
                                               oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                                    </td>
                                    <td class="text-left">
                                        <span class="mt-1 text-left">入力区分2</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="custom-control custom-checkbox custom-control-inline"
                                             style="">
                                            <input type="checkbox" name="check_created_date" id="check_created_date"
                                                   class="custom-control-input customCheckBox">
                                            <label class="custom-control-label margin_btn_17"
                                                   for="check_created_date"></label>
                                        </div>
                                    </td>
                                    <td style="width:60px!important;">
                                        <input type="tel" class="form-control text-right" maxlength="2"
                                               name="created_date" id="setting_created_date"
                                               autocomplete="off"
                                               oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                                    </td>
                                    <td class="text-left">
                                        <span class="mt-1 text-left">登録年月日</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="custom-control custom-checkbox custom-control-inline"
                                             style="">
                                            <input type="checkbox" name="check_created_time" id="check_created_time"
                                                   class="custom-control-input customCheckBox">
                                            <label class="custom-control-label margin_btn_17"
                                                   for="check_created_time"></label>
                                        </div>
                                    </td>
                                    <td style="width:60px!important;">
                                        <input type="tel" class="form-control text-right" maxlength="2"
                                               name="created_time" id="setting_created_time"
                                               autocomplete="off"
                                               oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                                    </td>
                                    <td class="text-left">
                                        <span class="mt-1 text-left">登録時刻</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="custom-control custom-checkbox custom-control-inline"
                                             style="">
                                            <input type="checkbox" name="check_edited_date" id="check_edited_date"
                                                   class="custom-control-input customCheckBox">
                                            <label class="custom-control-label margin_btn_17"
                                                   for="check_edited_date"></label>
                                        </div>
                                    </td>
                                    <td style="width:60px!important;">
                                        <input type="tel" class="form-control text-right" maxlength="2"
                                               name="edited_date" id="setting_edited_date"
                                               autocomplete="off"
                                               oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                                    </td>
                                    <td class="text-left">
                                        <span class="mt-1 text-left">更新年月日</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="custom-control custom-checkbox custom-control-inline"
                                             style="">
                                            <input type="checkbox" name="check_edited_time" id="check_edited_time"
                                                   class="custom-control-input customCheckBox">
                                            <label class="custom-control-label margin_btn_17"
                                                   for="check_edited_time"></label>
                                        </div>
                                    </td>
                                    <td style="width:60px!important;">
                                        <input type="tel" class="form-control text-right" maxlength="2"
                                               name="edited_time" id="setting_edited_time"
                                               autocomplete="off"
                                               oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                                    </td>
                                    <td class="text-left">
                                        <span class="mt-1 text-left">更新時刻</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="custom-control custom-checkbox custom-control-inline"
                                             style="">
                                            <input type="checkbox" name="check_datatxt0081" id="check_datatxt0081"
                                                   class="custom-control-input customCheckBox">
                                            <label class="custom-control-label margin_btn_17"
                                                   for="check_datatxt0081"></label>
                                        </div>
                                    </td>
                                    <td style="width:60px!important;">
                                        <input type="tel" class="form-control text-right" maxlength="2"
                                               name="datatxt0081" id="setting_datatxt0081"
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
                                             style="">
                                            <input type="checkbox" name="check_created_by" id="check_created_by"
                                                   class="custom-control-input customCheckBox">
                                            <label class="custom-control-label margin_btn_17"
                                                   for="check_created_by"></label>
                                        </div>
                                    </td>
                                    <td style="width:60px!important;">
                                        <input type="tel" class="form-control text-right" maxlength="2"
                                               onkeydown="lastTab(event)" onkeydown="lastTab(event)" name="created_by"
                                               id="setting_created_by"
                                               autocomplete="off"
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
                <div class="modal-footer">
                    <div class="modal-footer">
                        <button type="button" id="tableSettingSubmit" class="btn btn-info">
                            <i class="fas fa-save" style="margin-right: 5px;"></i>保存
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
