 <!-- setting modal start -->
 <div class="modal custom-modal fade" data-keyboard="false" data-backdrop="static" id="setting_display_modal"
 tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
 <div class="modal-dialog modal-dialog-centered" role="document" style="">
   <div class="modal-content" data-bind="nextFieldOnEnter:true">
     <div class="modal-header">
       <h6 class="modal-title" id="exampleModalLabel"></h6>
       <span type="button" class="close" data-dismiss="modal" aria-label="Close">
         <span aria-hidden="true">×</span>
       </span>
     </div>
     <div class="modal-body">
       <div class="row">
         <div class="col-lg-4">
           <button autofocus="" class="checkall btn btn-info" style="margin-bottom: 10px;">全選択</button>
           <button class="uncheck btn btn-info" style="margin-bottom: 10px;">全解除</button>
         </div>
         <div class="col-lg-4">
         </div>
         <div class="col-lg-4">
           <button class="btn btn-info " style="margin-bottom: 10px;float: right;">デフォルト</button>
         </div>
       </div>
       <div class="row">
         <div class="col-lg-12">
           <div class="table-responsive setting_header">
             <table class="table modal-table-blue line-transparent table-bordered">
               <tbody class="">
                 <tr>
                   <td>
                     <div class="custom-control custom-checkbox custom-control-inline">
                       <input type="checkbox" id="th1" class="custom-control-input customCheckBox" checked>
                       <label class="custom-control-label margin_btn_17" for="th1"></label>
                     </div>
                   </td>
                   <td style="width:60px!important;">
                     <input type="tel" class="form-control" value="0"
                       onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                   </td>
                   <td class="text-left">
                     <span class="mt-1 text-left">売上請求先CD</span>
                   </td>
                 </tr>
                 <tr>
                   <td>
                     <div class="custom-control custom-checkbox custom-control-inline">
                       <input type="checkbox" id="th2" class="custom-control-input customCheckBox" checked="">
                       <label class="custom-control-label margin_btn_17" for="th2"></label>
                     </div>
                   </td>
                   <td style="width:60px!important;">
                     <input type="tel" class="form-control" value="1"
                       onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                   </td>
                   <td class="text-left">
                     <span class="mt-1 text-left">売上請求先</span>
                   </td>
                 </tr>
                 <tr>
                   <td>
                     <div class="custom-control custom-checkbox custom-control-inline">
                       <input type="checkbox" id="th3" class="custom-control-input customCheckBox" checked="">
                       <label class="custom-control-label margin_btn_17" for="th3"></label>
                     </div>
                   </td>
                   <td style="width:60px!important;">
                     <input type="tel" class="form-control" value="2"
                       onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                   </td>
                   <td class="text-left">
                     <span class="mt-1 text-left">前回請求額</span>
                   </td>
                 </tr>
                 <tr>
                   <td>
                     <div class="custom-control custom-checkbox custom-control-inline">
                       <input type="checkbox" id="th4" class="custom-control-input customCheckBox" checked="">
                       <label class="custom-control-label margin_btn_17" for="th4"></label>
                     </div>
                   </td>
                   <td style="width:60px!important;">
                     <input type="tel" class="form-control" value="3"
                       onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                   </td>
                   <td class="text-left">
                     <span class="mt-1 text-left">現金入金額</span>
                   </td>
                 </tr>
                 <tr>
                   <td>
                     <div class="custom-control custom-checkbox custom-control-inline">
                       <input type="checkbox" id="th5" class="custom-control-input customCheckBox">
                       <label class="custom-control-label margin_btn_17" for="th5"></label>
                     </div>
                   </td>
                   <td style="width:60px!important;">
                     <input type="tel" class="form-control"
                       onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                   </td>
                   <td class="text-left">
                     <span class="mt-1 text-left">手形入金</span>
                   </td>
                 </tr>
                 <tr>
                   <td>
                     <div class="custom-control custom-checkbox custom-control-inline">
                       <input type="checkbox" id="th6" class="custom-control-input customCheckBox">
                       <label class="custom-control-label margin_btn_17" for="th6"></label>
                     </div>
                   </td>
                   <td style="width:60px!important;">
                     <input type="tel" class="form-control"
                       onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                   </td>
                   <td class="text-left">
                     <span class="mt-1 text-left">今回値引他</span>
                   </td>
                 </tr>
                 <tr>
                   <td>
                     <div class="custom-control custom-checkbox custom-control-inline">
                       <input type="checkbox" id="th7" class="custom-control-input customCheckBox">
                       <label class="custom-control-label margin_btn_17" for="th7"></label>
                     </div>
                   </td>
                   <td style="width:60px!important;">
                     <input type="tel" class="form-control"
                       onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                   </td>
                   <td class="text-left">
                     <span class="mt-1 text-left">今回繰越額</span>
                   </td>
                 </tr>
                 <tr>
                   <td>
                     <div class="custom-control custom-checkbox custom-control-inline">
                       <input type="checkbox" id="th8" class="custom-control-input customCheckBox">
                       <label class="custom-control-label margin_btn_17" for="th8"></label>
                     </div>
                   </td>
                   <td style="width:60px!important;">
                     <input type="tel" class="form-control"
                       onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                   </td>
                   <td class="text-left">
                     <span class="mt-1 text-left">今回売上額</span>
                   </td>
                 </tr>
                 <tr>
                   <td>
                     <div class="custom-control custom-checkbox custom-control-inline">
                       <input type="checkbox" id="th9" class="custom-control-input customCheckBox">
                       <label class="custom-control-label margin_btn_17" for="th9"></label>
                     </div>
                   </td>
                   <td style="width:60px!important;">
                     <input type="tel" class="form-control"
                       onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                   </td>
                   <td class="text-left">
                     <span class="mt-1 text-left">今回消費税</span>
                   </td>
                 </tr>
                 <tr>
                   <td>
                     <div class="custom-control custom-checkbox custom-control-inline">
                       <input type="checkbox" id="th11" class="custom-control-input customCheckBox">
                       <label class="custom-control-label margin_btn_17" for="th11"></label>
                     </div>
                   </td>
                   <td style="width:60px!important;">
                     <input type="tel" class="form-control"
                       onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                   </td>
                   <td class="text-left">
                     <span class="mt-1 text-left">今回請求額</span>
                   </td>
                 </tr>
                 <tr>
                   <td>
                     <div class="custom-control custom-checkbox custom-control-inline">
                       <input type="checkbox" id="th12" class="custom-control-input customCheckBox">
                       <label class="custom-control-label margin_btn_17" for="th12"></label>
                     </div>
                   </td>
                   <td style="width:60px!important;">
                     <input type="tel" class="form-control"
                       onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                   </td>
                   <td class="text-left">
                     <span class="mt-1 text-left">即時請求額</span>
                   </td>
                 </tr>
                 <tr>
                   <td>
                     <div class="custom-control custom-checkbox custom-control-inline">
                       <input type="checkbox" id="th13" class="custom-control-input customCheckBox">
                       <label class="custom-control-label margin_btn_17" for="th13"></label>
                     </div>
                   </td>
                   <td style="width:60px!important;">
                     <input type="tel" class="form-control"
                       onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                   </td>
                   <td class="text-left">
                     <span class="mt-1 text-left">即時請求税</span>
                   </td>
                 </tr>
               </tbody>
             </table>
           </div>
         </div>
       </div>
     </div>
     <div class="modal-footer">
       <button type="button" class="btn btn-info" data-dismiss="modal"><i class="fas fa-save"
           style="margin-right: 5px;"></i>保存 </button>
     </div>
   </div>
 </div>
</div>
<!-- setting modal end -->
  <!-- office modal 4 -->
  <div class="modal custom-modal" data-backdrop="static" id="search_modal4" role="dialog"
    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content" data-bind="nextFieldOnEnter:true">
        <div class="modal-header" style="height: 68px;padding: 23px 28px;">
          <h5 class="modal-title">取引先</h5>
          <span class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </span>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-lg-6">
              <div>
                <table class="table" style="border: none!important;width: auto; margin-bottom: 0px !important;">
                  <tbody>
                    <tr>
                      <td style="width: 23px!important;padding: 0!important;border:0!important;">
                        <div class="line-box-icon mr-3"></div>
                      </td>
                      <td style=" border: none!important;width: 40px!important;color: #fff;">検索（絞込）</td>
                      <td style=" width: 100%; border: none!important;padding-right: 0px !important;"><input type="text"
                          autofocus class="form-control" id="lastname" placeholder="検索ワード"
                          style="border-top-left-radius: 4px !important;border-bottom-left-radius: 4px !important;">
                      </td>
                      <td style=" border: none!important;"><button type="button"
                          class="btn bg-teal text-white btn_search" id="searchButton"
                          style="border-radius: 0px;margin-left: -6px;"><i class="fas fa-search"></i>
                        </button>
                      </td>
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
            <div class="d-flex align-items-center">
              <div style="font-size: 14px; color: #ff0000;">
                Error Message...
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-6">
              <div class="table_wrap">
                <div class=" page4_table_design mt-2  table_hover  table-head-only">
                  <div id="initial_content">
                    <div class="border-line"></div>
                    <h4 style="margin-bottom: 15px;margin-top: 10px;"><span class="ml-2">会社マスタ　（会社CD/会社名）</span></h4>
                    <div class="modal-table-white" style="height: 160px;width: 100%;cursor: pointer;">
                      <div class="first-table">
                        <table class="table" id="table-basic">
                          <tbody class="">
                            <tr class=" show_office_master_info table_hover2 grid">
                              <td>999999</td>
                              <td>株式会社サンプル</td>
                            </tr>
                            <tr class=" show_office_master_info table_hover2 gridAlternada">
                              <td style="width: 50px;">999999</td>
                              <td> 株式会社サンプル </td>
                            </tr>
                            <tr class=" show_office_master_info table_hover2 grid">
                              <td style="width: 50px;">999999 </td>
                              <td> 株式会社サンプル
                              </td>
                            </tr>
                            <tr class=" show_office_master_info table_hover2 gridAlternada ">
                              <td style="width: 50px;">999999</td>
                              <td>株式会社サンプル
                              </td>
                            </tr>
                            <tr class=" show_office_master_info table_hover2 gridAlternada ">
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
                    <h4 style="margin-bottom: 15px;margin-top: 15px;">事業所マスタ　（事業所CD/事業所名）</h4>
                    <div class="modal-table-white" style="height: 112px;width: 100%;cursor: pointer;">
                      <div class="second-table">
                        <table class="table ">
                          <thead class="header text-center" id="myHeader">
                          </thead>
                          <tbody>
                            <tr class="show_personal_master_info">
                              <td>01</td>
                              <td>北海道支社</td>
                              <td>北海道札幌市中央区北1…</td>
                            </tr>
                            <tr class="show_personal_master_info">
                              <td style="width:50px;">02</td>
                              <td>東北支社</td>
                              <td>宮城県仙台市青葉区…</td>
                            </tr>
                            <tr class="show_personal_master_info">
                              <td style="width:50px;">03</td>
                              <td>東京本社
                              </td>
                              <td>東京都中央区銀座…</td>
                            </tr>
                            <tr class="show_personal_master_info">
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
                  <div id="personal_master_content_div">
                    <h4 style="margin-bottom: 15px; margin-top: 10px;">個人マスタ　（個人CD/名称）</h4>
                    <div class=" modal-table-white" style="width: 100%; height: 84px;cursor: pointer;">
                      <div class="third-table">
                        <table class="table">
                          <tbody>
                            <tr class="show_content_last">
                              <td>001</td>
                              <td>鈴木　一郎</td>
                              <td>経営企画部</td>
                            </tr>
                            <tr class="show_content_last">
                              <td style="width:50px;">002</td>
                              <td>田中　二郎</td>
                              <td>営業部</td>
                            </tr>
                            <tr class="show_content_last">
                              <td style="width:50px;">003</td>
                              <td>山田　三郎</td>
                              <td>総務部</td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-6">
              <div id="office_content_div_last" style="margin-top: 38px;">
                <div style="width: 99%;">
                  <div class="heading">
                  </div>
                  <h4 class="b-color" style="margin-bottom: 15px;margin-top: 10px;"> 取引先情報</h4>
                  <table class="table modal-table-blue" id="table-basic">
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
            <div class="col-lg-6">
            </div>
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
        <div class="modal-footer pl-4 pr-4">
          <button type="button" id="" class="btn text-white w-145 bg-default" data-dismiss="modal"> <i class=""
              aria-hidden="true" style="margin-right: 5px;"></i>キャンセル
          </button>
          <button type="button" id="choice_button" class="btn w-145 bg-teal2 text-white ml-2" data-dismiss="modal">入力する
          </button>
        </div>
      </div>
    </div>
  </div>
  <!-- pop up modal end here -->