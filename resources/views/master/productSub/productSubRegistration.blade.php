<form id="registrationForm" action="{{ route('postEditProductSubMaster',[$bango]) }}" method="post"
      data-regmethod="registerProductSub"
      onsubmit="registerProductSub('{{route("postEditProductSubMaster",[$bango])}}');event.preventDefault();">
    @csrf
    <input type="hidden" name="type" value="create">
    <input type="hidden" name="validate_only" value="1">
    <div class="modal" data-keyboard="false" data-backdrop="static" id="product_sub_modal1" role="dialog"
         aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document" style="max-width: 800px;">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body pt-0" data-bind="nextFieldOnEnter:true">
                    <div class="development_page_top_table heading_mt mt-0" style="margin: 11px !important;">
                        {{-- <div class="row titlebr">
                        </div> --}}

                        <div class="row titlebr" style="margin-bottom: 15px;">

                            {{-- Error Message Starts Here --}}
                            <div class="col-12 pl-0" style="margin-left: -13px !important;">
                                <div id="error_data"></div>
                            </div>
                            {{-- Error Message Ends Here --}}

                            <div class="col-6 pl-1">
                                <table class="dev_tble_button" style="float: left;">
                                    <tbody>
                                    <tr class="marge_in">
                                        <td class="" style="padding-left: 0px!important;width: 70px!important;">
                                            <h5>商品サブマスタ(登録)</h5>
                                            <div class="mt-3">新規(処理状況)</div>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-6 pr-1">
                                <div style="float: right;">
                                    <button type="submit" id="regButton" class="btn btn-info" autofocus>
                                        <i class="fas fa-save" style="margin-right: 5px;"></i>保存
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="input_boxwrap_psub1" class="input_boxwrap_psub1 custom-form">
                        <div class="table_wrap">
                            <div class="row mt-1 mb-3">
                                <div class="col-lg-12">
                                    <div class="tbl_name">
                                        <div class="w-100">
                                            <div class=" row row_data">
                                                <div class="col-lg-3 col-md-3 col-sm-3 ">
                                                    <div class="margin_t ">
                                                        <span>サブ区分</span> <span style="color: red;">※</span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-9  col-md-9 col-sm-9">
                                                    <div class="outer row">
                                                        <div class="col-lg-6 ">
                                                            <div class="custom-arrow">
                                                                <select id="insert_other1" name="other1"
                                                                        class="form-control" style="width:100%;">
                                                                    @foreach($request['1'] as $user)
                                                                        <option
                                                                            value="{{$user->syouhinbango.' '}}{{$user->jouhou}}"
                                                                            @if($user->syouhinbango == '2') selected="selected" @endif>
                                                                            {{$user->syouhinbango.' '}}{{$user->jouhou}}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
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
                                                            <div class="custom-arrow">
                                                                <select id="insert_other3" name="other3"
                                                                        class="form-control" onChange="getOther2()"
                                                                        style="width:100%;">
                                                                    @foreach($categorykanris['E4'] as $user)
                                                                        <option
                                                                            value="{{$user->category1 .''. $user->category2}}">{{$user->category2}} {{$user->category4}}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
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
                                                            <div class="custom-arrow">
                                                                <select id="insert_other4" name="other4"
                                                                        class="form-control"
                                                                        onChange="getOther4($(this).parent().find('select').val())"
                                                                        style="width:100%;">
                                                                    @foreach($categorykanris['E5'] as $user)
                                                                        <option
                                                                            value="{{$user->category1.''.$user->category2}}">
                                                                            {{$user->category2}} {{$user->category4}}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
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
                                                        <div class="col-lg-6">
                                                            <div class="custom-arrow">
                                                                <select id="insert_other25" name="other25"
                                                                        class="form-control" onChange="getOther25()"
                                                                        style="width:100%;">
                                                                    @foreach($categorykanris['E8'] as $user)
                                                                        <option
                                                                            value="{{$user->category1.''.$user->category2}}">
                                                                            {{$user->category2}} {{$user->category4}}
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
                                                        <span>商品サブCD</span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-9  col-md-9 col-sm-9">
                                                    <div class="outer row">
                                                        <div class="col-lg-6"
                                                             style="white-space: normal; word-break: break-all;">
                                                            <input id="insert_other2" name="other2" type="hidden"
                                                                   class="form-control">
                                                            <div class="" id="show25"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class=" row row_data">
                                                <div class="col-lg-3  col-md-3 col-sm-3">
                                                    <div class="margin_t ">
                                                        <span>商品サブ名称<span style="color: red;">※</span></span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-9  col-md-9 col-sm-9">
                                                    <div class="outer row">
                                                        <div class="col-lg-6 ">
                                                            <input type="text" class="form-control" id="insert_other21"
                                                                   name="other21">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class=" row row_data">
                                                <div class="col-lg-3  col-md-3 col-sm-3">
                                                    <div class="margin_t ">
                            <span>商品サブ名称カナ名
                            </span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-9  col-md-9 col-sm-9">
                                                    <div class="outer row">
                                                        <div class="col-lg-6 ">
                                                            <input type="text" class="form-control" id="insert_other5"
                                                                   name="other5">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class=" row row_data">
                                                <div class="col-lg-3  col-md-3 col-sm-3">
                                                    <div class="margin_t ">
                                                        <span>小売業略称</span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-9  col-md-9 col-sm-9">
                                                    <div class="outer row">
                                                        <div class="col-lg-6 ">
                                                            <input type="text" id="insert_other22" name="other22"
                                                                   class="form-control" size="0" maxlength="15"
                                                                   placeholder="">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class=" row row_data">
                                                <div class="col-lg-3  col-md-3 col-sm-3">
                                                    <div class="margin_t ">
                                                        <span>小売業部門</span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-9 col-md-9 col-sm-9">
                                                    <div class="outer row">
                                                        <div class="col-lg-6 ">
                                                            <input type="text" id="insert_other23" name="other23"
                                                                   class="form-control" size="0" maxlength="8"
                                                                   placeholder="">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class=" row row_data">
                                                <div class="col-lg-3  col-md-3 col-sm-3">
                                                    <div class="margin_t ">
                                                        <span>小売業メッセージ種</span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-9  col-md-9 col-sm-9">
                                                    <div class="outer row">
                                                        <div class="col-lg-6 ">
                                                            <input id="insert_other24" type="text" name="other24"
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
                                                            <input type="text" id="insert_other18" name="other18"
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
                                                            <input type="text" class="form-control" id="insert_other20"
                                                                   name="other20">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class=" row row_data">
                                                <div class="col-lg-3  col-md-3 col-sm-3">
                                                    <div class="margin_t ">
                                                        <span>商品サブ分類1</span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-9 col-md-9 col-sm-9">
                                                    <div class="outer row">
                                                        <div class="col-lg-6 ">
                                                            <div class="custom-arrow">
                                                                <select id="insert_other6" name="other6"
                                                                        class="form-control" style="width:100%;">
                                                                    <option value="">-</option>
                                                                    @foreach($categorykanris['D2'] as $user)
                                                                        <option
                                                                            value="{{$user->category1}}{{$user->category2}}">
                                                                            {{$user->category1}}{{$user->category2}}{{$user->category4}}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class=" row row_data">
                                                <div class="col-lg-3  col-md-3 col-sm-3">
                                                    <div class="margin_t ">
                                                        <span>商品サブ分類2</span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-9 col-md-9 col-sm-9">
                                                    <div class="outer row">
                                                        <div class="col-lg-6 ">
                                                            <div class="custom-arrow">
                                                                <select id="insert_other7" name="other7"
                                                                        class="form-control" style="width:100%;">
                                                                    <option value="">-</option>
                                                                    @foreach($categorykanris['D3'] as $user)
                                                                        <option
                                                                            value="{{$user->category1}}{{$user->category2}}">
                                                                            {{$user->category1}}{{$user->category2}}{{$user->category4}}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class=" row row_data">
                                                <div class="col-lg-3  col-md-3 col-sm-3">
                                                    <div class="margin_t ">
                                                        <span>商品サブ分類3</span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-9  col-md-9 col-sm-9">
                                                    <div class="outer row">
                                                        <div class="col-lg-6 ">
                                                            <div class="custom-arrow">
                                                                <select id="insert_other8" name="other8"
                                                                        class="form-control" style="width:100%;">
                                                                    <option value="">-</option>
                                                                    @foreach($categorykanris['D4'] as $user)
                                                                        <option
                                                                            value="{{$user->category1}}{{$user->category2}}">
                                                                            {{$user->category1}}{{$user->category2}}{{$user->category4}}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class=" row row_data">
                                                <div class="col-lg-3  col-md-3 col-sm-3">
                                                    <div class="margin_t ">
                                                        <span>作成者</span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-9  col-md-9 col-sm-9">
                                                    <div class="outer row">
                                                        <div class="col-lg-6 ">
                                                            <div class="custom-arrow">
                                                                <select id="insert_other12" name="other12"
                                                                        class="form-control"
                                                                        onchange="tantousyaApi(this.value);"
                                                                        style="width:100%;">
                                                                    @foreach($tantousyas as $user)
                                                                        <option value="{{$user->bango}}">
                                                                            {{$user->bango.' '}}{{$user->name}}
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
                                                <div class="col-lg-3  col-md-3 col-sm-3">
                                                    <div class="margin_t ">
                                                        <span>作成事業部</span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-9  col-md-9 col-sm-9">
                                                    <div class="outer row">
                                                        <div class="col-lg-6 ">
                                                            <div class="m_t" id="insert_other9"></div>
                                                            <input type="hidden" id="other9_hidden" name="other9">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class=" row row_data">
                                                <div class="col-lg-3  col-md-3 col-sm-3">
                                                    <div class="margin_t ">
                                                        <span>作成部</span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-9  col-md-9 col-sm-9">
                                                    <div class="outer row">
                                                        <div class="col-lg-6 ">
                                                            <div class="m_t" id="insert_other10"></div>
                                                            <input type="hidden" id="other10_hidden" name="other10">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class=" row row_data">
                                                <div class="col-lg-3  col-md-3 col-sm-3">
                                                    <div class="margin_t ">
                                                        <span>作成グループ</span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-9  col-md-9 col-sm-9">
                                                    <div class="outer row">
                                                        <div class="col-lg-6 ">
                                                            <div class="m_t" id="insert_other11"></div>
                                                            <input type="hidden" id="other11_hidden" name="other11">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class=" row row_data">
                                                <div class="col-lg-3  col-md-3 col-sm-3">
                                                    <div class="margin_t ">
                                                        <span>データ区分 </span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-9  col-md-9 col-sm-9">
                                                    <div class="outer row">
                                                        <div class="col-lg-6 ">
                                                            <div class="custom-arrow">
                                                                <select id="insert_other13" name="other13"
                                                                        class="form-control" style="width:100%;">
                                                                    <option value="">-</option>
                                                                    @foreach($request['13'] as $user)
                                                                        <option
                                                                            value="{{$user->syouhinbango}} {{$user->jouhou}}">
                                                                            {{$user->syouhinbango}} {{$user->jouhou}}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class=" row row_data">
                                                <div class="col-lg-3  col-md-3 col-sm-3">
                                                    <div class="margin_t ">
                                                        <span>作成ステータス</span><span style="color: red;"> ※</span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-9  col-md-9 col-sm-9">
                                                    <div class="outer row">
                                                        <div class="col-lg-6 ">
                                                            <div class="custom-arrow">
                                                                <select id="insert_other14" name="other14"
                                                                        class="form-control" style="width:100%;">

                                                                    @foreach($request['14'] as $user)
                                                                        <option
                                                                            value="{{$user->syouhinbango.' '}}{{$user->jouhou}}"
                                                                            @if($user->syouhinbango == '3') selected="selected" @endif>
                                                                            {{$user->syouhinbango.' '}}{{$user->jouhou}}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class=" row row_data">
                                                <div class="col-lg-3  col-md-3 col-sm-3">
                                                    <div class="margin_t ">
                                                        <span>上市開始日</span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-9  col-md-9 col-sm-9">
                                                    <div class="outer row">
                                                        <div class="col-lg-6 ">
                                                            <div class="input-group">
                                                                <input name="other15" id="insert_other15" type="text"
                                                                       class="input_field form-control"
                                                                       maxlength="8"
                                                                       onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))"
                                                                       autocomplete="off"
                                                                       style="width: 96px!important; z-index: 0;">
                                                                <div class="input-group-append"
                                                                     style="margin-left: 10px; margin-top: 7px;">
                                                                    <span id="cal_icon_insert1"
                                                                          class="fa fa-calendar"></span>
                                                                </div>
                                                            </div>
                                                            <div class="input-group">
                                                                <input ignore id="datepicker1_comShow" readonly
                                                                       type="text"
                                                                       class="input_field form-control search" value=""
                                                                       autocomplete="off"
                                                                       style="background-color: white !important; color: white !important; position: absolute ; border: 1px solid white !important;">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class=" row row_data">
                                                <div class="col-lg-3  col-md-3 col-sm-3">
                                                    <div class="margin_t ">
                                                        <span>終売日</span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-9  col-md-9 col-sm-9">
                                                    <div class="outer row">
                                                        <div class="col-lg-6 ">
                                                            <div class="input-group">
                                                                <input name="other16" id="insert_other16" type="text"
                                                                       class="input_field form-control"
                                                                       maxlength="8"
                                                                       onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))"
                                                                       autocomplete="off"
                                                                       style="width: 96px!important; z-index: 0;">
                                                                <div class="input-group-append"
                                                                     style="margin-left: 10px;margin-top: 7px;">
                                                                    <span id="cal_icon_insert2"
                                                                          class="fa fa-calendar"></span>
                                                                </div>
                                                            </div>
                                                            <div class="input-group">
                                                                <input ignore id="datepicker2_comShow" readonly
                                                                       type="text"
                                                                       class="input_field form-control search" value=""
                                                                       autocomplete="off"
                                                                       style="background-color: white !important; color: white !important; position: absolute ; border: 1px solid white !important;">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class=" row row_data">
                                                <div class="col-lg-3  col-md-3 col-sm-3">
                                                    <div class="margin_t ">
                                                        <span>入力区分 </span><span style="color: red;"> ※</span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-9 col-md-9 col-sm-9">
                                                    <div class="outer row">
                                                        <div class="col-lg-6 ">
                                                            <div class="custom-arrow">
                                                                <select id="insert_other17" name="other17"
                                                                        class="form-control" style="width:100%;">

                                                                    @foreach($request['17'] as $user)
                                                                        <option
                                                                            value="{{$user->syouhinbango.' '}}{{$user->jouhou}}">
                                                                            {{$user->syouhinbango.' '}}{{$user->jouhou}}
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

{{-- Registration Modal's Scripts Start Here --}}
<script type="text/javascript">
    function lastTab1_product(event) {
        if (event.keyCode == 13) {
            document.getElementById("reg_kokyakusyouhinbango").focus();
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
    //Page scrolling remove calendar..
    $('.modal-body').scroll(function () {
        $("#datepicker1_comShow").datepicker("hide", function () {
        }, 0);
        $("#datepicker2_comShow").datepicker("hide", function () {
        }, 0);

        $("#datepicker1_comShow").blur();
        $("#datepicker2_comShow").blur();
    });
</script>

<script type="text/javascript">
    function validateInsert15() {
        var input = $("#insert_other15").val();
        var lead = input.replace(/[^/0-9-,\//]/g, '');
        $("#insert_other15").val(lead.replace(/[^/0-9-,\//]+(?!$)/, ''));
    }
</script>

<script type="text/javascript">
    function validateInsert16() {
        var input = $("#insert_other16").val();
        var lead = input.replace(/[^/0-9-,\//]/g, '');
        $("#insert_other16").val(lead.replace(/[^/0-9-,\//]+(?!$)/, ''));
    }
</script>
{{-- Registration Modal's Scripts End Here --}}
