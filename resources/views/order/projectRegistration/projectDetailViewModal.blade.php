<div class="modal custom-modal" data-keyboard="false" data-backdrop="static" id="project_detail_modal" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="max-width: 600px !important;" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" style="font-weight: 600;letter-spacing: 1px";>プロジェクト登録</h5>
          <span type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
          </span>
        </div>
        <div class="modal-body" data-bind="nextFieldOnEnter:true" style="color: #fff;">
          <div class="development_page_top_table heading_mt" style="margin:11px;margin-left: 0px;">
            <!--======================= button start ======================-->
            <div class="row titlebr" style="margin-bottom: 15px;">

                <!-- Error Message Starts Here -->
                <div class="col-12">
                  <div id="detail_project_error_data" style="margin-left: -14px;"></div>
                </div>
                <!-- Error Message Ends Here -->

                <div class="col-lg-12">
                    <div style="display: inline;">
                        <div style="float:left;">
                            <span>処理状況：詳細</span>
                           </div>
                      <div style="float: right;">
                        <table class="dev_tble_button" style="float: right;">
                            <tbody>
                              <tr class="marge_in">
                                 @if($tantousya->innerlevel <= 10) <td class="">
                                <td class="" style="padding-right: 5px!important;">
                                  <button id="deleteThis" onclick="deleteProjectRegistration('{{route('deleteOrReturnProject',[$bango])}}')" class="btn btn-info scroll" autofocus=""  data-toggle="modal"
                                    data-target="#"><i class="fa fa-trash" style="margin-right: 7px;">
                                  </i>削除</button>
                                </td>
                                @endif
                                <td class="">
                                  <button class="btn btn-info scroll" id="projectButton3" data-toggle="modal"
                                    data-target="#project_edit_modal"><i class="fa fa-pencil-square-o" aria-hidden="true"
                                    style="margin-right: 5px;"></i>変更画面へ</button>
                                </td>
                                @if($deleted_item )
                                <td class="">
                                  <a class="btn btn-info scroll" onclick="returnProjectRegistration('{{route('deleteOrReturnProject',[$bango,1])}}')" id="btnRestore" style="">データを戻す</a>
                                </td>
                                @endif
                                <!--  <td class="td_button_p">
                                  <a class="btn btn-info scroll" style="background-color: #4D82C6
                                  !important;border: 1px solid #4D82C6 !important;"><i class="fa fa-print" aria-hidden="true"
                                      style="margin-right: 5px;"></i>印刷</a>
                                  </td> -->
                              </tr>
                            </tbody>
                          </table>
                      </div>
                    </div>
                  </div>
            </div>
            <!--======================= button  end ======================-->
          </div>
          <!--======================= modal 2 table start here ======================-->
          <div class="row mt-1 mb-3">
            <div class="col-lg-12 col-md-12 col-sm-12">
              <div class="tbl_name">
                <div class="w-100">
                  <div class="row form-group">
                    <div class="col-lg-4 col-md-4 col-sm-4">
                      <div class="">
                        <div class="line-icon-box"></div>
                          プロジェクト番号<span style="color: red;">※</span>
                      </div>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-8">
                      <div class="outer row">
                        <div class="col-lg-6 col-md-6 col-sm-6">
                          <div id="detail_url"></div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row form-group">
                    <div class="col-lg-4 col-md-4 col-sm-4">
                      <div class="">
                        <div class="line-icon-box"></div>
                          プロジェクト名称<span style="color: red;">※</span>
                      </div>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-8">
                      <div class="outer row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                          <div id="detail_urlsm" style="white-space: normal; word-break: break-all;"></div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row form-group">
                    <div class="col-lg-4 col-md-4 col-sm-4">
                      <div class="">
                        <div class="line-icon-box"></div>
                          受注先<span style="color: red;">※</span>
                      </div>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-8">
                      <div class="outer row">
                        <div class="col-lg-6 col-md-6 col-sm-6">
                          <div id="detail_catchsm"></div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row form-group">
                    <div class="col-lg-4 col-md-4 col-sm-4">
                      <div class="">
                        <div class="line-icon-box"></div>
                          最終顧客<span style="color: red;"></span>
                      </div>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-8">
                      <div class="outer row">
                        <div class="col-lg-6 col-md-6 col-sm-6">
                          <div id="detail_caption"></div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row form-group">
                    <div class="col-lg-4 col-md-4 col-sm-4">
                      <div class="">
                        <div class="line-icon-box"></div>
                          営業<span style="color: red;">※</span>
                      </div>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-8">
                      <div class="outer row">
                        <div class="col-lg-6 col-md-6 col-sm-6">
                          <div id="detail_setumei"></div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row form-group">
                    <div class="col-lg-4 col-md-4 col-sm-4">
                      <div class="">
                        <div class="line-icon-box"></div>
                          SE<span style="color: red;"></span>
                      </div>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-8">
                      <div class="outer row">
                        <div class="col-lg-6 col-md-6 col-sm-6">
                          <div id="detail_catch"></div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row form-group">
                    <div class="col-lg-4 col-md-4 col-sm-4">
                      <div class="">
                        <div class="line-icon-box"></div>
                          開始年月～終了年月<span style="color: red;"></span>
                      </div>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-8">
                      <div class="outer row">
                        <div class="col-lg-6 col-md-6 col-sm-6">
                          <div id="detail_mbcatch_mbcatchsm"></div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row form-group">
                    <div class="col-lg-4 col-md-4 col-sm-4">
                      <div class="">
                        <div class="line-icon-box"></div>
                          備考<span style="color: red;"></span>
                      </div>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-8">
                      <div class="outer row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                          <div id="detail_mbcaption" style="white-space: normal !important; word-break: break-all !important;"></div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!--======================= modal 2 table end here ======================-->
        </div>
        <div class="modal-footer">
        </div>
        <script type="text/javascript">
          //Tab first field focus....
          $(document).on('shown.bs.modal', function(e) {
            $('[autofocus]', e.target).focus();
          });
        </script>
      </div>
    </div>
</div>
