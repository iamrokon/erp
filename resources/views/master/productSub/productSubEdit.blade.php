<form id="editForm" action="{{ route('postEditProductSubMaster', [$bango]) }}" method="post"
    data-editmethod="editProductSub"
    onsubmit="editProductSub('{{ route('postEditProductSubMaster', [$bango]) }}');event.preventDefault();">
    @csrf
    <input type="hidden" name="type" value="edit">
    <input type="hidden" id="edit_primarykey" name="editId" value="">
    <input type="hidden" id="e_other25" name="other25">
    <input type="hidden" name="validate_only" value="1">
    <div class="modal" data-keyboard="false" data-backdrop="static" id="product_sub_modal3" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document" style="max-width: 680px !important;">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" data-bind="nextFieldOnEnter:true">
                    <div class="development_page_top_table heading_mt mt-0" style="margin: 11px !important;">
                        <div class="row titlebr" style="margin-bottom: 15px;">

                            {{-- Error Message Starts Here --}}
                            <div class="col-12 pl-0" style="margin-left: -12px !important;">
                                <div id="error_dataEdit"></div>
                            </div>
                            {{-- Error Message Ends Here --}}

                            <div class="col-6 pl-1">
                                <table class="dev_tble_button" style="float: left;">
                                    <tbody>
                                        <tr class="marge_in">
                                            <td class="" style="padding-left: 0px!important;width: 70px!important;">
                                                <h5>商品サブマスタ(変更)</h5>
                                                <div class="mt-3">変更 (処理状況)</div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-6 pr-1">
                                <div style="float: right;">
                                    <button type="submit" class="btn btn-info" id="editButton" autofocus>
                                        <i class="fas fa-save" style="margin-right: 5px;"></i>保存
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="input_boxwrap_prsub_edit" class="input_boxwrap_psub2 custom-form">
                        <div class="table_wrap">
                            <div class="row mt-1 mb-3">
                                <div class="col-lg-12">
                                    <div class="tbl_name">
                                        <div class="w-100">
                                            <div class=" row row_data">
                                                <div class="col-lg-3 col-md-3 col-sm-3">
                                                    <div class="margin_t ">
                                                        <span>サブ区分</span> <span style="color: red;">※</span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-9 col-md-9 col-sm-9">
                                                    <div class="outer row">
                                                        <div class="col-lg-6 ">
                                                            <div class="m_t" id="edit_other1"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class=" row row_data">
                                                <div class="col-lg-3  col-md-3 col-sm-3">
                                                    <div class="margin_t ">
                                                        <span>取引先</span> <span style="color: red;">※</span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-9  col-md-9 col-sm-9">
                                                    <div class="outer row">
                                                        <div class="col-lg-6 ">
                                                            <div class="m_t" id="edit_other3"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class=" row row_data">
                                                <div class="col-lg-3  col-md-3 col-sm-3">
                                                    <div class="margin_t ">
                                                        <span>データ種</span> <span style="color: red;">※</span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-9  col-md-9 col-sm-9">
                                                    <div class="outer row">
                                                        <div class="col-lg-6 ">
                                                            <div class="m_t" id="edit_other4"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class=" row row_data">
                                                <div class="col-lg-3  col-md-3 col-sm-3">
                                                    <div class="margin_t ">
                                                        <span>バージョン区分</span> <span style="color: red;">※</span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-9  col-md-9 col-sm-9">
                                                    <div class="outer row">
                                                        <div class="col-lg-6 ">
                                                            <div class="m_t" id="edit_other25"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class=" row row_data">
                                                <div class="col-lg-3 col-md-3 col-sm-3">
                                                    <div class="margin_t ">
                                                        <span>商品サブCD</span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-9 col-md-9 col-sm-9">
                                                    <div class="outer row">
                                                        <input id="edit_other2_hidden" name="other2" type="hidden"
                                                            class="form-control" value="">
                                                        <div class="col-lg-6"
                                                            style="white-space: normal; word-break: break-all;">
                                                            <div class="m_t" id="edit_other2"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class=" row row_data">
                                                <div class="col-lg-3 col-md-3 col-sm-3">
                                                    <div class="margin_t ">
                                                        <span>商品サブ名称<span style="color: red;">※</span></span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-9 col-md-9 col-sm-9">
                                                    <div class="outer row">
                                                        <div class="col-lg-6 ">
                                                            <input id="edit_other21" name="other21" type="text"
                                                                class="form-control">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class=" row row_data">
                                                <div class="col-lg-3 col-md-3 col-sm-3">
                                                    <div class="margin_t ">
                                                        <span>商品サブ名称カナ名
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-9 col-md-9 col-sm-9">
                                                    <div class="outer row">
                                                        <div class="col-lg-6 ">
                                                            <input id="edit_other5" name="other5" type="text"
                                                                class="form-control">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class=" row row_data">
                                                <div class="col-lg-3 col-md-3 col-sm-3">
                                                    <div class="margin_t ">
                                                        <span>小売業略称</span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-9 col-md-9 col-sm-9">
                                                    <div class="outer row">
                                                        <div class="col-lg-6 ">
                                                            <input type="text" name="other22" id="edit_other22"
                                                                class="form-control" size="0" maxlength="15"
                                                                placeholder="">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class=" row row_data">
                                                <div class="col-lg-3 col-md-3 col-sm-3">
                                                    <div class="margin_t ">
                                                        <span>小売業部門</span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-9 col-md-9 col-sm-9">
                                                    <div class="outer row">
                                                        <div class="col-lg-6 ">
                                                            <input type="text" name="other23" id="edit_other23"
                                                                class="form-control" size="0" maxlength="8"
                                                                placeholder="">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class=" row row_data">
                                                <div class="col-lg-3 col-md-3 col-sm-3">
                                                    <div class="margin_t ">
                                                        <span>小売業メッセージ種</span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-9 col-md-9 col-sm-9">
                                                    <div class="outer row">
                                                        <div class="col-lg-6 ">
                                                            <input type="text" id="edit_other24" name="other24"
                                                                class="form-control" size="0" maxlength="8"
                                                                placeholder="">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row row_data">
                                                <div class="col-lg-3 col-md-3 col-sm-3">
                                                    <div class="margin_t">
                                                        <span>サブCD桁数</span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-9 col-md-9 col-sm-9">
                                                    <div class="outer row">
                                                        <div class="col-lg-6 col-md-6 col-sm-8">
                                                            <input type="text" id="edit_other18" name="other18"
                                                                class="form-control" size="0" maxlength="2"
                                                                placeholder="">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row row_data">
                                                <div class="col-lg-3 col-md-3 col-sm-3">
                                                    <div class="margin_t">
                                                        <span>対応バージョン</span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-9 col-md-9 col-sm-9">
                                                    <div class="outer row">
                                                        <div class="col-lg-6 col-md-6 col-sm-8">
                                                            <input id="edit_other20" name="other20" type="text"
                                                                class="form-control">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class=" row row_data">
                                                <div class="col-lg-3 col-md-3 col-sm-3">
                                                    <div class="margin_t ">
                                                        <span>商品サブ分類1</span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-9 col-md-9 col-sm-9">
                                                    <div class="outer row">
                                                        <div class="col-lg-6 ">
                                                            <div class="custom-arrow">
                                                                <select id="edit_other6_original" name="other6"
                                                                    class="form-control" style="width:100%;">
                                                                    <option value="">-</option>
                                                                    @foreach ($categorykanris['D2'] as $user)
                                                                        <option
                                                                            value="{{ $user->category1 }}{{ $user->category2 }}">
                                                                            {{ $user->category1 }}{{ $user->category2 }}
                                                                            {{ $user->category4 }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class=" row row_data">
                                                <div class="col-lg-3 col-md-3 col-sm-3">
                                                    <div class="margin_t ">
                                                        <span>商品サブ分類2</span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-9 col-md-9 col-sm-9">
                                                    <div class="outer row">
                                                        <div class="col-lg-6 ">
                                                            <div class="custom-arrow">
                                                                <select id="edit_other7_original" name="other7"
                                                                    class="form-control" style="width:100%;">
                                                                    <option value="">-</option>
                                                                    @foreach ($categorykanris['D3'] as $user)
                                                                        <option
                                                                            value="{{ $user->category1 }}{{ $user->category2 }}">
                                                                            {{ $user->category1 }}{{ $user->category2 }}
                                                                            {{ $user->category4 }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class=" row row_data">
                                                <div class="col-lg-3 col-md-3 col-sm-3">
                                                    <div class="margin_t ">
                                                        <span>商品サブ分類3</span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-9 col-md-9 col-sm-9">
                                                    <div class="outer row">
                                                        <div class="col-lg-6 ">
                                                            <div class="custom-arrow">
                                                                <select id="edit_other8_original" name="other8"
                                                                    class="form-control" style="width:100%;">
                                                                    <option value="">-</option>
                                                                    @foreach ($categorykanris['D4'] as $user)
                                                                        <option
                                                                            value="{{ $user->category1 }}{{ $user->category2 }}">
                                                                            {{ $user->category1 }}{{ $user->category2 }}
                                                                            {{ $user->category4 }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class=" row row_data">
                                                <div class="col-lg-3 col-md-3 col-sm-3">
                                                    <div class="margin_t ">
                                                        <span>作成者</span>
                                                    </div>
                                                </div>
                                                <div class="col-lg- col-md-9 col-sm-9">
                                                    <div class="outer row">
                                                        <div class="col-lg-6 ">
                                                            <div class="custom-arrow">
                                                                <select id="edit_other12" name="other12"
                                                                    class="form-control"
                                                                    onchange="tantousyaApiEdit('{{ $bango }}');"
                                                                    style="width:100%;">
                                                                    @foreach ($tantousyas as $user)
                                                                        <option value="{{ $user->bango }}">
                                                                            {{ $user->bango . ' ' }}{{ $user->name }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3 ">
                                                            <div class="m_t"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class=" row row_data">
                                                <div class="col-lg-3 col-md-3 col-sm-3">
                                                    <div class="margin_t ">
                                                        <span>作成事業部</span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-9 col-md-9 col-sm-9">
                                                    <div class="outer row">
                                                        <div class="col-lg-6 ">
                                                            <div class="m_t" id="edit_other9"></div>
                                                            <input type="hidden" id="edit_other9_hidden" name="other9"
                                                                value="">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class=" row row_data">
                                                <div class="col-lg-3 col-md-3 col-sm-3">
                                                    <div class="margin_t ">
                                                        <span>作成部</span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-9 col-md-9 col-sm-9">
                                                    <div class="outer row">
                                                        <div class="col-lg-6 ">
                                                            <div class="m_t" id="edit_other10"></div>
                                                            <input type="hidden" id="edit_other10_hidden" name="other10"
                                                                value="">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class=" row row_data">
                                                <div class="col-lg-3 col-md-3 col-sm-3">
                                                    <div class="margin_t ">
                                                        <span>作成グループ</span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-9 col-md-9 col-sm-9">
                                                    <div class="outer row">
                                                        <div class="col-lg-6 ">
                                                            <div class="m_t" id="edit_other11"></div>
                                                            <input type="hidden" id="edit_other11_hidden" name="other11"
                                                                value="">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class=" row row_data">
                                                <div class="col-lg-3 col-md-3 col-sm-3">
                                                    <div class="margin_t ">
                                                        <span>データ区分</span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-9 col-md-9 col-sm-9">
                                                    <div class="outer row">
                                                        <div class="col-lg-6 ">
                                                            <div class="custom-arrow">
                                                                <select id="edit_other13_original" name="other13"
                                                                    class="form-control" style="width:100%;">
                                                                    <option value="">-</option>
                                                                    @foreach ($request['13'] as $user)
                                                                        <option
                                                                            value="{{ $user->syouhinbango . ' ' }}{{ $user->jouhou }}">
                                                                            {{ $user->syouhinbango . ' ' }}{{ $user->jouhou }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class=" row row_data">
                                                <div class="col-lg-3 col-md-3 col-sm-3">
                                                    <div class="margin_t ">
                                                        <span>作成ステータス</span><span style="color: red;"> ※</span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-9 col-md-9 col-sm-9">
                                                    <div class="outer row">
                                                        <div class="col-lg-6 ">
                                                            <div class="custom-arrow">
                                                                <select id="edit_other14_original" name="other14"
                                                                    class="form-control" style="width:100%;">

                                                                    @foreach ($request['14'] as $user)
                                                                        <option
                                                                            value="{{ $user->syouhinbango . ' ' }}{{ $user->jouhou }}">
                                                                            {{ $user->syouhinbango . ' ' }}{{ $user->jouhou }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class=" row row_data">
                                                <div class="col-lg-3 col-md-3 col-sm-3">
                                                    <div class="margin_t ">
                                                        <span>上市開始日</span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-9 col-md-9 col-sm-9">
                                                    <div class="outer row">
                                                        <div class="col-lg-6 ">
                                                            <div class="input-group">
                                                                <input name="other15" id="edit_other15_modified"
                                                                    type="text" maxlength="8"
                                                                    onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))"
                                                                    class="input_field form-control" autocomplete="off">
                                                                <div class="input-group-append"
                                                                    style="margin-left: 10px;margin-top: 7px;">
                                                                    <span id="cal_icon_edit1"
                                                                        class="fa fa-calendar"></span>
                                                                </div>
                                                            </div>
                                                            <div class="input-group">
                                                                <input ignore id="datepicker1_comShow_edit1" readonly
                                                                    type="text" class="input_field form-control search"
                                                                    value="" autocomplete="off"
                                                                    style="background-color: white !important; color: white !important; position: absolute ; border: 1px solid white !important;">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class=" row row_data">
                                                <div class="col-lg-3 col-md-3 col-sm-3">
                                                    <div class="margin_t ">
                                                        <span>終売日</span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-9 col-md-9 col-sm-9">
                                                    <div class="outer row">
                                                        <div class="col-lg-6 ">
                                                            <div class="input-group">
                                                                <input name="other16" id="edit_other16_modified"
                                                                    type="text" maxlength="8"
                                                                    onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))"
                                                                    class="input_field form-control" autocomplete="off">
                                                                <div class="input-group-append"
                                                                    style="margin-left: 10px;margin-top: 7px;">
                                                                    <span id="cal_icon_edit2"
                                                                        class="fa fa-calendar"></span>
                                                                </div>
                                                            </div>
                                                            <div class="input-group">
                                                                <input ignore id="datepicker1_comShow_edit2" readonly
                                                                    type="text" class="input_field form-control search"
                                                                    value="" autocomplete="off"
                                                                    style="background-color: white !important; color: white !important; position: absolute ; border: 1px solid white !important;">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class=" row row_data">
                                                <div class="col-lg-3 col-md-3 col-sm-3">
                                                    <div class="margin_t ">
                                                        <span>入力区分</span><span style="color: red;"> ※</span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-9 col-md-9 col-sm-9">
                                                    <div class="outer row">
                                                        <div class="col-lg-6 ">
                                                            <div class="custom-arrow">
                                                                <select id="edit_other17_original" name="other17"
                                                                    onchange="other17effect()" class="form-control"
                                                                    style="width:100%;">

                                                                    @foreach ($request['17'] as $user)
                                                                        <option
                                                                            value="{{ $user->syouhinbango . ' ' }}{{ $user->jouhou }}">
                                                                            {{ $user->syouhinbango . ' ' }}{{ $user->jouhou }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
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
                    </div>
                </div>
                <div class="modal-footer">

                </div>
            </div>
        </div>
    </div>
</form>

{{-- Edit Modal's Scripts Start Here --}}

<script>
    //Page scrolling remove calendar..
    $('.modal-body').scroll(function() {
        $("#datepicker1_comShow_edit1").datepicker("hide", function() {}, 0);
        $("#datepicker1_comShow_edit2").datepicker("hide", function() {}, 0);

        $("#datepicker1_comShow_edit1").blur();
        $("#datepicker1_comShow_edit2").blur();
    });

</script>

<script type="text/javascript">
    $('#product_sub_modal3').scroll(function() {
        $("#edit_other15").datepicker("hide");
        $("edit_other15").blur();
        $("#edit_other16").datepicker("hide");
        $("edit_other16").blur();
    });

</script>

<script type="text/javascript">
    function validateEdit15() {
        var input = $("#edit_other15_modified").val();
        var lead = input.replace(/[^/0-9-,\//]/g, '');
        $("#edit_other15_modified").val(lead.replace(/[^/0-9-,\//]+(?!$)/, ''));
    }

</script>

<script type="text/javascript">
    function validateEdit16() {
        var input = $("#edit_other16_modified").val();
        var lead = input.replace(/[^/0-9-,\//]/g, '');
        $("#edit_other16_modified").val(lead.replace(/[^/0-9-,\//]+(?!$)/, ''));
    }

</script>

{{-- Edit Modal's Scripts End Here --}}
