<div class="modal" data-keyboard="false" data-backdrop="static" id="view_modal" role="dialog"
  aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document" style="max-width: 800px !important;">
    <div class="modal-content">
      <div class="modal-header">
        <h6 class="modal-title" id="exampleModalLabel"></h6>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="development_page_top_table heading_mt" style="margin:11px 0px;">

          {{-- Confirmation Message Starts Here --}}
          <div class="row titlebr" style="">
            <div class="col-12 pl-0" id="confirmation_message">
            </div>
          </div>
          {{-- Confirmation Message Ends Here --}}

          <div class="row titlebr" style="margin-bottom: 15px;">
            <div class="col-lg-6">
              <h5>得意先別商品マスタ(詳細)</h5>
            </div>

            <div class="col-lg-6">
              <table class="dev_tble_button" style="float: right;">
                <tbody>
                  <tr class="marge_in">
                    @if($tantousya->innerlevel <= 10) 
                      <td class="" style="padding-right: 5px!important;">
                        <a class="btn btn-info scroll" id="btnDelete" style="background-color: #3e6ec1!important;"
                          data-url="{{route('clearCustomerProductManagementSetting',[$bango])}}">
                          <i class="fa fa-trash" style="margin-right: 7px;"></i>削除
                        </a>
                      </td>
                      @if($deleted_item )
                      <td class="">
                        <a class="btn btn-info scroll"
                          data-url=" {{route('clearCustomerProductManagementSetting',[$bango,1])}}" id="btnRestore"
                          style="">データを戻す
                        </a>
                      </td>
                      @endif
                      @endif
                      <td class="">
                        <a class="btn btn-info scroll" id="edit_modal_open" style="">
                          <i class="fa fa-pencil-square-o" aria-hidden="true" style="margin-right: 5px;"></i>変更画面へ
                        </a>
                      </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>

        <div class="row mt-1 mb-3">
          <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="tbl_name">
              <div class="w-100">
                <div class=" row row_data">
                  <div class="col-lg-2 col-md-2 col-sm-2">
                    <div class="margin_t ">
                      <span>会社CD</span><span style="color: red;">※</span>
                    </div>
                  </div>
                  <div class="col-lg-10 col-md-10 col-sm-10">
                    <div class="outer row">
                      <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="m_t" id="company_id"></div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class=" row row_data">
                  <div class="col-lg-2 col-md-2 col-sm-2">
                    <div class="margin_t ">
                      <span>商品CD</span><span style="color: red;">※</span>
                    </div>
                  </div>
                  <div class="col-lg-10 col-md-10 col-sm-10">
                    <div class="outer row">
                      <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="m_t" id="product_id"></div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class=" row row_data">
                  <div class="col-lg-2 col-md-2 col-sm-2">
                    <div class="margin_t ">
                      <span>単価区分</span><span style="color: red;">※</span>
                    </div>
                  </div>
                  <div class="col-lg-9 col-md-9 col-sm-9">
                    <div class="outer row">
                      <div class="col-lg-8 col-md-8 col-sm-8 ">
                        <div class="m_t" id="unit_price"></div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row mt-1 mb-3">
          <div class="col-lg-6 col-md-6 col-sm-6">
            <div class="tbl_name">
              <div class="w-100">
                <div class=" row row_data">
                  <div class="col-lg-4 col-md-4 col-sm-4">
                    <div class="margin_t ">
                      <span>基本販売価格</span>
                    </div>
                  </div>
                  <div class="col-lg-8 col-md-8 col-sm-8">
                    <div class="outer row">
                      <div class="col-lg-8 col-md-8 col-sm-8">
                        <div class="m_t text-right" id="basic_selling"></div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class=" row row_data">
                  <div class="col-lg-4 col-md-4 col-sm-4">
                    <div class="margin_t ">
                      <span>PB販売価格</span>
                    </div>
                  </div>
                  <div class="col-lg-8 col-md-8 col-sm-8">
                    <div class="outer row">
                      <div class="col-lg-8 col-md-8 col-sm-8">
                        <div class="m_t text-right" id="pb_sales"></div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class=" row row_data">
                  <div class="col-lg-4 col-md-4 col-sm-4">
                    <div class="margin_t ">
                      <span>営業粗利</span>
                    </div>
                  </div>
                  <div class="col-lg-8 col-md-8 col-sm-8">
                    <div class="outer row">
                      <div class="col-lg-8 col-md-8 col-sm-8 ">
                        <div class="m_t text-right" id="operating_margin"></div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class=" row row_data">
                  <div class="col-lg-4 col-md-4 col-sm-4">
                    <div class="margin_t ">
                      <span>PB営業粗利</span>
                    </div>
                  </div>
                  <div class="col-lg-8 col-md-8 col-sm-8 ">
                    <div class="outer row">
                      <div class="col-lg-8 col-md-8 col-sm-8 ">
                        <div class="m_t text-right" id="pb_operating_gross"></div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-6 col-md-6 col-sm-6">
            <div class="tbl_name">
              <div class="w-100">
                <div class=" row row_data">
                  <div class="col-lg-5 col-md-5 col-sm-5">
                    <div class="margin_t">
                      <span>仕入価格</span>
                    </div>
                  </div>
                  <div class="col-lg-7 col-md-7 col-sm-7">
                    <div class="outer row">
                      <div class="col-lg-8 col-md-8 col-sm-8 ">
                        <div class="m_t text-right" id="purchase_price"></div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class=" row row_data">
                  <div class="col-lg-5 col-md-5 col-sm-5">
                    <div class="margin_t ">
                      <span>仕切(SE)</span>
                    </div>
                  </div>
                  <div class="col-lg-7 col-md-7 col-sm-7">
                    <div class="outer row">
                      <div class="col-lg-8 col-md-8 col-sm-8">
                        <div class="m_t text-right" id="partition_se"></div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class=" row row_data">
                  <div class="col-lg-5 col-md-5 col-sm-5">
                    <div class="margin_t ">
                      <span>仕切(研究所)</span>
                    </div>
                  </div>
                  <div class="col-lg-7 col-md-7 col-sm-7">
                    <div class="outer row">
                      <div class="col-lg-8 col-md-8 col-sm-8">
                        <div class="m_t text-right" id="partition_lab"></div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class=" row row_data">
                  <div class="col-lg-5 col-md-5 col-sm-5">
                    <div class="margin_t ">
                      <span>仕切(出荷センター)</span>
                    </div>
                  </div>
                  <div class="col-lg-7 col-md-7 col-sm-7">
                    <div class="outer row">
                      <div class="col-lg-8 col-md-8 col-sm-8">
                        <div class="m_t text-right" id="partition_shopping"></div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row mt-1 mb-3">
          <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="tbl_name">
              <div class="w-100">
                <div class=" row row_data">
                  <div class="col-lg-2 col-md-2 col-sm-2">
                    <div class="margin_t ">
                      <span>入力区分1</span><span style="color: red;">※</span>
                    </div>
                  </div>
                  <div class="col-lg-9 col-md-9 col-sm-9">
                    <div class="outer row">
                      <div class="col-lg-8 col-md-8 col-sm-8  ">
                        <div class="m_t" id="input_category_1"></div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class=" row row_data">
                  <div class="col-lg-2 col-md-2 col-sm-2">
                    <div class="margin_t ">
                      <span>入力区分2</span>
                    </div>
                  </div>
                  <div class="col-lg-9 col-md-9 col-sm-9">
                    <div class="outer row">
                      <div class="col-lg-8 col-md-8 col-sm-8 ">
                        <div class="m_t" id="input_category_2"></div>
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