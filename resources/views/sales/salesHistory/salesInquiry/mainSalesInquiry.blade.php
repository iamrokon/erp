@section('title', '売上履歴一覧・売上照会')
@section('menu-test1', 'ホーム >')
@section('menu-test3', ' 売上請求 >')
@section('menu-test5', ' 売上履歴一覧・売上照会')
@section('tag-test', 'ここには、ガイドの文章が入ります。ここには、ガイドの文章が入ります。')
@section('tag-test1', 'ここには、ガイドの文章が入ります。')

<!DOCTYPE html>
<html lang="ja">
  
  <head>

  {{-- Including Common Header Starts Here --}}
  @include('layouts.header')
  {{-- Including Common Header Ends Here--}}

   {{-- Including CSS Starts Here --}}
  @include('sales.salesHistory.salesInquiry.styles')
  {{-- Including CSS Ends Here--}}

  </head>

  <body class="common-nav" style="overflow-x:visible;">
    <section class="">
      @include('layout.nav_fixed')
      <div class="fullpage_width1" data-bind="nextFieldOnEnter:true">
      <!-- ============================= Top Search start here ===================== -->
      @include('sales.salesHistory.salesInquiry.salesInquiryTopSearch')
      <!-- ============================= Top Search end here ======================= -->

      <!-- ============================= Main Content start here ===================== -->
      @include('sales.salesHistory.salesInquiry.salesInquiryMainContent')
      <!-- ============================= Main Content end here ======================= -->
      </div>
      @include('layout.footer_new')
      <form action="{{route('orderInquiry')}}" method="POST" target="_blank" id="gotoOrderInquiry_I">
        @csrf
        <input type="hidden" id="userId" name="userId" value="{{$bango}}">
        <input type="hidden" name="kokyakuorderbango" id="kokyakuorderbango_i" />
        <input type="hidden" name="ordertypebango2" id="inquiry_ordertypebango2_i" />
      </form>

    </section>
    <!-- Details modal start here -->
    <div class="modal" data-keyboard="false" data-backdrop="static" id="detailsModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" style="max-width: 700px !important;" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="development_page_top_table heading_mt" style="margin:11px;">
              <!--======================= button start ======================-->
              <div class="row titlebr" style="margin-bottom: 15px;">
                <div class="col-lg-6 pl-1" style="padding-top: 9px;">
                  <h5 class="">商品説明マスタ(詳細)</h5>
                </div>
                <div class="col-lg-6" style="">
                  {{--
                  <table class="dev_tble_button" style="float: right;">
                    <tbody>
                      <tr class="marge_in">
                        <td class="">
                          <a class="btn btn-info scroll" style="background-color: #3e6ec1!important;" data-toggle="modal"
                            data-target="#"><i class="fa fa-trash" style="margin-right: 7px;">
                          </i>削除
                          </a>
                        </td>
                        <td class="">
                          <a class="btn btn-info scroll" id="product_des_Button3" data-toggle="modal"
                            data-target="#editModal" style="width: 100%;"><i class="fa fa-pencil-square-o"
                            aria-hidden="true" style="margin-right: 5px;"></i>変更画面へ</a>
                        </td>
                        <td class="" style="padding-left:6px!important;">
                          <a class="btn btn-info " style=""><i class="" aria-hidden="true"
                            style="margin-right: 5px;"></i>データを戻す</a>
                        </td>
                        {{--
                        <td class="">
                          <a class="btn btn-info scroll" style=""><i class="fa fa-print" aria-hidden="true"
                            style="margin-right: 5px;"></i>印刷</a>
                        </td>
                        --}}
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
              <!--======================= button  end ======================-->
            </div>
            <!--======================= modal 2 table start here ======================-->
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
                          {{--
                          <div class="col-lg-2 col-md-2 col-sm-2 ">
                            <div class="m_t"></div>
                          </div>
                          --}}
                          <div class="col-lg-3 col-md-3 col-sm-3 ">
                            <div class="m_t" style="font-size:12px;">
                              商品　
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class=" row row_data">
                      <div class="col-lg-3 col-md-3 col-sm-3">
                        <div class="margin_t ">
                          <span>商品説明CD </span> <span style="color: red;">※</span>
                        </div>
                      </div>
                      <div class="col-lg-9 col-md-9 col-sm-9">
                        <div class="outer row">
                          <div class="col-lg-2 col-md-2 col-sm-3 ">
                            <div style="position:relative;">
                              <div class="m_t">00571</div>
                            </div>
                          </div>
                          <div class="col-lg-8 col-md-8 col-sm-8 ">
                            <div class="m_t">Autoメール名人 導入先支援運用打合せ</div>
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
                          <div class="m_t">(成果物) システム計画書</div>
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
                          <div class="m_t" style="white-space: normal;word-break: break-all;">
                            <div>事前打ち合わせ、製品機能説明、社内環境整備、パッケージ操作指導（開発ツールは含まず）</div>
                            <div>＊開発指導のみの場合不要</div>
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
                        <div class="col-lg-12 col-md-12 col-sm-12">
                          <div class="m_t" style="white-space: normal; word-break: break-all;">
                            <div>社内0.5日</div>
                            <div>打合せ1～1.5日</div>
                            <div>訪問作業0.5日</div>
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
                          <div class="m_t">システム計画書</div>
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
                        <div class="col-lg-12 col-md-3 col-sm-3 ">
                          <div class="m_t"></div>
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
                          <div class="m_t" style="white-space: normal;word-break: break-all;"></div>
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
                            <div class="m_t">20191225AM-notes.PDF</div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class=" row row_data">
                    <div class="col-lg-3 col-md-3 col-sm-3">
                      <div class="margin_t "><span>補足説明</span></div>
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-9">
                      <div class="outer row">
                        <div class="col-lg-12 col-md-12 col-sm-12 ">
                          <div class="m_t" style="white-space: normal;word-break: break-all;">(当面未使用)</div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class=" row row_data">
                    <div class="col-lg-3 col-md-3 col-sm-3">
                      <div class="margin_t "><span>入力区分</span> <span style="color: red;">※</span></div>
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-9">
                      <div class="outer row" style="border-bottom: none;">
                        <div class="col-lg-2 col-md-2 col-sm-2 ">
                          <div class="m_t">2</div>
                        </div>
                        <div class="col-lg-8 col-md-8 col-sm-8 ">
                          <div class="m_t" style="font-size:12px;">
                            0：訂正不可　1：訂正可
                          </div>
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
      </div>
    </div>
    <!-- Details modal end here -->

    <!-- Example modal start here -->
    <div class="modal custom-data-modal" data-backdrop="static" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document" style="max-width: 700px;">
        <div class="modal-content bg-blue">
          <div class="modal-header p-2 pl-4 border-bottom-0" style="background: #fff;">
            <h5 class="modal-title" id="exampleModalLabel"><strong>取引条件</strong></h5>
            <span type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </span>
          </div>
          <div class="modal-body pt-0 pr-1 pl-1" style="border: 2px solid #fff;" data-bind="nextFieldOnEnter:true">
            <div class="modal-data-box pl-4 pr-4">
              <table class="table text-white" id="table-basic">
                <tbody class="pl-4 pr-4">
                  <tr>
                    <td class="border-left-0" style="width: 130px !important;padding-left: 0px !important; border-right: 0px !important;border-left: 0px !important;">
                      <div class="line-icon-box"></div>
                      入金方法
                    </td>
                    <td style="border-left: 0px !important;border-right: 0px !important;width: 840px;padding: 20px 0px !important;">
                      <input type="text" class="form-control" placeholder="01 現金入金" readonly="" autofocus="">
                    </td>
                  </tr>
                  <tr>
                    <td style="border-left: 0px !important;width: 130px;padding-left: 0px !important;border-right: 0px !important;">
                      <div class="line-icon-box"></div>
                      検収条件
                    </td>
                    <td style="border-left: 0px !important;border-right: 0px !important;width: 840px;padding: 20px 0px !important;">
                      <input type="text" class="form-control" placeholder="1 納品完了確認書　貴社捺印時" readonly="">
                    </td>
                  </tr>
                  <tr>
                    <td style="border-left: 0px !important;border-right: 0px !important;width: 130px;padding-left: 0px !important;padding-top: 17px;">
                      <div class="line-icon-box"></div>
                      売上基準
                    </td>
                    <td style="border-left: 0px !important;border-right: 0px !important;width: 840px;padding: 20px 0px !important;">
                      <input type="text" class="form-control" placeholder="1 検収基準" readonly="">
                    </td>
                  </tr>
                  <tr>
                    <td style="border-left: 0px !important;border-right: 0px !important;border-bottom:0px !important;width: 130px;padding-left: 0px;padding-top: 24px !important;">
                      <div class="line-icon-box"></div>
                      即時区分
                    </td>
                    <td style="border-left: 0px !important;border-right: 0px !important;border-bottom:0px !important;width: 840px;padding: 20px 0px 0px !important;">
                      <input type="text" class="form-control" placeholder="1 即時" readonly="">
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
            <div class="modal-footer border-top-0 pl-4 pr-4">
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Example modal end here -->

    <!-- Example1 modal start here -->
    <div class="modal custom-data-modal" data-backdrop="static" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1" aria-hidden="true">
      <div class="modal-dialog" role="document" style="max-width: 700px;">
        <div class="modal-content bg-blue">
          <div class="modal-header p-2 pl-4 border-bottom-0" style="background: #fff;">
            <h5 class="modal-title" id="exampleModalLabel"><strong>出荷指示</strong></h5>
            <span type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </span>
          </div>
          <div class="modal-body pt-0 pr-1 pl-1" style="border: 2px solid #fff;" data-bind="nextFieldOnEnter:true">
            <div class="modal-data-box pl-4 pr-4">
              <table class="table text-white" id="table-basic">
                <tbody class="pl-4 pr-4">
                  <tr>
                    <td class="border-left-0" style="width: 150px !important;padding-left: 0px !important; border-right: 0px !important;border-left: 0px !important;">
                      <div class="line-icon-box"></div>
                      発出備考
                    </td>
                    <td style="border-left: 0px !important;border-right: 0px !important;width: 840px;padding: 20px 0px !important;">
                      <div class="">
                        <textarea class="form-control" readonly="" autofocus rows="5" id="comment2" style=" resize: none;height: 53px;white-space:normal;border-radius:4px!important;" placeholder="発出備考NNNNNNNNNNNNNNNN"></textarea>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td style="border-left: 0px !important;width: 150px;padding-left: 0px !important;border-right: 0px !important;">
                      <div class="line-icon-box"></div>
                      納品方法
                    </td>
                    <td style="border-left: 0px !important;border-right: 0px !important;width: 840px;padding: 20px 0px !important;">
                      <input type="text" name="" class="form-control" placeholder="01 UIS" readonly="">
                    </td>
                  </tr>
                  <tr>
                    <td style="border-left: 0px !important;border-right: 0px !important;width: 150px;padding-left: 0px !important;padding-top: 17px;">
                      <div class="line-icon-box"></div>
                      継続区分
                    </td>
                    <td style="border-left: 0px !important;border-right: 0px !important;width: 840px;padding: 20px 0px !important;">
                      <input type="text" name="" class="form-control" placeholder="1 新規ﾗｲｾﾝｽ" readonly="">
                    </td>
                  </tr>
                  <tr>
                    <td style="border-left: 0px !important;border-right: 0px !important;width: 150px;padding-left: 0px;padding-top: 24px !important;">
                      <div class="line-icon-box"></div>
                      新規VUP
                    </td>
                    <td style="border-left: 0px !important;border-right: 0px !important;width: 840px;padding: 20px 0px !important;">
                      <input type="text" name="" class="form-control" placeholder="1 新規" readonly="">
                    </td>
                  </tr>
                  <tr>
                    <td style="border-left: 0px !important;border-right: 0px !important;border-bottom:0px !important;width: 150px;padding-left: 0px;padding-top: 24px !important;">
                      <div class="line-icon-box"></div>
                      VUP区分
                    </td>
                    <td style="border-left: 0px !important;border-right: 0px !important;border-bottom:0px !important;width: 840px;padding: 20px 0px 0px !important;">
                      <input type="text" name="" class="form-control" placeholder="1 ﾒｼﾞｬｰ50%" readonly="">
                    </td>
                  </tr>
                  <tr>
                    <td style="border-left: 0px !important;border-right: 0px !important;border-bottom:0px !important;width: 150px;padding-left: 0px;padding-top: 24px !important;">
                      <div class="line-icon-box"></div>
                      明細備考
                    </td>
                    <td style="border-left: 0px !important;border-right: 0px !important;border-bottom:0px !important;width: 840px;padding: 20px 0px 0px !important;">
                      <div class="">
                        <textarea class="form-control" rows="5" id="comment2" style=" resize: none;height: 75px;white-space:normal;border-radius:4px!important;" readonly="" placeholder=" 明細備考を入力（全角XX文字まで）"></textarea>
                      </div>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
            <div class="modal-footer border-top-0 pl-4 pr-4">
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Example1 modal end here -->

  <!-- Including Common Footer Links Start Here -->
  @include('layouts.footer')
  {{-- <script src="{{asset('js/sales/sales_history/salesHistory.js') }}"></script> --}}
  <!-- Including Common Footer Links End Here -->
    
    <!-- Hard reload js link starts here -->
    <script type="text/javascript">
      var salesHistoryLink = document.createElement("script");
        salesHistoryLink.type = "text/javascript";
        salesHistoryLink.src = "{{ asset('js/sales/sales_history/salesHistory.js') }}?v=" + Math.floor((Math.random() * 500) + 1);
        document.getElementsByTagName("head")[0].appendChild(salesHistoryLink);
    </script>
    <!-- Hard reload js link ends here -->

    <!-- Content top hide show js start -->
    <script type="text/javascript">
      $(document).ready(function(){
         $("#closetopcontent").click(function(){
           $(".order_entry_topcontent").toggle();
           $('.content-bottom-section').css('margin-top',38);
         });
       });
      function contentHideShow() {
       var hideShow = document.getElementById("closetopcontent");
       if (hideShow.innerHTML === "閉じる") {
         hideShow.innerHTML = "開く";
       } else {
         hideShow.innerHTML = "閉じる";
       }
      }
    </script>
    <!-- Content top hide show js end -->

    <!-- file name show in input area... -->
    <script>
      $(".custom-file-input").on("change", function() {
        var fileName = $(this).val().split("\\").pop();
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
      });

      //Enter press hide dropdown...
      $(".input_field").keydown(function(e){
        if(e.keyCode == 13) {
          $(".input_field").datepicker('hide');
        }
      });
    </script>
  </body>
</html>
