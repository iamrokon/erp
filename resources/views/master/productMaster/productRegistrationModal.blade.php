<form id="registrationForm" action="{{ route('postEditProductMaster',[$bango])}}" method="post"
  data-regmethod="registerProduct"
  onsubmit="registerProduct('{{route("postEditProductMaster",[$bango])}}');event.preventDefault();">
  @csrf
  <input type="hidden" name="type" value="create">
  <div class="modal custom-form" data-keyboard="false" data-backdrop="static" id="registrationModal" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog " style="max-width: 950px;" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body" data-bind="nextFieldOnEnter:true">
          <div class="development_page_top_table heading_mt" style="margin:0 2px;">
            <div class="row titlebr" style="margin-bottom: 15px;">

              <!-- Error Message Starts Here -->
              <div id="error_data"></div>
              <!-- Error Message Ends Here -->

              <div class="col-lg-12">
                <div style="display: inline;">
                  <div style="float:left; ">
                    <table class="dev_tble_button">
                      <tbody>
                        <tr>
                          <td class=""
                            style="padding-left: 0px!important;width: 100px!important;border:none!important; ">
                            <h5>商品マスタ(登録)</h5>
                            <div class="mt-3"> 新規 (処理状況)</div>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                  <div style="float: right;">
                    <button name="insert" id="regButton" type="submit" class="btn btn-info" autofocus>
                      <i class="fas fa-save" style="margin-right: 5px;"></i>保存
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div id="input_boxwrap_product_reg">
            <div class="row mt-1 mb-3">
              <div class="col-lg-8 col-md-8 col-sm-12">
                <div class="tbl_emp1">
                  <div class="w-100">
                    <div class=" row row_data">
                      <div class="col-lg-3 col-md-3 col-sm-3">
                        <div class="margin_t ">
                          <span>商品CD</span><span style="color: red;">※</span>
                        </div>
                      </div>
                      <div class="col-lg-9 col-md-9 col-sm-9">
                        <div class="outer row">
                          <div class="col-lg-12 ">
                            <div class="">
                              <input name="kokyakusyouhinbango" id="reg_kokyakusyouhinbango" readonly type="text"
                                class="input_field form-control">
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class=" row row_data">
                      <div class="col-lg-3 col-md-3 col-sm-3 ">
                        <div class="margin_t ">
                          <span>商品名</span><span style="color: red;">※</span>
                        </div>
                      </div>
                      <div class="col-lg-9 col-md-9 col-sm-9">
                        <div class="outer row">
                          <div class="col-lg-12 ">
                            <input name="name" id="reg_name" type="text" class="input_field form-control">
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class=" row row_data">
                      <div class="col-lg-3 col-md-3 col-sm-3">
                        <div class="margin_t ">
                          <span>商品名略称</span>
                        </div>
                      </div>
                      <div class="col-lg-9 col-md-9 col-sm-9">
                        <div class="outer row">
                          <div class="col-lg-12 ">
                            <input name="size" id="reg_size" type="text" class="input_field form-control">
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class=" row row_data">
                      <div class="col-lg-3 col-md-3 col-sm-3">
                        <div class="margin_t ">
                          <span>品目群</span> <span style="color: red;">※</span>
                        </div>
                      </div>
                      <div class="col-lg-9 col-md-9 col-sm-9">
                        <div class="outer row">
                          <div class="col-lg-12 ">
                            <div class="custom-arrow">
                              <select name="jouhou" id="reg_jouhou" data-bango="{{ $bango }}"
                                class="input_field form-control">
                                <!--<option data-categoryType="null" data-categoryValue="null" value="">-</option>-->
                                @foreach($jouhou as $jh)
                                <option data-categoryType="{{$jh->category1}}" data-categoryValue="{{$jh->category2}}"
                                  value="{{$jh->category1}}{{$jh->category2}}">
                                  {{$jh->category1}}{{$jh->category2.' '}}{{$jh->category4}}</option>
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
                          <span>製品区分</span> <span style="color: red;">※</span>
                        </div>
                      </div>
                      <div class="col-lg-9 col-md-9 col-sm-9">
                        <div class="outer row">
                          <div class="col-lg-12 ">
                            <div class="custom-arrow">
                              <select name="koyuujouhou" id="reg_koyuujouhou" data-bango="{{ $bango }}"
                                class="form-control">
                                <!--<option data-categoryType="null" data-categoryValue="null" value="">-</option>-->
                                @foreach($koyuujouhou as $kjouhou)
                                <option data-categoryType="{{$kjouhou->category1}}"
                                  data-categoryValue="{{$kjouhou->category2}}"
                                  value="{{$kjouhou->category1}}{{$kjouhou->category2}}">
                                  {{$kjouhou->category1}}{{$kjouhou->category2.' '}}{{$kjouhou->category4}}</option>
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
                          <span>品目区分</span> <span style="color: red;">※</span>
                        </div>
                      </div>
                      <div class="col-lg-9 col-md-9 col-sm-9">
                        <div class="outer row">
                          <div class="col-lg-12 ">
                            <div class="custom-arrow">
                              <select name="color" class="form-control" id="reg_color">
                                @foreach($color as $clr)
                                <option value="{{$clr->category1}}{{$clr->category2}}">
                                  {{$clr->category1}}{{$clr->category2.' '}}{{$clr->category4}}</option>
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
                          <span>販売形態</span>
                        </div>
                      </div>
                      <div class="col-lg-9 col-md-9 col-sm-9">
                        <div class="outer row">
                          <div class="col-lg-12 ">
                            <div class="custom-arrow">
                              <select name="bumon" class="form-control" id="reg_bumon">
                                <option value="">-</option>
                                @foreach($bumon as $bmn)
                                <option value="{{$bmn->category1}}{{$bmn->category2}}">
                                  {{$bmn->category1}}{{$bmn->category2.' '}}{{$bmn->category4}}</option>
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
                          <span>バージョン</span>
                        </div>
                      </div>
                      <div class="col-lg-9 col-md-9 col-sm-9">
                        <div class="outer row">
                          <div class="col-lg-12 ">
                            <div class="custom-arrow">
                              <select name="yoyaku" id="reg_syouhin1_yoyaku" class="form-control" style="width:100%;">
                                <option value="">-</option>
                                @foreach($yoyaku as $yyku)
                                <option value="{{$yyku->category1}}{{$yyku->category2}}">
                                  {{$yyku->category1}}{{$yyku->category2.' '}}{{$yyku->category4}}</option>
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
                          <span>保守区分</span>
                        </div>
                      </div>
                      <div class="col-lg-9 col-md-9 col-sm-9">
                        <div class="outer row">
                          <div class="col-lg-12 ">
                            <div class="custom-arrow">
                              <select name="data21" id="reg_data21" class="form-control">
                                <option value="">-</option>
                                @foreach($request_data21 as $data21)
                                <option value="{{$data21->syouhinbango.' '}}{{$data21->jouhou}}">
                                  {{$data21->syouhinbango.' '}}{{$data21->jouhou}}</option>
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
                          <span>継続区分</span>
                        </div>
                      </div>
                      <div class=" col-lg-9 col-md-9 col-sm-9">
                        <div class="outer row">
                          <div class="col-lg-12 ">
                            <div class="custom-arrow">
                              <select name="tokuchou" id="reg_tokuchou" class="form-control">
                                <option value="">-</option>
                                @foreach($request_tokuchou as $tokuchou)
                                <option value="{{$tokuchou->syouhinbango.' '}}{{$tokuchou->jouhou}}">
                                  {{$tokuchou->syouhinbango.' '}}{{$tokuchou->jouhou}}</option>
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
                          <span>新規VUP区分</span>
                        </div>
                      </div>
                      <div class="col-lg-9 col-md-9 col-sm-9">
                        <div class="outer row">
                          <div class="col-lg-12 ">
                            <div class="custom-arrow">
                              <select name="data22" id="reg_data22" class="form-control">
                                <option value="">-</option>
                                @foreach($request_data22 as $data22)
                                <option value="{{$data22->syouhinbango.' '}}{{$data22->jouhou}}">
                                  {{$data22->syouhinbango.' '}}{{$data22->jouhou}}</option>
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
                          <span>サブ区分</span>
                        </div>
                      </div>
                      <div class="col-lg-9 col-md-9 col-sm-9">
                        <div class="outer row">
                          <div class="col-lg-12 ">
                            <div class="custom-arrow">
                              <select name="data23" id="reg_data23" class="form-control">
                                <option value="">-</option>
                                @foreach($request_data23 as $data23)
                                <option value="{{$data23->syouhinbango.' '}}{{$data23->jouhou}}" @if($data23->
                                  syouhinbango.' '.$data23->jouhou=="0
                                  NULL"){{'selected'}}@endif>{{$data23->syouhinbango.' '}}{{$data23->jouhou}}</option>
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
                          <span>入力区分１</span><span style="color: red;"> ※</span>
                        </div>
                      </div>
                      <div class="col-lg-9 col-md-9 col-sm-9">
                        <div class="outer row">
                          <div class="col-lg-12 ">
                            <div class="custom-arrow">
                              <select name="data24" id="reg_data24" class="form-control">
                                @foreach($request_data24 as $data24)
                                <option value="{{$data24->syouhinbango.' '}}{{$data24->jouhou}}" @if($data24->syouhinbango.' '.$data24->jouhou=="1 訂正可"){{'selected'}}@endif>
                                    {{$data24->syouhinbango.' '}}{{$data24->jouhou}}
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
                          <span>仕入先CD</span>
                        </div>
                      </div>
                      <div class="col-lg-9 col-md-9 col-sm-9">
                        <div class="outer row">
                          <div class="col-lg-12 ">
                            <input type="text" name="season" id="reg_season" class="form-control"
                              style="background:#fff;" readonly="readonly">
                            <div class="" onclick="openModalPopup1();"
                              style="bottom: 0; float: left; margin-top: 4px; position: absolute; right: 22px; top: 0px;">
                              <img src="{{url('img')}}/open-book.svg" height="20" width="20" alt=""
                                style="cursor: pointer;">
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row mt-1 mb-3">
              <div class="col-lg-4 col-md-4 col-sm-4">
                <div class="tbl_product w-100">
                  <div class=" row row_data">
                    <div class="col-lg-4 col-md-4 col-sm-6">
                      <div class="margin_t ">
                        <span>基本販売価格</span>
                      </div>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-6">
                      <div class="outer row">
                        <div class="col-lg-12 ">
                          <input name="kakaku" id="reg_kakaku" type="text" maxlength="8"
                            class="input_field form-control text-right checkValues">
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class=" row row_data">
                    <div class="col-lg-4 col-md-4 col-sm-6">
                      <div class="margin_t ">
                        <span>PB販売価格</span>
                      </div>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-6">
                      <div class="outer row">
                        <div class="col-lg-12 ">
                          <input name="hanbaisu" id="reg_hanbaisu" type="text" maxlength="8"
                            class="input_field form-control text-right checkValues"
                            onkeypress="return (event.charCode !=8 && event.charCode ==0 || event.charCode ==44 || (event.charCode >= 48 && event.charCode <= 57))">
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class=" row row_data">
                    <div class="col-lg-4 col-md-4 col-sm-6">
                      <div class="margin_t ">
                        <span>営業粗利</span>
                      </div>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-6">
                      <div class="outer row">
                        <div class="col-lg-12 ">
                          <input name="jyougensu" id="reg_jyougensu" type="hidden" maxlength="8"
                            class="input_field form-control text-right">
                          <div class="m_t" id="reg_jyougensuDiv" style="text-align: right;"></div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class=" row row_data">
                    <div class="col-lg-4 col-md-4 col-sm-6">
                      <div class="margin_t ">
                        <span>PB営業粗利</span>
                      </div>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-6">
                      <div class="outer row">
                        <div class="col-lg-12 ">
                          <input name="kakaku_yoyaku" id="reg_yoyaku" type="hidden" maxlength="8"
                            class="input_field form-control text-right">
                          <div class="m_t" id="reg_yoyakuDiv" style="text-align: right;"></div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-4 col-md-4 col-sm-4">
                <div class="tbl_product w-100">
                  <div class=" row row_data">
                    <div class="col-lg-4 col-md-4 col-sm-6">
                      <div class="margin_t ">
                        <span>仕入価格</span>
                      </div>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-6">
                      <div class="outer row">
                        <div class="col-lg-12 ">
                          <input name="yoyakusu" id="reg_yoyakusu" type="text" maxlength="8"
                            class="input_field form-control text-right checkValues" value=""
                            onkeypress="return (event.charCode !=8 && event.charCode ==0 || event.charCode ==44 || (event.charCode >= 48 && event.charCode <= 57))">
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class=" row row_data">
                    <div class="col-lg-4 col-md-4 col-sm-6">
                      <div class="margin_t ">
                        <span>仕切(SE)</span>
                      </div>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-6">
                      <div class="outer row">
                        <div class="col-lg-12 ">
                          <input name="yoyakukanousu" id="reg_yoyakukanousu" type="text" maxlength="8"
                            class="input_field form-control text-right checkValues"
                            onkeypress="return (event.charCode !=8 && event.charCode ==0 || event.charCode ==44 || (event.charCode >= 48 && event.charCode <= 57))">
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class=" row row_data">
                    <div class="col-lg-4 col-md-4 col-sm-6">
                      <div class="margin_t ">
                        <span>仕切(研究所)</span>
                      </div>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-6">
                      <div class="outer row">
                        <div class="col-lg-12 ">
                          <input name="sortbango" id="reg_sortbango" type="text" maxlength="8"
                            class="input_field form-control text-right checkValues"
                            onkeypress="return (event.charCode !=8 && event.charCode ==0 || event.charCode ==44 || (event.charCode >= 48 && event.charCode <= 57))">
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class=" row row_data">
                    <div class="col-lg-4 col-md-4 col-sm-6">
                      <div class="margin_t ">
                        <span>仕切(出荷ｾﾝﾀｰ)</span>
                      </div>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-6">
                      <div class="outer row">
                        <div class="col-lg-12 ">
                          <input name="dataint01" id="reg_dataint01" type="text" maxlength="8"
                            class="input_field form-control text-right checkValues"
                            onkeypress="return (event.charCode !=8 && event.charCode ==0 || event.charCode ==44 || (event.charCode >= 48 && event.charCode <= 57))">
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-4 col-md-4 col-sm-4">
                <div class="tbl_product w-100">
                  <div class=" row row_data" style="margin-top: 32px;">
                    <div class="col-lg-4 col-md-4 col-sm-6">
                      <div class="margin_t ">
                        <span>価格設定区分</span>
                      </div>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-6">
                      <div class="outer row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                          <div class="custom-arrow">
                            <select name="meker" id="reg_meker" class="form-control">
                              <option value="">-</option>
                              @foreach($request_meker as $meker)
                              <option value="{{$meker->syouhinbango.' '}}{{$meker->jouhou}}">
                                {{$meker->syouhinbango.' '}}{{$meker->jouhou}}</option>
                              @endforeach
                            </select>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class=" row row_data" style="">
                    <div class="col-lg-4 col-md-4 col-sm-6">
                      <div class="margin_t ">
                        <span>単位</span>
                      </div>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-6">
                      <div class="outer row">
                        <div class="col-lg-12 ">
                          <input type="text" name="konpoumei" id="reg_konpoumei" class="form-control">
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class=" row row_data" style="">
                    <div class="col-lg-4 col-md-4 col-sm-6">
                      <div class="margin_t ">
                        <span>単価区分</span>
                      </div>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-6">
                      <div class="outer row">
                        <div class="col-lg-12 ">
                          <div class="custom-arrow">
                            <select name="data101" id="reg_data101" class="form-control" style="width:100%;">
                              <option value="">-</option>
                              @foreach($data101 as $dt101)
                              <option value="{{$dt101->category1}}{{$dt101->category2}}">
                                {{$dt101->category1}}{{$dt101->category2.' '}}{{$dt101->category4}}</option>
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
            <div class="row mt-1 mb-3">
              <div class="col-lg-12">
                <div class="tbl_product w-100">
                  <div class=" row row_data">
                    <div class="col-lg-3 col-md-3 col-sm-3">
                      <div class="margin_t ">
                        <span>入力区分２</span> <span style="color: red;">※</span>
                      </div>
                    </div>
                    <div class="col-lg-5 col-md-5 col-sm-5">
                      <div class="outer row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                          <div class="custom-arrow">
                            <select name="data25" id="reg_data25" class="form-control">
                              <option value="">-</option>
                              @foreach($request_data25 as $data25)
                              <option value="{{$data25->syouhinbango.' '}}{{$data25->jouhou}}" @if($data25->
                                syouhinbango.'
                                '.$data25->jouhou=="1
                                訂正可"){{'selected'}}@endif>{{$data25->syouhinbango.' '}}{{$data25->jouhou}}</option>
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
                        <span>上市開始日 </span>
                      </div>
                    </div>
                    <div class="col-lg-5 col-md-5 col-sm-5">
                      <div class="outer row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                          <div class="input-group">
                            <input name="synchrosyouhinbango" id="reg_synchrosyouhinbango" type="text" maxlength="8"
                              onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))"
                              class="input_field form-control" autocomplete="off">
                            <div class="input-group-append" style="margin-left: 10px; margin-top: 7px;">
                              <span id="cal_icon1_p" class="fa fa-calendar"></span>
                            </div>
                          </div>
                          <div class="input-group">
                            <input id="datepicker1_comShow" readonly type="text" ignore class="input_field form-control search"
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
                    <div class="col-lg-5 col-md-5 col-sm-5">
                      <div class="outer row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                          <div class="input-group">
                            <input name="endtime" id="reg_endtime" type="text" maxlength="8"
                              onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))"
                              class="input_field form-control" autocomplete="off">
                            <div class="input-group-append" style="margin-left: 10px; margin-top: 7px;">
                              <span id="cal_icon2_p" class="fa fa-calendar"></span>
                            </div>
                          </div>
                          <div class="input-group">
                            <input id="datepicker2_comShow" readonly type="text" ignore class="input_field form-control search"
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
                        <span>製品仕入品区分</span><span style="color: red;"> ※</span>
                        </span>
                      </div>
                    </div>
                    <div class="col-lg-5 col-md-5 col-sm-5">
                      <div class="outer row">
                        <div class="col-lg-12 col-md-12 col-sm-12 ">
                          <div class="custom-arrow">
                            <select name="data52" id="reg_data52" class="form-control">
                              @foreach($data52 as $dt52)
                              <option value="{{$dt52->category1}}{{$dt52->category2}}">
                                {{$dt52->category1}}{{$dt52->category2.' '}}{{$dt52->category4}}</option>
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
                        <span>事業分類</span>
                      </div>
                    </div>
                    <div class="col-lg-5 col-md-5 col-sm-5">
                      <div class="outer row">
                        <div class="col-lg-12 col-md-12 col-sm-12 ">
                          <div class="custom-arrow">
                            <select name="data53" id="reg_data53" class="form-control">
                              @foreach($data53 as $dt53)
                              <option value="{{$dt53->category1}}{{$dt53->category2}}">
                                {{$dt53->category1}}{{$dt53->category2.' '}}{{$dt53->category4}}</option>
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
                        <span>保守サブスク区分</span>
                      </div>
                    </div>
                    <div class="col-lg-5 col-md-5 col-sm-5">
                      <div class="outer row">
                        <div class="col-lg-12 col-md-12 col-sm-12 ">
                          <div class="custom-arrow">
                            <select name="data54" id="reg_data54" class="form-control">
                              <option value="">-</option>
                              @foreach($data54 as $dt54)
                              <option value="{{$dt54->category1}}{{$dt54->category2}}">
                                {{$dt54->category1}}{{$dt54->category2.' '}}{{$dt54->category4}}</option>
                              @endforeach
                            </select>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class=" row row_data" id="data100">
                    <div class="col-lg-3 col-md-3 col-sm-3">
                      <div class="margin_t ">
                        <span>商品分類3</span><span style="color: red;"> ※</span>
                      </div>
                    </div>
                    <div class="col-lg-5 col-md-5 col-sm-5">
                      <div class="outer row">
                        <div class="col-lg-12 col-md-12 col-sm-12 ">
                          <div class="custom-arrow">
                            <select name="data100" id="reg_data100" class="form-control">
                              @foreach($data100 as $dt100)
                              <option value="{{$dt100->category1}}{{$dt100->category2}}">
                                {{$dt100->category1}}{{$dt100->category2.' '}}{{$dt100->category4}}</option>
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
                        <span>ﾎﾞﾘｭｰﾑﾗｲｾﾝｽ区分</span>
                      </div>
                    </div>
                    <div class="col-lg-5 col-md-5 col-sm-5">
                      <div class="outer row">
                        <div class="col-lg-12 col-md-12 col-sm-12 ">
                          <div class="custom-arrow">
                            <select name="data50" id="reg_data50" class="form-control">
                              <option value="">-</option>
                              @foreach($request_data50 as $data50)
                              <option value="{{$data50->syouhinbango.' '}}{{$data50->jouhou}}">
                                {{$data50->syouhinbango.' '}}{{$data50->jouhou}}</option>
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
                        <span>ﾊﾞｰｼﾞｮﾝｱｯﾌﾟ区分</span>
                      </div>
                    </div>
                    <div class="col-lg-5 col-md-5 col-sm-5">
                      <div class="outer row">
                        <div class="col-lg-12 col-md-12 col-sm-12 ">
                          <div class="custom-arrow">
                            <select name="data51" id="reg_data51" class="form-control">
                              <option value="">-</option>
                              @foreach($request_data51 as $data51)
                              <option value="{{$data51->syouhinbango.' '}}{{$data51->jouhou}}">
                                {{$data51->syouhinbango.' '}}{{$data51->jouhou}}</option>
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
                        <span>最新ﾊﾞｰｼﾞｮﾝ区分</span>
                      </div>
                    </div>
                    <div class="col-lg-5 col-md-5 col-sm-5">
                      <div class="outer row">
                        <div class="col-lg-12 col-md-12 col-sm-12 ">
                          <div class="custom-arrow">
                            <select name="data26" id="reg_data26" class="form-control">
                              <option value="">-</option>
                              @foreach($data26 as $dt26)
                              <option value="{{$dt26->category1}}{{$dt26->category2}}">
                                {{$dt26->category1}}{{$dt26->category2.' '}}{{$dt26->category4}}</option>
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
                        <span>前受請求区分</span>
                      </div>
                    </div>
                    <div class="col-lg-5 col-md-5 col-sm-5">
                      <div class="outer row">
                        <div class="col-lg-12 col-md-12 col-sm-12 ">未使用</div>
                      </div>
                    </div>
                  </div>
                  <div class=" row row_data">
                    <div class="col-lg-3 col-md-3 col-sm-3">
                      <div class="margin_t ">
                        <span>請求課税区分</span>
                      </div>
                    </div>
                    <div class="col-lg-5 col-md-5 col-sm-5">
                      <div class="outer row">
                        <div class="col-lg-12 ">
                          <div class="custom-arrow">
                            <select name="data28" id="reg_data28" class="form-control">
                              <option value="">-</option>
                              @foreach($data28 as $dt28)
                              <option value="{{$dt28->category1}}{{$dt28->category2}}">
                                {{$dt28->category1}}{{$dt28->category2.' '}}{{$dt28->category4}}</option>
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
                        <span>販売可能</span><span style="color: red;"> ※</span>
                      </div>
                    </div>
                    <div class="col-lg-5 col-md-5 col-sm-5">
                      <div class="outer row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                          <div class="custom-arrow">
                            <select name="data29" id="reg_data29" class="form-control">
                              @foreach($data29 as $dt29)
                              <option value="{{$dt29->category1}}{{$dt29->category2}}" @if($dt29->
                                category1.$dt29->category2.' '.$dt29->category4=="F61
                                有"){{'selected'}}@endif>{{$dt29->category1}}{{$dt29->category2.' '}}{{$dt29->category4}}
                              </option>
                              @endforeach
                            </select>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4">
                      <div class="outer row">
                        <div class="col-lg-5 col-md-5 col-sm-5">
                          <div class="margin_t ">
                            <span>保守作成区分</span><span style="color: red;"> ※</span>
                          </div>
                        </div>
                        <div class="col-lg-7 col-md-7 col-sm-7">
                          <div class="custom-arrow">
                            <select name="url" id="reg_url" class="form-control">
                              @foreach($url as $ul)
                              <option value="{{$ul->category1}}{{$ul->category2}}">
                                {{$ul->category1}}{{$ul->category2.' '}}{{$ul->category4}}</option>
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
            <div class="row mt-1 mb-3">
              <div class="col-lg-8 col-md-8 col-sm-12">
                <div class="tbl_product w-100">
                  <div class=" row row_data">
                    <div class="col-lg-3 col-md-3 col-sm-3">
                      <div class="margin_t ">
                        <span>受注先限定</span>
                      </div>
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-9">
                      <div class="outer row">
                        <div class="col-lg-4 col-md-4 col-sm-4">
                          <input name="jouhou2" id="reg_jouhou2" type="text" class="input_field form-control">
                        </div>
                        <div class="col-lg-8 col-md-8 col-sm-8 ">
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class=" row row_data" id="r_url_mobile">
                    <div class="col-lg-3 col-md-3 col-sm-3">
                      <div class="margin_t ">
                        <span>保守商品CD</span>
                      </div>
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-9">
                      <div class="outer row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                          <div class="custom-arrow">
                            <select name="url_mobile" id="reg_url_mobile" class="form-control">
                              <option value="">-</option>
                              @foreach($syouhin1Info as $sInfo)
                              <option value="{{$sInfo->kokyakusyouhinbango}}">
                                {{$sInfo->kokyakusyouhinbango.' '}}{{$sInfo->name}}</option>
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
                        <span>セット商品上位CD</span>
                      </div>
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-9">
                      <div class="outer row">
                        <div class="col-lg-4 col-md-4 col-sm-4 ">
                          <input name="chardata4" id="reg_chardata4" data-bango="{{ $bango }}" type="text"
                            class="form-control">
                        </div>
                        <div class="col-lg-8 col-md-8 col-sm-8 " id="reg_syouhin_name"></div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row mt-1 mb-3">
              <div class="col-lg-8 col-md-8 col-sm-8">
                <div class="tbl_product w-100">
                  <div class=" row row_data">
                    <div class="col-lg-3 col-lg-3 col-md-3 col-sm-3">
                      <div class="margin_t ">
                        <span>メーカー品番</span>
                      </div>
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-9">
                      <div class="outer row">
                        <div class="col-lg-12 col-md-12 col-sm-12 ">
                          <input name="kongouritsu" id="reg_kongouritsu" type="text" class=" input_field form-control"
                            onkeydown="lastTab1_product(event)">
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class=" row row_data">
                    <div class="col-lg-3 col-md-3 col-sm-3">
                      <div class="margin_t " style="margin-top: 28px;">
                        <span>メーカー品名</span>
                      </div>
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-9">
                      <div class="outer row">
                        <div class="col-lg-12 col-md-12 col-sm-12 ">
                          <div class="form-group">
                            <textarea name="mdjouhou" id="reg_mdjouhou" class="form-control" rows="5"
                              style="height: 62px;padding-left: 0px;"></textarea>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class=" row row_data">
                    <div class="col-lg-3 col-md-3 col-sm-3">
                      <div class="margin_t ">
                        <span>保守会社CD</span>
                      </div>
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-9">
                      <div class="outer row">
                        <div class="col-lg-12 ">
                          <input type="text" name="data104" id="reg_data104" class="form-control"
                            style="background:#fff;" readonly="readonly">
                          <div class="" onclick="openModalPopup2();"
                            style="bottom: 0; float: left; margin-top: 4px; position: absolute; right: 22px; top: 0px;">
                            <img src="{{url('img')}}/open-book.svg" height="20" width="20" alt=""
                              style="cursor: pointer;">
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class=" row row_data">
                    <div class="col-lg-3 col-md-3 sm-3">
                      <div class="margin_t ">
                        <span>内訳製品粗利比率</span>
                      </div>
                    </div>
                    <div class="col-lg-9">
                      <div class="outer row">
                        <div class="col-lg-6 col-md-6 sm-6">
                          <div class="custom-arrow">
                            <select name="dspbango" id="reg_dspbango" class="form-control" style="width:100%;">
                              <option value="">-</option>
                              @foreach($dspbango as $dspbang)
                              <option value="{{$dspbang->category1}}{{$dspbang->category2}}">
                                {{$dspbang->category1}}{{$dspbang->category2.' '}}{{$dspbang->category4}}</option>
                              @endforeach
                            </select>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class=" row row_data">
                    <div class="col-lg-3 col-md-3 sm-3">
                      <div class="margin_t ">
                        <span>UIS対象商品</span>
                      </div>
                    </div>
                    <div class="col-lg-9 col-md-9 sm-9">
                      <div class="outer row">
                        <div class="col-lg-6 col-md-6 sm-6">
                          <div class="custom-arrow">
                            <select name="syouhin4_color" id="reg_syouhin4_color" class="form-control"
                              style="width:100%;">
                              <option value="">-</option>
                              @foreach($syouhin4_color as $syouhin4_clr)
                              <option value="{{$syouhin4_clr->category1}}{{$syouhin4_clr->category2}}">
                                {{$syouhin4_clr->category1}}{{$syouhin4_clr->category2.' '}}{{$syouhin4_clr->category4}}
                              </option>
                              @endforeach
                            </select>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class=" row row_data">
                    <div class="col-lg-3 col-md-3 sm-3">
                      <div class="margin_t ">
                        <span>納品方法</span>
                      </div>
                    </div>
                    <div class="col-lg-9 col-md-9 sm-9">
                      <div class="outer row">
                        <div class="col-lg-6 col-md-6 sm-6 ">
                          <div class="custom-arrow">
                            <select name="syouhin4_size" id="reg_syouhin4_size" class="form-control"
                              style="width:100%;">
                              <option value="">-</option>
                              @foreach($syouhin4_size as $syouhin4_sz)
                              <option value="{{$syouhin4_sz->category1}}{{$syouhin4_sz->category2}}">
                                {{$syouhin4_sz->category1}}{{$syouhin4_sz->category2.' '}}{{$syouhin4_sz->category4}}
                              </option>
                              @endforeach
                            </select>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class=" row row_data">
                    <div class="col-lg-3 col-md-3 sm-3">
                      <div class="margin_t ">
                        <span>予備4</span>
                      </div>
                    </div>
                    <div class="col-lg-9 col-md-9 sm-9">
                      <div class="outer row">
                        <div class="col-lg-6 col-md-6 sm-6 ">
                          <div class="custom-arrow">
                            <select name="syouhingroup" id="reg_syouhingroup" class="form-control" style="width:100%;">
                              <option value="">-</option>
                              @foreach($syouhingroup as $syouhingrp)
                              <option value="{{$syouhingrp->category1}}{{$syouhingrp->category2}}">
                                {{$syouhingrp->category1}}{{$syouhingrp->category2.' '}}{{$syouhingrp->category4}}
                              </option>
                              @endforeach
                            </select>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class=" row row_data">
                    <div class="col-lg-3 col-md-3 sm-3">
                      <div class="margin_t ">
                        <span>予備5</span>
                      </div>
                    </div>
                    <div class="col-lg-9 col-md-9 sm-9">
                      <div class="outer row">
                        <div class="col-lg-6 col-md-6 sm-6">
                          <div class="custom-arrow">
                            <select name="ruijihinbango" id="reg_ruijihinbango" class="form-control"
                              style="width:100%;">
                              <option value="">-</option>
                              @foreach($ruijihinbango as $ruijihinbng)
                              <option value="{{$ruijihinbng->category1}}{{$ruijihinbng->category2}}">
                                {{$ruijihinbng->category1}}{{$ruijihinbng->category2.' '}}{{$ruijihinbng->category4}}
                              </option>
                              @endforeach
                            </select>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class=" row row_data">
                    <div class="col-lg-3 col-md-3 sm-3">
                      <div class="margin_t ">
                        <span>予備6</span>
                      </div>
                    </div>
                    <div class="col-lg-9">
                      <div class="outer row">
                        <div class="col-lg-6 col-md-6 sm-6">
                          <div class="custom-arrow">
                            <select name="chardata1" id="reg_chardata1" class="form-control" style="width:100%;">
                              <option value="">-</option>
                              @foreach($chardata1 as $chardt1)
                              <option value="{{$chardt1->category1}}{{$chardt1->category2}}">
                                {{$chardt1->category1}}{{$chardt1->category2.' '}}{{$chardt1->category4}}</option>
                              @endforeach
                            </select>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class=" row row_data">
                    <div class="col-lg-3 col-md-3 sm-3">
                      <div class="margin_t ">
                        <span>予備7</span>
                      </div>
                    </div>
                    <div class="col-lg-9 col-md-9 sm-9">
                      <div class="outer row">
                        <div class="col-lg-6 col-md-6 sm-6 ">
                          <div class="custom-arrow">
                            <select name="chardata2" id="reg_chardata2" class="form-control" style="width:100%;">
                              <option value="">-</option>
                              @foreach($chardata2 as $chardt2)
                              <option value="{{$chardt2->category1}}{{$chardt2->category2}}">
                                {{$chardt2->category1}}{{$chardt2->category2.' '}}{{$chardt2->category4}}</option>
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
        <div class="modal-footer">

        </div>
      </div>
    </div>
  </div>
</form>

<script type="text/javascript">
  // Registration Modal
  $('#registrationModal').scroll(function () {
    $("#datepicker1_comShow").datepicker("hide", function () { }, 0);
    $("#datepicker2_comShow").datepicker("hide", function () { }, 0);
  });
</script>

<script type="text/javascript">
  function calInputKey1(e) {
    if (!e) {
      var e = window.event;
    }

    if (((e.keyCode >= 48 && e.keyCode <= 57 || e.keyCode == 47) && (!e.shiftKey && !e.altKey && !e.ctrlKey))) {
      return true;
    }
    
    else {
      e.preventDefault();
      return false;
    }
  }

  document.getElementById('reg_synchrosyouhinbango').addEventListener("keypress", calInputKey1, false);
  $("#reg_synchrosyouhinbango").on("input", function () {
    if (/^0/.test(this.value)) {
      this.value = this.value.replace(/^0/, "")
    }
  })
</script>
<script type="text/javascript">
  function calInputKey2(e) {
    if (!e) {
      var e = window.event;
    }

    //allow only numeric input
    //48-57 and 96-105 (keyboard left and numpad)
    if (((e.keyCode >= 48 && e.keyCode <= 57 || e.keyCode == 47) && (!e.shiftKey && !e.altKey && !e.ctrlKey))) {
      return true;
    }
    else {
      e.preventDefault();
      return false;
    }
  }

  document.getElementById('reg_endtime').addEventListener("keypress", calInputKey2, false);
  $("#reg_endtime").on("input", function () {
    if (/^0/.test(this.value)) {
      this.value = this.value.replace(/^0/, "")
    }
  })
</script>
<!-- script for prevent tab input and allow enter keyboard input -->

<script type="text/javascript">
  function lastTab1_product(event) {
    if (event.keyCode == 13) {
      document.getElementById("reg_kokyakusyouhinbango").focus();
      event.preventDefault();
    }
  }
</script>

<script>
  function makeSuitableNumber($value) {
    if (isNaN($value)) {
      return 0
    }
    return $value;
  }

  $('.checkValues').on('keyup', function (e) {
    var kakaku = $("#registrationForm").find("input[name=kakaku]").val();
    var kakaku = Number(kakaku);
    var hanbaisu = $("#registrationForm").find("input[name=hanbaisu]").val();
    var hanbaisu = Number(hanbaisu);
    var yoyakusu = $("#registrationForm").find("input[name=yoyakusu]").val();
    var yoyakusu = Number(yoyakusu);
    var yoyakukanousu = $("#registrationForm").find("input[name=yoyakukanousu]").val();
    var yoyakukanousu = Number(yoyakukanousu);
    var sortbango = $("#registrationForm").find("input[name=sortbango]").val();
    var sortbango = Number(sortbango);
    var dataint01 = $("#registrationForm").find("input[name=dataint01]").val();
    var dataint01 = Number(dataint01);

    var result = (yoyakusu + yoyakukanousu + sortbango + dataint01)

    var resultOne = kakaku - result;
    var resultTwo = hanbaisu - result;
    $("#reg_yoyakuDiv").text(makeSuitableNumber(resultTwo));
    $("#reg_yoyaku").val(makeSuitableNumber(resultTwo));
    $("#reg_jyougensuDiv").text(makeSuitableNumber(resultOne));
    $("#reg_jyougensu").val(makeSuitableNumber(resultOne));
  });
</script>