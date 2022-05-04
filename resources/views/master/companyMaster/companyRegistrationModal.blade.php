<form id="registrationForm" action="{{ route('postEditCompanyMaster',[$bango])}}" method="post"
  data-regmethod="registerCompany"
  onsubmit="registerCompany('{{route("postEditCompanyMaster",[$bango])}}'); event.preventDefault();"
  enctype='multipart/form-data'>
  @csrf
  <input type="hidden" name="type" value="create">
  <div class="modal custom-form" data-keyboard="false" data-backdrop="static" id="registrationModal" role="dialog"
    aria-labelledby="exampleModalLabel" style="display: none;" aria-hidden="true">
    <div class="modal-dialog" style="max-width: 1050px;z-index: 1052;" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"></h5>
          <div class="reg_hover_message" style="height:15px; color:red;padding-left: 15px;"></div>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body"  data-bind="nextFieldOnEnter:true">
          <div class="development_page_top_table heading_mt" style="margin:0 15px;">
            <div class="row titlebr" style="margin-bottom: 15px;">

              {{-- Error Message Starts Here --}}
              <div class="col-12 pl-1">
                <div id="error_data"></div>
              </div>
              {{-- Error Message Ends Here --}}

              <div class="col-lg-12">
                <div style="display: inline;">
                  <div style="float:left; ">
                    <table class="dev_tble_button">
                      <tbody>
                        <tr>
                          <td class=""
                            style="padding-left: 0px!important;width: 100px!important;border:none!important; ">
                            <h5>会社マスタ (登録)</h5>
                            <div class="mt-3">新規 (処理状況)</div>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                  <div style="float: right;">
                    <button message="@if(array_key_exists('reg', $buttonMessage)){{$buttonMessage['reg']}}@endif"
                      name="insert" id="regButton" type="submit" class="btn btn-info scroll reg_message_content"autofocus
                      style="margin-right: 5px;">
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
                <a class="nav-link active show" id="common1-tab" data-toggle="tab" href="#common1" role="tab"
                  aria-controls="common1" aria-selected="true"><b>共通</b>
                </a>
              </li>
              <li class="nav-item" id="reg_nav_item_2">
                <a class="nav-link" id="sales_billing1_tab" data-toggle="tab" href="#sales_billing1" role="tab"
                  aria-controls="sales_billing1" aria-selected="false"><b>売上・請求</b>
                </a>
              </li>
              <li class="nav-item" id="reg_nav_item_3">
                <a class="nav-link" id="payment1-tab" data-toggle="tab" href="#payment1" role="tab"
                  aria-controls="payment1" aria-selected="false"><b>仕入・支払</b>
                </a>
              </li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane h-100 p-3 border active show" id="common1" role="tabpanel"
                aria-labelledby="common1-tab">
                <div id="input_boxwrap_common1">
                  <div class="row mt-1 mb-3">
                    <div class="col-lg-12">
                      <div class="tbl_product w-100">
                        <div class=" row row_data custom-mb2">
                          <div class="col-lg-8 col-md-12">
                            <div class="outer row">
                              <div class="col-lg-3 col-md-4">
                                <div class="m_t">法人マイナンバー</div>
                              </div>
                              <div class="col-lg-3 col-md-3  ">
                                <input name="kounyusu" id="reg_kounyusu" type="text" class="input_field form-control"
                                  placeholder="">
                              </div>
                              <div class="col-lg-2 col-md-2">

                              </div>
                            </div>
                          </div>
                        </div>
                        <div class=" row row_data custom-mb2">
                          <div class="col-lg-2 col-md-4">
                            <div class="margin_t ">
                              <span>会社名</span>
                              <span style="color: red;">※</span>
                            </div>
                          </div>
                          <div class="col-lg-10 col-md-8">
                            <div class="outer row">
                              <div class="col-8 ">
                                <input name="name" id="reg_name" type="text" class=" input_field form-control">
                              </div>
                              <div class="col-4 p-0 ">
                                <div class="m_t" style=""> （全角推奨）</div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class=" row row_data custom-mb2">
                          <div class="col-lg-2 col-md-4">
                            <div class="margin_t ">
                              <span>会社名略称</span> <span style="color: red;">※</span>
                            </div>
                          </div>
                          <div class="col-lg-10 col-md-8">
                            <div class="outer row">
                              <div class="col-lg-8 col-md-8">
                                <input name="address" id="reg_address" type="text" class=" input_field form-control">
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
                                <input name="furigana" id="reg_furigana" type="text" class=" input_field form-control">
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class=" row row_data custom-mb2">
                          <div class="col-lg-2 col-md-4">
                            <div class="margin_t ">
                              <span>会社名カナ入金消込用
                              </span>
                            </div>
                          </div>
                          <div class="col-lg-10 col-md-8">
                            <div class="outer row">
                              <div class="col-lg-8 col-md-8">
                                <input name="datatxt0050" id="reg_datatxt0050" type="text"
                                  class=" input_field form-control">
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
                        <div class=" row row_data custom-mb2 ">
                          <div class="col-lg-3 col-md-4">
                            <div class="margin_t ">
                              <span>入力区分</span><span style="color: red;">※</span>
                            </div>
                          </div>
                          <div class="col-lg-9 col-md-8">
                            <div class="outer row">
                              <div class="col-lg-12 col-md-12  ">
                                <div class="custom-arrow">
                                  <select name="yubinbango" id="reg_yubinbango" class="form-control left_select ">
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
                          <div class="col-lg-8 col-md-6">
                            <div class="outer row">
                              <div class="col-lg-12 col-md-12 ">
                                <input name="syukeitukikijun" id="reg_syukeitukikijun" type="text"
                                  class="input_field form-control">
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
                              <span>旧取引先CD</span>
                            </div>
                          </div>
                          <div class="col-lg-8 col-md-6">
                            <div class="outer row">
                              <div class="col-lg-12 col-md-12 ">
                                <input name="syukeinen" id="reg_syukeinen" type="text" class="input_field form-control"
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
                          <div class="col-lg-8 col-md-8 col-sm-8">
                            <div class="outer row">
                              <div class="col-lg-9 col-md-9">
                                <div style="float: left;width: 65%">
                                  <input name="yobi13" id="reg_yobi13" type="text" readonly="true"
                                    class="input_field form-control" style="background:#fff;">
                                </div>
                                <div style="float: left;width: 30%;margin-left: 2%;">
                                  <div class="custom-file mb-3">
                                    <input type="file" accept=".pdf" class="custom-file-input" id="customFile" name="filename">
                                    <a class="btn btn-info" href="#">
                                      <label tabindex="0" class="input-file-trigger" for="customFile" style="margin: 0;">
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
                                <input name="bunrui6" id="reg_bunrui6" type="text" class="input_field form-control">
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
                                  <input name="tel" id="reg_tel" {{-- id="datepicker1_comShow"  --}} type="text"
                                    maxlength="8"
                                    onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))"
                                    class="input_field form-control" autocomplete="off">
                                  <div class="input-group-append" style="margin-left: 10px; margin-top: 7px;">
                                    <span id="cal_icon1_c" class="fa fa-calendar"></span>
                                  </div>
                                </div>
                                <div class="input-group">
                                  <input ignore name="" id="datepicker1_comShow" readonly type="text"
                                    class="input_field form-control" value="" autocomplete="off"
                                    style="background-color: white !important; color: white !important; position: absolute ; border: 1px solid white !important;">
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class=" row row_data custom-mb2">
                          <div class="col-lg-4 col-md-4">
                            <div class="margin_t ">
                              <span>帝国ﾃﾞｰﾀﾊﾞﾝｸ企業CD</span>
                            </div>
                          </div>
                          <div class="col-lg-8 col-md-8 ">
                            <div class="outer row">
                              <div class="col-lg-12 col-md-12">
                                <input name="fax" id="reg_fax" type="text" class="input_field form-control">
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class=" row row_data custom-mb2">
                          <div class="col-lg-4 col-md-4">
                            <div class="margin_t ">
                              <span>帝国ﾃﾞｰﾀﾊﾞﾝｸ評点</span>
                            </div>
                          </div>
                          <div class="col-lg-8 col-md-8">
                            <div class="outer row">
                              <div class="col-lg-12 col-md-12">
                                <input name="torihikisakibango" id="reg_torihikisakibango" type="text"
                                  class="input_field form-control">
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class=" row row_data custom-mb2">
                          <div class="col-lg-4 col-md-4">
                            <div class="margin_t ">
                              <span>経済産業省業種区分1
                              </span>
                            </div>
                          </div>
                          <div class="col-lg-8 col-md-8">
                            <div class="outer row">
                              <div class="col-lg-12 col-md-12  ">
                                <div class="custom-arrow">
                                  <select name="tantousya" id="reg_tantousya" data-bango="{{ $bango }}"
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
                          <div class="col-lg-8 col-md-8">
                            <div class="outer row">
                              <div class="col-lg-12 col-md-12 ">
                                <div class="custom-arrow">
                                  <select name="kcode1" id="reg_kcode1" class="form-control left_select ">
                                    <option value="">-</option>
                                    @foreach($kcode1 as $kCode1)
                                    <option value="{{$kCode1->category1}}{{$kCode1->category2}}">
                                      {{$kCode1->category1}}{{$kCode1->category2.' '}}{{$kCode1->category4}}
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
                    <div class="col-lg-5 col-md-12">
                      <div class="tbl_product w-100">
                        <div class=" row row_data custom-mb2">
                          <div class="col-lg-3 col-md-4  ">
                            <div class="margin_t ">
                              <span>基本業種</span>
                            </div>
                          </div>
                          <div class="col-lg-9 col-md-8 ">
                            <div class="outer row">
                              <div class="col-lg-12 col-md-12">
                                <div class="custom-arrow">
                                  <select name="kcode2" id="reg_kcode2" class="form-control left_select ">
                                    <option value="">-</option>
                                    @foreach($kcode2 as $kCode2)
                                    <option value="{{$kCode2->category1}}{{$kCode2->category2}}">
                                      {{$kCode2->category1}}{{$kCode2->category2.' '}}{{$kCode2->category4}}
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
                              <span>年商</span>
                            </div>
                          </div>
                          <div class="col-lg-9 col-md-8">
                            <div class="outer row">
                              <div class="col-lg-12 col-md-12">
                                <div class="custom-arrow">
                                  <select name="stoiawsestart" id="reg_stoiawsestart" class="form-control left_select ">
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
                          <div class="col-lg-3 col-md-4">
                            <div class="margin_t ">
                              <span>従業員</span>
                            </div>
                          </div>
                          <div class="col-lg-9 col-md-8">
                            <div class="outer row">
                              <div class="col-lg-12 col-md-12">
                                <div class="custom-arrow">
                                  <select name="stoiawseend" id="reg_stoiawseend" class="form-control left_select ">
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
                          <div class="col-lg-9 col-md-8">
                            <div class="outer row">
                              <div class="col-lg-12 col-md-12">
                                <div class="custom-arrow">
                                  <select name="stoiawsesaiban" id="reg_stoiawsesaiban"
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
                        <div class=" row row_data custom-mb2">
                          <div class="col-lg-3 col-md-4">
                            <div class="margin_t ">
                              <span>会社分類5</span>
                            </div>
                          </div>
                          <div class="col-lg-9 col-md-8">
                            <div class="outer row">
                              <div class="col-lg-12 col-md-12 ">
                                <div class="m_t">未使用</div>
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
                                  <textarea name="kensakukey" id="reg_kensakukey" class="form-control" rows="5"
                                    style="width: 100%; height: 120px;"></textarea>
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
                                <input name="syukeituki" id="reg_syukeituki" type="text"
                                  class="input_field form-control" value="2">
                              </div>
                              <div class="col-lg-5 col-md-5 ">
                                <div class="m_t" style="font-size: 12px;">1：有、2：無</div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class=" row row_data custom-mb2">
                          <div class="col-lg-3 col-md-4">
                            <div class="margin_t ">
                              <span>仕入区分</span> <span style="color: red;">※</span>
                            </div>
                          </div>
                          <div class="col-lg-9 col-md-8">
                            <div class="outer row">
                              <div class="col-lg-3 col-md-3 ">
                                <input name="syukeikikijun" id="reg_syukeikikijun" type="text" value="2"
                                  class="input_field form-control" onkeydown="lastTab(event)">
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

              <!-- sales and billing tabbed menu -->
              <div class="tab-pane fade h-100 p-3 border" id="sales_billing1" role="tabpanel"
                aria-labelledby="sales_billing1_tab">
                <div id="input_boxwrap_sales_billing1" data-bind="nextFieldOnEnter:true">
                  <div class="row mt-1 mb-3">
                    <div class="col-lg-6 col-md-12 ">
                      <div class="tbl_company w-100">
                        <div class=" row row_data custom-mb2">
                          <div class="col-lg-4 col-md-3">
                            <div class="margin_t ">
                              <span>即時区分</span><span style="color: red;">※</span>
                            </div>
                          </div>
                          <div class="col-lg-4 col-md-3">
                            <div>
                              <input name="kcode3" id="reg_kcode3" type="text" value="1"
                                class="input_field form-control" autofocus>
                            </div>
                          </div>
                          <div class="col-lg-4 col-md-3">
                            <div class="m_t" style="font-size: 12px;">1：即時、2：締日</div>
                          </div>
                        </div>
                        <div class=" row row_data custom-mb2">
                          <div class="col-lg-4 col-md-3">
                            <div class="margin_t ">
                              <span> 請求締め日</span> <span style="color: red;">※</span></div>
                          </div>
                          <div class="col-lg-4 col-md-3">
                            <div>
                              <div class="custom-arrow">
                                <select name="ytoiawsestart" id="reg_ytoiawsestart" class="form-control left_select ">
                                  <!--<option value="">-</option>-->
                                  @foreach($ytoiawsestart as $ytoiawsest)
                                  <option value="{{$ytoiawsest->category1}}{{$ytoiawsest->category2}}" @if($ytoiawsest->category1.$ytoiawsest->category2 == "A831"){{ "selected" }}@endif>
                                    {{$ytoiawsest->category1}}{{$ytoiawsest->category2.' '}}{{$ytoiawsest->category4}}
                                  </option>
                                  @endforeach
                                </select>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class=" row row_data custom-mb2">
                          <div class="col-lg-4 col-md-3">
                            <div class="margin_t">
                              <span>入金方法</span>
                              <span style="color: red;">※</span>
                            </div>
                          </div>
                          <div class="col-lg-4 col-md-3">
                            <div>
                              <div class="custom-arrow">
                                <select name="ytoiawseend" id="reg_ytoiawseend" class="form-control left_select ">
                                  @foreach($ytoiawseend as $ytoiawnd)
                                  <option value="{{$ytoiawnd->category1}}{{$ytoiawnd->category2}}" @if($ytoiawnd->
                                    category2=="02"){{'selected'}}@endif>
                                    {{$ytoiawnd->category1}}{{$ytoiawnd->category2.' '}}{{$ytoiawnd->category4}}
                                  </option>
                                  @endforeach
                                </select>
                              </div>
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
                              <input name="ytoiawsesaiban" id="reg_ytoiawsesaiban" value="1" type="text"
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
                                <select name="yetoiawsestart" id="reg_yetoiawsestart" class="form-control left_select ">
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
                              <input name="yetoiawseend" id="reg_yetoiawseend" value="1" type="text"
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
                              <input name="yetoiawsesaiban" id="reg_yetoiawsesaiban" value="2" type="text"
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
                        <div class=" row row_data">
                          <div class="col-lg-5 col-md-3">
                            <div class="margin_t ">
                              <span>保守更新案内有無</span>
                            </div>
                          </div>
                          <div class="col-lg-7 col-md-3">
                            <div>
                              <div class="custom-arrow">
                                <select name="netusername" id="reg_netusername" class="form-control left_select">
                                  <!--<option value="">-</option>-->
                                  @foreach($netusername as $netusern)
                                  <option value="{{$netusern->category1}}{{$netusern->category2}}" @if($netusern->
                                    category1.$netusern->category2=="F62"){{'selected'}}@endif>
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
                                <select name="netuserpasswd" id="reg_netuserpasswd" class="form-control left_select">
                                  <!--<option value="">-</option>-->
                                  @foreach($netuserpasswd as $netuserp)
                                  <option value="{{$netuserp->category1}}{{$netuserp->category2}}" @if($netuserp->
                                    category1.$netuserp->category2=="F62"){{'selected'}}@endif>
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
                                <select name="netlogin" id="reg_netlogin" class="form-control left_select ">
                                  <option value="">-</option>
                                  @foreach($netlogin as $netlgn)
                                  <option value="{{$netlgn->category1}}{{$netlgn->category2}}" @if($netlgn->
                                    category2=="1"){{'selected'}}@endif>
                                    {{$netlgn->category1}}{{$netlgn->category2.' '}}{{$netlgn->category4}}
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
                              <span>与信限度額</span>
                              <span style="color: red;">※</span>
                            </div>
                          </div>
                          <div class="col-lg-4 col-md-3">
                            <div>
                              <input name="denpyostart" id="reg_denpyostart" type="text" value="3,000,000"
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
                                  <input name="mail_soushin" id="reg_mail_soushin" type="text"
                                    class="input_field form-control" style="background:#fff;"
                                    onkeyup="getExtraShowingData(this,'{{$bango}}','reg_mail_soushin_extra','reg_mail_soushin_abbr')">
                                  <input name="mail_soushin_extra" id="reg_mail_soushin_extra" type="hidden">
                                </div>
                                <div class="" id="box_popup1_comp" style="bottom: 0;float: left;margin-top: 3px;position: absolute;right: 22px;top: 0px;">
                                  <img src="{{url('img')}}\open-book.svg" height="20" width="20" alt="" style="cursor: pointer;">
                                </div>
                              </div>
                              <div class="col-lg-6 col-md-6 m_t" id="reg_mail_soushin_abbr"></div>
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
                                <input name="mail_jyushin" id="reg_mail_jyushin" type="text" value="0"
                                  class="input_field form-control">
                              </div>
                              <div class="col-lg-6 col-md-6 ">
                                <div class="m_t">0～-9</div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class=" row row_data custom-mb2">
                          <div class="col-lg-2 col-md-3">
                            <div class="margin_t ">
                              <span>請求書メール区分</span>
                              <span style="color: red;">※</span>
                            </div>
                          </div>
                          <div class="col-lg-9 col-md-9">
                            <div class="outer row">
                              <div class="col-lg-6 col-md-6 ">
                                <input type="text" name="mail_nouhin" id="reg_mail_nouhin" value="2"
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
                              <div class="col-lg-6 col-md-6">
                                <input type="text" name="mail_toiawase" id="reg_mail_toiawase"
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
                                <input type="text" name="mail_soushin_mb" id="reg_mail_soushin_mb" value="2"
                                  class="input_field form-control">
                              </div>
                              <div class="col-lg-6 d-none "></div>
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
                              <div class="col-lg-6 col-md-3 ">
                                <input type="text" name="mail_jyushin_mb" id="reg_mail_jyushin_mb" value="1"
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
                              <div class="col-lg-6 col-md-6">
                                <div style="position:relative;">
                                  <input type="text" name="mail_nouhin_mb" id="reg_mail_nouhin_mb" class="form-control"
                                    style="background:#fff;"
                                    onkeyup="getExtraShowingData(this,'{{$bango}}','reg_mail_nouhin_mb_extra','reg_mail_nouhin_mb_abbr')">
                                  <input name="mail_nouhin_mb_extra" id="reg_mail_nouhin_mb_extra" type="hidden">
                                </div>
                                <div class="" id="box_popup1_comp2" data-toggle="modal" data-target="" style="bottom: 0;float: left;margin-top: 3px;position: absolute;right: 22px;top: 0px;">
                                  <img src="{{url('img')}}\open-book.svg" height="20" width="20" alt="" style="cursor: pointer;">
                                </div>
                              </div>
                              <div class="col-lg-6 col-md-6 d-none "></div>
                              <div id="reg_mail_nouhin_mb_abbr" class="col-lg-6 col-md-6 m_t"></div>
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
                                  <select name="mail_toiawase_mb" id="reg_mail_toiawase_mb"
                                    class="form-control left_select ">
                                    <!--<option value="">-</option>-->
                                    @foreach($mail_toiawase_mb as $mailToiawaseMb)
                                    <option value="{{$mailToiawaseMb->category1}}{{$mailToiawaseMb->category2}}"
                                      @if($mailToiawaseMb->category1.$mailToiawaseMb->category2=="B120"){{'selected'}}@endif>
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
                          <div class="col-lg-9 col-md-9 ">
                            <div class="outer row">
                              <div class="col-lg-6 col-md-6 ">
                                <div class="custom-arrow">
                                  <select name="mallsoukobango1" id="reg_mallsoukobango1"
                                    class="form-control left_select ">
                                    @foreach($mallsoukobango1 as $mallsoukoBango1)
                                    <option value="{{$mallsoukoBango1->category1}}{{$mallsoukoBango1->category2}}"
                                      @if($mallsoukoBango1->
                                      category2=="1"){{'selected'}}@endif>
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
                                <input type="text" name="datatxt0051" id="reg_datatxt0051" value="1" class="input_field form-control">
                              </div>
                              <div class="col-lg-6 d-none"></div>
                              <div class="col-lg-6 col-md-6">
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
                                <input type="text" name="mallsoukobango2" id="reg_mallsoukobango2" value="2" class="input_field form-control">
                              </div>
                              <div class="col-lg-5 col-md-5 ">
                                <div class="m_t" style="font-size: 12px;">1：有、2：無</div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class=" row row_data custom-mb2">
                          <div class="col-lg-4 col-md-3">
                            <div class="margin_t">
                              <span>指定納品書帳票CD</span>
                            </div>
                          </div>
                          <div class="col-lg-8 col-md-8">
                            <div class="outer row">
                              <div class="col-lg-7 col-md-7 ">
                                <input type="text" name="mallsoukobango3" id="reg_mallsoukobango3"
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
                                  <select name="domain" id="reg_domain" class="form-control left_select ">
                                    <option value="">-</option>
                                    @foreach($domain as $domn)
                                    <option value="{{$domn->category1}}{{$domn->category2}}">
                                      {{$domn->category1}}{{$domn->category2.' '}}{{$domn->category4}}
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
                            <div class="margin_t "><span>顧客深耕層別化</span></div>
                          </div>
                          <div class="col-lg-8 col-md-8">
                            <div class="outer row">
                              <div class="col-lg-7 col-md-7 ">
                                <div class="custom-arrow">
                                  <select name="domain2" id="reg_domain2" class="form-control left_select ">
                                    <option value="">-</option>
                                    @foreach($domain2 as $domn2)
                                    <option value="{{$domn2->category1}}{{$domn2->category2}}">
                                      {{$domn2->category1}}{{$domn2->category2.' '}}{{$domn2->category4}}
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
                              <span>得意先分類3</span>
                            </div>
                          </div>
                          <div class="col-lg-8 col-md-8">
                            <div class="outer row">
                              <div class="col-lg-7 col-md-7 ">
                                <div class="custom-arrow">
                                  <select name="datatxt0058" id="reg_datatxt0058" class="form-control left_select ">
                                    <option value="">-</option>
                                    @foreach($datatxt0058 as $dttxt0058)
                                    <option value="{{$dttxt0058->category1}}{{$dttxt0058->category2}}">
                                      {{$dttxt0058->category1}}{{$dttxt0058->category2.' '}}{{$dttxt0058->category4}}
                                    </option>
                                    @endforeach
                                  </select>
                                </div>
                              </div>

                              {{-- <div class="col-lg-12 col-md-12 ">
                                <div class="m_t">未使用</div>
                              </div> --}}
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
                                  <select name="datatxt0059" id="reg_datatxt0059" class="form-control left_select ">
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
                                  <select name="datatxt0060" id="reg_datatxt0060" class="form-control left_select ">
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
                                  <select name="datatxt0061" id="reg_datatxt0061" class="form-control left_select ">
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
                            <div class="margin_t ">
                              <span>単価設定区分</span>
                            </div>
                          </div>
                          <div class="col-lg-7 col-md-7">
                            <div class="outer row">
                              <div class="col-lg-12 col-md-12 ">
                                <div class="custom-arrow">
                                  <select name="haisoujouhou_address" id="reg_haisoujouhou_address"
                                    class="form-control left_select ">
                                    <option value="">-</option>
                                    @foreach($haisoujouhou_address as
                                    $haisoujouhouAddress)
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
                              <div class="col-lg-12 col-md-12 ">
                                <div class="input-group">
                                  <input name="kaiinbango" id="reg_kaiinbango" {{-- id="datepicker2_comShow"  --}}
                                    type="text" maxlength="8"
                                    onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))"
                                    class="input_field form-control" autocomplete="off">
                                  <div class="input-group-append" style="margin-left: 10px; margin-top: 7px;">
                                    <span id="cal_icon2_c" class="fa fa-calendar"></span>
                                  </div>
                                </div>
                                <div class="input-group">
                                  <input name="" id="datepicker2_comShow" readonly ignore type="text"
                                    class="input_field form-control" value="" autocomplete="off"
                                    style="background-color: white !important; color: white !important; position: absolute ; border: 1px solid white !important;">
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class=" row row_data custom-mb2">
                          <div class="col-lg-5 col-md-3">
                            <div class="margin_t ">
                              <span>取引開始日 東流</span>
                            </div>
                          </div>
                          <div class="col-lg-7 col-md-7">
                            <div class="outer row">
                              <div class="col-lg-12 col-md-12 ">
                                <div class="input-group">
                                  <input name="zokugara" id="reg_zokugara" {{-- id="datepicker3_comShow"  --}}
                                    type="text" maxlength="8"
                                    onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))"
                                    class="input_field form-control" autocomplete="off">
                                  <div class="input-group-append" style="margin-left: 10px; margin-top: 7px;">
                                    <span id="cal_icon3_c" class="fa fa-calendar"></span>
                                  </div>
                                </div>
                                <div class="input-group">
                                  <input id="datepicker3_comShow" readonly ignore type="text" class="input_field form-control"
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
                              <span>取引開始日 西直</span>
                            </div>
                          </div>
                          <div class="col-lg-7 col-md-7">
                            <div class="outer row">
                              <div class="col-lg-12 col-md-12 ">
                                <div class="input-group">
                                  <input name="haisoujouhou_name" id="reg_haisoujouhou_name"
                                    {{-- id="datepicker4_comShow"  --}} type="text" maxlength="8"
                                    onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))"
                                    class="input_field form-control" autocomplete="off">
                                  <div class="input-group-append" style="margin-left: 10px; margin-top: 7px;">
                                    <span id="cal_icon4_c" class="fa fa-calendar"></span>
                                  </div>
                                </div>
                                <div class="input-group">
                                  <input id="datepicker4_comShow" readonly ignore type="text" class="input_field form-control"
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
                                  <input name="haisoujouhou_yubinbango" id="reg_haisoujouhou_yubinbango"
                                    {{-- id="datepicker5_comShow"  --}} type="text" maxlength="8"
                                    onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))"
                                    class="input_field form-control" autocomplete="off">
                                  <div class="input-group-append" style="margin-left: 10px; margin-top: 7px;">
                                    <span id="cal_icon5_c" class="fa fa-calendar"></span>
                                  </div>
                                </div>
                                <div class="input-group">
                                  <input id="datepicker5_comShow" readonly ignore type="text" class="input_field form-control"
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
                                  <select name="kcode4" id="reg_kcode4" class="form-control left_select ">
                                    <!--<option value="">-</option>-->
                                    @foreach($kcode4 as $kCode4)
                                    <option value="{{$kCode4->syouhinbango.' '}}{{$kCode4->jouhou}}" @if($kCode4->syouhinbango == '3'){{'selected'}}@endif>
                                      {{$kCode4->syouhinbango.' '}}{{$kCode4->jouhou}}
                                    </option>
                                    @endforeach
                                  </select>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class=" row row_data">
                          <div class="col-lg-5 col-md-3">
                            <div class="margin_t ">
                              <span>データソース</span>
                            </div>
                          </div>
                          <div class="col-lg-7 col-md-7">
                            <div class="outer row">
                              <div class="col-lg-12 col-md-12 ">
                                <div class="custom-arrow">
                                  <select name="kcode5" id="reg_kcode5" class="form-control left_select ">
                                    <option value="">-</option>
                                    @foreach($kcode5 as $kCode5)
                                    <option value="{{$kCode5->category1}}{{$kCode5->category2}}">
                                      {{$kCode5->category1}}{{$kCode5->category2.' '}}{{$kCode5->category4}}
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

              <!-- sales and billing tabbed menu -->
              <div class="tab-pane fade h-100 p-3 border" id="payment1" role="tabpanel" aria-labelledby="payment1-tab">
                <div id="input_boxwrap_payment1" data-bind="nextFieldOnEnter:true">
                  <div class="row mt-1 mb-3">
                    <div class="col-lg-12 col-md-12">
                      <div class="tbl_company w-100">
                        <div class=" row row_data custom-mb2">
                          <div class="col-lg-2 col-md-3">
                            <div class="margin_t ">
                              <span>支払締め日</span> <span style="color: red;">※</span>
                            </div>
                          </div>
                          <div class="col-lg-4 col-md-3">
                            <div class="outer row">
                              <div class="col-lg-12 col-md-12 ">
                                <div class="custom-arrow">
                                  <select name="haisoujouhou_tel" id="reg_haisoujouhou_tel"
                                    class="form-control left_select " autofocus="">
                                    <!--<option value="">-</option>-->
                                    @foreach($haisoujouhou_tel as
                                    $haisoujouhouTel)
                                    <option value="{{$haisoujouhouTel->category1}}{{$haisoujouhouTel->category2}}" @if($haisoujouhouTel->category1.$haisoujouhouTel->category2 == "D820"){{ 'selected' }}@endif>
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
                              <div class="col-lg-12 col-md-12">
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
                                <input name="mail" id="reg_mail" type="text" value="1" class="form-control">
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
                              <span>支払日</span>
                              <span style="color: red;">※</span>
                            </div>
                          </div>
                          <div class="col-lg-4 col-md-3">
                            <div class="outer row">
                              <div class="col-lg-12 col-md-12 ">
                                <div class="custom-arrow">
                                  <select name="sex" id="reg_sex" class="form-control left_select ">
                                    <!--<option value="">-</option>-->
                                    @foreach($sex as $sx)
                                    <option value="{{$sx->category1}}{{$sx->category2}}" @if($sx->category1.$sx->category2 == "F931"){{ 'selected' }}@endif>
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
                              <div class="col-lg-12 col-md-12">
                                <div class="m_t"></div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class=" row row_data custom-mb2">
                          <div class="col-lg-2 col-md-3">
                            <div class="margin_t ">
                              <span>支払日休日設定</span>
                              <span style="color: red;">※</span>
                            </div>
                          </div>
                          <div class="col-lg-4 col-md-3">
                            <div class="outer row">
                              <div class="col-lg-12 col-md-12 ">
                                <input name="bunrui1" id="reg_bunrui1" type="text" value="1" class="form-control">
                              </div>
                            </div>
                          </div>
                          <div class="col-lg-6 col-md-6">
                            <div class="outer row">
                              <div class="col-lg-12 col-md-12">
                                <div class="m_t" style="font-size: 12px;">1：翌営業日、2：前営業日</div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class=" row row_data custom-mb2">
                          <div class="col-lg-2 col-md-3">
                            <div class="margin_t ">
                              <span>支払振込手数料設定</span>
                              <span style="color: red;">※</span>
                            </div>
                          </div>
                          <div class="col-lg-4 col-md-3">
                            <div class="outer row">
                              <div class="col-lg-12 col-md-12 ">
                                <input name="bunrui2" id="reg_bunrui2" value="2" type="text" class="form-control">
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
                            <div class="margin_t "><span>支払振込手数料区分</span>
                            </div>
                          </div>
                          <div class="col-lg-4 col-md-3">
                            <div class="outer row">
                              <div class="col-lg-12 col-md-12 ">
                                <div class="custom-arrow">
                                  <select name="syukeinenkijun" id="reg_syukeinenkijun" class="form-control">
                                    <option value="">-</option>
                                    @foreach($syukeinenkijun as
                                    $syukeinenkn)
                                    <option value="{{$syukeinenkn->category1}}{{$syukeinenkn->category2}}">
                                      {{$syukeinenkn->category1}}{{$syukeinenkn->category2.' '}}{{$syukeinenkn->category4}}
                                    </option>
                                    @endforeach
                                  </select>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class=" row row_data custom-mb2">
                        <div class="col-lg-2 col-md-3">
                          <div class="margin_t ">
                            <span>支払方法</span>
                            <span style="color: red;">※</span>
                          </div>
                        </div>
                        <div class="col-lg-4 col-md-3">
                          <div class="outer row">
                            <div class="col-lg-12 col-md-12 ">
                              <div class="custom-arrow">
                                <select name="bunrui3" id="reg_bunrui3" class="form-control left_select ">
                                  @foreach($bunrui3 as $bunr3)
                                  <option value="{{$bunr3->category1}}{{$bunr3->category2}}" @if($bunr3->category2.$bunr3->category2=="D901"){{'selected'}}@endif>
                                    {{$bunr3->category1}}{{$bunr3->category2.' '}}{{$bunr3->category4}}
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
                          <div class="margin_t ">
                            <span>振込銀行</span>
                          </div>
                        </div>
                        <div class="col-lg-4 col-md-3">
                          <div class="outer row">
                            <div class="col-lg-12 col-md-12">
                              <input name="datatxt0054" id="reg_datatxt0054" type="text" class="form-control">
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
                              <input name="datatxt0055" id="reg_datatxt0055" type="text" class="form-control">
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
                            <div class="col-lg-12 col-md-12">
                              <div class="custom-arrow">
                                <select name="endtime" id="reg_endtime" class="form-control left_select ">
                                  <option value="">-</option>
                                  @foreach($endtime as $endtm)
                                  <option value="{{$endtm->syouhinbango}}">
                                    {{$endtm->syouhinbango}}</option>
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
                            <div class="col-lg-12 col-md-12">
                              <input name="datatxt0056" id="reg_datatxt0056" type="text" class="form-control">
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
                            <div class="col-lg-12 col-md-12">
                              <input name="datatxt0057" id="reg_datatxt0057" type="text" class="form-control">
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
                              <input type="text" name="syukei3" id="reg_syukei3" class=" input_field form-control">
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
                            <div class="col-lg-12 col-md-12">
                              <div class="custom-arrow">
                                <select name="syukeiki" id="reg_syukeiki" class="form-control left_select ">
                                  <option value="">-</option>
                                  @foreach($syukeiki as $syuk)
                                  <option value="{{$syuk->category1}}{{$syuk->category2}}">
                                    {{$syuk->category1}}{{$syuk->category2.' '}}{{$syuk->category4}}
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
                          <div class="margin_t ">
                            <span>仕向支店</span>
                          </div>
                        </div>
                        <div class="col-lg-4 col-md-3">
                          <div class="outer row">
                            <div class="col-lg-12 col-md-12">
                              <div class="custom-arrow">
                                <select name="datatxt0053" id="reg_datatxt0053" class="form-control left_select ">
                                  <option value="">-</option>
                                  @foreach($datatxt0053 as
                                  $dttxt0053)
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
                          <div class="margin_t">
                            <span>支払課税区分</span>
                            <span style="color: red;">※</span>
                          </div>
                        </div>
                        <div class="col-lg-4 col-md-3">
                          <div class="outer row">
                            <div class="col-lg-12 col-md-12 ">
                              <div class="custom-arrow">
                                <select name="bunrui4" id="reg_bunrui4" class="form-control left_select ">
                                  <!--<option value="">-</option>-->
                                  @foreach($bunrui4 as $bunr4)
                                  <option value="{{$bunr4->category1}}{{$bunr4->category2}}" @if($bunr4->category1.$bunr4->category2=="E120"){{'selected'}}@endif>
                                    {{$bunr4->category1}}{{$bunr4->category2.' '}}{{$bunr4->category4}}
                                  </option>
                                  @endforeach
                                </select>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-5">
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
                            <span>支払税端数区分</span>
                            <span style="color: red;">※</span>
                          </div>
                        </div>
                        <div class="col-lg-4 col-md-3">
                          <div class="outer row">
                            <div class="col-lg-12 col-md-12">
                              <div class="custom-arrow">
                                <select name="bunrui5" id="reg_bunrui5" class="form-control left_select ">
                                  @foreach($bunrui5 as $bunr5)
                                  <option value="{{$bunr5->category1}}{{$bunr5->category2}}" @if($bunr5->
                                    category2=="1"){{'selected'}}@endif>
                                    {{$bunr5->category1}}{{$bunr5->category2.' '}}{{$bunr5->category4}}
                                  </option>
                                  @endforeach
                                </select>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-5">
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
                            <span>源泉税率</span>
                          </div>
                        </div>
                        <div class="col-lg-4 col-md-3">
                          <div class="outer row">
                            <div class="col-lg-12 col-md-12 ">
                              <input name="syukei2" id="reg_syukei2" type="text" class="form-control">
                            </div>
                          </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-5">
                          <div class="outer row">
                            <div class="col-lg-12 col-md-12 ">
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
                              <input name="bunrui9" id="reg_bunrui9" type="text" class="form-control" value="">
                            </div>
                          </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                          <div class="outer row">
                            <div class="col-lg-12 col-md-12 ">
                              <div class="m_t" style="font-size: 12px;">
                                0：当月、1：翌月、2：翌々月、3：3か月、4：4か月
                              </div>
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
                                <select name="bunrui10" id="reg_bunrui10" class="form-control left_select ">
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
                        <div class="col-lg-4 col-md-6">
                          <div class="outer row">
                            <div class="col-lg-12 ">
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
                              <input name="datatxt0052" id="reg_datatxt0052" type="text" value="1" class="form-control">
                            </div>
                          </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-5">
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
      <script>
        $('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
          var target = e.target.attributes.href.value;
          $(target + ' [autofocus]').focus();
        });
      </script>
    </div>
  </div>
  </div>
</form>

<script>
  // Registration Modal
$('#registrationModal').scroll(function() {
  $("#datepicker1_comShow").datepicker("hide", function() {}, 0);
  $("#datepicker2_comShow").datepicker("hide", function() {}, 0);
  $("#datepicker3_comShow").datepicker("hide", function() {}, 0);
  $("#datepicker4_comShow").datepicker("hide", function() {}, 0);
  $("#datepicker5_comShow").datepicker("hide", function() {}, 0);

  $("#datepicker1_comShow").blur();
  $("#datepicker2_comShow").blur();
  $("#datepicker3_comShow").blur();
  $("#datepicker4_comShow").blur();
  $("#datepicker5_comShow").blur();
});
</script>

<script>
  $(".custom-file-input").on("change", function() {
  var fileName = $(this).val().split("\\").pop();
  $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
  $("#reg_yobi13").val(fileName);
});
</script>
