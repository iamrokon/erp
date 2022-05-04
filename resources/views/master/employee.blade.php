@section('menu', '社員マスタ')
<!DOCTYPE html>
<html lang="ja" >
<head>
  <meta charset="utf-8">
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="msapplication-tap-highlight" content="no">
  <title>社員マスタ</title>
  <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}" >
  <link href="https://use.fontawesome.com/releases/v5.0.4/css/all.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="{{ asset('css/navbar_styles.css') }}" >
  <link rel="stylesheet" type="text/css" href="{{ asset('css/login_styles.css') }}" >
  <link rel="stylesheet" type="text/css" href="{{ asset('css/modal_styles.css') }}" >
  <link rel="stylesheet" type="text/css" href="{{ asset('css/product_styles.css') }}" >
    <link rel="stylesheet" type="text/css" href="{{ asset('css/pagination_styles.css') }}" >
  <script type="text/javascript">



  </script>


  <style>
    .mt_d{
        margin-top: 7px;

    }


    .box-dark {
        width: 13px;
        height: 13px;
        background-color: #333;
        color: #fff;
        text-align: right;
        float: right;
        cursor: pointer;
    }

/*.tbl_rounded tbody{
      display:block;
border: 1px solid #32859C;border-radius: 4px!important;
}*/
.tbl_emp1 td{
    border: none!important;
}


.tbl_emp1 td:first-child {
    border: none!important;
}
.button_wrap_right_top{
    width: 40%;
    /*margin: 2%;*/
}
.rounded_table_wrap{
    width: 60%;
    /*margin: 2%;*/
}
@media only screen and (max-width: 768px)  {
    .page-link{
      padding: 7px 7px!important;
  }

}
@media only screen and (max-width: 768px)  {

    .rounded_table_wrap{
      width: 50%;
      padding-left: 15px!important;
      margin-top: 5px;
  }

  .button_wrap_right_top{

    margin-top: 5px;
    width: 48%!important;
    margin-right: 20px;margin-right: 0px!important;

}

.column_display_btn{
    /*s*/

    float: right;
    padding: 0 10px!important;
}
}
}
}

@media only screen and (max-width: 767px)  {
    .rounded_table_wrap{
      width: 50%;
      padding-left: 15px!important;
  }
  .nav_mview{
      margin-bottom: 15px!important;
  }
  .column_display_btn{
      width: 50%!important;
  }

}
.border_none_table td{
    border: 1px solid #29487d!important;
    padding: 4px;
}

.page-link{
  height: 36px!important;
}
</style>

<!--[if IE]>
<style type="text/css">
    /************ css for all IE browsers ****************/

    input.pagi-input-field{
  height: 36px!important;
}
</style>
<![endif]-->

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
                              <div class="col-lg-2 col-6 col-sm-3 col-xs-6  pl-m mb-2 text-center"><a href="#" class="btn btn-info btn-m-view  "style="width: 100%;" data-toggle="modal" data-target="#employee_modal1">新規登録</a></div>

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

                  <th scope="col" ><span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1;  color: #fff;">社員ＩＤ</span></th>
                  <th scope="col" ><span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1;  color: #fff;">社員姓</span></th>
                  <th scope="col" ><span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1;  color: #fff;">社員名</span></th>
                  <th scope="col" ><span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1;  color: #fff;">給与ＩＤ</span></th>
                  <th scope="col" ><span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1;  color: #fff;">事業年度（期）</span></th>
                  <th scope="col" ><span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1;  color: #fff;">事業部</span></th>
                  <th scope="col" ><span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1;  color: #fff;">部</span></th>
                  <th scope="col" ><span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1;  color: #fff;">事業所コード</span></th>
                  <th scope="col" ><span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1;  color: #fff;">パスワード</span></th>
                  <th scope="col" ><span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1;  color: #fff;">権限コード</span></th>
                  <th scope="col" ><span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1;  color: #fff;">電話番号</span></th>
                  <th scope="col" ><span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1;  color: #fff;">内線番号</span></th>
                  <th scope="col" ><span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1;  color: #fff;">メールアドレス</span></th>
                  <th scope="col" ><span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1;  color: #fff;">入力者１</span></th>
                  <th scope="col" ><span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1;  color: #fff;">入力者２</span></th>
                  <th scope="col" ><span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1;  color: #fff;">入力者３</span></th>
                  <th scope="col" ><span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1;  color: #fff;">入力者４ </span></th>
                  <th scope="col" ><span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1;  color: #fff;">決裁者１</span></th>
                  <th scope="col" ><span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1;  color: #fff;">決裁者２</span></th>
                  <th scope="col" ><span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1;  color: #fff;">決裁者３</span></th>
                  <th scope="col" ><span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1;  color: #fff;">決裁者４</span></th>
                  <th scope="col" ><span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1;  color: #fff;">社員印影</span></th>
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
                  <a href="#" id="empButton1"class="btn btn-info btn-m-view " style="width: 100%;"data-toggle="modal" data-target="#employee_modal2"><i class="fa fa-folder-open" aria-hidden="true" style="margin-right: 5px;"></i>詳細</a>
              </td>

              <td>001</td>
              <td>山田太郎</td>
              <td>12345</td>
              <td>48</td>
              <td>01</td>
              <td>1</td>
              <td>1</td>
              <td>1</td>
              <td>*****</td>
              <td>90</td>
              <td>090-0000-0000</td>
              <td>1</td>
              <td>XXX1@XX.co.jp</td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
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
                  <a href="#" class="btn btn-info btn-m-view " style="width: 100%;"data-toggle="modal" data-target="#office_modal2"><i class="fa fa-folder-open" aria-hidden="true" style="margin-right: 5px;"></i>詳細
                  </a>
              </td>


              <td>002</td>
              <td>佐藤花子</td>
              <td>12345</td>
              <td>48</td>
              <td>02</td>
              <td>1</td>
              <td>3</td>
              <td>1</td>
              <td>*****</td>
              <td>01</td>
              <td>080-1111-1111</td>
              <td>2</td>
              <td>XXX2@XX.co.jp</td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
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
                  <a href="#" class="btn btn-info btn-m-view " style="width: 100%;"data-toggle="modal" data-target="#office_modal2"><i class="fa fa-folder-open" aria-hidden="true" style="margin-right: 5px;"></i>詳細
                  </a>
              </td>


              <td>003</td>
              <td>鈴木二郎</td>
              <td>12346</td>
              <td>49</td>
              <td>03</td>
              <td>2</td>
              <td>2</td>
              <td>2</td>
              <td>*****</td>
              <td>01</td>
              <td>090-2222-2222</td>
              <td>3</td>
              <td>XXX3@XX.co.jp</td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
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
                 <a href="#" class="btn btn-info btn-m-view " style="width: 100%;"data-toggle="modal" data-target="#office_modal2"><i class="fa fa-folder-open" aria-hidden="true" style="margin-right: 5px;"></i>詳細
                 </a>
             </td>


             <td>004</td>
             <td>田中良子</td>
             <td>12347</td>
             <td>49</td>
             <td>04</td>
             <td>1</td>
             <td></td>
             <td>2</td>
             <td>*****</td>
             <td>11</td>
             <td>080-3333-3333</td>
             <td>4</td>
             <td>XXX4@XX.co.jp</td>
             <td></td>
             <td></td>
             <td></td>
             <td></td>
             <td></td>
             <td></td>
             <td></td>
             <td></td>
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



<!-- product content col-12 ends here -->

</div>
<!-- product content row ends here -->
</div>




<!-- wrap-100 div end -->
</div>
<!-- bgcolor div end -->
</div>


<!-- Modal 1 start here -->

<div class="modal fade"  id="employee_modal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered" style="max-width: 900px !important;" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h6 class="modal-title" id="exampleModalLabel">社員マスタ　　(登録)</h6>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">



     <!--======================= modal 1 table start ======================-->
     <div class="table_wrap border_none_table">

        <div class="row titlebr" style="margin-bottom: 15px;">
           <div class="col-lg-6"></div>
           <div class="col-lg-6">
            <table class="dev_tble_button" style="float: right;margin-right: 14px;">
              <tbody>
                <tr class="marge_in">
                 <td class="" style="padding-left: 0px!important;width: 70px!important;border:none!important; ">


                 </td>

             </tr>
             <tr>
                <td class="" style="padding-left: 0px!important;width: 100px!important;border:none!important; ">
                新規(処理状況)</td>
            </tr>
        </tbody>
    </table>

</div>

</div>


<div class="row mt-1 mb-3">

 <div class="col-lg-10">


     <div class="tbl_emp1">
        <div  class="w-100">
          <div  class=" row row_data">
              <div  class="col-lg-2">
                  <div class="margin_t ">
                    <span>事業年度(期) <span style="color: red;">※</span></span>
                </div>


            </div>
            <div  class="col-lg-9">

                <div class="outer row" style="">
                  <div class="col-3 ">

                      <input type="text" class="form-control" value="123456">


                  </div>
                  <div class="col-9 ">
                    <div class="outer row" style="">
                     <div class="col-3">
                        <div class="text-center" style="margin-top: 5px;">社員ID</div>
                    </div>

                    <div class="col-6 pl-0"><input type="text" class="form-control" id="border_input" value=""> </div>

                </div>
            </div>

        </div>

    </div>

</div>

<div  class=" row row_data">
  <div  class="col-lg-2">
   <div class="margin_t ">
    <span>社員名(姓)</span>
</div>


</div>
<div  class="col-lg-9">

    <div class="outer row" style="">
     <div class="col-7 ">

        <input type="text" class="form-control" value="">


    </div>

</div>

</div>

</div>


<div  class=" row row_data">
  <div  class="col-lg-2">
     <div class="margin_t ">
        <span>社員名(名)</span>
    </div>


</div>
<div  class="col-lg-9">

    <div class="outer row" style="">
     <div class="col-7 ">

        <input type="text" class="form-control" value="">


    </div>

</div>

</div>

</div>


<div  class=" row row_data">
  <div  class="col-lg-2">
     <div class="margin_t ">
       <span>給与ID</span>
   </div>


</div>
<div  class="col-lg-9">

    <div class="outer row" style="">
     <div class="col-7 ">

        <input type="text" class="form-control" value="">


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


     <div class="tbl_emp1">
        <div class="w-100">


          <div class=" row row_data">
              <div class="col-lg-3">
               <div class="margin_t ">
                <span>事業部</span>
            </div>


        </div>
        <div class="col-lg-9">

            <div class="outer row" style="padding-left: 15px;">
             <div class="col-12 ">
                 <div class="">
                     <select class="form-control" id="exampleFormControlSelect2">
                      <option>B9の分類名を表示</option>
                      <option></option>

                  </select>
              </div>

          </div>

      </div>

  </div>

</div>


<div class=" row row_data">
  <div class="col-lg-3">
     <div class="margin_t ">
        <span>部</span>
    </div>


</div>
<div class="col-lg-9">

    <div class="outer row" style="padding-left: 15px;">
     <div class="col-12 ">

       <select class="form-control" id="exampleFormControlSelect2">
          <option>C1の分類名を表示</option>
          <option></option>

      </select>


  </div>

</div>

</div>

</div>


<div class=" row row_data">
  <div class="col-lg-3">
     <div class="margin_t ">
       <span>グループ
       </span>
   </div>


</div>
<div class="col-lg-9">

    <div class="outer row" style="padding-left: 15px;">
     <div class="col-12 ">

        <select class="form-control" id="exampleFormControlSelect2">
          <option>C2の分類名を表示</option>
          <option></option>

      </select>



  </div>

</div>

</div>

</div>
<div class=" row row_data">
  <div class="col-lg-3">
     <div class="margin_t ">
       <span>事業所
       </span>
   </div>


</div>
<div class="col-lg-9">

    <div class="outer row" style="padding-left: 15px;">
     <div class="col-12 ">

         <select class="form-control" id="exampleFormControlSelect2">
          <option>1 大阪</option>
          <option>2 東京</option>

      </select>


  </div>

</div>

</div>

</div>

</div>

</div>
</div>


<div class="col-lg-6">


 <div class="tbl_emp1">
    <div  class="w-100">


      <div  class=" row row_data">
          <div  class="col-lg-3">
           <div class="margin_t ">
            <span>パスワード</span>
        </div>


    </div>
    <div  class="col-lg-9">

        <div class="outer row" style="padding-left: 15px;">
         <div class="col-7 ">

            <input type="text" class="form-control" value="">


        </div>

    </div>

</div>

</div>


<div  class=" row row_data">
  <div  class="col-lg-3">
     <div class="margin_t ">
        <span>(確認用)</span>
    </div>


</div>
<div  class="col-lg-9">

    <div class="outer row" style="padding-left: 15px;">
     <div class="col-7 ">

        <input type="text" class="form-control" value="">


    </div>

</div>

</div>

</div>


<div  class=" row row_data">
  <div  class="col-lg-3">
     <div class="margin_t ">
       <span>権限コード
       </span>
   </div>


</div>
<div  class="col-lg-9">
    <div class="outer row" style="padding-left: 15px;">
     <div class="col-6 ">
       <div class="w-100">
           <select class="form-control" id="exampleFormControlSelect2" style="width: 100%!important;">
              <option></option>
              <option></option>

          </select>
      </div>
  </div>

  <div class="col-6 ">




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


     <div class="tbl_emp1">
        <div class="w-100">


          <div class=" row row_data">
              <div class="col-lg-3">
               <div class="margin_t ">
                <span>
                電話番号</span>
            </div>


        </div>
        <div class="col-lg-9">

            <div class="outer row" style="padding-left: 15px;">
             <div class="col-12 ">

                <input type="text" class="form-control" value="">


            </div>

        </div>

    </div>

</div>


<div class=" row row_data">
  <div class="col-lg-3">
     <div class="margin_t ">
        <span>内線番号</span>
    </div>


</div>
<div class="col-lg-9">

    <div class="outer row" style="padding-left: 15px;">
     <div class="col-12 ">

        <input type="text" class="form-control" value="">


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


     <div class="tbl_emp1">
        <div class="w-100">


          <div class=" row row_data">
              <div class="col-lg-3">
               <div class="margin_t ">
                <span>
                メールアドレス</span>
            </div>


        </div>
        <div class="col-lg-9">

            <div class="outer row" style="padding-left: 15px;">
             <div class="col-12 ">

                <input type="text" class="form-control" value="">


            </div>

        </div>

    </div>

</div>
<div class=" row row_data">
  <div class="col-lg-3">
   <div class="margin_t ">
    <span>
    (確認用)</span>
</div>


</div>
<div class="col-lg-9">

    <div class="outer row" style="padding-left: 15px;">
     <div class="col-12 ">

        <input type="text" class="form-control" value="">


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


     <div class="tbl_emp1">
        <div class="w-100">


          <div class=" row row_data">
              <div class="col-lg-3">
               <div class="margin_t ">
                <span>
                入力者1</span>
            </div>


        </div>
        <div class="col-lg-9">

            <div class="outer row" style="padding-left: 15px;">
             <div class="col-12 ">

                 <select class="form-control" id="exampleFormControlSelect2">
                  <option></option>
                  <option></option>

              </select>


          </div>

      </div>

  </div>

</div>

<div class=" row row_data">
  <div class="col-lg-3">
   <div class="margin_t ">
    <span>
    入力者2</span>
</div>


</div>
<div class="col-lg-9">

    <div class="outer row" style="padding-left: 15px;">
     <div class="col-12 ">

      <select class="form-control" id="exampleFormControlSelect2">
          <option></option>
          <option></option>

      </select>


  </div>

</div>

</div>

</div>
<div class=" row row_data">
  <div class="col-lg-3">
   <div class="margin_t ">
    <span>
    入力者3</span>
</div>


</div>
<div class="col-lg-9">

    <div class="outer row" style="padding-left: 15px;">
     <div class="col-12 ">

      <select class="form-control" id="exampleFormControlSelect2">
          <option></option>
          <option></option>

      </select>


  </div>

</div>

</div>

</div>

<div class=" row row_data">
  <div class="col-lg-3">
   <div class="margin_t ">
    <span>
    入力者4</span>
</div>


</div>
<div class="col-lg-9">

    <div class="outer row" style="padding-left: 15px;">
     <div class="col-12 ">

         <select class="form-control" id="exampleFormControlSelect2">
          <option></option>
          <option></option>

      </select>


  </div>

</div>

</div>

</div>



</div>

</div>
</div>


<div class="col-lg-6">


 <div class="tbl_emp1">
    <div class="w-100">


      <div class=" row row_data">
          <div class="col-lg-3">
           <div class="margin_t ">
            <span>
                決裁者1
            </span>
        </div>


    </div>
    <div class="col-lg-9">

        <div class="outer row" style="padding-left: 15px;">
         <div class="col-12 ">

           <select class="form-control" id="exampleFormControlSelect2">
              <option></option>
              <option></option>

          </select>


      </div>

  </div>

</div>

</div>

<div class=" row row_data">
  <div class="col-lg-3">
   <div class="margin_t ">
    <span>
        決裁者2
    </span>
</div>


</div>
<div class="col-lg-9">

    <div class="outer row" style="padding-left: 15px;">
     <div class="col-12 ">

       <select class="form-control" id="exampleFormControlSelect2">
          <option></option>
          <option></option>

      </select>

  </div>

</div>

</div>

</div>
<div class=" row row_data">
  <div class="col-lg-3">
   <div class="margin_t ">
    <span>
        決裁者3
    </span>
</div>


</div>
<div class="col-lg-9">

    <div class="outer row" style="padding-left: 15px;">
     <div class="col-12 ">

        <select class="form-control" id="exampleFormControlSelect2">
          <option></option>
          <option></option>

      </select>


  </div>

</div>

</div>

</div>

<div class=" row row_data">
  <div class="col-lg-3">
   <div class="margin_t ">
    <span>
        決裁者4
    </span>
</div>


</div>
<div class="col-lg-9">

    <div class="outer row" style="padding-left: 15px;">
     <div class="col-12 ">

        <select class="form-control" id="exampleFormControlSelect2">
          <option></option>
          <option></option>

      </select>


  </div>

</div>

</div>

</div>



</div>

</div>
</div>



</div>


<div class="row mt-1 mb-3">

 <div class="col-lg-10">


     <div class="tbl_emp1">
        <div class="w-100">


          <div class=" row row_data">
              <div class="col-lg-2">
               <div class="margin_t ">
                <span>
                    社員印影
                </span>
            </div>


        </div>
        <div class="col-lg-9">

            <div class="outer row" style="">
             <div class="col-12 ">

              <textarea class="" rows="5" col="50" id="comment" style="width: 100%;">
              </textarea>


          </div>

      </div>

  </div>

</div>







</div>

</div>
</div>


</div>

<div class="modal-footer">
   <a href="#" class="btn btn-info scroll" style="float: right;"><i class="fa fa-save" aria-hidden="true" style="margin-right: 5px;"></i>保存</a>
</div>
<!--======================= modal 1 table  end ======================-->
</div>
</div>
</div>
</div>
</div>
<!--============================== moda1 1 finish ====================== -->

<!-- ============================= moda1 2 start here ========================-->

<div class="modal fade"  id="employee_modal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" style="max-width: 900px !important;" role="document">
    <div class="modal-content">
     <div class="modal-header">
      <h6 class="modal-title" id="exampleModalLabel">事業所マスタ　　(詳細)</h6>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body">
  <div class="development_page_top_table heading_mt" style="margin:11px;">

      <!--======================= button start ======================-->

      <div class="row titlebr" style="margin-bottom: 15px;">

          <div class="col-lg-6" style="margin-left: -16px !important;"></div>

          <div class="col-lg-6" >
            <table class="dev_tble_button"style="float: right;">
              <tbody>
                <tr class="marge_in">
                 <td class="">
                  <a class="btn btn-info scroll" id="empButton3"data-toggle="modal" data-target="#employee_modal3" style="">変更画面へ</a>
              </td>
              <td class="td_button_p">
                 <a href="#" class="btn btn-info scroll" style=""><i class="fa fa-print" aria-hidden="true" style="margin-right: 5px;"></i>印刷</a>
             </td>
         </tr>
     </tbody>
 </table>

</div>

</div>

<!--======================= button  end ======================-->
</div>
<!--======================= modal 2 table start here ======================-->

<div class="table_wrap border_none_table">


 <div class="row mt-1 mb-3">

     <div class="col-lg-10">


         <div class="tbl_emp1">
            <div class="w-100">
              <div class=" row row_data">
                  <div class="col-lg-2">
                      <div class="margin_t ">
                        <span>事業年度(期) <span style="color: red;">※</span></span>
                    </div>


                </div>
                <div class="col-lg-9">

                    <div class="outer row" style="">
                      <div class="col-3 ">
                          <div class="mt_d">
                              48
                          </div>


                      </div>
                      <div class="col-9 ">
                        <div class="outer row" style="">
                           <div class="col-3">

                            <div class="text-center mt_d" style="margin-top: 5px;">社員ID</div>
                        </div>

                        <div class="col-6 pl-0"><div class="" style="margin-top: 5px;">001</div> </div>

                    </div>
                </div>

            </div>

        </div>

    </div>

    <div class=" row row_data">
      <div class="col-lg-2">
       <div class="margin_t ">
        <span>社員名(姓)</span>
    </div>


</div>
<div class="col-lg-9">

    <div class="outer row" style="">
     <div class="col-7 ">

        <div class="mt_d">山田</div>


    </div>

</div>

</div>

</div>


<div class=" row row_data">
  <div class="col-lg-2">
     <div class="margin_t ">
        <span>社員名(名)</span>
    </div>


</div>
<div class="col-lg-9">

    <div class="outer row" style="">
     <div class="col-7 ">

       <div class="mt_d">太郎</div>


   </div>

</div>

</div>

</div>


<div class=" row row_data">
  <div class="col-lg-2">
     <div class="margin_t ">
       <span>給与ID</span>
   </div>


</div>
<div class="col-lg-9">

    <div class="outer row" style="">
     <div class="col-7 ">

        <div class="mt_d">12345</div>

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


     <div class="tbl_emp1">
        <div class="w-100">


          <div class=" row row_data">
              <div class="col-lg-3">
               <div class="margin_t ">
                <span>事業部</span>
            </div>


        </div>
        <div class="col-lg-9">

            <div class="outer row" style="padding-left: 15px;">
             <div class="col-12 ">

               <div class="mt_d">01 西日本ソリューション事業部</div>


           </div>

       </div>

   </div>

</div>


<div class=" row row_data">
  <div class="col-lg-3">
     <div class="margin_t ">
        <span>部</span>
    </div>


</div>
<div class="col-lg-9">

    <div class="outer row" style="padding-left: 15px;">
     <div class="col-12 ">

        <div class="mt_d">011 西日本ソリューション営業部
        </div>


    </div>

</div>

</div>

</div>


<div class=" row row_data">
  <div class="col-lg-3">
     <div class="margin_t ">
       <span>グループ
       </span>
   </div>


</div>
<div class="col-lg-9">

    <div class="outer row" style="padding-left: 15px;">
     <div class="col-12 ">

         <div class="mt_d">0111 第1グループ</div>




     </div>

 </div>

</div>

</div>
<div class=" row row_data">
  <div class="col-lg-3">
     <div class="margin_t ">
       <span>事業所
       </span>
   </div>


</div>
<div class="col-lg-9">

    <div class="outer row" style="padding-left: 15px;">
     <div class="col-12 ">

       <div class="mt_d">36 大阪</div>


   </div>

</div>

</div>

</div>

</div>

</div>
</div>


<div class="col-lg-6">


 <div class="tbl_emp1">
    <div class="w-100">


      <div class=" row row_data">
          <div class="col-lg-3">
           <div class="margin_t ">
            <span>パスワード</span>
        </div>


    </div>
    <div class="col-lg-9">

        <div class="outer row" style="padding-left: 15px;">
         <div class="col-7 ">

           <div class="mt_d">******</div>


       </div>

   </div>

</div>

</div>


<div class=" row row_data">
  <div class="col-lg-3">
     <div class="margin_t ">
        <span>(確認用)</span>
    </div>


</div>
<div class="col-lg-9">

    <div class="outer row" style="padding-left: 15px;">
     <div class="col-7 ">

        <div class="mt_d">******</div>


    </div>

</div>

</div>

</div>


<div class=" row row_data">
  <div class="col-lg-3">
     <div class="margin_t ">
       <span>権限

       </span>
   </div>


</div>
<div class="outer row" style="padding-left: 30px;">
 <div class="col-6 ">

     <div class="mt_d">90</div>



 </div>

 <div class="col-6 ">


   <div class="mt_d">管理者</div>

</div>
</div>

</div>


</div>

</div>
</div>



</div>



<div class="row mt-1 mb-3">

 <div class="col-lg-6">


     <div class="tbl_emp1">
        <div class="w-100">


          <div class=" row row_data">
              <div class="col-lg-3">
               <div class="margin_t ">
                <span>
                電話番号</span>
            </div>


        </div>
        <div class="col-lg-9">

            <div class="outer row" style="padding-left: 15px;">
             <div class="col-12 ">

                 <div class="mt_d">090-0000-0000</div>


             </div>

         </div>

     </div>

 </div>


 <div class=" row row_data">
  <div class="col-lg-3">
     <div class="margin_t ">
        <span>内線番号</span>
    </div>


</div>
<div class="col-lg-9">

    <div class="outer row" style="padding-left: 15px;">
     <div class="col-12 ">

         <div class="mt_d">1</div>


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


     <div class="tbl_emp1">
        <div class="w-100">


          <div class=" row row_data">
              <div class="col-lg-3">
               <div class="margin_t ">
                <span>
                メールアドレス</span>
            </div>


        </div>
        <div class="col-lg-9">

            <div class="outer row" style="padding-left: 15px;">
             <div class="col-12 ">

                 <div class="mt_d">XXX1@xx.co.jp
                 </div>


             </div>

         </div>

     </div>

 </div>
 <div class=" row row_data">
  <div class="col-lg-3">
   <div class="margin_t ">
    <span>
    (確認用)</span>
</div>


</div>
<div class="col-lg-9">

    <div class="outer row" style="padding-left: 15px;">
     <div class="col-12 ">

       <div class="mt_d">XXX1@xx.co.jp
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


     <div class="tbl_emp1">
        <div class="w-100">


          <div class=" row row_data">
              <div class="col-lg-3">
               <div class="margin_t ">
                <span>
                入力者1</span>
            </div>


        </div>
        <div class="col-lg-9">

            <div class="outer row" style="padding-left: 15px;">
             <div class="col-12 ">

               <div class="mt_d"></div>


           </div>

       </div>

   </div>

</div>

<div class=" row row_data">
  <div class="col-lg-3">
   <div class="margin_t ">
    <span>
    入力者2</span>
</div>


</div>
<div class="col-lg-9">

    <div class="outer row" style="padding-left: 15px;">
     <div class="col-12 ">

         <div class="mt_d"></div>


     </div>

 </div>

</div>

</div>
<div class=" row row_data">
  <div class="col-lg-3">
   <div class="margin_t ">
    <span>
    入力者3</span>
</div>


</div>
<div class="col-lg-9">

    <div class="outer row" style="padding-left: 15px;">
     <div class="col-12 ">

      <div class="mt_d"></div>


  </div>

</div>

</div>

</div>

<div class=" row row_data">
  <div class="col-lg-3">
   <div class="margin_t ">
    <span>
    入力者4</span>
</div>


</div>
<div class="col-lg-9">

    <div class="outer row" style="padding-left: 15px;">
     <div class="col-12 ">

       <div class="mt_d"></div>


   </div>

</div>

</div>

</div>



</div>

</div>
</div>


<div class="col-lg-6">


 <div class="tbl_emp1">
    <div class="w-100">


      <div class=" row row_data">
          <div class="col-lg-3">
           <div class="margin_t ">
            <span>
                決裁者1
            </span>
        </div>


    </div>
    <div class="col-lg-9">

        <div class="outer row" style="padding-left: 15px;">
         <div class="col-12 ">

           <div class="mt_d"></div>


       </div>

   </div>

</div>

</div>

<div class=" row row_data">
  <div class="col-lg-3">
   <div class="margin_t ">
    <span>
        決裁者2
    </span>
</div>


</div>
<div class="col-lg-9">

    <div class="outer row" style="padding-left: 15px;">
     <div class="col-12 ">

         <div></div>

     </div>

 </div>

</div>

</div>
<div class=" row row_data">
  <div class="col-lg-3">
   <div class="margin_t ">
    <span>
        決裁者3
    </span>
</div>


</div>
<div class="col-lg-9">

    <div class="outer row" style="padding-left: 15px;">
     <div class="col-12 ">

       <div class="mt_d"></div>

   </div>

</div>

</div>

</div>

<div class=" row row_data">
  <div class="col-lg-3">
   <div class="margin_t ">
    <span>
        決裁者4
    </span>
</div>


</div>
<div class="col-lg-9">

    <div class="outer row" style="padding-left: 15px;">
     <div class="col-12 ">

        <div class="mt_d"></div>


    </div>

</div>

</div>

</div>



</div>

</div>
</div>



</div>


<div class="row mt-1 mb-3">

 <div class="col-lg-10">


     <div class="tbl_emp1">
        <div class="w-100">


          <div class=" row row_data">
              <div class="col-lg-2">
               <div class="margin_t ">
                <span>
                    社員印影
                </span>
            </div>


        </div>
        <div class="col-lg-9">

            <div class="outer row" style="">
             <div class="col-12 ">

              <div class="mt_d"></div>


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

<!--======================= modal 2 table end here ======================-->
</div>

</div>
</div>
</div>
<!-- ============================moda1 2 finish here ======================= -->

<!-- ============================moda1 3 start here ======================= -->

<div class="modal fade"  id="employee_modal3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered" style="max-width: 900px !important;" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h6 class="modal-title" id="exampleModalLabel">社員マスタ　　(変更)</h6>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
      <div class="development_page_top_table heading_mt" style="">



        <div class="row titlebr" style="margin-bottom: 15px;">
         <div class="col-lg-6"></div>
         <div class="col-lg-6">
             <table style="float: right;">
              <tbody>
         <!-- <tr>
           <td class="td_button_p">
           <a href="#" class="btn btn-info scroll" style="margin-left: 15px!important;"><i class="fa fa-save" aria-hidden="true" style="margin-right:5px;"></i>保存</a>
           </td>
       </tr> -->
       <tr>
        <td class="" style="padding-left: 0px!important;width: 100px!important; ">
        変更(処理状況)</td>
    </tr>

</tbody>
</table>
</div>
</div>

</div>

<!--======================= modal 1 table start ======================-->

<div class="table_wrap border_none_table">




 <div class="row mt-1 mb-3">

     <div class="col-lg-10">


         <div class="tbl_emp1">
            <div class="w-100">
              <div class=" row row_data">
                  <div class="col-lg-2">
                      <div class="margin_t ">
                        <span>事業年度(期) <span style="color: red;">※</span></span>
                    </div>


                </div>
                <div class="col-lg-9">

                    <div class="outer row" style="">
                      <div class="col-3 ">

                       <div class="mt_d"> <input type="text" class="form-control" value="48"></div>


                   </div>
                   <div class="col-9 ">
                    <div class="outer row" style="">
                       <div class="col-3">
                        <div class="text-center mt_d">社員ID</div>
                    </div>

                    <div class="col-6 pl-0"><div class="mt_d"><input type="text" class="form-control" id="border_input" value="001"> </div></div>

                </div>
            </div>

        </div>

    </div>

</div>

<div class=" row row_data">
  <div class="col-lg-2">
   <div class="margin_t ">
    <span>社員名(姓)</span>
</div>


</div>
<div class="col-lg-9">

    <div class="outer row" style="">
     <div class="col-7 ">
         <div class="mt_d">
            <input type="text" class="form-control" value="山田
            "></div>


        </div>

    </div>

</div>

</div>


<div class=" row row_data">
  <div class="col-lg-2">
     <div class="margin_t ">
        <span>社員名(名)</span>
    </div>


</div>
<div class="col-lg-9">

    <div class="outer row" style="">

     <div class="col-7 ">
        <div class="mt_d">
            <input type="text" class="form-control" value="太郎
            ">
        </div>

    </div>

</div>

</div>

</div>


<div class=" row row_data">
  <div class="col-lg-2">
     <div class="margin_t ">
       <span>給与ID</span>
   </div>


</div>
<div class="col-lg-9">

    <div class="outer row" style="">
     <div class="col-7 ">
        <div class="mt_d">

            <input type="text" class="form-control" value="12345
            ">
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


     <div class="tbl_emp1">
        <div class="w-100">


          <div class=" row row_data">
              <div class="col-lg-3">
               <div class="margin_t ">
                <span>事業部</span>
            </div>


        </div>
        <div class="col-lg-9">

            <div class="outer row" style="padding-left: 15px;">
             <div class="col-12 ">
                 <div class="">
                     <select class="form-control" id="exampleFormControlSelect2">
                      <option>B9の分類名を表示</option>
                      <option></option>

                  </select>
              </div>

          </div>

      </div>

  </div>

</div>


<div class=" row row_data">
  <div class="col-lg-3">
     <div class="margin_t ">
        <span>部</span>
    </div>


</div>
<div class="col-lg-9">

    <div class="outer row" style="padding-left: 15px;">
     <div class="col-12 ">

       <select class="form-control" id="exampleFormControlSelect2">
          <option>C1の分類名を表示</option>
          <option></option>

      </select>


  </div>

</div>

</div>

</div>


<div class=" row row_data">
  <div class="col-lg-3">
     <div class="margin_t ">
       <span>グループ
       </span>
   </div>


</div>
<div class="col-lg-9">

    <div class="outer row" style="padding-left: 15px;">
     <div class="col-12 ">

        <select class="form-control" id="exampleFormControlSelect2">
          <option>C2の分類名を表示</option>
          <option></option>

      </select>



  </div>

</div>

</div>

</div>
<div class=" row row_data">
  <div class="col-lg-3">
     <div class="margin_t ">
       <span>事業所
       </span>
   </div>


</div>
<div class="col-lg-9">

    <div class="outer row" style="padding-left: 15px;">
     <div class="col-12 ">

         <select class="form-control" id="exampleFormControlSelect2">
          <option>1 大阪</option>
          <option>2 東京</option>

      </select>


  </div>

</div>

</div>

</div>

</div>

</div>
</div>


<div class="col-lg-6">


 <div class="tbl_emp1">
    <div class="w-100">


      <div class=" row row_data">
          <div class="col-lg-3">
           <div class="margin_t ">
            <span>パスワード</span>
        </div>


    </div>
    <div class="col-lg-9">

        <div class="outer row" style="padding-left: 15px;">
         <div class="col-12 ">

            <input type="password" class="form-control" value="******">


        </div>

    </div>

</div>

</div>


<div class=" row row_data">
  <div class="col-lg-3">
     <div class="margin_t ">
        <span>(確認用)</span>
    </div>


</div>
<div class="col-lg-9">

    <div class="outer row" style="padding-left: 15px;">
     <div class="col-12 ">

        <input type="password" class="form-control" value="******">


    </div>

</div>

</div>

</div>


<div class=" row row_data">
  <div class="col-lg-3">
     <div class="margin_t ">
       <span>権限

       </span>
   </div>


</div>
<div class="col-lg-9">
    <div class="outer row" style="padding-left: 15px;">
     <div class="col-6 pr-0 ">

        <select class="form-control" id="exampleFormControlSelect2" style="width: 100%!important;">
          <option>90</option>
          <option></option>

      </select>


  </div>

  <div class="col-6 pl-0 ">

    <div><input type="text" class="form-control" value="管理者"></div>


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


     <div class="tbl_emp1">
        <div class="w-100">


          <div class=" row row_data">
              <div class="col-lg-3">
               <div class="margin_t ">
                <span>
                電話番号</span>
            </div>


        </div>
        <div class="col-lg-9">

            <div class="outer row" style="padding-left: 15px;">
             <div class="col-12 ">

                <input type="text" class="form-control" value="090-0000-0000
                ">


            </div>

        </div>

    </div>

</div>


<div class=" row row_data">
  <div class="col-lg-3">
     <div class="margin_t ">
        <span>内線番号</span>
    </div>


</div>
<div class="col-lg-9">

    <div class="outer row" style="padding-left: 15px;">
     <div class="col-12 ">

        <input type="text" class="form-control" value="1">


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


     <div class="tbl_emp1">
        <div class="w-100">


          <div class=" row row_data">
              <div class="col-lg-3">
               <div class="margin_t ">
                <span>
                メールアドレス</span>
            </div>


        </div>
        <div class="col-lg-9">

            <div class="outer row" style="padding-left: 15px;">
             <div class="col-12 ">

                <input type="text" class="form-control" value="XXX1@xx.co.jp
                ">


            </div>

        </div>

    </div>

</div>
<div class=" row row_data">
  <div class="col-lg-3">
   <div class="margin_t ">
    <span>
    (確認用)</span>
</div>


</div>
<div class="col-lg-9">

    <div class="outer row" style="padding-left: 15px;">
     <div class="col-12 ">

        <input type="text" class="form-control" value="XXX1@xx.co.jp
        ">


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


     <div class="tbl_emp1">
        <div class="w-100">


          <div class=" row row_data">
              <div class="col-lg-3">
               <div class="margin_t ">
                <span>
                入力者1</span>
            </div>


        </div>
        <div class="col-lg-9">

            <div class="outer row" style="padding-left: 15px;">
             <div class="col-12 ">

              <select class="form-control" id="exampleFormControlSelect2">
                  <option></option>
                  <option></option>

              </select>


          </div>

      </div>

  </div>

</div>

<div class=" row row_data">
  <div class="col-lg-3">
   <div class="margin_t ">
    <span>
    入力者2</span>
</div>


</div>
<div class="col-lg-9">

    <div class="outer row" style="padding-left: 15px;">
     <div class="col-12 ">

      <select class="form-control" id="exampleFormControlSelect2">
          <option></option>
          <option></option>

      </select>


  </div>

</div>

</div>

</div>
<div class=" row row_data">
  <div class="col-lg-3">
   <div class="margin_t ">
    <span>
    入力者3</span>
</div>


</div>
<div class="col-lg-9">

    <div class="outer row" style="padding-left: 15px;">
     <div class="col-12 ">

       <select class="form-control" id="exampleFormControlSelect2">
          <option></option>
          <option></option>

      </select>


  </div>

</div>

</div>

</div>

<div class=" row row_data">
  <div class="col-lg-3">
   <div class="margin_t ">
    <span>
    入力者4</span>
</div>


</div>
<div class="col-lg-9">

    <div class="outer row" style="padding-left: 15px;">
     <div class="col-12 ">

         <select class="form-control" id="exampleFormControlSelect2">
          <option></option>
          <option></option>

      </select>


  </div>

</div>

</div>

</div>



</div>

</div>
</div>


<div class="col-lg-6">


 <div class="tbl_emp1">
    <div class="w-100">


      <div class=" row row_data">
          <div class="col-lg-3">
           <div class="margin_t ">
            <span>
                決裁者1
            </span>
        </div>


    </div>
    <div class="col-lg-9">

        <div class="outer row" style="padding-left: 15px;">
         <div class="col-12 ">

            <select class="form-control" id="exampleFormControlSelect2">
              <option></option>
              <option></option>

          </select>


      </div>

  </div>

</div>

</div>

<div class=" row row_data">
  <div class="col-lg-3">
   <div class="margin_t ">
    <span>
        決裁者2
    </span>
</div>


</div>
<div class="col-lg-9">

    <div class="outer row" style="padding-left: 15px;">
     <div class="col-12 ">

       <select class="form-control" id="exampleFormControlSelect2">
          <option></option>
          <option></option>

      </select>


  </div>

</div>

</div>

</div>
<div class=" row row_data">
  <div class="col-lg-3">
   <div class="margin_t ">
    <span>
        決裁者3
    </span>
</div>


</div>
<div class="col-lg-9">

    <div class="outer row" style="padding-left: 15px;">
     <div class="col-12 ">

        <select class="form-control" id="exampleFormControlSelect2">
          <option></option>
          <option></option>

      </select>


  </div>

</div>

</div>

</div>

<div class=" row row_data">
  <div class="col-lg-3">
   <div class="margin_t ">
    <span>
        決裁者4

    </span>
</div>


</div>
<div class="col-lg-9">

    <div class="outer row" style="padding-left: 15px;">
     <div class="col-12 ">

      <select class="form-control" id="exampleFormControlSelect2">
          <option></option>
          <option></option>

      </select>


  </div>

</div>

</div>

</div>



</div>

</div>
</div>



</div>


<div class="row mt-1 mb-3">

 <div class="col-lg-10">


     <div class="tbl_emp1">
        <div class="w-100">


          <div class=" row row_data">
              <div class="col-lg-2">
               <div class="margin_t ">
                <span>
                    社員印影
                </span>
            </div>


        </div>
        <div class="col-lg-9">

            <div class="outer row" style="">
             <div class="col-12 ">

              <textarea class="" rows="5" col="50" id="comment" style="width: 100%;">                  </textarea>


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

<!--======================= modal 1 table  end ======================-->
</div>

<div class="modal-footer">
   <a href="#" class="btn btn-info scroll" style="float: right;"><i class="fa fa-save" aria-hidden="true" style="margin-right: 5px;"></i>保存</a>
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

<link href="//ajax.aspnetcdn.com/ajax/jquery.ui/1.8.9/themes/blitzer/jquery-ui.css" rel="stylesheet" type="text/css">
<script src="{{ asset('js/jquery-3.4.1.min.js') }}"></script>
<!--Bootstrap 4.x-->
<script src="  {{ asset('js/bootstrap.min.js') }}"></script>

<!--Jquery Map for mac operating system-->
<script src=" {{ asset('js/select2.min.js') }}"></script>

<script type="text/javascript">

    $("#empButton3").on("click", function(){
        $("#employee_modal2").modal("hide");

        $('body').removeClass('modal-open');
        $('.modal-backdrop').remove();


    });

</script>

</body>
</html>