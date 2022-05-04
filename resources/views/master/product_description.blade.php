@section('menu', '商品説明マスタ')
    <!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="msapplication-tap-highlight" content="no">
    <title>商品説明マスタ</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}">
    <link href="https://use.fontawesome.com/releases/v5.0.4/css/all.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/navbar_styles.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/login_styles.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/modal_styles.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/product_styles.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/pagination_styles.css') }}">
    <script type="text/javascript">


    </script>


    <style>

        /*.tbl_rounded tbody{
            display:block;
      border: 1px solid #32859C;border-radius: 4px!important;
      }*/
        .pl-custom-0 {
            padding-left: 0px !important;
        }

        #radiodiv1Pdes, #radiodiv2Pdes, #radiodiv3Pdes, #radiodiv4Pdes, #radiodiv5Pdes, #radiodiv6Pdes {
            padding-left: 10px !important;
        }

        .pr-custom-0 {
            padding-right: 0px !important;
        }

        .overflow_cls {
            overflow: hidden !important;
        }

        .largeTable {
            padding-bottom: 10px;
            height: 455px;
            overflow: auto;
        }

        @media only screen and (min-width: 1400px) {
            .largeTable {
                padding-bottom: 10px;
                height: 688px;
                overflow: auto;
            }

            .left_right_margin {
                margin-bottom:: 0px;

            }
        }

        .m_t {
            margin-top: 7px;

        }

        @media only screen and (max-width: 767px) {

            #radiodiv1Pdes, #radiodiv2Pdes, #radiodiv3Pdes, #radiodiv4Pdes, #radiodiv5Pdes, #radiodiv6Pdes {
                padding-left: 24px !important;
            }

            .rounded_table_wrap {
                width: 50%;
                padding-left: 15px !important;
            }

            .nav_mview {
                margin-bottom: 15px !important;
            }

            .pagi-input-field {
                height: 36px !important;
            }

            .pl-custom-0 {
                padding-left: 15px !important;
            }

            .pr-custom-0 {
                padding-right: 15px !important;
            }
        }

        }

        .border_none_table td {
            border: 1px solid #29487d !important;
            padding: 4px;
        }


        .form-control-custom-input {
            border: 1px solid #29487d !important;
            background: white;
            height: 28px !important;
            margin-top: 2px;
            border-radius: 0px !important;
        }

        .form-control-custom-input {
            display: block;
            width: auto;
            padding: 0.375rem 0.75rem;
            font-size: 1rem;
            line-height: 1.5;
            color: #495057;
            background-color: #fff;
            -webkit-background-clip: padding-box;
            background-clip: padding-box;
            border: 1px solid #ced4da;
            -webkit-border-radius: 0.25rem;
            border-radius: 0.25rem;
            -webkit-transition: border-color 0.15s ease-in-out, -webkit-box-shadow 0.15s ease-in-out;
            transition: border-color 0.15s ease-in-out, -webkit-box-shadow 0.15s ease-in-out;
            -o-transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
            transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
            transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out, -webkit-box-shadow 0.15s ease-in-out;
        }


        /* #SI - Code starts here */
        .form-group {
            margin-bottom: 0.1rem !important;
        }

        textarea {
            padding: 0px !important;
        }
    </style>


</head>


<body style="">
@include('layout.nav_test')
<div class="container left_right_margin">

    <div class="row">
        <div class="col-lg-12">
            <!--   <section class=" display_section margin_b">
         <div class="row" >
            <div class="col-lg-12 ">
              <div style="margin: auto;width: 200px;">
                <h5 href="#" class=" textfnt "style="color: #405063;border-radius: 10px;box-sizing: border-box; width: 200px; text-align: center!important;border: 2px solid #405063;margin-top: 16px;" > 事業所マスタ</h5>
              </div>
            </div>
         </div> -->

            <!-- display section end -->
            <!-- </section> -->


            <div class="bgcolr_order_inq" style="margin-top:7px; ">

                <div class="wrap-100"
                     style="background-color: #fff;padding: 10px;padding-top: 5px;box-sizing: border-box; overflow: hidden;height: auto;">

                    <div class="row">
                        <div class="col-lg-8 col-sm-12 m-pd">
                            <div class="responsive button-responsive-view">
                                <div class="row">
                                    <div class="col-lg-2 col-sm-3 col-xs-6 col-6 text-center"><a href="#"
                                                                                                 class="btn btn-info btn-m-view "
                                                                                                 style="width: 100%;"><i
                                                class="fa fa-search" aria-hidden="true"
                                                style="margin-right: 5px;"></i>検索</a></div>
                                    <div class="col-lg-2 col-6 col-sm-3 col-xs-6 pl-m text-center"><a href="#"
                                                                                                      class="btn btn-info btn-m-view "
                                                                                                      style="width: 100%;">一覧</a>
                                    </div>
                                    <div class="col-lg-2 col-6 col-sm-3 col-xs-6  pl-m text-center"><a href="#"
                                                                                                       class="btn btn-info btn-m-view  "
                                                                                                       style="width: 100%;"
                                                                                                       data-toggle="modal"
                                                                                                       data-target="#registrationModal">新規登録</a>
                                    </div>
                                    <!--  <div class="col-lg-2 col-6 col-sm-4 col-xs-6 padd-0 mb-2 text-center"><a href="#" class="btn btn-info btn-m-view " style="width: 100%;"data-toggle="modal" data-target="#office_modal2">変更</a></div> -->
                                    <!-- <div class="col-lg-2 col-6 col-sm-4 col-xs-6 pl-m mb-2 text-center"><a href="#" class="btn btn-info btn-m-view "style="width: 100%;">CSV作成</a></div> -->
                                    <div class="col-lg-2 col-sm-3 col-xs-6 col-6 pl-m text-center "><a href="#"
                                                                                                       class="btn btn-info btn-m-view"
                                                                                                       style="width: 100%;">EXCEL作成</a>
                                    </div>

                                    <div class="col-lg-2 col-sm-3 col-xs-6 col-6 pl-m ">
                                        <div class="custom-control custom-checkbox custom-control-inline">
                                            <input type="checkbox" id="btnchk1"
                                                   class="custom-control-input customCheckBox">
                                            <label class="custom-control-label margin_btn_17" for="btnchk1"
                                                   style="line-height: 25px;">削除データ表示</label>
                                        </div>
                                    </div>


                                </div>
                            </div>

                        </div>


                        {{-- <div class="col-lg-4 col-sm-12 m-pd">
                          <div class="row">

                            <div class="col-lg-12 col-sm-12 col-xs-12 col-12 pl-m pr-4"
                              style="display: inline-flex; justify-content: flex-end;">
                              <div class="custom-control custom-checkbox custom-control-inline">
                                <input type="checkbox" id="prdeschk1" class="custom-control-input customCheckBox" checked>
                                <label class="custom-control-label margin_btn_17" for="prdeschk1" style="line-height: 25px;">商品
                                </label>
                              </div>
                              <div class="custom-control custom-checkbox custom-control-inline">
                                <input type="checkbox" id="prdeschk2" class="custom-control-input customCheckBox " checked>
                                <label class="custom-control-label margin_btn_17" for="prdeschk2" style="line-height: 25px;">商品サブ
                                </label>
                              </div>
                            </div>


                          </div>


                        </div> --}}


                    </div>

                    <!-- button table row  end -->


                    <!-- pagination row starts here -->

                    <div class="row">

                        @include('layout.pagi1_settings')
                        @include('layout.pagi2_settings')


                    </div>

                    <!-- pagination row end here -->
                    <!-- Large table row starts here -->
                    <div class="row">
                        <div class="col-lg-12">

                            <div style="overflow: hidden;">
                                <div class="table-responsive largeTable" style="">
                                    <table class="table table-bordered table-striped" style="width: auto;">

                                        <thead class="thead-dark header text-center" id="myHeader">
                                        <tr>
                                            <th scope="col"></th>

                                            <th scope="col"><span
                                                    style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;margin: auto;background-color:#3e6ec1;  color: #fff;">商品説明CD区分</span>
                                            </th>
                                            <th scope="col"><span
                                                    style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;margin: auto;background-color:#3e6ec1;  color: #fff;">商品説明CD</span>
                                            </th>
                                            <th scope="col"><span
                                                    style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;margin: auto;background-color:#3e6ec1;  color: #fff;">商品名</span>
                                            </th>
                                            <th scope="col"><span
                                                    style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;margin: auto;background-color:#3e6ec1;  color: #fff;">見積明細備考</span>
                                            </th>
                                            <th scope="col"><span
                                                    style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;margin: auto;background-color:#3e6ec1;  color: #fff;">サービス内容</span>
                                            </th>
                                            <th scope="col"><span
                                                    style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;margin: auto;background-color:#3e6ec1;  color: #fff;">工数目安</span>
                                            </th>
                                            <th scope="col"><span
                                                    style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;margin: auto;background-color:#3e6ec1;  color: #fff;">成果物</span>
                                            </th>
                                            <th scope="col"><span
                                                    style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;margin: auto;background-color:#3e6ec1;  color: #fff;">社内備考</span>
                                            </th>
                                            <th scope="col"><span
                                                    style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;margin: auto;background-color:#3e6ec1;  color: #fff;">販売時留意点</span>
                                            </th>
                                            <th scope="col"><span
                                                    style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;margin: auto;background-color:#3e6ec1;  color: #fff;">商品説明PDF</span>
                                            </th>
                                            <th scope="col"><span
                                                    style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;margin: auto;background-color:#3e6ec1;  color: #fff;">補足説明</span>
                                            </th>

                                            <th scope="col"><span
                                                    style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;margin: auto;background-color:#3e6ec1;  color: #fff;">入力区分</span>
                                            </th>
                                            <th scope="col"><span
                                                    style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;margin: auto;background-color:#3e6ec1;  color: #fff;">登録年月日</span>
                                            </th>
                                            <th scope="col"><span
                                                    style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;margin: auto;background-color:#3e6ec1;  color: #fff;">登録時刻</span>
                                            </th>
                                            <th scope="col"><span
                                                    style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;margin: auto;background-color:#3e6ec1;  color: #fff;">更新年月日</span>
                                            </th>
                                            <th scope="col"><span
                                                    style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;margin: auto;background-color:#3e6ec1;  color: #fff;">更新時刻</span>
                                            </th>
                                            <th scope="col"><span
                                                    style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;margin: auto;background-color:#3e6ec1;  color: #fff;">更新時端末IP</span>
                                            </th>
                                            <th scope="col"><span
                                                    style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;margin: auto;background-color:#3e6ec1;  color: #fff;">更新者</span>
                                            </th>

                                        </tr>
                                        </thead>

                                        <tbody>


                                        <tr>

                                            <td></td>
                                            <td><input type="text" class="form-control"></td>

                                            <td>
                                                <input type="text" class="form-control">
                                            </td>

                                            <td>
                                                <input type="text" class="form-control">
                                            </td>

                                            <td>
                                                <input type="text" class="form-control">
                                            </td>

                                            <td>
                                                <input type="text" class="form-control">
                                            </td>
                                            <td><input type="text" class="form-control"></td>
                                            <td><input type="text" class="form-control"></td>

                                            <td>
                                                <input type="text" class="form-control">
                                            </td>

                                            <td>
                                                <input type="text" class="form-control">
                                            </td>

                                            <td>
                                                <input type="text" class="form-control">
                                            </td>

                                            <td>
                                                <input type="text" class="form-control">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control">
                                            </td>

                                            <td>
                                                <input type="text" class="form-control">
                                            </td>

                                            <td>
                                                <input type="text" class="form-control">
                                            </td>

                                            <td>
                                                <input type="text" class="form-control">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control">
                                            </td>
                                        </tr>


                                        <tr>
                                            <td style="width:50px;">
                                                <a href="#" id="nameButton1" class="btn btn-info btn-m-view "
                                                   style="width: 100%;"
                                                   data-toggle="modal" data-target="#detailsModal"><i
                                                        class="fa fa-folder-open"
                                                        aria-hidden="true" style="margin-right: 5px;"></i>詳細</a>
                                            </td>


                                            <td>00571</td>
                                            <td>Autoメール名人 導入先</td>
                                            <td>（成果物）システム計画</td>
                                            <td>事前打ち合わせ、製品機</td>
                                            <td>社内0.5日</td>
                                            <td>システム計画書</td>
                                            <td></td>
                                            <td></td>
                                            <td>20191225AM-notes.PD</td>
                                            <td>（当面未使用）</td>
                                            <td>1 商品</td>
                                            <td>1 マスタ索引</td>

                                            <td>2020/04/16</td>
                                            <td>00：00：00</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>

                                        </tr>


                                        <tr>

                                            <td style="width:50px;">
                                                <a href="#" id="nameButton1" class="btn btn-info btn-m-view "
                                                   style="width: 100%;"
                                                   data-toggle="modal" data-target="#detailsModal"><i
                                                        class="fa fa-folder-open"
                                                        aria-hidden="true" style="margin-right: 5px;"></i>詳細</a>
                                            </td>


                                            <td>008720011</td>
                                            <td>EOS名人 ライフ発注ﾃﾞｰ</td>
                                            <td>（成果物）データ項目引</td>
                                            <td>事前打ち合わせ、ライフ</td>
                                            <td>社内0.5日</td>
                                            <td>データ取込後データ内容</td>
                                            <td></td>
                                            <td></td>
                                            <td>ライフオンライン仕様書</td>
                                            <td>（当面未使用）</td>
                                            <td>2 商品サブ</td>
                                            <td>2 入力可</td>

                                            <td>2020/04/16</td>
                                            <td>00：00：00</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>

                                        </tr>


                                        </tbody>
                                    </table>
                                </div>

                            </div>

                        </div>
                    </div>

                </div>
            </div>


            <!-- product content col-12 ends here -->

        </div>
        <!-- product content row ends here -->
    </div>


    <!-- wrap-100 div end -->
</div>
<!-- bgcolor div end -->
</div>


<!-- Modal 1 start here -->

<div class="modal" data-keyboard="false" data-backdrop="static" id="registrationModal" tabindex="-1" role="dialog"
     aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 700px !important;" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <!-- <h6 class="modal-title" id="exampleModalLabel">商品説明マスタ(登録)</h6> -->
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body pt-0">
                <div class="development_page_top_table heading_mt" style="margin:11px;">


                    <!-- <div class="row titlebr" style="margin-bottom: 15px;">
                                    <div class="col-lg-12">
                                        <table class="dev_tble_button" style="float: right;">
                                            <tbody>
                                                <tr>
                                                    <td class="" style="padding-left: 0px!important;width: 100px!important;border:none!important; ">
                                                        新規(処理状況)</td>
                                                </tr>
                                            </tbody>
                                        </table>

                                    </div>
                                </div> -->

                    <!-- #SI - code starts here -->
                    <!-- Title with buttons start here -->
                    <div class="row titlebr" style="margin-bottom: 15px;">

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
                                <button type="button" class="btn btn-info" data-dismiss="modal"><i class="fas fa-save"
                                                                                                   style="margin-right: 5px;"></i>保存
                                </button>
                                {{-- <button type="button" class="btn btn-info" data-dismiss="modal"><i class="fa fa-print"
                                    style="margin-right: 7px;">
                                  </i>印刷 </button> --}}
                            </div>
                        </div>

                    </div>
                    <!-- Title with buttons ends here -->
                    <!-- #SI - code ends here -->

                </div>


                <!--======================= modal 1 table start ======================-->


                <div class="row mt-1 mb-3" data-bind="nextFieldOnEnter:true">

                    <div class="col-lg-12 col-md-12 col-sm-12">


                        <div class="tbl_name">
                            <div class="w-100">
                                <div class=" row row_data">
                                    <div class="col-lg-3 col-md-3 col-sm-3">
                                        <div class="margin_t "><span>商品説明CD区分</span></div>
                                    </div>
                                    <div class="col-lg-9 col-md-9 col-sm-9">

                                        <div class="outer row">
                                            {{-- <div class="col-lg-2 col-md-2 col-sm-2 ">

                                              <input type="text" class="form-control" value="">

                                            </div> --}}

                                            <div class="col-lg-8 col-md-8 col-sm-8 ">
                                                <div class="row">

                                                    <div class="col-lg-12 col-sm-12 col-xs-12 col-12">
                                                        <div id="radiodiv1Pdes"
                                                             class="custom-control custom-radio custom-control-inline mt-1"
                                                             style="margin-left:6px!important;">
                                                            <input type="radio" id="product_d_radio1" name="radiostatus"
                                                                   class="custom-control-input" value="1" tabindex="1"
                                                                   checked="" autofocus>
                                                            <label class="custom-control-label" for="product_d_radio1">商品</label>
                                                        </div>
                                                        <div id="radiodiv2Pdes"
                                                             class="custom-control custom-radio custom-control-inline mt-1">
                                                            <input type="radio" id="product_d_radio2" name="radiostatus"
                                                                   class="custom-control-input" value="1" tabindex="1">
                                                            <label class="custom-control-label" for="product_d_radio2">商品サブ</label>
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
                                            <span>商品説明CD <span style="color: red;">※</span></span></div>


                                    </div>
                                    <div class="col-lg-9 col-md-9 col-sm-9">

                                        <div class="outer row">
                                            <div class="col-lg-3 col-md-3 col-sm-3 pr-custom-0">

                                                <div style="position:relative;"><input type="text" class="form-control"
                                                                                       style=""
                                                                                       value="">
                                                    {{-- <div class="" id="popup2_des1" data-toggle="modal" data-target="#product_sub_modal4" onclick="openModalPopup1(); removeBorder();" data-target=""  style="bottom: 0;float: left;margin-top: 3px;position: absolute;right: 5px;top: 0px;">
                                                      <img src="img/open-book.svg" height="20" width="20" alt="" style="cursor: pointer;">
                                                    </div> --}}
                                                </div>


                                            </div>
                                            {{-- <div class="col-lg-8 col-md-8 col-sm-8 pl-custom-0">
                                              <input type="text" class="form-control" style="" value="">
                                            </div> --}}


                                        </div>

                                    </div>
                                </div>
                                <div class=" row row_data">
                                    <div class="col-lg-3 col-md-3 col-sm-3">
                                        <div class="margin_t "><span>見積明細備考</span></div>
                                    </div>
                                    <div class="col-lg-9 col-md-9 col-sm-9">

                                        <div class="outer row">
                                            <div class="col-lg-12 col-md-12 col-sm-12 ">

                                                <input type="text" class="form-control" value="">

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
                                                    <textarea class="form-control" rows="5" id="comment"
                                                              style="height: 80px;white-space:normal;"></textarea>
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
                                                    <textarea class="form-control" rows="5" id="comment"
                                                              style="height: 80px;white-space:normal;"></textarea>
                                                </div>

                                            </div>

                                        </div>
                                    </div>

                                </div>

                                <div class=" row row_data">
                                    <div class="col-lg-3 col-md-3 col-sm-3">
                                        <div class="margin_t "><span>成果物</span></div>
                                    </div>
                                    <div class="col-lg-9 col-md-9 col-sm-9">

                                        <div class="outer row">
                                            <div class="col-lg-12 col-md-12 col-sm-12 ">

                                                <input type="text" class="form-control" value="">

                                            </div>

                                        </div>
                                    </div>

                                </div>
                                <div class=" row row_data">
                                    <div class="col-lg-3 col-md-3 col-sm-3">
                                        <div class="margin_t "><span>社内備考</span></div>
                                    </div>
                                    <div class="col-lg-9 col-md-9 col-sm-9">

                                        <div class="outer row">
                                            <div class="col-lg-12 col-md-12 col-sm-12 ">

                                                <input type="text" class="form-control" value="">

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
                                                    <textarea class="form-control" rows="5" id="comment"
                                                              style="height: 80px;white-space:normal;"></textarea>
                                                </div>

                                            </div>

                                        </div>
                                    </div>

                                </div>
                                <div class=" row row_data">
                                    <div class="col-lg-3 col-md-3 col-sm-3">
                                        <div class="margin_t "><span>商品説明PDF</span></div>
                                    </div>
                                    <div class="col-lg-9 col-md-9 col-sm-9">

                                        <div class="outer row">
                                            <div class="col-lg-12 col-md-12 col-sm-12 ">
                                                <div style="position:relative;">

                                                    <input name="inp2" id="input_file_prdes1" type="text"
                                                           class="input_field form-control"
                                                           style="height: 42px!important;">

                                                </div>

                                                <div class="custom-file2"
                                                     style="margin-top: 9px;position: absolute;bottom: 0;top: -2px;right: 22px;">
                                                    <input type="file" class="custom-file-input1" id="customFilePrDes1"
                                                           name="filename2">
                                                    <label class=" btn btn-info" for="customFilePrDes1"><i
                                                            class="fa fa-search"
                                                            aria-hidden="true" style="margin-right: 5px;"></i>参照</label>
                                                </div>

                                            </div>
                                            <script>
                                                $(".custom-file-input1").on("change", function () {
                                                    var fileName2 = $(this).val().split("\\").pop();
                                                    $(this).siblings(".custom-file-label2").addClass("selected").html(fileName2);
                                                    $("#input_file_prdes1").val(fileName2);
                                                });
                                            </script>
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

                                                <div class="form-group">
                                                    <textarea class="form-control" rows="5" id="comment"
                                                              style="height: 80px;"></textarea>
                                                </div>

                                            </div>

                                        </div>
                                    </div>

                                </div>


                                <div class=" row row_data">
                                    <div class="col-lg-3 col-md-3 col-sm-3">
                                        <div class="margin_t "><span>入力区分</span></div>
                                    </div>
                                    <div class="col-lg-9 col-md-9 col-sm-9">

                                        <div class="outer row">
                                            <div class="col-lg-2 col-md-2 col-sm-2 ">

                                                <input type="text" class="form-control" value="">

                                            </div>
                                            <div class="col-lg-8 col-md-8 col-sm-8 ">
                                                <div class="m_t" style="font-size:12px;">
                                                    1：マスタ索引　2：入力可
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                            </div>

                        </div>
                    </div>


                </div>

                <!--======================= modal 1 table  end ======================-->
            </div>

            <div class="modal-footer">
                <!-- <button type="button" class="btn btn-info" data-dismiss="modal"><i class="fas fa-save" style="margin-right: 5px;"></i>保存 </button>
      <button type="button" class="btn btn-info" data-dismiss="modal"><i class="fa fa-print" style="margin-right: 7px;">
              </i>印刷 </button> -->

            </div>
        </div>
    </div>
</div>
</div>
<!--============================== moda1 1 finish ====================== -->

<!-- ============================= moda1 2 start here ========================-->

<div class="modal" data-keyboard="false" data-backdrop="static" id="detailsModal" tabindex="-1" role="dialog"
     aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 700px !important;" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <!-- <h6 class="modal-title" id="exampleModalLabel">商品説明マスタ(詳細)</h6> -->
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
                            <table class="dev_tble_button" style="float: right;">
                                <tbody>
                                <tr class="marge_in">
                                    <td class="">

                                        <a class="btn btn-info scroll" style="background-color: #3e6ec1!important;"
                                           data-toggle="modal"
                                           data-target="#"><i class="fa fa-trash" style="margin-right: 7px;">
                                            </i>削除
                                        </a>


                                    </td>
                                    <td class="">
                                        <a class="btn btn-info scroll" id="product_des_Button3" data-toggle="modal"
                                           data-target="#editModal" style="width: 100%;"><i
                                                class="fa fa-pencil-square-o"
                                                aria-hidden="true" style="margin-right: 5px;"></i>変更画面へ</a>
                                    </td>
                                    <td class="" style="padding-left:6px!important;">
                                        <a class="btn btn-info " style=""><i class="" aria-hidden="true"
                                                                             style="margin-right: 5px;"></i>データを戻す</a>
                                    </td>

                                    {{-- <td class="">
                                      <a class="btn btn-info scroll" style=""><i class="fa fa-print" aria-hidden="true"
                                          style="margin-right: 5px;"></i>印刷</a>
                                    </td> --}}
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
                                            {{-- <div class="col-lg-2 col-md-2 col-sm-2 ">

                                                <div class="m_t"></div>
                                            </div> --}}
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
                                            <span>商品説明CD </span></div>


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
                                    <div class="margin_t "><span>見積明細備考</span></div>
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
                                    <div class="margin_t "><span>成果物</span></div>
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
                                    <div class="margin_t "><span>社内備考</span></div>
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
                                    <div class="margin_t "><span>商品説明PDF</span></div>
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
                                            <div class="m_t" style="white-space: normal;word-break: break-all;">
                                                (当面未使用)
                                            </div>

                                        </div>

                                    </div>
                                </div>

                            </div>


                            <div class=" row row_data">
                                <div class="col-lg-3 col-md-3 col-sm-3">
                                    <div class="margin_t "><span>入力区分</span></div>
                                </div>
                                <div class="col-lg-9 col-md-9 col-sm-9">

                                    <div class="outer row">
                                        <div class="col-lg-2 col-md-2 col-sm-2 ">

                                            <div class="m_t">2</div>

                                        </div>
                                        <div class="col-lg-8 col-md-8 col-sm-8 ">
                                            <div class="m_t" style="font-size:12px;">
                                                1：マスタ索引　2：入力可
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
</div>
<!-- ============================moda1 2 finish here ======================= -->

<!-- ============================moda1 3 start here ======================= -->

<div class="modal" data-keyboard="false" data-backdrop="static" id="editModal" tabindex="-1" role="dialog"
     aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 700px !important;" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <!-- <h6 class="modal-title" id="exampleModalLabel">商品説明マスタ(変更)</h6> -->
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="development_page_top_table heading_mt mt-0" style="margin:11px;">


                    <!-- <div class="row titlebr" style="margin-bottom: 15px;">
                                    <div class="col-lg-12">
                                        <table class="dev_tble_button" style="float: right;margin-right: -18px;
                      margin-bottom: 15px;">
                                            <tbody>
                                                <tr>
                                                    <td class="" style="padding-left: 0px!important;width: 100px!important;border:none!important; ">
                                                        変更(処理状況)</td>
                                                </tr>
                                            </tbody>
                                        </table>

                                    </div>
                                </div> -->
                    <!-- #SI - code starts here -->
                    <!-- Title with buttons start here -->
                    <div class="row titlebr" style="margin-bottom: 15px;">

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

                        <div class="col-6 pr-2">
                            <div style="float: right;">
                                <button type="button" class="btn btn-info" data-dismiss="modal"><i class="fas fa-save"
                                                                                                   style="margin-right: 5px;"></i>保存
                                </button>
                                {{-- <button type="button" class="btn btn-info" data-dismiss="modal"><i class="fa fa-print"
                                    style="margin-right: 7px;">
                                  </i>印刷 </button> --}}
                            </div>
                        </div>

                    </div>
                    <!-- Title with buttons ends here -->
                    <!-- #SI - code ends here -->

                </div>

                <!--======================= modal 3 table start ======================-->
                <!---------------modal3 header------------>

                <!---------------modal3 header end------------>
                <div class="row mt-1 mb-3" data-bind="nextFieldOnEnter:true">

                    <div class="col-lg-12 col-md-12 col-sm-12">


                        <div class="tbl_name">
                            <div class="w-100">
                                <div class=" row row_data">
                                    <div class="col-lg-3 col-md-3 col-sm-3">
                                        <div class="margin_t "><span>商品説明CD区分</span></div>
                                    </div>
                                    <div class="col-lg-9 col-md-9 col-sm-9">

                                        <div class="outer row">
                                            {{-- <div class="col-lg-2 col-md-2 col-sm-2 ">

                                                <div class="m_t"></div>
                                            </div> --}}
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
                                            <span>商品説明CD <span style="color: red;">※</span></span></div>


                                    </div>
                                    <div class="col-lg-9 col-md-9 col-sm-9">

                                        <div class="outer row">
                                            <div class="col-lg-2 col-md-2 col-sm-3 pr-custom-0">
                                                <div class="m_t">00571</div>


                                            </div>
                                            <div class="col-lg-8 col-md-8 col-sm-8 pl-custom-0">
                                                <div class="m_t">Autoメール名人 導入先支援運用打合せ</div>
                                            </div>


                                        </div>

                                    </div>
                                </div>
                                <div class=" row row_data">
                                    <div class="col-lg-3 col-md-3 col-sm-3">
                                        <div class="margin_t "><span>見積明細備考</span></div>
                                    </div>
                                    <div class="col-lg-9 col-md-9 col-sm-9">

                                        <div class="outer row">
                                            <div class="col-lg-12 col-md-12 col-sm-12 ">

                                                <input type="text" class="form-control" value="(成果物) システム計画書">

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
                            <textarea class="form-control" rows="5" id="comment"
                                      style="height: 80px;white-space:normal;">事前打ち合わせ、製品機能説明、社内環境整備、パッケージ操作指導（開発ツールは含まず）</textarea>
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
                            <textarea class="form-control" rows="5" id="comment"
                                      style="height: 80px;white-space:normal;">社内0.5日
打合せ1～1.5日
訪問作業0.5日
                            </textarea>
                                                </div>

                                            </div>

                                        </div>
                                    </div>

                                </div>

                                <div class=" row row_data">
                                    <div class="col-lg-3 col-md-3 col-sm-3">
                                        <div class="margin_t "><span>成果物</span></div>
                                    </div>
                                    <div class="col-lg-9 col-md-9 col-sm-9">

                                        <div class="outer row">
                                            <div class="col-lg-12 col-md-12 col-sm-12">

                                                <input type="text" class="form-control" value="システム計画書">

                                            </div>

                                        </div>
                                    </div>

                                </div>
                                <div class=" row row_data">
                                    <div class="col-lg-3 col-md-3 col-sm-3">
                                        <div class="margin_t "><span>社内備考</span></div>
                                    </div>
                                    <div class="col-lg-9 col-md-9 col-sm-9">

                                        <div class="outer row">
                                            <div class="col-lg-12 col-md-12 col-sm-12">

                                                <input type="text" class="form-control" value="">

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
                                                    <textarea class="form-control" rows="5" id="comment"
                                                              style="height: 80px;white-space:normal;"></textarea>
                                                </div>

                                            </div>

                                        </div>
                                    </div>

                                </div>
                                <div class=" row row_data">
                                    <div class="col-lg-3 col-md-3 col-sm-3">
                                        <div class="margin_t "><span>商品説明PDF</span></div>
                                    </div>
                                    <div class="col-lg-9 col-md-9 col-sm-9">

                                        <div class="outer row">
                                            <div class="col-lg-12 col-md-12 col-sm-12">
                                                <div style="position:relative;">

                                                    <input name="inp2" id="input_file_prdes2" type="text"
                                                           class="input_field form-control"
                                                           value="20191225AM-notes.PDF" style="height: 42px!important;">

                                                </div>

                                                <div class="custom-file2"
                                                     style="margin-top: 9px;position: absolute;bottom: 0;top: -2px;right: 22px;">
                                                    <input type="file" class="custom-file-input2" id="customFilePrDes2"
                                                           name="filename3">
                                                    <label class=" btn btn-info" for="customFilePrDes2"><i
                                                            class="fa fa-search"
                                                            aria-hidden="true" style="margin-right: 5px;"></i>参照</label>
                                                </div>

                                            </div>
                                            <script>
                                                $(".custom-file-input2").on("change", function () {
                                                    var fileName2 = $(this).val().split("\\").pop();
                                                    $(this).siblings(".custom-file-label2").addClass("selected").html(fileName2);
                                                    $("#input_file_prdes2").val(fileName2);
                                                });
                                            </script>
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

                                                <div class="form-group">
                            <textarea class="form-control" rows="5" id="comment"
                                      style="height: 80px;white-space:normal;">(当面未使用)</textarea>
                                                </div>

                                            </div>

                                        </div>
                                    </div>

                                </div>


                                <div class=" row row_data">
                                    <div class="col-lg-3 col-md-3 col-sm-3">
                                        <div class="margin_t "><span>入力区分</span></div>
                                    </div>
                                    <div class="col-lg-9 col-md-9 col-sm-9">

                                        <div class="outer row">
                                            <div class="col-lg-2 col-md-2 col-sm-2">

                                                <input type="text" class="form-control" value="2">

                                            </div>
                                            <div class="col-lg-8 col-md-8 col-sm-8 ">
                                                <div class="m_t" style="font-size:12px;">
                                                    1：マスタ索引　2：入力可
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
                <!-- <button type="button" class="btn btn-info" data-dismiss="modal"><i class="fas fa-save" style="margin-right: 5px;"></i>保存 </button>
                          <button type="button" class="btn btn-info" data-dismiss="modal"><i class="fa fa-print" style="margin-right: 7px;">
              </i>印刷 </button> -->
            </div>
        </div>
    </div>
</div>
<!-- ============================moda1 3 end here ======================= -->

<!-- col-12 div end -->
</div>
<!-- row div end -->
</div>

<!-- container-fluid div end -->
</div>
@include('layout.footer')
<!-- ============================new moda1 end here ======================= -->
<div class="modal" data-keyboard="false" data-backdrop="static" id="setting_display_modal" tabindex="-1" role="dialog"
     aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document" style="">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="exampleModalLabel"></h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">


                <div class="row">
                    <div class="col-lg-4">

                        <!--     <a href="#" class="btn btn-info " onclick="table3SelectAll()" id=""style="background-color:#3e6ec1!important;margin-top: 2px;margin-bottom: 20px;" data-toggle="modal" data-target="#">全選択</a>  -->

                        <a class="checkall btn btn-info " style="margin-bottom: 10px;">全選択</a>
                        <a class="uncheck btn btn-info" style="margin-bottom: 10px;">全解除</a>

                    </div>

                    <div class="col-lg-4">


                    </div>
                    <div class="col-lg-4">
                        <a class="btn btn-info " style="margin-bottom: 10px;float: right;">デフォルト</a>

                    </div>

                </div>
                <div id="setting_input_boxwrap_office" data-bind="nextFieldOnEnter:true">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="table-responsive setting_header">
                                <table class="table table-striped  table-bordered">
                                    <tbody class="">

                                    <tr>
                                        <td>
                                            <div class="custom-control custom-checkbox custom-control-inline">
                                                <input type="checkbox" id="th1" class="custom-control-input" checked
                                                       disabled>
                                                <label class="custom-control-label margin_btn_17" for="th1"></label>

                                            </div>
                                        </td>
                                        <td style="width:60px!important;">
                                            <input type="text" class="form-control" value="0" readonly
                                                   onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                                        </td>
                                        <td class="text-left">
                                            <span class="mt-1 text-left">商品説明CD区分</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="custom-control custom-checkbox custom-control-inline">
                                                <input type="checkbox" id="product_description_CD"
                                                       class="custom-control-input customCheckBox">
                                                <label class="custom-control-label margin_btn_17"
                                                       for="product_description_CD"></label>
                                            </div>
                                        </td>
                                        <td style="width:60px!important;">
                                            <input type="tel" class="form-control" autofocus
                                                   onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                                        </td>
                                        <td class="text-left">
                                            <span class="mt-1 text-left">商品説明CD</span>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <div class="custom-control custom-checkbox custom-control-inline">
                                                <input type="checkbox" id="th2"
                                                       class="custom-control-input customCheckBox">
                                                <label class="custom-control-label margin_btn_17" for="th2"></label>
                                            </div>
                                        </td>
                                        <td style="width:60px!important;">
                                            <input type="tel" class="form-control" value=""
                                                   onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                                        </td>
                                        <td class="text-left">
                                            <span class="mt-1 text-left">商品名</span>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <div class="custom-control custom-checkbox custom-control-inline">
                                                <input type="checkbox" id="th3"
                                                       class="custom-control-input customCheckBox">
                                                <label class="custom-control-label margin_btn_17" for="th3"></label>
                                            </div>
                                        </td>
                                        <td style="width:60px!important;">
                                            <input type="tel" class="form-control" value=""
                                                   onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                                        </td>
                                        <td class="text-left">
                                            <span class="mt-1 text-left">見積明細備考</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="custom-control custom-checkbox custom-control-inline">
                                                <input type="checkbox" id="th4"
                                                       class="custom-control-input customCheckBox">
                                                <label class="custom-control-label margin_btn_17" for="th4"></label>
                                            </div>
                                        </td>
                                        <td style="width:60px!important;">
                                            <input type="tel" class="form-control"
                                                   onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                                        </td>
                                        <td class="text-left">
                                            <span class="mt-1 text-left">サービス内容</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="custom-control custom-checkbox custom-control-inline">
                                                <input type="checkbox" id="th5"
                                                       class="custom-control-input customCheckBox">
                                                <label class="custom-control-label margin_btn_17" for="th5"></label>
                                            </div>
                                        </td>
                                        <td style="width:60px!important;">
                                            <input type="tel" class="form-control"
                                                   onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                                        </td>
                                        <td class="text-left">
                                            <span class="mt-1 text-left">工数目安</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="custom-control custom-checkbox custom-control-inline">
                                                <input type="checkbox" id="th6"
                                                       class="custom-control-input customCheckBox">
                                                <label class="custom-control-label margin_btn_17" for="th6"></label>
                                            </div>
                                        </td>
                                        <td style="width:60px!important;">
                                            <input type="tel" class="form-control"
                                                   onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                                        </td>
                                        <td class="text-left">
                                            <span class="mt-1 text-left">成果物</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="custom-control custom-checkbox custom-control-inline">
                                                <input type="checkbox" id="th7"
                                                       class="custom-control-input customCheckBox">
                                                <label class="custom-control-label margin_btn_17" for="th7"></label>
                                            </div>
                                        </td>
                                        <td style="width:60px!important;">
                                            <input type="tel" class="form-control"
                                                   onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                                        </td>
                                        <td class="text-left">
                                            <span class="mt-1 text-left">社内備考</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="custom-control custom-checkbox custom-control-inline">
                                                <input type="checkbox" id="th8"
                                                       class="custom-control-input customCheckBox">
                                                <label class="custom-control-label margin_btn_17" for="th8"></label>
                                            </div>
                                        </td>
                                        <td style="width:60px!important;">
                                            <input type="tel" class="form-control"
                                                   onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                                        </td>
                                        <td class="text-left">
                                            <span class="mt-1 text-left">販売時留意点</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="custom-control custom-checkbox custom-control-inline">
                                                <input type="checkbox" id="th9"
                                                       class="custom-control-input customCheckBox">
                                                <label class="custom-control-label margin_btn_17" for="th9"></label>
                                            </div>
                                        </td>
                                        <td style="width:60px!important;">
                                            <input type="tel" class="form-control"
                                                   onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                                        </td>
                                        <td class="text-left">
                                            <span class="mt-1 text-left">商品説明PDF</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="custom-control custom-checkbox custom-control-inline">
                                                <input type="checkbox" id="th10"
                                                       class="custom-control-input customCheckBox">
                                                <label class="custom-control-label margin_btn_17" for="th10"></label>
                                            </div>
                                        </td>
                                        <td style="width:60px!important;">
                                            <input type="tel" class="form-control"
                                                   onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                                        </td>
                                        <td class="text-left">
                                            <span class="mt-1 text-left">補足説明</span>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <div class="custom-control custom-checkbox custom-control-inline">
                                                <input type="checkbox" id="th12"
                                                       class="custom-control-input customCheckBox">
                                                <label class="custom-control-label margin_btn_17" for="th12"></label>
                                            </div>
                                        </td>
                                        <td style="width:60px!important;">
                                            <input type="tel" class="form-control"
                                                   onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                                        </td>
                                        <td class="text-left">
                                            <span class="mt-1 text-left">入力区分</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="custom-control custom-checkbox custom-control-inline">
                                                <input type="checkbox" id="th13"
                                                       class="custom-control-input customCheckBox">
                                                <label class="custom-control-label margin_btn_17" for="th13"></label>
                                            </div>
                                        </td>
                                        <td style="width:60px!important;">
                                            <input type="tel" class="form-control"
                                                   onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                                        </td>
                                        <td class="text-left">
                                            <span class="mt-1 text-left">登録年月日</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="custom-control custom-checkbox custom-control-inline">
                                                <input type="checkbox" id="th14"
                                                       class="custom-control-input customCheckBox">
                                                <label class="custom-control-label margin_btn_17" for="th14"></label>
                                            </div>
                                        </td>
                                        <td style="width:60px!important;">
                                            <input type="tel" class="form-control"
                                                   onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                                        </td>
                                        <td class="text-left">
                                            <span class="mt-1 text-left">登録時刻</span>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <div class="custom-control custom-checkbox custom-control-inline">
                                                <input type="checkbox" id="th15"
                                                       class="custom-control-input customCheckBox">
                                                <label class="custom-control-label margin_btn_17" for="th15"></label>
                                            </div>
                                        </td>
                                        <td style="width:60px!important;">
                                            <input type="tel" class="form-control"
                                                   onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                                        </td>
                                        <td class="text-left">
                                            <span class="mt-1 text-left">更新年月日</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="custom-control custom-checkbox custom-control-inline">
                                                <input type="checkbox" id="th16"
                                                       class="custom-control-input customCheckBox">
                                                <label class="custom-control-label margin_btn_17" for="th16"></label>
                                            </div>
                                        </td>
                                        <td style="width:60px!important;">
                                            <input type="tel" class="form-control"
                                                   onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                                        </td>
                                        <td class="text-left">
                                            <span class="mt-1 text-left">更新時刻</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="custom-control custom-checkbox custom-control-inline">
                                                <input type="checkbox" id="th17"
                                                       class="custom-control-input customCheckBox">
                                                <label class="custom-control-label margin_btn_17" for="th17"></label>
                                            </div>
                                        </td>
                                        <td style="width:60px!important;">
                                            <input type="tel" class="form-control"
                                                   onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                                        </td>
                                        <td class="text-left">
                                            <span class="mt-1 text-left">更新時端末IP</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="custom-control custom-checkbox custom-control-inline">
                                                <input type="checkbox" id="th18"
                                                       class="custom-control-input customCheckBox">
                                                <label class="custom-control-label margin_btn_17" for="th18"></label>
                                            </div>
                                        </td>
                                        <td style="width:60px!important;">
                                            <input type="tel" class="form-control"
                                                   onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))"
                                                   onkeydown="lastTab1_office(event)">
                                        </td>
                                        <td class="text-left">
                                            <span class="mt-1 text-left">更新者</span>
                                        </td>
                                    </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>


                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-info" data-dismiss="modal"><i class="fas fa-save"
                                                                                   style="margin-right: 5px;"></i>保存
                </button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">

    function lastTab1_office(event) {
        if (event.keyCode == 13) {
            document.getElementById("product_description_CD").focus();
            event.preventDefault();
        }
    }

    // document.onkeydown = function (event) {
    //   if(event.shiftKey && event.keyCode == 13)
    //   {
    //     return false;
    //   }
    // }


</script>
<script>

    $("textarea").keydown(function (event) {
        if (event.keyCode == 13 && !e.shiftKey) {
            event.preventDefault();

        }


    });
</script>
<script>

    ko.bindingHandlers.nextFieldOnEnter = {
        init: function (element, valueAccessor, allBindingsAccessor) {
            $(element).on('keydown', 'input,textarea, select', function (e) {
                var self = $(this)
                    , form = $(element)
                    , focusable
                    , next
                ;

                if (e.keyCode == 13 && !e.shiftKey) {
                    focusable = form.find('input,a,select,textarea,button').filter(':visible');
                    var nextIndex = focusable.index(this) == focusable.length - 1 ? 0 : focusable.index(this) + 1;
                    next = focusable.eq(nextIndex);
                    next.focus();
                    return false;
                }
                if (e.keyCode == 9) {
                    e.preventDefault();
                }
            });
        }
    };

    ko.applyBindings({});

</script>


<link href="//ajax.aspnetcdn.com/ajax/jquery.ui/1.8.9/themes/blitzer/jquery-ui.css" rel="stylesheet" type="text/css">
<script src="{{ asset('js/jquery-3.4.1.min.js') }}"></script>
<!--Bootstrap 4.x-->
<script src="  {{ asset('js/bootstrap.min.js') }}"></script>

<!--Jquery Map for mac operating system-->
<script src=" {{ asset('js/select2.min.js') }}"></script>
<script src="  {{ asset('js/common.js') }}"></script>
<script src="https://ajax.aspnetcdn.com/ajax/knockout/knockout-2.2.1.js" type="text/javascript"></script>


{{-- <script type="text/javascript">
      $("#product_des_Button3").on("click", function() {
          $("#detailsModal").modal("hide");
          $('body').removeClass('modal-open');
          $('body').css('overflow-y', 'hidden');
          $('.modal-backdrop').remove();


      });

  </script> --}}
<script type="text/javascript">
    $("#product_des_Button3").on("click", function () {

        // $('body').removeClass('modal-open');
        //$('body').addClass('overflow_cls');
        $('.modal-backdrop').remove();
        $('#editModal').on('show.bs.modal', function (e) {
            $('body').addClass('overflow_cls');
            $("#detailsModal").modal("hide");
        })
        $('.modal-backdrop').show();
        $('#editModal').on('hide.bs.modal', function (e) {
            $('body').removeClass('overflow_cls');
        })


    });
</script>
<!-- #SI - code starts here -->
<!-- Check uncheck for table settings -->
<script type="text/javascript">
    var state = false; // desecelted

    $('.checkall').click(function () {
        $('.customCheckBox').each(function () {
            if (!state) {
                this.checked = true;
            }
        });
    });

    //Unchecked....
    $('.uncheck').click(function () {
        $('.customCheckBox').each(function () {
            if (!state) {
                this.checked = false;
                $("input[type='tel']").val("");
            }
        });
    });
</script>
<script>


    $("textarea").keydown(function (e) {
        if (e.keyCode == 13 && !e.shiftKey) {
            e.preventDefault();
        } else {
        }
    });


    ko.bindingHandlers.nextFieldOnEnter = {
        init: function (element, valueAccessor, allBindingsAccessor) {
            $(element).on('keydown', 'input,textarea, select', function (e) {
                var self = $(this),
                    form = $(element),
                    focusable, next;

                if (e.keyCode == 13 && !e.shiftKey) {
                    focusable = form.find('input,a,select,textarea,button').filter(':visible');
                    var nextIndex = focusable.index(this) == focusable.length - 1 ? 0 : focusable.index(this) + 1;
                    next = focusable.eq(nextIndex);
                    next.focus();
                    return false;
                }
                if (e.keyCode == 9) {
                    e.preventDefault();
                }
            });
        }
    };

    ko.applyBindings({});
</script>

<script>
    // hover message
    $(function () {
        // $(document).on("hover", ".message_content", function (ev) {
        //   console.log('hhh');
        // var mssg = $(this).attr("class");
        // $('.hover_message').html(mssg);

        $(".message_content").hover(function () {
            var mssg = $(this).attr("message");
            $('.hover_message').html(mssg);
            // console.log('hhh in');
        }, function () {
            // console.log('hhh out');
            //var mssg = $(this).attr("class");
            $('.hover_message').html('');
        });
    });

    // });

    //message on hover on input in modal
    $(function () {
        $(".hover_message_content").hover(function () {
            var mssg = $(this).attr("message");
            $('.modal_hover_message').html(mssg);
        }, function () {
            $('.modal_hover_message').html('');
        });
    });


    // Focus on modal open
    $(document).on('shown.bs.modal', function (e) {
        //$('[autofocus]', e.target).focus();
        if ('a[data-toggle="tab"]') {
            $('[autofocus]', e.target).focus();
        }
    });

    // $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
    //   var target = e.target.attributes.href.value;
    //   $(target +' [autofocus]').focus();
    // });
</script>

<!-- #SI - code ends here -->


<script>
    $(".custom-file1").on("change", function () {
        var fileName2 = $(this).val().split("\\").pop();
        $(this).siblings(".custom-file-label2").addClass("selected").html(fileName2);
        $("#input_file_prdes1").val(fileName2);
    });
</script>


</body>

</html>
