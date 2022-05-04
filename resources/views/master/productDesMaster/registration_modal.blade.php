<form id="registrationForm" method="post" enctype='multipart/form-data'
  action="{{route("postProductDescriptionMasterDetail",[$bango])}}" data-regmethod="registerProductDescription">
  @csrf
  <input type="hidden" name="type" value="create">
  <input type="hidden" name="bango" value="{{$bango}}">
  <input type="hidden" name="submit_url" value="{{route("postProductDescriptionMasterDetail",[$bango])}}">
  <input type="hidden" name="validate_only" value="1">
  <div class="modal" data-keyboard="false" data-backdrop="static" id="registration_modal" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="max-width: 700px !important;" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body pt-0" data-bind="nextFieldOnEnter:true">
          <div class="development_page_top_table heading_mt" style="margin: 11px !important;">
            <div class="row titlebr" style="margin-bottom: 15px;">

              {{-- Error Message Starts Here --}}
              <div class="col-12 pl-0" style="margin-left: -13px !important;">
                <div id="registration_error_data"></div>
              </div>
              {{-- Error Message Ends Here --}}

              <div class="col-6 pl-1">
                <table class="dev_tble_button" style="float: left;">
                  <tbody>
                    <tr class="marge_in">
                      <td class="" style="padding-left: 0px!important;width: 70px!important;">
                        <h5>商品説明マスタ(登録)</h5>
                        <div class="mt-3">新規(処理状況)</div>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <div class="col-6 pr-2">
                <div style="float: right;">
                  <button type="submit" name="insert" id="submit_registration" class="btn btn-info" autofocus>
                    <i class="fas fa-save" style="margin-right: 5px;"></i>保存
                  </button>
                </div>
              </div>
            </div>
          </div>

          <div class="row mt-1 mb-3 custom-form">
            <div class="col-lg-12 col-md-12 col-sm-12">
              <div class="tbl_name">
                <div class="w-100">
                  <div class=" row row_data">
                    <div class="col-lg-3 col-md-3 col-sm-3">
                      <div style="margin-bottom:7px;"><span>商品説明CD区分</span></div>
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-9">
                      <div class="outer row">
                        <div class="col-sm-12">
                          <div class="row">
                            <div class="col-lg-12 col-sm-12 col-xs-12 col-12">
                              <div class="d-flex">
                                <label class="radio_container" for="product_d_radio1">商品
                                  <input type="radio" id="product_d_radio1" class="check_product_radio" name="url" value="商品" checked autofocus>
                                  <span class="radio_checkmark"></span>
                                </label>
                                <label class="radio_container ml-3" for="product_d_radio2">商品サブ
                                  <input type="radio" id="product_d_radio2" class="check_product_radio" name="url" value="商品サブ">
                                  <span class="radio_checkmark"></span>
                                </label>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class=" row row_data">
                    <div class="col-lg-3 col-md-3 col-sm-3">
                      <div class="margin_t ">
                        <span>商品説明CD<span style="color: red;">※</span></span> </div>
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-9">
                      <div class="outer row">
                        <div class="col-lg-3 col-md-3 col-sm-3 pr-custom-0">
                          <div style="position:relative;">
                            <input type="text" class="form-control" id="insert_urlsm" name="urlsm"
                              oninput="this.value = this.value.replace(/[^a-zA-Z0-9]/g, '').replace(/(\..*)\./g, '$1');">
                          </div>
                        </div>
                        <div class="col-lg-9 col-md-9 col-sm-9">
                          <div style="white-space: normal; word-break: break-all !important;">
                            <span id="insert_name"></span>
                          </div>
                        </div>
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
                          <input type="text" class="form-control" id="insert_mbcatch" name="mbcatch">
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
                            <textarea class="form-control" rows="9" id="insert_setumei" name="setumei"
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
                            <textarea name="catch" id="insert_catch" class="form-control" rows="13"
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
                        <div class="col-lg-12 col-md-12 col-sm-12 ">
                          <textarea type="text" id="insert_caption" name="caption" class="form-control" rows="5"
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
                        <div class="col-lg-12 col-md-12 col-sm-12 ">
                          <textarea type="text" id="insert_catchsm" name="catchsm" class="form-control" rows="3"
                            style="height: 67px; white-space: pre-wrap;"></textarea>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class=" row row_data">
                    <div class="col-lg-3 col-md-3 col-sm-3">
                      <div class="margin_t "><span>販売時留意点</span></div>
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-9">
                      <div class="outer row">
                        <div class="col-lg-12 col-md-12 col-sm-12 ">
                          <div class="form-group">
                            <textarea class="form-control" rows="10" name="mbcatchsm" id="insert_mbcatchsm"
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
                        <div class="col-lg-12 col-md-12 col-sm-12 ">
                          <div style="position:relative;">
                            <input name="inp2" id="input_file_prdes1" type="text" class="input_field form-control"
                              style="height: 37.5px !important;" readonly>
                          </div>
                          {{-- <div class="custom-file2"
                            style="margin-top: 9px;position: absolute;bottom: 0;top: -2px;right: 20px;">
                            <input type="file" class="custom-file-input1" id="customFilePrDes1" name="mbcaption"
                              onchange="readURL(this);"
                              accept="zip,application/octet-stream,application/zip,application/x-zip,application/x-zip-compressed,application/pdf">
                            <button class="btn btn-info" for="customFilePrDes1">
                              <i class="far fa-file-pdf" aria-hidden="true" style="margin-right: 5px;"></i>参照
                            </button>
                          </div> --}}
                          <div class="custom-file2" style="margin-top: 0; position: absolute; bottom: 5px; right: 20px;">
                            <input type="file"
                              accept="zip,application/octet-stream,application/zip,application/x-zip,application/x-zip-compressed,application/pdf"
                              class="custom-file-input1" onchange="readURL(this);" id="customFilePrDes1" name="mbcaption">
                            <a class="btn btn-info" href="#">
                              <label style="cursor: pointer;margin: 0;" for="customFilePrDes1"><i class="far fa-file-pdf" aria-hidden="true" style="margin-right: 5px;"></i> 参照</label>
                            </a>
                          </div>
                        </div>
                        <script>
                          $(".custom-file-input1").on("change", function () {
                            var fileName2 = $(this).val().split("\\").pop();
                            $(this).siblings(".custom-file-label2").addClass("selected").html(fileName2);
                            $("#input_file_prdes1").val(fileName2);
                          });

                          function readURL(input) {
                            if (input.files && input.files[0]) {
                              var reader = new FileReader();
                              reader.readAsDataURL(input.files[0]);
                            }
                          }

                          $("#customFilePrDes1").change(function () {
                            readURL($('#customFilePrDes1').val());
                          });
                        </script>
                        {{-- <script>
                          $(".custom-file-input1").on("change", function () {
                            var fileName2 = $(this).val().split("\\").pop();
                            $(this).siblings(".custom-file-label2").addClass("selected").html(fileName2);
                            $("#input_file_prdes1").val(fileName2);
                          });

                          function readURL(input) {
                            if (input.files && input.files[0]) {
                              var reader = new FileReader();
                              reader.readAsDataURL(input.files[0]);
                            }
                          }

                          $("#customFilePrDes1").change(function () {
                              readURL($('#customFilePrDes1').val());
                          });
                        </script> --}}
                      </div>
                    </div>
                  </div>
                  <div class="row row_data" style="margin-top: 0.1rem;">
                    <div class="col-lg-3 col-md-3 col-sm-3">
                      <div class="margin_t "><span>補足説明</span></div>
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-9">
                      <div class="outer row">
                        <div class="col-lg-12 col-md-12 col-sm-12 ">
                          <div class="form-group " style="white-space: normal;margin-top: 4px;">
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
                        <div class="col-lg-3 col-md-3 col-sm-3 ">
                            <div class="custom-arrow">
                                <select class="form-control" id="insert_datatxt0096" name="datatxt0096" style="width: 95px!important; border:1px solid #e1e1e1 !important;border-radius: 0.25rem!important;">
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
