@section('menu', '売上請求先別与信管理マスタ')
<!DOCTYPE html>
<html lang="ja" >
<head>
  <meta charset="utf-8">
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="msapplication-tap-highlight" content="no">
  <title>売上請求先別与信管理マスタ</title>
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


.modal-open {
    overflow: hidden;
}
.modal {
  overflow: auto !important;

}
.tbl_credit tr td{
    border: 1px solid #29487d!important;
    padding: 6px;line-height: 1.42857143;
        font-size: 0.8em;

}
@media only screen and (max-width: 767px)  {
.modal {
/*  overflow: auto !important;*/
    padding: 0!important;
}
.modal-open .modal {
    overflow-x: hidden;
    overflow-y: auto;
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


    <!--first div and first two table start here  -->
      <div class="row">
        <!-- first table -->
        <div class="col-lg-3 col-sm-3 col-md-3">
          <table class="table table-bordered">


            <tbody>
              <tr>
                <td style="background-color: #3e6ec1 ;text-align: center;color: white;font-weight: bold;">会社名</td>
              </tr>
              <tr>
               <td>
                 <select class="form-control left_select " style="">
                    <option value="20"></option>
                    <option value="50"></option>
                    <option value="100"></option>
                </select>
               </td>
              </tr>
            </tbody>
          </table>
        </div>
        <!-- 2nd table -->
         <div class="col-xl-6 col-lg-9 col-md-9 col-sm-9" style="">
          <div class="outer row">


            <div class="col-lg-12 col-md-12 col-sm-12">
              <div class="tbl_credit">
<div class="table-responsive">
          <table class="">

<thead class="thead-dark">
    <tr>
      <td scope="col" colspan="4" style="background-color: #3e6ec1!important;text-align: center;color: white;font-weight: bold;">選択開始年月</td>
      <td scope="col" colspan="4" style="background-color: #3e6ec1!important;text-align: center;color: white;font-weight: bold;">選択終了年月</td>

    </tr>
  </thead>


            <tbody>

               <tr>
                <td style="border-right: 0px!important;padding-right: 0px;">
                  <select class="form-control" style="width: 95px!important;">
                    <option value="20"></option>
                    <option value="50"></option>
                    <option value="100"></option>
                  </select>
                </td>
                   <td style="border-left: 0px!important;">年</td>
                <td style="border-right: 0px!important;padding-right: 0px;">
                  <select class="form-control" style="width: 95px!important;">
                    <option value="20"></option>
                    <option value="50"></option>
                    <option value="100"></option>
                  </select>
                </td>
 <td style="border-left: 0px!important;">月</td>
               <td style="border-right: 0px!important;padding-right: 0px;">
                  <select class="form-control" style="width: 95px!important;">
                    <option value="20"></option>
                    <option value="50"></option>
                    <option value="100"></option>
                  </select>
                </td>
                <td style="border-left: 0px!important;">年</td>
                <td style="border-right: 0px!important;padding-right: 0px;">
                  <select class="form-control" style="width: 95px!important;">
                    <option value="20"></option>
                    <option value="50"></option>
                    <option value="100"></option>
                  </select>
                </td>
                    <td style="border-left: 0px!important;">月</td>
              </tr>



            </tbody>
          </table>
        </div>
</div>
</div>

        </div>




        </div>

        <!------------3rd table------->
         <div class="col-lg-3 col-sm-4" style="">

        </div>
         <!------------3rd table end------->
        <!--first div and first three table 2nd table end -->
      </div>
      <!-- end here -->

  <div class="row" >
  <div class="col-lg-8 col-sm-12 m-pd">
    <div class="responsive button-responsive-view">
        <div class="row mb-3 mt-2">
  <div class="col-lg-2 col-sm-3 col-xs-6 col-6 mb-2 text-center"><a href="#" class="btn btn-info btn-m-view " style="width: 100%;"><i class="fa fa-search" aria-hidden="true" style="margin-right: 5px;"></i>検索</a></div>
    <div class="col-lg-2 col-6 col-sm-4 col-xs-6 pl-m mb-2 text-center"><a href="#" class="btn btn-info btn-m-view " style="width: 100%;">一覧</a></div>
 <!--  <div class="col-lg-2 col-6 col-sm-4 col-xs-6  pl-m mb-2 text-center"><a href="#" class="btn btn-info btn-m-view  "style="width: 100%;" data-toggle="modal" data-target="#office_modal1">新規登録</a></div> -->
<!--  <div class="col-lg-2 col-6 col-sm-4 col-xs-6 padd-0 mb-2 text-center"><a href="#" class="btn btn-info btn-m-view " style="width: 100%;"data-toggle="modal" data-target="#office_modal2">変更</a></div> -->
  <!-- <div class="col-lg-2 col-6 col-sm-4 col-xs-6 pl-m mb-2 text-center"><a href="#" class="btn btn-info btn-m-view "style="width: 100%;">CSV作成</a></div> -->
 <div class="col-lg-2 col-sm-4 col-xs-6 col-6 pl-m mb-2 text-center " ><a href="#" class="btn btn-info btn-m-view"style="width: 100%;">EXCEL作成</a></div>

</div>
    </div>





 </div>
</div>

<!-- button table row  end -->

     <!-- pagination row starts here -->

 <div class="col-lg-12">

 <div class="row">

   <div class="pagi_main_wrap">

     <div class="pagi_inner_wrap">

       <div class="pagi_left_div">

          @include('layout.pagi1_settings')

       </div>

       <div  class="pagi_midd_div">

       @include('layout.pagi2_settings')

 @include('layout.pagi3_settings')

  @include('layout.pagi4_settings')

       </div>
        <div class="right_colset" >

          @include('layout.pagi5_settings')
        asdfghjkl;
       </div>

     </div>

   </div>



</div>
</div>

<!-- pagination row end here -->
<!-- Large table row starts here -->
  <div class="row">
  <div class="col-lg-12">

<div class="table-responsive" style="padding-bottom: 10px;">
<table class="table table-bordered table-striped">

      <thead class="thead-dark header text-center" id="myHeader">
      <tr>
        <th></th>
          <th scope="col" ><span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1;  color: #fff;">会社ＩＤ</span></th>
  <th scope="col" ><span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1;  color: #fff;">年月</span></th>
  <th scope="col" ><span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1;  color: #fff;">与信限度額</span></th>
  <th scope="col" ><span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1;  color: #fff;">前月与信残高金額</span></th>
  <th scope="col" ><span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1;  color: #fff;">当月受注金額</span></th>
  <th scope="col" ><span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1;  color: #fff;">当月売上金額</span></th>
  <th scope="col" ><span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1;  color: #fff;">当月入金金額</span></th>
  <th scope="col" ><span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1;  color: #fff;">当月与信残高金額</span></th>
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
      <a href="#" id="creditButton1" class="btn btn-info btn-m-view " style="width: 100%;" data-toggle="modal" data-target="#credit_modal1"><i class="fa fa-folder-open" aria-hidden="true" style="margin-right: 5px;"></i>詳細</a>
   </td>

        <td>123456</td>
        <td>株式会社ジョイアス</td>
        <td>2019/09</td>
        <td>999,999</td>
        <td>999,999</td>
        <td>999,999,999</td>
        <td>999,999,999</td>
        <td>999,999,999</td>
        <td>999,999</td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>

      </tr>

 <!--      3rd row -->
   <tr>
    <td style="width:50px;">
      <a href="#" id="creditButton1" class="btn btn-info btn-m-view " style="width: 100%;" data-toggle="modal" data-target="#credit_modal1"><i class="fa fa-folder-open" aria-hidden="true" style="margin-right: 5px;"></i>詳細</a>
   </td>

        <td>234567</td>
        <td>アロン化成株式会社</td>
        <td>2019/09</td>
        <td>999,999</td>
        <td>999,999</td>
        <td>999,999,999</td>
        <td>999,999,999</td>
        <td>999,999,999</td>
        <td>999,999</td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
      </tr>

 <!--      4th row -->
   <tr>
  <td style="width:50px;">
      <a href="#" id="creditButton1" class="btn btn-info btn-m-view " style="width: 100%;" data-toggle="modal" data-target="#credit_modal1"><i class="fa fa-folder-open" aria-hidden="true" style="margin-right: 5px;"></i>詳細</a>
   </td>

        <td>345678</td>
        <td>株式会社ミスミグループ本社</td>
        <td>2019/09</td>
        <td>999,999</td>
        <td>999,999</td>
        <td>999,999,999</td>
        <td>999,999,999</td>
        <td>999,999,999</td>
        <td>999,999</td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>

      </tr>
   <tr>
<td style="width:50px;">
      <a href="#" id="creditButton1" class="btn btn-info btn-m-view " style="width: 100%;" data-toggle="modal" data-target="#credit_modal1"><i class="fa fa-folder-open" aria-hidden="true" style="margin-right: 5px;"></i>詳細</a>
   </td>

        <td>456789</td>
        <td>株式会社寺岡製作所</td>
        <td>2019/09</td>
        <td>999,999</td>
        <td>999,999</td>
        <td>999,999,999</td>
        <td>999,999,999</td>
        <td>999,999,999</td>
        <td>999,999</td>
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

<div class="modal fade"  id="credit_modal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" style="max-width: 800px !important;z-index: 1055;" role="document">
    <div class="modal-content">
       <div class="modal-header">
          <h6 class="modal-title" id="exampleModalLabel">売上請求先別与信管理マスタ
　　(変更)</h6>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
    <div class="modal-body">
  <div class="development_page_top_table heading_mt" style="margin:11px;">

      <!--======================= button start ======================-->

  <div class="row titlebr" style="margin-bottom: 15px;">
<div class="col-lg-12">
        <table class="dev_tble_button" style="float: right;margin-right: -18px;
              margin-bottom: 15px;">
        <tbody>
          <tr>
          <td class="" style="padding-left: 0px!important;width: 100px!important;border:none!important; ">
            新規(処理状況)</td>
          </tr>
        </tbody>
      </table>

    </div>
</div>

<!--======================= button  end ======================-->
 </div>
<!--======================= modal 1 table start here ======================-->


<div class="row mt-1 mb-3">

           <div class="col-lg-12">


<div class="tbl_name">
<div class="w-100">


  <div class=" row row_data">
      <div class="col-lg-3">
     <div class="margin_t ">
<span>会社ID</span>    </div>


  </div>
<div class="col-lg-9">

    <div class="outer row">
               <div class="col-lg-2 ">

        <div>123456</div>


                      </div>
            <div class="col-lg-8 ">

        <div>株式会社ジョイアス・フーズ</div>


                      </div>
                    </div>

  </div>

  </div>

  <div class=" row row_data">
      <div class="col-lg-3">
     <div class="margin_t ">
<span>年月</span>    </div>


  </div>
<div class="col-lg-9">

    <div class="outer row">
               <div class="col-lg-12 ">

<input type="text" class="form-control" value="201909">


                      </div>

                    </div>

  </div>

  </div>
  <div class=" row row_data">
      <div class="col-lg-3">
     <div class="margin_t ">
<span>与信限度額</span>    </div>


  </div>
<div class="col-lg-9">

    <div class="outer row">
               <div class="col-lg-12 ">

        <div> 999,999</div>


                      </div>

                    </div>

  </div>

  </div>
    <div class=" row row_data">
      <div class="col-lg-3">
     <div class="margin_t ">
<span>前月与信残高金額</span>    </div>


  </div>
<div class="col-lg-9">

    <div class="outer row">
               <div class="col-lg-12 ">

        <div> 999,999</div>


                      </div>

                    </div>

  </div>

  </div>

      <div class=" row row_data">
      <div class="col-lg-3">
     <div class="margin_t ">
<span>当月受注金額</span>    </div>


  </div>
<div class="col-lg-9">

    <div class="outer row">
               <div class="col-lg-12 ">

        <div> 999,999,999</div>


                      </div>

                    </div>

  </div>

  </div>
        <div class=" row row_data">
      <div class="col-lg-3">
     <div class="margin_t ">
<span>当月売上金額</span>    </div>


  </div>
<div class="col-lg-9">

    <div class="outer row">
               <div class="col-lg-12 ">

        <div> 999,999,999</div>


                      </div>

                    </div>

  </div>

  </div>
          <div class=" row row_data">
      <div class="col-lg-3">
     <div class="margin_t ">
<span>当月入金金額</span>    </div>


  </div>
<div class="col-lg-9">

    <div class="outer row">
               <div class="col-lg-12 ">

<input type="text" class="form-control" value="999,999,999">


                      </div>

                    </div>

  </div>

  </div>
            <div class=" row row_data">
      <div class="col-lg-3">
     <div class="margin_t ">
<span>当月与信残高金額</span>    </div>


  </div>
<div class="col-lg-9">

    <div class="outer row">
               <div class="col-lg-12 ">

        <div>999,999</div>


                      </div>

                    </div>

  </div>

  </div>

</div>
</div>
</div>
</div>

 <!--======================= modal 1 table end here ======================-->
  </div>
 <div class="modal-footer">

<a href="#" class="btn btn-info scroll" style="float: right;"><i class="fa fa-save" aria-hidden="true" style="margin-right: 5px;"></i>保存</a>
                </div>



  </div>
  </div>
 </div>

<!-- ============================= moda1 1 start here ========================-->

<div class="modal fade"  id="credit_modal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" style="max-width: 800px !important;" role="document">
    <div class="modal-content">
       <div class="modal-header">
          <h6 class="modal-title" id="exampleModalLabel">売上請求先別与信管理マスタ　　(詳細)</h6>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
    <div class="modal-body">
  <div class="development_page_top_table heading_mt" style="margin:11px;">

      <!--======================= button start ======================-->

  <div class="row titlebr" style="margin-bottom: 15px;">

     <div class="col-lg-6"></div>
  <div class="col-lg-6">
    <table class="dev_tble_button" style="float: right;">
      <tbody>
        <tr class="marge_in">
           <td class="">
          <a class="btn btn-info scroll" id="creditButton3" data-toggle="modal" data-target="#credit_modal2" style="width: 100%;">変更画面へ</a>
           </td>
           <td class="">
           <a class="btn btn-info scroll" style=""><i class="fa fa-print" aria-hidden="true" style="margin-right: 5px;"></i>印刷</a>
           </td>
        </tr>
      </tbody>
    </table>

  </div>

</div>

<!--======================= button  end ======================-->
 </div>
<!--======================= modal 1 table start here ======================-->


<div class="row mt-1 mb-3">

           <div class="col-lg-12">


<div class="tbl_name">
<div class="w-100">


  <div class=" row row_data">
      <div class="col-lg-3">
     <div class="margin_t ">
<span>会社ID</span>    </div>


  </div>
<div class="col-lg-9">

    <div class="outer row">
               <div class="col-lg-2 ">

        <div>123456</div>


                      </div>
            <div class="col-lg-8 ">

        <div>株式会社ジョイアス・フーズ</div>


                      </div>
                    </div>

  </div>

  </div>

  <div class=" row row_data">
      <div class="col-lg-3">
     <div class="margin_t ">
<span>年月</span>    </div>


  </div>
<div class="col-lg-9">

    <div class="outer row">
               <div class="col-lg-12 ">

        <div> 201909</div>


                      </div>

                    </div>

  </div>

  </div>
  <div class=" row row_data">
      <div class="col-lg-3">
     <div class="margin_t ">
<span>与信限度額</span>    </div>


  </div>
<div class="col-lg-9">

    <div class="outer row">
               <div class="col-lg-12 ">

        <div> 999,999</div>


                      </div>

                    </div>

  </div>

  </div>
    <div class=" row row_data">
      <div class="col-lg-3">
     <div class="margin_t ">
<span>前月与信残高金額</span>    </div>


  </div>
<div class="col-lg-9">

    <div class="outer row">
               <div class="col-lg-12 ">

        <div> 999,999</div>


                      </div>

                    </div>

  </div>

  </div>

      <div class=" row row_data">
      <div class="col-lg-3">
     <div class="margin_t ">
<span>当月受注金額</span>    </div>


  </div>
<div class="col-lg-9">

    <div class="outer row">
               <div class="col-lg-12 ">

        <div> 999,999,999</div>


                      </div>

                    </div>

  </div>

  </div>
        <div class=" row row_data">
      <div class="col-lg-3">
     <div class="margin_t ">
<span>当月売上金額</span>    </div>


  </div>
<div class="col-lg-9">

    <div class="outer row">
               <div class="col-lg-12 ">

        <div> 999,999,999</div>


                      </div>

                    </div>

  </div>

  </div>
          <div class=" row row_data">
      <div class="col-lg-3">
     <div class="margin_t ">
<span>当月入金金額</span>    </div>


  </div>
<div class="col-lg-9">

    <div class="outer row">
               <div class="col-lg-12 ">

        <div> 999,999,999</div>


                      </div>

                    </div>

  </div>

  </div>
            <div class=" row row_data">
      <div class="col-lg-3">
     <div class="margin_t ">
<span>当月与信残高金額</span>    </div>


  </div>
<div class="col-lg-9">

    <div class="outer row">
               <div class="col-lg-12 ">

        <div>999,999</div>


                      </div>

                    </div>

  </div>

  </div>

</div>
</div>
</div>
</div>


 <!--======================= modal 1 table end here ======================-->
  </div>



  </div>
  </div>
 </div>
<!-- ============================moda1 1 finish here ======================= -->


   <!-- ============================moda1 2 start here ======================= -->
<!-- ============================moda1 2 end here ======================= -->

<!-- col-12 div end -->

<!-- row div end -->


<!-- container-fluid div end -->

@include('layout.footer')

<link href="//ajax.aspnetcdn.com/ajax/jquery.ui/1.8.9/themes/blitzer/jquery-ui.css" rel="stylesheet" type="text/css">
<script src="{{ asset('js/jquery-3.4.1.min.js') }}"></script>
<!--Bootstrap 4.x-->
<script src="  {{ asset('js/bootstrap.min.js') }}"></script>

<!--Jquery Map for mac operating system-->
<script src=" {{ asset('js/select2.min.js') }}"></script>
 <script type="text/javascript">

$("#creditButton3").on("click", function(){
    $("#credit_modal1").modal("hide");
  $('body').removeClass('modal-open');
  $('body').css('overflow-y', 'hidden');
 $('.modal-backdrop').remove();


});

</script>
</body>
</html>