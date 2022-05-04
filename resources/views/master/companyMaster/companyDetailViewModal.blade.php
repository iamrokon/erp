<div class="modal custom-form" data-keyboard="false" data-backdrop="static" id="company_code_modal2" role="dialog"
  aria-labelledby="exampleModalLabel" style="display: none;" aria-hidden="true">
  <div class="modal-dialog" style="max-width: 1050px;z-index: 1052;" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"></h5>
        <div class="detail_hover_message" style="height:15px; color:red;padding-left: 15px;"></div>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body" data-bind="nextFieldOnEnter:true">
        <div class="development_page_top_table heading_mt" style="margin: 0 2px 0px 15px;">
          <div class="row titlebr" style="margin-bottom: 15px;">

            {{-- Error Message Starts Here --}}
            <div class="col-12 pl-1">
              <div id="com_detail_error_data"></div>
            </div>
            {{-- Error Message Ends Here --}}

            <div class="col-lg-6">
              <h5>会社マスタ（詳細）</h5>
            </div>
            <div class="col-lg-6">
              <table class="dev_tble_button" style="float: right;margin-right: 14px;">
                <tbody>
                  <tr class="marge_in">
                    <td class="" style="padding-right: 10px!important;">
                      @if($tantousya->innerlevel <= 10) 
                        <button message="@if(array_key_exists('delete', $buttonMessage)){{$buttonMessage['delete']}}@endif"
                          id="deleteThis" class="btn btn-info scroll delete_message_content" autofocus
                          style="background-color: #3e6ec1!important;" data-toggle="modal" data-target="#"
                          onclick="deleteCompanyMaster('{{route('deleteOrReturnCompany',[$bango])}}')">
                          <i class="fa fa-trash" style="margin-right: 7px;"></i>削除
                        </button>
                      @endif
                    </td>
                    <td class="" style="padding-left: 0px!important;width: 70px!important; ">
                      <button message="@if(array_key_exists('edit_open', $buttonMessage)){{$buttonMessage['edit_open']}}@endif"
                        class="btn btn-info scroll edit_open_message_content" id="comp_button3"
                        style="background-color: #3e6ec1!important;" data-toggle="modal" data-target="#comp_modal3"> 
                        <i class="fa fa-pencil-square-o" aria-hidden="true" style="margin-right: 5px;"></i>変更画面へ
                      </button>
                    </td>
                    @if($deleted_item )
                    <td class="">
                      <a message="@if(array_key_exists('return', $buttonMessage)){{$buttonMessage['return']}}@endif" 
                        class="btn btn-info scroll return_message_content" 
                        onclick="returnCompanyMaster('{{route('deleteOrReturnCompany',[$bango  ,1])}}')" id="btnRestore" style="">
                        データを戻す
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
              <a class="nav-link  active show" id="common2-tab" data-toggle="tab" href="#common2" role="tab"
                aria-controls="common2" aria-selected="true"><b>共通</b>
              </a>
            </li>
            <li class="nav-item" id="detail_nav_item_2">
              <a class="nav-link " id="sales_billing2_tab" data-toggle="tab" href="#sales_billing2" role="tab"
                aria-controls="sales_billing2" aria-selected="false"><b>売上・請求</b>
              </a>
            </li>
            <li class="nav-item" id="detail_nav_item_3">
              <a class="nav-link " id="payment2-tab" data-toggle="tab" href="#payment2" role="tab"
                aria-controls="payment2" aria-selected="false"><b>仕入・支払</b>
              </a>
            </li>
          </ul>

          <div class="tab-content">
            <div class="tab-pane h-200 p-3 border active show" id="common2" role="tabpanel" aria-labelledby="common2-tab">
              <div class="row mt-1 mb-3">
                <div class="col-lg-12 col-md-12">
                  <div class="tbl_product w-100">
                    <div class=" row row_data">
                      <div class="col-lg-2 col-md-4">
                        <div class="margin_t ">
                          <span>会社CD <span style="color: red;">※</span></span>
                        </div>
                      </div>
                      <div class="col-lg-8 col-md-8">
                        <div class="outer row">
                          <div class="col-lg-4 col-md-3">
                            <div class="m_t" id="comp_detail_bango"></div>
                          </div>
                          <div class="col-lg-3 col-md-4 ">
                            <div class="m_t">法人マイナンバー</div>
                          </div>
                          <div class="col-lg-3 col-md-4 ">
                            <div class="m_t" id="detail_kounyusu"></div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class=" row row_data">
                      <div class="col-lg-2 col-md-4">
                        <div class="margin_t ">
                          <span>会社名</span> <span style="color: red;">※</span>
                        </div>
                      </div>
                      <div class="col-lg-10 col-md-8">
                        <div class="outer row">
                          <div class="col-lg-12 col-md-12">
                            <div class="m_t" id="detail_name"></div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class=" row row_data">
                      <div class="col-lg-2 col-md-4">
                        <div class="margin_t ">
                          <span>会社名略称</span> <span style="color: red;">※</span>
                        </div>
                      </div>
                      <div class="col-lg-10 col-md-8">
                        <div class="outer row">
                          <div class="col-lg-12 col-md-12 ">
                            <div class="m_t" id="detail_address"></div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class=" row row_data">
                      <div class="col-lg-2 col-md-4">
                        <div class="margin_t ">
                          <span>会社名カナ</span>
                        </div>
                      </div>
                      <div class="col-lg-10 col-md-8">
                        <div class="outer row">
                          <div class="col-lg-12 col-md-12">
                            <div class="m_t" id="detail_furigana"></div>
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
                      <div class="col-lg-10 col-md-8">
                        <div class="outer row">
                          <div class="col-lg-12 col-md-12 ">
                            <div class="m_t" id="detail_datatxt0050"></div>
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
                    <div class=" row row_data">
                      <div class="col-lg-3 col-md-4">
                        <div class="margin_t ">
                          <span>入力区分</span><span style="color: red;">※</span>
                        </div>
                      </div>
                      <div class="col-lg-9 col-md-8">
                        <div class="outer row">
                          <div class="col-lg-12 col-md-12 ">
                            <div class="m_t" id="detail_yubinbango"></div>
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
                          <span>会計取引先CD</span>
                        </div>
                      </div>
                      <div class="col-lg-8 col-md-6">
                        <div class="outer row">
                          <div class="col-lg-12 col-md-12 ">
                            <div class="m_t" id="detail_syukeitukikijun"></div>
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
                            <div class="m_t" id="detail_syukeinen"></div>
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
                    <div class=" row row_data">
                      <div class="col-lg-4 col-md-4">
                        <div class="margin_t ">
                          <span>帝国ﾃﾞｰﾀﾊﾞﾝｸ信用録PDF</span>
                        </div>
                      </div>
                      <div class="col-lg-8 col-md-8">
                        <div class="outer row">
                          <div class="col-lg-12 col-md-12 ">
                            <input id="detail_base_url" type="hidden" value="{{url('/uploads/company_master')}}" />
                            <a target="_blank" id="detail_yobi13_show_url">
                              <div style="float: left;width: 65%;" class="m_t" id="detail_yobi13"></div>
                            </a>
                            <div style="float: left;width: 30%;margin-left: 2%;margin-top: 3px;"></div>
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
                            <div class="m_t" id="detail_bunrui6"></div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class=" row row_data">
                      <div class="col-lg-4 col-md-4">
                        <div class="margin_t ">
                          <span>帝国ﾃﾞｰﾀﾊﾞﾝｸ取得年月日</span>
                        </div>
                      </div>
                      <div class="col-lg-8 col-md-8">
                        <div class="outer row">
                          <div class="col-lg-12 col-md-12 ">
                            <div class="m_t" id="detail_tel"></div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class=" row row_data">
                      <div class="col-lg-4 col-md-4">
                        <div class="margin_t ">
                          <span>帝国ﾃﾞｰﾀﾊﾞﾝｸ企業CD</span>
                        </div>
                      </div>
                      <div class="col-lg-8 col-md-8">
                        <div class="outer row">
                          <div class="col-lg-12 col-md-12 ">
                            <div class="m_t" id="detail_fax"></div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class=" row row_data">
                      <div class="col-lg-4 col-md-4">
                        <div class="margin_t ">
                          <span>帝国ﾃﾞｰﾀﾊﾞﾝｸ評点</span>
                        </div>
                      </div>
                      <div class="col-lg-8 col-md-8">
                        <div class="outer row">
                          <div class="col-lg-12 col-md-12 ">
                            <div class="m_t" id="detail_torihikisakibango"></div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class=" row row_data">
                      <div class="col-lg-4 col-md-4">
                        <div class="margin_t ">
                          <span>経済産業省業種区分1</span>
                        </div>
                      </div>
                      <div class="col-lg-8 col-md-8">
                        <div class="outer row">
                          <div class="col-lg-12 col-md-12">
                            <div class="m_t" id="detail_tantousya"></div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class=" row row_data">
                      <div class="col-lg-4 col-md-4">
                        <div class="margin_t ">
                          <span>経済産業省業種区分2</span>
                        </div>
                      </div>
                      <div class="col-lg-8 col-md-8">
                        <div class="outer row">
                          <div class="col-lg-12 col-md-12">
                            <div class="m_t" id="detail_kcode1"></div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-5 col-md-12">
                  <div class="tbl_product w-100">
                    <div class=" row row_data">
                      <div class="col-lg-3 col-md-4">
                        <div class="margin_t ">
                          <span>基本業種</span>
                        </div>
                      </div>
                      <div class="col-lg-9 col-md-8">
                        <div class="outer row">
                          <div class="col-lg-12 col-md-12 ">
                            <div class="m_t" id="detail_kcode2" style="white-space: normal;word-break: break-all;">
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class=" row row_data">
                      <div class="col-lg-3 col-md-4">
                        <div class="margin_t ">
                          <span>年商</span>
                        </div>
                      </div>
                      <div class="col-lg-9 col-md-8">
                        <div class="outer row">
                          <div class="col-lg-12 col-md-12">
                            <div class="m_t" id="detail_stoiawsestart"></div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class=" row row_data">
                      <div class="col-lg-3 col-md-4">
                        <div class="margin_t ">
                          <span>従業員</span>
                        </div>
                      </div>
                      <div class="col-lg-9 col-md-8">
                        <div class="outer row">
                          <div class="col-lg-12 col-md-12 ">
                            <div class="m_t" id="detail_stoiawseend"></div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class=" row row_data">
                      <div class="col-lg-3 col-md-4">
                        <div class="margin_t ">
                          <span>資本金</span>
                        </div>
                      </div>
                      <div class="col-lg-9 col-md-8">
                        <div class="outer row">
                          <div class="col-lg-12 col-md-12 ">
                            <div class="m_t" id="detail_stoiawsesaiban"></div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class=" row row_data">
                      <div class="col-lg-3 col-md-4">
                        <div class="margin_t ">
                          <span>会社分類5</span>
                        </div>
                      </div>
                      <div class="col-lg-9 col-md-8">
                        <div class="outer row">
                          <div class="col-lg-12 col-md-12 ">
                            <div class="m_t"> 未使用</div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row mt-1 mb-3">
                <div class="col-lg-6 col-md-12">
                  <div class="tbl_product w-100">
                    <div class=" row row_data">
                      <div class="col-lg-3 col-md-4">
                        <div class="margin_t ">
                          <span>備考</span>
                        </div>
                      </div>
                      <div class="col-lg-9 col-md-8">
                        <div class="outer row">
                          <div class="col-lg-12 col-md-12">
                            <div class="m_t" id="detail_kensakukey" style="white-space: normal;word-break: break-all;">
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-6 col-md-12">
                  <div class="tbl_product w-100">
                    <div class=" row row_data">
                      <div class="col-lg-3 col-md-4">
                        <div class="margin_t ">
                          <span>売上区分</span> <span style="color: red;">※</span>
                        </div>
                      </div>
                      <div class="col-lg-9 col-md-8">
                        <div class="outer row">
                          <div class="col-lg-2 col-md-2 ">
                            <div class="m_t" id="detail_syukeituki"></div>
                          </div>
                          <div class="col-lg-6 col-md-6">
                            <div class="m_t" style="font-size: 12px;">1：有、2：無</div>
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
                          <div class="col-lg-2 col-md-2">
                            <div class="m_t" id="detail_syukeikikijun"></div>
                          </div>
                          <div class="col-lg-6 col-md-6">
                            <div class="m_t" style="font-size: 12px;">1：有、2：無</div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="tab-pane fade h-100 p-3 border" id="sales_billing2" role="tabpanel" aria-labelledby="sales_billing2_tab">
              <div class="row mt-1 mb-3">
                <div class="col-lg-6 col-md-12">
                  <div class="tbl_company w-100">
                    <div class=" row row_data">
                      <div class="col-lg-4 col-md-3">
                        <div class="margin_t ">
                          <span>即時区分</span><span style="color: red;">※</span>
                        </div>
                      </div>
                      <div class="col-lg-4 col-md-3">
                        <div>
                          <div class="m_t" id="detail_kcode3"></div>
                        </div>
                      </div>
                      <div class="col-lg-2 col-md-2 d-none">
                        <div class="m_t"></div>
                      </div>
                      <div class="col-lg-4 col-md-3">
                        <div class="m_t" style="font-size: 12px;">1：即時、2：締日</div>
                      </div>
                    </div>
                    <div class=" row row_data">
                      <div class="col-lg-4 col-md-3">
                        <div class="margin_t ">
                          <span>請求締め日</span><span style="color: red;">※</span></div>
                      </div>
                      <div class="col-lg-4 col-md-3">
                        <div class="m_t" id="detail_ytoiawsestart"></div>
                      </div>
                    </div>
                    <div class=" row row_data">
                      <div class="col-lg-4 col-md-3">
                        <div class="margin_t ">
                          <span>入金方法</span><span style="color: red;">※</span></div>
                      </div>
                      <div class="col-lg-4 col-md-3">
                        <div class="m_t" id="detail_ytoiawseend"></div>
                      </div>
                    </div>
                    <div class=" row row_data">
                      <div class="col-lg-4 col-md-3">
                        <div class="margin_t">
                        <span>入金月</span><span style="color: red;">※</span>
                        </div>
                      </div>
                      <div class="col-lg-4 col-md-3">
                        <div class="m_t" id="detail_ytoiawsesaiban"></div>
                      </div>
                      <div class="col-lg-4 col-md-5">
                        <div class="m_t" style="font-size: 12px;">0：当月、1：翌月、</div>
                        <div class="m_t" style="font-size: 12px;">2：翌々月、3：3か月、4：4か月</div>
                      </div>
                    </div>
                    <div class=" row row_data">
                      <div class="col-lg-4 col-md-3">
                        <div class="margin_t">
                          <span>入金日</span><span style="color: red;">※</span>
                        </div>
                      </div>
                      <div class="col-lg-4 col-md-3">
                        <div class="m_t" id="detail_yetoiawsestart">
                        </div>
                      </div>
                      <div class="col-lg-4 col-md-5">
                        <div class="m_t"></div>
                      </div>
                    </div>
                    <div class=" row row_data">
                      <div class="col-lg-4 col-md-3">
                        <div class="margin_t ">
                          <span>入金日休日設定</span><span style="color: red;">※</span>
                        </div>
                      </div>
                      <div class="col-lg-4 col-md-3">
                        <div class="m_t" id="detail_yetoiawseend">1 翌営業日</div>
                      </div>
                      <div class="col-lg-4 col-md-5">
                        <div class="m_t" style="font-size: 12px;">1：翌営業日、2：前営業日</div>
                      </div>
                    </div>
                    <div class=" row row_data">
                      <div class="col-lg-4 col-md-3">
                        <div class="margin_t ">
                          <span>入金振込手数料設定</span><span style="color: red;">※</span>
                        </div>
                      </div>
                      <div class="col-lg-4 col-md-3">
                        <div class="m_t" id="detail_yetoiawsesaiban">1 自社</div>
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
                      <div class="col-lg-4 col-md-3">
                        <div class="margin_t ">
                          <span>保守更新案内有無</span>
                        </div>
                      </div>
                      <div class="col-lg-8 col-md-8">
                        <div class="m_t" id="detail_netusername"></div>
                      </div>
                    </div>
                    <div class=" row row_data">
                      <div class="col-lg-4 col-md-3">
                        <div class="margin_t ">
                          <span>ライセンス証書有無</span>
                        </div>
                      </div>
                      <div class="col-lg-8 col-md-8">
                        <div class="m_t" id="detail_netuserpasswd">1 有</div>
                      </div>
                    </div>
                    <div class=" row row_data">
                      <div class="col-lg-4 col-md-3">
                        <div class="margin_t ">
                          <span>検収条件</span>
                        </div>
                      </div>
                      <div class="col-lg-7 col-md-3">
                        <div class="m_t" id="detail_netlogin">
                        </div>
                      </div>
                    </div>
                    <div class=" row row_data">
                      <div class="col-lg-5 col-md-3 ">
                        <div class="margin_t ">
                          <span>与信限度額</span> <span style="color: red;">※</span></div>
                      </div>
                      <div class="col-lg-4 col-md-3">
                        <div class="m_t" id="detail_denpyostart">
                        </div>
                      </div>
                      <div class="col-lg-3 col-md-3">
                        <div class="m_t">円
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="row mt-1 mb-3">
                <div class="col-lg-12 col-md-12">
                  <div class="tbl_company w-100">
                    <div class=" row row_data">
                      <div class="col-lg-2 col-md-3">
                        <div class="margin_t ">
                          <span>請求先CD</span>
                        </div>
                      </div>
                      <div class="col-lg-9 col-md-9">
                        <div class="outer row">
                          <div class="col-lg-6 col-md-6 ">
                            <div class="m_t" id="detail_mail_soushin"></div>
                          </div>
                          <div id="detail_mail_soushin_extra" class="col-lg-6 col-md-6 m_t"></div>
                        </div>
                      </div>
                    </div>
                    <div class=" row row_data">
                      <div class="col-lg-2 col-md-3">
                        <div class="margin_t "><span>請求書送付日</span> <span style="color: red;">※</span></div>
                      </div>
                      <div class="col-lg-9 col-md-9">
                        <div class="outer row">
                          <div class="col-lg-6 col-md-6 ">
                            <div class="m_t" id="detail_mail_jyushin"></div>
                          </div>
                          <div class="col-lg-6 col-md-6  ">
                            <div class="m_t"></div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class=" row row_data">
                      <div class="col-lg-2 col-md-3">
                        <div class="margin_t ">
                          <span>請求書メール区分</span>
                          <span style="color: red;">※</span>
                        </div>
                      </div>
                      <div class="col-lg-9 col-md-9">
                        <div class="outer row">
                          <div class="col-lg-6 col-md-6">
                            <div class="m_t" id="detail_mail_nouhin"></div>
                          </div>
                          <div class="col-lg-6 col-md-6 ">
                            <div class="m_t" style="font-size: 12px;">1：PDFﾒｰﾙ送信、2：ﾒｰﾙ不要</div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class=" row row_data">
                      <div class="col-lg-2 col-md-3">
                        <div class="margin_t "><span>請求書メール宛先</span> </div>
                      </div>
                      <div class="col-lg-9 col-md-9">
                        <div class="outer row">
                          <div class="col-lg-6 col-md-6 ">
                            <div class="m_t" id="detail_mail_toiawase"></div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class=" row row_data">
                      <div class="col-lg-2 col-md-3">
                        <div class="margin_t ">
                          <span>請求書UIS</span>
                          <span style="color: red;">※</span>
                        </div>
                      </div>
                      <div class="col-lg-9 col-md-9">
                        <div class="outer row">
                          <div class="col-lg-6 col-md-6 ">
                            <div class="m_t" id="detail_mail_soushin_mb"></div>
                          </div>
                          <div class="col-lg-6 col-md-6 ">
                            <div class="m_t" style="font-size: 12px;">1：PDF-UIS、2：UIS不要</div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class=" row row_data">
                      <div class="col-lg-2 col-md-3">
                        <div class="margin_t "><span>請求書郵送</span> <span style="color: red;">※</span></div>
                      </div>
                      <div class="col-lg-9 col-md-9">
                        <div class="outer row">
                          <div class="col-lg-6 col-md-6">
                            <div class="m_t" id="detail_mail_jyushin_mb"></div>
                          </div>
                          <div class="col-lg-6 col-md-6">
                            <div class="m_t" style="font-size: 12px;">1：郵送、4：不要</div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class=" row row_data">
                      <div class="col-lg-2 col-md-3">
                        <div class="margin_t "><span>請求書郵送先CD</span></div>
                      </div>
                      <div class="col-lg-9 col-md-9">
                        <div class="outer row">
                          <div class="col-lg-6 col-md-6">
                            <div class="m_t" id="detail_mail_nouhin_mb"></div>
                          </div>
                          <div id="detail_mail_nouhin_mb_extra" class="col-lg-6 col-md-6 m_t"></div>
                        </div>
                      </div>
                    </div>
                    <div class=" row row_data">
                      <div class="col-lg-2 col-md-3">
                        <div class="margin_t "><span>請求課税区分</span><span style="color: red;">※</span></div>
                      </div>
                      <div class="col-lg-9 col-md-9">
                        <div class="outer row">
                          <div class="col-lg-6 col-md-6 ">
                            <div class="m_t" id="detail_mail_toiawase_mb"></div>
                          </div>
                          <div class="col-lg-6 col-md-6 "></div>
                        </div>
                      </div>
                    </div>
                    <div class=" row row_data">
                      <div class="col-lg-2 col-md-3">
                        <div class="margin_t "><span>請求税端数区分</span><span style="color: red;">※</span></div>
                      </div>
                      <div class="col-lg-9 col-md-9">
                        <div class="outer row">
                          <div class="col-lg-6 col-md-6">
                            <div class="m_t" id="detail_mallsoukobango1">
                              1 四捨五入
                            </div>
                          </div>
                          <div class="col-lg-6 col-md-6 "></div>
                        </div>
                      </div>
                    </div>
                    <div class=" row row_data">
                      <div class="col-lg-2 col-md-3">
                        <div class="margin_t ">
                          <span>請求消費税計算区分</span> <span style="color: red;">※</span></div>
                      </div>
                      <div class="col-lg-9 col-md-9">
                        <div class="outer row">
                          <div class="col-lg-6 col-md-6 ">
                            <div class="m_t" id="detail_datatxt0051"></div>
                          </div>
                          <div class="col-lg-6 col-md-6 ">
                            <div class="m_t" style="font-size: 12px;">&nbsp;1：伝票単位　2：明細単位　3:請求時一括</div>
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
                    <div class=" row row_data">
                      <div class="col-lg-4 col-md-3">
                        <div class="margin_t "><span>専伝区分</span> <span style="color: red;">※</span></div>
                      </div>
                      <div class="col-lg-8 col-md-8">
                        <div class="outer row">
                          <div class="col-lg-7 col-md-7 ">
                            <div class="m_t" id="detail_mallsoukobango2"></div>
                          </div>
                          <div class="col-lg-5 col-md-5 ">
                            <div class="m_t" style="font-size: 12px;">1：有、2：無</div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class=" row row_data">
                      <div class="col-lg-4 col-md-3">
                        <div class="margin_t ">
                          <span>指定納品書帳票CD</span>
                        </div>
                      </div>
                      <div class="col-lg-8 col-md-8">
                        <div class="outer row">
                          <div class="col-lg-6 col-md-6 ">
                            <div class="m_t" id="detail_mallsoukobango3"></div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class=" row row_data">
                      <div class="col-lg-4 col-md-3">
                        <div class="margin_t ">
                          <span>販売ランク</span>
                        </div>
                      </div>
                      <div class="col-lg-8 col-md-8">
                        <div class="outer row">
                          <div class="col-lg-12 col-md-12">
                            <div class="m_t" id="detail_domain"></div>
                          </div>
                          <div class="col-lg-5 col-md-5 d-none "></div>
                        </div>
                      </div>
                    </div>
                    <div class=" row row_data">
                      <div class="col-lg-4 col-md-3">
                        <div class="margin_t "><span>顧客深耕層別化</span></div>
                      </div>
                      <div class="col-lg-8 col-md-8">
                        <div class="outer row">
                          <div class="col-lg-12 col-md-12 ">
                            <div class="m_t" id="detail_domain2"></div>
                          </div>
                          <div class="col-lg-5 col-md-5 d-none "></div>
                        </div>
                      </div>
                    </div>
                    <div class=" row row_data">
                      <div class="col-lg-4 col-md-3">
                        <div class="margin_t ">
                          <span>得意先分類3</span>
                        </div>
                      </div>
                      <div class="col-lg-8 col-md-8">
                        <div class="outer row">
                          <div class="col-lg-12 col-md-12">
                            <div class="m_t" id="detail_datatxt0058"></div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class=" row row_data">
                      <div class="col-lg-4 col-md-3">
                        <div class="margin_t ">
                          <span>得意先分類4</span>
                        </div>
                      </div>
                      <div class="col-lg-8 col-md-8">
                        <div class="outer row">
                          <div class="col-lg-12 col-md-12 ">
                            <div class="m_t" id="detail_datatxt0059"></div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class=" row row_data">
                      <div class="col-lg-4 col-md-3">
                        <div class="margin_t ">
                          <span>得意先分類5</span>
                        </div>
                      </div>
                      <div class="col-lg-8 col-md-8">
                        <div class="outer row">
                          <div class="col-lg-12 col-md-12">
                            <div class="m_t" id="detail_datatxt0060"></div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class=" row row_data">
                      <div class="col-lg-4 col-md-3">
                        <div class="margin_t ">
                          <span>得意先分類6</span>
                        </div>
                      </div>
                      <div class="col-lg-8 col-md-8">
                        <div class="outer row">
                          <div class="col-lg-12 col-md-12 ">
                            <div class="m_t" id="detail_datatxt0061"></div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-6 col-md-12">
                  <div class="tbl_company w-100">
                    <div class=" row row_data">
                      <div class="col-lg-5 col-md-3">
                        <div class="margin_t ">
                          <span>単価設定区分</span>
                        </div>
                      </div>
                      <div class="col-lg-7 col-md-7">
                        <div class="outer row">
                          <div class="col-lg-12 col-md-12">
                            <div class="m_t" id="detail_haisoujouhou_address"></div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class=" row row_data">
                      <div class="col-lg-5 col-md-3">
                        <div class="margin_t ">
                          <span>取引開始日 東直</span>
                        </div>
                      </div>
                      <div class="col-lg-7 col-md-7">
                        <div class="outer row">
                          <div class="col-lg-12 col-md-12 ">
                            <div class="m_t" id="detail_kaiinbango"></div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class=" row row_data">
                      <div class="col-lg-5 col-md-3">
                        <div class="margin_t ">
                          <span>取引開始日 東流</span>
                        </div>
                      </div>
                      <div class="col-lg-7 col-md-7">
                        <div class="outer row">
                          <div class="col-lg-12 col-md-12 ">
                            <div class="m_t" id="detail_zokugara"></div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class=" row row_data">
                      <div class="col-lg-5 col-md-3">
                        <div class="margin_t ">
                          <span>取引開始日 西直</span>
                        </div>
                      </div>
                      <div class="col-lg-7 col-md-7">
                        <div class="outer row">
                          <div class="col-lg-12 col-md-12 ">
                            <div class="m_t" id="detail_haisoujouhou_name"></div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class=" row row_data">
                      <div class="col-lg-5 col-md-3">
                        <div class="margin_t ">
                          <span>取引開始日 西流</span>
                        </div>
                      </div>
                      <div class="col-lg-7 col-md-7">
                        <div class="outer row">
                          <div class="col-lg-12 col-md-12">
                            <div class="m_t" id="detail_haisoujouhou_yubinbango"></div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class=" row row_data">
                      <div class="col-lg-5 col-md-3">
                        <div class="margin_t ">
                          <span>ユーザー区分</span><span style="color: red;">※</span>
                        </div>
                      </div>
                      <div class="col-lg-7 col-md-7">
                        <div class="outer row">
                          <div class="col-lg-12 col-md-12 ">
                            <div class="m_t" id="detail_kcode4"></div>
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
                            <div class="m_t" id="detail_kcode5"></div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="tab-pane fade h-100 p-3 border" id="payment2" role="tabpanel" aria-labelledby="payment2-tab">
              <div class="row mt-1 mb-3">
                <div class="col-lg-12 col-md-12">
                  <div class="tbl_company w-100">
                    <div class=" row row_data">
                      <div class="col-lg-2 col-md-3">
                        <div class="margin_t "><span>支払締め日</span> <span style="color: red;">※</span></div>
                      </div>
                      <div class="col-lg-4 col-md-3">
                        <div class="outer row">
                          <div class="col-lg-12 col-md-12 ">
                            <div class="m_t" id="detail_haisoujouhou_tel"></div>
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
                    <div class=" row row_data">
                      <div class="col-lg-2 col-md-3">
                        <div class="margin_t ">
                          <span>支払月</span>
                          <span style="color: red;">※</span>
                        </div>
                      </div>
                      <div class="col-lg-4 col-md-3">
                        <div class="outer row">
                          <div class="col-lg-12 col-md-12 ">
                            <div class="m_t" id="detail_mail"></div>
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
                    <div class=" row row_data">
                      <div class="col-lg-2 col-md-3">
                        <div class="margin_t ">
                          <span>支払日</span> 
                          <span style="color: red;">※</span>
                        </div>
                      </div>
                      <div class="col-lg-4 col-md-3">
                        <div class="outer row">
                          <div class="col-lg-12 col-md-12 ">
                            <div class="m_t" id="detail_sex"></div>
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
                    <div class=" row row_data">
                      <div class="col-lg-2 col-md-3">
                        <div class="margin_t ">
                          <span>支払日休日設定</span>
                          <span style="color: red;">※</span>
                        </div>
                      </div>
                      <div class="col-lg-4 col-md-3">
                        <div class="outer row">
                          <div class="col-lg-12 col-md-12">
                            <div class="m_t" id="detail_bunrui1"></div>
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
                    <div class=" row row_data">
                      <div class="col-lg-2 col-md-3">
                        <div class="margin_t "><span>支払振込手数料設定</span> <span style="color: red;">※</span></div>
                      </div>
                      <div class="col-lg-4 col-md-3">
                        <div class="outer row">
                          <div class="col-lg-12 col-md-12 ">
                            <div class="m_t" id="detail_bunrui2"></div>
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
                    <div class=" row row_data">
                      <div class="col-lg-2 col-md-3">
                        <div class="margin_t "><span>支払振込手数料区分</span></div>
                      </div>
                      <div class="col-lg-4 col-md-3">
                        <div class="outer row">
                          <div class="col-lg-12 col-md-12 ">
                            <div class="m_t" id="detail_syukeinenkijun"></div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class=" row row_data">
                      <div class="col-lg-2 col-md-3">
                        <div class="margin_t "><span>支払方法</span> <span style="color: red;">※</span></div>
                      </div>
                      <div class="col-lg-4 col-md-3">
                        <div class="outer row">
                          <div class="col-lg-12 col-md-12">
                            <div class="m_t" id="detail_bunrui3"></div>
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
                    <div class=" row row_data">
                      <div class="col-lg-2 col-md-3">
                        <div class="margin_t ">
                          <span>振込銀行</span>
                        </div>
                      </div>
                      <div class="col-lg-4 col-md-3">
                        <div class="outer row">
                          <div class="col-lg-12 col-md-12 ">
                            <div class="m_t" id="detail_datatxt0054"></div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class=" row row_data">
                      <div class="col-lg-2 col-md-3">
                        <div class="margin_t ">
                          <span>振込支店</span>
                        </div>
                      </div>
                      <div class="col-lg-4 col-md-3">
                        <div class="outer row">
                          <div class="col-lg-12 col-md-12">
                            <div class="m_t" id="detail_datatxt0055"></div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class=" row row_data">
                      <div class="col-lg-2 col-md-3">
                        <div class="margin_t ">
                          <span>預金種別</span>
                        </div>
                      </div>
                      <div class="col-lg-4 col-md-3">
                        <div class="outer row">
                          <div class="col-lg-12 col-md-12 ">
                            <div class="m_t" id="detail_endtime"></div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class=" row row_data">
                      <div class="col-lg-2 col-md-3">
                        <div class="margin_t ">
                          <span>口座番号</span>
                        </div>
                      </div>
                      <div class="col-lg-4 col-md-3">
                        <div class="outer row">
                          <div class="col-lg-12 col-md-12 ">
                            <div class="m_t" id="detail_datatxt0056"></div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class=" row row_data">
                      <div class="col-lg-2 col-md-3">
                        <div class="margin_t ">
                          <span>口座名義人</span>
                        </div>
                      </div>
                      <div class="col-lg-4 col-md-3">
                        <div class="outer row">
                          <div class="col-lg-12 col-md-12">
                            <div class="m_t" id="detail_datatxt0057"></div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class=" row row_data">
                      <div class="col-lg-2 col-md-3">
                        <div class="margin_t ">
                          <span>支払手形サイト</span>
                        </div>
                      </div>
                      <div class="col-lg-9 col-md-3">
                        <div class="outer row">
                          <div class="col-lg-12 col-md-12">
                            <div class="m_t" id="detail_syukei3"></div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class=" row row_data">
                      <div class="col-lg-2 col-md-3">
                        <div class="margin_t ">
                          <span>仕向銀行</span>
                        </div>
                      </div>
                      <div class="col-lg-4 col-md-4">
                        <div class="outer row">
                          <div class="col-lg-12 col-md-12">
                            <div class="m_t" id="detail_syukeiki"></div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class=" row row_data">
                      <div class="col-lg-2 col-md-3">
                        <div class="margin_t ">
                          <span>仕向支店</span>
                        </div>
                      </div>
                      <div class="col-lg-4 col-md-3">
                        <div class="outer row">
                          <div class="col-lg-12 col-md-12 ">
                            <div class="m_t" id="detail_datatxt0053"></div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class=" row row_data">
                      <div class="col-lg-2 col-md-3">
                        <div class="margin_t "><span>支払課税区分</span> <span style="color: red;">※</span></div>
                      </div>
                      <div class="col-lg-4 col-md-3">
                        <div class="outer row">
                          <div class="col-lg-12 col-md-12 ">
                            <div class="m_t" id="detail_bunrui4"></div>
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
                    <div class=" row row_data">
                      <div class="col-lg-2 col-md-3">
                        <div class="margin_t "><span>支払税端数区分</span> <span style="color: red;">※</span></div>
                      </div>
                      <div class="col-lg-4 col-md-3">
                        <div class="outer row">
                          <div class="col-lg-12 col-md-12 ">
                            <div class="m_t" id="detail_bunrui5"></div>
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
                    <div class=" row row_data">
                      <div class="col-lg-2 col-md-3">
                        <div class="margin_t "><span>源泉税率</span></div>
                      </div>
                      <div class="col-lg-4 col-md-3">
                        <div class="outer row">
                          <div class="col-lg-12 col-md-12 ">
                            <div class="m_t" id="detail_syukei2"></div>
                          </div>
                        </div>
                      </div>
                      <div class="col-lg-6 col-md-6">
                        <div class="outer row">
                          <div class="col-lg-12 col-md-12 ">
                            <div class="m_t" style="font-size: 12px;">％</div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class=" row row_data">
                      <div class="col-lg-2 col-md-3">
                        <div class="margin_t ">
                          <span>手形決済月</span>
                        </div>
                      </div>
                      <div class="col-lg-4 col-md-3">
                        <div class="outer row">
                          <div class="col-lg-12 col-md-12 ">
                            <div class="m_t" id="detail_bunrui9"></div>
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
                    <div class=" row row_data">
                      <div class="col-lg-2 col-md-3">
                        <div class="margin_t ">
                          <span>手形決済日</span>
                        </div>
                      </div>
                      <div class="col-lg-4 col-md-3">
                        <div class="outer row">
                          <div class="col-lg-12 col-md-12 ">
                            <div class="m_t" id="detail_bunrui10"></div>
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
                    <div class=" row row_data">
                      <div class="col-lg-2 col-md-3">
                        <div class="margin_t ">
                          <span>支払消費税計算区分</span>
                          <span style="color: red;">※</span>
                        </div>
                      </div>
                      <div class="col-lg-4 col-md-3">
                        <div class="outer row">
                          <div class="col-lg-12 col-md-12 ">
                            <div class="m_t" id="detail_datatxt0052"></div>
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
      <div class="modal-footer">

      </div>
    </div>
  </div>
</div>