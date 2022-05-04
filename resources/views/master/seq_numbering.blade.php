@section('menu', 'SEQ番号付番マスタ')
<!DOCTYPE html>
<html lang="ja" >
<head>
  <meta charset="utf-8">
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="msapplication-tap-highlight" content="no">
  <title>SEQ番号付番マスタ</title>
  <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}" >
  <link href="https://use.fontawesome.com/releases/v5.0.4/css/all.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="{{ asset('css/navbar_styles.css') }}" >
  <link rel="stylesheet" type="text/css" href="{{ asset('css/login_styles.css') }}" >
  <link rel="stylesheet" type="text/css" href="{{ asset('css/modal_styles.css') }}" >
  <link rel="stylesheet" type="text/css" href="{{ asset('css/product_styles.css') }}" >
  <link rel="stylesheet" type="text/css" href="{{ asset('css/pagination_styles.css') }}" >
  <script type="text/javascript"></script>
  <style>
/*.tbl_rounded tbody{
      display:block;
border: 1px solid #32859C;border-radius: 4px!important;
}*/
.button_wrap_right_top{
width: 40%;
/*margin: 2%;*/
}
.rounded_table_wrap{
width: 60%;
/*margin: 2%;*/
}
@media only screen and (max-width: 767px)  {
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

 }
.border_none_table td{
    border: 1px solid #29487d!important;
    padding: 4px;
}
</style>



</head>


<body style="">
  @include('layout.nav_test')
  <div class="container left_right_margin">

   <div class="row">
   <div class="col-lg-12">


   <div  class = "bordera bgcolr_order_inq" style="margin-top: 12px;margin-bottom: 80px; ">

    <div class="wrap-100"  style="margin-top: 25px;background-color: #fff;padding: 10px;box-sizing: border-box; overflow: hidden;height: auto;">

  <div class="row" >
  <div class="col-lg-8 col-sm-12 m-pd">
    <div class="responsive button-responsive-view">
        <div class="row mb-3 mt-2">
  <div class="col-lg-2 col-sm-3 col-xs-6 col-6 mb-2 text-center"><a href="#" class="btn btn-info btn-m-view " style="width: 100%;"><i class="fa fa-search" aria-hidden="true" style="margin-right: 5px;"></i>検索</a></div>
    <div class="col-lg-2 col-6 col-sm-3 col-xs-6 pl-m mb-2 text-center"><a href="#" class="btn btn-info btn-m-view " style="width: 100%;">一覧</a></div>
  <div class="col-lg-2 col-6 col-sm-3 col-xs-6  pl-m mb-2 text-center"><a href="#" class="btn btn-info btn-m-view  "style="width: 100%;" data-toggle="modal" data-target="#sequence_modal1">新規登録</a></div>
 <div class="col-lg-2 col-sm-3 col-xs-6 col-6 pl-m mb-2 text-center " ><a href="#" class="btn btn-info btn-m-view"style="width: 100%;">EXCEL作成</a></div>

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

<div class="table-responsive" style="padding-bottom: 10px;">
<table class="table table-bordered table-striped">

      <thead class="thead-dark header text-center" id="myHeader">
      <tr>
          <th scope="col"></th>
         <th scope="col" ><span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1;  color: #fff;">番号区分</span></th>
  <th scope="col" ><span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1;  color: #fff;">番号</span></th>
  <th scope="col" ><span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1;  color: #fff;">番号総桁数</span></th>
  <th scope="col" ><span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1;  color: #fff;">登録年月日</span></th>
  <th scope="col" ><span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1;  color: #fff;">登録時刻</span></th>
  <th scope="col" ><span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1;  color: #fff;">更新年月日</span></th>
  <th scope="col" ><span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1;  color: #fff;">更新時刻</span></th>
  <th scope="col" ><span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1;  color: #fff;">更新時端末IP</span></th>
  <th scope="col" ><span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1;  color: #fff;">更新者</span></th>

      </tr>
  </thead>

    <tbody>


   <tr>
          <td></td>

        <td><input type="text" class="form-control">  </td>
         <td>
            <input type="text" class="form-control">
        </td>
         <td>
            <input type="text" class="form-control">
        </td>
         <td>
            <input type="text" class="form-control">
        </td>
         <td><input type="text" class="form-control">  </td>
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
      <a href="#" id="sequenceButton1" class="btn btn-info btn-m-view " style="width: 100%;" data-toggle="modal" data-target="#sequence_modal2"><i class="fa fa-folder-open" aria-hidden="true" style="margin-right: 5px;"></i>詳細</a>
     </td>

        <td>1</td>
        <td>001</td>
        <td>12345</td>
        <td>48</td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>



      </tr>

 <!--      3rd row -->
   <tr>
      <td style="width:50px;">
      <a href="#" id="sequenceButton1" class="btn btn-info btn-m-view " style="width: 100%;" data-toggle="modal" data-target="#sequence_modal2"><i class="fa fa-folder-open" aria-hidden="true" style="margin-right: 5px;"></i>詳細</a>
     </td>

         <td>2</td>
        <td>001</td>
        <td>12345</td>
        <td>48</td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>


      </tr>

 <!--      4th row -->
   <tr>
      <td style="width:50px;">
      <a href="#" id="sequenceButton1" class="btn btn-info btn-m-view " style="width: 100%;" data-toggle="modal" data-target="#sequence_modal2"><i class="fa fa-folder-open" aria-hidden="true" style="margin-right: 5px;"></i>詳細</a>
     </td>

<td>3</td>
        <td>001</td>
        <td>12345</td>
        <td>48</td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>



      </tr>
   <tr>
      <td style="width:50px;">
      <a href="#" id="sequenceButton1" class="btn btn-info btn-m-view " style="width: 100%;" data-toggle="modal" data-target="#sequence_modal2"><i class="fa fa-folder-open" aria-hidden="true" style="margin-right: 5px;"></i>詳細</a>
     </td>

         <td>1</td>
        <td>001</td>
        <td>12345</td>
        <td>48</td>
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



    <!-- product content col-12 ends here -->

  </div>
      <!-- product content row ends here -->
</div>




<!-- wrap-100 div end -->
</div>
<!-- bgcolor div end -->



<!-- Modal 1 start here -->

<div class="modal fade"  id="sequence_modal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
 <div class="modal-dialog modal-dialog-centered" style="max-width: 700px !important;" role="document">
  <div class="modal-content">
    <div class="modal-header">
      <h6 class="modal-title" id="exampleModalLabel">SEQ番号付番マスタ(登録)</h6>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
 <div class="modal-body">
  <div class="development_page_top_table heading_mt" style="margin:11px;">



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


   <!--======================= modal 1 table start ======================-->


<div class="row mt-1 mb-3">

           <div class="col-lg-12">


<div class="tbl_name">
<div class="w-100">


  <div class=" row row_data">
      <div class="col-lg-3">
     <div class="margin_t ">
<span>番号区分</span>    </div>


  </div>
<div class="col-lg-9">

    <div class="outer row">
               <div class="col-lg-12 ">

              <select class="" style="width: 100%;">
                  <option value="1">D7の分類コードと分類名を表示</option>
              </select>


                      </div>

                    </div>

  </div>

  </div>
  <div class=" row row_data">
      <div class="col-lg-3">
     <div class="margin_t "><span>番号</span></div>
  </div>
<div class="col-lg-9">

    <div class="outer row">
     <div class="col-lg-12 ">

      <input type="text" class="form-control" value="">

    </div>

    </div>
  </div>

  </div>

    <div class=" row row_data">
      <div class="col-lg-3">
     <div class="margin_t "><span>番号総桁数</span></div>
  </div>
<div class="col-lg-9">

    <div class="outer row">
     <div class="col-lg-12 ">

      <input type="text" class="form-control" value="">

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
        <button type="button" class="btn btn-info" data-dismiss="modal"><i class="fas fa-save" style="margin-right: 5px;"></i>保存 </button>
    </div>
   </div>
  </div>
</div>



<div class="modal fade"  id="sequence_modal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
 <div class="modal-dialog modal-dialog-centered" style="max-width: 700px !important;" role="document">
  <div class="modal-content">
    <div class="modal-header">
      <h6 class="modal-title" id="exampleModalLabel">SEQ番号付番マスタ(詳細)</h6>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
 <div class="modal-body">
  <div class="development_page_top_table heading_mt" style="margin:11px;">



<div class="row titlebr" style="margin-bottom: 15px;">
  <div class="col-lg-6"></div>
  <div class="col-lg-6">
    <table class="dev_tble_button" style="float: right;">
      <tbody>
        <tr class="marge_in">
           <td class="">
          <a class="btn btn-info scroll" id="seq_Button3" style="background-color: #3e6ec1!important;" data-toggle="modal" data-target="#sequence_modal3"> <i class="fa fa-pencil-square-o" aria-hidden="true" style="margin-right: 5px;"></i>変更画面へ</a>
           </td>
           <td class="td_button_p">
           <a class="btn btn-info scroll" style=""><i class="fa fa-print" aria-hidden="true" style="margin-right: 5px;"></i>印刷</a>
           </td>
        </tr>
      </tbody>
    </table>

  </div>

</div>

</div>


   <!--======================= modal 1 table start ======================-->


<div class="row mt-1 mb-3">

           <div class="col-lg-12">


<div class="tbl_name">
<div class="w-100">


  <div class=" row row_data">
      <div class="col-lg-3">
     <div class="margin_t ">
<span>番号区分</span>    </div>


  </div>
<div class="col-lg-9">

    <div class="outer row">
               <div class="col-lg-12 ">

           <div>00001 受注順番号</div>


                      </div>

                    </div>

  </div>

  </div>
  <div class=" row row_data">
      <div class="col-lg-3">
     <div class="margin_t "><span>番号</span></div>
  </div>
<div class="col-lg-9">

    <div class="outer row">
     <div class="col-lg-12 ">

         <div>99999999</div>

    </div>

    </div>
  </div>

  </div>

    <div class=" row row_data">
      <div class="col-lg-3">
     <div class="margin_t "><span>番号総桁数</span></div>
  </div>
<div class="col-lg-9">

    <div class="outer row">
     <div class="col-lg-12 ">

   <div>99</div>

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

    </div>
   </div>
  </div>
</div>



<div class="modal fade"  id="sequence_modal3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
 <div class="modal-dialog modal-dialog-centered" style="max-width: 700px !important;" role="document">
  <div class="modal-content">
    <div class="modal-header">
      <h6 class="modal-title" id="exampleModalLabel">SEQ番号付番マスタ(変更)</h6>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
 <div class="modal-body">
  <div class="development_page_top_table heading_mt" style="margin:11px;">



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


   <!--======================= modal 1 table start ======================-->


<div class="row mt-1 mb-3">

           <div class="col-lg-12">


<div class="tbl_name">
<div class="w-100">


  <div class=" row row_data">
      <div class="col-lg-3">
     <div class="margin_t ">
<span>番号区分</span>    </div>


  </div>
<div class="col-lg-9">

    <div class="outer row">
               <div class="col-lg-12 ">

       <select class="" style="width: 100%;">
                  <option value="1">00001 受注順番号</option>
              </select>


                      </div>

                    </div>

  </div>

  </div>
  <div class=" row row_data">
      <div class="col-lg-3">
     <div class="margin_t "><span>番号</span></div>
  </div>
<div class="col-lg-9">

    <div class="outer row">
     <div class="col-lg-12 ">

      <input type="text" class="form-control" value="99999999">

    </div>

    </div>
  </div>

  </div>

    <div class=" row row_data">
      <div class="col-lg-3">
     <div class="margin_t "><span>番号総桁数</span></div>
  </div>
<div class="col-lg-9">

    <div class="outer row">
     <div class="col-lg-12 ">

      <input type="text" class="form-control" value="99">

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
        <button type="button" class="btn btn-info" data-dismiss="modal"><i class="fas fa-save" style="margin-right: 5px;"></i>保存</button>
    </div>
   </div>
  </div>
</div>


<!-- ============================new moda1 end here ======================= -->
<div class="modal fade" id="setting_display_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 1050px;">
                    <div class="modal-content">
                        <div class="modal-header">

                        </div>
                        <div class="modal-body">
                            <div class=" page4_table_design mt-2  table_hover ">
                              <div class="table-responsive setting_header">
                                <table class="table table-striped  table-bordered">
                                    <tbody class="">
                                        <tr>
                                            <td>
                                                <div class="custom-control custom-checkbox custom-control-inline">
                                                    <input type="checkbox" id="th1" class="custom-control-input" checked="">
                                                    <label class="custom-control-label margin_btn_17" for="th1"></label>

                                                </div>
                                            </td>
                                              <td style="width:60px!important;">
                                                <input type="tel" class="form-control" value="0" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                                            </td>
                                            <td class="text-left">
                                                <span class="mt-1 text-left">番号区分</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="custom-control custom-checkbox custom-control-inline">
                                                    <input type="checkbox" id="th2" class="custom-control-input" checked="">
                                                    <label class="custom-control-label margin_btn_17" for="th2"></label>
                                                </div>
                                            </td>
                                               <td style="width:60px!important;">
                                                <input type="tel" class="form-control" value="1" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                                            </td>
                                            <td class="text-left">
                                                <span class="mt-1 text-left">番号</span>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>
                                                <div class="custom-control custom-checkbox custom-control-inline">
                                                    <input type="checkbox" id="th3" class="custom-control-input" checked="">
                                                    <label class="custom-control-label margin_btn_17" for="th3"></label>
                                                </div>
                                            </td>
                                               <td style="width:60px!important;">
                                                <input type="tel" class="form-control" value="2" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                                            </td>
                                            <td class="text-left">
                                                <span class="mt-1 text-left">番号総桁数</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="custom-control custom-checkbox custom-control-inline">
                                                    <input type="checkbox" id="th4" class="custom-control-input">
                                                    <label class="custom-control-label margin_btn_17" for="th4"></label>
                                                </div>
                                            </td>
                                               <td style="width:60px!important;">
                                                <input type="tel" class="form-control" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                                            </td>
                                            <td class="text-left">
                                                <span class="mt-1 text-left">登録年月日</span>
                                            </td>
                                        </tr>
                                          <tr>
                                            <td>
                                                <div class="custom-control custom-checkbox custom-control-inline">
                                                    <input type="checkbox" id="th5" class="custom-control-input">
                                                    <label class="custom-control-label margin_btn_17" for="th5"></label>
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
                                                    <input type="checkbox" id="th6" class="custom-control-input">
                                                    <label class="custom-control-label margin_btn_17" for="th6"></label>
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
                                                    <input type="checkbox" id="th7" class="custom-control-input">
                                                    <label class="custom-control-label margin_btn_17" for="th7"></label>
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
                                                    <input type="checkbox" id="th8" class="custom-control-input">
                                                    <label class="custom-control-label margin_btn_17" for="th8"></label>
                                                </div>
                                            </td>
                                               <td style="width:60px!important;">
                                                <input type="tel" class="form-control" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                                            </td>
                                            <td class="text-left">
                                                <span class="mt-1 text-left">更新時端末IP</span>
                                            </td>
                                        </tr>
                                          <tr>
                                            <td>
                                                <div class="custom-control custom-checkbox custom-control-inline">
                                                    <input type="checkbox" id="th9" class="custom-control-input">
                                                    <label class="custom-control-label margin_btn_17" for="th9"></label>
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
                        <div class="modal-footer">
                           <button type="button" class="btn btn-info" data-dismiss="modal">閉じる&nbsp;<i class="fa fa-times cencel_fontawesome"></i></button>
                        </div>
                    </div>
                </div>
            </div>


@include('layout.footer')




<link href="//ajax.aspnetcdn.com/ajax/jquery.ui/1.8.9/themes/blitzer/jquery-ui.css" rel="stylesheet" type="text/css">
<script src="{{ asset('js/jquery-3.4.1.min.js') }}"></script>
<!--Bootstrap 4.x-->
<script src="  {{ asset('js/bootstrap.min.js') }}"></script>

<!--Jquery Map for mac operating system-->
<script src=" {{ asset('js/select2.min.js') }}"></script>
 <script type="text/javascript">

$("#seq_Button3").on("click", function(){
    $("#sequence_modal2").modal("hide");
  $('body').removeClass('modal-open');
  $('body').css('overflow-y', 'hidden');
 $('.modal-backdrop').remove();


});

</script>

</body>
</html>