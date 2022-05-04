@section('menu', '個人マスタ')
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="msapplication-tap-highlight" content="no">
    <title>個人マスタ</title>
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

        .m_t{
  margin-top: 7px;

}

  .m-pl-15{
    padding-left: 0px!important;

  }
  .m-pr-15{
 padding-right: 0px!important;

  }
.button_wrap_right_top{
width: 40%;
/*margin: 2%;*/
}
.rounded_table_wrap{
width: 60%;
/*margin: 2%;*/
}
@media only screen and (max-width: 767px)  {

    .m-pl-15{
    padding-left: 15px!important;

  }
  .m-pr-15{
 padding-right: 15px!important;

  }
.rounded_table_wrap{
  width: 50%;
  padding-left: 15px!important;
}
.nav_mview{
      margin-bottom: 15px!important;
}
.pagi-input-field{
  height: 36px!important;
}


.border_none_table td{
    border: 1px solid #29487d!important;
    padding: 4px;
}
}
</style>



</head>


<body style="">
    @include('layout.nav_test')
    <div class="container left_right_margin">

        <div class="row">
            <div class="col-lg-12">
                <!--  <section class=" display_section margin_b">
     <div class="row" >
        <div class="col-lg-12 ">
          <div style="margin: auto;width: 200px;">
            <h5 href="#" class=" textfnt "style="color: #405063;border-radius: 10px;box-sizing: border-box; width: 200px; text-align: center!important;border: 2px solid #405063;margin-top: 16px;" > 個人マスタ</h5>
          </div>
        </div>
     </div> -->

                <!-- display section end -->
                <!-- </section> -->


                <div class="bordera bgcolr_order_inq" style="margin-top: 12px;margin-bottom: 80px; ">

                    <div class="wrap-100" style="margin-top: 25px;background-color: #fff;padding: 10px;box-sizing: border-box; overflow: hidden;height: auto;">

                        <div class="row">
                            <div class="col-lg-8 col-sm-12 m-pd">
                                <div class="responsive button-responsive-view">
                                    <div class="row mb-3 mt-2">
                                        <div class="col-lg-2 col-sm-3 col-xs-6 col-6 mb-2 text-center"><a href="#" class="btn btn-info btn-m-view " style="width: 100%;"><i class="fa fa-search" aria-hidden="true" style="margin-right: 5px;"></i>検索</a></div>
                                        <div class="col-lg-2 col-6 col-sm-3 col-xs-6 pl-m mb-2 text-center"><a href="#" class="btn btn-info btn-m-view " style="width: 100%;">一覧</a></div>
                                        <div class="col-lg-2 col-6 col-sm-3 col-xs-6  pl-m mb-2 text-center"><a href="#" class="btn btn-info btn-m-view  " style="width: 100%;" data-toggle="modal" data-target="#personal_modal1">新規登録</a></div>
                                        <!--  <div class="col-lg-2 col-6 col-sm-4 col-xs-6 padd-0 mb-2 text-center"></div> -->
                                        <!--  <div class="col-lg-2 col-6 col-sm-4 col-xs-6 pl-m mb-2 text-center"><a href="#" class="btn btn-info btn-m-view "style="width: 100%;">CSV作成</a></div> -->
                                        <div class="col-lg-2 col-sm-3 col-xs-6 col-6 pl-m mb-2 text-center "><a href="#" class="btn btn-info btn-m-view" style="width: 100%;">EXCEL作成</a></div>

                                         <div class="col-lg-2 col-sm-3 col-xs-6 col-6 pl-m mb-2" >
                                        <div class="custom-control custom-checkbox custom-control-inline">
                        <input type="checkbox" id="btnchk1" class="custom-control-input customCheckBox">
                         <label class="custom-control-label margin_btn_17" for="btnchk1" style="line-height: 25px;">削除データ表示</label>
                         </div>
                                         </div>

                                    </div>
                                </div>





                            </div>
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
                                <div class="table-responsive" style="padding-bottom: 10px;height: 350px;overflow:auto;">
                                    <table class="table table-bordered table-striped">



                                        <thead class="thead-dark header text-center" id="myHeader">
                                            <tr>
                                                <th scope="col"></th>
                                                <th scope="col"><span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1;  color: #fff;">会社CD</span></th>
                                                <th scope="col"><span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1;  color: #fff;">事業所CD</span></th>
                                                <th scope="col"><span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1;  color: #fff;">個人CD</span></th>
                                                <th scope="col"><span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1;  color: #fff;">部署</span></th>
                                                <th scope="col"><span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1;  color: #fff;">役職</span></th>
                                                <th scope="col"><span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1;  color: #fff;">個人名</span></th>
                                                <th scope="col"><span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1;  color: #fff;">部担当略称</span></th>
                                                <th scope="col"><span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1;  color: #fff;">入力区分</span></th>
                                                <th scope="col"><span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1;  color: #fff;">メールアドレス</span></th>
                                                <th scope="col"><span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1;  color: #fff;">TEL</span></th>
                                                <th scope="col"><span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1;  color: #fff;">FAX</span></th>
                                                <th scope="col"><span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1;  color: #fff;">社内備考（個人）</span></th>
                                                <th scope="col"><span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1;  color: #fff;">案内停止フラグ</span></th>
                                                <th scope="col"><span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1;  color: #fff;">キーマンフラグ</span></th>
                                                <th scope="col"><span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1;  color: #fff;">役員改選案内</span></th>
                                                <th scope="col"><span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1;  color: #fff;">年賀状</span></th>
                                                <th scope="col"><span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1;  color: #fff;">ユーザー会案内 </span></th>
                                                <th scope="col"><span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1;  color: #fff;">送付物フラグ４</span></th>
                                                <th scope="col"><span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1;  color: #fff;">登録年月日</span></th>
                                                <th scope="col"><span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1;  color: #fff;">登録時刻
                                                    </span></th>
                                                <th scope="col"><span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1;  color: #fff;">更新年月日
                                                    </span></th>
                                                <th scope="col"><span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1;  color: #fff;">更新時刻
                                                    </span></th>
                                                <th scope="col"><span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1;  color: #fff;">更新時端末IP
                                                    </span></th>
                                                <th scope="col"><span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1;  color: #fff;">更新者
                                                    </span></th>


                                            </tr>
                                        </thead>

                                        <tbody>


                                            <tr>
                                                <td></td>

                                                <td><input type="text" class="form-control"> </td>
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
                                                <td>
                                                    <input type="text" class="form-control">
                                                </td>






                                            </tr>

                                            <!--      2nd row -->
                                            <tr>
                                                <td style="width:50px;">
                                                    <a href="#" id="sequenceButton1" class="btn btn-info btn-m-view " style="width: 100%;" data-toggle="modal" data-target="#personal_modal2"><i class="fa fa-folder-open" aria-hidden="true" style="margin-right: 5px;"></i>詳細</a>
                                                </td>

                                                <td>111</td>
                                                <td>000001</td>
                                                <td>〇〇〇〇〇株式会社</td>
                                                <td>03</td>
                                                <td>東日本ソリューション事業部 </td>
                                                <td>営業企画部</td>
                                                <td>部長</td>
                                                <td>本田一男</td>
                                                <td>1　入力可</td>
                                                <td>kazuo.honda@mail.xx.co.jp</td>
                                                <td>09011112222</td>
                                                <td>0322223333</td>
                                                <td></td>
                                                <td>1　停止</td>
                                                <td>1　A責任者</td>
                                                <td>1　ON　役員改選案内先</td>
                                                <td>1　ON</td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>



                                            </tr>

                                            <!--      3rd row -->
                                            <tr>
                                                <td style="width:50px;">
                                                    <a href="#" id="sequenceButton1" class="btn btn-info btn-m-view " style="width: 100%;" data-toggle="modal" data-target="#personal_modal2"><i class="fa fa-folder-open" aria-hidden="true" style="margin-right: 5px;"></i>詳細</a>
                                                </td>
                                                <td>112</td>
                                                <td>000001</td>
                                                <td>〇〇〇〇〇株式会社</td>
                                                <td>03</td>
                                                <td>東日本ソリューション事業部 </td>
                                                <td>IT企画部</td>
                                                <td>課長</td>
                                                <td>竹山浩一郎</td>
                                                <td>0　マスタ牽引</td>
                                                <td></td>
                                                <td>080-1111-1111</td>
                                                <td>03-1111-1111</td>
                                                <td></td>
                                                <td>0</td>
                                                <td>2　Bサブ責任者</td>
                                                <td>0</td>
                                                <td>0</td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>




                                            </tr>

                                            <!--      4th row -->
                                            <tr>
                                                <td style="width:50px;">
                                                    <a href="#" id="sequenceButton1" class="btn btn-info btn-m-view " style="width: 100%;" data-toggle="modal" data-target="#personal_modal2"><i class="fa fa-folder-open" aria-hidden="true" style="margin-right: 5px;"></i>詳細</a>
                                                </td>

                                                <td>113</td>
                                                <td>000002</td>
                                                <td>株式会社●●●</td>
                                                <td>04</td>
                                                <td>近畿第一事業部</td>
                                                <td>企画開発部</td>
                                                <td>次長</td>
                                                <td>安部二郎</td>
                                                <td>0　マスタ牽引</td>
                                                <td></td>
                                                <td>090-2222-2222</td>
                                                <td>0000-11-1111</td>
                                                <td></td>
                                                <td>1　停止</td>
                                                <td>1　A責任者</td>
                                                <td>1　ON　役員改選案内先</td>
                                                <td>1　ON</td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>



                                            </tr>
                                            <tr>
                                                <td style="width:50px;">
                                                    <a href="#" id="sequenceButton1" class="btn btn-info btn-m-view " style="width: 100%;" data-toggle="modal" data-target="#personal_modal2"><i class="fa fa-folder-open" aria-hidden="true" style="margin-right: 5px;"></i>詳細</a>
                                                </td>
                                                <td>114</td>
                                                <td>000002</td>
                                                <td>株式会社●●●</td>
                                                <td>04</td>
                                                <td>近畿第一事業部</td>
                                                <td>営業部</td>
                                                <td>副主任</td>
                                                <td>上田次郎</td>
                                                <td>1　入力可</td>
                                                <td></td>
                                                <td>080-3333-3333</td>
                                                <td></td>
                                                <td></td>
                                                <td>0</td>
                                                <td>3　C担当者</td>
                                                <td>0</td>
                                                <td>0</td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
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
            </div>
        </div>


    </div>
    <!--=========================================MODAL 1 START====================================-->
    <div class="modal fade" data-keyboard="false" data-backdrop="static" id="personal_modal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document" style="max-width:800px!important;">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">個人マスタ(登録)</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="development_page_top_table heading_mt" style="margin:11px;margin-right: 0px;">



                        <div class="row titlebr" style="margin-bottom: 15px;">
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
                        </div>

                    </div>
                    <!--=======================Modal 1 button wrapper end ======================-->


                    <div class="table_wrap">


                        <div class="row mt-1 mb-3">

                            <div class="col-lg-12">


                                <div class="tbl_name">
                                    <div class="w-100">

                                        <div class=" row row_data">
                                            <div class="col-lg-2">
                                                <div class="margin_t ">
                                                    <span>会社CD<span style="color: red;">※</span></span>
                                                </div>


                                            </div>
                                            <div class="col-lg-9">

                                                <div class="outer row">
                                                    <div class="col-lg-6 ">
                                                        <select class="form-control" style="width:100%;">
                                                            <option value="1"></option>
                                                            <option value="1"></option>
                                                        </select>


                                                    </div>
                                                    <div class="col-lg-6  m-pl-15 ">
                                                        <div class="m_t"></div>

                                                    </div>
                                                </div>

                                            </div>

                                        </div>
                                        <div class=" row row_data">
                                            <div class="col-lg-2">
                                                <div class="margin_t ">
                                                    <span>事業所CD</span>
                                                </div>


                                            </div>
                                            <div class="col-lg-9">

                                                <div class="outer row">

                                                    <div class="col-lg-6 ">
                                                        <select class="form-control" style="width:100%;">
                                                            <option value="1"></option>
                                                            <option value="1"></option>
                                                        </select>

                                                    </div>
                                                    <div class="col-lg-6 ">
                                                        <div class="m_t"></div>

                                                    </div>
                                                </div>

                                            </div>

                                        </div>

                                      <!--   <div class=" row row_data">
                                            <div class="col-lg-2">
                                                <div class="margin_t ">
                                                    <span>個人ID</span>
                                                </div>


                                            </div>
                                            <div class="col-lg-9">

                                                <div class="outer row">

                                                    <div class="col-lg-6 ">
                                                        <input type="text" class="form-control">

                                                    </div>
                                                </div>

                                            </div>

                                        </div> -->
                                        <div class=" row row_data">
                                            <div class="col-lg-2">
                                                <div class="margin_t ">
                                                    <span>部署</span>
                                                </div>


                                            </div>
                                            <div class="col-lg-9">

                                                <div class="outer row">

                                                    <div class="col-lg-6 ">
                                                        <input type="text" class="form-control">

                                                    </div>
                                                </div>

                                            </div>

                                        </div>
                                        <div class=" row row_data">
                                            <div class="col-lg-2">
                                                <div class="margin_t ">
                                                    <span>役職</span>
                                                </div>


                                            </div>
                                            <div class="col-lg-9">

                                                <div class="outer row">

                                                    <div class="col-lg-6 ">
                                                        <input type="text" class="form-control">

                                                    </div>
                                                </div>

                                            </div>

                                        </div>
                                        <div class=" row row_data">
                                            <div class="col-lg-2">
                                                <div class="margin_t ">
                                                    <span>個人名</span>
                                                </div>


                                            </div>
                                            <div class="col-lg-9">

                                                <div class="outer row">

                                                    <div class="col-lg-6 ">
                                                        <input type="text" class="form-control">

                                                    </div>
                                                    <div class="col-lg-6 ">
                                                        <div class="outer row">
                                                            <div class="col-lg-4 ">

                                                                <div class="m_t">入力区分</div>
                                                            </div>
                                                            <div class="col-lg-8 ">

                                                                <select class="form-control" style="width:100%;">
                                                                    <option value="1">1 入力可</option>
                                                                    <option value="1">0 マスタ索引</option>
                                                                </select>

                                                            </div>

                                                        </div>

                                                    </div>

                                                </div>

                                            </div>

                                        </div>
                                        <div class=" row row_data">
                                            <div class="col-lg-2">
                                                <div class="margin_t ">
                                                    <span>部担当略称</span>
                                                </div>


                                            </div>
                                            <div class="col-lg-9">

                                                <div class="outer row">

                                                    <div class="col-lg-6 ">
                                                        <input type="text" class="form-control">

                                                    </div>
                                                </div>

                                            </div>

                                        </div>
                                        <div class=" row row_data">
                                            <div class="col-lg-2">
                                                <div class="margin_t ">
                                                    <span>メールアドレス</span>
                                                </div>


                                            </div>
                                            <div class="col-lg-9">

                                                <div class="outer row">

                                                    <div class="col-lg-6 ">
                                                        <input type="text" class="form-control">

                                                    </div>
                                                </div>

                                            </div>

                                        </div>


                                        <div class=" row row_data">
                                            <div class="col-lg-2">
                                                <div class="margin_t ">
                                                    <span>メールアドレス<br />(確認用)</span>
                                                </div>


                                            </div>
                                            <div class="col-lg-9">

                                                <div class="outer row">

                                                    <div class="col-lg-6 ">
                                                        <input type="text" class="form-control">

                                                    </div>
                                                </div>

                                            </div>

                                        </div>
                                        <div class=" row row_data">
                                            <div class="col-lg-2">
                                                <div class="margin_t ">
                                                    <span>TEL</span>
                                                </div>


                                            </div>
                                            <div class="col-lg-9">

                                                <div class="outer row">

                                                    <div class="col-lg-6 ">
                                                        <input type="text" class="form-control">

                                                    </div>
                                                </div>

                                            </div>

                                        </div>
                                        <div class=" row row_data">
                                            <div class="col-lg-2">
                                                <div class="margin_t ">
                                                    <span>FAX</span>
                                                </div>


                                            </div>
                                            <div class="col-lg-9">

                                                <div class="outer row">

                                                    <div class="col-lg-6 ">
                                                        <input type="text" class="form-control">

                                                    </div>
                                                </div>

                                            </div>

                                        </div>

                                        <div class=" row row_data">
                                            <div class="col-lg-2">
                                                <div class="margin_t ">
                                                    <span>社内備考</span>
                                                </div>


                                            </div>
                                            <div class="col-lg-9">

                                                <div class="outer row">

                                                    <div class="col-lg-8 ">
                                                        <div class="form-group">

                                                            <textarea class="form-control" rows="5" id="comment" style="height: 80px;"></textarea>
                                                        </div>

                                                    </div>
                                                </div>

                                            </div>

                                        </div>




                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-1 mb-3">

                            <div class="col-lg-6">


                                <div class="tbl_name">
                                    <div class="w-100">


                                        <div class=" row row_data">
                                            <div class="col-lg-4">
                                                <div class="margin_t ">
                                                    <span>案内停止フラグ</span>
                                                </div>


                                            </div>
                                            <div class="col-lg-8">

                                                <div class="outer row">

                                                    <div class="col-lg-12 ">
                                                        <select class="form-control" style="width:100%;">
                                                            <option value="1">0 NULL</option>
                                                            <option value="1">1 停止</option>

                                                        </select>

                                                    </div>
                                                </div>

                                            </div>

                                        </div>

                                        <div class=" row row_data">
                                            <div class="col-lg-4">
                                                <div class="margin_t ">
                                                    <span>キーマンフラグ</span>
                                                </div>


                                            </div>
                                            <div class="col-lg-8">

                                                <div class="outer row">

                                                    <div class="col-lg-12 ">
                                                        <select class="form-control" style="width:100%;">
                                                            <option value="1">1 A責任者</option>
                                                            <option value="1">2 Bサブ責任者</option>
                                                            <option value="1">3 C担当者</option>

                                                        </select>

                                                    </div>
                                                </div>

                                            </div>

                                        </div>



                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">


                                <div class="tbl_name">
                                    <div class="w-100">

                                        <div class=" row row_data">
                                            <div class="col-lg-4">
                                                <div class="margin_t ">
                                                    <span>役員改選案内</span>
                                                </div>


                                            </div>
                                            <div class="col-lg-8">

                                                <div class="outer row">

                                                    <div class="col-lg-12 ">
                                                        <select class="form-control" style="width:100%;">
                                                            <option value="1">0 NULL</option>
                                                            <option value="1">1 送付する</option>
                                                        </select>

                                                    </div>
                                                </div>

                                            </div>

                                        </div>
                                        <div class=" row row_data">
                                            <div class="col-lg-4">
                                                <div class="margin_t ">
                                                    <span>年賀状</span>
                                                </div>


                                            </div>
                                            <div class="col-lg-8">

                                                <div class="outer row">

                                                    <div class="col-lg-12 ">
                                                        <select class="form-control" style="width:100%;">
                                                            <option value="1">0 NULL</option>
                                                            <option value="1">1 送付する</option>
                                                        </select>

                                                    </div>
                                                </div>

                                            </div>

                                        </div>

                                        <div class=" row row_data">
                                            <div class="col-lg-4">
                                                <div class="margin_t ">
                                                    <span>ユーザー会案内</span>
                                                </div>


                                            </div>
                                            <div class="col-lg-8">

                                                <div class="outer row">

                                                    <div class="col-lg-12 ">
                                                        <select class="form-control" style="width:100%;">
                                                            <option value="1">0 NULL</option>
                                                            <option value="1">1 送付する</option>


                                                        </select>

                                                    </div>
                                                </div>

                                            </div>

                                        </div>

                                        <div class=" row row_data">
                                            <div class="col-lg-4">
                                                <div class="margin_t ">
                                                    <span>送付物フラグ４</span>
                                                </div>


                                            </div>
                                            <div class="col-lg-8">

                                                <div class="outer row">

                                                    <div class="col-lg-12 ">
                                                        <select class="form-control" style="width:100%;">
                                                            <option value="1">0 NULL</option>
                                                            <option value="1">1 送付する</option>

                                                        </select>

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
                     <button type="button" class="btn btn-info" data-dismiss="modal"><i class="fas fa-save" style="margin-right: 5px;"></i>保存 </button>
        <button type="button" class="btn btn-info" data-dismiss="modal"><i class="fa fa-print" style="margin-right: 7px;">
        </i>印刷 </button>
                </div>


            </div>
        </div>

    </div>


    <!--===================================MODAL 2 START==============================-->

    <div class="modal fade"data-keyboard="false" data-backdrop="static"  id="personal_modal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 800px!important;">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">個人マスタ(詳細)</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="development_page_top_table heading_mt" style="margin:11px;margin-right: 0px;">



                        <div class="row titlebr" style="margin-bottom: 15px;">
                            <div class="col-lg-12">
                                <table class="dev_tble_button" style="float: right;">
                                    <tbody>
                                        <tr class="marge_in">

                                            <td class="" style="padding-right: 10px!important;">

             <a class="btn btn-info scroll" style="background-color: #3e6ec1!important;" data-toggle="modal" data-target="#"><i class="fa fa-trash" style="margin-right: 7px;">
        </i>削除
</a>


           </td>
                                            <td class="" style="padding-left: 0px!important;width: 70px!important;">
                                                <a class="btn btn-info scroll" data-toggle="modal" id="personalButton3" data-target="#personal_modal3" style=""><i class="fa fa-pencil-square-o" aria-hidden="true" style="margin-right: 5px;"></i>変更画面へ</a>
                                            </td>
                                            <td class="" style="padding-left: 10px!important;">
                                                <a class="btn btn-info scroll" style=""><i class="fa fa-print" aria-hidden="true" style="margin-right: 5px;"></i>印刷</a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>

                            </div>
                        </div>

                    </div>
                    <!--=======================Modal 1 button wrapper end ======================-->


                    <div class="table_wrap">


                        <div class="row mt-1 mb-3">

                            <div class="col-lg-12">


                                <div class="tbl_name">
                                    <div class="w-100">

                                        <div class=" row row_data">
                                            <div class="col-lg-2">
                                                <div class="margin_t ">
                                                    <span>会社CD<span style="color: red;">※</span></span>
                                                </div>


                                            </div>
                                            <div class="col-lg-9">

                                                <div class="outer row">
                                                    <div class="col-lg-6 ">
                                                        <div class="m_t">123456</div>


                                                    </div>
                                                    <div class="col-lg-6  m-pl-15 ">
                                                        <div class="m_t">株式会社ジョイアス・フーズ</div>

                                                    </div>
                                                </div>

                                            </div>

                                        </div>
                                        <div class=" row row_data">
                                            <div class="col-lg-2">
                                                <div class="margin_t ">
                                                    <span>事業所CD</span>
                                                </div>


                                            </div>
                                            <div class="col-lg-9">

                                                <div class="outer row">

                                                    <div class="col-lg-6 ">
                                                        <div class="m_t">12</div>

                                                    </div>
                                                    <div class="col-lg-6 m-pl-15 ">
                                                        <div class="m_t">北海道支店</div>

                                                    </div>
                                                </div>

                                            </div>

                                        </div>

                                        <div class=" row row_data">
                                            <div class="col-lg-2">
                                                <div class="margin_t ">
                                                    <span>個人CD</span>
                                                </div>


                                            </div>
                                            <div class="col-lg-9">

                                                <div class="outer row">

                                                    <div class="col-lg-6 ">
                                                        <div class="m_t">797</div>

                                                    </div>
                                                </div>

                                            </div>

                                        </div>
                                        <div class=" row row_data">
                                            <div class="col-lg-2">
                                                <div class="margin_t ">
                                                    <span>部署</span>
                                                </div>


                                            </div>
                                            <div class="col-lg-9">

                                                <div class="outer row">

                                                    <div class="col-lg-6 ">
                                                        <div class="m_t">営業部</div>

                                                    </div>
                                                </div>

                                            </div>

                                        </div>
                                        <div class=" row row_data">
                                            <div class="col-lg-2">
                                                <div class="margin_t ">
                                                    <span>役職</span>
                                                </div>


                                            </div>
                                            <div class="col-lg-9">

                                                <div class="outer row">

                                                    <div class="col-lg-6 ">
                                                        <div class="m_t">部長</div>

                                                    </div>
                                                </div>

                                            </div>

                                        </div>
                                        <div class=" row row_data">
                                            <div class="col-lg-2">
                                                <div class="margin_t ">
                                                    <span>個人名</span>
                                                </div>


                                            </div>
                                            <div class="col-lg-9">

                                                <div class="outer row">

                                                    <div class="col-lg-6 ">
                                                        <div class="m_t">小川太郎</div>

                                                    </div>
                                                    <div class="col-lg-6 ">
                                                        <div class="outer row">
                                                            <div class="col-lg-4 ">

                                                                <div class="m_t">入力区分</div>
                                                            </div>
                                                            <div class="col-lg-8 ">
                                                                <div class="m_t">1 入力可</div>
                                                                <!--    <input type="text" class="form-control" value="0322223333"> -->

                                                            </div>

                                                        </div>

                                                    </div>


                                                </div>

                                            </div>

                                        </div>
                                        <div class=" row row_data">
                                            <div class="col-lg-2">
                                                <div class="margin_t ">
                                                    <span>部担当略称</span>
                                                </div>


                                            </div>
                                            <div class="col-lg-9">

                                                <div class="outer row">

                                                    <div class="col-lg-6 ">
                                                        <div class="m_t">営業</div>

                                                    </div>
                                                </div>

                                            </div>

                                        </div>
                                        <div class=" row row_data">
                                            <div class="col-lg-2">
                                                <div class="margin_t ">
                                                    <span>メールアドレス</span>
                                                </div>


                                            </div>
                                            <div class="col-lg-9">

                                                <div class="outer row">

                                                    <div class="col-lg-6 ">
                                                        <div class="m_t">kazuo.honda@mail.xx.cop</div>



                                                    </div>
                                                </div>

                                            </div>

                                        </div>


                                        <div class=" row row_data">
                                            <div class="col-lg-2">
                                                <div class="margin_t ">
                                                    <span>メールアドレス<br />(確認用)</span>
                                                </div>


                                            </div>
                                            <div class="col-lg-9">

                                                <div class="outer row">

                                                    <div class="col-lg-6 ">
                                                        <div class="m_t">kazuo.honda@mail.xx.cop</div>

                                                    </div>
                                                </div>

                                            </div>

                                        </div>
                                        <div class=" row row_data">
                                            <div class="col-lg-2">
                                                <div class="margin_t ">
                                                    <span>TEL</span>
                                                </div>


                                            </div>
                                            <div class="col-lg-9">

                                                <div class="outer row">

                                                    <div class="col-lg-6 ">
                                                        <div class="m_t">09011112222</div>

                                                    </div>
                                                </div>

                                            </div>

                                        </div>
                                        <div class=" row row_data">
                                            <div class="col-lg-2">
                                                <div class="margin_t ">
                                                    <span>FAX</span>
                                                </div>


                                            </div>
                                            <div class="col-lg-9">

                                                <div class="outer row">

                                                    <div class="col-lg-6 ">
                                                        <div class="m_t">0322223333</div>

                                                    </div>
                                                </div>

                                            </div>

                                        </div>

                                        <div class=" row row_data">
                                            <div class="col-lg-2">
                                                <div class="margin_t ">
                                                    <span>社内備考</span>
                                                </div>


                                            </div>
                                            <div class="col-lg-9">

                                                <div class="outer row">

                                                    <div class="col-lg-8 ">
                                                        <div class="form-group">

                                                            <div class="m_t"></div>
                                                        </div>

                                                    </div>
                                                </div>

                                            </div>

                                        </div>




                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-1 mb-3">

                            <div class="col-lg-6">


                                <div class="tbl_name">
                                    <div class="w-100">


                                        <div class=" row row_data">
                                            <div class="col-lg-4">
                                                <div class="margin_t ">
                                                    <span>案内停止フラグ</span>
                                                </div>


                                            </div>
                                            <div class="col-lg-8">

                                                <div class="outer row">

                                                    <div class="col-lg-12 ">
                                                        <div class="m_t">0 NULL</div>

                                                    </div>
                                                </div>

                                            </div>

                                        </div>

                                        <div class=" row row_data">
                                            <div class="col-lg-4">
                                                <div class="margin_t ">
                                                    <span>キーマンフラグ</span>
                                                </div>


                                            </div>
                                            <div class="col-lg-8">

                                                <div class="outer row">

                                                    <div class="col-lg-12 ">
                                                        <div class="m_t">1 A責任者</div>


                                                    </div>
                                                </div>

                                            </div>

                                        </div>



                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">


                                <div class="tbl_name">
                                    <div class="w-100">

                                        <div class=" row row_data">
                                            <div class="col-lg-4">
                                                <div class="margin_t ">
                                                    <span>役員改選案内</span>
                                                </div>


                                            </div>
                                            <div class="col-lg-8">

                                                <div class="outer row">

                                                    <div class="col-lg-12 ">
                                                        <div class="m_t">1 送付する</div>


                                                    </div>
                                                </div>

                                            </div>

                                        </div>
                                        <div class=" row row_data">
                                            <div class="col-lg-4">
                                                <div class="margin_t ">
                                                    <span>年賀状</span>
                                                </div>


                                            </div>
                                            <div class="col-lg-8">

                                                <div class="outer row">

                                                    <div class="col-lg-12 ">
                                                        <div class="m_t">1 送付する</div>

                                                    </div>
                                                </div>

                                            </div>

                                        </div>

                                        <div class=" row row_data">
                                            <div class="col-lg-4">
                                                <div class="margin_t ">
                                                    <span>ユーザー会案内</span>
                                                </div>


                                            </div>
                                            <div class="col-lg-8">

                                                <div class="outer row">

                                                    <div class="col-lg-12 ">
                                                        <div class="m_t">1 送付する</div>

                                                    </div>
                                                </div>

                                            </div>

                                        </div>

                                        <div class=" row row_data">
                                            <div class="col-lg-4">
                                                <div class="margin_t ">
                                                    <span>送付物フラグ４</span>
                                                </div>


                                            </div>
                                            <div class="col-lg-8">

                                                <div class="outer row">

                                                    <div class="col-lg-12 ">
                                                        <div class="m_t">0 NULL</div>


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
                    <!--    <button type="button" class="btn btn-info" data-dismiss="modal"><i class="fas fa-save" style="margin-right: 5px;"></i>保存 </button> -->
                    <!--  <button type="button" class="btn btn-info" data-dismiss="modal">キャンセル </button> -->
                </div>


            </div>
        </div>

    </div>

    <!-- </div> -->

    <!--===================================MODAL 2 END==============================-->
    <!--===================================MODAL personal 3 start==============================-->

    <div class="modal fade" data-keyboard="false" data-backdrop="static" id="personal_modal3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 800px!important;">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">個人マスタ(変更)</h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="development_page_top_table heading_mt" style="margin:11px;margin-right: 0px;">



                        <div class="row titlebr" style="margin-bottom: 15px;">
                            <div class="col-lg-12">
                                <table class="dev_tble_button" style="float: right;">
                                    <tbody>
                                        <tr>
                                            <td class="" style="padding-left: 0px!important;width: 100px!important;border:none!important; ">
                                                変更(処理状況)</td>
                                        </tr>
                                    </tbody>
                                </table>

                            </div>
                        </div>

                    </div>
                    <!--=======================Modal 1 button wrapper end ======================-->


                    <div class="table_wrap">


                        <div class="row mt-1 mb-3">

                            <div class="col-lg-12">


                                <div class="tbl_name">
                                    <div class="w-100">

                                        <div class=" row row_data">
                                            <div class="col-lg-2">
                                                <div class="margin_t ">
                                                    <span>会社CD<span style="color: red;">※</span></span>
                                                </div>


                                            </div>
                                            <div class="col-lg-9">

                                                <div class="outer row">
                                                    <div class="col-lg-6 ">
                                                        <select class="form-control" style="width:100%;">
                                                            <option value="1">123456</option>
                                                            <option value="1"></option>
                                                        </select>


                                                    </div>
                                                    <div class="col-lg-6  m-pl-15 ">
                                                        <div class="m_t">株式会社ジョイアス・フーズ</div>

                                                    </div>
                                                </div>

                                            </div>

                                        </div>
                                        <div class=" row row_data">
                                            <div class="col-lg-2">
                                                <div class="margin_t ">
                                                    <span>事業所CD</span>
                                                </div>


                                            </div>
                                            <div class="col-lg-9">

                                                <div class="outer row">

                                                    <div class="col-lg-6 ">
                                                        <select class="form-control" style="width:100%;">
                                                            <option value="1">12</option>
                                                            <option value="1"></option>
                                                        </select>

                                                    </div>
                                                    <div class="col-lg-6 m-pl-15 ">
                                                        <div class="m_t">北海道支店</div>

                                                    </div>
                                                </div>

                                            </div>

                                        </div>

                                        <div class=" row row_data">
                                            <div class="col-lg-2">
                                                <div class="margin_t ">
                                                    <span>個人CD</span>
                                                </div>


                                            </div>
                                            <div class="col-lg-9">

                                                <div class="outer row">

                                                    <div class="col-lg-6">
                                                        <input type="text" class="form-control" value="797">
                                                        <!--      <div class="m_t"></div>  -->

                                                    </div>
                                                </div>

                                            </div>

                                        </div>
                                        <div class=" row row_data">
                                            <div class="col-lg-2">
                                                <div class="margin_t ">
                                                    <span>部署</span>
                                                </div>


                                            </div>
                                            <div class="col-lg-9">

                                                <div class="outer row">

                                                    <div class="col-lg-6 ">
                                                        <input type="text" class="form-control" value="営業部">

                                                    </div>
                                                </div>

                                            </div>

                                        </div>
                                        <div class=" row row_data">
                                            <div class="col-lg-2">
                                                <div class="margin_t ">
                                                    <span>役職</span>
                                                </div>


                                            </div>
                                            <div class="col-lg-9">

                                                <div class="outer row">

                                                    <div class="col-lg-6 ">
                                                        <input type="text" class="form-control" value="部長">

                                                    </div>
                                                </div>

                                            </div>

                                        </div>
                                        <div class=" row row_data">
                                            <div class="col-lg-2">
                                                <div class="margin_t ">
                                                    <span>個人名</span>
                                                </div>


                                            </div>
                                            <div class="col-lg-9">

                                                <div class="outer row">

                                                    <div class="col-lg-6 ">
                                                        <input type="text" class="form-control" value="小川太郎">

                                                    </div>

                                                    <div class="col-lg-6 ">
                                                        <div class="outer row">
                                                            <div class="col-lg-4 ">

                                                                <div class="m_t">入力区分</div>
                                                            </div>
                                                            <div class="col-lg-8 ">
                                                                <select class="form-control" style="width:100%;">
                                                                    <option value="1">1 入力可</option>
                                                                    <option value="1"></option>
                                                                </select>


                                                            </div>

                                                        </div>

                                                    </div>

                                                </div>

                                            </div>

                                        </div>
                                        <div class=" row row_data">
                                            <div class="col-lg-2">
                                                <div class="margin_t ">
                                                    <span>部担当略称</span>
                                                </div>


                                            </div>
                                            <div class="col-lg-9">

                                                <div class="outer row">

                                                    <div class="col-lg-6 ">
                                                        <input type="text" class="form-control" value="営業">

                                                    </div>
                                                </div>

                                            </div>

                                        </div>
                                        <div class=" row row_data">
                                            <div class="col-lg-2">
                                                <div class="margin_t ">
                                                    <span>メールアドレス</span>
                                                </div>


                                            </div>
                                            <div class="col-lg-9">

                                                <div class="outer row">

                                                    <div class="col-lg-6 ">
                                                        <input type="text" class="form-control" value="kazuo.honda@mail.xx.cop">

                                                    </div>
                                                </div>

                                            </div>

                                        </div>


                                        <div class=" row row_data">
                                            <div class="col-lg-2">
                                                <div class="margin_t ">
                                                    <span>メールアドレス <br />(確認用)</span>
                                                </div>


                                            </div>
                                            <div class="col-lg-9">

                                                <div class="outer row">

                                                    <div class="col-lg-6 ">
                                                        <input type="text" class="form-control" value="kazuo.honda@mail.xx.cop">

                                                    </div>
                                                </div>

                                            </div>

                                        </div>
                                        <div class=" row row_data">
                                            <div class="col-lg-2">
                                                <div class="margin_t ">
                                                    <span>TEL</span>
                                                </div>


                                            </div>
                                            <div class="col-lg-9">

                                                <div class="outer row">

                                                    <div class="col-lg-6 ">
                                                        <input type="text" class="form-control" value="09011112222">

                                                    </div>
                                                </div>

                                            </div>

                                        </div>
                                        <div class=" row row_data">
                                            <div class="col-lg-2">
                                                <div class="margin_t ">
                                                    <span>FAX</span>
                                                </div>


                                            </div>
                                            <div class="col-lg-9">

                                                <div class="outer row">

                                                    <div class="col-lg-6 ">
                                                        <input type="text" class="form-control" value="0322223333">

                                                    </div>
                                                </div>

                                            </div>

                                        </div>

                                        <div class=" row row_data">
                                            <div class="col-lg-2">
                                                <div class="margin_t ">
                                                    <span>社内備考</span>
                                                </div>


                                            </div>
                                            <div class="col-lg-9">

                                                <div class="outer row">

                                                    <div class="col-lg-8 ">
                                                        <div class="form-group">

                                                            <textarea class="form-control" rows="5" id="comment" style="height: 80px;"></textarea>
                                                        </div>

                                                    </div>
                                                </div>

                                            </div>

                                        </div>




                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-1 mb-3">

                            <div class="col-lg-6">


                                <div class="tbl_name">
                                    <div class="w-100">


                                        <div class=" row row_data">
                                            <div class="col-lg-4">
                                                <div class="margin_t ">
                                                    <span>案内停止フラグ</span>
                                                </div>


                                            </div>
                                            <div class="col-lg-8">

                                                <div class="outer row">

                                                    <div class="col-lg-12 ">
                                                        <select class="form-control" style="width:100%;">
                                                            <option value="1">0 NULL</option>
                                                            <option value="1">1 停止</option>

                                                        </select>

                                                    </div>
                                                </div>

                                            </div>

                                        </div>

                                        <div class=" row row_data">
                                            <div class="col-lg-4">
                                                <div class="margin_t ">
                                                    <span>キーマンフラグ</span>
                                                </div>


                                            </div>
                                            <div class="col-lg-8">

                                                <div class="outer row">

                                                    <div class="col-lg-12 ">
                                                        <select class="form-control" style="width:100%;">
                                                            <option value="1">1 A責任者</option>
                                                            <option value="1">2 Bサブ責任者</option>
                                                            <option value="1">3 C担当者</option>

                                                        </select>

                                                    </div>
                                                </div>

                                            </div>

                                        </div>



                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">


                                <div class="tbl_name">
                                    <div class="w-100">

                                        <div class=" row row_data">
                                            <div class="col-lg-4">
                                                <div class="margin_t ">
                                                    <span>役員改選案内</span>
                                                </div>


                                            </div>
                                            <div class="col-lg-8">

                                                <div class="outer row">

                                                    <div class="col-lg-12 ">
                                                        <select class="form-control" style="width:100%;">
                                                            <option value="1">0 NULL</option>
                                                            <option value="1">1 送付する</option>
                                                        </select>

                                                    </div>
                                                </div>

                                            </div>

                                        </div>
                                        <div class=" row row_data">
                                            <div class="col-lg-4">
                                                <div class="margin_t ">
                                                    <span>年賀状</span>
                                                </div>


                                            </div>
                                            <div class="col-lg-8">

                                                <div class="outer row">

                                                    <div class="col-lg-12 ">
                                                        <select class="form-control" style="width:100%;">
                                                            <option value="1">0 NULL</option>
                                                            <option value="1">1 送付する</option>
                                                        </select>

                                                    </div>
                                                </div>

                                            </div>

                                        </div>

                                        <div class=" row row_data">
                                            <div class="col-lg-4">
                                                <div class="margin_t ">
                                                    <span>ユーザー会案内</span>
                                                </div>


                                            </div>
                                            <div class="col-lg-8">

                                                <div class="outer row">

                                                    <div class="col-lg-12 ">
                                                        <select class="form-control" style="width:100%;">
                                                            <option value="1">0 NULL</option>
                                                            <option value="1">1 送付する</option>


                                                        </select>

                                                    </div>
                                                </div>

                                            </div>

                                        </div>

                                        <div class=" row row_data">
                                            <div class="col-lg-4">
                                                <div class="margin_t ">
                                                    <span>送付物フラグ４</span>
                                                </div>


                                            </div>
                                            <div class="col-lg-8">

                                                <div class="outer row">

                                                    <div class="col-lg-12 ">
                                                        <select class="form-control" style="width:100%;">
                                                            <option value="1">0 NULL</option>
                                                            <option value="1">1 送付する</option>

                                                        </select>

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
                   <button type="button" class="btn btn-info" data-dismiss="modal"><i class="fas fa-save" style="margin-right: 5px;"></i>保存 </button>
        <button type="button" class="btn btn-info" data-dismiss="modal"><i class="fa fa-print" style="margin-right: 7px;">
        </i>印刷 </button>
                </div>


            </div>
        </div>

    </div>


    <!--===================================MODAL personal  3 END==============================-->


    <!--===================================Settings Modal Starts==============================-->
    <!-- ============================new moda1 end here ======================= -->
<div class="modal fade" data-keyboard="false" data-backdrop="static" id="setting_display_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 700px;">
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


   </div>
</div>

<script type="text/javascript">
var state = false; // desecelted

$('.checkall').click(function () {

    $('.customCheckBox').each(function() {
      if(!state) {
          this.checked = true;
        }
    });

    //switch
    if (state) {
      state = false;
    }

});
</script>

<div class="row">
  <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="table-responsive setting_header">
                            <table class="table table-striped  table-bordered">
                                <tbody class="">

                                      <tr>
                                        <td>
                                            <div class="custom-control custom-checkbox custom-control-inline">
                                                <input type="checkbox" id="th1" class="custom-control-input customCheckBox" checked="">
                                                <label class="custom-control-label margin_btn_17" for="th1"></label>

                                            </div>
                                        </td>
                                        <td style="width:60px!important;">
                                            <input type="tel" class="form-control" value="0" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                                        </td>
                                        <td class="text-left">
                                            <span class="mt-1 text-left">会社CD</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="custom-control custom-checkbox custom-control-inline">
                                                <input type="checkbox" id="th2" class="custom-control-input customCheckBox" >
                                                <label class="custom-control-label margin_btn_17" for="th2"></label>
                                            </div>
                                        </td>
                                        <td style="width:60px!important;">
                                            <input type="tel" class="form-control" value="1" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                                        </td>
                                        <td class="text-left">
                                            <span class="mt-1 text-left">事業所CD</span>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <div class="custom-control custom-checkbox custom-control-inline">
                                                <input type="checkbox" id="th3" class="custom-control-input customCheckBox" >
                                                <label class="custom-control-label margin_btn_17" for="th3"></label>
                                            </div>
                                        </td>
                                        <td style="width:60px!important;">
                                            <input type="tel" class="form-control" value="2" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                                        </td>
                                        <td class="text-left">
                                            <span class="mt-1 text-left">個人CD</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="custom-control custom-checkbox custom-control-inline">
                                                <input type="checkbox" id="th4" class="custom-control-input customCheckBox">
                                                <label class="custom-control-label margin_btn_17" for="th4"></label>
                                            </div>
                                        </td>
                                        <td style="width:60px!important;">
                                            <input type="tel" class="form-control" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                                        </td>
                                        <td class="text-left">
                                            <span class="mt-1 text-left">部署</span>
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
                                            <input type="tel" class="form-control" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                                        </td>
                                        <td class="text-left">
                                            <span class="mt-1 text-left">役職</span>
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
                                            <input type="tel" class="form-control" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                                        </td>
                                        <td class="text-left">
                                            <span class="mt-1 text-left">個人名</span>
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
                                            <input type="tel" class="form-control" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                                        </td>
                                        <td class="text-left">
                                            <span class="mt-1 text-left">部担当略称</span>
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
                                            <input type="tel" class="form-control" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                                        </td>
                                        <td class="text-left">
                                            <span class="mt-1 text-left">入力区分</span>
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
                                            <input type="tel" class="form-control" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                                        </td>
                                        <td class="text-left">
                                            <span class="mt-1 text-left">メールアドレス</span>
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
                                            <input type="tel" class="form-control" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                                        </td>
                                        <td class="text-left">
                                            <span class="mt-1 text-left">TEL</span>
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
                                            <input type="tel" class="form-control" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                                        </td>
                                        <td class="text-left">
                                            <span class="mt-1 text-left">FAX</span>
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
                                            <input type="tel" class="form-control" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                                        </td>
                                        <td class="text-left">
                                            <span class="mt-1 text-left">社内備考（個人</span>
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
                                            <input type="tel" class="form-control" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                                        </td>
                                        <td class="text-left">
                                            <span class="mt-1 text-left">案内停止フラグ</span>
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
                                            <input type="tel" class="form-control" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                                        </td>
                                        <td class="text-left">
                                            <span class="mt-1 text-left">キーマンフラグ</span>
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
                                            <input type="tel" class="form-control" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                                        </td>
                                        <td class="text-left">
                                            <span class="mt-1 text-left">役員改選案内</span>
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
                                            <input type="tel" class="form-control" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                                        </td>
                                        <td class="text-left">
                                            <span class="mt-1 text-left">年賀状</span>
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
                                            <input type="tel" class="form-control" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                                        </td>
                                        <td class="text-left">
                                            <span class="mt-1 text-left">ユーザー会案内</span>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <div class="custom-control custom-checkbox custom-control-inline">
                                                <input type="checkbox" id="th18" class="custom-control-input customCheckBox">
                                                <label class="custom-control-label margin_btn_17" for="th18"></label>
                                            </div>
                                        </td>
                                        <td style="width:60px!important;">
                                            <input type="tel" class="form-control" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                                        </td>
                                        <td class="text-left">
                                            <span class="mt-1 text-left">送付物フラグ４</span>
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
                                            <input type="tel" class="form-control" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                                        </td>
                                        <td class="text-left">
                                            <span class="mt-1 text-left">登録年月日</span>
                                        </td>
                                    </tr>



                                </tbody>
                            </table>
                        </div>
</div>

<div class="col-lg-6 col-md-6 col-sm-6">
                <div class="table-responsive setting_header">
                            <table class="table table-striped  table-bordered">
                                <tbody class="">
                                    <tr>
                                        <td>
                                            <div class="custom-control custom-checkbox custom-control-inline">
                                                <input type="checkbox" id="th21" class="custom-control-input customCheckBox">
                                                <label class="custom-control-label margin_btn_17" for="th21"></label>
                                            </div>
                                        </td>
                                        <td style="width:60px!important;">
                                            <input type="tel" class="form-control" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                                        </td>
                                        <td class="text-left">
                                            <span class="mt-1 text-left">登録時刻</span>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <div class="custom-control custom-checkbox custom-control-inline">
                                                <input type="checkbox" id="th22" class="custom-control-input customCheckBox">
                                                <label class="custom-control-label margin_btn_17" for="th22"></label>
                                            </div>
                                        </td>
                                        <td style="width:60px!important;">
                                            <input type="tel" class="form-control" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                                        </td>
                                        <td class="text-left">
                                            <span class="mt-1 text-left">更新年月日</span>
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
                                            <input type="tel" class="form-control" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                                        </td>
                                        <td class="text-left">
                                            <span class="mt-1 text-left">更新時刻</span>
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
                                            <input type="tel" class="form-control" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                                        </td>
                                        <td class="text-left">
                                            <span class="mt-1 text-left">更新時端末IP者</span>
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
                                            <input type="tel" class="form-control" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
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
                        <div class="modal-footer">
                           <button type="button" class="btn btn-info" data-dismiss="modal">閉じる&nbsp;<i class="fa fa-times cencel_fontawesome"></i></button>
                        </div>
                    </div>
                </div>
            </div>

    <!--===================================Settings Modal Starts==============================-->

    @include('layout.footer')

    <link href="//ajax.aspnetcdn.com/ajax/jquery.ui/1.8.9/themes/blitzer/jquery-ui.css" rel="stylesheet" type="text/css">
    <script src="{{ asset('js/jquery-3.4.1.min.js') }}"></script>
    <!--Bootstrap 4.x-->
    <script src="  {{ asset('js/bootstrap.min.js') }}"></script>

    <!--Jquery Map for mac operating system-->
    <script src=" {{ asset('js/select2.min.js') }}"></script>
    <script type="text/javascript">
        $("#personalButton3").on("click", function() {
            $("#personal_modal2").modal("hide");
            $('body').removeClass('modal-open');
            $('body').css('overflow-y', 'hidden');
            $('.modal-backdrop').remove();


        });

    </script>
</body>

</html>
