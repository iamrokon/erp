<div class="modal custom-form" data-keyboard="false" data-backdrop="static" id="office_modal2" role="dialog"
  aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" style="max-width: 800px !important;" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h6 class="modal-title" id="exampleModalLabel"></h6>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="development_page_top_table heading_mt" style="margin:11px;margin-right: 0px;">
          <div class="row titlebr" style="margin-bottom: 15px;">

            {{-- Error Message Starts Here --}}
            <div class="col-12">
              <div id="detail_office_error_data" style="margin-left: -14px !important;"></div>
            </div>
            {{-- Error Message Ends Here --}}

            <div class="col-lg-6 col-md-6">
              <h5>事業所マスタ(詳細)</h5>
            </div>

            <div class="col-lg-6 col-md-6">
              <table class="dev_tble_button" style="float: right;">
                <tbody>
                  <tr class="marge_in">
                    <td class="" style="padding-right: 5px!important;">
                      @if($tantousya->innerlevel <= 10) <a class="btn btn-info scroll" id="deleteThis"
                        style="background-color: #3e6ec1!important;" data-toggle="modal" data-target="#"
                        onclick="deleteOfficeMaster('{{route('deleteOrReturnOffice',[$bango])}}')">
                        <i class="fa fa-trash" style="margin-right: 7px;"></i>削除
                        </a>
                        @endif
                    </td>
                    <td class="">
                      <a class="btn btn-info scroll" id="officeButton3" data-toggle="modal" data-target="#office_modal3"
                        style="">
                        <i class="fa fa-pencil-square-o" aria-hidden="true" style="margin-right: 5px;"></i>変更画面へ
                        </a>
                    </td>
                    @if($deleted_item )
                    <td class="">
                      <a class="btn btn-info scroll"
                        onclick="returnOfficeMaster('{{route('deleteOrReturnOffice',[$bango,1])}}')" id="btnRestore"
                        style="">データを戻す
                      </a>
                    </td>
                    @endif
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>

        <div class="container h-100 py-2">
          <ul class="nav nav-tabs " id="myTab" role="tablist">
            <li class="nav-item">
              <a class="nav-link active show" id="common2-tab" data-toggle="tab" href="#common2" role="tab"
                aria-controls="common2" aria-selected="true"><b>共通</b>
              </a>
            </li>
            <li class="nav-item" id="detail_nav_item_2">
              <a class="nav-link" id="sales_billing2_tab" data-toggle="tab" href="#sales_billing2" role="tab"
                aria-controls="sales_billing2" aria-selected="false"><b>売上・請求</b>
              </a>
            </li>
            <li class="nav-item" id="detail_nav_item_3">
              <a class="nav-link" id="payment2-tab" data-toggle="tab" href="#payment2" role="tab"
                aria-controls="payment2" aria-selected="false"><b>仕入・支払</b>
              </a>
            </li>
          </ul>

          <div class="tab-content">
            <div class="tab-pane h-100 p-3 border active show" id="common2" role="tabpanel"
              aria-labelledby="common2-tab">
              <div id="input_boxwrap_common2" class="input_boxwrap_common2" data-bind="nextFieldOnEnter:true">
                <div class="row mt-1 mb-3">
                  <div class="col-lg-12 col-md-12">
                    <div class="tbl_product w-100">
                      <div class=" row row_data">
                        <div class="col-lg-2 col-md-2">
                          <div class="margin_t ">
                            <span>会社CD</span> <span style="color:red;">※</span>
                          </div>
                        </div>
                        <div class="col-lg-9 col-md-9">
                          <div class="outer row">
                            <div class="col-lg-6 col-md-6 ">
                              <div class="m_t" id="detail_shikibetsucode">
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class=" row row_data">
                        <div class="col-lg-2 col-md-2">
                          <div class="margin_t ">
                            <span>事業所CD</span> <span style="color:red;">※</span>
                          </div>
                        </div>
                        <div class="col-lg-9 col-md-9">
                          <div class="outer row">
                            <div class="col-lg-6 col-md-6 ">
                              <div class="m_t" id="detail_torihikisakibango"></div>
                            </div>
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
                              <div class="m_t" id="detail_name">
                              </div>
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
                            <div class="col-lg-6 col-md-6 ">
                              <div class="m_t" id="detail_haisoumoji1">
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class=" row row_data">
                        <div class="col-lg-2 col-md-2">
                          <div class="margin_t ">
                            <span>入力区分</span> <span style="color:red;">※</span>
                          </div>
                        </div>
                        <div class="col-lg-9 col-md-9">
                          <div class="outer row">
                            <div class="col-lg-4 col-md-4 ">
                              <div class="m_t" id="detail_torihikisakirank1">
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
                            <div class="col-lg-4 col-md-4 ">
                              <div class="m_t" id="detail_syukeitukikijun">
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
                            <div class="col-lg-4 col-md-4 ">
                              <div class="m_t" id="detail_syukeituki">
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
                        <div class="col-lg-9 col-md-9">
                          <div class="outer row">
                            <div class="col-lg-4 col-md-4 ">
                              <div class="m_t" id="detail_syukeikikijun"></div>
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
                        <div class="col-lg-9 col-md-9">
                          <div class="outer row">
                            <div class="col-lg-4 col-md-4 ">
                              <div class="m_t" id="detail_syukeinenkijun">
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
                        <div class="col-lg-2 col-md-2">
                          <div class="margin_t ">
                            <span>郵便番号</span>@if(isset($init_selected_kokyaku->mail_jyushin_mb) && substr($init_selected_kokyaku->mail_jyushin_mb,0,1)=="1")<span style="color:red;">※</span>@endif
                          </div>
                        </div>
                        <div class="col-lg-9 col-md-9">
                          <div class="outer row">
                            <div class="col-lg-4 col-md-4 ">
                              <div class="m_t" id="detail_zip">
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class=" row row_data">
                        <div class="col-lg-2 col-md-2">
                          <div class="margin_t ">
                            <span>都道府県名</span>@if(isset($init_selected_kokyaku->mail_jyushin_mb) && substr($init_selected_kokyaku->mail_jyushin_mb,0,1)=="1")<span style="color:red;">※</span>@endif
                          </div>
                        </div>
                        <div class="col-lg-9 col-md-9">
                          <div class="outer row">
                            <div class="col-lg-4 col-md-4 ">
                              <div class="m_t" id="detail_address1"></div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class=" row row_data">
                        <div class="col-lg-2 col-md-2">
                          <div class="margin_t ">
                            <span>市区町村名</span>@if(isset($init_selected_kokyaku->mail_jyushin_mb) && substr($init_selected_kokyaku->mail_jyushin_mb,0,1)=="1")<span style="color:red;">※</span>@endif
                          </div>
                        </div>
                        <div class="col-lg-9 col-md-9">
                          <div class="outer row">
                            <div class="col-lg-8 col-md-8 ">
                              <div class="m_t" id="detail_address2"></div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class=" row row_data">
                        <div class="col-lg-2 col-md-2">
                          <div class="margin_t ">
                            <span>町域名</span>@if(isset($init_selected_kokyaku->mail_jyushin_mb) && substr($init_selected_kokyaku->mail_jyushin_mb,0,1)=="1")<span style="color:red;">※</span>@endif
                          </div>
                        </div>
                        <div class="col-lg-9 col-md-9">
                          <div class="outer row">
                            <div class="col-lg-8 col-md-8 ">
                              <div class="m_t" id="detail_address3"></div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class=" row row_data">
                        <div class="col-lg-2 col-md-2">
                          <div class="margin_t ">
                            <span>番地・建物名</span>@if(isset($init_selected_kokyaku->mail_jyushin_mb) && substr($init_selected_kokyaku->mail_jyushin_mb,0,1)=="1")<span style="color:red;"></span>@endif
                          </div>
                        </div>
                        <div class="col-lg-9 col-md-9">
                          <div class="outer row">
                            <div class="col-lg-8 col-md-8 ">
                              <div class="m_t" id="detail_address4"></div>
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
                        <div class="col-lg-2 col-md-2">
                          <div class="margin_t ">
                            <span>TEL</span>
                          </div>
                        </div>
                        <div class="col-lg-9 col-md-9">
                          <div class="outer row">
                            <div class="col-lg-4 col-md-4 ">
                              <div class="m_t" id="detail_tel"></div>
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
                            <div class="col-lg-4 col-md-4 ">
                              <div class="m_t" id="detail_torihikisakirank2"></div>
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
                            <div class="col-lg-4 col-md-4 ">
                              <div class="m_t" id="detail_yobi1"></div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class=" row row_data">
                        <div class="col-lg-2 col-md-2">
                          <div class="margin_t ">
                            <span>メールアドレス</span>
                          </div>
                        </div>
                        <div class="col-lg-9 col-md-9">
                          <div class="outer row">
                            <div class="col-lg-8 col-md-8 ">
                              <div class="m_t" id="detail_mail"></div>
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
                              <div class="m_t" id="detail_mail_confirm"></div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row mt-2 mb-3">
                  <div class="col-lg-10 col-md-10">
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
                              <div class="m_t" id="detail_haisoumoji2"></div>
                            </div>
                            <div class="col-lg-5 col-md-5 ">
                              <div class="m_t">1：有、2：無
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class=" row row_data">
                        <div class="col-lg-2 col-md-2 ">
                          <div class="margin_t ">
                            <span>仕入区分</span> <span style="color:red;">※</span>
                          </div>
                        </div>
                        <div class="col-lg-10 col-md-10">
                          <div class="outer row">
                            <div class="col-lg-3 col-md-3 ">
                              <div class="m_t" id="detail_syukeiki"></div>
                            </div>
                            <div class="col-lg-5 col-md-5 ">
                              <div class="m_t">1：有、2：無
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row mt-2 mb-3">
                  <div class="col-lg-12 col-md-12 ">
                    <div class="tbl_product w-100">
                      <div class=" row row_data mt-2">
                        <div class="col-lg-3 col-md-3 ">
                          <div class="margin_t ">
                            <span>事業所口座使用区分
                            </span>
                          </div>
                        </div>
                        <div class="col-lg-9 col-md-9 ">
                          <div class="outer row">
                            <div class="col-lg-3 col-md-3">
                              <div class="m_t" id="detail_other1"></div>
                            </div>
                            <div class="col-lg-4 col-md-4 ">
                              <div class="m_t" style="font-size: 12px;">1：会社Ｍ、2：事業所Ｍ
                              </div>
                            </div>
                            <div class="col-lg-5 col-md-5">
                              <div class="outer row">
                                <div class="col-lg-5 col-md-5 ">
                                  <div class="margin_t ">
                                    <span class="text-right">旧取引先CD</span>
                                  </div>
                                </div>
                                <div class="col-lg-7 col-md-7">
                                  <div class="m_t" id="detail_other36"> </div>
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

            <div class="tab-pane fade h-100 p-3 border" id="sales_billing2" role="tabpanel" aria-labelledby="sales_billing2_tab">
              <div id="input_boxwrap_sales_billing2" data-bind="nextFieldOnEnter:true">
                <div class="row mt-1 mb-3">
                  <div class="col-lg-12 col-md-12  ">
                    <div class="tbl_company w-100">
                      <div class=" row row_data">
                        <div class="col-lg-3 col-md-3 ">
                          <div class="margin_t ">
                            <span>即時区分</span><span style="color: red;">※</span>
                          </div>
                        </div>
                        <div class="col-lg-2 col-md-2">
                          <div>
                            <div class="m_t" id="detail_other2"></div>
                          </div>
                        </div>
                        <div class="col-lg-5 col-md-5 ">
                          <div class="m_t" style="font-size: 12px;">1：即時、2：締日
                          </div>
                        </div>
                      </div>
                      <div class=" row row_data">
                        <div class="col-lg-3 col-md-3 ">
                          <div class="margin_t ">
                            <span> 請求締め日</span> <span style="color: red;">※</span> </div>
                        </div>
                        <div class="col-lg-9 col-md-9">
                          <div class="outer row">
                            <div class="col-lg-6 col-md-6">
                              <div class="m_t" id="detail_other3"></div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class=" row row_data">
                        <div class="col-lg-3 col-md-3 col-sm-3">
                          <div class="margin_t ">
                            <span>入金方法</span> <span style="color: red;">※</span> </div>
                        </div>
                        <div class="col-lg-9 col-md-9 col-sm-9">
                          <div class="outer row">
                            <div class="col-lg-6 col-md-6 col-sm-6 ">
                              <div class="m_t" id="detail_other4"></div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class=" row row_data">
                        <div class="col-lg-3 col-md-3">
                          <div class="margin_t ">
                            <span>入金月</span> <span style="color: red;">※</span>
                          </div>
                        </div>
                        <div class="col-lg-9 col-md-9 ">
                          <div class="outer row">
                            <div class="col-lg-4 col-md-4">
                              <div class="m_t" id="detail_other5"></div>
                            </div>
                            <div class="col-lg-8 col-md-8">
                              <div class="m_t" style="font-size: 12px;">0：当月、1：翌月、2：翌々月、3：3か月、4：4か月
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class=" row row_data">
                        <div class="col-lg-3 col-md-3 ">
                          <div class="margin_t ">
                            <span>入金日</span> <span style="color: red;">※</span>
                          </div>
                        </div>
                        <div class="col-lg-9 col-md-9">
                          <div class="outer row">
                            <div class="col-lg-4 col-md-4">
                              <div class="m_t" id="detail_other6"></div>
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
                            <span>入金日休日設定</span> <span style="color: red;">※</span>
                          </div>
                        </div>
                        <div class="col-lg-9 col-md-9 ">
                          <div class="outer row">
                            <div class="col-lg-4 col-md-4 ">
                              <div class="m_t" id="detail_other7"></div>
                            </div>
                            <div class="col-lg-8 col-md-8">
                              <div class="m_t" style="font-size: 12px;">1：翌営業日、2：前営業日
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class=" row row_data">
                        <div class="col-lg-3 col-md-3 ">
                          <div class="margin_t ">
                            <span>入金振込手数料設定</span> <span style="color: red;">※</span>
                          </div>
                        </div>
                        <div class="col-lg-9 col-md-9 ">
                          <div class="outer row">
                            <div class="col-lg-4 col-md-4">
                              <div class="m_t" id="detail_other8"></div>
                            </div>
                            <div class="col-lg-8 col-md-8">
                              <div class="m_t" style="font-size: 12px;">1：自社、2：先方
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class=" row row_data">
                        <div class="col-lg-3 col-md-3">
                          <div class="margin_t ">
                            <span>与信限度額</span> <span style="color: red;">※</span>
                          </div>
                        </div>
                        <div class="col-lg-9 col-md-9">
                          <div class="outer row">
                            <div class="col-lg-4 col-md-4">
                              <div class="m_t text-right" id="detail_otherfloat1"></div>
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
                  <div class="col-lg-12 col-md-12">
                    <div class="tbl_product w-100">
                      <div class=" row row_data">
                        <div class="col-lg-3 col-md-3 ">
                          <div class="margin_t ">
                            <span>請求先CD</span>
                          </div>
                        </div>
                        <div class="col-lg-9 col-md-9 ">
                          <div class="outer row">
                            <div class="col-lg-4 col-md-4">
                              <div class="m_t" id="detail_other9"></div>
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
                        <div class="col-lg-9 col-md-9">
                          <div class="outer row">
                            <div class="col-lg-4 col-md-4  ">
                              <div class="m_t" id="detail_other10"></div>
                            </div>
                            <div class="col-lg-8 col-md-8 ">
                              <div class="m_t">
                                0～-9
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class=" row row_data">
                        <div class="col-lg-3 col-md-3 ">
                          <div class="margin_t ">
                            <span>請求書メール区分</span> <span style="color: red;">※</span>
                          </div>
                        </div>
                        <div class="col-lg-9 col-md-9 ">
                          <div class="outer row">
                            <div class="col-lg-4 col-md-4">
                              <div class="m_t" id="detail_other11"></div>
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
                        <div class="col-lg-9 col-md-9 ">
                          <div class="outer row">
                            <div class="col-lg-4 col-md-4 ">
                              <div class="m_t" id="detail_other12"></div>
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
                        <div class="col-lg-3 col-md-3">
                          <div class="margin_t ">
                            <span>請求書UIS</span> <span style="color: red;">※</span>
                          </div>
                        </div>
                        <div class="col-lg-9 col-md-9 ">
                          <div class="outer row">
                            <div class="col-lg-4 col-md-4  ">
                              <div class="m_t" id="detail_other13"></div>
                            </div>
                            <div class="col-lg-8 col-md-8 ">
                              <div class="m_t">
                                1：PDF‐UIS、２：UIS不要
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class=" row row_data">
                        <div class="col-lg-3 col-md-3 ">
                          <div class="margin_t ">
                            <span>請求書郵送</span> <span style="color: red;">※</span>
                          </div>
                        </div>
                        <div class="col-lg-9 col-md-9 ">
                          <div class="outer row">
                            <div class="col-lg-4 col-md-4 ">
                              <div class="m_t" id="detail_other14"></div>
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
                        <div class="col-lg-3 col-md-3 ">
                          <div class="margin_t ">
                            <span>請求書郵送先CD</span>
                          </div>
                        </div>
                        <div class="col-lg-9 col-md-9">
                          <div class="outer row">
                            <div class="col-lg-4 col-md-4 ">
                              <div class="m_t" id="detail_other15"></div>
                            </div>
                            <div class="col-lg-8 col-md-8 ">
                              <div class="m_t">
                              </div>
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
                        <div class="col-lg-9 col-md-9 ">
                          <div class="outer row">
                            <div class="col-lg-4 col-md-4 ">
                              <div class="m_t" id="detail_other16"></div>
                            </div>
                            <div class="col-lg-8 col-md-8">
                              <div class="m_t">
                              </div>
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
                        <div class="col-lg-9 col-md-9 ">
                          <div class="outer row">
                            <div class="col-lg-4 col-md-4 ">
                              <div class="m_t" id="detail_other18"></div>
                            </div>
                            <div class="col-lg-8 col-md-8">
                              <div class="m_t">
                              </div>
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
                            <div class="col-lg-4 col-md-4 ">
                              <div class="m_t" id="detail_other17"></div>
                            </div>
                            <div class="col-lg-8 col-md-8  ">
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
                              <div class="m_t" id="detail_other39"></div>
                            </div>
                            <div class="col-lg-8 col-md-8 ">
                              <div class="m_t">
                                1：有、2：無
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class=" row row_data">
                        <div class="col-lg-3 col-md-3 ">
                          <div class="margin_t ">
                            <span>指定納品書帳票CD</span>
                          </div>
                        </div>
                        <div class="col-lg-9 col-md-9">
                          <div class="outer row">
                            <div class="col-lg-4 col-md-4">
                              <div class="m_t" id="detail_other40"></div>
                            </div>
                            <div class="col-lg-8 col-md-8 ">
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

            <div class="tab-pane fade h-100 p-3 border" id="payment2" role="tabpanel" aria-labelledby="payment2-tab">
              <div id="input_boxwrap_payment2" data-bind="nextFieldOnEnter:true">
                <div class="row mt-1 mb-3">
                  <div class="col-lg-12 col-md-12">
                    <div class="tbl_company w-100">
                      <div class=" row row_data">
                        <div class="col-lg-3 col-md-3">
                          <div class="margin_t "><span>支払締め日</span> <span style="color: red;">※</span></div>
                        </div>
                        <div class="col-lg-9 col-md-9">
                          <div class="outer row">
                            <div class="col-lg-4 col-md-4">
                              <div class="m_t" id="detail_other19"></div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class=" row row_data">
                        <div class="col-lg-3 col-md-3">
                          <div class="margin_t "><span>支払月</span> <span style="color: red;">※</span> </div>
                        </div>
                        <div class="col-lg-9 col-md-9">
                          <div class="outer row">
                            <div class="col-lg-2 col-md-2">
                              <div class="m_t" id="detail_other20"></div>
                            </div>
                            <div class="col-lg-10 col-md-10">
                              <div class="m_t" style="font-size: 12px;">0：当月、1：翌月、2：翌々月、3：3か月、4：4か月
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class=" row row_data">
                        <div class="col-lg-3 col-md-3">
                          <div class="margin_t "><span>支払日</span> <span style="color: red;">※</span> </div>
                        </div>
                        <div class="col-lg-9 col-md-9">
                          <div class="outer row">
                            <div class="col-lg-4 col-md-4">
                              <div class="m_t" id="detail_other21"></div>
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
                              <div class="m_t" id="detail_other22"></div>
                            </div>
                            <div class="col-lg-10 col-md-10">
                              <div class="m_t" style="font-size: 12px;">1：翌営業日、2：前営業日</div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class=" row row_data">
                        <div class="col-lg-3 col-md-3 ">
                          <div class="margin_t "><span>支払振込手数料設定</span> <span style="color: red;">※</span></div>
                        </div>
                        <div class="col-lg-9 col-md-9">
                          <div class="outer row">
                            <div class="col-lg-2 col-md-2 ">
                              <div class="m_t" id="detail_other23"></div>
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
                            <div class="col-lg-4 col-md-4 ">
                              <div class="m_t" id="detail_other24"></div>
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
                              <div class="m_t text-right" id="detail_otherfloat2"></div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class=" row row_data">
                        <div class="col-lg-3 col-md-3">
                          <div class="margin_t "><span> 支払振込手数料区分
                            </span></div>
                        </div>
                        <div class="col-lg-9 col-md-9">
                          <div class="outer row">
                            <div class="col-lg-4 col-md-4">
                              <div class="m_t" id="detail_other30"></div>
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
                              <div class="m_t" id="detail_other25"></div>
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
                              <div class="m_t" id="detail_other26"></div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class=" row row_data">
                        <div class="col-lg-3 col-md-3 ">
                          <div class="margin_t ">
                            <span>預金種別</span>
                          </div>
                        </div>
                        <div class="col-lg-9 col-md-9 ">
                          <div class="outer row">
                            <div class="col-lg-4 col-md-4 ">
                              <div class="m_t" id="detail_otherfloat4"></div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class=" row row_data">
                        <div class="col-lg-3 col-md-3 ">
                          <div class="margin_t ">
                            <span>口座番号</span>
                          </div>
                        </div>
                        <div class="col-lg-9 col-md-9 ">
                          <div class="outer row">
                            <div class="col-lg-4 col-md-4 ">
                              <div class="m_t" id="detail_other27"></div>
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
                              <div class="m_t" id="detail_other28"></div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class=" row row_data">
                        <div class="col-lg-3 col-md-3 ">
                          <div class="margin_t ">
                            <span>仕向銀行</span>
                          </div>
                        </div>
                        <div class="col-lg-9 col-md-9 ">
                          <div class="outer row">
                            <div class="col-lg-4 col-md-4 ">
                              <div class="m_t" id="detail_other31"></div>
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
                              <div class="m_t" id="detail_other32"></div>
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
                            <div class="col-lg-4 col-md-4">
                              <div class="m_t" id="detail_other33"></div>
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
                            <div class="col-lg-2 col-md-2 ">
                              <div class="m_t" id="detail_other34"></div>
                            </div>
                            <div class="col-lg-10 col-md-10 ">
                              <div class="m_t" style="font-size: 12px;">1：伝票単位、2：明細単位</div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class=" row row_data">
                        <div class="col-lg-3 col-md-3 ">
                          <div class="margin_t ">
                            <span>支払税端数区分</span> <span style="color: red;">※</span>
                          </div>
                        </div>
                        <div class="col-lg-9 col-md-9 ">
                          <div class="outer row">
                            <div class="col-lg-4 col-md-4">
                              <div class="m_t" id="detail_other35"></div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class=" row row_data">
                        <div class="col-lg-3 col-md-3">
                          <div class="margin_t ">
                            <span>源泉税率
                            </span>
                          </div>
                        </div>
                        <div class="col-lg-9 col-md-9">
                          <div class="outer row">
                            <div class="col-lg-2 col-md-2">
                              <div class="m_t text-right" id="detail_otherfloat3"></div>
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
                              <div class="m_t" id="detail_other37"></div>
                            </div>
                            <div class="col-lg-10 col-md-10">
                              <div class="m_t" style="font-size: 12px;">0：当月　1：翌月　2：翌々月　3：3か月　4：4か月</div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class=" row row_data">
                        <div class="col-lg-3 col-md-3 ">
                          <div class="margin_t ">
                            <span>手形決済日</span>
                          </div>
                        </div>
                        <div class="col-lg-9 col-md-9 ">
                          <div class="outer row">
                            <div class="col-lg-2 col-md-2 ">
                              <div class="m_t" id="detail_other38"></div>
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
