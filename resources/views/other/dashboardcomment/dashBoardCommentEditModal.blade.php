<!-- =============== Edit modal start ================ -->
<form id="editForm" action="{{ route('postEditDashboardComment',[$bango]) }}" method="post"
  data-editmethod="editDashboardComment"
  onsubmit="editDashboardComment('{{route("postEditDashboardComment",[$bango])}}');event.preventDefault();"
  enctype='multipart/form-data'>
  @csrf
  <input type="hidden" name="type" value="edit">
  <input type="hidden" id="hiddenSyouhinbango" name="syouhinbango" value="">
  <input type="hidden" id="hiddenSitehinban" name="sitehinban" value="">
  <div class="modal" id="dashboard_comments_modal3" data-keyboard="false" data-focus="false" data-backdrop="static"
    tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog " style="max-width: 900px!important;" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title font-weight-bold" id="exampleModalLabel">インフォメーション</h5>
          <span class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </span>
        </div>
        <div class="modal-body" data-bind="nextFieldOnEnter:true">
          <div class="development_page_top_table heading_mt">
            <div class="row">
              <div class="col-lg-12" style="">

                {{-- Error Message Starts Here --}}
                <div id="error_dataEdit" style="margin-left: -7px !important;padding-left:0px!important; margin-bottom: 10px;"></div>
                {{-- Error Message Ends Here --}}
              </div>
            </div>
            <div class="row titlebr" style="margin-bottom: 15px;">

              <div class="col-lg-2" style="">
                変更(処理状況)

              </div>
              <div class="col-lg-4">
                <div class="radio-rounded custom-table-oh">
                  <div class="custom-control custom-radio custom-control" style="padding-left:11px!important;">
                    <input type="radio" class="custom-control-input" id="edit_yukouflag1" name="yukouflag" value="1"
                      autofocus="">
                    <label class="custom-control-label" for="edit_yukouflag1"
                      style="font-size: 12px!important;cursor:pointer;">LAMU システムに関するお知らせ</label>
                  </div>
                  <div class="custom-control custom-radio custom-control-inline" style="padding-left:11px!important;">
                    <input type="radio" class="custom-control-input" id="edit_yukouflag2" name="yukouflag" value="2"
                      checked>
                    <label class="custom-control-label" for="edit_yukouflag2"
                      style="font-size: 12px!important;cursor:pointer;"> その他のお知らせ</label>
                  </div>

                </div>
              </div>
              <div class="col-lg-6" style="">
                <table class="dev_tble_button" style="float: right;">
                  <tbody>
                    <tr class="marge_in">
                      <!-- <td class="">
                            <button class="btn btn-info scroll" style="background-color: #3e6ec1!important;" data-toggle="modal" data-target="#"><i class="fa fa-trash" style="margin-right: 7px;">
                            </i>削除
                            </button>
                        </td> -->
                      @if($tantousya->innerlevel <= 10)
                        <td>
                          <a class="btn btn-info scroll custom_button" id="deleteThis" style="background-color: #3e6ec1!important;" data-toggle="modal" data-target="#" onclick="deleteDashboardCommentMaster('{{route('clearDashboardCommentSetting',[$bango])}}')">
                            <i class="fa fa-trash" style="margin-right: 7px;"></i>削除
                          </a>
                        </td>
                        @if($deleted_item )
                        <td>
                          <a class="btn btn-info scroll custom_button_120" onclick="returnDashboardCommentMaster('{{route('clearDashboardCommentSetting',[$bango,1])}}')" id="btnRestore" style="">データを戻す</a>
                        </td>
                        @endif
                      @endif
                        {{-- </td> --}}
                        <td>
                          <!-- <button autofocus="" class="btn btn-info scroll" id="" style="" data-toggle="modal" data-target="#product_sub_modal3"> <i class="fas fa-save" style="margin-right: 5px;"></i>保存 </button> -->
                          <button href="#" id="editButton" type="submit" class="btn btn-info scroll custom_button">
                            <i class="fa fa-save" aria-hidden="true" style="margin-right: 5px;"></i>登録
                          </button>
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
                                <input type="text" id="edit_sitesyubetsu" name="sitesyubetsu" class="form-control"
                                  value="">
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
                                <input type="text" name="kinsyousu" class="form-control" id="edit_kinsyousu"
                                  onchange="editDashboardComment('{{route("postEditDashboardComment",[$bango])}}','kinsyousu')"
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
                                <input type="text" name="kinsyousetteisu" class="form-control" id="edit_kinsyousetteisu"
                                  onchange="editDashboardComment('{{route("postEditDashboardComment",[$bango])}}','kinsyousetteisu')"
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
              <textarea id="ckeditor2" name="status2">

                </textarea>
              <input type="hidden" name="status" id="edit_status" value="">
              <input type="hidden" name="status_validate" id="edit_status_validate" value="">
            </div>
          </div>
          <div class="row mt-1 mb-3">
            <div class="col-lg-12">
              <div class="tbl_name">
                <div class="w-100">
                  <!-- <div class=" row row_data">
                      <div class="col-lg-3 mb-2 mt-2">
                        <button disabled class="btn btn-info" style="" data-toggle="modal" data-target="#"><i class="fa fa-plus" style="margin-right: 7px;">
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
                            <input name="hanbaimode" id="edit_file_das" type="text" class="input_field form-control" style="background:#fff;">
                            <input name="old_hanbaimode" id="old_hanbaimode" type="hidden"
                              class="input_field form-control">
                          </div>
                        </div>
                        <div class="col-5 d-flex justify-content-end">
                          <div class="input-file-container1">
                            <div class="custom-file mb-3">
                              <input type="file" accept="image/png, image/jpeg, application/pdf"
                                class="custom-file-input_das2" id="customFile" name="filename">
                              <a href="#">
                                <label tabindex="0" class="input-file-trigger btn btn-info custom_button" for="customFile" style="margin: 0;">
                                  <i class="fa fa-search" aria-hidden="true" style="margin-right: 5px;"></i>参照
                                </label>
                              </a>
                            </div>
                          </div>
                          <div style="margin-right: 48px;">
                            <button onclick="removeFile()" type="button" class="btn btn-info custom_button ml-2"
                              data-toggle="modal" data-target="#">
                              <i class="fa fa-trash" style="margin-right: 7px;"></i>削除
                            </button>
                          </div>
                          <div id="editorText2" style="font-size: 12px !important;">0文字</div>
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
  $(".custom-file-input_das2").on("change", function () {
        var fileName = $(this).val().split("\\").pop();
        $("#dashboard_comments_modal3").find('#edit_file_das').val(fileName);
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        // $("#employee_modal3").find('#inpemp2').val(fileName)
        $("#edit_file_das").trigger("keyup");
      });

      function removeFile(){
        var fileName = "";
        $("#edit_file_das").val(fileName);
        $('#editForm #edit_file_das').removeClass("error");
        e = $.Event('keyup');
        e.keyCode= 13; // enter
        $('#edit_file_das').trigger(e);
      }
</script>
<!-- =============== Edit modal end ================ -->
