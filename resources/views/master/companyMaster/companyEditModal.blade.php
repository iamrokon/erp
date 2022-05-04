<form id="editForm" action="{{ route('postEditCompanyMaster',[$bango]) }}" method="post" data-editmethod="editCompany"
  onsubmit="editCompany('{{route("postEditCompanyMaster",[$bango])}}'); event.preventDefault();"
  enctype='multipart/form-data'>
  @csrf
  <input type="hidden" name="type" value="edit">
  <input type="hidden" id="edit_hiddenBango" name="bango" value="">
  <input type="hidden" id="edit_hiddenYobi12" name="yobi12" value="">
  <div class="modal custom-form" data-keyboard="false" data-backdrop="static" id="comp_modal3" role="dialog"
    aria-labelledby="exampleModalLabel" style="display: none;" aria-hidden="true">
    <div class="modal-dialog " style="max-width: 1050px;z-index: 1052;" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"></h5>
          <div class="edit_hover_message" style="height:15px; color:red;padding-left: 15px;"></div>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body" data-bind="nextFieldOnEnter:true">
          <div class="development_page_top_table heading_mt" style="margin:0 15px;">
            <div class="row titlebr" style="margin-bottom: 15px;">

              {{-- Error Message Starts Here --}}
              <div class="col-lg-12 pl-1">
                <div id="edit_error_data"></div>
              </div>
              {{-- Error Message Ends Here --}}

              <div class="col-lg-12">
                <div style="display: inline;">
                  <div style="float:left; ">
                    <table class="dev_tble_button">
                      <tbody>
                        <tr>
                          <td class="" style="padding-left: 0px!important;width: 100px!important;border:none!important; ">
                            <h5>会社マスタ（変更）</h5>
                            <div class="mt-3"> 変更(処理状況)</div>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                  <div style="float: right;">
                    <button message="@if(array_key_exists('edit', $buttonMessage)){{$buttonMessage['edit']}}@endif"
                      id="editButton" type="submit" class="btn btn-info scroll edit_message_content" autofocus
                      style="height: 26px;">
                      <i class="fa fa-save" aria-hidden="true" style="margin-right: 5px;"></i>保存
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="container h-100 py-2">
            <ul class="nav nav-tabs " id="myTab" role="tablist">
              <li class="nav-item">
                <a class="nav-link  active show" id="common3-tab" data-toggle="tab" href="#common3" role="tab"
                  aria-controls="common3" aria-selected="true"><b>共通</b>
                </a>
              </li>
              <li class="nav-item" id="edit_nav_item_2">
                <a class="nav-link " id="sales_billing3_tab" data-toggle="tab" href="#sales_billing3" role="tab"
                  aria-controls="sales_billing3" aria-selected="false"><b>売上・請求</b>
                </a>
              </li>
              <li class="nav-item" id="edit_nav_item_3">
                <a class="nav-link " id="payment3-tab" data-toggle="tab" href="#payment3" role="tab"
                  aria-controls="payment3" aria-selected="false"><b>仕入・支払</b>
                </a>
              </li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane h-100 p-3 border active show" id="common3" role="tabpanel" aria-labelledby="common3-tab">
                <div id="input_boxwrap_common3" >
                  <div class="row mt-1 mb-3">
                    <div class="col-lg-12 col-md-12">
                      <div class="tbl_product w-100">
                        <div class=" row row_data custom-mb2">
                          <div class="col-lg-2 col-md-4 ">
                            <div class="margin_t ">
                              <span>会社CD <span style="color: red;">※</span></span>
                            </div>
                          </div>
                          <div class="col-lg-8 col-md-8 ">
                            <div class="outer row">
                              <div class="col-lg-4 col-md-3">
                                  <input name="yobi12" type="text" class="input_field form-control" id="edit_yobi12" value=""
                                  readonly="" style="border:none!important;outline: 0!important;">
                              </div>
                              <div class="col-lg-3 col-md-4 ">
                                <div>法人マイナンバー</div>
                              </div>
                              <div class="col-lg-3 col-md-3  ">
                                <input name="kounyusu" id="edit_kounyusu" type="text" class="input_field form-control" value=""  placeholder="">
                              </div>
                              <div class="col-lg-2 col-md-2">

                              </div>
                            </div>
                          </div>
                        </div>
                        <div class=" row row_data custom-mb2">
                          <div class="col-lg-2 col-md-4 ">
                            <div class="margin_t ">
                              <span>会社名</span> <span style="color: red;">※</span>
                            </div>
                          </div>
                          <div class="col-lg-10 col-md-8">
                            <div class="outer row">
                              <div class="col-8 ">
                                <input name="name" id="edit_name" type="text" class="input_field form-control">
                              </div>
                              <div class="col-4 p-0 ">
                                <div class="m_t" style=""> （全角推奨）</div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class=" row row_data custom-mb2">
                          <div class="col-lg-2 col-md-4 ">
                            <div class="margin_t ">
                              <span>会社名略称</span> <span style="color: red;">※</span>
                            </div>
                          </div>
                          <div class="col-lg-10 col-md-8">
                            <div class="outer row">
                              <div class="col-lg-8 col-md-8  ">
                                <input name="address" id="edit_address" type="text" class="input_field form-control">
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class=" row row_data custom-mb2">
                          <div class="col-lg-2 col-md-4">
                            <div class="margin_t ">
                              <span>会社名カナ</span>
                            </div>
                          </div>
                          <div class="col-lg-10 col-md-8">
                            <div class="outer row">
                              <div class="col-lg-8 col-md-8">
                                <input name="furigana" id="edit_furigana" type="text" class="input_field form-control">
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class=" row row_data">
                          <div class="col-lg-2 col-md-4">
                            <div class="margin_t ">
                              <span>会社名カナ入金消込用
                              </span>
                            </div>
                          </div>
                          <div class="col-lg-10 col-md-8 ">
                            <div class="outer row">
                              <div class="col-lg-8 col-md-8  ">
                                <input name="datatxt0050" id="edit_datatxt0050" type="text"
                                  class="input_field form-control">
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row mt-1 mb-3">
                    <div class="col-lg-4 col-md-4">
                      <div class="tbl_product w-100">
                        <div class=" row row_data custom-mb2">
                          <div class="col-lg-3 col-md-4">
                            <div class="margin_t ">
                              <span>入力区分</span><span style="color: red;">※</span>
                            </div>
                          </div>
                          <div class="col-lg-9 col-md-8  ">
                            <div class="outer row">
                              <div class="col-lg-12 col-md-12 ">
                                <div class="custom-arrow">
                                  <select name="yubinbango" id="edit_yubinbango" class="form-control left_select ">
                                    <!--<option value="">-</option>-->
                                    @foreach($request_yubinbango as $yubinbango)
                                    <option value="{{$yubinbango->syouhinbango.' '}}{{$yubinbango->jouhou}}">
                                      {{$yubinbango->syouhinbango.' '}}{{$yubinbango->jouhou}}</option>
                                    @endforeach
                                  </select>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-4 col-md-4">
                      <div class="tbl_product w-100">
                        <div class=" row row_data custom-mb2">
                          <div class="col-lg-4 col-md-6">
                            <div class="margin_t ">
                              <span>会計取引先CD</span>
                            </div>
                          </div>
                          <div class="col-lg-8 col-md-6 ">
                            <div class="outer row">
                              <div class="col-lg-12 col-md-12 ">
                                <input name="syukeitukikijun" id="edit_syukeitukikijun" type="text"
                                  class="input_field form-control" placeholder="">
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-4 col-md-4">
                      <div class="tbl_product w-100">
                        <div class=" row row_data">
                          <div class="col-lg-4 col-md-6">
                            <div class="margin_t ">
                              <span>旧取引先CD</span>
                            </div>
                          </div>
                          <div class="col-lg-8 col-md-6">
                            <div class="outer row">
                              <div class="col-lg-12 col-md-12 ">
                                <input name="syukeinen" id="edit_syukeinen" type="text" class="input_field form-control"
                                  placeholder="">
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row mt-1 mb-3">
                    <div class="col-lg-7 col-md-12">
                      <div class="tbl_product w-100">
                        <div class=" row row_data custom-mb2">
                          <div class="col-lg-4 col-md-4">
                            <div class="margin_t ">
                              <span>帝国ﾃﾞｰﾀﾊﾞﾝｸ信用録PDF</span>
                            </div>
                          </div>
                          <div class="col-lg-8 col-md-8">
                            <div class="outer row">
                              <div class="col-lg-9 col-md-12 ">
                                <div style="float: left;width: 65%">
                                  <input name="yobi13" id="edit_yobi13" type="text" readonly="true"
                                    class="input_field form-control" style="background:#fff;">
                                  <input name="old_yobi13" id="edit_old_yobi13" type="hidden">
                                  <input name="old_yobi13_short" id="edit_old_yobi13_short" type="hidden">
                                </div>
                                <div style="float: left;width: 30%;margin-left: 2%;">
                                  <div class="custom-file mb-3">
                                    <input type="file" accept=".pdf" class="custom-file-input2" id="customFile2" name="filename">
                                    <a class="btn btn-info" href="#">
                                      <label tabindex="0" class="input-file-trigger" for="customFile2" style="margin: 0;">
                                        <i class="fa fa-search" aria-hidden="true" style="margin-right: 5px;">
                                        </i>参照
                                      </label>
                                    </a>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class=" row row_data">
                          <div class="col-lg-4 col-md-4">
                            <div class="margin_t ">
                              <span>信用録書類保管番号
                              </span>
                            </div>
                          </div>
                          <div class="col-lg-8 col-md-8">
                            <div class="outer row">
                              <div class="col-lg-12 col-md-12 ">
                                <input name="bunrui6" id="edit_bunrui6" type="text" class="input_field form-control">
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class=" row row_data custom-mb2">
                          <div class="col-lg-4 col-md-4">
                            <div class="margin_t ">
                              <span>帝国ﾃﾞｰﾀﾊﾞﾝｸ取得年月日</span>
                            </div>
                          </div>
                          <div class="col-lg-8 col-md-8">
                            <div class="outer row">
                              <div class="col-lg-12 col-md-12 ">
                                <div class="input-group">
                                  <input name="tel" id="edit_tel" {{-- id="datepicker6_comShow"  --}} type="text"
                                    maxlength="8"
                                    onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))"
                                    class="input_field form-control" autocomplete="off">
                                  <div class="input-group-append" style="margin-left: 10px; margin-top: 7px;">
                                    <span id="cal_icon6_c" class="fa fa-calendar"></span>
                                  </div>
                                </div>
                                <div class="input-group">
                                  <input ignore id="datepicker6_comShow" readonly type="text" class="input_field form-control" value="" autocomplete="off"
                                    style="background-color: white !important; color: white !important; position: absolute ; border: 1px solid white !important;">
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class=" row row_data custom-mb2">
                          <div class="col-lg-4 col-md-4 ">
                            <div class="margin_t ">
                              <span>帝国ﾃﾞｰﾀﾊﾞﾝｸ企業CD</span>
                            </div>
                          </div>
                          <div class="col-lg-8 col-md-8">
                            <div class="outer row">
                              <div class="col-lg-12 col-md-12  ">
                                <input name="fax" id="edit_fax" type="text" class="input_field form-control">
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class=" row row_data custom-mb2">
                          <div class="col-lg-4  col-md-4">
                            <div class="margin_t ">
                              <span>帝国ﾃﾞｰﾀﾊﾞﾝｸ評点</span>
                            </div>
                          </div>
                          <div class="col-lg-8 col-md-8">
                            <div class="outer row">
                              <div class="col-lg-12 col-md-12 ">
                                <input name="torihikisakibango" id="edit_torihikisakibango" type="text" class="input_field form-control">
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class=" row row_data custom-mb2">
                          <div class="col-lg-4 col-md-4">
                            <div class="margin_t ">
                              <span>経済産業省業種区分1</span>
                            </div>
                          </div>
                          <div class="col-lg-8 col-md-8 ">
                            <div class="outer row">
                              <div class="col-lg-12 col-md-12  ">
                                <div class="custom-arrow">
                                  <select name="tantousya" id="edit_tantousya" data-bango="{{ $bango }}"
                                    class="form-control left_select ">
                                    <option data-categoryType="null" data-categoryValue="null" value="">-</option>
                                    @foreach($reg_tantousya as $rgTantousya)
                                    <option data-categoryType="{{$rgTantousya->category1}}"
                                      data-categoryValue="{{$rgTantousya->category2}}"
                                      value="{{$rgTantousya->category1}}{{$rgTantousya->category2}}">
                                      {{$rgTantousya->category1}}{{$rgTantousya->category2.' '}}{{$rgTantousya->category4}}
                                    </option>
                                    @endforeach
                                  </select>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class=" row row_data custom-mb2">
                          <div class="col-lg-4 col-md-4">
                            <div class="margin_t ">
                              <span>経済産業省業種区分2</span>
                            </div>
                          </div>
                          <div class="col-lg-8 col-md-8 ">
                            <div class="outer row">
                              <div class="col-lg-12 col-md-12  ">
                                <div class="custom-arrow">
                                  <select name="kcode1" id="edit_kcode1" class="form-control left_select ">
                                    <option value="">-</option>
                                    @foreach($kcode1 as $kCode1)
                                    <option value="{{$kCode1->category1}}{{$kCode1->category2}}">
                                      {{$kCode1->category1}}{{$kCode1->category2.' '}}{{$kCode1->category4}}</option>
                                    @endforeach
                                  </select>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-5 col-md-12">
                      <div class="tbl_product w-100">
                        <div class=" row row_data custom-mb2">
                          <div class="col-lg-3  col-md-4">
                            <div class="margin_t ">
                              <span>基本業種</span>
                            </div>
                          </div>
                          <div class="col-lg-9 col-md-8 ">
                            <div class="outer row">
                              <div class="col-lg-12 col-md-12  ">
                                <div class="custom-arrow">
                                  <select name="kcode2" id="edit_kcode2" class="form-control left_select ">
                                    <option value="">-</option>
                                    @foreach($kcode2 as $kCode2)
                                    <option value="{{$kCode2->category1}}{{$kCode2->category2}}">
                                      {{$kCode2->category1}}{{$kCode2->category2.' '}}{{$kCode2->category4}}</option>
                                    @endforeach
                                  </select>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class=" row row_data custom-mb2">
                          <div class="col-lg-3 col-md-4">
                            <div class="margin_t ">
                              <span>年商</span>
                            </div>
                          </div>
                          <div class="col-lg-9 col-md-8 ">
                            <div class="outer row">
                              <div class="col-lg-12 col-md-12  ">
                                <div class="custom-arrow">
                                  <select name="stoiawsestart" id="edit_stoiawsestart"
                                    class="form-control left_select ">
                                    <option value="">-</option>
                                    @foreach($stoiawsestart as $stoiawsest)
                                    <option value="{{$stoiawsest->category1}}{{$stoiawsest->category2}}">
                                      {{$stoiawsest->category1}}{{$stoiawsest->category2.' '}}{{$stoiawsest->category4}}
                                    </option>
                                    @endforeach
                                  </select>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class=" row row_data custom-mb2">
                          <div class="col-lg-3 col-md-4 ">
                            <div class="margin_t ">
                              <span>従業員</span>
                            </div>
                          </div>
                          <div class="col-lg-9 col-md-8 ">
                            <div class="outer row">
                              <div class="col-lg-12 col-md-12 ">
                                <div class="custom-arrow">
                                  <select name="stoiawseend" id="edit_stoiawseend" class="form-control left_select ">
                                    <option value="">-</option>
                                    @foreach($stoiawseend as $stoiawsd)
                                    <option value="{{$stoiawsd->category1}}{{$stoiawsd->category2}}">
                                      {{$stoiawsd->category1}}{{$stoiawsd->category2.' '}}{{$stoiawsd->category4}}
                                    </option>
                                    @endforeach
                                  </select>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class=" row row_data custom-mb2">
                          <div class="col-lg-3 col-md-4">
                            <div class="margin_t ">
                              <span>資本金</span>
                            </div>
                          </div>
                          <div class="col-lg-9 col-md-8 ">
                            <div class="outer row">
                              <div class="col-lg-12 col-md-12 ">
                                <div class="custom-arrow">
                                  <select name="stoiawsesaiban" id="edit_stoiawsesaiban"
                                    class="form-control left_select ">
                                    <option value="">-</option>
                                    @foreach($stoiawsesaiban as $stoiawsesbn)
                                    <option value="{{$stoiawsesbn->category1}}{{$stoiawsesbn->category2}}">
                                      {{$stoiawsesbn->category1}}{{$stoiawsesbn->category2.' '}}{{$stoiawsesbn->category4}}
                                    </option>
                                    @endforeach
                                  </select>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class=" row row_data">
                          <div class="col-lg-3 col-md-4 ">
                            <div class="margin_t ">
                              <span>会社分類5</span>
                            </div>
                          </div>
                          <div class="col-lg-9 col-md-8">
                            <div class="outer row">
                              <div class="col-lg-12 col-md-12 ">
                                <div>未使用</div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row mt-1 mb-3">
                    <div class="col-lg-7 col-md-12">
                      <div class="tbl_product w-100">
                        <div class=" row row_data custom-mb2">
                          <div class="col-lg-4 col-md-4">
                            <div class="margin_t ">
                              <span>備考</span>
                            </div>
                          </div>
                          <div class="col-lg-8 col-md-8">
                            <div class="outer row">
                              <div class="col-lg-12 col-md-12 ">
                                <div class="">
                                  <textarea name="kensakukey" id="edit_kensakukey" class="form-control" rows="5" id=""
                                    style="width: 100%;height: 120px;"></textarea>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-5 col-md-12">
                      <div class="tbl_product w-100">
                        <div class=" row row_data custom-mb2">
                          <div class="col-lg-3 col-md-4">
                            <div class="margin_t ">
                              <span>売上区分</span> <span style="color: red;">※</span>
                            </div>
                          </div>
                          <div class="col-lg-9 col-md-8">
                            <div class="outer row">
                              <div class="col-lg-3 col-md-3 ">
                                <input name="syukeituki" id="edit_syukeituki" type="text" value="2"
                                  class="input_field form-control">
                              </div>
                              <div class="col-lg-5 col-md-5  ">
                                <div class="m_t" style="font-size: 12px;">1：有、2：無
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class=" row row_data">
                          <div class="col-lg-3 col-md-4">
                            <div class="margin_t ">
                              <span>仕入区分</span> <span style="color: red;">※</span>
                            </div>
                          </div>
                          <div class="col-lg-9 col-md-8">
                            <div class="outer row">
                              <div class="col-lg-3 col-md-3 ">
                                <input name="syukeikikijun" id="edit_syukeikikijun" type="text" value="2"
                                  class="input_field form-control">
                              </div>
                              <div class="col-lg-5 col-md-5">
                                <div class="m_t" style="font-size: 12px;">1：有、2：無</div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="tab-pane fade h-100 p-3 border" id="sales_billing3" role="tabpanel"
                aria-labelledby="sales_billing3_tab">
                <div id="input_boxwrap_sales_billing3" data-bind="nextFieldOnEnter:true">
                  <div class="row mt-1 mb-3">
                    <div class="col-lg-6 col-md-12">
                      <div class="tbl_company w-100">
                        <div class=" row row_data custom-mb2">
                          <div class="col-lg-4 col-md-3">
                            <div class="margin_t ">
                              <span>即時区分</span><span style="color: red;">※</span>
                            </div>
                          </div>
                          <div class="col-lg-4 col-md-3 ">
                            <div>
                              <input autofocus name="kcode3" id="edit_kcode3" type="text" value="1"
                                class="input_field form-control">
                            </div>
                          </div>
                          <div class="col-lg-2 col-md-4 d-none">
                            <div class="m_t"></div>
                          </div>
                          <div class="col-lg-4 col-md-3">
                            <div class="m_t" style="font-size: 12px;">1：即時、2：締日</div>
                          </div>
                        </div>
                        <div class=" row row_data custom-mb2">
                          <div class="col-lg-4 col-md-3">
                            <div class="margin_t ">
                              <span>請求締め日</span> <span style="color: red;">※</span></div>
                          </div>
                          <div class="col-lg-4 col-md-3">
                            <div class="custom-arrow">
                              <select name="ytoiawsestart" id="edit_ytoiawsestart" class="form-control left_select ">
                                <!--<option value="">-</option>-->
                                @foreach($ytoiawsestart as $ytoiawsest)
                                <option value="{{$ytoiawsest->category1}}{{$ytoiawsest->category2}}">
                                  {{$ytoiawsest->category1}}{{$ytoiawsest->category2.' '}}{{$ytoiawsest->category4}}
                                </option>
                                @endforeach
                              </select>
                            </div>
                          </div>
                        </div>
                        <div class=" row row_data custom-mb2">
                          <div class="col-lg-4 col-md-3">
                            <div class="margin_t ">
                              <span>入金方法</span>
                              <span style="color: red;">※</span>
                            </div>
                          </div>
                          <div class="col-lg-4 col-md-3">
                            <div class="custom-arrow">
                              <select name="ytoiawseend" id="edit_ytoiawseend" class="form-control left_select ">
                                @foreach($ytoiawseend as $ytoiawnd)
                                <option value="{{$ytoiawnd->category1}}{{$ytoiawnd->category2}}">
                                  {{$ytoiawnd->category1}}{{$ytoiawnd->category2.' '}}{{$ytoiawnd->category4}}</option>
                                @endforeach
                              </select>
                            </div>
                          </div>
                        </div>
                        <div class=" row row_data custom-mb2">
                          <div class="col-lg-4 col-md-3">
                            <div class="margin_t ">
                              <span>入金月</span><span style="color: red;">※</span>
                            </div>
                          </div>
                          <div class="col-lg-4 col-md-3">
                            <div>
                              <input name="ytoiawsesaiban" id="edit_ytoiawsesaiban" type="text" value="1"
                                class="input_field form-control">
                            </div>
                          </div>
                          <div class="col-lg-4 col-md-5">
                            <div class="m_t" style="font-size: 12px;">0：当月、1：翌月、</div>
                            <div class="m_t" style="font-size: 12px;">2：翌々月、3：3か月、4：4か月</div>
                          </div>
                        </div>
                        <div class=" row row_data custom-mb2">
                          <div class="col-lg-4 col-md-3">
                            <div class="margin_t ">
                              <span>入金日</span><span style="color: red;">※</span>
                            </div>
                          </div>
                          <div class="col-lg-4 col-md-3">
                            <div>
                              <div class="custom-arrow">
                                <select name="yetoiawsestart" id="edit_yetoiawsestart"
                                  class="form-control left_select ">
                                  {{-- <!--<option value="">-</option>
                                  @foreach($yetoiawsestart  as $yetoiawsest)
                                  <option value="{{$yetoiawsest->syouhinbango.' '}}{{$yetoiawsest->jouhou}}">{{$yetoiawsest->syouhinbango.' '}}{{$yetoiawsest->jouhou}}</option>
                                  @endforeach--> --}}
                                  <option value="1">1</option>
                                  <option value="2">2</option>
                                  <option value="3">3</option>
                                  <option value="4">4</option>
                                  <option value="5">5</option>
                                  <option value="6">6</option>
                                  <option value="7">7</option>
                                  <option value="8">8</option>
                                  <option value="9">9</option>
                                  <option value="10">10</option>
                                  <option value="11">11</option>
                                  <option value="12">12</option>
                                  <option value="13">13</option>
                                  <option value="14">14</option>
                                  <option value="15">15</option>
                                  <option value="16">16</option>
                                  <option value="17">17</option>
                                  <option value="18">18</option>
                                  <option value="19">19</option>
                                  <option value="20">20</option>
                                  <option value="21">21</option>
                                  <option value="22">22</option>
                                  <option value="23">23</option>
                                  <option value="24">24</option>
                                  <option value="25">25</option>
                                  <option value="26">26</option>
                                  <option value="27">27</option>
                                  <option value="28">28</option>
                                  <option value="29">29</option>
                                  <option value="30">30</option>
                                  <option value="31" selected>月末</option>
                                </select>
                              </div>
                            </div>
                          </div>
                          <div class="col-lg-4 col-md-5">
                            <div class="m_t"></div>
                          </div>
                        </div>
                        <div class=" row row_data custom-mb2">
                          <div class="col-lg-4 col-md-3">
                            <div class="margin_t ">
                              <span>入金日休日設定</span><span style="color: red;">※</span>
                            </div>
                          </div>
                          <div class="col-lg-4 col-md-3">
                            <div>
                              <input name="yetoiawseend" id="edit_yetoiawseend" type="text" value="1"
                                class="input_field form-control">
                            </div>
                          </div>
                          <div class="col-lg-4 col-md-5">
                            <div class="m_t" style="font-size: 12px;">1：翌営業日、2：前営業日</div>
                          </div>
                        </div>
                        <div class=" row row_data custom-mb2">
                          <div class="col-lg-4 col-md-3">
                            <div class="margin_t ">
                              <span>入金振込手数料設定</span><span style="color: red;">※</span>
                            </div>
                          </div>
                          <div class="col-lg-4 col-md-3">
                            <div>
                              <input name="yetoiawsesaiban" id="edit_yetoiawsesaiban" type="text"
                                class="input_field form-control">
                            </div>
                          </div>
                          <div class="col-lg-4 col-md-5">
                            <div class="m_t" style="font-size: 12px;">1：自社、2：先方</div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-6 col-md-12">
                      <div class="tbl_company w-100">
                        <div class=" row row_data custom-mb2">
                          <div class="col-lg-5 col-md-3">
                            <div class="margin_t ">
                              <span>保守更新案内有無</span>
                            </div>
                          </div>
                          <div class="col-lg-7 col-md-3">
                            <div>
                              <div class="custom-arrow">
                                <select name="netusername" id="edit_netusername" class="form-control left_select">
                                  <!--<option value="">-</option>-->
                                  @foreach($netusername as $netusern)
                                  <option value="{{$netusern->category1}}{{$netusern->category2}}" @if($netusern->
                                    category1.$netusern->category2.' '.$netusern->category4=="F62
                                    無"){{'selected'}}@endif>
                                    {{$netusern->category1}}{{$netusern->category2.' '}}{{$netusern->category4}}
                                  </option>
                                  @endforeach
                                </select>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class=" row row_data custom-mb2">
                          <div class="col-lg-5 col-md-3">
                            <div class="margin_t ">
                              <span>ライセンス証書有無</span>
                            </div>
                          </div>
                          <div class="col-lg-7 col-md-3">
                            <div>
                              <div class="custom-arrow">
                                <select name="netuserpasswd" id="edit_netuserpasswd" class="form-control left_select ">
                                  <!--<option value="">-</option>-->
                                  @foreach($netuserpasswd as $netuserp)
                                  <option value="{{$netuserp->category1}}{{$netuserp->category2}}" @if($netuserp->
                                    category1.$netuserp->category2.' '.$netuserp->category4=="F62
                                    無"){{'selected'}}@endif>
                                    {{$netuserp->category1}}{{$netuserp->category2.' '}}{{$netuserp->category4}}
                                  </option>
                                  @endforeach
                                </select>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class=" row row_data custom-mb2">
                          <div class="col-lg-5 col-md-3">
                            <div class="margin_t ">
                              <span>検収条件</span>
                            </div>
                          </div>
                          <div class="col-lg-7 col-md-3">
                            <div>
                              <div class="custom-arrow">
                                <select name="netlogin" id="edit_netlogin" class="form-control left_select ">
                                  <option value="">-</option>
                                  @foreach($netlogin as $netlgn)
                                  <option value="{{$netlgn->category1}}{{$netlgn->category2}}">
                                    {{$netlgn->category1}}{{$netlgn->category2.' '}}{{$netlgn->category4}}</option>
                                  @endforeach
                                </select>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class=" row row_data">
                          <div class="col-lg-5 col-md-3">
                            <div class="margin_t ">
                              <span> 与信限度額</span> <span style="color: red;">※</span></div>
                          </div>
                          <div class="col-lg-4 col-md-3">
                            <div>
                              <input name="denpyostart" id="edit_denpyostart" type="text" value="3000000"
                                class="input_field form-control text-right">
                            </div>
                          </div>
                          <div class="col-lg-3 col-md-3">
                            <div class="m_t">円</div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <!-- 2nd tab1 row -->
                  <div class="row mt-1 mb-3">
                    <div class="col-lg-12 col-md-12">
                      <div class="tbl_company w-100">
                        <div class=" row row_data custom-mb2">
                          <div class="col-lg-2 col-md-3">
                            <div class="margin_t "><span>請求先CD</span></div>
                          </div>
                          <div class="col-lg-9 col-md-9">
                            <div class="outer row">
                              <div class="col-lg-6 col-md-6 ">
                                <div style="position:relative;">
                                  <input name="mail_soushin" id="edit_mail_soushin" type="text"
                                    class="input_field form-control" style="background: #fff;"
                                    onkeyup="getExtraShowingData(this,'{{$bango}}','edit_mail_soushin_extra','edit_mail_soushin_abbr')">
                                  <input name="mail_soushin_extra" id="edit_mail_soushin_extra" type="hidden">
                                </div>
                                <div class="" id="edit_box_popup1_comp" data-toggle="modal" data-target=""
                                  style="bottom: 0;float: left;margin-top: 3px;position: absolute;right: 22px;top: 0px;">
                                  <img src="{{url('img')}}\open-book.svg" height="20" width="20" alt=""
                                    style="cursor: pointer;">
                                </div>
                              </div>
                              <div id="edit_mail_soushin_abbr" class="col-lg-6 col-md-6 m_t"></div>
                            </div>
                          </div>
                        </div>
                        <div class=" row row_data custom-mb2">
                          <div class="col-lg-2 col-md-3">
                            <div class="margin_t "><span>請求書送付日</span> <span style="color: red;">※</span></div>
                          </div>
                          <div class="col-lg-9 col-md-9">
                            <div class="outer row">
                              <div class="col-lg-6 col-md-6 ">
                                <input name="mail_jyushin" id="edit_mail_jyushin" type="text" value="0"
                                  class="input_field form-control">
                              </div>
                              <div class="col-lg-6 col-md-6  ">
                                <div class="m_t">0～-9</div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class=" row row_data custom-mb2">
                          <div class="col-lg-2 col-md-3">
                            <div class="margin_t "><span>請求書メール区分</span> <span style="color: red;">※</span></div>
                          </div>
                          <div class="col-lg-9 col-md-9">
                            <div class="outer row">
                              <div class="col-lg-6 col-md-6">
                                <input name="mail_nouhin" id="edit_mail_nouhin" type="text"
                                  class="input_field form-control">
                              </div>
                              <div class="col-lg-6 col-md-6 d-none "></div>
                              <div class="col-lg-6 col-md-6 ">
                                <div class="m_t" style="font-size: 12px;">1：PDFﾒｰﾙ送信、2：ﾒｰﾙ不要</div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class=" row row_data custom-mb2">
                          <div class="col-lg-2 col-md-3">
                            <div class="margin_t "><span>請求書メール宛先</span></div>
                          </div>
                          <div class="col-lg-9 col-md-9">
                            <div class="outer row">
                              <div class="col-lg-6 col-md-6 ">
                                <input name="mail_toiawase" id="edit_mail_toiawase" type="text"
                                  class="input_field form-control">
                              </div>
                              <div class="col-lg-6 col-md-6">
                                <div class="m_t" style="font-size: 12px;"> メールパスワードを登録してください</div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class=" row row_data custom-mb2">
                          <div class="col-lg-2 col-md-3">
                            <div class="margin_t "><span>請求書UIS</span> <span style="color: red;">※</span></div>
                          </div>
                          <div class="col-lg-9 col-md-9">
                            <div class="outer row">
                              <div class="col-lg-6 col-md-6 ">
                                <input name="mail_soushin_mb" id="edit_mail_soushin_mb" type="text"
                                  class="input_field form-control">
                              </div>
                              <div class="col-lg-6 col-md-6 d-none "></div>
                              <div class="col-lg-6 col-md-6 ">
                                <div class="m_t" style="font-size: 12px;">1：PDF-UIS、2：UIS不要</div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class=" row row_data custom-mb2">
                          <div class="col-lg-2 col-md-3">
                            <div class="margin_t "><span>請求書郵送</span> <span style="color: red;">※</span></div>
                          </div>
                          <div class="col-lg-9 col-md-9">
                            <div class="outer row">
                              <div class="col-lg-6 col-md-6">
                                <input name="mail_jyushin_mb" id="edit_mail_jyushin_mb" type="text"
                                  class="input_field form-control">
                              </div>
                              <div class="col-lg-6 col-md-6 ">
                                <div class="m_t" style="font-size: 12px;">1：郵送、4：不要</div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class=" row row_data custom-mb2">
                          <div class="col-lg-2 col-md-3">
                            <div class="margin_t "><span>請求書郵送先CD</span></div>
                          </div>
                          <div class="col-lg-9 col-md-9">
                            <div class="outer row">
                              <div class="col-lg-6 col-md-6 ">
                                <div style="position:relative;">
                                  <input name="mail_nouhin_mb" id="edit_mail_nouhin_mb" type="text"
                                    class="input_field form-control" style="background: #fff"
                                    onkeyup="getExtraShowingData(this,'{{$bango}}','edit_mail_nouhin_mb_extra','edit_mail_nouhin_mb_abbr')">
                                  <input name="mail_nouhin_mb_extra" id="edit_mail_nouhin_mb_extra" type="hidden">
                                </div>
                                <div class="" id="edit_box_popup1_comp2" data-toggle="modal" data-target=""
                                  style="bottom: 0;float: left;margin-top: 3px;position: absolute;right: 22px;top: 0px;">
                                  <img src="{{url('img')}}\open-book.svg" height="20" width="20" alt=""
                                    style="cursor: pointer;">
                                </div>
                              </div>
                              <div class="col-lg-6 col-md-6 d-none "></div>
                              <div id="edit_mail_nouhin_mb_abbr" class="col-lg-6 col-md-6 m_t"></div>
                            </div>
                          </div>
                        </div>
                        <div class=" row row_data custom-mb2">
                          <div class="col-lg-2 col-md-3">
                            <div class="margin_t "><span>請求課税区分</span><span style="color: red;">※</span></div>
                          </div>
                          <div class="col-lg-9 col-md-9">
                            <div class="outer row">
                              <div class="col-lg-6 col-md-6 ">
                                <div class="custom-arrow">
                                  <select name="mail_toiawase_mb" id="edit_mail_toiawase_mb"
                                    class="form-control left_select ">
                                    <!--<option value="">-</option>-->
                                    @foreach($mail_toiawase_mb as $mailToiawaseMb)
                                    <option value="{{$mailToiawaseMb->category1}}{{$mailToiawaseMb->category2}}">
                                      {{$mailToiawaseMb->category1}}{{$mailToiawaseMb->category2.' '}}{{$mailToiawaseMb->category4}}
                                    </option>
                                    @endforeach
                                  </select>
                                </div>
                              </div>
                              <div class="col-lg-6 col-md-6 d-none "></div>
                              <div class="col-lg-6 col-md-6 "></div>
                            </div>
                          </div>
                        </div>
                        <div class=" row row_data custom-mb2">
                          <div class="col-lg-2 col-md-3">
                            <div class="margin_t "><span>請求税端数区分</span><span style="color: red;">※</span></div>
                          </div>
                          <div class="col-lg-9 col-md-9">
                            <div class="outer row">
                              <div class="col-lg-6 col-md-6 ">
                                <div class="custom-arrow">
                                  <select name="mallsoukobango1" id="edit_mallsoukobango1"
                                    class="form-control left_select ">
                                    @foreach($mallsoukobango1 as $mallsoukoBango1)
                                    <option value="{{$mallsoukoBango1->category1}}{{$mallsoukoBango1->category2}}">
                                      {{$mallsoukoBango1->category1}}{{$mallsoukoBango1->category2.' '}}{{$mallsoukoBango1->category4}}
                                    </option>
                                    @endforeach
                                  </select>
                                </div>
                              </div>
                              <div class="col-lg-6 col-md-6 d-none "></div>
                              <div class="col-lg-6 col-md-6 "></div>
                            </div>
                          </div>
                        </div>
                        <div class=" row row_data custom-mb2">
                          <div class="col-lg-2 col-md-3">
                            <div class="margin_t ">
                              <span>請求消費税計算区分</span>
                              <span style="color: red;">※</span>
                            </div>
                          </div>
                          <div class="col-lg-9 col-md-9">
                            <div class="outer row">
                              <div class="col-lg-6 col-md-6 ">
                                <input name="datatxt0051" id="edit_datatxt0051" type="text"
                                  class="input_field form-control">
                              </div>
                              <div class="col-lg-6 col-md-6 d-none "></div>
                              <div class="col-lg-6 col-md-6 ">
                                <div class="m_t" style="font-size: 12px;">1：伝票単位、2：明細単位、3：請求時一括</div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row mt-1 mb-3">
                    <div class="col-lg-6 col-md-12">
                      <div class="tbl_company w-100">
                        <div class=" row row_data custom-mb2">
                          <div class="col-lg-4 col-md-3">
                            <div class="margin_t "><span>専伝区分</span> <span style="color: red;">※</span></div>
                          </div>
                          <div class="col-lg-8 col-md-8">
                            <div class="outer row">
                              <div class="col-lg-7 col-md-7 ">
                                <input name="mallsoukobango2" id="edit_mallsoukobango2" type="text" value="2"
                                  class="input_field form-control">
                              </div>
                              <div class="col-lg-5 col-md-5 ">
                                <div class="m_t" style="font-size: 12px;">1：有、2：無</div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class=" row row_data custom-mb2">
                          <div class="col-lg-4 col-md-3">
                            <div class="margin_t "><span>指定納品書帳票CD
                              </span></div>
                          </div>
                          <div class="col-lg-8 col-md-8">
                            <div class="outer row">
                              <div class="col-lg-7 col-md-7 ">
                                <input name="mallsoukobango3" id="edit_mallsoukobango3" type="text"
                                  class="input_field form-control">
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class=" row row_data custom-mb2">
                          <div class="col-lg-4 col-md-3">
                            <div class="margin_t "><span>販売ランク</span></div>
                          </div>
                          <div class="col-lg-8 col-md-8">
                            <div class="outer row">
                              <div class="col-lg-7 col-md-7 ">
                                <div class="custom-arrow">
                                  <select name="domain" id="edit_domain" class="form-control left_select ">
                                    <option value="">-</option>
                                    @foreach($domain as $domn)
                                    <option value="{{$domn->category1}}{{$domn->category2}}">
                                      {{$domn->category1}}{{$domn->category2.' '}}{{$domn->category4}}</option>
                                    @endforeach
                                  </select>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class=" row row_data custom-mb2">
                          <div class="col-lg-4 col-md-3">
                            <div class="margin_t "><span>顧客深耕層別化</span></div>
                          </div>
                          <div class="col-lg-8 col-md-8">
                            <div class="outer row">
                              <div class="col-lg-7 col-md-7 ">
                                <div class="custom-arrow">
                                  <select name="domain2" id="edit_domain2" class="form-control left_select ">
                                    <option value="">-</option>
                                    @foreach($domain2 as $domn2)
                                    <option value="{{$domn2->category1}}{{$domn2->category2}}">
                                      {{$domn2->category1}}{{$domn2->category2.' '}}{{$domn2->category4}}</option>
                                    @endforeach
                                  </select>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class=" row row_data custom-mb2">
                          <div class="col-lg-4 col-md-3">
                            <div class="margin_t ">
                              <span>得意先分類3</span>
                            </div>
                          </div>
                          <div class="col-lg-8 col-md-8">
                            <div class="outer row">
                              <div class="col-lg-7 col-md-7 ">
                                <div class="custom-arrow">
                                  <select name="datatxt0058" id="edit_datatxt0058" class="form-control left_select ">
                                    <option value="">-</option>
                                    @foreach($datatxt0058 as $dttxt0058)
                                    <option value="{{$dttxt0058->category1}}{{$dttxt0058->category2}}">
                                      {{$dttxt0058->category1}}{{$dttxt0058->category2.' '}}{{$dttxt0058->category4}}
                                    </option>
                                    @endforeach
                                  </select>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class=" row row_data custom-mb2">
                          <div class="col-lg-4 col-md-3">
                            <div class="margin_t ">
                              <span>得意先分類4</span>
                            </div>
                          </div>
                          <div class="col-lg-8 col-md-8">
                            <div class="outer row">
                              <div class="col-lg-7 col-md-7 ">
                                <div class="custom-arrow">
                                  <select name="datatxt0059" id="edit_datatxt0059" class="form-control left_select ">
                                    <option value="">-</option>
                                    @foreach($datatxt0059 as $dttxt0059)
                                    <option value="{{$dttxt0059->category1}}{{$dttxt0059->category2}}">
                                      {{$dttxt0059->category1}}{{$dttxt0059->category2.' '}}{{$dttxt0059->category4}}
                                    </option>
                                    @endforeach
                                  </select>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class=" row row_data custom-mb2">
                          <div class="col-lg-4 col-md-3">
                            <div class="margin_t ">
                              <span>得意先分類5</span>
                            </div>
                          </div>
                          <div class="col-lg-8 col-md-8">
                            <div class="outer row">
                              <div class="col-lg-7 col-md-7 ">
                                <div class="custom-arrow">
                                  <select name="datatxt0060" id="edit_datatxt0060" class="form-control left_select ">
                                    <option value="">-</option>
                                    @foreach($datatxt0060 as $dttxt0060)
                                    <option value="{{$dttxt0060->category1}}{{$dttxt0060->category2}}">
                                      {{$dttxt0060->category1}}{{$dttxt0060->category2.' '}}{{$dttxt0060->category4}}
                                    </option>
                                    @endforeach
                                  </select>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class=" row row_data custom-mb2">
                          <div class="col-lg-4 col-md-3">
                            <div class="margin_t ">
                              <span>得意先分類6</span>
                            </div>
                          </div>
                          <div class="col-lg-8 col-md-8">
                            <div class="outer row">
                              <div class="col-lg-7 col-md-7 ">
                                <div class="custom-arrow">
                                  <select name="datatxt0061" id="edit_datatxt0061" class="form-control left_select">
                                    <option value="">-</option>
                                    @foreach($datatxt0061 as $dttxt0061)
                                    <option value="{{$dttxt0061->category1}}{{$dttxt0061->category2}}">
                                      {{$dttxt0061->category1}}{{$dttxt0061->category2.' '}}{{$dttxt0061->category4}}
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
                    <div class="col-lg-6 col-md-12">
                      <div class="tbl_company w-100">
                        <div class=" row row_data custom-mb2">
                          <div class="col-lg-5 col-md-3">
                            <div class="margin_t "><span>単価設定区分</span></div>
                          </div>
                          <div class="col-lg-7 col-md-7">
                            <div class="outer row">
                              <div class="col-lg-12 col-md-12 ">
                                <div class="custom-arrow">
                                  <select name="haisoujouhou_address" id="edit_haisoujouhou_address"
                                    class="form-control left_select ">
                                    <option value="">-</option>
                                    @foreach($haisoujouhou_address as $haisoujouhouAddress)
                                    <option
                                      value="{{$haisoujouhouAddress->category1}}{{$haisoujouhouAddress->category2}}">
                                      {{$haisoujouhouAddress->category1}}{{$haisoujouhouAddress->category2.' '}}{{$haisoujouhouAddress->category4}}
                                    </option>
                                    @endforeach
                                  </select>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class=" row row_data custom-mb2">
                          <div class="col-lg-5 col-md-3">
                            <div class="margin_t "><span>取引開始日 東直</span></div>
                          </div>
                          <div class="col-lg-7 col-md-7">
                            <div class="outer row">
                              <div class="col-lg-12 col-md-12">
                                <div class="input-group">
                                  <input name="kaiinbango" id="edit_kaiinbango" {{-- id="datepicker7_comShow"  --}}
                                    type="text" maxlength="8"
                                    onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))"
                                    class="input_field form-control" autocomplete="off">
                                  <div class="input-group-append" style="margin-left: 10px; margin-top: 7px;">
                                    <span id="cal_icon7_c" class="fa fa-calendar"></span>
                                  </div>
                                </div>
                                <div class="input-group">
                                  <input id="datepicker7_comShow" readonly ignore type="text" class="input_field form-control"
                                    value="" autocomplete="off"
                                    style="background-color: white !important; color: white !important; position: absolute ; border: 1px solid white !important;">
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class=" row row_data custom-mb2">
                          <div class="col-lg-5 col-md-3">
                            <div class="margin_t "><span>取引開始日 東流</span></div>
                          </div>
                          <div class="col-lg-7 col-md-7">
                            <div class="outer row">
                              <div class="col-lg-12  col-md-12 ">
                                <div class="input-group">
                                  <input name="zokugara" id="edit_zokugara" {{-- id="datepicker8_comShow"  --}}
                                    type="text" maxlength="8"
                                    onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))"
                                    class="input_field form-control" autocomplete="off">
                                  <div class="input-group-append" style="margin-left: 10px; margin-top: 7px;">
                                    <span id="cal_icon8_c" class="fa fa-calendar"></span>
                                  </div>
                                </div>
                                <div class="input-group">
                                  <input id="datepicker8_comShow" readonly ignore type="text" class="input_field form-control"
                                    value="" autocomplete="off"
                                    style="background-color: white !important; color: white !important; position: absolute ; border: 1px solid white !important;">
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class=" row row_data custom-mb2">
                          <div class="col-lg-5 col-md-3">
                            <div class="margin_t "><span>取引開始日 西直
                              </span></div>
                          </div>
                          <div class="col-lg-7 col-md-7">
                            <div class="outer row">
                              <div class="col-lg-12 col-md-12 ">
                                <div class="input-group">
                                  <input name="haisoujouhou_name" id="edit_haisoujouhou_name"
                                    {{-- id="datepicker9_comShow"  --}} type="text" maxlength="8"
                                    onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))"
                                    class="input_field form-control" autocomplete="off">
                                  <div class="input-group-append" style="margin-left: 10px; margin-top: 7px;">
                                    <span id="cal_icon9_c" class="fa fa-calendar"></span>
                                  </div>
                                </div>
                                <div class="input-group">
                                  <input id="datepicker9_comShow" readonly ignore type="text" class="input_field form-control"
                                    value="" autocomplete="off"
                                    style="background-color: white !important; color: white !important; position: absolute ; border: 1px solid white !important;">
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class=" row row_data custom-mb2">
                          <div class="col-lg-5 col-md-3">
                            <div class="margin_t ">
                              <span>取引開始日 西流</span>
                            </div>
                          </div>
                          <div class="col-lg-7 col-md-7">
                            <div class="outer row">
                              <div class="col-lg-12 col-md-12 ">
                                <div class="input-group">
                                  <input name="haisoujouhou_yubinbango" id="edit_haisoujouhou_yubinbango"
                                    {{-- id="datepicker10_comShow"  --}} type="text" maxlength="8"
                                    onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))"
                                    class="input_field form-control" autocomplete="off">
                                  <div class="input-group-append" style="margin-left: 10px; margin-top: 7px;">
                                    <span id="cal_icon10_c" class="fa fa-calendar"></span>
                                  </div>
                                </div>
                                <div class="input-group">
                                  <input id="datepicker10_comShow" readonly ignore type="text" class="input_field form-control"
                                    value="" autocomplete="off"
                                    style="background-color: white !important; color: white !important; position: absolute ; border: 1px solid white !important;">
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class=" row row_data custom-mb2">
                          <div class="col-lg-5 col-md-3">
                            <div class="margin_t ">
                              <span>ユーザー区分</span><span style="color: red;">※</span>
                            </div>
                          </div>
                          <div class="col-lg-7 col-md-7">
                            <div class="outer row">
                              <div class="col-lg-12 col-md-12 ">
                                <div class="custom-arrow">
                                  <select name="kcode4" id="edit_kcode4" class="form-control left_select ">
                                    <!--<option value="">-</option>-->
                                    @foreach($kcode4 as $kCode4)
                                    <option value="{{$kCode4->syouhinbango.' '}}{{$kCode4->jouhou}}">
                                      {{$kCode4->syouhinbango.' '}}{{$kCode4->jouhou}}</option>
                                    @endforeach
                                  </select>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class=" row row_data custom-mb2">
                          <div class="col-lg-5 col-md-3">
                            <div class="margin_t ">
                              <span>データソース</span>
                            </div>
                          </div>
                          <div class="col-lg-7 col-md-7">
                            <div class="outer row">
                              <div class="col-lg-12 col-md-12 ">
                                <div class="custom-arrow">
                                  <select name="kcode5" id="edit_kcode5" class="form-control left_select ">
                                    <option value="">-</option>
                                    @foreach($kcode5 as $kCode5)
                                    <option value="{{$kCode5->category1}}{{$kCode5->category2}}">
                                      {{$kCode5->category1}}{{$kCode5->category2.' '}}{{$kCode5->category4}}</option>
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

              <!-- sales and billing tabbed menu -->
              <div class="tab-pane fade h-100 p-3 border" id="payment3" role="tabpanel" aria-labelledby="payment3-tab">
                <div id="input_boxwrap_payment3" data-bind="nextFieldOnEnter:true">
                  <div class="row mt-1 mb-3">
                    <div class="col-lg-12 col-md-12">
                      <div class="tbl_company w-100">
                        <div class=" row row_data custom-mb2">
                          <div class="col-lg-2 col-md-3 ">
                            <div class="margin_t "><span>支払締め日</span> <span style="color: red;">※</span></div>
                          </div>
                          <div class="col-lg-4 col-md-3">
                            <div class="outer row">
                              <div class="col-lg-12 col-md-12 ">
                                <div class="custom-arrow">
                                  <select name="haisoujouhou_tel" autofocus id="edit_haisoujouhou_tel"
                                    class="form-control left_select ">
                                    <!--<option value="">-</option>-->
                                    @foreach($haisoujouhou_tel as $haisoujouhouTel)
                                    <option value="{{$haisoujouhouTel->category1}}{{$haisoujouhouTel->category2}}">
                                      {{$haisoujouhouTel->category1}}{{$haisoujouhouTel->category2.' '}}{{$haisoujouhouTel->category4}}
                                    </option>
                                    @endforeach
                                  </select>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="col-lg-6 col-md-6">
                            <div class="outer row">
                              <div class="col-lg-12 col-md-12 ">
                                <div class="m_t"></div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class=" row row_data custom-mb2">
                          <div class="col-lg-2 col-md-3">
                            <div class="margin_t "><span>支払月</span> <span style="color: red;">※</span></div>
                          </div>
                          <div class="col-lg-4 col-md-3">
                            <div class="outer row">
                              <div class="col-lg-12 col-md-12 ">
                                <input name="mail" id="com_edit_mail" type="text" class=" input_field form-control">
                              </div>
                            </div>
                          </div>
                          <div class="col-lg-6 col-md-6">
                            <div class="outer row">
                              <div class="col-lg-12 col-md-12 ">
                                <div class="m_t" style="font-size: 12px;">0：当月、1：翌月、2：翌々月、3：3か月、4：4か月</div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class=" row row_data custom-mb2">
                          <div class="col-lg-2 col-md-3">
                            <div class="margin_t "><span>支払日</span> <span style="color: red;">※</span></div>
                          </div>
                          <div class="col-lg-4 col-md-3">
                            <div class="outer row">
                              <div class="col-lg-12 col-md-12 ">
                                <div class="custom-arrow">
                                  <select name="sex" id="edit_sex" class="form-control left_select ">
                                    <!--<option value="">-</option>-->
                                    @foreach($sex as $sx)
                                    <option value="{{$sx->category1}}{{$sx->category2}}">
                                      {{$sx->category1}}{{$sx->category2.' '}}{{$sx->category4}}
                                    </option>
                                    @endforeach
                                  </select>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="col-lg-6 col-md-6">
                            <div class="outer row">
                              <div class="col-lg-12 col-md-12 ">
                                <div class="m_t"></div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class=" row row_data custom-mb2">
                          <div class="col-lg-2 col-md-3">
                            <div class="margin_t "><span>支払日休日設定</span> <span style="color: red;">※</span></div>
                          </div>
                          <div class="col-lg-4 col-md-3">
                            <div class="outer row">
                              <div class="col-lg-12 col-md-12 ">
                                <input name="bunrui1" id="edit_bunrui1" type="text" class="input_field form-control">
                              </div>
                            </div>
                          </div>
                          <div class="col-lg-6 col-md-6">
                            <div class="outer row">
                              <div class="col-lg-12 col-md-12 ">
                                <div class="m_t" style="font-size: 12px;">1：翌営業日、2：前営業日</div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class=" row row_data custom-mb2">
                          <div class="col-lg-2 col-md-3">
                            <div class="margin_t "><span>支払振込手数料設定</span> <span style="color: red;">※</span></div>
                          </div>
                          <div class="col-lg-4 col-md-3">
                            <div class="outer row">
                              <div class="col-lg-12 col-md-12 ">
                                <input name="bunrui2" id="edit_bunrui2" type="text" class="input_field form-control">
                              </div>
                            </div>
                          </div>
                          <div class="col-lg-6 col-md-6">
                            <div class="outer row">
                              <div class="col-lg-12 col-md-12 ">
                                <div class="m_t" style="font-size: 12px;">1：自社、2：先方</div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class=" row row_data custom-mb2">
                          <div class="col-lg-2 col-md-3">
                            <div class="margin_t "><span>支払振込手数料区分</span></div>
                          </div>
                          <div class="col-lg-4 col-md-3">
                            <div class="outer row">
                              <div class="col-lg-12 col-md-12 ">
                                <div class="custom-arrow">
                                  <select name="syukeinenkijun" id="edit_syukeinenkijun"
                                    class="form-control input_field">
                                    <option value="">-</option>
                                    @foreach($syukeinenkijun as $syukeinenkn)
                                    <option value="{{$syukeinenkn->category1}}{{$syukeinenkn->category2}}">
                                      {{$syukeinenkn->category1}}{{$syukeinenkn->category2.' '}}{{$syukeinenkn->category4}}
                                    </option>
                                    @endforeach
                                  </select>
                                </div>
                              </div>
                            </div>
                          </div>
                          {{-- <div class="col-lg-6 col-md-6">
                            <div class="outer row">
                              <div class="col-lg-12 col-md-12 ">
                                <div class="m_t" style="font-size: 12px;">1：自社、2：先方</div>
                              </div>
                            </div>
                          </div> --}}
                        </div>
                        <div class=" row row_data custom-mb2">
                          <div class="col-lg-2 col-md-3">
                            <div class="margin_t "><span>支払方法</span> <span style="color: red;">※</span></div>
                          </div>
                          <div class="col-lg-4 col-md-3">
                            <div class="outer row">
                              <div class="col-lg-12 col-md-12 ">
                                <div class="custom-arrow">
                                  <select name="bunrui3" id="edit_bunrui3" class="form-control left_select ">
                                    @foreach($bunrui3 as $bunr3)
                                    <option value="{{$bunr3->category1}}{{$bunr3->category2}}">
                                      {{$bunr3->category1}}{{$bunr3->category2.' '}}{{$bunr3->category4}}</option>
                                    @endforeach
                                  </select>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="col-lg-6 col-md-6">
                            <div class="outer row">
                              <div class="col-lg-12 col-md-12 ">
                                <div class="m_t"></div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class=" row row_data custom-mb2">
                          <div class="col-lg-2 col-md-3">
                            <div class="margin_t ">
                              <span>振込銀行</span>
                            </div>
                          </div>
                          <div class="col-lg-4 col-md-3">
                            <div class="outer row">
                              <div class="col-lg-12 col-md-12 ">
                                <input name="datatxt0054" id="edit_datatxt0054" type="text" class="form-control">
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class=" row row_data custom-mb2">
                          <div class="col-lg-2 col-md-3">
                            <div class="margin_t ">
                              <span>振込支店</span>
                            </div>
                          </div>
                          <div class="col-lg-4 col-md-3">
                            <div class="outer row">
                              <div class="col-lg-12 col-md-12 ">
                                <input name="datatxt0055" id="edit_datatxt0055" type="text" class="form-control">
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class=" row row_data custom-mb2">
                          <div class="col-lg-2 col-md-3">
                            <div class="margin_t ">
                              <span>預金種別</span>
                            </div>
                          </div>
                          <div class="col-lg-4 col-md-3">
                            <div class="outer row">
                              <div class="col-lg-12 col-md-12 ">
                                <div class="custom-arrow">
                                  <select name="endtime" id="edit_endtime" class="form-control left_select ">
                                    <option value="">-</option>
                                    @foreach($endtime as $endtm)
                                    <option value="{{$endtm->syouhinbango}}">{{$endtm->syouhinbango}}</option>
                                    @endforeach
                                  </select>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class=" row row_data custom-mb2">
                          <div class="col-lg-2 col-md-3">
                            <div class="margin_t ">
                              <span>口座番号</span>
                            </div>
                          </div>
                          <div class="col-lg-4 col-md-3">
                            <div class="outer row">
                              <div class="col-lg-12  col-md-12">
                                <input name="datatxt0056" id="edit_datatxt0056" type="text" class="form-control">
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class=" row row_data custom-mb2">
                          <div class="col-lg-2 col-md-3">
                            <div class="margin_t ">
                              <span>口座名義人</span>
                            </div>
                          </div>
                          <div class="col-lg-4 col-md-3">
                            <div class="outer row">
                              <div class="col-lg-12 col-md-12 ">
                                <input name="datatxt0057" id="edit_datatxt0057" type="text" class="form-control">
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class=" row row_data custom-mb2">
                          <div class="col-lg-2 col-md-3">
                            <div class="margin_t ">
                              <span>支払手形サイト</span>
                            </div>
                          </div>
                          <div class="col-lg-4 col-md-3">
                            <div class="outer row">
                              <div class="col-lg-12 col-md-12">
                                <input type="text" name="syukei3" id="edit_syukei3" class=" input_field form-control">
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class=" row row_data custom-mb2">
                          <div class="col-lg-2 col-md-3">
                            <div class="margin_t ">
                              <span>仕向銀行</span>
                            </div>
                          </div>
                          <div class="col-lg-4 col-md-3">
                            <div class="outer row">
                              <div class="col-lg-12  col-md-12">
                                <div class="custom-arrow">
                                  <select name="syukeiki" id="edit_syukeiki" class="form-control left_select ">
                                    <option value="">-</option>
                                    @foreach($syukeiki as $syuk)
                                    <option value="{{$syuk->category1}}{{$syuk->category2}}">
                                      {{$syuk->category1}}{{$syuk->category2.' '}}{{$syuk->category4}}</option>
                                    @endforeach
                                  </select>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class=" row row_data custom-mb2">
                          <div class="col-lg-2 col-md-3">
                            <div class="margin_t ">
                              <span>仕向支店</span>
                            </div>
                          </div>
                          <div class="col-lg-4 col-md-3">
                            <div class="outer row">
                              <div class="col-lg-12 col-md-12">
                                <div class="custom-arrow">
                                  <select name="datatxt0053" id="edit_datatxt0053" class="form-control left_select ">
                                    <option value="">-</option>
                                    @foreach($datatxt0053 as $dttxt0053)
                                    <option value="{{$dttxt0053->category1}}{{$dttxt0053->category2}}">
                                      {{$dttxt0053->category1}}{{$dttxt0053->category2.' '}}{{$dttxt0053->category4}}
                                    </option>
                                    @endforeach
                                  </select>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class=" row row_data custom-mb2">
                          <div class="col-lg-2 col-md-3">
                            <div class="margin_t "><span>支払課税区分</span> <span style="color: red;">※</span></div>
                          </div>
                          <div class="col-lg-4 col-md-3">
                            <div class="outer row">
                              <div class="col-lg-12 col-md-12">
                                <div class="custom-arrow">
                                  <select name="bunrui4" id="edit_bunrui4" class="form-control left_select ">
                                    <!--<option value="">-</option>-->
                                    @foreach($bunrui4 as $bunr4)
                                    <option value="{{$bunr4->category1}}{{$bunr4->category2}}">
                                      {{$bunr4->category1}}{{$bunr4->category2.' '}}{{$bunr4->category4}}</option>
                                    @endforeach
                                  </select>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="col-lg-6 col-md-6">
                            <div class="outer row">
                              <div class="col-lg-12 col-md-12 ">
                                <div class="m_t"></div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class=" row row_data custom-mb2">
                          <div class="col-lg-2 col-md-3">
                            <div class="margin_t "><span>支払税端数区分</span> <span style="color: red;">※</span></div>
                          </div>
                          <div class="col-lg-4 col-md-3">
                            <div class="outer row">
                              <div class="col-lg-12 col-md-12 ">
                                <div class="custom-arrow">
                                  <select name="bunrui5" id="edit_bunrui5" class="form-control left_select ">
                                    @foreach($bunrui5 as $bunr5)
                                    <option value="{{$bunr5->category1}}{{$bunr5->category2}}">
                                      {{$bunr5->category1}}{{$bunr5->category2.' '}}{{$bunr5->category4}}</option>
                                    @endforeach
                                  </select>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="col-lg-6 col-md-6">
                            <div class="outer row">
                              <div class="col-lg-12 col-md-12 ">
                                <div class="m_t"></div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class=" row row_data custom-mb2">
                          <div class="col-lg-2 col-md-3">
                            <div class="margin_t "><span>源泉税率</span></div>
                          </div>
                          <div class="col-lg-4 col-md-3">
                            <div class="outer row">
                              <div class="col-lg-12 col-md-12">
                                <input name="syukei2" id="edit_syukei2" type="text" class=" input_field form-control">
                              </div>
                            </div>
                          </div>
                          <div class="col-lg-6 col-md-6">
                            <div class="outer row">
                              <div class="col-lg-12 col-md-12">
                                <div class="m_t" style="font-size: 12px;">％</div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class=" row row_data custom-mb2">
                          <div class="col-lg-2 col-md-3">
                            <div class="margin_t ">
                              <span>手形決済月</span>
                            </div>
                          </div>
                          <div class="col-lg-4 col-md-3">
                            <div class="outer row">
                              <div class="col-lg-12 col-md-12 ">
                                <input name="bunrui9" id="edit_bunrui9" type="text" class=" input_field form-control">
                              </div>
                            </div>
                          </div>
                          <div class="col-lg-6 col-md-6">
                            <div class="outer row">
                              <div class="col-lg-12 col-md-12 ">
                                <div class="m_t" style="font-size: 12px;">0：当月、1：翌月、2：翌々月、3：3か月、4：4か月</div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class=" row row_data custom-mb2">
                          <div class="col-lg-2 col-md-3">
                            <div class="margin_t ">
                              <span>手形決済日</span>
                            </div>
                          </div>
                          <div class="col-lg-4 col-md-3">
                            <div class="outer row">
                              <div class="col-lg-12 col-md-12 ">
                                <div class="custom-arrow">
                                  <select name="bunrui10" id="edit_bunrui10" class="form-control left_select ">
                                    <option value="">-</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                    <option value="9">9</option>
                                    <option value="10">10</option>
                                    <option value="11">11</option>
                                    <option value="12">12</option>
                                    <option value="13">13</option>
                                    <option value="14">14</option>
                                    <option value="15">15</option>
                                    <option value="16">16</option>
                                    <option value="17">17</option>
                                    <option value="18">18</option>
                                    <option value="19">19</option>
                                    <option value="20">20</option>
                                    <option value="21">21</option>
                                    <option value="22">22</option>
                                    <option value="23">23</option>
                                    <option value="24">24</option>
                                    <option value="25">25</option>
                                    <option value="26">26</option>
                                    <option value="27">27</option>
                                    <option value="28">28</option>
                                    <option value="29">29</option>
                                    <option value="30">30</option>
                                    <option value="31">月末</option>
                                  </select>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="col-lg-6 col-md-6">
                            <div class="outer row">
                              <div class="col-lg-12 col-md-12 ">
                                <div class="m_t"></div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class=" row row_data custom-mb2">
                          <div class="col-lg-2 col-md-3">
                            <div class="margin_t ">
                              <span>支払消費税計算区分</span>
                              <span style="color: red;">※</span>
                            </div>
                          </div>
                          <div class="col-lg-4 col-md-3">
                            <div class="outer row">
                              <div class="col-lg-12 col-md-12 ">
                                <input name="datatxt0052" id="edit_datatxt0052" type="text"
                                  class=" input_field form-control">
                              </div>
                            </div>
                          </div>
                          <div class="col-lg-6 col-md-6">
                            <div class="outer row">
                              <div class="col-lg-12 col-md-12 ">
                                <div class="m_t" style="font-size: 12px;">1：伝票単位、2：明細単位</div>
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

<script type="text/javascript">
  $('#comp_modal3').scroll(function() {
  $("#datepicker6_comShow").datepicker("hide", function() {}, 0);
  $("#datepicker7_comShow").datepicker("hide", function() {}, 0);
  $("#datepicker8_comShow").datepicker("hide", function() {}, 0);
  $("#datepicker9_comShow").datepicker("hide", function() {}, 0);
  $("#datepicker10_comShow").datepicker("hide", function() {}, 0);

  $("#datepicker6_comShow").blur();
  $("#datepicker7_comShow").blur();
  $("#datepicker8_comShow").blur();
  $("#datepicker9_comShow").blur();
  $("#datepicker10_comShow").blur();
});
</script>

<script>
  // Registration Modal
$('#comp_modal3').on('shown.bs.modal', function() {
  $("#edit_kounyusu").focus();
  $("#edit_kcode3").focus();
  $("#edit_haisoujouhou_tel").focus();
});

// Edit Modal
$('#employee_modal3').on('shown.bs.modal', function() {
  $("#edit_ztanka").focus();
});

// Settings Modal
$('#setting_display_modal').on('shown.bs.modal', function() {
  $("#setting_name").focus();
});
</script>
<script>
  $(".custom-file-input2").on("change", function() {
  var fileName = $(this).val().split("\\").pop();
  $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
  $("#edit_yobi13").val(fileName);
});
</script>
{{-- <script src="https://ajax.aspnetcdn.com/ajax/knockout/knockout-2.2.1.js" type="text/javascript"></script> --}}
{{-- <script>
  $("textarea").keydown(function(event) {
  if (event.keyCode == 13 && !e.shiftKey) {
    event.preventDefault();
  }
});
</script> --}}

<script type="text/javascript">
  $('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
  var target = e.target.attributes.href.value;
  $(target + ' [autofocus]').focus();
});
</script>
<script type="text/javascript">
  $(document).ready(function() {
  $('#editForm').attr('autocomplete', 'off');
});
</script>
