<form id="registrationForm" action="{{route('postEditNameMaster',[$bango])}}" data-regmethod="registerName"
      method="post">
    @csrf
    <input type="hidden" name="type" value="create">
    <input type="hidden" name="validate_only" value="1">
    <div class="modal" data-keyboard="false" data-backdrop="static" id="name_modal1" role="dialog"
         aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" style="max-width: 700px !important;" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body pt-0" data-bind="nextFieldOnEnter:true">
                    <div class="development_page_top_table heading_mt" style="margin: 11px !important;">

                        {{-- Error Message Starts Here --}}
                        <div class="col-12 pl-0" style="margin-left: -26px !important;">
                            <div id="error_data"></div>
                        </div>
                        {{-- Error Message Ends Here --}}

                        <div class="row titlebr" style="margin-bottom: 15px;">
                            <div class="col-6 pl-1">
                                <table class="dev_tble_button" style="float: left;">
                                    <tbody>
                                    <tr class="marge_in">
                                        <td class="" style="padding-left: 0px!important;width: 70px!important;">
                                            <h5>名称マスタ(登録)</h5>
                                            <div class="mt-3">新規（処理状況）</div>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-6 pr-1">
                                <div style="float: right;">
                                    <button name="insert" id="regButton"
                                            onclick="registerName('{{route("postEditNameMaster",[$bango])}}')"
                                            class="btn btn-info scroll" type="button" autofocus>
                                        <i class="fas fa-save" style="margin-right: 5px;"></i>保存
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="input_boxwrap_n1" class="input_boxwrap_n1 custom-form">
                        <div class="row mt-1 mb-3">
                            <div class="col-lg-12">
                                <div class="tbl_name">
                                    <div class="w-100">
                                        <div class=" row row_data">
                                            <div class="col-lg-3">
                                                <div class="margin_t ">
                                                    <span>名称CD <span style="color: red;">※</span></span>
                                                </div>
                                            </div>
                                            <div class="col-lg-9">
                                                <div class="outer row">
                                                    <div class="col-lg-12 ">
                                                        <input type="text" class="form-control" value=""
                                                               name="category1" id="insert_category1">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class=" row row_data">
                                            <div class="col-lg-3">
                                                <div class="margin_t "><span>分類CD<span
                                                            style="color: red;">※</span></span></div>
                                            </div>
                                            <div class="col-lg-9">
                                                <div class="outer row">
                                                    <div class="col-lg-12 ">
                                                        <input type="text" class="form-control" value=""
                                                               name="category2" id="insert_category2">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class=" row row_data">
                                            <div class="col-lg-3">
                                                <div class="margin_t "><span>名称名<span
                                                            style="color: red;">※</span></span></div>
                                            </div>
                                            <div class="col-lg-9">
                                                <div class="outer row">
                                                    <div class="col-lg-12 ">
                                                        <input type="text" class="form-control" value=""
                                                               name="category3" id="insert_category3" readonly>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class=" row row_data">
                                            <div class="col-lg-3">
                                                <div class="margin_t "><span>分類名</span> <span
                                                        style="color: red;">※</span></div>
                                            </div>
                                            <div class="col-lg-9">
                                                <div class="outer row">
                                                    <div class="col-lg-12 ">
                                                        <input type="text" class="form-control" value=""
                                                               name="category4" id="insert_category4">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class=" row row_data">
                                            <div class="col-lg-3">
                                                <div class="margin_t "><span>名称名略称</span> <span
                                                        style="color: red;">※</span></div>
                                            </div>
                                            <div class="col-lg-9">
                                                <div class="outer row">
                                                    <div class="col-lg-12 ">
                                                        <input type="text" class="form-control" value=""
                                                               name="category5" id="insert_category5" readonly>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class=" row row_data">
                                            <div class="col-lg-3">
                                                <div class="margin_t "><span>分類名略称</span> <span
                                                        style="color: red;">※</span></div>
                                            </div>
                                            <div class="col-lg-9">
                                                <div class="outer row">
                                                    <div class="col-lg-12 ">
                                                        <input type="text" class="form-control" value=""
                                                               name="groupbango" id="insert_groupbango">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class=" row row_data">
                                            <div class="col-lg-3">
                                                <div class="margin_t "><span>分類CD桁数<span
                                                            style="color: red;">※</span></span></div>
                                            </div>
                                            <div class="col-lg-9">
                                                <div class="outer row">
                                                    <div class="col-lg-12 ">
                                                        <input type="text" class="form-control" value="" name="osusume"
                                                               id="insert_osusume">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class=" row row_data">
                                            <div class="col-lg-3">
                                                <div class="margin_t "><span>表示順</span> <span
                                                        style="color: red;">※</span></div>
                                            </div>
                                            <div class="col-lg-9">
                                                <div class="outer row">
                                                    <div class="col-lg-12 ">
                                                        <input type="text" class="form-control" value="" name="suchi1"
                                                               id="insert_suchi1">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class=" row row_data">
                                            <div class="col-lg-3">
                                                <div class="margin_t " style="margin-top:12px;"><span>変更可否</span> <span
                                                        style="color: red;">※</span></div>
                                            </div>
                                            <div class="col-lg-9">
                                                <div class="outer row">
                                                    <div class="col-lg-12 ">
                                                        <div class="radio-rounded d-inline-block"
                                                             style="margin-top:10px;margin-bottom:8px;">

                                                            <div
                                                                class="custom-control custom-radio custom-control-inline"
                                                                style="padding-left:11px!important;">
                                                                <input type="radio" class="custom-control-input"
                                                                       id="changed" name="changed" value="1 可"/>
                                                                <label class="custom-control-label" for="changed"
                                                                       style="font-size: 12px!important;cursor:pointer;">可 </label>
                                                            </div>
                                                            <div
                                                                class="custom-control custom-radio custom-control-inline"
                                                                style="padding-left: 26px!important;">
                                                                <input type="radio" class="custom-control-input"
                                                                       id="changed1" name="changed" value="2 不可" />
                                                                <label class="custom-control-label" for="changed1"
                                                                       style="font-size: 12px!important;cursor:pointer;">
                                                                    不可 </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class=" row row_data">
                                            <div class="col-lg-3">
                                                <div class="margin_t "><span>予備1</span></div>
                                            </div>
                                            <div class="col-lg-9">
                                                <div class="outer row">
                                                    <div class="col-lg-12 ">
                                                        <input type="text" class="form-control" value="" id="insert_spare_one" name="spare_one">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class=" row row_data">
                                            <div class="col-lg-3">
                                                <div class="margin_t "><span>予備2</span></div>
                                            </div>
                                            <div class="col-lg-9">
                                                <div class="outer row">
                                                    <div class="col-lg-12 ">
                                                        <input type="text" class="form-control" value="" id="insert_spare_two" name="spare_two">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class=" row row_data">
                                            <div class="col-lg-3">
                                                <div class="margin_t "><span>予備3</span></div>
                                            </div>
                                            <div class="col-lg-9">
                                                <div class="outer row">
                                                    <div class="col-lg-12 ">
                                                        <input type="text" class="form-control" value="" id="insert_spare_three" name="spare_three">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">

                </div>
            </div>
        </div>
    </div>
</form>
