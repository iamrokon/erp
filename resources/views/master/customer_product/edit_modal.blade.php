<form id="editForm" method="post" data-editmethod="editCustomerProduct"
  action="{{route("postCustomerProductManagement",[$bango])}}">
  @csrf
  <input type="hidden" name="type" value="edit">
  <input type="hidden" name="customerProductBango" id="customerProductBango" value="">
  <input type="hidden" name="editUrl" value="{{route("postCustomerProductManagement",[$bango])}}">
  <input type="hidden" name="validate_only" value="1">
  <div class="modal custom-form" data-keyboard="false" data-backdrop="static" id="edit_modal" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" style="max-width: 800px !important;" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h6 class="modal-title" id="exampleModalLabel"></h6>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body" data-bind="nextFieldOnEnter:true">
          <div class="development_page_top_table heading_mt">

            {{-- Error Message Starts Here --}}
            <div class="col-12 pl-0" style="margin-left: -15px !important;">
              <div id="edit_registration_error_data"></div>
            </div>
            {{-- Error Message Ends Here --}}

            <div class="row titlebr" style="margin-bottom: 15px;">
              <div class="col-6">
                <table class="dev_tble_button" style="float: left;">
                  <tbody>
                    <tr class="marge_in">
                      <td class="" style="padding-left: 0px!important;width: 70px!important;">
                        <h5>得意先別商品マスタ(変更)</h5>
                        <div class="mt-3">変更(処理状況)</div>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <div class="col-6">
                <div style="float: right;">
                  <button name="insert" id="edit_submit_registration" type="submit" class="btn btn-info" autofocus>
                    <i class="fas fa-save" style="margin-right: 5px;"></i>保存
                  </button>
                </div>
              </div>
            </div>
          </div>
          <div class="row mt-1 mb-3">
            <div class="col-lg-12 col-md-12 col-sm-12 ">
              <div class="tbl_name">
                <div class="w-100">
                  <div class=" row row_data">
                    <div class="col-lg-2 col-md-2 col-sm-2">
                      <div class="margin_t">
                        <span>会社CD</span><span style="color: red;">※</span>
                      </div>
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-9">
                      <div class="outer row">
                        <div class="col-lg-8 col-md-8 col-sm-8">
                          <input type="text" id="edit_company_id" class="form-control" readonly>
                          <input type="hidden" name="company_id" id="new_edit_company_id">
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
                    <div class="col-lg-9 col-md-9 col-sm-9">
                      <div class="outer row">
                        <div class="col-lg-8 col-md-8 col-sm-8">
                          <input type="text" id="edit_product_id" class="form-control" readonly>
                          <input type="hidden" name="product_id" id="new_edit_product_id">
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
                    <div class="col-lg-9 col-md-6 col-sm-6">
                      <div class="outer row">
                        <div class="col-lg-8 col-md-8 col-sm-8">
                          <input type="text" class="form-control" id="edit_unit_price" readonly>
                          <input type="hidden" name="unit_price" id="new_edit_unit_price">
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
                    <div class="col-lg-8 col-md-8 col-sm-8 ">
                      <div class="outer row">
                        <div class="col-lg-8 col-md-8 col-sm-8 ">
                          <input type="text" class="form-control text-right e_subs" name="basic_selling" maxlength="8"
                            id="edit_basic_selling"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
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
                          <input type="text" class="form-control text-right e_subs" name="pb_sales" maxlength="8"
                            id="edit_pb_sales"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
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
                        <div class="col-lg-8 col-md-8 col-sm-8">
                          <div class="m_t text-right operating_margin_text_edit"></div>
                          <input type="hidden" id="edit_operating_margin" name="operating_margin">
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
                    <div class="col-lg-8 col-md-8 col-sm-8">
                      <div class="outer row">
                        <div class="col-lg-8 col-md-8 col-sm-8">
                          <div class="m_t pb_operating_gross_text_edit text-right"></div>
                          <input type="hidden" id="edit_pb_operating_gross" name="pb_operating_gross">
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
                      <div class="margin_t ">
                        <span>仕入価格</span>
                      </div>
                    </div>
                    <div class="col-lg-7 col-md-7 col-sm-7">
                      <div class="outer row">
                        <div class="col-lg-8 col-md-8 col-sm-8">
                          <input type="text" class="form-control text-right e_subsBy" name="purchase_price"
                            maxlength="8" id="edit_purchase_price"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
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
                        <div class="col-lg-8 col-md-8 col-sm-8 ">
                          <input type="text" class="form-control text-right e_subsBy" name="partition_se" maxlength="8"
                            id="edit_partition_se"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
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
                          <input type="text" class="form-control text-right e_subsBy" name="partition_lab" maxlength="8"
                            id="edit_partition_lab"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
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
                          <input type="text" class="form-control text-right e_subsBy" name="partition_shopping"
                            maxlength="8" id="edit_partition_shopping"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
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
                      <div class="margin_t">
                        <span>入力区分1</span><span style="color: red;">※</span>
                      </div>
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-9">
                      <div class="outer row">
                        <div class="col-lg-8 col-md-8 col-sm-8">
                          <div class="custom-arrow">
                            <select id="edit_input_category_1" name="input_category_1" class="form-control"
                              style="width:100%;">
{{--                              <option value="">-</option>--}}
                              @foreach($inputCategory1s as $inputCategory1)
                              <option value="{{$inputCategory1->syouhinbango .' '.$inputCategory1->jouhou}}">
                                {{$inputCategory1->syouhinbango .' '.$inputCategory1->jouhou}}
                              </option>
                              @endforeach
                            </select>
                          </div>
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
                        <div class="col-lg-8 col-md-8 col-sm-8">
                          <div class="custom-arrow">
                            <select name="input_category_2" id="edit_input_category_2" class="form-control"
                              style="width:100%;">
{{--                              <option value="">-</option>--}}
                              @foreach($inputCategory2s as $inputCategory2)
                              <option value="{{$inputCategory2->syouhinbango .' '.$inputCategory2->jouhou}}">
                                {{$inputCategory2->syouhinbango .' '.$inputCategory2->jouhou}}
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
        <div class="modal-footer">

        </div>
      </div>
    </div>
  </div>
</form>
