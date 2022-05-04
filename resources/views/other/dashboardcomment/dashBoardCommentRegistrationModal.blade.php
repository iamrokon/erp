<!-- ================= Regiatration Modal start ================== -->

<form id="registrationForm" action="{{ route('postEditDashboardComment',[$bango]) }}" method="post"
  data-regmethod="registerDashboardComment" enctype='multipart/form-data'>
  @csrf
  <input type="hidden" name="type" value="create">
  <div class="modal" data-keyboard="false" data-focus="false" data-backdrop="static" id="dashboard_modal1" tabindex="-1"
    role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog " style="max-width: 900px!important;" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title font-weight-bold" id="exampleModalLabel">インフォメーション</h5>
          <span class="close" id="regClose" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </span>
        </div>
        <div class="modal-body " data-bind="nextFieldOnEnter:true">
          <div class="development_page_top_table heading_mt">
            <div class="row">
              <div class="col-lg-12" style="">
                {{-- Error Message Starts Here --}}
                <div id="error_data" style="margin-left: -7px !important; padding-left:0px!important; margin-bottom: 10px;"></div>
                {{-- Error Message Ends Here --}}
              </div>

            </div>
            <div class="row titlebr" style="margin-bottom: 15px;">
              <div class="col-lg-2" style="">
                新規（処理状況）
              </div>
              <div class="col-lg-4">

                <div class="radio-rounded custom-table-oh">
                  <div class="custom-control custom-radio custom-control" style="padding-left:11px!important;">
                    <input type="radio" class="custom-control-input" id="insert_yukouflag1" name="yukouflag"
                      autofocus="" value="1" checked="">
                    <label class="custom-control-label" for="insert_yukouflag1"
                      style="font-size: 12px!important;cursor:pointer;">LAMU システムに関するお知らせ</label>
                  </div>
                  <div class="custom-control custom-radio custom-control-inline" style="padding-left:11px!important;">
                    <input type="radio" class="custom-control-input" id="insert_yukouflag2" name="yukouflag" value="2">
                    <label class="custom-control-label" for="insert_yukouflag2"
                      style="font-size: 12px!important;cursor:pointer;"> その他のお知らせ</label>
                  </div>

                </div>
              </div>
              <div class="col-lg-6" style="">
                <table class="dev_tble_button" style="float: right;">
                  <tbody>
                    <tr class="marge_in">
                      <td class="">
                        <button name="insert" type="button" class="btn btn-info scroll custom_button"
                          onclick="registerDashboardComment('{{route("postEditDashboardComment",[$bango])}}');" id="regButton">
                          <i class="fa fa-save" aria-hidden="true" style="margin-right: 5px;"></i>登録
                        </button>
                        <!-- <button autofocus="" class="btn btn-info scroll" id="" style="" data-toggle="modal" data-target="#product_sub_modal3">登録 </button> -->
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <!--======================= button  end ======================-->
            </div>
          </div>
          <div class="row mt-1 mb-3">
            <div class="col-lg-12">
              <div class="tbl_name">
                <div class="w-100">
                  <div class="row row_data">
                    <div class="col-lg-7">
                      <table class="table custom-form" style="border: none!important;">
                        <tbody>
                          <tr>
                            <td style="width: 23px!important;padding: 0!important;border:0!important;">
                              <div class="line-icon-box"></div>
                            </td>
                            <td style="border: none!important;width: 66px!important;">タイトル</td>
                            <td style="border: none!important;">
                              <div class="input-group">
                                <input type="text" name="sitesyubetsu" id="insert_sitesyubetsu" class="form-control">
                              </div>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>

                  <div class="row row_data">
                    <div class="col-lg-5 col-md-6">
                      <table class="table custom-form custom-table" style="border: none!important;">
                        <tbody>
                          <tr>
                            <td style="width: 23px !important;padding: 0!important;border:0!important;">
                              <div class="line-icon-box"></div>
                            </td>
                            <td style="border: none!important;width: 66px !important;">掲載開始日</td>
                            <td style="border: none!important; ">

                              <div class="input-group">
                                <input type="text" name="kinsyousu" class="form-control input_field"
                                  id="insert_kinsyousu"
                                  oninput="this.value = this.value.replace(/[^\d^\/]/g, '').replace(/([\d]{4}\/?)([\d]{2}\/?)([\d]{2})/g, '$1$2$3').replace(/([\d]{8})([\d]{1,2})?/g, '$1');"
                                  onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))"
                                  maxlength="10" autocomplete="off" placeholder="年/月/日" style="width: 96px!important;"
                                  value="">
                                <input type="hidden" class="datePickerHidden">
                              </div>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>

                    <div class="col-lg-5 col-md-6">
                      <table class="table custom-form" style="border: none!important;">
                        <tbody>
                          <tr>
                            <td style="width: 23px !important;padding: 0!important;border:0!important;">
                              <div class="line-icon-box"></div>
                            </td>
                            <td style="border: none!important;width: 66px !important;">掲載終了日</td>
                            <td style="border: none!important;">
                              <div class="input-group">
                                <input type="text" name="kinsyousetteisu" class="form-control"
                                  id="insert_kinsyousetteisu"
                                  oninput="this.value = this.value.replace(/[^\d^\/]/g, '').replace(/([\d]{4}\/?)([\d]{2}\/?)([\d]{2})/g, '$1$2$3').replace(/([\d]{8})([\d]{1,2})?/g, '$1');"
                                  onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))"
                                  maxlength="10" autocomplete="off" placeholder="年/月/日" style="width: 96px!important;"
                                  value="">
                                <input type="hidden" class="datePickerHidden">
                              </div>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-lg-12">
              <textarea id="ckeditor1" name="status2">

                </textarea>
              <input type="hidden" name="status" id="status" value="">
              <input type="hidden" name="status_validate" id="status_validate" value="">
            </div>
          </div>
          <div class="row mt-1 mb-3">
            <div class="col-lg-12">
              <div class="tbl_name">
                <div class="w-100">
                  <!-- <div class=" row row_data">
                      <div class="col-lg-3 mb-2 mt-2">
                        <button class="btn btn-info" disabled style="" data-toggle="modal" data-target="#"><i class="fa fa-plus" style="margin-right: 7px;">
                          </i>添付ファイル追加
                        </button>
                      </div>
                    </div> -->
                  <div class="row row_data">
                    <div class="col-12 mt-2">
                      <div class="outer row">
                        <div class="col-7 mb-2">
                          <!--   <input type="text" class="form-control" value=""> -->
                          <div class="custom-form">
                            <input name="hanbaimode" id="insert_file_das" type="text" class="input_field form-control" style="background:#fff;">
                          </div>
                        </div>
                        <div class="col-5 d-flex justify-content-end">
                          <div class="input-file-container1">
                            <div class="custom-file mb-3">
                              <input type="file" accept="image/png, image/jpeg, application/pdf"
                                class="custom-file-input_das" id="customFileDas" name="filename">
                              <a href="#">
                                <label tabindex="0" class="input-file-trigger btn btn-info custom_button" for="customFileDas" style="margin: 0;">
                                  <i class="fa fa-search" aria-hidden="true" style="margin-right: 5px;"></i>参照
                                </label>
                              </a>
                            </div>
                          </div>
                          <div style="margin-right: 48px;">
                              <button onclick="removeFile1()" type="button" class="btn btn-info custom_button ml-2" data-toggle="modal" data-target="#"><i class="fa fa-trash" style="margin-right: 7px;">
                                  </i>削除
                              </button>
<!--                                <button id="deleteFile" type="button" class="btn btn-info custom_button ml-2" data-toggle="modal" data-target="#"><i class="fa fa-trash" style="margin-right: 7px;">
                                  </i>削除
                                </button>-->
                          </div>
                          <div id="editorText1" style="font-size: 12px !important;">0文字</div>
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

<script>
  $(".custom-file-input_das").on("change", function () {
      var fileName = $(this).val().split("\\").pop();
      $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
      $("#insert_file_das").val(fileName);

      $("#insert_file_das").trigger("keyup");
      //checkFrontendValidation();
    });

    function removeFile1(){
      var fileName = "";
      $("#insert_file_das").val(fileName);
      $("#customFileDas").val(fileName);
      // console.log($("#insert_file_das").val());
      $('#registrationForm #insert_file_das').removeClass("error");
      e = $.Event('keyup');
      e.keyCode= 13; // enter
      $('#insert_file_das').trigger(e);
    }
  /*$("#deleteFile").on('click', function() {
      console.log($("#insert_file_das").val() != '')
      if($("#insert_file_das").val() != ''){
          $("#insert_file_das").val('');
          console.log($("#insert_file_das").val())
          $('#registrationForm #insert_file_das').removeClass("error");
          e = $.Event('keyup');
          e.keyCode= 13; // enter
          $("#insert_file_das").trigger(e);
      }
  });*/
</script>
<!-- ================= Regiatration Modal end ================== -->
