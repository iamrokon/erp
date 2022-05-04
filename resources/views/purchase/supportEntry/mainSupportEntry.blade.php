@section('title', 'サポート入力')
@section('menu-test1', 'ホーム >')
@section('menu-test3', '発注 >')
@section('menu-test5', 'サポート入力')
@section('tag-test', 'ここは、ガイドの文章が入ります。')


<!DOCTYPE html>
<html lang="ja">

{{-- Including Common Header Starts Here --}}
@include('layouts.header')
{{-- Including Common Header Ends Here--}}


<meta name="csrf-token" content="{{ csrf_token() }}" />

{{-- Including CSS Style 1 Starts Here --}}
@include('purchase.supportEntry.styles')
{{-- Including CSS Style 1 Ends Here --}}



<body class="common-nav" style="overflow-x:visible;">

  <!-- preloader start here -->
    <div class="preloader">
        <div class="loading" style="display: none"></div>
    </div>
  <!-- preloader end here -->


  <section>
    {{-- Navbar Starts Here --}}
    @include('layout.nav_fixed')
    {{-- Navbar Ends Here --}}
   
    {{-- Navbar Starts Here --}}
    @include('purchase.supportEntry.div1')
    {{-- Navbar Ends Here --}}

      
    {{-- Navbar Starts Here --}}
    @include('purchase.supportEntry.div2')
    {{-- Navbar Ends Here --}}

  </section>


 {{-- Footer Starts Here --}}
 @include('layout.footer_new')
 {{-- Footer end Here --}}

  <!-- Statr search modal -->
  <div class="modal custom-modal" data-backdrop="static" id="search_modal4" role="dialog"
    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content" data-bind="nextFieldOnEnter:true">

        <div class="modal-header" style="height: 68px;padding: 23px 28px;">
          <h5 class="modal-title">取引先</h5>
          <span type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </span>
        </div>

        <div class="modal-body">
          <div class="row">
            <div class="col-lg-6">
            </div>
          </div>
          <div class="row">
            <div class="col-lg-6">
              <div style="margin-bottom: 5px;">
                <table class="table" style="border: none!important;width: auto;">
                  <tbody>
                    <tr>
                      <td style="width: 23px!important;padding: 0!important;border:0!important;">
                        <div class="line-box-icon mr-3"></div>
                      </td>
                      <td style=" border: none!important;width: 40px!important;color: #fff;">検索（絞込）</td>
                      <td style=" width: 100%; border: none!important;"><input type="text" class="form-control"
                          autofocus="" id="lastname" placeholder="検索ワード"
                          style="border-top-left-radius: 4px !important;border-bottom-left-radius: 4px !important;">
                      </td>
                      <td style=" border: none!important;"><button type="button"
                          class="btn bg-teal text-white btn_search" id="searchButton"
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
              <div id="office_content_div_last" style="margin-top: 57px;">
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
                        <td style="width: 112px;">案内停止フラグ</td>
                        <td style="width: 300px;">停止</td>
                      </tr>
                      <tr>
                        <td style="width: 112px;">キーマンフラグ</td>
                        <td style="width: 300px;"> A 責任者</td>
                      </tr>
                      <tr>
                        <td style="width: 112px;">役員改選案内先</td>
                        <td style="width: 300px;"></td>
                      </tr>
                      <tr>
                        <td style="width: 112px;">年賀状</td>
                        <td style="width: 300px;"></td>
                      </tr>
                      <tr>
                        <td style="width: 112px;">ユーザー感謝会案内</td>
                        <td style="width: 300px;"></td>
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
          <button type="button" id="choice_button" class="btn w-145 bg-teal2 text-white ml-2" data-dismiss="modal">
      入力する
          </button>
        </div>
      </div>
    </div>
  </div>
  </div>
  <!-- end search modal -->

  <!-- Setting modal start -->
  <div class="modal custom-modal" data-keyboard="false" data-backdrop="static" id="setting_display_modal" tabindex="-1"
    role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-bind="nextFieldOnEnter:true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h6 class="modal-title" id="exampleModalLabel"></h6>
          <span type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </span>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-lg-4">
              <button class="checkall btn btn-info " autofocus="" style="margin-bottom: 10px;">全選択</button>
              <button class="uncheck btn btn-info" style="margin-bottom: 10px;">全解除</button>
            </div>
            <div class="col-lg-4">
            </div>
            <div class="col-lg-4">
              <button class="btn btn-info " style="margin-bottom: 10px;float: right;">デフォルト</button>
            </div>
          </div>
          <!-- Check uncheck for table settings -->
          <script type="text/javascript">
            var state = false; // desecelted
        $('.checkall').click(function() {
        $('.customCheckBox').each(function() {
        if (!state) {
        this.checked = true;
        }
        });
        });
        //Unchecked....
        $('.uncheck').click(function() {
        $('.customCheckBox').each(function() {
        if (!state) {
        this.checked = false;
        $("input[type='tel']").val("");
        }
        });
        });
          </script>
          <div class="row">
            <div class="col-lg-6">
              <div class="table-responsive setting_header">
                <table class="table table-striped modal-table-blue line-transparent table-bordered">
                  <tbody class="">
                    <tr>
                      <td>
                        <div class="custom-control custom-checkbox custom-control-inline">
                          <input type="checkbox" id="th1" class="custom-control-input customCheckBox" checked="">
                          <label class="custom-control-label margin_btn_17" for="th1"></label>
                        </div>
                      </td>
                      <td style="width:60px!important;">
                        <input type="tel" class="form-control" value="0"
                          onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                      </td>
                      <td class="text-left">
                        <span class="mt-1 text-left">受注区分</span>
                      </td>
                    </tr>

                    <tr>
                      <td>
                        <div class="custom-control custom-checkbox custom-control-inline">
                          <input type="checkbox" id="th19" class="custom-control-input customCheckBox" checked="">
                          <label class="custom-control-label margin_btn_17" for="th19"></label>
                        </div>
                      </td>
                      <td style="width:60px!important;">
                        <input type="tel" class="form-control" value="1"
                          onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                      </td>
                      <td class="text-left">
                        <span class="mt-1 text-left">作成区分</span>
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
                        <span class="mt-1 text-left"> 担　当</span>
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
                        <input type="tel" class="form-control" value="1"
                          onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                      </td>
                      <td class="text-left">
                        <span class="mt-1 text-left">受注番号</span>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="custom-control custom-checkbox custom-control-inline">
                          <input type="checkbox" id="th18" class="custom-control-input customCheckBox" checked="">
                          <label class="custom-control-label margin_btn_17" for="th18"></label>
                        </div>
                      </td>
                      <td style="width:60px!important;">
                        <input type="tel" class="form-control" value="2"
                          onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                      </td>
                      <td class="text-left">
                        <span class="mt-1 text-left">訂正回数</span>
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
                        <input type="tel" class="form-control" value="2"
                          onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                      </td>
                      <td class="text-left">
                        <span class="mt-1 text-left">受注件名</span>
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
                        <span class="mt-1 text-left">受注先</span>
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
                        <span class="mt-1 text-left">売上請求先</span>
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
                        <span class="mt-1 text-left">最終顧客</span>
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
                        <span class="mt-1 text-left">売上請求担当者</span>
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
                        <span class="mt-1 text-left">受注金額</span>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="custom-control custom-checkbox custom-control-inline">
                          <input type="checkbox" id="th17" class="custom-control-input customCheckBox">
                          <label class="custom-control-label margin_btn_17" for="th17"></label>
                        </div>
                      </td>
                      <td style="width:60px!important;">
                        <input type="tel" class="form-control"
                          onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                      </td>
                      <td class="text-left">
                        <span class="mt-1 text-left">粗利</span>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="custom-control custom-checkbox custom-control-inline">
                          <input type="checkbox" id="th10" class="custom-control-input customCheckBox">
                          <label class="custom-control-label margin_btn_17" for="th10"></label>
                        </div>
                      </td>
                      <td style="width:60px!important;">
                        <input type="tel" class="form-control"
                          onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                      </td>
                      <td class="text-left">
                        <span class="mt-1 text-left">受注日</span>
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
                        <span class="mt-1 text-left">売上日</span>
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
                        <span class="mt-1 text-left">入金日</span>
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
                        <span class="mt-1 text-left">[最終顧客]ﾃﾞｰﾀｿｰｽ</span>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="custom-control custom-checkbox custom-control-inline">
                          <input type="checkbox" id="th16" class="custom-control-input customCheckBox">
                          <label class="custom-control-label margin_btn_17" for="th16"></label>
                        </div>
                      </td>
                      <td style="width:60px!important;">
                        <input type="tel" class="form-control"
                          onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                      </td>
                      <td class="text-left">
                        <span class="mt-1 text-left">[最終顧客]ﾕｰｻﾞｰ</span>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="custom-control custom-checkbox custom-control-inline">
                          <input type="checkbox" id="th14" class="custom-control-input customCheckBox">
                          <label class="custom-control-label margin_btn_17" for="th14"></label>
                        </div>
                      </td>
                      <td style="width:60px!important;">
                        <input type="tel" class="form-control"
                          onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                      </td>
                      <td class="text-left">
                        <span class="mt-1 text-left">[最終顧客]取引開始日</span>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="custom-control custom-checkbox custom-control-inline">
                          <input type="checkbox" id="th15" class="custom-control-input customCheckBox">
                          <label class="custom-control-label margin_btn_17" for="th15"></label>
                        </div>
                      </td>
                      <td style="width:60px!important;">
                        <input type="tel" class="form-control"
                          onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                      </td>
                      <td class="text-left">
                        <span class="mt-1 text-left">[受注先]取引開始日</span>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="custom-control custom-checkbox custom-control-inline">
                          <input type="checkbox" id="th20" class="custom-control-input customCheckBox">
                          <label class="custom-control-label margin_btn_17" for="th20"></label>
                        </div>
                      </td>
                      <td style="width:60px!important;">
                        <input type="tel" class="form-control"
                          onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                      </td>
                      <td class="text-left">
                        <span class="mt-1 text-left">プロジェクト番号</span>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="custom-control custom-checkbox custom-control-inline">
                          <input type="checkbox" id="th21" class="custom-control-input customCheckBox">
                          <label class="custom-control-label margin_btn_17" for="th21"></label>
                        </div>
                      </td>
                      <td style="width:60px!important;">
                        <input type="tel" class="form-control"
                          onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                      </td>
                      <td class="text-left">
                        <span class="mt-1 text-left">客先注番</span>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="table-responsive setting_header">
                <table class="table table-striped modal-table-blue line-transparent table-bordered">
                  <tbody>
                    <tr>
                      <td>
                        <div class="custom-control custom-checkbox custom-control-inline">
                          <input type="checkbox" id="th22" class="custom-control-input customCheckBox">
                          <label class="custom-control-label margin_btn_17" for="th22"></label>
                        </div>
                      </td>
                      <td style="width:60px!important;">
                        <input type="tel" class="form-control"
                          onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                      </td>
                      <td class="text-left">
                        <span class="mt-1 text-left">代理店１</span>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="custom-control custom-checkbox custom-control-inline">
                          <input type="checkbox" id="th23" class="custom-control-input customCheckBox">
                          <label class="custom-control-label margin_btn_17" for="th23"></label>
                        </div>
                      </td>
                      <td style="width:60px!important;">
                        <input type="tel" class="form-control"
                          onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                      </td>
                      <td class="text-left">
                        <span class="mt-1 text-left">代理店２</span>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="custom-control custom-checkbox custom-control-inline">
                          <input type="checkbox" id="th24" class="custom-control-input customCheckBox">
                          <label class="custom-control-label margin_btn_17" for="th24"></label>
                        </div>
                      </td>
                      <td style="width:60px!important;">
                        <input type="tel" class="form-control"
                          onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                      </td>
                      <td class="text-left">
                        <span class="mt-1 text-left">請求書送付先</span>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="custom-control custom-checkbox custom-control-inline">
                          <input type="checkbox" id="th25" class="custom-control-input customCheckBox">
                          <label class="custom-control-label margin_btn_17" for="th25"></label>
                        </div>
                      </td>
                      <td style="width:60px!important;">
                        <input type="tel" class="form-control"
                          onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                      </td>
                      <td class="text-left">
                        <span class="mt-1 text-left">入金方法</span>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="custom-control custom-checkbox custom-control-inline">
                          <input type="checkbox" id="th26" class="custom-control-input customCheckBox">
                          <label class="custom-control-label margin_btn_17" for="th26"></label>
                        </div>
                      </td>
                      <td style="width:60px!important;">
                        <input type="tel" class="form-control"
                          onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                      </td>
                      <td class="text-left">
                        <span class="mt-1 text-left">即時区分</span>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="custom-control custom-checkbox custom-control-inline">
                          <input type="checkbox" id="th27" class="custom-control-input customCheckBox">
                          <label class="custom-control-label margin_btn_17" for="th27"></label>
                        </div>
                      </td>
                      <td style="width:60px!important;">
                        <input type="tel" class="form-control"
                          onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                      </td>
                      <td class="text-left">
                        <span class="mt-1 text-left">検収条件</span>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="custom-control custom-checkbox custom-control-inline">
                          <input type="checkbox" id="th28" class="custom-control-input customCheckBox">
                          <label class="custom-control-label margin_btn_17" for="th28"></label>
                        </div>
                      </td>
                      <td style="width:60px!important;">
                        <input type="tel" class="form-control"
                          onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                      </td>
                      <td class="text-left">
                        <span class="mt-1 text-left">注文書書類保管番号</span>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="custom-control custom-checkbox custom-control-inline">
                          <input type="checkbox" id="th29" class="custom-control-input customCheckBox">
                          <label class="custom-control-label margin_btn_17" for="th29"></label>
                        </div>
                      </td>
                      <td style="width:60px!important;">
                        <input type="tel" class="form-control"
                          onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                      </td>
                      <td class="text-left">
                        <span class="mt-1 text-left">検収確認書書類保管番号</span>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="custom-control custom-checkbox custom-control-inline">
                          <input type="checkbox" id="th30" class="custom-control-input customCheckBox">
                          <label class="custom-control-label margin_btn_17" for="th30"></label>
                        </div>
                      </td>
                      <td style="width:60px!important;">
                        <input type="tel" class="form-control"
                          onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                      </td>
                      <td class="text-left">
                        <span class="mt-1 text-left">売上指示・検印譜フェーズ</span>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="custom-control custom-checkbox custom-control-inline">
                          <input type="checkbox" id="th31" class="custom-control-input customCheckBox">
                          <label class="custom-control-label margin_btn_17" for="th31"></label>
                        </div>
                      </td>
                      <td style="width:60px!important;">
                        <input type="tel" class="form-control"
                          onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                      </td>
                      <td class="text-left">
                        <span class="mt-1 text-left">売上指示者</span>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="custom-control custom-checkbox custom-control-inline">
                          <input type="checkbox" id="th32" class="custom-control-input customCheckBox">
                          <label class="custom-control-label margin_btn_17" for="th32"></label>
                        </div>
                      </td>
                      <td style="width:60px!important;">
                        <input type="tel" class="form-control"
                          onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                      </td>
                      <td class="text-left">
                        <span class="mt-1 text-left">売上検印者</span>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="custom-control custom-checkbox custom-control-inline">
                          <input type="checkbox" id="th33" class="custom-control-input customCheckBox">
                          <label class="custom-control-label margin_btn_17" for="th33"></label>
                        </div>
                      </td>
                      <td style="width:60px!important;">
                        <input type="tel" class="form-control"
                          onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                      </td>
                      <td class="text-left">
                        <span class="mt-1 text-left">伝票作成フラグ</span>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="custom-control custom-checkbox custom-control-inline">
                          <input type="checkbox" id="th34" class="custom-control-input customCheckBox">
                          <label class="custom-control-label margin_btn_17" for="th34"></label>
                        </div>
                      </td>
                      <td style="width:60px!important;">
                        <input type="tel" class="form-control"
                          onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                      </td>
                      <td class="text-left">
                        <span class="mt-1 text-left">伝票作成者</span>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="custom-control custom-checkbox custom-control-inline">
                          <input type="checkbox" id="th35" class="custom-control-input customCheckBox">
                          <label class="custom-control-label margin_btn_17" for="th35"></label>
                        </div>
                      </td>
                      <td style="width:60px!important;">
                        <input type="tel" class="form-control"
                          onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                      </td>
                      <td class="text-left">
                        <span class="mt-1 text-left">検収書確認フラグ</span>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="custom-control custom-checkbox custom-control-inline">
                          <input type="checkbox" id="th36" class="custom-control-input customCheckBox">
                          <label class="custom-control-label margin_btn_17" for="th36"></label>
                        </div>
                      </td>
                      <td style="width:60px!important;">
                        <input type="tel" class="form-control"
                          onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                      </td>
                      <td class="text-left">
                        <span class="mt-1 text-left">検収書確認者</span>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="custom-control custom-checkbox custom-control-inline">
                          <input type="checkbox" id="th37" class="custom-control-input customCheckBox">
                          <label class="custom-control-label margin_btn_17" for="th37"></label>
                        </div>
                      </td>
                      <td style="width:60px!important;">
                        <input type="tel" class="form-control"
                          onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                      </td>
                      <td class="text-left">
                        <span class="mt-1 text-left">受注実績作成フラグ</span>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="custom-control custom-checkbox custom-control-inline">
                          <input type="checkbox" id="th38" class="custom-control-input customCheckBox">
                          <label class="custom-control-label margin_btn_17" for="th38"></label>
                        </div>
                      </td>
                      <td style="width:60px!important;">
                        <input type="tel" class="form-control"
                          onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                      </td>
                      <td class="text-left">
                        <span class="mt-1 text-left">売上伝票メール送信フラグ</span>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="custom-control custom-checkbox custom-control-inline">
                          <input type="checkbox" id="th39" class="custom-control-input customCheckBox">
                          <label class="custom-control-label margin_btn_17" for="th39"></label>
                        </div>
                      </td>
                      <td style="width:60px!important;">
                        <input type="tel" class="form-control"
                          onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                      </td>
                      <td class="text-left">
                        <span class="mt-1 text-left">売上伝票PDFダウンロードフラグ</span>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="custom-control custom-checkbox custom-control-inline">
                          <input type="checkbox" id="th40" class="custom-control-input customCheckBox">
                          <label class="custom-control-label margin_btn_17" for="th40"></label>
                        </div>
                      </td>
                      <td style="width:60px!important;">
                        <input type="tel" class="form-control"
                          onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                      </td>
                      <td class="text-left">
                        <span class="mt-1 text-left">最終顧客／販売ランク</span>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="custom-control custom-checkbox custom-control-inline">
                          <input type="checkbox" id="th41" class="custom-control-input customCheckBox">
                          <label class="custom-control-label margin_btn_17" for="th41"></label>
                        </div>
                      </td>
                      <td style="width:60px!important;">
                        <input type="tel" class="form-control"
                          onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                      </td>
                      <td class="text-left">
                        <span class="mt-1 text-left">最終顧客／顧客深耕層別化</span>
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
  <!--   end modal -->

  <!-- child screen 102-1 Starts -->
  <!-- <div class="modal custom-data-modal" data-backdrop="static" id="numberSearchModal" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel3" aria-hidden="true">
    <div class="modal-dialog" role="document" style="max-width: 100%">
      <div class="modal-content bg-blue">
        <div class="modal-header p-2 pl-4 border-bottom-0" style="background: #fff;height: 69px;padding: 24px 28px;">
          <h5 class="modal-title" id="exampleModalLabel"><strong>番号検索</strong></h5>
          <span type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </span>
        </div>
        <div class="modal-body pt-0 pr-1 pl-1" style="border: 2px solid #fff;" data-bind="nextFieldOnEnter:true">
          <div class="pl-4 pr-4" style="margin-top: 30px;">
            <div class=" row row_data mb-1">
              <div class="col-7">

                <div class="radio-rounded d-inline-block">
                  <div class="custom-control custom-radio custom-control-inline" style="padding-left:11px!important;">
                    <input type="radio" class="custom-control-input" id="customRadio8" name="rd1" value="" autofocus=""
                      checked="">
                    <label class="custom-control-label text-white" for="customRadio8"
                      style="font-size: 12px!important;cursor:pointer;">受注</label>
                  </div>
                  <div class="custom-control custom-radio custom-control-inline" style="padding-left:11px!important;">
                    <input type="radio" class="custom-control-input" id="customRadio9" name="rd1" value="">
                    <label class="custom-control-label text-white" for="customRadio9"
                      style="font-size: 12px!important;cursor:pointer;"> 発注</label>
                  </div>

                </div>
              </div>
            </div>
          </div>
          <div class="pl-4 pr-4" style="margin-top: 16px;">
            <div style="border-top: 1px solid #141855;padding-bottom: 15px;">
              <div class="row mt-2">
                <div class="col-lg-8">
                  <div class="mt-2 mb-2" style="overflow-x:auto; overflow-y:auto; height: auto;">
                    <table class="custom-table-pagination table_hover2_pagi table-nohover  gridAlternada w_680">
                      <tbody>
                        <tr>
                          <td class="" style="padding-left:0px!important;">
                            <div class="pagi">
                              <div class="nav_mview">
                                <nav aria-label="Page navigation example ">
                                  <ul class="pagination">
                                    <li class="page-item">
                                      <a class="page-link" href="#" aria-label="Previous"
                                        style="margin-right: 10px;border-top-right-radius: 4px;border-bottom-right-radius: 4px;color: black !important;height: 30px;">
                                        <span aria-hidden="true"><i class="fa fa-angle-left"
                                            style="line-height: 18px;font-size: 20px;"></i></span>
                                        <span class="sr-only">Previous</span>
                                      </a>
                                    </li>
                                    <li class="w_50 ">
                                      <input type="text" name="page" id="paginate"
                                        class="form-control intLimitTextBox text-center input_pagi" value="6"
                                        style=" margin-top: 0px;border-left: 0px!important;height: 27px!important;width: 40px;margin-right: 10px;border-radius: 4px !important;text-align: left !important;padding-left: 2px !important;height: 30px !important;">
                                    </li>
                                    <li class="page-item"><a class="page-link" href="#"
                                        style="line-height: 18px !important;color: black !important;border-radius: 4px;margin-right: 10px; width: 30px;font-weight: 600;">=</a>
                                    </li>
                                    <li class="page-item">
                                      <a class="page-link" href="#" aria-label="Next"
                                        style="line-height: 12px !important;color: black !important;border-top-left-radius: 4px;border-bottom-left-radius: 4px;height: 30px;">
                                        <span aria-hidden="true"><i class="fa fa-angle-right"
                                            style="line-height: 18px;font-size: 20px;"></i></span>
                                        <span class="sr-only">Next</span>
                                      </a>
                                    </li>
                                  </ul>
                                </nav>
                              </div>
                            </div>
                          </td>
                          <td class="">
                            <div class="pagi_border-_none_text_wrap text-white">
                              <table class="ml-3">
                                <tbody>
                                  <tr class="table_hover2_pagi  grid">
                                    <td class="p-2 pl-2 pr-2" style="border:none!important;color:white !important;">
                                      情報総数</td>
                                    <td class="p-2 pl-2 pr-2" style="border:none!important;color:white !important;">203
                                    </td>
                                    <td class="p-2 pl-2 pr-2" style="border:none!important;color:white !important;">表示範囲
                                    </td>
                                    <td class="p-2 pl-2 pr-2" style="border:none!important;color:white !important;">
                                      101～120</td>
                                    <td class="p-2 pl-2 pr-2" style="border:none!important;color:white !important;">ページ数
                                    </td>
                                    <td class="p-2 pl-2 pr-2" style="border:none!important;color:white !important;">11
                                    </td>
                                  </tr>
                                </tbody>
                              </table>

                            </div>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              
                <style type="text/css">
                  @media only screen and (min-width:768px) and (max-width:992px) {
                    #tbl_border_none {
                      width: 100%;
                      margin-bottom: 10px;
                      float: right;
                    }
                  }

                  #tbl_border_none {
                    float: right;
                  }

                  @media only screen and (max-width:767px) {
                    #tbl_border_none {
                      margin-left: 0px;
                      float: none !important;
                    }
                  }
                </style>
                <div class="col-lg-4">
                  <div class="ml-auto pt-3 text-right">
                    <button type="button" id="choice_button" class="btn bg-teal w-145 text-white" style="width: 145px;">
                      検 索
                    </button>
                    <button type="button" id="" class="btn text-white bg-default w-145 mr-2" style="width: 145px;"> <i
                        class="" aria-hidden="true" style="margin-right: 5px;"></i> 一覧
                    </button>
                  </div>
                </div>
              </div>
            </div>
            <div class="table-scroll-area table-responsive">
              <div class="reference-table" style="margin-top: 20px;margin-bottom: 17px;">
                <div class="">
                  <table class="table modal-inner modal-table-white text-dark bg-white"
                    style="margin-bottom: 0px !important;cursor: pointer;">
                    <thead>
                      <tr>
                        <th class="text-white" style="background: #363A81 !important;">番号</th>
                        <th class="text-white" style="background: #363A81 !important;">担当</th>
                        <th class="text-white" style="background: #363A81 !important;">受注先</th>
                        <th class="text-white" style="background: #363A81 !important;">最終顧客</th>
                        <th class="text-white" style="background: #363A81 !important;">受注・見積額</th>
                        <th class="text-white" style="background: #363A81 !important;">受注件名・見積件名</th>
                        <th class="text-white" style="background: #363A81 !important;">売上・見積日</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td class="line-title" style="height: 30px;background: white;margin-right: 1px;">
                          <input type="text" class="form-control"
                            style="width: 64px !important;border: 1px solid #E1E1E1 !important;border-radius: 4px !important;">
                        </td>
                        <td class="line-title" style="height: 30px;background: white;margin-right: 1px;">
                          <input type="text" class="form-control"
                            style="width: 52px !important;border: 1px solid #E1E1E1 !important;border-radius: 4px !important;">
                        </td>
                        <td class="line-title" style="height: 30px;background: white;margin-right: 1px;">
                          <input type="text" class="form-control"
                            style="width: 136px !important;border: 1px solid #E1E1E1 !important;border-radius: 4px !important;">
                        </td>
                        <td class="line-title" style="height: 30px;background: white;margin-right: 1px;">
                          <input type="text" class="form-control"
                            style="width: 133px !important;border: 1px solid #E1E1E1 !important;border-radius: 4px !important;">
                        </td>
                        <td class="line-title" style="height: 30px;background: white;margin-right: 1px;">
                          <input type="text" class="form-control"
                            style="width: 112px !important;border: 1px solid #E1E1E1 !important;border-radius: 4px !important;">
                        </td>
                        <td class="line-title" style="height: 30px;background: white;margin-right: 1px;">
                          <input type="text" class="form-control"
                            style="width: 249px !important;border: 1px solid #E1E1E1 !important;border-radius: 4px !important;">
                        </td>
                        <td class="line-title" style="height: 30px;background: white;">
                          <input type="text" class="form-control"
                            style="width: 109px !important;border: 1px solid #E1E1E1 !important;border-radius: 4px !important;">
                        </td>
                      </tr>
                      <tr tabindex="0" class="show_personal_master_info trfocused trfocus">
                        <td>99999999</td>
                        <td>NNN</td>
                        <td>NNNNNNNNNN</td>
                        <td>NNNNNNNNNN</td>
                        <td>999999999</td>
                        <td>NNNNNNNNNNNNNNNNNNNN</td>
                        <td>2020/00/00</td>

                      </tr>
                      <tr tabindex="0" class="show_personal_master_info add_border trfocus">
                        <td>99999999</td>
                        <td>NNN</td>
                        <td>NNNNNNNNNN</td>
                        <td>NNNNNNNNNN</td>
                        <td>999999999</td>
                        <td>NNNNNNNNNNNNNNNNNNNN</td>
                        <td>2020/00/00</td>
                      </tr>

                      <tr tabindex="0" class="show_personal_master_info trfocus">
                        <td>99999999</td>
                        <td>NNN</td>
                        <td>NNNNNNNNNN</td>
                        <td>NNNNNNNNNN</td>
                        <td>999999999</td>
                        <td>NNNNNNNNNNNNNNNNNNNN</td>
                        <td>2020/00/00</td>
                      </tr>
                      <tr tabindex="0" class="show_personal_master_info trfocus">
                        <td>99999999</td>
                        <td>NNN</td>
                        <td>NNNNNNNNNN</td>
                        <td>NNNNNNNNNN</td>
                        <td>999999999</td>
                        <td>NNNNNNNNNNNNNNNNNNNN</td>
                        <td>2020/00/00</td>
                      </tr>
                      <tr tabindex="0" class="show_personal_master_info trfocus">
                        <td>99999999</td>
                        <td>NNN</td>
                        <td>NNNNNNNNNN</td>
                        <td>NNNNNNNNNN</td>
                        <td>999999999</td>
                        <td>NNNNNNNNNNNNNNNNNNNN</td>
                        <td>2020/00/00</td>
                      </tr>
                      <tr tabindex="0" class="show_personal_master_info trfocus">
                        <td>99999999</td>
                        <td>NNN</td>
                        <td>NNNNNNNNNN</td>
                        <td>NNNNNNNNNN</td>
                        <td>999999999</td>
                        <td>NNNNNNNNNNNNNNNNNNNN</td>
                        <td>2020/00/00</td>
                      </tr>
                      <tr tabindex="0" class="show_personal_master_info trfocus">
                        <td>99999999</td>
                        <td>NNN</td>
                        <td>NNNNNNNNNN</td>
                        <td>NNNNNNNNNN</td>
                        <td>999999999</td>
                        <td>NNNNNNNNNNNNNNNNNNNN</td>
                        <td>2020/00/00</td>
                      </tr>
                      <tr tabindex="0" class="show_personal_master_info trfocus">
                        <td>99999999</td>
                        <td>NNN</td>
                        <td>NNNNNNNNNN</td>
                        <td>NNNNNNNNNN</td>
                        <td>999999999</td>
                        <td>NNNNNNNNNNNNNNNNNNNN</td>
                        <td>2020/00/00</td>
                      </tr>
                      <tr tabindex="0" class="show_personal_master_info trfocus">
                        <td>99999999</td>
                        <td>NNN</td>
                        <td>NNNNNNNNNN</td>
                        <td>NNNNNNNNNN</td>
                        <td>999999999</td>
                        <td>NNNNNNNNNNNNNNNNNNNN</td>
                        <td>2020/00/00</td>
                      </tr>
                      <tr tabindex="0" class="show_personal_master_info trfocus">
                        <td>99999999</td>
                        <td>NNN</td>
                        <td>NNNNNNNNNN</td>
                        <td>NNNNNNNNNN</td>
                        <td>999999999</td>
                        <td>NNNNNNNNNNNNNNNNNNNN</td>
                        <td>2020/00/00</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer border-top-0 pl-4 pr-4">
            <button type="button" id="" class="btn text-white bg-default  w-145" data-dismiss="modal"> <i class=""
                aria-hidden="true" style="margin-right: 5px;"></i>キャンセル
            </button>
            <button type="button" id="choice_button" class="btn  w-145 bg-teal text-white ml-2" data-dismiss="modal">
             入力する
            </button>
          </div>
        </div>
      </div>
    </div>
  </div> -->

   <!-- child screen 102-1 Ends -->

@include('purchase.supportEntry.include.number_search.main')

  <!-- Including Common Footer Links Starts Here -->
  @include('layouts.footer')
  <!-- Including Common Footer Links Ends Here -->

  <script type="text/javascript">
    $(document).ready(function(){
      $("#closetopcontent").click(function(){
        $(".order_entry_topcontent").toggle();
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
  <script>
    $(document).ready(function(){
    $(".first-table").hide();
    $("button#searchButton").click(function(){
      $(".first-table").show();
    });
  });
  $(document).ready(function(){
      $(".second-table").hide();
      $(".first-table").click(function(){
       $(".second-table").show();
      });
  });
  $(document).ready(function(){
     $(".third-table").hide();
    $(".second-table").click(function(){
      $(".third-table").show();
    });
  });
  </script>
  <script type="text/javascript">
    $("#modalarea").on('click', function(){
        $(".modal-backdrop").addClass("overflow_cls");
        // $('.modal-backdrop').remove();
      });

  $("#modalarea").on("click", function(){
  $('.modal-backdrop').remove();
  $('#modalarea').on('show.bs.modal', function (e) {
  $('body').addClass('overflow_cls');

  })
  $('#modalarea').on('hide.bs.modal', function (e) {
  $('body').removeClass('overflow_cls');
  })
  $("#modalarea").modal("hide");
  });
  </script>
   
    {{-- Knockout - Enter to New Input Starts Here --}}
    <script src="https://ajax.aspnetcdn.com/ajax/knockout/knockout-2.2.1.js" type="text/javascript"></script>
    <script>
      // Knockout
      ko.bindingHandlers.nextFieldOnEnter = {
          init: function (element, valueAccessor, allBindingsAccessor) {
              $(element).on('keydown', 'input, textarea, select, button, tr.trfocus, a.btn', function (e) {
                  var self = $(this),
                      form = $(element),
                      focusable, next;
                  if (e.keyCode == 13 && !e.shiftKey) {
                      focusable = form.find('input:not([ignore]), select, textarea, button:not([disabled]), tr.trfocus, a.btn').filter(':visible');
                      // focusable = form.find('input:not([ignore]), select, textarea, button:not([ignore]), a.btn').filter(':visible');
                      var nextIndex = focusable.index(this) == focusable.length - 1 ? 0 : focusable.index(this) + 1;
                      next = focusable.eq(nextIndex);
                      next.focus();
                      return false;
                  }
                  if (e.keyCode == 9) {
                      e.preventDefault();
                  }
  
                  // Shift+Enter to select table row
                  if (e.keyCode == 13 && e.shiftKey) {
                    var rowSelect2 = $('.rowSelect');
                    $(this).trigger('click');
                  }
              });
          }
      };
      ko.applyBindings({});
  
    </script>
    {{-- Knockout - Enter to New Input ends Here --}}

  <script type="text/javascript">
    // Date Picker Initialization
$('#datepicker1_oen').datepicker({
      language: 'ja-JP',
      format: 'yyyy/mm/dd',
      autoHide: true,
      zIndex: 10,
      offset: 4,
      trigger: '#datepicker1_oen'
    });

    $('#datepicker1_oen').on('change focus', function () {
      if ($(this).val().length == 10) {
        $(this).siblings('.datePickerHidden').val($(this).val());
        let datevalue = $(this).siblings('.datePickerHidden').val();  //getting date value from calendar
        let formatted_date = datevalue.replaceAll('/', '')
        $(this).val(formatted_date);
        $(this).focus(); //focusing current input on select
        $(this).datepicker('hide');

        if($(this).val().replaceAll('/', '') > $('#datepicker2_oen').val().replaceAll('/', '')){
          $('#datepicker2_oen').val(datevalue);
          $('#datepicker2_oen').datepicker('setStartDate', $('#datepicker1_oen').datepicker('getDate'));
          $('#datepicker2_oen').datepicker('update');
          $('#datepicker2_oen').val('');
        }
        else{
          $('#datepicker2_oen').datepicker('setStartDate', $('#datepicker1_oen').datepicker('getDate'));
          $('#datepicker2_oen').datepicker('update');
        }
      }
    });

    $('#datepicker1_oen').on('keyup', function (e) {
      let inputDateValue = $(this).val();  //getting date value from input
      if (inputDateValue.length == 8) {
        let slicedYear = inputDateValue.slice(0, 4);
        let slicedMonth = inputDateValue.slice(4, 6);
        let slicedDay = inputDateValue.slice(6, 8);
        let formatted_sliced_date = slicedYear + "/" + slicedMonth + "/" + slicedDay;
        $(this).siblings('.datePickerHidden').val(formatted_sliced_date);
        $(this).datepicker('setDate', new Date(slicedYear, slicedMonth - 1, slicedDay));
        $('#datepicker2_oen').datepicker('setStartDate', $('#datepicker1_oen').datepicker('getDate'));
        $('#datepicker2_oen').datepicker('update');
      }
    });
    // Update date value with slash on blur
    $('#datepicker1_oen').on('blur', function () {
      if ($(this).val() != '') {
        $(this).val($(this).siblings('.datePickerHidden').val());
      }
      else if ($(this).val() == '') {
        $(this).val('');
        $(this).siblings('.datePickerHidden').val('');
      }
    });
    // Enter hide
    $("#datepicker1_oen").keydown(function (e) {
      if (e.keyCode == 13) {
        $("#datepicker1_oen").datepicker('hide');
      }
    });
  </script>
  <script type="text/javascript">
    $('#datepicker2_oen').datepicker({
      language: 'ja-JP',
      format: 'yyyy/mm/dd',
      autoHide: true,
      zIndex: 10,
      offset: 4,
      trigger: '#datepicker2_oen',
      startDate: $('#datepicker1_oen').datepicker('getDate')
    });

    $('#datepicker2_oen').on('change focus', function () {
      if ($(this).val().length == 10) {
        $(this).siblings('.datePickerHidden').val($(this).val());
        let datevalue = $(this).siblings('.datePickerHidden').val();  //getting date value from calendar
        let formatted_date = datevalue.replaceAll('/', '')
        $(this).val(formatted_date);
        $(this).focus(); //focusing current input on select
        $(this).datepicker('hide');
      }
    });

    $('#datepicker2_oen').on('keyup', function (e) {
      let inputDateValue = $(this).val();  //getting date value from input
      if (inputDateValue.length == 8) {
        let slicedYear = inputDateValue.slice(0, 4);
        let slicedMonth = inputDateValue.slice(4, 6);
        let slicedDay = inputDateValue.slice(6, 8);
        let formatted_sliced_date = slicedYear + "/" + slicedMonth + "/" + slicedDay;
        $(this).siblings('.datePickerHidden').val(formatted_sliced_date);
        $(this).datepicker('setDate', new Date(slicedYear, slicedMonth - 1, slicedDay));
      }
    });
    // Update date value with slash on blur
    $('#datepicker2_oen').on('blur', function () {
      if ($(this).val() != '') {
        $(this).val($(this).siblings('.datePickerHidden').val());
      }
      else if ($(this).val() == '') {
        $(this).val('');
        $(this).siblings('.datePickerHidden').val('');
      }
    });

    //Enter press hide dropdown...
    
    $("#datepicker2_oen").keydown(function (e) {
      if (e.keyCode == 13) {
        $("#datepicker2_oen").datepicker('hide');
      }
    });
  </script>
  <script type="text/javascript">
    $('#datepicker3_oen').datepicker({
      language: 'ja-JP',
      format: 'yyyy/mm/dd',
      autoHide: true,
      zIndex: 10,
      offset: 4,
      trigger: '#datepicker3_oen'
    });

    $('#datepicker3_oen').on('change focus', function () {
      if ($(this).val().length == 10) {
        $(this).siblings('.datePickerHidden').val($(this).val());
        let datevalue = $(this).siblings('.datePickerHidden').val();  //getting date value from calendar
        let formatted_date = datevalue.replaceAll('/', '')
        $(this).val(formatted_date);
        $(this).focus(); //focusing current input on select
        $(this).datepicker('hide');

        if($(this).val().replaceAll('/', '') > $('#datepicker2_oen').val().replaceAll('/', '')){
          $('#datepicker4_oen').val(datevalue);
          $('#datepicker4_oen').datepicker('setStartDate', $('#datepicker3_oen').datepicker('getDate'));
          $('#datepicker4_oen').datepicker('update');
          $('#datepicker4_oen').val('');
        }
        else{
          $('#datepicker4_oen').datepicker('setStartDate', $('#datepicker3_oen').datepicker('getDate'));
          $('#datepicker4_oen').datepicker('update');
        }
      }
    });

    $('#datepicker3_oen').on('keyup', function (e) {
      let inputDateValue = $(this).val();  //getting date value from input
      if (inputDateValue.length == 8) {
        let slicedYear = inputDateValue.slice(0, 4);
        let slicedMonth = inputDateValue.slice(4, 6);
        let slicedDay = inputDateValue.slice(6, 8);
        let formatted_sliced_date = slicedYear + "/" + slicedMonth + "/" + slicedDay;
        $(this).siblings('.datePickerHidden').val(formatted_sliced_date);
        $(this).datepicker('setDate', new Date(slicedYear, slicedMonth - 1, slicedDay));
        $('#datepicker4_oen').datepicker('setStartDate', $('#datepicker3_oen').datepicker('getDate'));
        $('#datepicker4_oen').datepicker('update');
      }
    });
    // Update date value with slash on blur
    $('#datepicker3_oen').on('blur', function () {
      if ($(this).val() != '') {
        $(this).val($(this).siblings('.datePickerHidden').val());
      }
      else if ($(this).val() == '') {
        $(this).val('');
        $(this).siblings('.datePickerHidden').val('');
      }
    });
    $("#datepicker3_oen").keydown(function (e) {
      if (e.keyCode == 13) {
        $("#datepicker3_oen").datepicker('hide');
      }
    });
    $('#datepicker4_oen').datepicker({
      language: 'ja-JP',
      format: 'yyyy/mm/dd',
      autoHide: true,
      zIndex: 10,
      offset: 4,
      trigger: '#datepicker4_oen',
      startDate: $('#datepicker3_oen').datepicker('getDate')
    });

    $('#datepicker4_oen').on('change focus', function () {
      if ($(this).val().length == 10) {
        $(this).siblings('.datePickerHidden').val($(this).val());
        let datevalue = $(this).siblings('.datePickerHidden').val();  //getting date value from calendar
        let formatted_date = datevalue.replaceAll('/', '')
        $(this).val(formatted_date);
        $(this).focus(); //focusing current input on select
        $(this).datepicker('hide');
      }
    });

    $('#datepicker4_oen').on('keyup', function (e) {
      let inputDateValue = $(this).val();  //getting date value from input
      if (inputDateValue.length == 8) {
        let slicedYear = inputDateValue.slice(0, 4);
        let slicedMonth = inputDateValue.slice(4, 6);
        let slicedDay = inputDateValue.slice(6, 8);
        let formatted_sliced_date = slicedYear + "/" + slicedMonth + "/" + slicedDay;
        $(this).siblings('.datePickerHidden').val(formatted_sliced_date);
        $(this).datepicker('setDate', new Date(slicedYear, slicedMonth - 1, slicedDay));
      }
    });
    // Update date value with slash on blur
    $('#datepicker4_oen').on('blur', function () {
      if ($(this).val() != '') {
        $(this).val($(this).siblings('.datePickerHidden').val());
      }
      else if ($(this).val() == '') {
        $(this).val('');
        $(this).siblings('.datePickerHidden').val('');
      }
    });
    $("#datepicker4_oen").keydown(function (e) {
      if (e.keyCode == 13) {
        $("#datepicker4_oen").datepicker('hide');
      }
    });
    //5
    $('#datepicker5_oen').datepicker({
      language: 'ja-JP',
      format: 'yyyy/mm/dd',
      autoHide: true,
      zIndex: 10,
      offset: 4,
      trigger: '#datepicker5_oen',
      startDate: $('#datepicker3_oen').datepicker('getDate')
    });

    $('#datepicker5_oen').on('change focus', function () {
      if ($(this).val().length == 10) {
        $(this).siblings('.datePickerHidden').val($(this).val());
        let datevalue = $(this).siblings('.datePickerHidden').val();  //getting date value from calendar
        let formatted_date = datevalue.replaceAll('/', '')
        $(this).val(formatted_date);
        $(this).focus(); //focusing current input on select
        $(this).datepicker('hide');
      }
    });

    $('#datepicker5_oen').on('keyup', function (e) {
      let inputDateValue = $(this).val();  //getting date value from input
      if (inputDateValue.length == 8) {
        let slicedYear = inputDateValue.slice(0, 4);
        let slicedMonth = inputDateValue.slice(4, 6);
        let slicedDay = inputDateValue.slice(6, 8);
        let formatted_sliced_date = slicedYear + "/" + slicedMonth + "/" + slicedDay;
        $(this).siblings('.datePickerHidden').val(formatted_sliced_date);
        $(this).datepicker('setDate', new Date(slicedYear, slicedMonth - 1, slicedDay));
      }
    });
    // Update date value with slash on blur
    $('#datepicker5_oen').on('blur', function () {
      if ($(this).val() != '') {
        $(this).val($(this).siblings('.datePickerHidden').val());
      }
      else if ($(this).val() == '') {
        $(this).val('');
        $(this).siblings('.datePickerHidden').val('');
      }
    });
   
    //Enter press hide dropdown...
    $("#datepicker5_oen").keydown(function (e) {
      if (e.keyCode == 13) {
        $("#datepicker5_oen").datepicker('hide');
      }
    });
  </script>
  <script>
    //6
  $('#datepicker6_oen').datepicker({
      language: 'ja-JP',
      format: 'yyyy/mm/dd',
      autoHide: true,
      zIndex: 10,
      offset: 4,
      trigger: '#datepicker6_oen',
      startDate: $('#datepicker5_oen').datepicker('getDate')
    });

    $('#datepicker6_oen').on('change focus', function () {
      if ($(this).val().length == 10) {
        $(this).siblings('.datePickerHidden').val($(this).val());
        let datevalue = $(this).siblings('.datePickerHidden').val();  //getting date value from calendar
        let formatted_date = datevalue.replaceAll('/', '')
        $(this).val(formatted_date);
        $(this).focus(); //focusing current input on select
        $(this).datepicker('hide');
      }
    });

    $('#datepicker6_oen').on('keyup', function (e) {
      let inputDateValue = $(this).val();  //getting date value from input
      if (inputDateValue.length == 8) {
        let slicedYear = inputDateValue.slice(0, 4);
        let slicedMonth = inputDateValue.slice(4, 6);
        let slicedDay = inputDateValue.slice(6, 8);
        let formatted_sliced_date = slicedYear + "/" + slicedMonth + "/" + slicedDay;
        $(this).siblings('.datePickerHidden').val(formatted_sliced_date);
        $(this).datepicker('setDate', new Date(slicedYear, slicedMonth - 1, slicedDay));
      }
    });
    // Update date value with slash on blur
    $('#datepicker6_oen').on('blur', function () {
      if ($(this).val() != '') {
        $(this).val($(this).siblings('.datePickerHidden').val());
      }
      else if ($(this).val() == '') {
        $(this).val('');
        $(this).siblings('.datePickerHidden').val('');
      }
    });

    //Enter press hide dropdown...
   
    $("#datepicker6_oen").keydown(function (e) {
      if (e.keyCode == 13) {
        $("#datepicker6_oen").datepicker('hide');
      }
    });
  </script>
  <script>
    //7
  $('#datepicker7_oen').datepicker({
      language: 'ja-JP',
      format: 'yyyy/mm/dd',
      autoHide: true,
      zIndex: 10,
      offset: 4,
      trigger: '#datepicker7_oen',
      startDate: $('#datepicker6_oen').datepicker('getDate')
    });

    $('#datepicker7_oen').on('change focus', function () {
      if ($(this).val().length == 10) {
        $(this).siblings('.datePickerHidden').val($(this).val());
        let datevalue = $(this).siblings('.datePickerHidden').val();  //getting date value from calendar
        let formatted_date = datevalue.replaceAll('/', '')
        $(this).val(formatted_date);
        $(this).focus(); //focusing current input on select
        $(this).datepicker('hide');
      }
    });

    $('#datepicker7_oen').on('keyup', function (e) {
      let inputDateValue = $(this).val();  //getting date value from input
      if (inputDateValue.length == 8) {
        let slicedYear = inputDateValue.slice(0, 4);
        let slicedMonth = inputDateValue.slice(4, 6);
        let slicedDay = inputDateValue.slice(6, 8);
        let formatted_sliced_date = slicedYear + "/" + slicedMonth + "/" + slicedDay;
        $(this).siblings('.datePickerHidden').val(formatted_sliced_date);
        $(this).datepicker('setDate', new Date(slicedYear, slicedMonth - 1, slicedDay));
      }
    });
    // Update date value with slash on blur
    $('#datepicker7_oen').on('blur', function () {
      if ($(this).val() != '') {
        $(this).val($(this).siblings('.datePickerHidden').val());
      }
      else if ($(this).val() == '') {
        $(this).val('');
        $(this).siblings('.datePickerHidden').val('');
      }
    });

    //Enter press hide dropdown...
   
    $("#datepicker7_oen").keydown(function (e) {
      if (e.keyCode == 13) {
        $("#datepicker7_oen").datepicker('hide');
      }
    });
  </script>
  <script>
    //8
  $('#datepicker8_oen').datepicker({
      language: 'ja-JP',
      format: 'yyyy/mm/dd',
      autoHide: true,
      zIndex: 10,
      offset: 4,
      trigger: '#datepicker8_oen',
      startDate: $('#datepicker7_oen').datepicker('getDate')
    });

    $('#datepicker8_oen').on('change focus', function () {
      if ($(this).val().length == 10) {
        $(this).siblings('.datePickerHidden').val($(this).val());
        let datevalue = $(this).siblings('.datePickerHidden').val();  //getting date value from calendar
        let formatted_date = datevalue.replaceAll('/', '')
        $(this).val(formatted_date);
        $(this).focus(); //focusing current input on select
        $(this).datepicker('hide');
      }
    });

    $('#datepicker8_oen').on('keyup', function (e) {
      let inputDateValue = $(this).val();  //getting date value from input
      if (inputDateValue.length == 8) {
        let slicedYear = inputDateValue.slice(0, 4);
        let slicedMonth = inputDateValue.slice(4, 6);
        let slicedDay = inputDateValue.slice(6, 8);
        let formatted_sliced_date = slicedYear + "/" + slicedMonth + "/" + slicedDay;
        $(this).siblings('.datePickerHidden').val(formatted_sliced_date);
        $(this).datepicker('setDate', new Date(slicedYear, slicedMonth - 1, slicedDay));
      }
    });
    // Update date value with slash on blur
    $('#datepicker8_oen').on('blur', function () {
      if ($(this).val() != '') {
        $(this).val($(this).siblings('.datePickerHidden').val());
      }
      else if ($(this).val() == '') {
        $(this).val('');
        $(this).siblings('.datePickerHidden').val('');
      }
    });

    //Enter press hide dropdown...
   
    $("#datepicker8_oen").keydown(function (e) {
      if (e.keyCode == 13) {
        $("#datepicker8_oen").datepicker('hide');
      }
    });
  </script>
  <script>
    //6
  $('#datepicker9_oen').datepicker({
      language: 'ja-JP',
      format: 'yyyy/mm/dd',
      autoHide: true,
      zIndex: 10,
      offset: 4,
      trigger: '#datepicker9_oen',
      startDate: $('#datepicker8_oen').datepicker('getDate')
    });

    $('#datepicker9_oen').on('change focus', function () {
      if ($(this).val().length == 10) {
        $(this).siblings('.datePickerHidden').val($(this).val());
        let datevalue = $(this).siblings('.datePickerHidden').val();  //getting date value from calendar
        let formatted_date = datevalue.replaceAll('/', '')
        $(this).val(formatted_date);
        $(this).focus(); //focusing current input on select
        $(this).datepicker('hide');
      }
    });

    $('#datepicker9_oen').on('keyup', function (e) {
      let inputDateValue = $(this).val();  //getting date value from input
      if (inputDateValue.length == 8) {
        let slicedYear = inputDateValue.slice(0, 4);
        let slicedMonth = inputDateValue.slice(4, 6);
        let slicedDay = inputDateValue.slice(6, 8);
        let formatted_sliced_date = slicedYear + "/" + slicedMonth + "/" + slicedDay;
        $(this).siblings('.datePickerHidden').val(formatted_sliced_date);
        $(this).datepicker('setDate', new Date(slicedYear, slicedMonth - 1, slicedDay));
      }
    });
    // Update date value with slash on blur
    $('#datepicker9_oen').on('blur', function () {
      if ($(this).val() != '') {
        $(this).val($(this).siblings('.datePickerHidden').val());
      }
      else if ($(this).val() == '') {
        $(this).val('');
        $(this).siblings('.datePickerHidden').val('');
      }
    });

    //Enter press hide dropdown...
   
    $("#datepicker9_oen").keydown(function (e) {
      if (e.keyCode == 13) {
        $("#datepicker9_oen").datepicker('hide');
      }
    });
  </script>
  <script>
  //6
  $('#datepicker10_oen').datepicker({
      language: 'ja-JP',
      format: 'yyyy/mm/dd',
      autoHide: true,
      zIndex: 10,
      offset: 4,
      trigger: '#datepicker10_oen',
      startDate: $('#datepicker9_oen').datepicker('getDate')
    });

    $('#datepicker10_oen').on('change focus', function () {
      if ($(this).val().length == 10) {
        $(this).siblings('.datePickerHidden').val($(this).val());
        let datevalue = $(this).siblings('.datePickerHidden').val();  //getting date value from calendar
        let formatted_date = datevalue.replaceAll('/', '')
        $(this).val(formatted_date);
        $(this).focus(); //focusing current input on select
        $(this).datepicker('hide');
      }
    });

    $('#datepicker10_oen').on('keyup', function (e) {
      let inputDateValue = $(this).val();  //getting date value from input
      if (inputDateValue.length == 8) {
        let slicedYear = inputDateValue.slice(0, 4);
        let slicedMonth = inputDateValue.slice(4, 6);
        let slicedDay = inputDateValue.slice(6, 8);
        let formatted_sliced_date = slicedYear + "/" + slicedMonth + "/" + slicedDay;
        $(this).siblings('.datePickerHidden').val(formatted_sliced_date);
        $(this).datepicker('setDate', new Date(slicedYear, slicedMonth - 1, slicedDay));
      }
    });
    // Update date value with slash on blur
    $('#datepicker10_oen').on('blur', function () {
      if ($(this).val() != '') {
        $(this).val($(this).siblings('.datePickerHidden').val());
      }
      else if ($(this).val() == '') {
        $(this).val('');
        $(this).siblings('.datePickerHidden').val('');
      }
    });

    //Enter press hide dropdown...
   
    $("#datepicker10_oen").keydown(function (e) {
      if (e.keyCode == 13) {
        $("#datepicker10_oen").datepicker('hide');
      }
    });
  </script>
  <script>
    //6
    $('#datepicker11_oen').datepicker({
        language: 'ja-JP',
        format: 'yyyy/mm/dd',
        autoHide: true,
        zIndex: 10,
        offset: 4,
        trigger: '#datepicker11_oen',
        startDate: $('#datepicker10_oen').datepicker('getDate')
      });
  
      $('#datepicker11_oen').on('change focus', function () {
        if ($(this).val().length == 10) {
          $(this).siblings('.datePickerHidden').val($(this).val());
          let datevalue = $(this).siblings('.datePickerHidden').val();  //getting date value from calendar
          let formatted_date = datevalue.replaceAll('/', '')
          $(this).val(formatted_date);
          $(this).focus(); //focusing current input on select
          $(this).datepicker('hide');
        }
      });
  
      $('#datepicker11_oen').on('keyup', function (e) {
        let inputDateValue = $(this).val();  //getting date value from input
        if (inputDateValue.length == 8) {
          let slicedYear = inputDateValue.slice(0, 4);
          let slicedMonth = inputDateValue.slice(4, 6);
          let slicedDay = inputDateValue.slice(6, 8);
          let formatted_sliced_date = slicedYear + "/" + slicedMonth + "/" + slicedDay;
          $(this).siblings('.datePickerHidden').val(formatted_sliced_date);
          $(this).datepicker('setDate', new Date(slicedYear, slicedMonth - 1, slicedDay));
        }
      });
      // Update date value with slash on blur
      $('#datepicker11_oen').on('blur', function () {
        if ($(this).val() != '') {
          $(this).val($(this).siblings('.datePickerHidden').val());
        }
        else if ($(this).val() == '') {
          $(this).val('');
          $(this).siblings('.datePickerHidden').val('');
        }
      });
  
      //Enter press hide dropdown...
     
      $("#datepicker11_oen").keydown(function (e) {
        if (e.keyCode == 13) {
          $("#datepicker11_oen").datepicker('hide');
        }
      });
    </script>
   <script>
    $("#add_icon").click(function () {
      $("#datepicker1_oen").datepicker('hide');
      $("#datepicker2_oen").datepicker('hide');
      $("#datepicker3_oen").datepicker('hide');
      $("#datepicker4_oen").datepicker('hide');
      $("#datepicker5_oen").datepicker('hide');
      $("#datepicker6_oen").datepicker('hide');
      $("#datepicker7_oen").datepicker('hide');
      $("#datepicker8_oen").datepicker('hide');
      $("#datepicker9_oen").datepicker('hide');
      $("#datepicker10_oen").datepicker('hide');
      $("#datepicker11_oen").datepicker('hide');
    });
  </script>
  <script>
    $(document).on('shown.bs.modal', function (e) {
        $('[autofocus]', e.target).focus();
    });
</script>
  <!-- script for take only 60 characters in textarea field -->
  <script>
    // $('.largeDesc').keypress(function () {
    //   this.value = this.value
    //   .replace(/[\n\r]+/g, "")
    //   .replace(/(.{60})/g, "$1\n");
    // });
    // $('.largeDesc').keyup(function () {
    //   this.value = this.value
    //   .replace(/[\n\r]+/g, "")
    //   .replace(/(.{60})/g, "$1\n");
    // });
    var box = document.getElementById('order_summary_remarks');
var charlimit = 60; // char limit per line
box.onkeyup = function() {
	var lines = box.value.split('\n');
	for (var i = 0; i < lines.length; i++) {
		if (lines[i].length <= charlimit) continue;
		var j = 0; space = charlimit;
		while (j++ <= charlimit) {
			if (lines[i].charAt(j) === ' ') space = j;
		}
		lines[i + 1] = lines[i].substring(space + 1) + (lines[i + 1] || "");
		lines[i] = lines[i].substring(0, space);
	}
	box.value = lines.slice(0, 17).join('\n');
};
    //file upload show name....
    $(".custom-file-input").on("change", function () {
      var fileName = $(this).val().split("\\").pop();
      $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });
  </script>
  <script src="{{asset('js/purchase/supportEntry/number_search.js')}}"></script>
  <script src="{{asset('js/purchase/supportEntry/support_details.js')}}"></script>
</body>

</html>