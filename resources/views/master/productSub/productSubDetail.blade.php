<div class="modal" data-keyboard="false" data-backdrop="static" id="product_sub_modal2" role="dialog"
  aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document" style="max-width: 680px!important;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" data-bind="nextFieldOnEnter:true">
        <div class="development_page_top_table heading_mt" style="margin: 11px !important;">
          <div class="row titlebr" style="margin-bottom: 15px;">

            {{-- Error Message Starts Here --}}
            <div class="col-12">
              <div id="detail_error_data"></div>
            </div>
            {{-- Error Message Ends Here --}}

            {{-- Error Message Starts Here --}}
            <div class="col-12 pl-0">
              <div id="productsub_detail_error_data"></div>
            </div>
            {{-- Error Message Ends Here --}}

            <div class="col-6" style="">
              <h6 class="mt-2">商品サブマスタ(詳細)</h6>
            </div>

            <div class="col-6" style="">
              <table class="dev_tble_button" style="float: right;">
                <tbody>
                  <tr class="marge_in">
                    @if($tantousya->innerlevel <= 10) 
                      <td class="" style="">
                        <a href="#" class="btn btn-info scroll" id="deleteThis" onclick="deleteProductSubMaster('{{route('clearProductSubSetting',[$bango])}}')" autofocus>
                          <i class="fa fa-trash" style="margin-right: 7px;"></i>削除
                        </a>
                      </td>
                    @endif
                    <td class="">
                      <a href="#" class="btn btn-info scroll @if($tantousya->innerlevel >= 15) disable @endif " id="productSubButton3" data-toggle="modal" data-target="#product_sub_modal3" > 
                        <i class="fa fa-pencil-square-o" aria-hidden="true" style="margin-right: 5px;"></i>変更画面へ
                      </a>
                    </td>
                    @if($deleted_item )
                      <td class="">
                        <a href="#" class="btn btn-info scroll" id="btnRestore" onclick="returnProductSubMaster('{{route('clearProductSubSetting',[$bango,1])}}')">
                          <i class="" aria-hidden="true" style="margin-right: 5px;"></i>データを戻す
                        </a>
                      </td>
                    @endif
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
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
                            <div class="m_t" id="detail_other1" style="white-space: normal; word-break: break-all"></div>
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
                            <div class="m_t" id="detail_other3_detail"></div>
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
                            <div class="m_t" id="detail_other4_detail"></div>
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
                            <div class="m_t" id="detail_other25_detail"></div>
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
                          <div class="col-lg-6 ">
                            <div class="m_t" id="detail_other2" style="white-space: normal; word-break: break-all"></div>
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
                            <div class="m_t" id="detail_other21"></div>
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
                      <div class="col-lg-9 col-md-9 col-sm-9 ">
                        <div class="outer row">
                          <div class="col-lg-6 ">
                            <div class="m_t" id="detail_other5" style="white-space: normal; word-break: break-all;"></div>
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
                            <div class="m_t" style="white-space: normal; word-break: break-all;" id="detail_other22"></div>
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
                            <div class="m_t" id="detail_other23" style="white-space: normal; word-break: break-all;"></div>
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
                            <div class="m_t" id="detail_other24" style="white-space: normal; word-break: break-all;"></div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class=" row row_data">
                      <div class="col-lg-3 col-md-3 col-sm-3">
                        <div class="margin_t ">
                          <span>サブCD桁数</span>
                        </div>
                      </div>
                      <div class="col-lg-9 col-md-9 col-sm-9">
                        <div class="outer row">
                          <div class="col-lg-6 col-md-6 col-sm-8 ">
                            <div class="m_t" id="detail_other18" style="white-space: normal; word-break: break-all;"></div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class=" row row_data">
                      <div class="col-lg-3 col-md-3 col-sm-3">
                        <div class="margin_t ">
                          <span>対応バージョン</span>
                        </div>
                      </div>
                      <div class="col-lg-9 col-md-9 col-sm-9">
                        <div class="outer row">
                          <div class="col-lg-6 col-md-6 col-sm-8 ">
                            <div class="m_t" id="detail_other20" style="white-space: normal; word-break: break-all;"></div>
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
                            <div class="m_t" id="detail_other6" style="white-space: normal; word-break: break-all;"></div>
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
                            <div class="m_t" id="detail_other7" style="white-space: normal; word-break: break-all;"></div>
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
                            <div class="m_t" id="detail_other8" style="white-space: normal; word-break: break-all;"></div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row row_data">
                      <div class="col-lg-3 col-md-3 col-sm-3">
                        <div class="margin_t ">
                          <span>作成者</span>
                        </div>
                      </div>
                      <div class="col-lg-9 col-md-9 col-sm-9">
                        <div class="outer row">
                          <div class="col-lg-6 ">
                            <div class="m_t" id="detail_other12_detail" style="white-space: normal; word-break: break-all;"></div>
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
                      <div class="col-lg-9  col-md-9 col-sm-9">
                        <div class="outer row">
                          <div class="col-lg-6 ">
                            <div class="m_t" id="detail_other9" style="white-space: normal; word-break: break-all;"></div>
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
                      <div class="col-lg-9  col-md-9 col-sm-9">
                        <div class="outer row">
                          <div class="col-lg-6 ">
                            <div class="m_t" id="detail_other10" style="white-space: normal; word-break: break-all;"></div>
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
                      <div class="col-lg-9  col-md-9 col-sm-9">
                        <div class="outer row">
                          <div class="col-lg-6 ">
                            <div class="m_t" id="detail_other11" style="white-space: normal; word-break: break-all;"></div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class=" row row_data">
                      <div class="col-lg-3 col-md-3 col-sm-3">
                        <div class="margin_t ">
                          <span>データ区分 </span>
                        </div>
                      </div>
                      <div class="col-lg-9">
                        <div class="outer row">
                          <div class="col-lg-6 ">
                            <div class="m_t" id="detail_other13_original" style="white-space: normal; word-break: break-all;"></div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class=" row row_data">
                      <div class="col-lg-3 col-md-3 col-sm-3">
                        <div class="margin_t ">
                          <span>作成ステータス </span><span style="color: red;"> ※</span>
                        </div>
                      </div>
                      <div class="col-lg-9  col-md-9 col-sm-9">
                        <div class="outer row">
                          <div class="col-lg-6 ">
                            <div class="m_t" id="detail_other14_original" style="white-space: normal; word-break: break-all;"></div>
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
                      <div class="col-lg-9">
                        <div class="outer row">
                          <div class="col-lg-6 ">
                            <div class="m_t" id="detail_other15_modified" style="white-space: normal; word-break: break-all;"></div>
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
                      <div class="col-lg-9  col-md-9 col-sm-9">
                        <div class="outer row">
                          <div class="col-lg-6 ">
                            <div class="m_t" id="detail_other16_modified" style="white-space: normal; word-break: break-all;"></div>
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
                      <div class="col-lg-9  col-md-9 col-sm-9">
                        <div class="outer row">
                          <div class="col-lg-6 ">
                            <div class="m_t" id="detail_other17_original" style="white-space: normal; word-break: break-all;">2</div>
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
</div>