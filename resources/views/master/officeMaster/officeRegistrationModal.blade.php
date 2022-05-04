<style media="screen">
  .invoice_mail_change_stat{
    display: none;
  }
</style>
<form id="registrationForm" action="{{ route('postEditOfficeMaster',[$bango]) }}"
  data-regmethod="officeMasterRegistration" method="post">
  @csrf
  <input type="hidden" name="type" value="create">
  <div class="modal custom-form" data-keyboard="false" data-backdrop="static" id="registrationModal" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true" style="overflow: hidden !important;">
    <div class="modal-dialog" style="max-width: 900px !important;" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h6 class="modal-title" id="exampleModalLabel"></h6>
          <button type="button" class="close" onclick="closeModal('registrationModal');">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body" style="overflow-y: scroll; max-height: 81vh;" data-bind="nextFieldOnEnter:true">
          <div class="development_page_top_table heading_mt">

            {{-- Error Message Starts Here --}}
            <div id="error_data" style="padding-left: 1px !important;"></div>
            {{-- Error Message Ends Here --}}

            <div class="row titlebr" style="margin-bottom: 12px;padding: 0px 15px;">
              <div class="col-lg-12">
                <div style="display: inline;">
                  <div style="float:left; ">
                    <table class="dev_tble_button">
                      <tbody>
                        <tr>
                          <td class=""
                            style="padding-left: 0px!important;width: 100px!important;border:none!important; ">
                            <h5>事業所マスタ(登録)</h5>
                            <div class="mt-3"> 新規(処理状況)</div>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                  <div style="float: right;">
                    <button type="button" id="insertSubmit"
                      onclick="officeMasterRegistration('{{route("postEditOfficeMaster",[$bango])}}')"
                      class="btn btn-info">
                      <i class="fas fa-save" style="margin-right: 5px;"></i>保存
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="container h-100 py-2">
            <ul class="nav nav-tabs " id="myTab" role="tablist">
              <li class="nav-item">
                <a class="nav-link active show" id="common1-tab-office" data-toggle="tab" href="#common1-office"
                  role="tab" aria-controls="common1" aria-selected="true"><b>共通</b>
                </a>
              </li>
              <li class="nav-item" id="reg_nav_item_2">
                <a class="nav-link" id="sales_billing1_office_tab" data-toggle="tab" href="#sales_billing1_office"
                  role="tab" aria-controls="sales_billing1_office" aria-selected="false"><b>売上・請求</b>
                </a>
              </li>
              <li class="nav-item" id="reg_nav_item_3">
                <a class="nav-link" id="payment1-office-tab" data-toggle="tab" href="#payment1-office" role="tab"
                  aria-controls="payment1-office" aria-selected="false"><b>仕入・支払</b>
                </a>
              </li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane h-100 p-3 border active show" id="common1-office" role="tabpanel"
                aria-labelledby="common1-tab-office">
                <div id="input_boxwrap_common1" class="input_boxwrap_common1" data-bind="nextFieldOnEnter:true">
                  <div class="row mt-1 mb-3">
                    <div class="col-lg-12 col-md-12">
                      <div class="tbl_name">
                        <div class="w-100">
                          <div class=" row row_data">
                            <div class="col-lg-2 col-md-2">
                              <div class="margin_t ">
                                <span>会社CD <span style="color: red;">※</span></span>
                              </div>
                            </div>
                            <div class="col-lg-9 col-md-9">
                              <div class="outer row">
                                <div class="col-lg-6 col-md-6">
                                  <div class="custom-arrow">
                                    <select name="shikibetsucode" id="insert_shikibetsucode"
                                      onchange="loadSelectedKokyaku(this,'{{route('loadSelectedKokyaku',[$bango])}}',1)"
                                      class="form-control custom_select_search" autofocus style="width:100%">
                                      @foreach($kokyakus as $kokyaku)
                                      <option value="{{$kokyaku->yobi12}}"
                                        data-id="{{$kokyaku->yobi12}} {{$kokyaku->name}}">{{$kokyaku->yobi12}}
                                        {{$kokyaku->name}}</option>
                                      @endforeach
                                    </select>
                                  </div>
                                </div>
                                <div class="col-lg-4 col-md-4 m-pl-15"></div>
                              </div>
                            </div>
                          </div>
                          <div class=" row row_data">
                            <div class="col-lg-2 col-md-2">
                              <div class="margin_t ">
                                <span>事業所名</span> <span style="color:red;">※</span>
                              </div>
                            </div>
                            <div class="col-lg-9 col-md-9">
                              <div class="outer row">
                                <div class="col-lg-6 col-md-6">
                                  <input type="text" name="name" id="insert_name" class="form-control" value="">
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class=" row row_data">
                            <div class="col-lg-2 col-md-2">
                              <div class="margin_t ">
                                <span>事業所名略称</span> <span style="color:red;">※</span>
                              </div>
                            </div>
                            <div class="col-lg-9 col-md-9">
                              <div class="outer row">
                                <div class="col-lg-6 col-md-6">
                                  <input type="text" id="insert_haisoumoji1" name="haisoumoji1" class="form-control">
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row mt-1 mb-3">
                    <div class="col-lg-12 col-md-12 ">
                      <div class="tbl_name">
                        <div class="w-100">
                          <div class=" row row_data">
                            <div class="col-lg-2 col-md-2">
                              <div class="margin_t ">
                                <span>入力区分 <span style="color: red;">※</span></span>
                              </div>
                            </div>
                            <div class="col-lg-9 col-md-9">
                              <div class="outer row">
                                <div class="col-lg-4 col-md-4 ">
                                  <div class="custom-arrow">
                                    <select class="form-control left_select" name="torihikisakirank1"
                                      id="insert_torihikisakirank1" style="width:100%;">
                                      @foreach($requests as $request)
                                      <option value="{{$request->syouhinbango}} {{$request->jouhou}}" @if($request->syouhinbango == "0"){{"selected"}}@endif>
                                        {{$request->syouhinbango}} {{$request->jouhou}}</option>
                                      @endforeach
                                    </select>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class=" row row_data">
                            <div class="col-lg-2 col-md-2">
                              <div class="margin_t ">
                                <span>担当SA1</span>
                              </div>
                            </div>
                            <div class="col-lg-9 col-md-9">
                              <div class="outer row">
                                <div class="col-lg-4 col-md-4">
                                  <div class="custom-arrow">
                                    <select class="form-control" name="syukeitukikijun" id="insert_syukeitukikijun"
                                      style="width:100%;">
                                      <option value="">-</option>
                                      @foreach($tantousyas as $tantousya)
                                      <option value="{{$tantousya->bango}}">{{$tantousya->bango}} {{$tantousya->name}}
                                      </option>
                                      @endforeach
                                    </select>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class=" row row_data">
                            <div class="col-lg-2 col-md-2">
                              <div class="margin_t ">
                                <span>担当SA2</span>
                              </div>
                            </div>
                            <div class="col-lg-9 col-md-9">
                              <div class="outer row">
                                <div class="col-lg-4 col-md-4">
                                  <div class="custom-arrow">
                                    <select class="form-control" name="syukeituki" id="insert_syukeituki"
                                      style="width:100%;">
                                      <option value="">-</option>
                                      @foreach($tantousyas as $tantousya)
                                      <option value="{{$tantousya->bango}}">{{$tantousya->bango}} {{$tantousya->name}}
                                      </option>
                                      @endforeach
                                    </select>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class=" row row_data">
                            <div class="col-lg-2 col-md-2">
                              <div class="margin_t ">
                                <span>担当SE1</span>
                              </div>
                            </div>
                            <div class="col-lg-9 col-md-9 ">
                              <div class="outer row">
                                <div class="col-lg-4 col-md-4">
                                  <div class="custom-arrow">
                                    <select class="form-control" name="syukeikikijun" id="insert_syukeikikijun"
                                      style="width:100%;">
                                      <option value="">-</option>
                                      @foreach($tantousyas as $tantousya)
                                      <option value="{{$tantousya->bango}}">{{$tantousya->bango}} {{$tantousya->name}}
                                      </option>
                                      @endforeach
                                    </select>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class=" row row_data">
                            <div class="col-lg-2 col-md-2">
                              <div class="margin_t ">
                                <span>担当SE2</span>
                              </div>
                            </div>
                            <div class="col-lg-9 col-md-9 ">
                              <div class="outer row">
                                <div class="col-lg-4 col-md-4 ">
                                  <div class="custom-arrow">
                                    <select class="form-control" name=" syukeinenkijun" id="insert_syukeinenkijun"
                                      style="width:100%;">
                                      <option value="">-</option>
                                      @foreach($tantousyas as $tantousya)
                                      <option value="{{$tantousya->bango}}">{{$tantousya->bango}} {{$tantousya->name}}
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
                  <div class="row mt-1 mb-3">
                    <div class="col-lg-12 col-md-12">
                      <div class="tbl_name">
                        <div class="w-100">
                          <div class=" row row_data">
                            <div class="col-lg-2 col-md-2">
                              <div class="margin_t ">
                                <span>郵便番号</span>@if(isset($init_selected_kokyaku->mail_jyushin_mb) && substr($init_selected_kokyaku->mail_jyushin_mb,0,1)=="1" && substr($init_selected_kokyaku->syukeituki,0,1)=="1")<span style="color:red;" class="invoice_mail_change">※</span>@endif
                              </div>
                            </div>
                            <div class="col-lg-9 col-md-9">
                              <div class="outer row">
                                <div class="col-lg-4 col-md-4 ">
                                  <input type="text" name="zip1" id="insert_zip1" class="form-control">
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class=" row row_data">
                            <div class="col-lg-2 col-md-2">
                              <div class="margin_t ">
                                <span>都道府県名</span>@if(isset($init_selected_kokyaku->mail_jyushin_mb) && substr($init_selected_kokyaku->mail_jyushin_mb,0,1)=="1" && substr($init_selected_kokyaku->syukeituki,0,1)=="1")<span style="color:red;" class="invoice_mail_change">※</span>@endif
                              </div>
                            </div>
                            <div class="col-lg-9 col-md-9">
                              <div class="outer row">
                                <div class="col-lg-4 col-md-4">
                                  <div class="custom-arrow">
                                    <select class="form-control" name="address1" id="insert_address1"
                                      style="width:100%;">
                                      <option value="">-</option>
                                      <option label="北海道" value="北海道">北海道</option>
                                      <option label="青森県" value="青森県">青森県</option>
                                      <option label="岩手県" value="岩手県">岩手県</option>
                                      <option label="宮城県" value="宮城県">宮城県</option>
                                      <option label="秋田県" value="秋田県">秋田県</option>
                                      <option label="山形県" value="山形県">山形県</option>
                                      <option label="福島県" value="福島県">福島県</option>
                                      <option label="茨城県" value="茨城県">茨城県</option>
                                      <option label="栃木県" value="栃木県">栃木県</option>
                                      <option label="群馬県" value="群馬県">群馬県</option>
                                      <option label="埼玉県" value="埼玉県">埼玉県</option>
                                      <option label="千葉県" value="千葉県">千葉県</option>
                                      <option label="東京都" value="東京都">東京都</option>
                                      <option label="神奈川県" value="神奈川県">神奈川県</option>
                                      <option label="新潟県" value="新潟県">新潟県</option>
                                      <option label="富山県" value="富山県">富山県</option>
                                      <option label="石川県" value="石川県">石川県</option>
                                      <option label="福井県" value="福井県">福井県</option>
                                      <option label="山梨県" value="山梨県">山梨県</option>
                                      <option label="長野県" value="長野県">長野県</option>
                                      <option label="岐阜県" value="岐阜県">岐阜県</option>
                                      <option label="静岡県" value="静岡県">静岡県</option>
                                      <option label="愛知県" value="愛知県">愛知県</option>
                                      <option label="三重県" value="三重県">三重県</option>
                                      <option label="滋賀県" value="滋賀県">滋賀県</option>
                                      <option label="京都府" value="京都府">京都府</option>
                                      <option label="大阪府" value="大阪府">大阪府</option>
                                      <option label="兵庫県" value="兵庫県">兵庫県</option>
                                      <option label="奈良県" value="奈良県">奈良県</option>
                                      <option label="和歌山県" value="和歌山県">和歌山県</option>
                                      <option label="鳥取県" value="鳥取県">鳥取県</option>
                                      <option label="島根県" value="島根県">島根県</option>
                                      <option label="岡山県" value="岡山県">岡山県</option>
                                      <option label="広島県" value="広島県">広島県</option>
                                      <option label="山口県" value="山口県">山口県</option>
                                      <option label="徳島県" value="徳島県">徳島県</option>
                                      <option label="香川県" value="香川県">香川県</option>
                                      <option label="愛媛県" value="愛媛県">愛媛県</option>
                                      <option label="高知県" value="高知県">高知県</option>
                                      <option label="福岡県" value="福岡県">福岡県</option>
                                      <option label="佐賀県" value="佐賀県">佐賀県</option>
                                      <option label="長崎県" value="長崎県">長崎県</option>
                                      <option label="熊本県" value="熊本県">熊本県</option>
                                      <option label="大分県" value="大分県">大分県</option>
                                      <option label="宮崎県" value="宮崎県">宮崎県</option>
                                      <option label="鹿児島県" value="鹿児島県">鹿児島県</option>
                                      <option label="沖縄県" value="沖縄県">沖縄県</option>
                                    </select>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class=" row row_data">
                            <div class="col-lg-2 col-md-2">
                              <div class="margin_t ">
                                <span>市区町村名</span>@if(isset($init_selected_kokyaku->mail_jyushin_mb) && substr($init_selected_kokyaku->mail_jyushin_mb,0,1)=="1" && substr($init_selected_kokyaku->syukeituki,0,1)=="1")<span style="color:red;" class="invoice_mail_change">※</span>@endif
                              </div>
                            </div>
                            <div class="col-lg-9 col-md-9">
                              <div class="outer row">
                                <div class="col-lg-8 col-md-8 ">
                                  <input type="text" class="form-control" name="address2" id="insert_address2">
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class=" row row_data">
                            <div class="col-lg-2 col-md-2">
                              <div class="margin_t ">
                                <span>町域名</span>@if(isset($init_selected_kokyaku->mail_jyushin_mb) && substr($init_selected_kokyaku->mail_jyushin_mb,0,1)=="1" && substr($init_selected_kokyaku->syukeituki,0,1)=="1")<span style="color:red;" class="invoice_mail_change">※</span>@endif
                              </div>
                            </div>
                            <div class="col-lg-9 col-md-9">
                              <div class="outer row">
                                <div class="col-lg-8 col-md-8">
                                  <input type="text" class="form-control" name="address3" id="insert_address3">
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class=" row row_data">
                            <div class="col-lg-2 col-md-2">
                              <div class="margin_t ">
                                <span>番地・建物名</span>@if(isset($init_selected_kokyaku->mail_jyushin_mb) && substr($init_selected_kokyaku->mail_jyushin_mb,0,1)=="1" && substr($init_selected_kokyaku->syukeituki,0,1)=="1")<span style="color:red;" class="invoice_mail_change"></span>@endif
                              </div>
                            </div>
                            <div class="col-lg-9 col-md-9">
                              <div class="outer row">
                                <div class="col-lg-8 col-md-8">
                                  <input type="text" class="form-control" name="address4" id="insert_address4">
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row mt-1 mb-3">
                    <div class="col-lg-12 col-md-12">
                      <div class="tbl_name">
                        <div class="w-100">
                          <div class=" row row_data">
                            <div class="col-lg-2 col-md-2">
                              <div class="margin_t ">
                                <span>TEL</span>
                              </div>
                            </div>
                            <div class="col-lg-9 col-md-9">
                              <div class="outer row">
                                <div class="col-lg-4 col-md-4">
                                  <input type="text" class="form-control" name="tel" id="insert_tel">
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class=" row row_data">
                            <div class="col-lg-2 col-md-2">
                              <div class="margin_t ">
                                <span>FAX</span>
                              </div>
                            </div>
                            <div class="col-lg-9 col-md-9">
                              <div class="outer row">
                                <div class="col-lg-4 col-md-4">
                                  <input type="text" class="form-control" name="torihikisakirank2"
                                    id="insert_torihikisakirank2">
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class=" row row_data">
                            <div class="col-lg-2 col-md-2">
                              <div class="margin_t ">
                                <span>JIS市区町村CD</span>
                              </div>
                            </div>
                            <div class="col-lg-9 col-md-9">
                              <div class="outer row">
                                <div class="col-lg-4 col-md-4">
                                    <input name="yobi1" id="reg_yobi1" type="text" class="form-control">
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row mt-1">
                    <div class="col-lg-12 col-md-12">
                      <div class="tbl_name">
                        <div class="w-100">
                          <div class=" row row_data">
                            <div class="col-lg-2 col-md-2">
                              <div class="margin_t ">
                                <span>メールアドレス</span>
                              </div>
                            </div>
                            <div class="col-lg-9 col-md-9">
                              <div class="outer row">
                                <div class="col-lg-8 col-md-8">
                                  <input type="text" class="form-control" name="mail" id="insert_mail">
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class=" row row_data">
                            <div class="col-lg-2 col-md-2">
                              <div class="margin_t ">
                                <span>(確認用)</span>
                              </div>
                            </div>
                            <div class="col-lg-9 col-md-9">
                              <div class="outer row">
                                <div class="col-lg-8 col-md-8 ">
                                  <input type="text" class="form-control" id="insert_mail_confirmation"
                                    name="mail_confirmation">
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row mt-2 mb-3">
                    <div class="col-lg-9 col-md-9">
                      <div class="tbl_product w-100">
                        <div class=" row row_data">
                          <div class="col-lg-2 col-md-2">
                            <div class="margin_t ">
                              <span>売上区分</span> <span style="color:red;">※</span>
                            </div>
                          </div>
                          <div class="col-lg-10 col-md-10">
                            <div class="outer row">
                              <div class="col-lg-3 col-md-3 ">
                                <input type="text" name="haisoumoji2" id="insert_haisoumoji2"
                                  value="@if(!empty($init_selected_kokyaku)){{ substr($init_selected_kokyaku->syukeituki,0,1) }}@endif"
                                  class="input_field form-control">
                              </div>
                              <div class="col-lg-5 col-md-5">
                                <div class="m_t">1：有、2：無</div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class=" row row_data">
                          <div class="col-lg-2 col-md-2">
                            <div class="margin_t ">
                              <span>仕入区分</span> <span style="color:red;">※</span>
                            </div>
                          </div>
                          <div class="col-lg-10 col-md-10">
                            <div class="outer row">
                              <div class="col-lg-3 col-md-3">
                                <input type="text" name="syukeiki" id="insert_syukeiki"
                                  value="@if(!empty($init_selected_kokyaku)){{substr($init_selected_kokyaku->syukeikikijun,0,1)}}@endif"
                                  class="input_field form-control">
                              </div>
                              <div class="col-lg-5 col-md-5">
                                <div class="m_t">1：有、2：無</div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row mt-2 mb-3">
                    <div class="col-lg-12 col-md-12">
                      <div class="tbl_product w-100">
                        <div class=" row row_data mt-2">
                          <div class="col-lg-3 col-md-3">
                            <div class="margin_t ">
                              <span>事業所口座使用区分</span>
                            </div>
                          </div>
                          <div class="col-lg-9 col-md-9">
                            <div class="outer row">
                              <div class="col-lg-3 col-md-3">
                                <input type="text" name="other1" id="insert_other1" value="1" class="form-control">
                              </div>
                              <div class="col-lg-4 col-md-4 ">
                                <div class="m_t" style="font-size: 12px;">1：会社Ｍ、2：事業所Ｍ
                                </div>
                              </div>
                              <div class="col-lg-5 col-md-5">
                                <div class="outer row">
                                  <div class="col-lg-5 col-md-5">
                                    <div class="margin_t ">
                                      <span>旧取引先CD</span>
                                    </div>
                                  </div>
                                  <div class="col-lg-7 col-md-7">
                                    <input type="text" name="other36" id="insert_other36"
                                      class="form-control lastEnter">
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

              <!-- sales and billing tabbed menu -->
              <div class="tab-pane fade h-100 p-3 border" id="sales_billing1_office" role="tabpanel"
                aria-labelledby="sales_billing1_office_tab">
                <div id="input_boxwrap_sales_billing1" data-bind="nextFieldOnEnter:true">
                  <div class="row mt-1 mb-3">
                    <div class="col-lg-12 col-md-12">
                      <div class="tbl_company w-100">
                        <div class=" row row_data">
                          <div class="col-lg-3 col-md-3">
                            <div class="margin_t ">
                              <span>即時区分</span><span style="color: red;">※</span>
                            </div>
                          </div>
                          <div class="col-lg-2 col-md-2">
                            <div>
                              <input type="text" name="other2" id="insert_other2"
                                value="@if(!empty($init_selected_kokyaku)){{substr($init_selected_kokyaku->kcode3,0,1)}}@endif"
                                autofocus class="input_field form-control hover_message_content" message="message 2">
                            </div>
                          </div>
                          <div class="col-lg-5 col-md-5">
                            <div class="m_t" style="font-size: 12px;">1：即時、2：締日
                            </div>
                          </div>
                        </div>
                        <div class=" row row_data">
                          <div class="col-lg-3 col-md-3">
                            <div class="margin_t ">
                              <span>請求締め日</span> <span style="color: red;">※</span></div>
                          </div>
                          <div class="col-lg-9 col-md-9">
                            <div class="outer row">
                              <div class="col-lg-6 col-md-6">
                                <div class="custom-arrow">
                                  <select name="other3" id="insert_other3" class="form-control" style="width:100%;">
                                    @foreach($other3 as $othr3)
                                    <option value="{{$othr3->category1}}{{$othr3->category2}}"
                                      @if(!empty($init_selected_kokyaku)) @if($init_selected_kokyaku->ytoiawsestart ==
                                      $othr3->category1.$othr3->category2) selected @endif @endif >
                                      {{$othr3->category1}}{{$othr3->category2.' '}}{{$othr3->category4}}
                                    </option>
                                    @endforeach
                                  </select>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class=" row row_data">
                          <div class="col-lg-3 col-md-3">
                            <div class="margin_t ">
                              <span>入金方法</span> <span style="color: red;">※</span></div>
                          </div>
                          <div class="col-lg-9 col-md-9">
                            <div class="outer row">
                              <div class="col-lg-6 col-md-6">
                                <div class="custom-arrow">
                                  <select name="other4" id="insert_other4" class="form-control" style="width:100%;">
                                    @foreach($other4 as $othr4)
                                    <option value="{{$othr4->category1}}{{$othr4->category2}}"
                                      @if(!empty($init_selected_kokyaku)) @if($init_selected_kokyaku->ytoiawseend ==
                                      $othr4->category1.$othr4->category2) selected @endif @endif >
                                      {{$othr4->category1}}{{$othr4->category2.' '}}{{$othr4->category4}}
                                    </option>
                                    @endforeach
                                  </select>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class=" row row_data">
                          <div class="col-lg-3 col-md-3">
                            <div class="margin_t ">
                              <span>入金月</span> <span style="color: red;">※</span></div>
                          </div>
                          <div class="col-lg-9 col-md-9">
                            <div class="outer row">
                              <div class="col-lg-4 col-md-4">
                                <input type="text" name="other5" id="insert_other5"
                                  value="@if(!empty($init_selected_kokyaku)){{substr($init_selected_kokyaku->ytoiawsesaiban,0,1)}}@endif"
                                  class="form-control">
                              </div>
                              <div class="col-lg-8 col-md-8">
                                <div class="m_t" style="font-size: 12px;">0：当月、1：翌月、2：翌々月、3：3か月、4：4か月
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class=" row row_data">
                          <div class="col-lg-3 col-md-3">
                            <div class="margin_t ">
                              <span>入金日</span> <span style="color: red;">※</span></div>
                          </div>
                          <div class="col-lg-9 col-md-9">
                            <div class="outer row">
                              <div class="col-lg-4 col-md-4">
                                <div class="custom-arrow">
                                  <select name="other6" id="insert_other6" class="form-control" style="width:100%;">
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
                              <div class="col-lg-8 col-md-8">
                                <div class="m_t" style="font-size: 12px;">
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class=" row row_data">
                          <div class="col-lg-3 col-md-3">
                            <div class="margin_t ">
                              <span>入金日休日設定</span> <span style="color: red;">※</span></div>
                          </div>
                          <div class="col-lg-9 col-md-9">
                            <div class="outer row">
                              <div class="col-lg-4 col-md-4">
                                <input type="text" name="other7" id="insert_other7"
                                  value="@if(!empty($init_selected_kokyaku)){{substr($init_selected_kokyaku->yetoiawseend,0,1)}}@endif"
                                  class="form-control">
                              </div>
                              <div class="col-lg-8 col-md-8">
                                <div class="m_t" style="font-size: 12px;">1：翌営業日、2：前営業日</div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class=" row row_data">
                          <div class="col-lg-3 col-md-3">
                            <div class="margin_t ">
                              <span>入金振込手数料設定</span> <span style="color: red;">※</span></div>
                          </div>
                          <div class="col-lg-9 col-md-9">
                            <div class="outer row">
                              <div class="col-lg-4 col-md-4">
                                <input type="text" name="other8" id="insert_other8"
                                  value="@if(!empty($init_selected_kokyaku)){{substr($init_selected_kokyaku->yetoiawsesaiban,0,1)}}@endif"
                                  class="form-control">
                              </div>
                              <div class="col-lg-8 col-md-8">
                                <div class="m_t" style="font-size: 12px;">1：自社、2：先方</div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class=" row row_data">
                          <div class="col-lg-3 col-md-3">
                            <div class="margin_t ">
                              <span>与信限度額</span> <span style="color: red;">※</span> </div>
                          </div>
                          <div class="col-lg-9 col-md-9 ">
                            <div class="outer row">
                              <div class="col-lg-4 col-md-4">
                                <input type="text" name="otherfloat1" id="insert_otherfloat1"
                                  value="@if(!empty($init_selected_kokyaku)){{number_format($init_selected_kokyaku->denpyostart)}}@endif"
                                  class="form-control text-right">
                              </div>
                              <div class="col-lg-8 col-md-8">
                                <div class="m_t" style="font-size: 12px;">
                                  円
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row mt-2 mb-3">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                      <div class="tbl_product w-100">
                        <div class=" row row_data">
                          <div class="col-lg-3 col-md-3 col-sm-3">
                            <div class="margin_t ">
                              <span>請求先CD</span>
                            </div>
                          </div>
                          <div class="col-lg-9 col-md-9">
                            <div class="outer row">
                              <div class="col-lg-4 col-md-4">
                                <input type="text" name="other9" id="insert_other9" class="form-control">
                                <div class="" id="box_popup1" data-toggle="modal" data-target="" value="会社マスタ検索画面を表示"
                                  style="bottom: 0;float: left;margin-top: 3px;position: absolute;right: 21px;top: 0px;">
                                  <img src="img/open-book.svg" height="20" width="20" alt="" style="cursor: pointer;">
                                </div>
                              </div>
                              <div class="col-lg-8 col-md-8">
                                <div class="m_t"></div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class=" row row_data">
                          <div class="col-lg-3 col-md-3">
                            <div class="margin_t ">
                              <span>請求書送付日</span> <span style="color: red;">※</span>
                            </div>
                          </div>
                          <div class="col-lg-9 col-md-9 ">
                            <div class="outer row">
                              <div class="col-lg-4 col-md-4 ">
                                <input type="text" name="other10" id="insert_other10"
                                  value="@if(!empty($init_selected_kokyaku)){{$init_selected_kokyaku->mail_jyushin}}@endif"
                                  class="form-control">
                              </div>
                              <div class="col-lg-8 col-md-8">
                                <div class="m_t">
                                  0～-9
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class=" row row_data">
                          <div class="col-lg-3 col-md-3">
                            <div class="margin_t ">
                              <span>請求書メール区分</span> <span style="color: red;">※</span>
                            </div>
                          </div>
                          <div class="col-lg-9 col-md-9">
                            <div class="outer row">
                              <div class="col-lg-4 col-md-4">
                                <input type="text" name="other11" id="insert_other11"
                                  value="@if(!empty($init_selected_kokyaku)){{substr($init_selected_kokyaku->mail_nouhin,0,1)}}@endif"
                                  class="form-control">
                              </div>
                              <div class="col-lg-8 col-md-8">
                                <div class="m_t">
                                  １：PDFﾒｰﾙ送信、2：ﾒｰﾙ不要
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class=" row row_data">
                          <div class="col-lg-3 col-md-3">
                            <div class="margin_t ">
                              <span>請求書メール宛先</span>
                            </div>
                          </div>
                          <div class="col-lg-9 col-md-9">
                            <div class="outer row">
                              <div class="col-lg-4 col-md-4">
                                <input type="text" name="other12" id="insert_other12"
                                  value="@if(!empty($init_selected_kokyaku)){{$init_selected_kokyaku->mail_toiawase}}@endif"
                                  class="form-control">
                              </div>
                              <div class="col-lg-8 col-md-8 ">
                              <div class="m_t">
                                メールパスワードを登録してください
                              </div>
                            </div>
                            </div>
                          </div>
                        </div>
                        <div class=" row row_data">
                          <div class="col-lg-3 col-md-3 col-sm-3">
                            <div class="margin_t ">
                              <span>請求書UIS</span> <span style="color: red;">※</span>
                            </div>
                          </div>
                          <div class="col-lg-9 col-md-9">
                            <div class="outer row">
                              <div class="col-lg-4 col-md-4">
                                <input type="text" name="other13" id="insert_other13"
                                  value="@if(!empty($init_selected_kokyaku)){{substr($init_selected_kokyaku->mail_soushin_mb,0,1)}}@endif"
                                  class="form-control">
                              </div>
                              <div class="col-lg-8 col-md-8">
                                <div class="m_t">
                                  1：PDF‐UIS、２：UIS不要
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class=" row row_data">
                          <div class="col-lg-3 col-md-3">
                            <div class="margin_t ">
                              <span>請求書郵送</span> <span style="color: red;">※</span>
                            </div>
                          </div>
                          <div class="col-lg-9 col-md-9">
                            <div class="outer row">
                              <div class="col-lg-4 col-md-4">
                                <input type="text" name="other14" id="insert_other14" oninput="hideOrShow(this.value)"
                                  value="@if(!empty($init_selected_kokyaku)){{substr($init_selected_kokyaku->mail_jyushin_mb,0,1)}}@endif"
                                  class="form-control">
                              </div>
                              <div class="col-lg-8 col-md-8">
                                <div class="m_t">
                                  1：郵送　4：不要
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class=" row row_data">
                          <div class="col-lg-3 col-md-3">
                            <div class="margin_t ">
                              <span>請求書郵送先CD</span>
                            </div>
                          </div>
                          <div class="col-lg-9 col-md-9">
                            <div class="outer row">
                              <div class="col-lg-4 col-md-4">
                                <input type="text" name="other15" id="insert_other15" class="form-control" value="">
                                <div class="" id="box_popup2" data-toggle="modal" data-target="" value="会社マスタ検索画面を表示"
                                  style="bottom: 0;float: left;margin-top: 3px;position: absolute;right: 21px;top: 0px;">
                                  <img src="img/open-book.svg" height="20" width="20" alt="" style="cursor: pointer;">
                                </div>
                              </div>
                              <div class="col-lg-8 col-md-8">
                                <div class="m_t"></div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class=" row row_data">
                          <div class="col-lg-3 col-md-3">
                            <div class="margin_t ">
                              <span>請求課税区分</span> <span style="color: red;">※</span>
                            </div>
                          </div>
                          <div class="col-lg-9 col-md-9">
                            <div class="outer row">
                              <div class="col-lg-4 col-md-4 ">
                                <div class="custom-arrow">
                                  <select name="other16" id="insert_other16" class="form-control" style="width:100%;">
                                    @foreach($other16 as $othr16)
                                    <option value="{{$othr16->category1}}{{$othr16->category2}}"
                                      @if(!empty($init_selected_kokyaku)) @if($init_selected_kokyaku->mail_toiawase_mb
                                      ==
                                      $othr16->category1.$othr16->category2) selected @endif @endif >
                                      {{$othr16->category1}}{{$othr16->category2.' '}}{{$othr16->category4}}
                                    </option>
                                    @endforeach
                                  </select>
                                </div>
                              </div>
                              <div class="col-lg-8 col-md-8">
                                <div class="m_t"></div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class=" row row_data">
                          <div class="col-lg-3 col-md-3">
                            <div class="margin_t ">
                              <span>請求税端数区分</span><span style="color: red;">※</span>
                            </div>
                          </div>
                          <div class="col-lg-9 col-md-9">
                            <div class="outer row">
                              <div class="col-lg-4 col-md-4">
                                <div class="custom-arrow">
                                  <select name="other18" id="insert_other18" class="form-control" style="width:100%;">
                                    <!-- <option value="">-</option> -->
                                    @foreach($other18 as $othr18)
                                    <option value="{{$othr18->category1}}{{$othr18->category2}}"
                                      @if(!empty($init_selected_kokyaku)) @if($init_selected_kokyaku->mallsoukobango1 ==
                                      $othr18->category1.$othr18->category2) selected @endif @endif >
                                      {{$othr18->category1}}{{$othr18->category2.' '}}{{$othr18->category4}}
                                    </option>
                                    @endforeach
                                  </select>
                                </div>
                              </div>
                              <div class="col-lg-8 col-md-8 ">
                                <div class="m_t"></div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class=" row row_data">
                          <div class="col-lg-3 col-md-3">
                            <div class="margin_t ">
                              <span>請求消費税計算区分</span> <span style="color: red;">※</span>
                            </div>
                          </div>
                          <div class="col-lg-9 col-md-9">
                            <div class="outer row">
                              <div class="col-lg-4 col-md-4">
                                <input type="text" name="other17" id="insert_other17"
                                  value="@if(!empty($init_selected_kokyaku)){{substr($init_selected_kokyaku->datatxt0051,0,1)}}@endif"
                                  class="form-control">
                              </div>
                              <div class="col-lg-8 col-md-8">
                                <div class="m_t">
                                  1：伝票単位　2：明細単位　3:請求時一括
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class=" row row_data">
                          <div class="col-lg-3 col-md-3">
                            <div class="margin_t ">
                              <span>専伝区分</span><span style="color: red;">※</span>
                            </div>
                          </div>
                          <div class="col-lg-9 col-md-9">
                            <div class="outer row">
                              <div class="col-lg-4 col-md-4">
                                <input type="text" name="other39" id="insert_other39"
                                  value="@if(!empty($init_selected_kokyaku)){{substr($init_selected_kokyaku->mallsoukobango2,0,1)}}@endif"
                                  class="form-control">
                              </div>
                              <div class="col-lg-8 col-md-8">
                                <div class="m_t">
                                  1：有、2：無
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class=" row row_data">
                          <div class="col-lg-3 col-md-3">
                            <div class="margin_t ">
                              <span>指定納品書帳票CD</span>
                            </div>
                          </div>
                          <div class="col-lg-9 col-md-9">
                            <div class="outer row">
                              <div class="col-lg-4 col-md-4 ">
                                <input type="text" name="other40" id="insert_other40"
                                  value="@if(!empty($init_selected_kokyaku)){{$init_selected_kokyaku->mallsoukobango3}}@endif"
                                  class="form-control">
                              </div>
                              <div class="col-lg-8 col-md-8">
                                <div class="m_t"></div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="tab-pane fade h-100 p-3 border" id="payment1-office" role="tabpanel"
                aria-labelledby="payment1-office-tab">
                <div id="input_boxwrap_payment1" data-bind="nextFieldOnEnter:true">
                  <div class="row mt-1 mb-3">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                      <div class="tbl_company w-100">
                        <div class=" row row_data">
                          <div class="col-lg-3 col-md-3">
                            <div class="margin_t "><span>支払締め日</span> <span style="color: red;">※</span></div>
                          </div>
                          <div class="col-lg-9 col-md-9">
                            <div class="outer row">
                              <div class="col-lg-4 col-md-4">
                                <div class="custom-arrow">
                                  <select name="other19" id="insert_other19"
                                    class="form-control left_select hover_message_content" message="message 3"
                                    autofocus>
                                    @foreach($other19 as $othr19)
                                    <option value="{{$othr19->category1}}{{$othr19->category2}}"
                                      @if(!empty($init_selected_kokyaku)) @if($init_selected_kokyaku->haisoujouhou_tel
                                      ==
                                      $othr19->category1.$othr19->category2) selected @endif @endif >
                                      {{$othr19->category1}}{{$othr19->category2.' '}}{{$othr19->category4}}
                                    </option>
                                    @endforeach
                                  </select>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class=" row row_data">
                          <div class="col-lg-3 col-md-3">
                            <div class="margin_t "><span>支払月</span> <span style="color: red;">※</span></div>
                          </div>
                          <div class="col-lg-9 col-md-9">
                            <div class="outer row">
                              <div class="col-lg-2 col-md-2">
                                <input type="text" name="other20" id="insert_other20"
                                  value="@if(!empty($init_selected_kokyaku)){{substr($init_selected_kokyaku->mail,0,1)}}@endif"
                                  class="input_field form-control">
                              </div>
                              <div class="col-lg-10 col-md-10">
                                <div class="m_t" style="font-size: 12px;">0：当月、1：翌月、2：翌々月、3：3か月、4：4か月</div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class=" row row_data">
                          <div class="col-lg-3 col-md-3">
                            <div class="margin_t "><span>支払日</span> <span style="color: red;">※</span></div>
                          </div>
                          <div class="col-lg-9 col-md-9">
                            <div class="outer row">
                              <div class="col-lg-4 col-md-4">
                                <div class="custom-arrow">
                                  <select name="other21" id="insert_other21"
                                    class="form-control left_select hover_message_content" message="message 3">
                                    @foreach($other21 as $othr21)
                                    <option value="{{$othr21->category1}}{{$othr21->category2}}"
                                      @if(!empty($init_selected_kokyaku)) @if($init_selected_kokyaku->sex ==
                                      $othr21->category1.$othr21->category2) selected @endif @endif >
                                      {{$othr21->category1}}{{$othr21->category2.' '}}{{$othr21->category4}}
                                    </option>
                                    @endforeach
                                  </select>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class=" row row_data">
                          <div class="col-lg-3 col-md-3">
                            <div class="margin_t "><span>支払日休日設定</span> <span style="color: red;">※</span></div>
                          </div>
                          <div class="col-lg-9 col-md-9">
                            <div class="outer row">
                              <div class="col-lg-2 col-md-2">
                                <input type="text" name="other22" id="insert_other22"
                                  value="@if(!empty($init_selected_kokyaku)){{substr($init_selected_kokyaku->bunrui1,0,1)}}@endif"
                                  class="input_field form-control">
                              </div>
                              <div class="col-lg-10 col-md-10">
                                <div class="m_t" style="font-size: 12px;">1：翌営業日、2：前営業日</div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class=" row row_data">
                          <div class="col-lg-3 col-md-3">
                            <div class="margin_t "><span>支払振込手数料設定</span> <span style="color: red;">※</span></div>
                          </div>
                          <div class="col-lg-9 col-md-9">
                            <div class="outer row">
                              <div class="col-lg-2 col-md-2">
                                <input type="text" name="other23" id="insert_other23"
                                  value="@if(!empty($init_selected_kokyaku)){{substr($init_selected_kokyaku->bunrui2,0,1)}}@endif"
                                  class="input_field form-control">
                              </div>
                              <div class="col-lg-10 col-md-10">
                                <div class="m_t" style="font-size: 12px;">1：自社、2：先方</div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class=" row row_data">
                          <div class="col-lg-3 col-md-3">
                            <div class="margin_t "><span>支払方法</span> <span style="color: red;">※</span></div>
                          </div>
                          <div class="col-lg-9 col-md-9">
                            <div class="outer row">
                              <div class="col-lg-4 col-md-4">
                                <div class="custom-arrow">
                                  <select name="other24" id="insert_other24" class="form-control" style="width:100%;">
                                    @foreach($other24 as $othr24)
                                    <option value="{{$othr24->category1}}{{$othr24->category2}}"
                                      @if(!empty($init_selected_kokyaku)) @if($init_selected_kokyaku->bunrui3 ==
                                      $othr24->category1.$othr24->category2) selected @endif @endif >
                                      {{$othr24->category1}}{{$othr24->category2.' '}}{{$othr24->category4}}
                                    </option>
                                    @endforeach
                                  </select>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class=" row row_data">
                          <div class="col-lg-3 col-md-3">
                            <div class="margin_t "><span>支払手形サイト
                              </span></div>
                          </div>
                          <div class="col-lg-9 col-md-9">
                            <div class="outer row">
                              <div class="col-lg-4 col-md-4">
                                <input type="text" name="otherfloat2" id="insert_otherfloat2"
                                  value="@if(!empty($init_selected_kokyaku)){{$init_selected_kokyaku->syukei3}}@endif"
                                  class="form-control text-right">
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class=" row row_data">
                          <div class="col-lg-3 col-md-3 ">
                            <div class="margin_t "><span> 支払振込手数料区分
                              </span></div>
                          </div>
                          <div class="col-lg-9 col-md-9">
                            <div class="outer row">
                              <div class="col-lg-4 col-md-4">
                                <div class="custom-arrow">
                                  <select name="other30" id="insert_other30" class="form-control" style="width:100%;">
                                    <option value="">-</option>
                                    @foreach($other30 as $othr30)
                                    <option value="{{$othr30->category1}}{{$othr30->category2}}">
                                      {{$othr30->category1}}{{$othr30->category2.' '}}{{$othr30->category4}}
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
                  <div class="row mt-2 mb-3">
                    <div class="col-lg-12 col-md-12">
                      <div class="tbl_product w-100">
                        <div class=" row row_data">
                          <div class="col-lg-3 col-md-3">
                            <div class="margin_t ">
                              <span>振込銀行</span>
                            </div>
                          </div>
                          <div class="col-lg-9 col-md-9">
                            <div class="outer row">
                              <div class="col-lg-4 col-md-4">
                                <input name="other25" id="insert_other25" type="text" class="form-control">
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class=" row row_data">
                          <div class="col-lg-3 col-md-3">
                            <div class="margin_t ">
                              <span>振込支店</span>
                            </div>
                          </div>
                          <div class="col-lg-9 col-md-9">
                            <div class="outer row">
                              <div class="col-lg-4 col-md-4">
                                <input name="other26" id="insert_other26" type="text" class="form-control">
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class=" row row_data">
                          <div class="col-lg-3 col-md-3">
                            <div class="margin_t ">
                              <span>預金種別</span>
                            </div>
                          </div>
                          <div class="col-lg-3 col-md-3">
                            <div class="outer row">
                              <div class="col-lg-12 col-md-12">
                                <div class="custom-arrow">
                                  <select name="otherfloat4" id="insert_otherfloat4" class="form-control left_select ">
                                    <option value="">-</option>
                                    @foreach($otherfloat4 as $otherflt4)
                                    <option value="{{$otherflt4->syouhinbango}}">{{$otherflt4->syouhinbango}}</option>
                                    @endforeach
                                  </select>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class=" row row_data">
                          <div class="col-lg-3 col-md-3">
                            <div class="margin_t ">
                              <span>口座番号</span>
                            </div>
                          </div>
                          <div class="col-lg-9 col-md-9">
                            <div class="outer row">
                              <div class="col-lg-4 col-md-4">
                                <input name="other27" id="insert_other27" type="text" class="form-control">
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class=" row row_data">
                          <div class="col-lg-3 col-md-3">
                            <div class="margin_t ">
                              <span>口座名義人</span>
                            </div>
                          </div>
                          <div class="col-lg-9 col-md-9">
                            <div class="outer row">
                              <div class="col-lg-4 col-md-4">
                                <input name="other28" id="insert_other28" type="text" class="form-control">
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class=" row row_data">
                          <div class="col-lg-3 col-md-3">
                            <div class="margin_t ">
                              <span>仕向銀行</span>
                            </div>
                          </div>
                          <div class="col-lg-9 col-md-9">
                            <div class="outer row">
                              <div class="col-lg-4 col-md-4">
                                <div class="custom-arrow">
                                  <select name='other31' id="insert_other31" class="form-control"
                                    style="width: 100%!important;">
                                    <option>-</option>
                                    @foreach($other31 as $othr31)
                                    <option value="{{$othr31->category1}}{{$othr31->category2}}" @if(!empty($init_selected_kokyaku) && $init_selected_kokyaku->syukeiki == $othr31->category1.$othr31->category2) selected @endif>
                                      {{$othr31->category1}}{{$othr31->category2.' '}}{{$othr31->category4}}
                                    </option>
                                    @endforeach
                                  </select>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class=" row row_data">
                          <div class="col-lg-3 col-md-3">
                            <div class="margin_t ">
                              <span>仕向支店</span>
                            </div>
                          </div>
                          <div class="col-lg-9 col-md-9">
                            <div class="outer row">
                              <div class="col-lg-4 col-md-4">
                                <div class="custom-arrow">
                                  <select class="form-control" name="other32" id="insert_other32"
                                    style="width: 100%!important;">
                                    <option>-</option>
                                    @foreach($other32 as $othr32)
                                    <option value="{{$othr32->category1}}{{$othr32->category2}}" @if(!empty($init_selected_kokyaku) && $init_selected_kokyaku->datatxt0053 == $othr32->category1.$othr32->category2) selected @endif>
                                      {{$othr32->category1}}{{$othr32->category2.' '}}{{$othr32->category4}}
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
                  <div class="row mt-2 mb-3">
                    <div class="col-lg-12 col-md-12">
                      <div class="tbl_product w-100">
                        <div class=" row row_data">
                          <div class="col-lg-3 col-md-3">
                            <div class="margin_t ">
                              <span>支払課税区分</span> <span style="color: red;">※</span>
                            </div>
                          </div>
                          <div class="col-lg-9 col-md-9">
                            <div class="outer row">
                              <div class="col-lg-4 col-md-4 ">
                                <div class="custom-arrow">
                                  <select name="other33" id="insert_other33" class="form-control" style="width:100%;">
                                    @foreach($other33 as $othr33)
                                    <option value="{{$othr33->category1}}{{$othr33->category2}}"
                                      @if(!empty($init_selected_kokyaku)) @if($init_selected_kokyaku->bunrui4 ==
                                      $othr33->category1.$othr33->category2) selected @endif @endif >
                                      {{$othr33->category1}}{{$othr33->category2.' '}}{{$othr33->category4}}
                                    </option>
                                    @endforeach
                                  </select>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class=" row row_data">
                          <div class="col-lg-3 col-md-3">
                            <div class="margin_t ">
                              <span>支払消費税計算区分</span> <span style="color: red;">※</span>
                            </div>
                          </div>
                          <div class="col-lg-9 col-md-9">
                            <div class="outer row">
                              <div class="col-lg-2 col-md-2">
                                <input type="text" name="other34" id="insert_other34"
                                  value="@if(!empty($init_selected_kokyaku)){{substr($init_selected_kokyaku->datatxt0052,0,1)}}@endif"
                                  class="input_field form-control">
                              </div>
                              <div class="col-lg-10 col-md-10">
                                <div class="m_t" style="font-size: 12px;">1：伝票単位、2：明細単位</div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class=" row row_data">
                          <div class="col-lg-3 col-md-3">
                            <div class="margin_t ">
                              <span>支払税端数区分</span> <span style="color: red;">※</span>
                            </div>
                          </div>
                          <div class="col-lg-9 col-md-9">
                            <div class="outer row">
                              <div class="col-lg-4 col-md-4">
                                <div class="custom-arrow">
                                  <select name="other35" id="insert_other35" class="form-control" style="width:100%;">
                                    @foreach($other35 as $othr35)
                                    <option value="{{$othr35->category1}}{{$othr35->category2}}"
                                      @if(!empty($init_selected_kokyaku)) @if($init_selected_kokyaku->bunrui5 ==
                                      $othr35->category1.$othr35->category2) selected @endif @endif >
                                      {{$othr35->category1}}{{$othr35->category2.' '}}{{$othr35->category4}}
                                    </option>
                                    @endforeach
                                  </select>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class=" row row_data">
                          <div class="col-lg-3 col-md-3">
                            <div class="margin_t ">
                              <span>源泉税率</span>
                            </div>
                          </div>
                          <div class="col-lg-9 col-md-9">
                            <div class="outer row">
                              <div class="col-lg-2 col-md-2 ">
                                <input type="text" name="otherfloat3" id="insert_otherfloat3"
                                  value="@if(!empty($init_selected_kokyaku)){{$init_selected_kokyaku->syukei2}}@endif"
                                  class="input_field form-control text-right">
                              </div>
                              <div class="col-lg-10 col-md-10 ">
                                <div class="m_t" style="font-size: 12px;">%</div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class=" row row_data">
                          <div class="col-lg-3 col-md-3">
                            <div class="margin_t ">
                              <span>手形決済月</span>
                            </div>
                          </div>
                          <div class="col-lg-9 col-md-9">
                            <div class="outer row">
                              <div class="col-lg-2 col-md-2">
                                <input type="text" name="other37" id="insert_other37"
                                  value="@if(!empty($init_selected_kokyaku)){{substr($init_selected_kokyaku->bunrui9,0,1)}}@endif"
                                  class="input_field form-control">
                              </div>
                              <div class="col-lg-10 col-md-10">
                                <div class="m_t" style="font-size: 12px;">0：当月、1：翌月、2：翌々月、3：3か月、4：4か月</div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class=" row row_data">
                          <div class="col-lg-3 col-md-3">
                            <div class="margin_t ">
                              <span>手形決済日</span>
                            </div>
                          </div>
                          <div class="col-lg-9 col-md-9">
                            <div class="outer row">
                              <div class="col-lg-4 col-md-4">
                                <div class="custom-arrow">
                                  <select name="other38" id="insert_other38" class="form-control"
                                    style="width: 100%!important;">
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
        <script type="text/javascript">
          function hideOrShow(invoice_mail){
            //alert(invoice_mail);
          }
        </script>

      </div>
    </div>
  </div>
</form>
