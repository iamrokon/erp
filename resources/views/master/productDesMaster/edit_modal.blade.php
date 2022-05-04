<form id="editForm" method="post" action="{{route("postProductDescriptionMasterDetail",[$bango])}}"
  data-editmethod="editProductDescription">
  @csrf
  <input type="hidden" name="type" value="edit">
  <input type="hidden" name="productDesBango" id="productDesBango" value="">
  <input type="hidden" name="editUrl" value="{{route("postProductDescriptionMasterDetail",[$bango])}}">
  <input type="hidden" name="validate_only" value="1">
  <div class="modal custom-form" data-keyboard="false" data-backdrop="static" id="edit_modal" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 700px !important;" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body" data-bind="nextFieldOnEnter:true">
          <div class="development_page_top_table heading_mt mt-0" style="margin:11px;">
            <div class="row titlebr" style="margin-bottom: 15px;">

              {{-- Error Message Starts Here --}}
              <div class="col-12 pl-0" style="margin-left: -11px !important;">
                <div id="edit_registration_error_data"></div>
              </div>
              {{-- Error Message Ends Here --}}

              <div class="col-6 pl-1">
                <table class="dev_tble_button" style="float: left;">
                  <tbody>
                    <tr class="marge_in">
                      <td class="" style="padding-left: 0px!important;width: 70px!important;">
                        <h5>商品説明マスタ(変更)</h5>
                        <div class="mt-3">変更(処理状況)</div>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <div class="col-6 pr-1">
                <div style="float: right;">
                  <button type="submit" class="btn btn-info" name="insert" id="edit_submit_registration" autofocus>
                    <i class="fas fa-save" style="margin-right: 5px;"></i>保存
                  </button>
                </div>
              </div>
            </div>
          </div>

          <div class="row mt-1 mb-3">
            <div class="col-lg-12 col-md-12 col-sm-12">
              <div class="tbl_name">
                <div class="w-100">
                  <div class=" row row_data">
                    <div class="col-lg-3 col-md-3 col-sm-3">
                      <div class="margin_t "><span>商品説明CD区分</span></div>
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-9">
                      <div class="outer row">
                        <div class="col-lg-3 col-md-3 col-sm-3 ">
                          <div class="m_t" id="url" style="font-size:12px;">
                            商品　
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class=" row row_data">
                    <div class="col-lg-3 col-md-3 col-sm-3">
                      <div class="margin_t ">
                        <span>商品説明CD <span style="color: red;">※</span></span> </div>
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-9">
                      <div class="outer row">
                        <div class="col-lg-12 col-md-12 col-sm-12 pr-custom-0">
                          <div class="m_t" id="urlsm" style="white-space: normal; word-break: break-all;"></div>
                        </div>
                        {{-- <div class="col-lg-8 col-md-8 col-sm-8 pl-custom-0">
                          <div class="m_t">Autoメール名人 導入先支援運用打合せ</div>
                        </div> --}}
                      </div>
                    </div>
                  </div>
                  <div class=" row row_data">
                    <div class="col-lg-3 col-md-3 col-sm-3">
                      <div class="margin_t "><span>見積明細備考</span> </div>
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-9">
                      <div class="outer row">
                        <div class="col-lg-12 col-md-12 col-sm-12 ">
                          <input type="text" class="form-control" id="edit_mbcatch" name="mbcatch">
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class=" row row_data">
                    <div class="col-lg-3 col-md-3 col-sm-3">
                      <div class="margin_t "><span>サービス内容</span></div>
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-9">
                      <div class="outer row">
                        <div class="col-lg-12 col-md-12 col-sm-12 ">
                          <div class="form-group">
                            <textarea class="form-control" rows="9" id="edit_setumei" name="setumei"
                              style="height: 200px; white-space: pre-wrap;"></textarea>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class=" row row_data">
                    <div class="col-lg-3 col-md-3 col-sm-3">
                      <div class="margin_t "><span>工数目安</span></div>
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-9">
                      <div class="outer row">
                        <div class="col-lg-12 col-md-12 col-sm-12 ">
                          <div class="form-group">
                            <textarea id="edit_catch" name="catch" class="form-control" rows="13"
                              style="height: 290px; white-space: pre-wrap;"></textarea>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class=" row row_data">
                    <div class="col-lg-3 col-md-3 col-sm-3">
                      <div class="margin_t "><span>成果物</span> </div>
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-9">
                      <div class="outer row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                          <textarea type="text" id="edit_caption" name="caption" class="form-control" rows="5"
                            style="height: 111px; white-space: pre-wrap;"></textarea>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class=" row row_data">
                    <div class="col-lg-3 col-md-3 col-sm-3">
                      <div class="margin_t "><span>社内備考</span> </div>
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-9">
                      <div class="outer row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                          <textarea type="text" id="edit_catchsm" name="catchsm" class="form-control" rows="3"
                            style="height: 67px; white-space: pre-wrap;"></textarea>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class=" row row_data">
                    <div class="col-lg-3 col-md-3 col-sm-3">
                      <div class="margin_t "><span>販売時留意点</span></div>
                    </div>
                    <div class="col-lg-9　col-md-9 col-sm-9">
                      <div class="outer row">
                        <div class="col-lg-12 col-md-12 col-sm-12 ">
                          <div class="form-group">
                            <textarea class="form-control" rows="10" name="mbcatchsm" id="edit_mbcatchsm"
                              style="height: 222px !important; white-space: pre-wrap;"></textarea>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class=" row row_data">
                    <div class="col-lg-3 col-md-3 col-sm-3">
                      <div class="margin_t "><span>商品説明PDF</span> </div>
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-9">
                      <div class="outer row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                          <div style="position:relative;">
                            <input id="input_file_prdes2" type="text" class="input_field form-control" name="new_inp2"
                              style="height: 42px!important;" readonly>
                          </div>
                          <input name="old_inp2" id="old_inp2" type="hidden" class="input_field form-control">
                          {{-- <div class="custom-file2" style="margin-top: 9px;position: absolute;bottom: 0;top: -2px;right: 20px;">
                            <input type="file" class="custom-file-input3" id="customFilePrDes2" name="mbcaption" onchange="readURL(this);"
                              accept="zip,application/octet-stream,application/zip,application/x-zip,application/x-zip-compressed,application/pdf">
                            <button class="btn btn-info" for="customFilePrDes2">
                              <i class="far fa-file-pdf" aria-hidden="true" style="margin-right: 5px;"></i>参照
                            </button>
                          </div> --}}
                          <div class="custom-file2" style="margin-top: 0; position: absolute; bottom: 7px; right: 22px;">
                            <input type="file"
                              accept="zip,application/octet-stream,application/zip,application/x-zip,application/x-zip-compressed,application/pdf"
                              class="custom-file-input3" onchange="readURL(this);" id="customFilePrDes2" name="mbcaption">
                            <a class="btn btn-info" href="#">
                              <label style="cursor: pointer;margin: 0;" for="customFilePrDes2"><i class="far fa-file-pdf" aria-hidden="true" style="margin-right: 5px;"></i> 参照</label>
                            </a>
                          </div>
                        </div>
                        <script>
                          $(".custom-file-input3").on("change", function () {
                            var fileName2 = $(this).val().split("\\").pop();
                            $(this).siblings(".custom-file-label2").addClass("selected").html(fileName2);
                            $("#input_file_prdes2").val(fileName2);
                          });

                          function readURL(input) {
                            if (input.files && input.files[0]) {
                              var reader = new FileReader();
                              reader.readAsDataURL(input.files[0]);
                            }
                          }
                          $("#customFilePrDes2").change(function () {
                            readURL($('#customFilePrDes2').val());
                          });
                        </script>
                        {{-- <script>
                          $(".custom-file-input3").on("change", function () {
                            var fileName2 = $(this).val().split("\\").pop();
                            $(this).siblings(".custom-file-label2").addClass("selected").html(fileName2);
                            $("#input_file_prdes2").val(fileName2);
                          });

                          function readURL(input) {
                            if (input.files && input.files[0]) {
                              var reader = new FileReader();
                              reader.readAsDataURL(input.files[0]);
                            }
                          }
                          $("#customFilePrDes2").change(function () {
                            readURL($('#customFilePrDes2').val());
                          });
                        </script> --}}
                      </div>
                    </div>
                  </div>

                  <div class=" row row_data" style="margin-top: 0.1rem;">
                    <div class="col-lg-3 col-md-3 col-sm-3">
                      <div class="margin_t "><span>補足説明</span></div>
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-9">
                      <div class="outer row">
                        <div class="col-lg-12 col-md-12 col-sm-12 ">
                          <div class="form-group" style="white-space:normal;margin-top: 4px;">
                            (当面未使用)
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class=" row row_data">
                    <div class="col-lg-3 col-md-3 col-sm-3">
                      <div class="margin_t "><span>入力区分</span> <span style="color: red;">※</span></div>
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-9">
                      <div class="outer row">
                        <div class="col-lg-3 col-md-3 col-sm-3">
                          <div class="custom-arrow">
                              <select class="form-control" id="edit_datatxt0096" name="datatxt0096" style="width: 95px!important; border:1px solid #e1e1e1 !important;border-radius: 0.25rem!important;">
                                  @foreach($requests as $req)
                                      <option value="{{$req->syouhinbango.' '.$req->jouhou}}">{{$req->syouhinbango.' '.$req->jouhou}}</option>
                                  @endforeach
                              </select>
                          </div>
                        </div>
                        <div class="col-lg-8 col-md-8 col-sm-8 ">
                          <div class="m_t" style="font-size:12px;">

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
