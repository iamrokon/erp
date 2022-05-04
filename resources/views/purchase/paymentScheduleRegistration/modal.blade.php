
  <!-- Search modal starts Here -->
  <div class="modal custom-modal" data-backdrop="static" id="search_modal4" role="dialog"
    aria-labelledby="exampleModalCenterTitle" aria-hidden="true" style="padding-right:0px !important;">
    <div class="modal-dialog" role="document" style="max-width: 1330px!important;overflow-x: visible;width: 1330px;">
      <div class="modal-content" data-bind="nextFieldOnEnter:true">

        <div class="modal-header" style="height: 68px;padding: 23px 28px;">
          <h5 class="modal-title">取引先</h5>
          <span class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </span>
        </div>

        <div class="modal-body" style="padding: 0px 29px 0px 30px;">
          <div class="row">
            <div class="col-6 pr-0">
              <div style="height:90px;padding:29px 0px;">
                <table class="table" style="border: none!important;width: auto;margin-bottom:0px !important;">
                  <tbody>
                    <tr>
                      <td style="width: 23px!important;padding: 0!important;border:0!important;">
                        <div class="line-box-icon mr-3"></div>
                      </td>
                      <td style=" border: none!important;width: 40px!important;color: #fff;">検索（絞込）</td>
                      <td style=" width: 100%; border: none!important;"><input type="text" autofocus
                          class="form-control" id="lastname" placeholder="検索ワード"
                          style="border-top-left-radius: 4px !important;border-bottom-left-radius: 4px !important;">
                      </td>
                      <td style=" border: none!important;">
                        <button type="button" class="btn text-white btn_search" id="searchButton"
                          style="border-radius: 0px;margin-left: -6px;"><i class="fas fa-search"></i>
                        </button></td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <script type="text/javascript">
                $(function () {
                  $('.show_office_master_info').click(function (event) {
                    $('.show_office_master_info').not(this).removeClass('add_border');
                    $(this).addClass('add_border');
                    $("#office_master_content_div").show();
                  });
                });
              </script>
            </div>
            <div class="col-6">
              <div
                style="margin-left:15px;background: #aec7e7;font-size: 14px;color: #000;line-height: 27px;padding: 0px 10px;margin-top:32px;">
                検索結果に該当するデータがありません
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-6 pr-0">
              <div class="table_wrap">
                <div class=" page4_table_design table_hover  table-head-only">

                  <div id="initial_content">
                    <div class="border-line" style="margin-bottom:0px;"></div>
                    <div style="height:77px;padding:29px 0px;">
                      <h4><span class="ml-2">会社マスタ　（会社CD/会社名）</span></h4>
                    </div>
                    <div class="modal-table-white search-scroll"
                      style="height: 225px;width: 100%;cursor: pointer;overflow-y:scroll">
                      <div class="first-table">
                        <table class="table" id="table-basic">
                          <tbody class="">
                            <tr tabindex="0" class=" show_office_master_info table_hover2 grid trfocus"
                              style="height:40px;">
                              <td>999999</td>
                              <td>株式会社サンプル</td>
                            </tr>
                            <tr tabindex="0" class=" show_office_master_info table_hover2 gridAlternada trfocus"
                              style="height:40px;">
                              <td style="width: 50px;">999999</td>
                              <td> 株式会社サンプル </td>
                            </tr>
                            <tr tabindex="0" class=" show_office_master_info table_hover2 grid trfocus"
                              style="height:40px;">
                              <td style="width: 50px;">999999 </td>
                              <td> 株式会社サンプル
                              </td>
                            </tr>
                            <tr tabindex="0" class=" show_office_master_info table_hover2 gridAlternada trfocus "
                              style="height:40px;">

                              <td style="width: 50px;">999999</td>
                              <td>株式会社サンプル
                              </td>

                            </tr>
                            <tr tabindex="0" class=" show_office_master_info table_hover2 gridAlternada trfocus "
                              style="height:40px;">

                              <td style="width: 50px;">999999</td>
                              <td>株式会社サンプル
                              </td>

                            </tr>
                            <tr tabindex="0" class=" show_office_master_info table_hover2 gridAlternada trfocus "
                              style="height:40px;">

                              <td style="width: 50px;">999999</td>
                              <td>株式会社サンプル
                              </td>

                            </tr>
                            <tr tabindex="0" class=" show_office_master_info table_hover2 gridAlternada trfocus "
                              style="height:40px;">

                              <td style="width: 50px;">999999</td>
                              <td>株式会社サンプル
                              </td>

                            </tr>
                            <tr tabindex="0" class=" show_office_master_info table_hover2 gridAlternada trfocus "
                              style="height:40px;">

                              <td style="width: 50px;">999999</td>
                              <td>株式会社サンプル
                              </td>

                            </tr>
                            <tr tabindex="0" class=" show_office_master_info table_hover2 gridAlternada trfocus "
                              style="height:40px;">

                              <td style="width: 50px;">999999</td>
                              <td>株式会社サンプル
                              </td>

                            </tr>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                  <script type="text/javascript">
                    $(function () {
                      $('#searchButton').click(function (event) {
                        $("#initial_content").show();
                      });
                    });
                  </script>

                  <div id="office_master_content_div">
                    <!-- 2nd modal content -->
                    <div style="height:75px;padding:29px 0px;">
                      <h4 style=""> 事業所マスタ &nbsp;&nbsp;&nbsp;(事業所CD/事業所名/住所)</h4>
                    </div>
                    <div class="modal-table-white" style="height: 164px;width: 100%;cursor: pointer;">
                      <div class="second-table">
                        <table class="table ">
                          <thead class="header text-center" id="myHeader">

                          </thead>
                          <tbody>
                            <tr tabindex="0" class="show_personal_master_info trfocus" style="height: 40px;">
                              <td>01</td>
                              <td>北海道支社</td>
                              <td>北海道札幌市中央区北1…</td>
                            </tr>
                            <tr tabindex="0" class="show_personal_master_info trfocus" style="height: 40px;">
                              <td style="width:50px;">02</td>
                              <td>東北支社</td>
                              <td>宮城県仙台市青葉区…</td>
                            </tr>

                            <tr tabindex="0" class="show_personal_master_info trfocus" style="height: 40px;">
                              <td style="width:50px;">03</td>
                              <td>東京本社
                              </td>
                              <td>東京都中央区銀座…</td>
                            </tr>
                            <tr tabindex="0" class="show_personal_master_info trfocus" style="height: 40px;">
                              <td style="width:50px;">04</td>
                              <td>大阪支社
                              </td>
                              <td>大阪府高槻市…</td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-6">
              <div id="office_content_div_last" style="margin-top: 33px;padding-left:17px;">
                <div>
                  <div class="heading"></div>
                  <h4 class="b-color" style="margin-bottom: 25px;margin-top: 10px;"> 取引先情報</h4>
                  <table class="table modal-table-blue" id="table-basic"
                    style="height:665px;margin-bottom:0px !important;">
                    <tbody>
                      <tr>
                        <td style="width: 112px;">番号</td>
                        <td style="width: 300px;"> 99999999999</td>
                      </tr>
                      <tr>
                        <td style="width: 112px;">会社名</td>
                        <td style="width: 300px;">株式会社サンプル </td>
                      </tr>
                      <tr>
                        <td style="width: 112px;">事業所名</td>
                        <td style="width: 300px;">東京本社</td>
                      </tr>
                      <tr>
                        <td style="width: 112px;">部署</td>
                        <td style="width: 300px;">営業部 </td>
                      </tr>
                      <tr>
                        <td style="width: 112px;">役職
                        </td>
                        <td style="width: 300px;">部長</td>
                      </tr>
                      <tr>
                        <td style="width: 112px;">氏名</td>
                        <td style="width: 300px;"> 田中　二郎</td>
                      </tr>
                      <tr>
                        <td style="width: 112px;">メールアドレス</td>
                        <td style="width: 300px;">sample@xxxx.co.jp</td>
                      </tr>
                      <tr>
                        <td style="width: 112px;">電話番号</td>
                        <td style="width: 300px;"> 00-0000-0000</td>
                      </tr>
                      <tr>
                        <td style="width: 112px;">帝国DB信用録PDF</td>
                        <td style="width: 300px;">sample-sinyo.pdf</td>
                      </tr>
                      <tr>
                        <td style="width: 112px;">帝国DB評点</td>
                        <td style="width: 300px;">59</td>
                      </tr>
                      <tr>
                        <td style="width: 112px;">与信限度額</td>
                        <td style="width: 300px;">3,000,000／残 750,000</td>
                      </tr>
                      <tr>
                        <td style="width: 112px;">入金日</td>
                        <td style="width: 300px;">10日締 翌々月 20日</td>
                      </tr>
                      <tr>
                        <td style="width: 112px;">請求書方式</td>
                        <td style="width: 300px;">1 郵送／1 PDFメール送信</td>
                      </tr>
                      <tr>
                        <td style="width: 112px;">社内備考（会社）</td>
                        <td style="width: 300px;">社内備考</td>
                      </tr>
                      <tr style="border:none;">
                        <td class="line-title" style="border-bottom:none !important;width: 112px;height: 30px;"></td>
                        <td style="border-bottom:none !important;width: 300px;"></td>
                      </tr>
                      <tr>
                        <td class="line-title" style="border-bottom:none !important;width: 112px;height: 30px;"></td>
                        <td style="border-bottom:none !important;width: 300px;"></td>
                      </tr>
                      <tr>
                        <td class="line-title" style="border-bottom:none !important;width: 112px;height: 30px;"></td>
                        <td style="border-bottom:none !important;width: 300px;"></td>
                      </tr>
                    </tbody>
                  </table>
                </div>

              </div>

            </div>
          </div>
          <!-- 2nd modal content end -->

          <!-- 3rd modal content  -->
          <script type="text/javascript">
            $(function () {
              $('.show_personal_master_info').click(function (event) {
                $('.show_personal_master_info').not(this).removeClass('add_border');
                $(this).addClass('add_border');
                $("#personal_master_content_div").show();
              });
            });

          </script>
          <div class="row">
            <div class="col-lg-6"> </div>
            <!-- 3rd modal content end  -->
            <!-- 4th modal content end  -->
            <script type="text/javascript">
              $(function () {
                $('.show_content_last').click(function (event) {
                  $('.show_content_last').not(this).removeClass('add_border');
                  $(this).addClass('add_border');
                  $("#office_content_div_last").show();
                });
              });
            </script>
          </div>
          <!-- 4th modal content end  -->
          <!-- modal content enddd   -->

        </div>
        <div class="modal-footer pl-4 pr-4" style="height:86px;padding:32px 29px;">
          <button type="button" id="" class="btn text-white bg-teal3 uskc-button" data-dismiss="modal"> <i class=""
              aria-hidden="true" style="margin-right: 5px;"></i>親画面をクリア
          </button>
          <button type="button" id="" class="btn text-white  bg-default uskc-button" data-dismiss="modal"> <i class=""
              aria-hidden="true" style="margin-right: 5px;"></i>キャンセル
          </button>
          <button type="button" id="choice_button" class="btn  bg-teal text-white ml-2 uskc-button"
            data-dismiss="modal">
            入力する
          </button>
        </div>
      </div>
    </div>
  </div>

  <!-- Search Modal ends here -->