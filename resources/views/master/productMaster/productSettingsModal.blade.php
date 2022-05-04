<form id="tableSetting" action="{{ route('productMasterTableSetting',$bango) }}">
    @csrf
    <input type="hidden" name="redirect_path" value="productMasterReload">
    <div class="modal" data-keyboard="false" data-backdrop="static" id="setting_display_modal"
         role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog " role="document" style="max-width: 1050px;">
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

                    <div class="row" data-bind="nextFieldOnEnter:true">
                        <div class="col-lg-4 col-md-6 col-sm-6">
                            <div class="table-responsive setting_header">
                                <table class="table table-striped  table-bordered">
                                    <tbody class="">
                                    <tr>
                                        <td>
                                            <div class="custom-control custom-checkbox custom-control-inline"
                                                 style="margin-left: 21px!important;">
                                                <input type="checkbox" id="check_kokyakusyouhinbango"
                                                       class=" custom-control-input" checked="checked"
                                                       disabled="disabled">
                                                <input type="hidden" name="check_kokyakusyouhinbango" value="on">
                                                <label class="custom-control-label margin_btn_17"
                                                       for="check_kokyakusyouhinbango"></label>

                                            </div>
                                        </td>
                                        <td style="width:60px!important;">
                                            <input type="text" name="kokyakusyouhinbango"
                                                   id="setting_kokyakusyouhinbango" class="form-control text-right"
                                                   maxlength="2" value="0" readonly="readonly" autocomplete="off"
                                                   oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                                        </td>
                                        <td class="text-left">
                                            <span class="mt-1 text-left">商品CD</span>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <div class="custom-control custom-checkbox custom-control-inline"
                                                 style="margin-left: 21px!important;">
                                                <input type="checkbox" name="check_name" id="check_name"
                                                       class=" custom-control-input customCheckBox">
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
                                            <span class="mt-1 text-left">商品名</span>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <div class="custom-control custom-checkbox custom-control-inline"
                                                 style="margin-left: 21px!important;">
                                                <input type="checkbox" name="check_jouhou_detail"
                                                       id="check_jouhou_detail"
                                                       class=" custom-control-input customCheckBox">
                                                <label class="custom-control-label margin_btn_17"
                                                       for="check_jouhou_detail"></label>
                                            </div>
                                        </td>
                                        <td style="width:60px!important;">
                                            <input type="tel" name="jouhou_detail" id="setting_jouhou_detail"
                                                   class="form-control text-right" maxlength="2" value=""
                                                   autocomplete="off"
                                                   oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                                        </td>
                                        <td class="text-left">
                                            <span class="mt-1 text-left">品目群CD</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="custom-control custom-checkbox custom-control-inline"
                                                 style="margin-left: 21px!important;">
                                                <input type="checkbox" name="check_koyuujouhou_detail"
                                                       id="check_koyuujouhou_detail"
                                                       class=" custom-control-input customCheckBox">
                                                <label class="custom-control-label margin_btn_17"
                                                       for="check_koyuujouhou_detail"></label>
                                            </div>
                                        </td>
                                        <td style="width:60px!important;">
                                            <input type="tel" name="koyuujouhou_detail" id="setting_koyuujouhou_detail"
                                                   class="form-control text-right" maxlength="2" autocomplete="off"
                                                   oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                                        </td>
                                        <td class="text-left">
                                            <span class="mt-1 text-left">製品区分</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="custom-control custom-checkbox custom-control-inline"
                                                 style="margin-left: 21px!important;">
                                                <input type="checkbox" name="check_color_detail" id="check_color_detail"
                                                       class=" custom-control-input customCheckBox">
                                                <label class="custom-control-label margin_btn_17"
                                                       for="check_color_detail"></label>
                                            </div>
                                        </td>
                                        <td style="width:60px!important;">
                                            <input type="tel" name="color_detail" id="setting_color_detail"
                                                   class="form-control text-right" maxlength="2" autocomplete="off"
                                                   oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                                        </td>
                                        <td class="text-left">
                                            <span class="mt-1 text-left">品目区分</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="custom-control custom-checkbox custom-control-inline"
                                                 style="margin-left: 21px!important;">
                                                <input type="checkbox" name="check_bumon" id="check_bumon"
                                                       class=" custom-control-input customCheckBox">
                                                <label class="custom-control-label margin_btn_17"
                                                       for="check_bumon"></label>
                                            </div>
                                        </td>
                                        <td style="width:60px!important;">
                                            <input type="tel" name="bumon" id="setting_bumon"
                                                   class="form-control text-right" maxlength="2" autocomplete="off"
                                                   oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                                        </td>
                                        <td class="text-left">
                                            <span class="mt-1 text-left">販売形態</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="custom-control custom-checkbox custom-control-inline"
                                                 style="margin-left: 21px!important;">
                                                <input type="checkbox" name="check_syouhin1_yoyaku" id="check_syouhin1_yoyaku"
                                                       class=" custom-control-input customCheckBox">
                                                <label class="custom-control-label margin_btn_17"
                                                       for="check_syouhin1_yoyaku"></label>
                                            </div>
                                        </td>
                                        <td style="width:60px!important;">
                                            <input type="tel" name="syouhin1_yoyaku" id="setting_syouhin1_yoyaku"
                                                   class="form-control text-right" maxlength="2" autocomplete="off"
                                                   oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                                        </td>
                                        <td class="text-left">
                                            <span class="mt-1 text-left">バージョン</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="custom-control custom-checkbox custom-control-inline"
                                                 style="margin-left: 21px!important;">
                                                <input type="checkbox" name="check_data21" id="check_data21"
                                                       class=" custom-control-input customCheckBox">
                                                <label class="custom-control-label margin_btn_17"
                                                       for="check_data21"></label>
                                            </div>
                                        </td>
                                        <td style="width:60px!important;">
                                            <input type="tel" name="data21" id="setting_data21"
                                                   class="form-control text-right" maxlength="2" autocomplete="off"
                                                   oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                                        </td>
                                        <td class="text-left">
                                            <span class="mt-1 text-left">保守区分</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="custom-control custom-checkbox custom-control-inline"
                                                 style="margin-left: 21px!important;">
                                                <input type="checkbox" name="check_tokuchou" id="check_tokuchou"
                                                       class=" custom-control-input customCheckBox">
                                                <label class="custom-control-label margin_btn_17"
                                                       for="check_tokuchou"></label>
                                            </div>
                                        </td>
                                        <td style="width:60px!important;">
                                            <input type="tel" name="tokuchou" id="setting_tokuchou"
                                                   class="form-control text-right" maxlength="2" autocomplete="off"
                                                   oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                                        </td>
                                        <td class="text-left">
                                            <span class="mt-1 text-left">継続区分</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="custom-control custom-checkbox custom-control-inline"
                                                 style="margin-left: 21px!important;">
                                                <input type="checkbox" name="check_data22" id="check_data22"
                                                       class=" custom-control-input customCheckBox">
                                                <label class="custom-control-label margin_btn_17"
                                                       for="check_data22"></label>
                                            </div>
                                        </td>
                                        <td style="width:60px!important;">
                                            <input type="tel" name="data22" id="setting_data22"
                                                   class="form-control text-right" maxlength="2" autocomplete="off"
                                                   oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                                        </td>
                                        <td class="text-left">
                                            <span class="mt-1 text-left">新規VUP区分</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="custom-control custom-checkbox custom-control-inline"
                                                 style="margin-left: 21px!important;">
                                                <input type="checkbox" name="check_data23" id="check_data23"
                                                       class=" custom-control-input customCheckBox">
                                                <label class="custom-control-label margin_btn_17"
                                                       for="check_data23"></label>
                                            </div>
                                        </td>
                                        <td style="width:60px!important;">
                                            <input type="tel" name="data23" id="setting_data23"
                                                   class="form-control text-right" maxlength="2" autocomplete="off"
                                                   oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                                        </td>
                                        <td class="text-left">
                                            <span class="mt-1 text-left">商品サブCD区分</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="custom-control custom-checkbox custom-control-inline"
                                                 style="margin-left: 21px!important;">
                                                <input type="checkbox" name="check_size" id="check_size"
                                                       class=" custom-control-input customCheckBox">
                                                <label class="custom-control-label margin_btn_17"
                                                       for="check_size"></label>
                                            </div>
                                        </td>
                                        <td style="width:60px!important;">
                                            <input type="tel" name="size" id="setting_size"
                                                   class="form-control text-right" maxlength="2" autocomplete="off"
                                                   oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                                        </td>
                                        <td class="text-left">
                                            <span class="mt-1 text-left">商品名略称</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="custom-control custom-checkbox custom-control-inline"
                                                 style="margin-left: 21px!important;">
                                                <input type="checkbox" name="check_data24" id="check_data24"
                                                       class=" custom-control-input customCheckBox">
                                                <label class="custom-control-label margin_btn_17"
                                                       for="check_data24"></label>
                                            </div>
                                        </td>
                                        <td style="width:60px!important;">
                                            <input type="tel" name="data24" id="setting_data24"
                                                   class="form-control text-right" maxlength="2" autocomplete="off"
                                                   oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                                        </td>
                                        <td class="text-left">
                                            <span class="mt-1 text-left">入力区分１</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="custom-control custom-checkbox custom-control-inline"
                                                 style="margin-left: 21px!important;">
                                                <input type="checkbox" name="check_season" id="check_season"
                                                       class=" custom-control-input customCheckBox">
                                                <label class="custom-control-label margin_btn_17"
                                                       for="check_season"></label>
                                            </div>
                                        </td>
                                        <td style="width:60px!important;">
                                            <input type="tel" name="season" id="setting_season"
                                                   class="form-control text-right" maxlength="2" autocomplete="off"
                                                   oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                                        </td>
                                        <td class="text-left">
                                            <span class="mt-1 text-left">仕入先CD</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="custom-control custom-checkbox custom-control-inline"
                                                 style="margin-left: 21px!important;">
                                                <input type="checkbox" name="check_kakaku" id="check_kakaku"
                                                       class=" custom-control-input customCheckBox">
                                                <label class="custom-control-label margin_btn_17"
                                                       for="check_kakaku"></label>
                                            </div>
                                        </td>
                                        <td style="width:60px!important;">
                                            <input type="tel" name="kakaku" id="setting_kakaku"
                                                   class="form-control text-right" maxlength="2" autocomplete="off"
                                                   oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                                        </td>
                                        <td class="text-left">
                                            <span class="mt-1 text-left">基本販売価格</span>
                                        </td>
                                    </tr>


                                    <tr>
                                        <td>
                                            <div class="custom-control custom-checkbox custom-control-inline"
                                                 style="margin-left: 21px!important;">
                                                <input type="checkbox" name="check_hanbaisu" id="check_hanbaisu"
                                                       class=" custom-control-input customCheckBox">
                                                <label class="custom-control-label margin_btn_17"
                                                       for="check_hanbaisu"></label>
                                            </div>
                                        </td>
                                        <td style="width:60px!important;">
                                            <input type="tel" name="hanbaisu" id="setting_hanbaisu"
                                                   class="form-control text-right" maxlength="2" autocomplete="off"
                                                   oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                                        </td>
                                        <td class="text-left">
                                            <span class="mt-1 text-left">PB販売価格</span>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <div class="custom-control custom-checkbox custom-control-inline"
                                                 style="margin-left: 21px!important;">
                                                <input type="checkbox" name="check_jyougensu" id="check_jyougensu"
                                                       class=" custom-control-input customCheckBox">
                                                <label class="custom-control-label margin_btn_17"
                                                       for="check_jyougensu"></label>
                                            </div>
                                        </td>
                                        <td style="width:60px!important;">
                                            <input type="tel" name="jyougensu" id="setting_jyougensu"
                                                   class="form-control text-right" maxlength="2" autocomplete="off"
                                                   oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                                        </td>
                                        <td class="text-left">
                                            <span class="mt-1 text-left">営業粗利</span>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <div class="custom-control custom-checkbox custom-control-inline"
                                                 style="margin-left: 21px!important;">
                                                <input type="checkbox" name="check_kakaku_yoyaku"
                                                       id="check_kakaku_yoyaku"
                                                       class=" custom-control-input customCheckBox">
                                                <label class="custom-control-label margin_btn_17"
                                                       for="check_kakaku_yoyaku"></label>
                                            </div>
                                        </td>
                                        <td style="width:60px!important;">
                                            <input type="tel" name="kakaku_yoyaku" id="setting_kakaku_yoyaku"
                                                   class="form-control text-right" maxlength="2" autocomplete="off"
                                                   oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                                        </td>
                                        <td class="text-left">
                                            <span class="mt-1 text-left">PB営業粗利</span>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <div class="custom-control custom-checkbox custom-control-inline"
                                                 style="margin-left: 21px!important;">
                                                <input type="checkbox" name="check_yoyakusu" id="check_yoyakusu"
                                                       class=" custom-control-input customCheckBox">
                                                <label class="custom-control-label margin_btn_17"
                                                       for="check_yoyakusu"></label>
                                            </div>
                                        </td>
                                        <td style="width:60px!important;">
                                            <input type="tel" name="yoyakusu" id="setting_yoyakusu"
                                                   class="form-control text-right" maxlength="2" autocomplete="off"
                                                   oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                                        </td>
                                        <td class="text-left">
                                            <span class="mt-1 text-left">仕入価格</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="custom-control custom-checkbox custom-control-inline"
                                                 style="margin-left: 21px!important;">
                                                <input type="checkbox" name="check_yoyakukanousu"
                                                       id="check_yoyakukanousu"
                                                       class=" custom-control-input customCheckBox">
                                                <label class="custom-control-label margin_btn_17"
                                                       for="check_yoyakukanousu"></label>
                                            </div>
                                        </td>
                                        <td style="width:60px!important;">
                                            <input type="tel" name="yoyakukanousu" id="setting_yoyakukanousu"
                                                   class="form-control text-right" maxlength="2" autocomplete="off"
                                                   oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                                        </td>
                                        <td class="text-left">
                                            <span class="mt-1 text-left">仕切（SE）</span>
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
                                            <div class="custom-control custom-checkbox custom-control-inline"
                                                 style="margin-left: 21px!important;">
                                                <input type="checkbox" name="check_sortbango" id="check_sortbango"
                                                       class=" custom-control-input customCheckBox">
                                                <label class="custom-control-label margin_btn_17"
                                                       for="check_sortbango"></label>
                                            </div>
                                        </td>
                                        <td style="width:60px!important;">
                                            <input type="tel" name="sortbango" id="setting_sortbango"
                                                   class="form-control text-right" maxlength="2" autocomplete="off"
                                                   oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                                        </td>
                                        <td class="text-left">
                                            <span class="mt-1 text-left">仕切（研究所）</span>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <div class="custom-control custom-checkbox custom-control-inline"
                                                 style="margin-left: 21px!important;">
                                                <input type="checkbox" name="check_dataint01" id="check_dataint01"
                                                       class=" custom-control-input customCheckBox">
                                                <label class="custom-control-label margin_btn_17"
                                                       for="check_dataint01"></label>
                                            </div>
                                        </td>
                                        <td style="width:60px!important;">
                                            <input type="tel" name="dataint01" id="setting_dataint01"
                                                   class="form-control text-right" maxlength="2" autocomplete="off"
                                                   oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                                        </td>
                                        <td class="text-left">
                                            <span class="mt-1 text-left">仕切（出荷ｾﾝﾀｰ）</span>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <div class="custom-control custom-checkbox custom-control-inline"
                                                 style="margin-left: 21px!important;">
                                                <input type="checkbox" name="check_data25" id="check_data25"
                                                       class=" custom-control-input customCheckBox">
                                                <label class="custom-control-label margin_btn_17"
                                                       for="check_data25"></label>
                                            </div>
                                        </td>
                                        <td style="width:60px!important;">
                                            <input type="tel" name="data25" id="setting_data25"
                                                   class="form-control text-right" maxlength="2" autocomplete="off"
                                                   oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                                        </td>
                                        <td class="text-left">
                                            <span class="mt-1 text-left">入力区分2</span>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <div class="custom-control custom-checkbox custom-control-inline"
                                                 style="margin-left: 21px!important;">
                                                <input type="checkbox" name="check_data52_detail"
                                                       id="check_data52_detail"
                                                       class=" custom-control-input customCheckBox">
                                                <label class="custom-control-label margin_btn_17"
                                                       for="check_data52_detail"></label>
                                            </div>
                                        </td>
                                        <td style="width:60px!important;">
                                            <input type="tel" name="data52_detail" id="setting_data52_detail"
                                                   class="form-control text-right" maxlength="2" autocomplete="off"
                                                   oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                                        </td>
                                        <td class="text-left">
                                            <span class="mt-1 text-left">製品仕入品区分</span>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <div class="custom-control custom-checkbox custom-control-inline"
                                                 style="margin-left: 21px!important;">
                                                <input type="checkbox" name="check_data53_detail"
                                                       id="check_data53_detail"
                                                       class=" custom-control-input customCheckBox">
                                                <label class="custom-control-label margin_btn_17"
                                                       for="check_data53_detail"></label>
                                            </div>
                                        </td>
                                        <td style="width:60px!important;">
                                            <input type="tel" name="data53_detail" id="setting_data53_detail"
                                                   class="form-control text-right" maxlength="2" autocomplete="off"
                                                   oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                                        </td>
                                        <td class="text-left">
                                            <span class="mt-1 text-left">事業分類</span>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <div class="custom-control custom-checkbox custom-control-inline"
                                                 style="margin-left: 21px!important;">
                                                <input type="checkbox" name="check_data54_detail"
                                                       id="check_data54_detail"
                                                       class=" custom-control-input customCheckBox">
                                                <label class="custom-control-label margin_btn_17"
                                                       for="check_data54_detail"></label>
                                            </div>
                                        </td>
                                        <td style="width:60px!important;">
                                            <input type="tel" name="data54_detail" id="setting_data54_detail"
                                                   class="form-control text-right" maxlength="2" autocomplete="off"
                                                   oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                                        </td>
                                        <td class="text-left">
                                            <span class="mt-1 text-left">商品分類2</span>
                                        </td>
                                    </tr>


                                    <tr>
                                        <td>
                                            <div class="custom-control custom-checkbox custom-control-inline"
                                                 style="margin-left: 21px!important;">
                                                <input type="checkbox" name="check_data100_detail"
                                                       id="check_data100_detail"
                                                       class=" custom-control-input customCheckBox">
                                                <label class="custom-control-label margin_btn_17"
                                                       for="check_data100_detail"></label>
                                            </div>
                                        </td>
                                        <td style="width:60px!important;">
                                            <input type="tel" name="data100_detail" id="setting_data100_detail"
                                                   class="form-control text-right" maxlength="2" autocomplete="off"
                                                   oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                                        </td>
                                        <td class="text-left">
                                            <span class="mt-1 text-left">商品分類3</span>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <div class="custom-control custom-checkbox custom-control-inline"
                                                 style="margin-left: 21px!important;">
                                                <input type="checkbox" name="check_data50" id="check_data50"
                                                       class=" custom-control-input customCheckBox">
                                                <label class="custom-control-label margin_btn_17"
                                                       for="check_data50"></label>

                                            </div>
                                        </td>
                                        <td style="width:60px!important;">
                                            <input type="tel" name="data50" id="setting_data50"
                                                   class="form-control text-right" maxlength="2" value=""
                                                   autocomplete="off"
                                                   oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                                        </td>
                                        <td class="text-left">
                                            <span class="mt-1 text-left">ﾎﾞﾘｭｰﾑﾗｲｾﾝｽ区分</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="custom-control custom-checkbox custom-control-inline"
                                                 style="margin-left: 21px!important;">
                                                <input type="checkbox" name="check_data51" id="check_data51"
                                                       class=" custom-control-input customCheckBox">
                                                <label class="custom-control-label margin_btn_17"
                                                       for="check_data51"></label>
                                            </div>
                                        </td>
                                        <td style="width:60px!important;">
                                            <input type="tel" name="data51" id="setting_data51"
                                                   class="form-control text-right" maxlength="2" value=""
                                                   autocomplete="off"
                                                   oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                                        </td>
                                        <td class="text-left">
                                            <span class="mt-1 text-left">ﾊﾞｰｼﾞｮﾝｱｯﾌﾟ区分</span>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <div class="custom-control custom-checkbox custom-control-inline"
                                                 style="margin-left: 21px!important;">
                                                <input type="checkbox" name="check_synchrosyouhinbango_detail"
                                                       id="check_synchrosyouhinbango_detail"
                                                       class=" custom-control-input customCheckBox">
                                                <label class="custom-control-label margin_btn_17"
                                                       for="check_synchrosyouhinbango_detail"></label>
                                            </div>
                                        </td>
                                        <td style="width:60px!important;">
                                            <input type="tel" name="synchrosyouhinbango_detail"
                                                   id="setting_synchrosyouhinbango_detail"
                                                   class="form-control text-right" maxlength="2" value=""
                                                   autocomplete="off"
                                                   oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                                        </td>
                                        <td class="text-left">
                                            <span class="mt-1 text-left">上市開始日</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="custom-control custom-checkbox custom-control-inline"
                                                 style="margin-left: 21px!important;">
                                                <input type="checkbox" name="check_endtime_detail"
                                                       id="check_endtime_detail"
                                                       class=" custom-control-input customCheckBox">
                                                <label class="custom-control-label margin_btn_17"
                                                       for="check_endtime_detail"></label>
                                            </div>
                                        </td>
                                        <td style="width:60px!important;">
                                            <input type="tel" name="endtime_detail" id="setting_endtime_detail"
                                                   class="form-control text-right" maxlength="2" autocomplete="off"
                                                   oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                                        </td>
                                        <td class="text-left">
                                            <span class="mt-1 text-left">終売日</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="custom-control custom-checkbox custom-control-inline"
                                                 style="margin-left: 21px!important;">
                                                <input type="checkbox" name="check_data26" id="check_data26"
                                                       class=" custom-control-input customCheckBox">
                                                <label class="custom-control-label margin_btn_17"
                                                       for="check_data26"></label>
                                            </div>
                                        </td>
                                        <td style="width:60px!important;">
                                            <input type="tel" name="data26" id="setting_data26"
                                                   class="form-control text-right" maxlength="2" autocomplete="off"
                                                   oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                                        </td>
                                        <td class="text-left">
                                            <span class="mt-1 text-left">最新バージョン区分</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="custom-control custom-checkbox custom-control-inline"
                                                 style="margin-left: 21px!important;">
                                                <input type="checkbox" name="check_data27" id="check_data27"
                                                       class=" custom-control-input customCheckBox">
                                                <label class="custom-control-label margin_btn_17"
                                                       for="check_data27"></label>
                                            </div>
                                        </td>
                                        <td style="width:60px!important;">
                                            <input type="tel" name="data27" id="setting_data27"
                                                   class="form-control text-right" maxlength="2" autocomplete="off"
                                                   oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                                        </td>
                                        <td class="text-left">
                                            <span class="mt-1 text-left">前受請求区分</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="custom-control custom-checkbox custom-control-inline"
                                                 style="margin-left: 21px!important;">
                                                <input type="checkbox" name="check_data28_detail"
                                                       id="check_data28_detail"
                                                       class=" custom-control-input customCheckBox">
                                                <label class="custom-control-label margin_btn_17"
                                                       for="check_data28_detail"></label>
                                            </div>
                                        </td>
                                        <td style="width:60px!important;">
                                            <input type="tel" name="data28_detail" id="setting_data28_detail"
                                                   class="form-control text-right" maxlength="2" autocomplete="off"
                                                   oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                                        </td>
                                        <td class="text-left">
                                            <span class="mt-1 text-left">税区分</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="custom-control custom-checkbox custom-control-inline"
                                                 style="margin-left: 21px!important;">
                                                <input type="checkbox" name="check_data29" id="check_data29"
                                                       class=" custom-control-input customCheckBox">
                                                <label class="custom-control-label margin_btn_17"
                                                       for="check_data29"></label>
                                            </div>
                                        </td>
                                        <td style="width:60px!important;">
                                            <input type="tel" name="data29" id="setting_data29"
                                                   class="form-control text-right" maxlength="2" autocomplete="off"
                                                   oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                                        </td>
                                        <td class="text-left">
                                            <span class="mt-1 text-left">販売可能</span>
                                        </td>
                                    </tr>
                                    {{-- <tr>
                                        <td>
                                            <div class="custom-control custom-checkbox custom-control-inline"
                                                 style="margin-left: 21px!important;">
                                                <input type="checkbox" name="check_data101" id="check_data101"
                                                       class=" custom-control-input customCheckBox">
                                                <label class="custom-control-label margin_btn_17"
                                                       for="check_data101"></label>
                                            </div>
                                        </td>
                                        <td style="width:60px!important;">
                                            <input type="tel" name="data101" id="setting_data101"
                                                   class="form-control text-right" maxlength="2" autocomplete="off"
                                                   oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                                        </td>
                                        <td class="text-left">
                                            <span class="mt-1 text-left">サービス内容</span>
                                        </td>
                                    </tr> --}}
                                    {{-- <tr>
                                        <td>
                                            <div class="custom-control custom-checkbox custom-control-inline"
                                                 style="margin-left: 21px!important;">
                                                <input type="checkbox" name="check_data102" id="check_data102"
                                                       class=" custom-control-input customCheckBox">
                                                <label class="custom-control-label margin_btn_17"
                                                       for="check_data102"></label>
                                            </div>
                                        </td>
                                        <td style="width:60px!important;">
                                            <input type="tel" name="data102" id="setting_data102"
                                                   class="form-control text-right" maxlength="2" autocomplete="off"
                                                   oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                                        </td>
                                        <td class="text-left">
                                            <span class="mt-1 text-left">成果物</span>
                                        </td>
                                    </tr> --}}
                                    {{-- <tr>
                                        <td>
                                            <div class="custom-control custom-checkbox custom-control-inline"
                                                 style="margin-left: 21px!important;">
                                                <input type="checkbox" name="check_data103" id="check_data103"
                                                       class=" custom-control-input customCheckBox">
                                                <label class="custom-control-label margin_btn_17"
                                                       for="check_data103"></label>
                                            </div>
                                        </td>
                                        <td style="width:60px!important;">
                                            <input type="tel" name="data103" id="setting_data103"
                                                   class="form-control text-right" maxlength="2" autocomplete="off"
                                                   oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                                        </td>
                                        <td class="text-left">
                                            <span class="mt-1 text-left">工数目安</span>
                                        </td>
                                    </tr> --}}
                                    {{-- <tr>
                                        <td>
                                            <div class="custom-control custom-checkbox custom-control-inline"
                                                 style="margin-left: 21px!important;">
                                                <input type="checkbox" name="check_name2" id="check_name2"
                                                       class=" custom-control-input customCheckBox">
                                                <label class="custom-control-label margin_btn_17"
                                                       for="check_name2"></label>
                                            </div>
                                        </td>
                                        <td style="width:60px!important;">
                                            <input type="tel" name="name2" id="setting_name2"
                                                   class="form-control text-right" maxlength="2" autocomplete="off"
                                                   oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                                        </td>
                                        <td class="text-left">
                                            <span class="mt-1 text-left">サービス内容（社内備考）</span>
                                        </td>
                                    </tr> --}}
                                    <tr>
                                        <td>
                                            <div class="custom-control custom-checkbox custom-control-inline"
                                                 style="margin-left: 21px!important;">
                                                <input type="checkbox" name="check_url" id="check_url"
                                                       class=" custom-control-input customCheckBox">
                                                <label class="custom-control-label margin_btn_17"
                                                       for="check_url"></label>
                                            </div>
                                        </td>
                                        <td style="width:60px!important;">
                                            <input type="tel" name="url" id="setting_url"
                                                   class="form-control text-right" maxlength="2" autocomplete="off"
                                                   oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                                        </td>
                                        <td class="text-left">
                                            <span class="mt-1 text-left">保守作成区分</span>
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
                                            <div class="custom-control custom-checkbox custom-control-inline"
                                                 style="margin-left: 21px!important;">
                                                <input type="checkbox" name="check_data20"
                                                       id="check_data20"
                                                       class=" custom-control-input customCheckBox">
                                                <label class="custom-control-label margin_btn_17"
                                                       for="check_data20"></label>
                                            </div>
                                        </td>
                                        <td style="width:60px!important;">
                                            <input type="tel" name="data20" id="setting_data20"
                                                   class="form-control text-right" maxlength="2" autocomplete="off"
                                                   oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                                        </td>
                                        <td class="text-left">
                                            <span class="mt-1 text-left">得意先限定商品</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="custom-control custom-checkbox custom-control-inline"
                                                 style="margin-left: 21px!important;">
                                                <input type="checkbox" name="check_url_mobile" id="check_url_mobile"
                                                       class=" custom-control-input customCheckBox">
                                                <label class="custom-control-label margin_btn_17"
                                                       for="check_url_mobile"></label>
                                            </div>
                                        </td>
                                        <td style="width:60px!important;">
                                            <input type="tel" name="url_mobile" id="setting_url_mobile"
                                                   class="form-control text-right" maxlength="2" autocomplete="off"
                                                   oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                                        </td>
                                        <td class="text-left">
                                            <span class="mt-1 text-left">保守商品CD</span>
                                        </td>
                                    </tr>


                                    <tr>
                                        <td>
                                            <div class="custom-control custom-checkbox custom-control-inline"
                                                 style="margin-left: 21px!important;">
                                                <input type="checkbox" name="check_kongouritsu" id="check_kongouritsu"
                                                       class=" custom-control-input customCheckBox">
                                                <label class="custom-control-label margin_btn_17"
                                                       for="check_kongouritsu"></label>
                                            </div>
                                        </td>
                                        <td style="width:60px!important;">
                                            <input type="tel" name="kongouritsu" id="setting_kongouritsu"
                                                   class="form-control text-right" maxlength="2" autocomplete="off"
                                                   oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                                        </td>
                                        <td class="text-left">
                                            <span class="mt-1 text-left">メーカー品番</span>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <div class="custom-control custom-checkbox custom-control-inline"
                                                 style="margin-left: 21px!important;">
                                                <input type="checkbox" name="check_mdjouhou" id="check_mdjouhou"
                                                       class=" custom-control-input customCheckBox">
                                                <label class="custom-control-label margin_btn_17"
                                                       for="check_mdjouhou"></label>
                                            </div>
                                        </td>
                                        <td style="width:60px!important;">
                                            <input type="tel" name="mdjouhou" id="setting_mdjouhou"
                                                   class="form-control text-right" maxlength="2" autocomplete="off"
                                                   oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                                        </td>
                                        <td class="text-left">
                                            <span class="mt-1 text-left">メーカー品名</span>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <div class="custom-control custom-checkbox custom-control-inline"
                                                 style="margin-left: 21px!important;">
                                                <input type="checkbox" name="check_meker" id="check_meker"
                                                       class=" custom-control-input customCheckBox">
                                                <label class="custom-control-label margin_btn_17"
                                                       for="check_meker"></label>
                                            </div>
                                        </td>
                                        <td style="width:60px!important;">
                                            <input type="tel" name="meker" id="setting_meker"
                                                   class="form-control text-right" maxlength="2" autocomplete="off"
                                                   oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                                        </td>
                                        <td class="text-left">
                                            <span class="mt-1 text-left">価格設定区分</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="custom-control custom-checkbox custom-control-inline"
                                                 style="margin-left: 21px!important;">
                                                <input type="checkbox" name="check_konpoumei" id="check_konpoumei"
                                                       class=" custom-control-input customCheckBox">
                                                <label class="custom-control-label margin_btn_17"
                                                       for="check_konpoumei"></label>
                                            </div>
                                        </td>
                                        <td style="width:60px!important;">
                                            <input type="tel" name="konpoumei" id="setting_konpoumei"
                                                   class="form-control text-right" maxlength="2" autocomplete="off"
                                                   oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                                        </td>
                                        <td class="text-left">
                                            <span class="mt-1 text-left">単位</span>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <div class="custom-control custom-checkbox custom-control-inline"
                                                 style="margin-left: 21px!important;">
                                                <input type="checkbox" name="check_data104" id="check_data104"
                                                       class=" custom-control-input customCheckBox">
                                                <label class="custom-control-label margin_btn_17"
                                                       for="check_data104"></label>
                                            </div>
                                        </td>
                                        <td style="width:60px!important;">
                                            <input type="tel" name="data104" id="setting_data104"
                                                   class="form-control text-right" maxlength="2" autocomplete="off"
                                                   oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                                        </td>
                                        <td class="text-left">
                                            <span class="mt-1 text-left">保守会社CD</span>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <div class="custom-control custom-checkbox custom-control-inline"
                                                 style="margin-left: 21px!important;">
                                                <input type="checkbox" name="check_created_date" id="check_created_date"
                                                       class=" custom-control-input customCheckBox">
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
                                                 style="margin-left: 21px!important;">
                                                <input type="checkbox" name="check_created_time" id="check_created_time"
                                                       class=" custom-control-input customCheckBox">
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
                                                 style="margin-left: 21px!important;">
                                                <input type="checkbox" name="check_edited_date" id="check_edited_date"
                                                       class=" custom-control-input customCheckBox">
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
                                                 style="margin-left: 21px!important;">
                                                <input type="checkbox" name="check_edited_time" id="check_edited_time"
                                                       class=" custom-control-input customCheckBox">
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
                                                 style="margin-left: 21px!important;">
                                                <input type="checkbox" name="check_code3" id="check_code3"
                                                       class="custom-control-input customCheckBox">
                                                <label class="custom-control-label margin_btn_17"
                                                       for="check_code3"></label>
                                            </div>
                                        </td>
                                        <td style="width:60px!important;">
                                            <input type="tel" name="code3" id="setting_code3"
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
                                                 style="margin-left: 21px!important;">
                                                <input type="checkbox" name="check_user_name" id="check_user_name"
                                                       class=" custom-control-input customCheckBox">
                                                <label class="custom-control-label margin_btn_17"
                                                       for="check_user_name"></label>
                                            </div>
                                        </td>
                                        <td style="width:60px!important;">
                                            <input type="tel" name="user_name" id="setting_user_name"
                                                   class="form-control text-right" maxlength="2"
                                                   onkeydown="lastTab(event)" autocomplete="off"
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
                <div class="modal-footer">
                    <a type="button" id="tableSettingSubmit" class="btn btn-info"><i class="fas fa-save"
                                                                                     style="margin-right: 5px;"></i>保存
                    </a>
                </div>
            </div>
        </div>
    </div>
</form>
<script type="text/javascript">

    $(document).ready(function(){
    $('#setting_display_modal').attr('autocomplete', 'off');
    });
</script>
