@section('menu', '事業所マスタ')
<!DOCTYPE html>
<html lang="ja" >
<head>
  <meta charset="utf-8">
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="msapplication-tap-highlight" content="no">
  <title>事業所マスタ</title>
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

  .box-dark {
    width: 13px;
    height: 13px;
    background-color: #333;
    color: #fff;
    text-align: right;
    float: right;
    cursor: pointer;
}
.m_t{
  margin-top: 7px;

}
.button_wrap_right_top{
width: 40%;
/*margin: 2%;*/
}
.rounded_table_wrap{
width: 60%;
/*margin: 2%;*/
}

  .m-pl-15{
    padding-left: 0px!important;

  }
  .m-pr-15{
 padding-right: 0px!important;

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


   <div  class = "bordera bgcolr_order_inq" style="margin-top: 12px;margin-bottom: 80px; ">

    <div class="wrap-100"  style="margin-top: 25px;background-color: #fff;padding: 10px;box-sizing: border-box; overflow: hidden;height: auto;">

  <div class="row" >
  <div class="col-lg-8 col-sm-12 m-pd">
    <div class="responsive button-responsive-view">
        <div class="row mb-3 mt-2">
  <div class="col-lg-2 col-sm-3 col-xs-6 col-6 mb-2 text-center"><a href="#" class="btn btn-info btn-m-view " style="width: 100%;"><i class="fa fa-search" aria-hidden="true" style="margin-right: 5px;"></i>検索</a></div>
    <div class="col-lg-2 col-6 col-sm-3 col-xs-6 pl-m mb-2 text-center"><a href="#" class="btn btn-info btn-m-view " style="width: 100%;">一覧</a></div>
  <div class="col-lg-2 col-6 col-sm-3 col-xs-6  pl-m mb-2 text-center"><a href="#" class="btn btn-info btn-m-view  "style="width: 100%;" data-toggle="modal" data-target="#office_modal1">新規登録</a></div>
<!--  <div class="col-lg-2 col-6 col-sm-4 col-xs-6 padd-0 mb-2 text-center"><a href="#" class="btn btn-info btn-m-view " style="width: 100%;"data-toggle="modal" data-target="#office_modal2">変更</a></div> -->
  <!-- <div class="col-lg-2 col-6 col-sm-4 col-xs-6 pl-m mb-2 text-center"><a href="#" class="btn btn-info btn-m-view "style="width: 100%;">CSV作成</a></div> -->
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
         <th scope="col"></th>
  <th scope="col" ><span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1;color: #fff;">会社CD</span></th>
  <th scope="col" ><span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1;  color: #fff;">事業所CD</span></th>
  <th scope="col" ><span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1;  color: #fff;">事業所名</span></th>
  <th scope="col" ><span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1;  color: #fff;">事業所名略称</span></th>
  <th scope="col" ><span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1;  color: #fff;">入力区分</span></th>
  <th scope="col" ><span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1;  color: #fff;">担当SA1</span></th>
  <th scope="col" ><span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1;  color: #fff;">担当SA2</span></th>
  <th scope="col" ><span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1;  color: #fff;">担当SE1</span></th>
  <th scope="col" ><span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1;  color: #fff;">担当SE2</span></th>
  <th scope="col" ><span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1;  color: #fff;">郵便番号</span></th>
  <th scope="col" ><span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1;  color: #fff;">都道府県名</span></th>
  <th scope="col" ><span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1;  color: #fff;">市区町村名</span></th>
  <th scope="col" ><span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1;  color: #fff;">町域名</span></th>
  <th scope="col" ><span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1;  color: #fff;">番地・建物名</span></th>
  <th scope="col" ><span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1;  color: #fff;">TEL</span></th>
  <th scope="col" ><span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1;  color: #fff;">FAX</span></th>
  <th scope="col" ><span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1;  color: #fff;">JIS市区町村CD</span></th>
  <th scope="col" ><span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1;  color: #fff;">メールアドレス</span></th>
  <th scope="col" ><span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1;  color: #fff;">請求先CD</span></th>
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







      </tr>

 <!--      2nd row -->
   <tr>
    <td class="col-lg-2 col-sm-4 col-xs-6 col-6 mb-2 text-center"><a href="{{url('/personal')}}" target="_blank" class="btn btn-warning btn-m-view " style="width: 100%;background-color: #87ceeb!important;border:1px solid #87ceeb!important;"><i class="fas fa-plus-circle" style="margin-right:5px;"></i>展開</a>
      </td>
      <td style="width:50px;">
      <a href="#" id="productsubButton1" class="btn btn-info btn-m-view " style="width: 100%;" data-toggle="modal" data-target="#office_modal2"><i class="fa fa-folder-open" aria-hidden="true" style="margin-right: 5px;"></i>詳細</a>
     </td>

        <td>1</td>
        <td>001</td>
        <td>12345</td>
        <td>48</td>
        <td>01</td>
        <td>1</td>
        <td>1</td>
        <td>1</td>
        <td></td>
        <td>90</td>
        <td></td>
        <td>1030015</td>
        <td>東京都</td>
        <td></td>
        <td></td>
        <td></td>
        <td>0421234567</td>
        <td>0421234568</td>
        <td>13102</td>
        <td>XXX1@XX.co.jp</td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
               <td></td>



      </tr>

 <!--      3rd row -->
   <tr>
    <td class="col-lg-2 col-sm-4 col-xs-6 col-6 mb-2 text-center"><a href="{{url('/personal')}}" target="_blank" class="btn btn-warning btn-m-view " style="width: 100%;background-color: #87ceeb!important;border:1px solid #87ceeb!important;"><i class="fas fa-plus-circle" style="margin-right:5px;"></i>展開</a>
      </td>
      <td style="width:50px;">
      <a href="#" id="productsubButton1" class="btn btn-info btn-m-view " style="width: 100%;" data-toggle="modal" data-target="#office_modal2"><i class="fa fa-folder-open" aria-hidden="true" style="margin-right: 5px;"></i>詳細</a>
     </td>

         <td>2</td>
        <td>001</td>
        <td>12345</td>
        <td>48</td>
        <td>01</td>
        <td>1</td>
        <td>1</td>
        <td>1</td>
        <td></td>
        <td>90</td>
        <td></td>
        <td>1030015</td>
        <td>東京都</td>
        <td></td>
        <td></td>
        <td></td>
        <td>0421234567</td>
        <td>0421234568</td>
        <td>13102</td>
        <td>XXX1@XX.co.jp</td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
               <td></td>
      </tr>

 <!--      4th row -->
   <tr>
     <td class="col-lg-2 col-sm-4 col-xs-6 col-6 mb-2 text-center"><a href="{{url('/personal')}}" target="_blank" class="btn btn-warning btn-m-view " style="width: 100%;background-color: #87ceeb!important;border:1px solid #87ceeb!important;"><i class="fas fa-plus-circle" style="margin-right:5px;"></i>展開</a>
      </td>
      <td style="width:50px;">
      <a href="#" id="productsubButton1" class="btn btn-info btn-m-view " style="width: 100%;" data-toggle="modal" data-target="#office_modal2"><i class="fa fa-folder-open" aria-hidden="true" style="margin-right: 5px;"></i>詳細</a>
     </td>

<td>3</td>
        <td>001</td>
        <td>12345</td>
        <td>48</td>
        <td>01</td>
        <td>1</td>
        <td>1</td>
        <td>1</td>
        <td></td>
        <td>90</td>
        <td></td>
        <td>1030015</td>
        <td>東京都</td>
        <td></td>
        <td></td>
        <td></td>
        <td>0421234567</td>
        <td>0421234568</td>
        <td>13102</td>
        <td>XXX1@XX.co.jp</td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
               <td></td>

      </tr>
   <tr>
    <td class="col-lg-2 col-sm-4 col-xs-6 col-6 mb-2 text-center"><a href="{{url('/personal')}}" target="_blank" class="btn btn-warning btn-m-view " style="width: 100%;background-color: #87ceeb!important;border:1px solid #87ceeb!important;"><i class="fas fa-plus-circle" style="margin-right:5px;"></i>展開</a>
      </td>
      <td style="width:50px;">
      <a href="#" id="productsubButton1" class="btn btn-info btn-m-view " style="width: 100%;" data-toggle="modal" data-target="#office_modal2"><i class="fa fa-folder-open" aria-hidden="true" style="margin-right: 5px;"></i>詳細</a>
     </td>

         <td>1</td>
        <td>001</td>
        <td>12345</td>
        <td>48</td>
        <td>01</td>
        <td>1</td>
        <td>1</td>
        <td>1</td>
        <td></td>
        <td>90</td>
        <td></td>
        <td>1030015</td>
        <td>東京都</td>
        <td></td>
        <td></td>
        <td></td>
        <td>0421234567</td>
        <td>0421234568</td>
        <td>13102</td>
        <td>XXX1@XX.co.jp</td>
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
 <!--    </div> -->


<!-- Modal 1 start here -->

<div class="modal fade" data-keyboard="false" data-backdrop="static" id="office_modal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
 <div class="modal-dialog modal-dialog-centered" style="max-width: 800px !important;" role="document">
  <div class="modal-content">
    <div class="modal-header">
      <h6 class="modal-title" id="exampleModalLabel">事業所マスタ(登録)</h6>
      <button type="button" class="close" >
        <span aria-hidden="true">&times;</span>
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
   <!--======================= modal 1 table start ======================-->


  <div class="table_wrap">


  <div class="row mt-1 mb-3">

   <div class="col-lg-12">


    <div class="tbl_name">
      <div class="w-100">

 <div class=" row row_data">
      <div class="col-lg-2">
     <div class="margin_t ">
<span>会社CD</span>
</div>


  </div>
  <div class="col-lg-9">

      <div class="outer row">
          <div class="col-lg-4 ">

        <select class="form-control" style="width:100%;">
                        <option value="1"></option>
                        <option value="1"></option>
           </select>

          </div>
        <div class="col-lg-8  m-pl-15 ">
          <input type="text" class="form-control">

        </div>
      </div>

    </div>

  </div>
<!--  <div class=" row row_data">
      <div class="col-lg-2">
     <div class="margin_t ">
<span>事業所ID<span style="color: red;">※</span></span>
</div>


  </div>
  <div class="col-lg-9">

      <div class="outer row">

        <div class="col-lg-4 ">
<div class="m_t"></div>

        </div>
      </div>

    </div>

  </div> -->
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
<span>事業所名</span>
</div>


  </div>
  <div class="col-lg-8">

      <div class="outer row">

        <div class="col-lg-12 ">
          <input type="text" class="form-control">

        </div>
      </div>

    </div>

  </div>

     <div class=" row row_data">
      <div class="col-lg-4">
     <div class="margin_t ">
<span >事業所名略称</span>
</div>


  </div>
  <div class="col-lg-8">

      <div class="outer row">

        <div class="col-lg-12 ">
          <input type="text" class="form-control">

        </div>
      </div>

    </div>

  </div>

         <div class=" row row_data">
      <div class="col-lg-4">
     <div class="margin_t ">
<span>入力区分</span>
</div>


  </div>
  <div class="col-lg-8">

      <div class="outer row">

        <div class="col-lg-12 ">
      <select class="form-control" style="width:100%;">
                  <option value="1">0 マスタ索引</option>
                  <option value="1">1 入力可</option>

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
      <div class="col-lg-3">
     <div class="margin_t ">
<span>担当SA1</span>
</div>


  </div>
  <div class="col-lg-9">

      <div class="outer row">

        <div class="col-lg-12 ">
      <select class="form-control" style="width:100%;">
                  <option value="1">159 佐藤</option>
                  <option value="1">357 山田</option>
                  <option value="1">654 田中</option>
                  <option value="1">789 鈴木</option>
              </select>

        </div>
      </div>

    </div>

  </div>
         <div class=" row row_data">
      <div class="col-lg-3">
     <div class="margin_t ">
<span>担当SA2</span>
</div>


  </div>
  <div class="col-lg-9">

      <div class="outer row">

        <div class="col-lg-12 ">
      <select class="form-control" style="width:100%;">
                  <option value="1">335 加藤</option>
                  <option value="1">447 渡辺</option>
                  <option value="1">558 中山</option>
                  <option value="1">987 伊藤</option>
              </select>

        </div>
      </div>

    </div>

  </div>

           <div class=" row row_data">
      <div class="col-lg-3">
     <div class="margin_t ">
<span>担当SE1</span>
</div>


  </div>
  <div class="col-lg-9">

      <div class="outer row">

        <div class="col-lg-12 ">
      <select class="form-control" style="width:100%;">
                  <option value="1">124 佐野</option>
                  <option value="1">587 菊池</option>
                  <option value="1">587 菊池</option>
                  <option value="1">774 小森</option>

              </select>

        </div>
      </div>

    </div>

  </div>

             <div class=" row row_data">
      <div class="col-lg-3">
     <div class="margin_t ">
<span>担当SE2</span>
</div>


  </div>
  <div class="col-lg-9">

      <div class="outer row">

        <div class="col-lg-12 ">
      <select class="form-control" style="width:100%;">
                  <option value="1">338 西村</option>
                  <option value="1">415 柴田</option>
                  <option value="1">485 佐々木</option>
                  <option value="1">778 工藤</option>
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

<div class="col-lg-12">


    <div class="tbl_name">
      <div class="w-100">

 <div class=" row row_data">
      <div class="col-lg-2">
     <div class="margin_t ">
<span>郵便番号</span>
</div>


  </div>
  <div class="col-lg-9">

      <div class="outer row">

        <div class="col-lg-2 m-pr-15">
  <input type="text" class="form-control">

        </div>
          <div class="col-lg-1 ">
          <div class="text-center m_t">-</div>
        </div>
        <div class="col-lg-2 m-pl-15 ">
      <input type="text" class="form-control">

        </div>

            <div class="col-lg-7 ">
        <div class="outer row">
            <div class="col-lg-4 "><span class="margin_t">都道府県
        </span></div>
        <div class="col-lg-8 ">
            <input type="text" class="form-control">
        </div>
        </div>

        </div>

      </div>

    </div>

  </div>

 <div class=" row row_data">
      <div class="col-lg-2">
     <div class="margin_t ">
<span>市区町村名</span>
</div>


  </div>
  <div class="col-lg-9">

      <div class="outer row">

        <div class="col-lg-12 ">
   <input type="text" class="form-control">

        </div>
      </div>

    </div>

  </div>

 <div class=" row row_data">
      <div class="col-lg-2">
     <div class="margin_t ">
<span>地域名</span>
</div>


  </div>
  <div class="col-lg-9">

      <div class="outer row">

        <div class="col-lg-12 ">
   <input type="text" class="form-control">

        </div>
      </div>

    </div>

  </div>
 <div class=" row row_data">
      <div class="col-lg-2">
     <div class="margin_t ">
<span>番地・建物名</span>
</div>


  </div>
  <div class="col-lg-9">

      <div class="outer row">

        <div class="col-lg-12 ">
   <input type="text" class="form-control">

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
<span>TEL</span>
</div>


  </div>
  <div class="col-lg-8">

      <div class="outer row">

        <div class="col-lg-12 ">
   <input type="text" class="form-control">

        </div>
      </div>

    </div>

  </div>

<div class=" row row_data">
      <div class="col-lg-4">
     <div class="margin_t ">
<span>FAX</span>
</div>


  </div>
  <div class="col-lg-8">

      <div class="outer row">

        <div class="col-lg-12 ">
   <input type="text" class="form-control">

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
      <div class="col-lg-5">
     <div class="margin_t ">
<span>JIS市区町村CD
</span>
</div>


  </div>
  <div class="col-lg-7">

      <div class="outer row">

        <div class="col-lg-12 ">
<select class="form-control" style="width:100%;">
                  <option value="1"></option>
                  <option value="1">1</option>
                  <option value="1">1</option>
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

   <div class="col-lg-12">


    <div class="tbl_name">
      <div class="w-100">

<div class=" row row_data">
      <div class="col-lg-3">
     <div class="margin_t ">
<span>メールアドレス</span>
</div>


  </div>
  <div class="col-lg-9">

      <div class="outer row">

        <div class="col-lg-12 ">
   <input type="text" class="form-control">

        </div>
      </div>

    </div>

  </div>
<div class=" row row_data">
      <div class="col-lg-3">
     <div class="margin_t ">
<span>メールアドレス(確認用)</span>
</div>


  </div>
  <div class="col-lg-9">

      <div class="outer row">

        <div class="col-lg-12 ">
   <input type="text" class="form-control">

        </div>
      </div>

    </div>

  </div>

<div class=" row row_data">
      <div class="col-lg-3">
     <div class="margin_t ">
<span>請求先CD</span>
</div>


  </div>
  <div class="col-lg-9">

      <div class="outer row">

        <div class="col-lg-12 ">

<input type="text" class="form-control" style="">
<div class="box-dark" id="box_popup1" style="bottom: 0;float: left;margin-top: 8px;position: absolute;right: 24px;top: 0px;" data-toggle="modal" data-target="#contractor_modal">

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



       <!--======================= modal 1 table  end ======================-->
 </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-info" data-dismiss="modal"><i class="fas fa-save" style="margin-right: 5px;"></i>保存 </button> <!-- <button type="button" class="btn btn-info" data-dismiss="modal">キャンセル </button> -->
    </div>
   </div>
  </div>
</div>
<!--============================== moda1 1 finish ====================== -->

<!-- ============================= moda1 2 start here ========================-->

<div class="modal fade" data-keyboard="false" data-backdrop="static" id="office_modal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" style="max-width: 800px !important;" role="document">
    <div class="modal-content">
       <div class="modal-header">
          <h6 class="modal-title" id="exampleModalLabel">事業所マスタ(詳細)</h6>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
    <div class="modal-body">
  <div class="development_page_top_table heading_mt" style="margin:11px;margin-right: 0px;">

      <!--======================= button start ======================-->

  <div class="row titlebr" style="margin-bottom: 15px;">

  <div class="col-lg-6" style=""></div>

  <div class="col-lg-6" >
    <table class="dev_tble_button" style="float: right;">
      <tbody>
        <tr class="marge_in">
           <td class="">
          <a class="btn btn-info scroll" id="officeButton3" data-toggle="modal" data-target="#office_modal3" style=""><i class="fa fa-pencil-square-o" aria-hidden="true" style="margin-right: 5px;"></i>変更画面へ</a>
           </td>
           <td class="td_button_p">
           <a class="btn btn-info scroll" style=""><i class="fa fa-print" aria-hidden="true" style="margin-right: 5px;"></i>印刷</a>
           </td>
        </tr>
      </tbody>
    </table>

  </div>

</div>

<!--======================= button  end ======================-->
 </div>
<!--======================= modal 2 table start here ======================-->


<div class="table_wrap">


  <div class="row mt-1 mb-3">

   <div class="col-lg-12">


    <div class="tbl_name">
      <div class="w-100">

 <div class=" row row_data">
      <div class="col-lg-2">
     <div class="margin_t ">
<span>会社CD</span>
</div>


  </div>
  <div class="col-lg-9">

      <div class="outer row">
          <div class="col-lg-4 ">
             <div class="m_t">123456</div>


          </div>
        <div class="col-lg-8  m-pl-15 ">
                  <div class="m_t">株式会社ジョイアス・フーズ</div>

        </div>
      </div>

    </div>

  </div>
 <div class=" row row_data">
      <div class="col-lg-2">
     <div class="margin_t ">
<span>事業所CD<span style="color: red;">※</span></span>
</div>


  </div>
  <div class="col-lg-9">

      <div class="outer row">

        <div class="col-lg-4 ">
        <div class="m_t">12</div>

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
<span>事業所名</span>
</div>


  </div>
  <div class="col-lg-8">

      <div class="outer row">

        <div class="col-lg-12 ">
         <div class="m_t">北海道支店</div>

        </div>
      </div>

    </div>

  </div>

     <div class=" row row_data">
      <div class="col-lg-4">
     <div class="margin_t ">
<span >事業所名略称</span>
</div>


  </div>
  <div class="col-lg-8">

      <div class="outer row">

        <div class="col-lg-12 ">
               <div class="m_t">北海道</div>

        </div>
      </div>

    </div>

  </div>

         <div class=" row row_data">
      <div class="col-lg-4">
     <div class="margin_t ">
<span>入力区分</span>
</div>


  </div>
  <div class="col-lg-8">

      <div class="outer row">

        <div class="col-lg-12 ">
           <div class="m_t">1 入力可</div>

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
      <div class="col-lg-3">
     <div class="margin_t ">
<span>担当SA1</span>
</div>


  </div>
  <div class="col-lg-9">

      <div class="outer row">

        <div class="col-lg-12 ">
  <div class="m_t">357 山田</div>

        </div>
      </div>

    </div>

  </div>
         <div class=" row row_data">
      <div class="col-lg-3">
     <div class="margin_t ">
<span>担当SA2</span>
</div>


  </div>
  <div class="col-lg-9">

      <div class="outer row">

        <div class="col-lg-12 ">
   <div class="m_t">987 伊藤</div>

        </div>
      </div>

    </div>

  </div>

           <div class=" row row_data">
      <div class="col-lg-3">
     <div class="margin_t ">
<span>担当SE1</span>
</div>


  </div>
  <div class="col-lg-9">

      <div class="outer row">

        <div class="col-lg-12 ">
   <div class="m_t">587 菊池</div>

        </div>
      </div>

    </div>

  </div>

             <div class=" row row_data">
      <div class="col-lg-3">
     <div class="margin_t ">
<span>担当SE2</span>
</div>


  </div>
  <div class="col-lg-9">

      <div class="outer row">

        <div class="col-lg-12 ">
 <div class="m_t">485 佐々木</div>

        </div>
      </div>

    </div>

  </div>
      </div>
    </div>
  </div>


</div>

<div class="row mt-1 mb-3">

<div class="col-lg-12">


    <div class="tbl_name">
      <div class="w-100">

 <div class=" row row_data">
      <div class="col-lg-2">
     <div class="margin_t ">
<span>郵便番号</span>
</div>


  </div>
  <div class="col-lg-9">

      <div class="outer row">

        <div class="col-lg-3 m-pr-15">
  <div class="m_t pull-left">001</div>
    <div class="text-center m_t pull-left" style="margin-right: 4px;margin-left: 4px;">-</div>
           <div class="m_t pull-left">0011</div>
        </div>


            <div class="col-lg-7 ">
        <div class="outer row">
            <div class="col-lg-4 "><div class="m_t">都道府県
        </div></div>
        <div class="col-lg-8 ">
       <div class="m_t">北海道</div>
        </div>
        </div>

        </div>

      </div>

    </div>

  </div>

 <div class=" row row_data">
      <div class="col-lg-2">
     <div class="margin_t ">
<span>市区町村名</span>
</div>


  </div>
  <div class="col-lg-9">

      <div class="outer row">

        <div class="col-lg-12 ">
 <div class="m_t">札幌市</div>

        </div>
      </div>

    </div>

  </div>

 <div class=" row row_data">
      <div class="col-lg-2">
     <div class="margin_t ">
<span>地域名</span>
</div>


  </div>
  <div class="col-lg-9">

      <div class="outer row">

        <div class="col-lg-12 ">
 <div class="m_t">北町</div>

        </div>
      </div>

    </div>

  </div>
 <div class=" row row_data">
      <div class="col-lg-2">
     <div class="margin_t ">
<span>番地・建物名</span>
</div>


  </div>
  <div class="col-lg-9">

      <div class="outer row">

        <div class="col-lg-12 ">
 <div class="m_t">1番2号</div>

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
<span>TEL</span>
</div>


  </div>
  <div class="col-lg-8">

      <div class="outer row">

        <div class="col-lg-12 ">
 <div class="m_t">0421234567</div>

        </div>
      </div>

    </div>

  </div>

<div class=" row row_data">
      <div class="col-lg-4">
     <div class="margin_t ">
<span>FAX</span>
</div>


  </div>
  <div class="col-lg-8">

      <div class="outer row">

        <div class="col-lg-12 ">
 <div class="m_t">0421234568</div>

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
      <div class="col-lg-5">
     <div class="margin_t ">
<span>JIS市区町村CD
</span>
</div>


  </div>
  <div class="col-lg-7">

      <div class="outer row">

        <div class="col-lg-12 ">
 <div class="m_t">13102</div>

        </div>
      </div>

    </div>

  </div>


      </div>
    </div>
  </div>


</div>

<div class="row mt-1 mb-3">

   <div class="col-lg-12">


    <div class="tbl_name">
      <div class="w-100">

<div class=" row row_data">
      <div class="col-lg-3">
     <div class="margin_t ">
<span>メールアドレス</span>
</div>


  </div>
  <div class="col-lg-9">

      <div class="outer row">

        <div class="col-lg-12 ">
 <div class="m_t">XXX1@xx.co.jp</div>

        </div>
      </div>

    </div>

  </div>
<div class=" row row_data">
      <div class="col-lg-3">
     <div class="margin_t ">
<span>メールアドレス(確認用)</span>
</div>


  </div>
  <div class="col-lg-9">

      <div class="outer row">

        <div class="col-lg-12 ">
 <div class="m_t">XXX1@xx.co.jp</div>

        </div>
      </div>

    </div>

  </div>

<div class=" row row_data">
      <div class="col-lg-3">
     <div class="margin_t ">
<span>請求先CD</span>
</div>


  </div>
  <div class="col-lg-9">

      <div class="outer row">

        <div class="col-lg-12 ">
 <div class="m_t">13102</div>

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
    <div class="modal-footer">
<!--         <button type="button" class="btn btn-info" data-dismiss="modal">閉じる</button> -->
    </div>
  </div>
  </div>
 </div>
<!-- ============================moda1 2 finish here ======================= -->

<!-- ============================moda1 3 start here ======================= -->

<div class="modal fade" data-keyboard="false" data-backdrop="static"  id="office_modal3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
 <div class="modal-dialog modal-dialog-centered" style="max-width: 800px!important;" role="document">
  <div class="modal-content">
    <div class="modal-header">
      <h6 class="modal-title" id="exampleModalLabel">事業所マスタ(変更)</h6>
      <button type="button" class="close" >
        <span aria-hidden="true">&times;</span>
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
   <!--======================= modal 3 table start ======================-->

<div class="table_wrap">


  <div class="row mt-1 mb-3">

   <div class="col-lg-12">


    <div class="tbl_name">
      <div class="w-100">

 <div class=" row row_data">
      <div class="col-lg-2">
     <div class="margin_t ">
<span>会社CD</span>
</div>


  </div>
  <div class="col-lg-9">

      <div class="outer row">
          <div class="col-lg-4 ">

        <select class="form-control" style="width:100%;">
                        <option value="1">123456</option>
                        <option value="1"></option>
           </select>

          </div>
        <div class="col-lg-8  m-pl-15 ">
          <input type="text" class="form-control" value="株式会社ジョイアス・フーズ">

        </div>
      </div>

    </div>

  </div>
 <div class=" row row_data">
      <div class="col-lg-2">
     <div class="margin_t ">
<span>事業所CD<span style="color: red;">※</span></span>
</div>


  </div>
  <div class="col-lg-9">

      <div class="outer row">

        <div class="col-lg-4 ">
       <div class="m_t">12</div>

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
<span>事業所名</span>
</div>


  </div>
  <div class="col-lg-8">

      <div class="outer row">

        <div class="col-lg-12 ">
          <input type="text" class="form-control" value="北海道支店">

        </div>
      </div>

    </div>

  </div>

     <div class=" row row_data">
      <div class="col-lg-4">
     <div class="margin_t ">
<span >事業所名略称</span>
</div>


  </div>
  <div class="col-lg-8">

      <div class="outer row">

        <div class="col-lg-12 ">
          <input type="text" class="form-control" value="北海道">

        </div>
      </div>

    </div>

  </div>

         <div class=" row row_data">
      <div class="col-lg-4">
     <div class="margin_t ">
<span>入力区分</span>
</div>


  </div>
  <div class="col-lg-8">

      <div class="outer row">

        <div class="col-lg-12 ">
      <select class="form-control" style="width:100%;">
                  <option value="1">1 入力可</option>
                  <option value="1">1 入力可</option>

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
      <div class="col-lg-3">
     <div class="margin_t ">
<span>担当SA1</span>
</div>


  </div>
  <div class="col-lg-9">

      <div class="outer row">

        <div class="col-lg-12 ">
      <select class="form-control" style="width:100%;">
                  <option value="1">159 佐藤</option>
                  <option value="1">357 山田</option>
                  <option value="1">654 田中</option>
                  <option value="1">789 鈴木</option>
              </select>

        </div>
      </div>

    </div>

  </div>
         <div class=" row row_data">
      <div class="col-lg-3">
     <div class="margin_t ">
<span>担当SA2</span>
</div>


  </div>
  <div class="col-lg-9">

      <div class="outer row">

        <div class="col-lg-12 ">
      <select class="form-control" style="width:100%;">
                  <option value="1">335 加藤</option>
                  <option value="1">447 渡辺</option>
                  <option value="1">558 中山</option>
                  <option value="1">987 伊藤</option>
              </select>

        </div>
      </div>

    </div>

  </div>

           <div class=" row row_data">
      <div class="col-lg-3">
     <div class="margin_t ">
<span>担当SE1</span>
</div>


  </div>
  <div class="col-lg-9">

      <div class="outer row">

        <div class="col-lg-12 ">
      <select class="form-control" style="width:100%;">
                  <option value="1">124 佐野</option>
                  <option value="1">587 菊池</option>
                  <option value="1">587 菊池</option>
                  <option value="1">774 小森</option>

              </select>

        </div>
      </div>

    </div>

  </div>

             <div class=" row row_data">
      <div class="col-lg-3">
     <div class="margin_t ">
<span>担当SE2</span>
</div>


  </div>
  <div class="col-lg-9">

      <div class="outer row">

        <div class="col-lg-12 ">
      <select class="form-control" style="width:100%;">
                  <option value="1">338 西村</option>
                  <option value="1">415 柴田</option>
                  <option value="1">485 佐々木</option>
                  <option value="1">778 工藤</option>
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

<div class="col-lg-12">


    <div class="tbl_name">
      <div class="w-100">

 <div class=" row row_data">
      <div class="col-lg-2">
     <div class="margin_t ">
<span>郵便番号</span>
</div>


  </div>
  <div class="col-lg-9">

      <div class="outer row">

        <div class="col-lg-2 m-pr-15">
  <input type="text" class="form-control" value="001">

        </div>
          <div class="col-lg-1 ">
          <div class="text-center m_t">-</div>
        </div>
        <div class="col-lg-2 m-pl-15 ">
      <input type="text" class="form-control" value="0011">

        </div>

            <div class="col-lg-7 ">
        <div class="outer row">
            <div class="col-lg-4 "><span class="margin_t">都道府県
        </span></div>
        <div class="col-lg-8 ">
            <input type="text" class="form-control" value="北海道">
        </div>
        </div>

        </div>

      </div>

    </div>

  </div>

 <div class=" row row_data">
      <div class="col-lg-2">
     <div class="margin_t ">
<span>市区町村名</span>
</div>


  </div>
  <div class="col-lg-9">

      <div class="outer row">

        <div class="col-lg-12 ">
   <input type="text" class="form-control" value="札幌市
">

        </div>
      </div>

    </div>

  </div>

 <div class=" row row_data">
      <div class="col-lg-2">
     <div class="margin_t ">
<span>地域名</span>
</div>


  </div>
  <div class="col-lg-9">

      <div class="outer row">

        <div class="col-lg-12 ">
   <input type="text" class="form-control" value="北町">

        </div>
      </div>

    </div>

  </div>
 <div class=" row row_data">
      <div class="col-lg-2">
     <div class="margin_t ">
<span>番地・建物名</span>
</div>


  </div>
  <div class="col-lg-9">

      <div class="outer row">

        <div class="col-lg-12 ">
   <input type="text" class="form-control" value="1番2号">

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
<span>TEL</span>
</div>


  </div>
  <div class="col-lg-8">

      <div class="outer row">

        <div class="col-lg-12 ">
   <input type="text" class="form-control" value="0421234567">

        </div>
      </div>

    </div>

  </div>

<div class=" row row_data">
      <div class="col-lg-4">
     <div class="margin_t ">
<span>FAX</span>
</div>


  </div>
  <div class="col-lg-8">

      <div class="outer row">

        <div class="col-lg-12 ">
   <input type="text" class="form-control" value="0421234568">

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
      <div class="col-lg-5">
     <div class="margin_t ">
<span>JIS市区町村CD
</span>
</div>


  </div>
  <div class="col-lg-7">

      <div class="outer row">

        <div class="col-lg-12 ">
<select class="form-control" style="width:100%;">
                  <option value="1">13102</option>
                  <option value="1">1</option>
                  <option value="1">1</option>
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

   <div class="col-lg-12">


    <div class="tbl_name">
      <div class="w-100">

<div class=" row row_data">
      <div class="col-lg-3">
     <div class="margin_t ">
<span>メールアドレス</span>
</div>


  </div>
  <div class="col-lg-9">

      <div class="outer row">

        <div class="col-lg-12 ">
   <input type="text" class="form-control" value="XXX1@xx.co.jp">

        </div>
      </div>

    </div>

  </div>
<div class=" row row_data">
      <div class="col-lg-3">
     <div class="margin_t ">
<span>メールアドレス(確認用)</span>
</div>


  </div>
  <div class="col-lg-9">

      <div class="outer row">

        <div class="col-lg-12 ">
   <input type="text" class="form-control" value="XXX1@xx.co.jp">

        </div>
      </div>

    </div>

  </div>

<div class=" row row_data">
      <div class="col-lg-3">
     <div class="margin_t ">
<span>請求先CD</span>
</div>


  </div>
  <div class="col-lg-9">

      <div class="outer row">

        <div class="col-lg-12 ">
<input type="text" class="form-control" style="">
          <div class="box-dark" id="box_popup2"style="bottom: 0;float: left;margin-top: 8px;position: absolute;right: 24px;top: 0px;" data-toggle="modal" data-target="#contractor_modal"></div>
<!-- <select class="form-control" style="width:100%;">
                  <option value="1">13102</option>
                  <option value="1">1</option>
                  <option value="1">1</option>
              </select> -->

        </div>
      </div>

    </div>

  </div>

      </div>
    </div>
  </div>
</div>

</div>


       <!--======================= modal 3 table  end ======================-->
 </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-info" data-dismiss="modal"><i class="fas fa-save" style="margin-right: 5px;"></i>保存 </button> <!-- <button type="button" class="btn btn-info" data-dismiss="modal">キャンセル </button> -->
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


<!-- ============================new moda1 end here ======================= -->
<div class="modal fade" data-keyboard="false" data-backdrop="static" id="setting_display_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 1050px;">
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
  <div class="col-lg-4">
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
                                                    <input type="checkbox" id="th2" class="custom-control-input customCheckBox">
                                                    <label class="custom-control-label margin_btn_17" for="th2"></label>
                                                </div>
                                            </td>
                                               <td style="width:60px!important;">
                                                <input type="tel" class="form-control" value="1" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                                            </td>
                                            <td class="text-left">
                                                <span class="mt-1 text-left">事業所CD </span>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>
                                                <div class="custom-control custom-checkbox custom-control-inline">
                                                    <input type="checkbox" id="th3" class="custom-control-input customCheckBox">
                                                    <label class="custom-control-label margin_btn_17" for="th3"></label>
                                                </div>
                                            </td>
                                               <td style="width:60px!important;">
                                                <input type="tel" class="form-control" value="2" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                                            </td>
                                            <td class="text-left">
                                                <span class="mt-1 text-left">事業所名 </span>
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
                                                <span class="mt-1 text-left">事業所名略称</span>
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
                                                <span class="mt-1 text-left">事業所名カナ</span>
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
                                                <span class="mt-1 text-left">入力区分</span>
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
                                                <span class="mt-1 text-left">担当SA1</span>
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
                                                <span class="mt-1 text-left">担当SA2</span>
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
                                                <span class="mt-1 text-left">担当SE1</span>
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
                                                <span class="mt-1 text-left">担当SE2</span>
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
                                                <span class="mt-1 text-left">郵便番号</span>
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
                                                <span class="mt-1 text-left">都道府県名</span>
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
                                                <span class="mt-1 text-left">市区町村名</span>
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
                                                <span class="mt-1 text-left">番地・建物名</span>
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
                                                <span class="mt-1 text-left">TEL</span>
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
                                                <span class="mt-1 text-left">FAX</span>
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
                                                <span class="mt-1 text-left">JIS市区町村CD</span>
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
                                                <span class="mt-1 text-left">メールアドレス</span>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>
                                                <div class="custom-control custom-checkbox custom-control-inline">
                                                    <input type="checkbox" id="th19" class="custom-control-input customCheckBox">
                                                    <label class="custom-control-label margin_btn_17" for="th19"></label>
                                                </div>
                                            </td>
                                               <td style="width:60px!important;">
                                                <input type="tel" class="form-control" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                                            </td>
                                            <td class="text-left">
                                                <span class="mt-1 text-left">請求先CDﾞ</span>
                                            </td>
                                        </tr>



                                </tbody>
                            </table>
                        </div>
</div>

<div class="col-lg-4">
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
                                                <span class="mt-1 text-left">データ有効区分</span>
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
                                                <span class="mt-1 text-left">登録年月日</span>
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
                                                <span class="mt-1 text-left">登録時刻</span>
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
                                                <span class="mt-1 text-left">更新年月日</span>
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
                                                <span class="mt-1 text-left">更新時刻</span>
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
                                                <input type="tel" class="form-control" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                                            </td>
                                            <td class="text-left">
                                                <span class="mt-1 text-left">更新時端末IP</span>
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
                        <button type="button" class="btn btn-info" data-dismiss="modal"><i class="fas fa-save" style="margin-right: 5px;"></i>保存 </button>
                        </div>
                    </div>
                </div>
            </div>
    <div class="modal fade" data-backdrop="static" id="contractor_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 1106px!important;">
            <div class="modal-content">

                 <div class="modal-header">
                    <h5 class="modal-title">受注先検索</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>

                <div class="modal-body">

 <div class="row">
        <div class="col-lg-6">
                        <h4 style="margin-bottom: 15px;margin-top: 10px;">会社マスタ</h4>
  <div style="margin-bottom: 5px;">
  <table class="table" style="border: none!important;width: auto;">
    <tbody>
      <tr>

         <td style=" border: none!important;width: 40px!important;">ｶﾅ/名称</td>
         <td style=" border: none!important;"><input type = "text" class = "form-control" id = "lastname" placeholder = "ｻﾝﾌﾟﾙ"></td>
        <td style=" border: none!important;"><button type="button" class="btn btn-info btn_search" data-toggle="modal" data-target="#" style="margin-top: 2px;" >検索

      </button></td>
      </tr>

    </tbody>
   </table>
</div>

</div>


  <div class="table_wrap">
<div class=" page4_table_design mt-2  table_hover  table-head-only">
                                        <table class="table table-striped " id="table-basic">
                                            <thead class="thead-dark header text-center" id="myHeader">
                                                <tr>

                                                    <th scope="col"style="background-color: #c2d6d6!important;color: #17252A; border-top: 1px solid #29487d!important;"> 番号</th>
                                                    <th scope="col"style="background-color: #c2d6d6!important;color: #17252A; border-top: 1px solid #29487d!important;">会社名</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                <tr class="table_hover2 gridAlternada">
                                               <!--      <td scope="row">
                                                      <div class="radio">
                                                        <label style="margin-left: 11px;margin-top: 6px;margin-bottom: 0px;"><input type="radio" name="optradio"></label>
                                                      </div>
                                                    </td> -->
                                                    <td style="width: 50px; text-align: center;">11 </td>
                                                    <td> 株式会社サンプル </td>

                                                </tr>
                                                <tr class="table_hover2 grid">

                                                    <td style="width: 50px; text-align: center;">12 </td>
                                                    <td> さんぷる運送株式会社
 </td>

                                                </tr>
                                                <tr class="table_hover2 gridAlternada ">

                                                    <td style="width: 50px; text-align: center;">13</td>
                                                    <td>サンプルマート株式会社
</td>

                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
 </div>
<!-- 2nd modal content -->


                       <h4 style="margin-bottom: 15px;margin-top: 15px;">事業所マスタ</h4>

<div style="width: 99%;">
<table class="table ">

        <thead class="thead-dark header text-center" id="myHeader">
                                                <tr>

                                                    <th scope="col"style="background-color: #c2d6d6!important;color: #17252A;border-top: 1px solid #29487d!important;"> 番号</th>
                                                    <th scope="col"style="background-color: #c2d6d6!important;color: #17252A;border-top: 1px solid #29487d!important;">事務所名</th>
                                                   <th scope="col"style="background-color: #c2d6d6!important;color: #17252A;border-top: 1px solid #29487d!important;">住所</th>
                                                </tr>
                                            </thead>
    <tbody>

   <tr>

        <td style="width:50px;text-align: center;">5</td>

      <td>本社</td>

      <td>東京都港区…</td>


      </tr>

         <tr>

        <td style="width:50px;text-align: center;">5</td>


      <td>ABC工場
</td>

      <td>千葉県船橋市…</td>


      </tr>

    </tbody>
  </table>
</div>




<!--  </div>
 </div> -->
<!-- 2nd modal content end -->

<!-- 3rd modal content  -->
   <div class="row" >
    <div class="col-lg-6">


                  <h4 style="margin-bottom: 15px; margin-top: 10px;">個人マスタ</h4>





<div style="width: 99%;">
<table class="table ">

        <thead class="thead-dark header text-center" id="myHeader">
                                                <tr>

                                                    <th scope="col"style="background-color: #c2d6d6!important;color: #17252A;border-top: 1px solid #29487d!important;"> 番号</th>
                                                    <th scope="col"style="background-color: #c2d6d6!important;color: #17252A;border-top: 1px solid #29487d!important;">氏名</th>
                                                   <th scope="col"style="background-color: #c2d6d6!important;color: #17252A;border-top: 1px solid #29487d!important;">部署</th>
                                                </tr>
                                            </thead>
    <tbody>

   <tr>

        <td style="width:50px;text-align: center;">11</td>

      <td>山田</td>

      <td>経営企画部</td>


      </tr>

         <tr>

        <td style="width:50px;text-align: center;">25</td>


      <td>佐藤</td>

      <td>営業部</td>


      </tr>

    </tbody>
  </table>
</div>
</div>
<!-- 3rd modal content end  -->

<!-- 4th modal content end  -->
    <div class="col-lg-6">
<div style="width: 99%;">



                          <table class="table table-striped " id="table-basic">

                                <tbody>

                                  <tr>
                                       <td style="width: 112px;background-color: #c2d6d6!important;border-top: 1px solid #29487d!important;">番号</td>
                                      <td style="width: 300px;border-top: 1px solid #29487d!important;"> 11</td>

                                  </tr>
                                  <tr>
                                       <td style="width: 112px;background-color: #c2d6d6!important;">部署</td>
                                      <td style="width: 300px;">経営企画部 </td>

                                  </tr>
                                 <tr>
                                       <td style="width: 112px;background-color: #c2d6d6!important;">課</td>
                                      <td style="width: 300px;">システム課 </td>

                                  </tr>
                                 <tr>
                                       <td style="width: 112px;background-color: #c2d6d6!important;">氏名</td>
                                      <td style="width: 300px;">山田太郎 </td>

                                  </tr>
                                 <tr>
                                       <td style="width: 112px;background-color: #c2d6d6!important;">メールアドレス</td>
                                      <td style="width: 300px;">sample@xxxx.co.jp</td>

                                  </tr>
                                  <tr>
                                       <td style="width: 112px;background-color: #c2d6d6!important;">電話番号</td>
                                      <td style="width: 300px;"> 000-0000-0000</td>

                                  </tr>






                                            </tbody>
                                        </table>
</div>
</div>


</div>


<!-- 4th modal content end  -->
                              <!-- modal content enddd   -->

                </div>
                <div class="modal-footer">
                     <button type="button" class="btn btn-info"  data-dismiss="modal">選択

</button>
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

$("#officeButton3").on("click", function(){
    $("#office_modal2").modal("hide");
  $('body').removeClass('modal-open');
  $('body').css('overflow-y', 'hidden');
 $('.modal-backdrop').remove();


});

</script>
 <script type="text/javascript">

$("#box_popup1").on("click", function(){
    $("#office_modal1").modal("hide");
  $('body').removeClass('modal-open');
  $('body').css('overflow-y', 'hidden');
 $('.modal-backdrop').remove();


});

</script>
 <script type="text/javascript">

$("#box_popup2").on("click", function(){
    $("#office_modal3").modal("hide");
  $('body').removeClass('modal-open');
  $('body').css('overflow-y', 'hidden');
 $('.modal-backdrop').remove();


});

</script>
</body>
</html>