@section('menu', '商品マスタ')
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="msapplication-tap-highlight" content="no">
    <title>商品マスタ</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}">
    <link href="https://use.fontawesome.com/releases/v5.0.4/css/all.css" rel="stylesheet">
    <!--    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"> -->

    <link rel="stylesheet" type="text/css" href="{{ asset('css/navbar_styles.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/login_styles.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/modal_styles.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/product_styles.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/pagination_styles.css') }}">
    <!--            <link rel="stylesheet" href="{{ asset('css/jquery.jpDatePicker.css') }}"> -->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script type="text/javascript">



    </script>


    <style>

        .hasDatepicker{
    position: relative;
  }
.ui-datepicker-trigger{

  position: absolute;
bottom: 0;
right: -17px;
top: 4px;
background-color:
#fff;


}


        /*.ui-datepicker{ z-index: 0 !important;}*/
/*.ui-datepicker{z-index: 99 !important};*/
.m_t{
  margin-top: 7px;

}
.border_none_table td {
    border: 1px solid #29487d!important;
    padding: 4px;
}
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
.modal {
  overflow: auto !important;

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


 }
.border_none_table td{
    border: 1px solid #29487d!important;
    padding: 4px;
}
.ui-datepicker {
    width: 314px!important;
    padding: .2em .2em 0;

}

.ui-datepicker td a{
    text-align: center!important;
}
.ui-datepicker td {
    border: 0;
    padding: 1px;
    width: 64px!important;
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
            <h5 href="#" class=" textfnt "style="color: #405063;border-radius: 10px;box-sizing: border-box; width: 200px; text-align: center!important;border: 2px solid #405063;margin-top: 16px;" > 商品マスタ
</h5>
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
                                        <div class="col-lg-2 col-6 col-sm-3 col-xs-6 pl-m mb-2 text-center"><a href="#" class="btn btn-info btn-m-view " data-toggle="modal" data-target="#modal-date" style="width: 100%;">一覧</a></div>
                                        <div class="col-lg-2 col-6 col-sm-3 col-xs-6  pl-m mb-2 text-center"><a href="#" class="btn btn-info btn-m-view  " style="width: 100%;" data-toggle="modal" data-target="#product_code_modal">新規登録</a></div>
                                        <!-- <div class="col-lg-2 col-6 col-sm-3 col-xs-6 padd-0 mb-2 text-center"><a href="#" class="btn btn-info btn-m-view " style="width: 100%;"data-toggle="modal" data-target="#product_code_modal2">変更</a></div> -->
                                        <!-- <div class="col-lg-2 col-6 col-sm-3 col-xs-6 pl-m mb-2 text-center"><a href="#" class="btn btn-info btn-m-view "style="width: 100%;">CSV作成</a></div> -->
                                        <div class="col-lg-2 col-sm-3 col-xs-6 col-6 pl-m mb-2 text-center "><a href="#" class="btn btn-info btn-m-view" style="width: 100%;">EXCEL作成</a></div>

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




 <script type="text/javascript">
$(document).ready(function () {


$('#datepicker4').click(function () {



  $('.modal-body').on('DOMMouseScroll mousewheel', function (e) {
 if( e.originalEvent.deltaY < 0) {
  console.log('Down');
  } else {
     console.log('Up');

 }

 return false;
 });

setTimeout(function() {
  $('.modal-body').off('mousewheel');
}, 3000);
    });

});

</script>


 <script type="text/javascript">
$(document).ready(function () {


$('#datepicker3').click(function () {



  $('.modal-body').on('DOMMouseScroll mousewheel', function (e) {
 if( e.originalEvent.deltaY < 0) {
  console.log('Down');
  } else {
     console.log('Up');

 }

 return false;
 });

setTimeout(function() {
  $('.modal-body').off('mousewheel');
}, 3000);
    });

});

</script>

 <script type="text/javascript">
$(document).ready(function () {


$('#datepicker2').click(function () {



  $('.modal-body').on('DOMMouseScroll mousewheel', function (e) {
 if( e.originalEvent.deltaY < 0) {
  console.log('Down');
  } else {
     console.log('Up');

 }

 return false;
 });

setTimeout(function() {
  $('.modal-body').off('mousewheel');
}, 3000);
    });

});

</script>
 <script type="text/javascript">
$(document).ready(function () {


$('#datepicker1').click(function () {



  $('.modal-body').on('DOMMouseScroll mousewheel', function (e) {
 if( e.originalEvent.deltaY < 0) {
  console.log('Down');
  } else {
     console.log('Up');

 }

 return false;
 });

setTimeout(function() {
  $('.modal-body').off('mousewheel');
}, 3000);
    });

});

</script>
 <script type="text/javascript">
$(document).ready(function () {


$('.fa-calendar').click(function () {



  $('.modal-body').on('DOMMouseScroll mousewheel', function (e) {
 if( e.originalEvent.deltaY < 0) {
  console.log('Down');
  } else {
     console.log('Up');

 }

 return false;
 });

setTimeout(function() {
  $('.modal-body').off('mousewheel');
}, 3000);
    });

});

</script>

                        <!-- pagination row end here -->
                        <!-- Large table row starts here -->
                        <div class="row">
                            <div class="col-lg-12">

                                <div class="table-responsive" style="padding-bottom: 10px;">
                                    <table class="table table-bordered table-striped">

                                        <thead class="thead-dark header text-center" id="myHeader">
                                            <tr>
                                                <th scope="col"></th>
                                                <th scope="col"><span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1;  color: #fff;">商品CD</span></th>
                                                <th scope="col"><span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1;  color: #fff;">商品名</span></th>
                                                <th scope="col"><span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1;  color: #fff;">品目群CD</span></th>
                                                <th scope="col"><span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1;  color: #fff;">製品区分</span></th>
                                                <th scope="col"><span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1;  color: #fff;">品目区分</span></th>
                                                <th scope="col"><span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1;  color: #fff;">販売形態</span></th>
                                                <th scope="col"><span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1;  color: #fff;">バージョン</span></th>
                                                <th scope="col"><span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1;  color: #fff;">保守区分</span></th>
                                                <th scope="col"><span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1;  color: #fff;">継続区分</span></th>
                                                <th scope="col"><span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1;  color: #fff;">新設VUP区分</span></th>
                                                <th scope="col"><span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1;  color: #fff;">商品ｻﾌﾞCD区分</span></th>
                                                <th scope="col"><span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1;  color: #fff;">商品名略称</span></th>
                                                <th scope="col"><span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1;  color: #fff;">入力区分１</span></th>
                                                <th scope="col"><span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1;  color: #fff;">仕入先CD</span></th>
                                                <th scope="col"><span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1;  color: #fff;">基本販売価格 </span></th>
                                                <th scope="col"><span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1;  color: #fff;">PB販売価格</span></th>
                                                <th scope="col"><span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1;  color: #fff;">営業粗利 </span></th>
                                                <th scope="col"><span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1;  color: #fff;">PB営業粗利</span></th>
                                                <th scope="col"><span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1;  color: #fff;">仕入価格</span></th>


                                                <th scope="col"><span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1;  color: #fff;">仕切（SE）</span></th>
                                                <th scope="col"><span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1;  color: #fff;">仕切（研究所）</span></th>
                                                <th scope="col"><span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1;  color: #fff;">仕切（出荷ｾﾝﾀｰ）</span></th>
                                                <th scope="col"><span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1;  color: #fff;">入力区分2</span></th>
                                                <th scope="col"><span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1;  color: #fff;">製品仕入品区分</span></th>
                                                <th scope="col"><span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1;  color: #fff;">商品分類1</span></th>
                                                <th scope="col"><span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1;  color: #fff;">商品分類2</span></th>
                                                <th scope="col"><span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1;  color: #fff;">商品分類3</span></th>
                                                <th scope="col"><span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1;  color: #fff;">ﾎﾞﾘｭｰﾑﾗｲｾﾝｽ区分</span></th>
                                                <th scope="col"><span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1;  color: #fff;">ﾊﾞｰｼﾞｮﾝｱｯﾌﾟ区分</span></th>
                                                <th scope="col"><span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1;  color: #fff;">上市開始日</span></th>
                                                <th scope="col"><span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1;  color: #fff;">終売日</span></th>
                                                <th scope="col"><span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1;  color: #fff;">最新バージョン区分</span></th>
                                                <th scope="col"><span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1;  color: #fff;">前受請求区分</span></th>
                                                <th scope="col"><span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1;  color: #fff;">税区分</span></th>
                                                <th scope="col"><span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1;  color: #fff;">売上計上区分 </span></th>
                                                <th scope="col"><span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1;  color: #fff;">サービス内容</span></th>
                                                <th scope="col"><span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1;  color: #fff;">成果物</span></th>
                                                <th scope="col"><span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1;  color: #fff;">工数目安</span></th>
                                                <th scope="col"><span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1;  color: #fff;">サービス内容（社内備考）</span></th>
                                                <th scope="col"><span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1;  color: #fff;">保守作成区分</span></th>
                                                <th scope="col"><span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1;  color: #fff;">得意先限定商品</span></th>
                                                <th scope="col"><span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1;  color: #fff;">保守商品ＣＤ</span></th>
                                                <th scope="col"><span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1;  color: #fff;">メーカー品番</span></th>
                                                <th scope="col"><span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1;  color: #fff;">メーカー品名</span></th>
                                                <th scope="col"><span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1;  color: #fff;">価格設定区分</span></th>
                                                <th scope="col"><span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1;  color: #fff;">保守会社CD</span></th>
                                                <th scope="col"><span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1;  color: #fff;">登録年月日</span></th>
                                                <th scope="col"><span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1;  color: #fff;">登録時刻</span></th>
                                                <th scope="col"><span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1;  color: #fff;">更新年月日</span></th>
                                                <th scope="col"><span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1;  color: #fff;">更新時刻</span></th>
                                                <th scope="col"><span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1;  color: #fff;">更新時端末IP</span></th>
                                                <th scope="col"><span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1;  color: #fff;">更新者</span></th>

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

                                                    <a href="#" class="btn btn-info btn-m-view " style="width: 100%;" data-toggle="modal" data-target="#product_code_modal2"><i class="fa fa-folder-open" aria-hidden="true" style="margin-right: 5px;"></i>詳細
                                                    </a>
                                                </td>

                                                <td>00335</td>
                                                <td>Ａｕｔｏメール名人 基本パッケージ．開発版 1年ﾗｲｾﾝｽ 6.0.0</td>
                                                <td>Autoﾒｰﾙ名人V0600.1LS</td>
                                                <td>03　Autoメール名人</td>
                                                <td>01　製品 </td>
                                                <td>01　基本ﾊﾟｯｹｰｼﾞ．開発版</td>
                                                <td>1　1年ﾗｲｾﾝｽ</td>
                                                <td>0600 6.0.0</td>
                                                <td></td>
                                                <td>1 新規ﾗｲｾﾝｽ</td>
                                                <td>1 新規</td>
                                                <td></td>
                                                <td></td>
                                                <td>1　入力可</td>
                                                <td>140,000</td>
                                                <td>100,000</td>
                                                <td>99,999,999</td>
                                                <td>99,999,999</td>
                                                <td>000001　㈱AAA</td>
                                                <td>99,999,999</td>
                                                <td>99,999,999</td>
                                                <td>99,999,999</td>
                                                <td>99,999,999</td>
                                                <td>1 入力可</td>
                                                <td>1 自社品(AM名人)　</td>
                                                <td>01 自社製品</td>
                                                <td>01 RPA</td>
                                                <td>製品</td>
                                                <td>1 ﾎﾞﾘｭｰﾑﾗﾝｾﾝｽﾊﾟﾀｰﾝ①を適用可</td>
                                                <td>1 ﾒｼﾞｬｰ50%</td>
                                                <td>1 通常</td>
                                                <td>10%</td>
                                                <td>1 可</td>
                                                <td></td>
                                                <td></td>
                                                <td>0.5</td>
                                                <td>開発機能含む標準システム</td>
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
                                                    <a href="#" class="btn btn-info btn-m-view " style="width: 100%;" data-toggle="modal" data-target="#product_code_modal2"><i class="fa fa-folder-open" aria-hidden="true" style="margin-right: 5px;"></i>詳細
                                                    </a>
                                                </td>

                                                <td>00336</td>
                                                <td>Ａｕｔｏメール名人 基本パッケージ．開発版 1年ﾗｲｾﾝｽ 6.0.0</td>
                                                <td>Autoﾒｰﾙ名人V0600.1LS</td>
                                                <td>03　Autoメール名人</td>
                                                <td>01　製品 </td>
                                                <td>01　基本ﾊﾟｯｹｰｼﾞ．開発版</td>
                                                <td>3　買取ﾗｲｾﾝｽ</td>
                                                <td>0600 6.0.0</td>
                                                <td></td>
                                                <td>1 新規ﾗｲｾﾝｽ</td>
                                                <td>1 新規</td>
                                                <td>2　有</td>
                                                <td></td>
                                                <td>0　マスタ牽引</td>
                                                <td>630,000</td>
                                                <td>600,000</td>
                                                <td>99,999,999</td>
                                                <td>99,999,999</td>
                                                <td>000001　㈱AAA</td>
                                                <td>99,999,999</td>
                                                <td>99,999,999</td>
                                                <td>99,999,999</td>
                                                <td>99,999,999</td>
                                                <td>0 マスタ牽引</td>
                                                <td>3 仕入品(SKYLINK)　</td>
                                                <td>03 仕入製品</td>
                                                <td>02 帳票</td>
                                                <td>製品</td>
                                                <td>1 ﾎﾞﾘｭｰﾑﾗﾝｾﾝｽﾊﾟﾀｰﾝ①を適用可</td>
                                                <td>2 ﾏｲﾅｰ無償</td>
                                                <td>2 前受</td>
                                                <td>10%</td>
                                                <td>1 可</td>
                                                <td></td>
                                                <td></td>
                                                <td>1.0</td>
                                                <td>開発機能含む標準システム</td>
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
                                                    <a href="#" class="btn btn-info btn-m-view " style="width: 100%;" data-toggle="modal" data-target="#product_code_modal2"><i class="fa fa-folder-open" aria-hidden="true" style="margin-right: 5px;"></i>詳細
                                                    </a>
                                                </td>

                                                <td>00337</td>
                                                <td>Ａｕｔｏメール名人 基本パッケージ．開発版 買取 6.0.0</td>
                                                <td>Autoﾒｰﾙ名人V0600.1LS</td>
                                                <td>03　Autoメール名人</td>
                                                <td>01　製品 </td>
                                                <td>01　基本ﾊﾟｯｹｰｼﾞ．開発版</td>
                                                <td>2　5年ﾗｲｾﾝｽ</td>
                                                <td>0600 6.0.0</td>
                                                <td></td>
                                                <td>2 継続ﾗｲｾﾝｽ</td>
                                                <td>2 ﾊﾞｰｼﾞｮﾝｱｯﾌﾟ</td>
                                                <td></td>
                                                <td></td>
                                                <td>0　マスタ牽引</td>
                                                <td>630,000</td>
                                                <td>600,000</td>
                                                <td>99,999,999</td>
                                                <td>99,999,999</td>
                                                <td>000002　あいうえ㈱</td>
                                                <td>99,999,999</td>
                                                <td>99,999,999</td>
                                                <td>99,999,999</td>
                                                <td>99,999,999</td>
                                                <td>0 マスタ牽引</td>
                                                <td>1 自社品(AM名人)　</td>
                                                <td>02 仕入製品</td>
                                                <td>03 EDI</td>
                                                <td>役務</td>
                                                <td>1 ﾎﾞﾘｭｰﾑﾗﾝｾﾝｽﾊﾟﾀｰﾝ①を適用可</td>
                                                <td>1 ﾒｼﾞｬｰ50%</td>
                                                <td>1 前受</td>
                                                <td>10%</td>
                                                <td>1 可</td>
                                                <td></td>
                                                <td></td>
                                                <td>0.5</td>
                                                <td>開発機能含む標準システム</td>
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
                                                    <a href="#" class="btn btn-info btn-m-view " style="width: 100%;" data-toggle="modal" data-target="#product_code_modal2"><i class="fa fa-folder-open" aria-hidden="true" style="margin-right: 5px;"></i>詳細
                                                    </a>
                                                </td>

                                                <td>00338</td>
                                                <td>Ａｕｔｏメール名人 基本パッケージ．開発版　サポートパック 1年ﾗｲｾﾝｽ 6.0.0</td>
                                                <td>Autoﾒｰﾙ名人V0600.1LS</td>
                                                <td>03　Autoメール名人.1LS</td>
                                                <td>01　製品</td>
                                                <td>02　基本ﾊﾟｯｹｰｼﾞ．開発版　ｻﾎﾟｰﾄﾊﾟｯｸ </td>
                                                <td>1　1年ﾗｲｾﾝｽ</td>
                                                <td>0600 6.0.0</td>
                                                <td>2 保守</td>
                                                <td>1 新規ﾗｲｾﾝｽ</td>
                                                <td>1 新規</td>
                                                <td></td>
                                                <td></td>
                                                <td>1　入力可</td>
                                                <td>140,000</td>
                                                <td>100,000</td>
                                                <td>99,999,999</td>
                                                <td>99,999,999</td>
                                                <td>000001　㈱AAA</td>
                                                <td>99,999,999</td>
                                                <td>99,999,999</td>
                                                <td>99,999,999</td>
                                                <td>99,999,999</td>
                                                <td>1 入力可</td>
                                                <td>1 自社品(AM名人)　</td>
                                                <td>01 自社製品</td>
                                                <td>01 RPA</td>
                                                <td>製品</td>
                                                <td>1 ﾎﾞﾘｭｰﾑﾗﾝｾﾝｽﾊﾟﾀｰﾝ①を適用可</td>
                                                <td>1 ﾒｼﾞｬｰ50%</td>
                                                <td>1 通常</td>
                                                <td>10%</td>
                                                <td>1 可</td>
                                                <td></td>
                                                <td></td>
                                                <td>0.5</td>
                                                <td>開発機能含む標準システムに1回訪問指導を含む</td>
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
    <!--    </div>-->


    <!-- Modal 1 start here -->


    <!-- <div class="modal fade" id="product_code_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
 -->






    <div class="modal fade"data-keyboard="false" data-backdrop="static"  id="product_code_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" style="max-width: 950px;" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">商品マスタ(登録)</h5>
                    <button type="button" class="close" >
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="development_page_top_table heading_mt" style="margin:0 2px;">

                        <!--======================= button start ======================-->

                        <div class="row titlebr" style="margin-bottom: 15px;">
                            <div class="col-6">


                            </div>
                            <div class="col-6">
                                <table class="dev_tble_button" style="float: right;">
                                    <tbody>
                                        <tr class="marge_in">
                                            <td class="" style="padding-left: 0px!important;width: 70px!important;">
                                                <div>新規 (処理状況)

                                                </div>
                                            </td>

                                        </tr>
                                    </tbody>
                                </table>

                            </div>

                        </div>

                        <!--======================= button wrapper end ======================-->
                    </div>

                    <div class="row mt-1 mb-3">


                        <div class="col-lg-8">


                            <div class="tbl_emp1">
                                <div class="w-100">


                                    <div class=" row row_data">
                                        <div class="col-lg-3">
                                            <div class="margin_t ">
                                                <span>商品CD <span style="color: red;">※</span></span>
                                            </div>


                                        </div>
                                        <div class="col-lg-9">

                                            <div class="outer row">
                                                <div class="col-lg-12 ">
                                                    <div class="">
                                                        <input type="text" class="form-control" value="">
                                                    </div>

                                                </div>

                                            </div>

                                        </div>

                                    </div>


                                    <div class=" row row_data">
                                        <div class="col-lg-3">
                                            <div class="margin_t ">
                                                <span>商品名</span>
                                            </div>


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
                                            <div class="margin_t ">
                                                <span>略称</span>
                                            </div>


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
                                            <div class="margin_t ">
                                                <span>品目群</span>
                                            </div>


                                        </div>
                                        <div class="col-lg-9">

                                            <div class="outer row">
                                                <div class="col-lg-12 ">
                                                    <select class="form-control" id="">
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
                                                <span>製品区分</span>
                                            </div>


                                        </div>
                                        <div class="col-lg-9">

                                            <div class="outer row">
                                                <div class="col-lg-12 ">
                                                    <select class="form-control" id="">
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
                                                <span>品目区分</span>
                                            </div>


                                        </div>
                                        <div class="col-lg-9">

                                            <div class="outer row">
                                                <div class="col-lg-12 ">
                                                    <select class="form-control" id="">
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
                                                <span>販売形態</span>
                                            </div>


                                        </div>
                                        <div class="col-lg-9">

                                            <div class="outer row">
                                                <div class="col-lg-12 ">
                                                    <select class="form-control" id="">
                                                        <option>1 1年ﾗｲｾﾝｽ</option>
                                                        <option>2 5年ﾗｲｾﾝｽ</option>
                                                        <option>3 買取ﾗｲｾﾝｽ</option>
                                                    </select>
                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                    <div class=" row row_data">
                                        <div class="col-lg-3">
                                            <div class="margin_t ">
                                                <span>バージョン</span>
                                            </div>


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
                                            <div class="margin_t ">
                                                <span>保守区分</span>
                                            </div>


                                        </div>
                                        <div class="col-lg-9">

                                            <div class="outer row">
                                                <div class="col-lg-12 ">
                                                    <select class="form-control" id="">
                                                        <option>1 NULL</option>
                                                        <option>2 保守</option>

                                                    </select>
                                                </div>

                                            </div>

                                        </div>

                                    </div>
                                    <div class=" row row_data">
                                        <div class="col-lg-3">
                                            <div class="margin_t ">
                                                <span>継続区分</span>
                                            </div>


                                        </div>
                                        <div class="col-lg-9">

                                            <div class="outer row">
                                                <div class="col-lg-12 ">
                                                    <select class="form-control" id="">
                                                        <option>1 新規ﾗｲｾﾝｽ</option>
                                                        <option>2 継続ﾗｲｾﾝｽ</option>

                                                    </select>
                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                    <div class=" row row_data">
                                        <div class="col-lg-3">
                                            <div class="margin_t ">
                                                <span>新規VUP区分</span>
                                            </div>


                                        </div>
                                        <div class="col-lg-9">

                                            <div class="outer row">
                                                <div class="col-lg-12 ">
                                                    <select class="form-control" id="">
                                                        <option>1 新規</option>
                                                        <option>2 バージョンアップ</option>

                                                    </select>
                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                    <div class=" row row_data">
                                        <div class="col-lg-3">
                                            <div class="margin_t ">
                                                <span>商品サブCD区分</span>
                                            </div>


                                        </div>
                                        <div class="col-lg-9">

                                            <div class="outer row">
                                                <div class="col-lg-12 ">
                                                    <select class="form-control" id="">
                                                        <option>0 無</option>
                                                        <option>1 運送店</option>
                                                        <option>2 小売店</option>
                                                    </select>
                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                    <div class=" row row_data">
                                        <div class="col-lg-3">
                                            <div class="margin_t ">
                                                <span>入力区分１(商品名等)</span>
                                            </div>


                                        </div>
                                        <div class="col-lg-9">

                                            <div class="outer row">
                                                <div class="col-lg-12 ">
                                                    <select class="form-control" id="">
                                                        <option>0 マスタ索引</option>
                                                        <option>1 入力可</option>

                                                    </select>
                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                    <div class=" row row_data">
                                        <div class="col-lg-3">
                                            <div class="margin_t ">
                                                <span>仕入先</span>
                                            </div>


                                        </div>
                                        <div class="col-lg-9">

                                            <div class="outer row">
                                                <div class="col-lg-4 ">
                                                    <select class="form-control" id="">
                                                        <option></option>
                                                        <option></option>

                                                    </select>
                                                </div>
                                                <div class="col-lg-8 ">
                                                    <div></div>
                                                </div>
                                            </div>

                                        </div>

                                    </div>


                                    <!-- end row data -->

                                </div>

                            </div>
                        </div>





                    </div>
                    <div class="row mt-1 mb-3">
                        <div class="col-lg-4">
                            <div class="tbl_product w-100">

                                <div class=" row row_data">
                                    <div class="col-lg-4">
                                        <div class="margin_t ">
                                            <span>基本販売価格</span>
                                        </div>


                                    </div>
                                    <div class="col-lg-8">

                                        <div class="outer row">
                                            <div class="col-lg-12 ">
                                                <input type="text" class="form-control" value="">
                                            </div>

                                        </div>

                                    </div>

                                </div>

                                <div class=" row row_data">
                                    <div class="col-lg-4">
                                        <div class="margin_t ">
                                            <span>PB販売価格</span>
                                        </div>


                                    </div>
                                    <div class="col-lg-8">

                                        <div class="outer row">
                                            <div class="col-lg-12 ">
                                                <input type="text" class="form-control" value="">
                                            </div>

                                        </div>

                                    </div>

                                </div>

                                <div class=" row row_data">
                                    <div class="col-lg-4">
                                        <div class="margin_t ">
                                            <span>営業粗利</span>
                                        </div>


                                    </div>
                                    <div class="col-lg-8">

                                        <div class="outer row">
                                            <div class="col-lg-12 ">
                                                <input type="text" class="form-control" value="">
                                            </div>

                                        </div>

                                    </div>

                                </div>

                                <div class=" row row_data">
                                    <div class="col-lg-4">
                                        <div class="margin_t ">
                                            <span>PB営業粗利</span>
                                        </div>


                                    </div>
                                    <div class="col-lg-8">

                                        <div class="outer row">
                                            <div class="col-lg-12 ">
                                                <input type="text" class="form-control" value="">
                                            </div>

                                        </div>

                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="tbl_product w-100">

                                <div class=" row row_data">
                                    <div class="col-lg-4">
                                        <div class="margin_t ">
                                            <span>仕入価格</span>
                                        </div>


                                    </div>
                                    <div class="col-lg-8">

                                        <div class="outer row">
                                            <div class="col-lg-12 ">
                                                <input type="text" class="form-control" value="">
                                            </div>

                                        </div>

                                    </div>

                                </div>


                                <div class=" row row_data">
                                    <div class="col-lg-4">
                                        <div class="margin_t ">
                                            <span>仕切(SE)</span>
                                        </div>


                                    </div>
                                    <div class="col-lg-8">

                                        <div class="outer row">
                                            <div class="col-lg-12 ">
                                                <input type="text" class="form-control" value="">
                                            </div>

                                        </div>

                                    </div>

                                </div>



                                <div class=" row row_data">
                                    <div class="col-lg-4">
                                        <div class="margin_t ">
                                            <span>仕切(研究所)</span>
                                        </div>


                                    </div>
                                    <div class="col-lg-8">

                                        <div class="outer row">
                                            <div class="col-lg-12 ">
                                                <input type="text" class="form-control" value="">
                                            </div>

                                        </div>

                                    </div>

                                </div>

                                <div class=" row row_data">
                                    <div class="col-lg-4">
                                        <div class="margin_t ">
                                            <span>仕切(出荷ｾﾝﾀｰ)</span>
                                        </div>


                                    </div>
                                    <div class="col-lg-8">

                                        <div class="outer row">
                                            <div class="col-lg-12 ">
                                                <input type="text" class="form-control" value="">
                                            </div>

                                        </div>

                                    </div>

                                </div>



                            </div>
                        </div>



                        <div class="col-lg-4">
                            <div class="tbl_product w-100">



                                <div class=" row row_data" style="margin-top: 90px;">
                                    <div class="col-lg-4">
                                        <div class="margin_t ">
                                            <span>価格設定区分</span>
                                        </div>


                                    </div>
                                    <div class="col-lg-8">

                                        <div class="outer row">
                                            <div class="col-lg-12 ">
                                                <select class="form-control" id="">
                                                    <option>0 定価</option>
                                                    <option>1 OPEN価格</option>

                                                </select>
                                            </div>

                                        </div>

                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-1 mb-3">
                        <div class="col-lg-12">
                            <div class="tbl_product w-100">
                                <div class=" row row_data">
                                    <div class="col-lg-3">
                                        <div class="margin_t ">
                                            <span>入力区分２(単価等)</span>
                                        </div>


                                    </div>
                                    <div class="col-lg-5">

                                        <div class="outer row">
                                            <div class="col-lg-12 ">
                                                <select class="form-control" id="">
                                                    <option>0 マスタ索引</option>
                                                    <option></option>

                                                </select>
                                            </div>

                                        </div>

                                    </div>

                                </div>
                                <div class=" row row_data">
                                    <div class="col-lg-3">
                                        <div class="margin_t ">
                                            <span>上市開始日</span>
                                        </div>


                                    </div>
                                    <div class="col-lg-5">

                                        <div class="outer row">
                                        <div class="col-lg-10 ">

            <input type="text" name='datepicker' class="form-control" value="" id="datepicker1" placeholder="">

            </div>
                                     <!--        <div class="col-lg-2 "> <span class=" m_t fa fa-calendar"></span></div> -->


                                        </div>

                                    </div>

                                </div>
                                <div class=" row row_data">
                                    <div class="col-lg-3">
                                        <div class="margin_t ">
                                            <span>終売日</span>
                                        </div>


                                    </div>
                                    <div class="col-lg-5">

                                        <div class="outer row">
                                        <div class="col-lg-10 ">

            <input type="text" name='datepicker' class="form-control" value="" id="datepicker2" placeholder="">

            </div>
                                       <!--      <div class="col-lg-2 "> <span class=" m_t fa fa-calendar"></span></div> -->


                                        </div>

                                    </div>

                                </div>

                                <div class=" row row_data">
                                    <div class="col-lg-3">
                                        <div class="margin_t ">
                                            <span>製品仕入品区分
                                            </span>
                                        </div>


                                    </div>
                                    <div class="col-lg-5">

                                        <div class="outer row">
                                            <div class="col-lg-12 ">
                                                <select class="form-control" id="">
                                                    <option>C7の分類名を表示</option>


                                                </select>
                                            </div>

                                        </div>

                                    </div>

                                </div>



                                <div class=" row row_data">
                                    <div class="col-lg-3">
                                        <div class="margin_t ">
                                            <span>商品分類１

                                            </span>
                                        </div>


                                    </div>
                                    <div class="col-lg-5">

                                        <div class="outer row">
                                            <div class="col-lg-12 ">
                                                <select class="form-control" id="">
                                                    <option>C8の分類名を表示</option>


                                                </select>
                                            </div>

                                        </div>

                                    </div>

                                </div>
                                <div class=" row row_data">
                                    <div class="col-lg-3">
                                        <div class="margin_t ">
                                            <span>商品分類2

                                            </span>
                                        </div>


                                    </div>
                                    <div class="col-lg-5">

                                        <div class="outer row">
                                            <div class="col-lg-12 ">
                                                <select class="form-control" id="">
                                                    <option>C9の分類名を表示</option>


                                                </select>
                                            </div>

                                        </div>

                                    </div>

                                </div>


                                <div class=" row row_data">
                                    <div class="col-lg-3">
                                        <div class="margin_t ">
                                            <span>商品分類3

                                            </span>
                                        </div>


                                    </div>
                                    <div class="col-lg-5">

                                        <div class="outer row">
                                            <div class="col-lg-12 ">
                                                <select class="form-control" id="">
                                                    <option>D1の分類名を表示</option>


                                                </select>
                                            </div>

                                        </div>

                                    </div>

                                </div>
                                <div class=" row row_data">
                                    <div class="col-lg-3">
                                        <div class="margin_t ">
                                            <span>ﾎﾞﾘｭｰﾑﾗｲｾﾝｽ区分


                                            </span>
                                        </div>


                                    </div>
                                    <div class="col-lg-5">

                                        <div class="outer row">
                                            <div class="col-lg-12 ">
                                                <select class="form-control" id="">
                                                    <option>1 ﾎﾞﾘｭｰﾑﾗｲｾﾝｽﾊﾟﾀｰﾝ①

                                                    </option>
                                                    <option>2 ﾎﾞﾘｭｰﾑﾗｲｾﾝｽﾊﾟﾀｰﾝ②</option>

                                                </select>
                                            </div>

                                        </div>

                                    </div>

                                </div>


                                <div class=" row row_data">
                                    <div class="col-lg-3">
                                        <div class="margin_t ">
                                            <span>ﾊﾞｰｼﾞｮﾝｱｯﾌﾟ区分



                                            </span>
                                        </div>


                                    </div>
                                    <div class="col-lg-5">

                                        <div class="outer row">
                                            <div class="col-lg-12 ">
                                                <select class="form-control" id="">
                                                    <option>1 ﾒｼﾞｬｰ50％


                                                    </option>
                                                    <option>2 ﾏｲﾅｰ無償</option>

                                                </select>
                                            </div>

                                        </div>

                                    </div>

                                </div>


                                <div class=" row row_data">
                                    <div class="col-lg-3">
                                        <div class="margin_t ">
                                            <span>最新ﾊﾞｰｼﾞｮﾝ区分</span>
                                        </div>

                                    </div>
                                    <div class="col-lg-5">

                                        <div class="outer row">
                                            <div class="col-lg-12 ">
                                                <select class="form-control" id="">
                                                    <option>1 最新</option>
                                                    <option>2 製品販売/旧バージョン</option>
                                                    <option>3 製品保守終了/ｻﾎﾟ有</option>
                                                </select>
                                            </div>

                                        </div>

                                    </div>

                                </div>
                                <div class=" row row_data">
                                    <div class="col-lg-3">
                                        <div class="margin_t ">
                                            <span>前受請求区分</span>
                                        </div>

                                    </div>
                                    <div class="col-lg-5">

                                        <div class="outer row">
                                            <div class="col-lg-12 ">
                                                <select class="form-control" id="">
                                                    <option>1 通常</option>
                                                    <option>2 前受</option>

                                                </select>
                                            </div>

                                        </div>

                                    </div>

                                </div>




                                <div class=" row row_data">
                                    <div class="col-lg-3">
                                        <div class="margin_t ">
                                            <span>税区分</span>
                                        </div>

                                    </div>
                                    <div class="col-lg-5">

                                        <div class="outer row">
                                            <div class="col-lg-12 ">
                                                <select class="form-control" id="">
                                                    <option>1 通常1 10%</option>
                                                    <option>2 旧8%</option>

                                                </select>
                                            </div>

                                        </div>

                                    </div>

                                </div>


                                <div class=" row row_data">
                                    <div class="col-lg-3">
                                        <div class="margin_t ">
                                            <span>売上計上区分</span>
                                        </div>

                                    </div>
                                    <div class="col-lg-9">

                                        <div class="outer row">
                                            <div class="col-lg-7">
                                                <select class="form-control" id="" style="
    width: 95%;
">
                                                    <option>1 可</option>
                                                    <option>2 不可</option>

                                                </select>
                                            </div>
                                            <div class="col-lg-2">

                                                <div class="m_t text-right">
                                                    保守作成区分</div>




                                            </div>
                                            <div class="col-lg-3 ">
                                                <select class="form-control" id="">
                                                    <option>1 無し</option>
                                                    <option> 2 作る</option>


                                                </select>
                                            </div>
                                        </div>

                                    </div>

                                </div>

                            </div>
                        </div>





                    </div>

                    <div class="row mt-1 mb-3">
                        <div class="col-lg-8">
                            <div class="tbl_product w-100">

                                <div class=" row row_data">
                                    <div class="col-lg-3">
                                        <div class="margin_t ">
                                            <span>得意先限定商品</span>
                                        </div>


                                    </div>
                                    <div class="col-lg-9">

                                        <div class="outer row">
                                            <div class="col-lg-4 ">
                                                <input type="text" class="form-control" value="">
                                            </div>
                                            <div class="col-lg-8 ">

                                            </div>
                                        </div>

                                    </div>

                                </div>

                                <div class=" row row_data">
                                    <div class="col-lg-3">
                                        <div class="margin_t ">
                                            <span>保守商品CD</span>
                                        </div>


                                    </div>
                                    <div class="col-lg-9">

                                        <div class="outer row">
                                            <div class="col-lg-4 ">
                                                <select class="form-control" id="">
                                                    <option>1 可





                                                    </option>
                                                    <option></option>

                                                </select>
                                            </div>
                                            <div class="col-lg-8 ">

                                            </div>
                                        </div>

                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>


                    <div class="row mt-1 mb-3">
                        <div class="col-lg-8">
                            <div class="tbl_product w-100">
                                <div class=" row row_data">
                                    <div class="col-lg-3">
                                        <div class="margin_t " style="
    margin-top: 28px;
">
                                            <span>サービス内容</span>
                                        </div>


                                    </div>
                                    <div class="col-lg-9">

                                        <div class="outer row">
                                            <div class="col-lg-12 ">
                                                <div class="form-group">

                                                    <textarea class="form-control" rows="5" id="" style="height: 62px;"></textarea>
                                                </div>
                                            </div>

                                        </div>

                                    </div>

                                </div>
                                <div class=" row row_data">
                                    <div class="col-lg-3">
                                        <div class="margin_t ">
                                            <span>成果物</span>
                                        </div>


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
                                        <div class="margin_t " style="
    margin-top: 28px;
">
                                            <span>工数目安</span>
                                        </div>


                                    </div>
                                    <div class="col-lg-9">

                                        <div class="outer row">
                                            <div class="col-lg-12 ">
                                                <div class="form-group">

                                                    <textarea class="form-control" rows="5" id="" style="height: 62px;"></textarea>
                                                </div>
                                            </div>

                                        </div>

                                    </div>

                                </div>

                                <div class=" row row_data">
                                    <div class="col-lg-3">
                                        <div class="margin_t " style="
    margin-top: 54px;
">
                                            <span>サービス内容<br />
                                                （社内備考)</span>
                                        </div>


                                    </div>
                                    <div class="col-lg-9">

                                        <div class="outer row">
                                            <div class="col-lg-12 ">
                                                <div class="form-group">

                                                    <textarea class="form-control" rows="5" id="" style="height: 115px;"></textarea>
                                                </div>
                                            </div>

                                        </div>

                                    </div>

                                </div>



                                <div class=" row row_data">
                                    <div class="col-lg-3">
                                        <div class="margin_t ">
                                            <span>メーカー品番</span>
                                        </div>


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
                                        <div class="margin_t " style="
    margin-top: 28px;
">
                                            <span>メーカー品名</span>
                                        </div>


                                    </div>
                                    <div class="col-lg-9">

                                        <div class="outer row">
                                            <div class="col-lg-12 ">
                                                <div class="form-group">

                                                    <textarea class="form-control" rows="5" id="" style="height: 62px;"></textarea>
                                                </div>
                                            </div>

                                        </div>

                                    </div>

                                </div>

                                <div class=" row row_data">
                                    <div class="col-lg-3">
                                        <div class="margin_t ">
                                            <span>保守会社</span>
                                        </div>


                                    </div>
                                    <div class="col-lg-9">

                                        <div class="outer row">
                                            <div class="col-lg-4 ">
                                                <select class="form-control" id="">
                                                    <option></option>
                                                    <option></option>

                                                </select>
                                            </div>
                                            <div class="col-lg-8 ">
                                                <div></div>
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
    <!-- moda1 1 finish -->

    <!-- moda1 2 start here -->

    <div class="modal fade" id="product_code_modal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" style="max-width: 950px;" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">商品マスタ(詳細)</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row titlebr" style="margin-bottom: 15px;">

                        <div class="col-6">



                        </div>
                        <div class="col-6">
                            <div>
                                <table class="dev_tble_button" style="float: right;">
                                    <tbody>
                                        <tr class="marge_in">

                                          <td class="" style="padding-right: 7px!important;">

             <a class="btn btn-info scroll" style="background-color: #3e6ec1!important;" data-toggle="modal" data-target="#"><i class="fa fa-trash" style="margin-right: 7px;">
        </i>削除
</a>


           </td>
                                            <td class="" style="padding-left: 0px!important;width: 70px!important;">
                                                <a href="#" class="btn btn-info " id="productButton3" style="width: 100%;" data-toggle="modal" data-target="#product_code_modal3"><i class="fa fa-pencil-square-o" aria-hidden="true" style="margin-right: 5px;"></i>変更画面へ</a>
                                            </td>
                                            <td class="" style="padding-left:6px!important;">
                                                <a class="btn btn-info scroll" style=""><i class="fa fa-print" aria-hidden="true" style="margin-right: 5px;"></i>印刷</a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                        </div>

                    </div>

                    <div class="row mt-1 mb-3">


                        <div class="col-lg-8">


                            <div class="tbl_emp1">
                                <div class="w-100">


                                    <div class=" row row_data">
                                        <div class="col-lg-3">
                                            <div class="margin_t ">
                                                <span>商品CD <span style="color: red;">※</span></span>
                                            </div>


                                        </div>
                                        <div class="col-lg-9">

                                            <div class="outer row">
                                                <div class="col-lg-12 ">
                                                    <div class="m_t">
                                                        00335
                                                    </div>

                                                </div>

                                            </div>

                                        </div>

                                    </div>


                                    <div class=" row row_data">
                                        <div class="col-lg-3">
                                            <div class="margin_t ">
                                                <span>商品名</span>
                                            </div>


                                        </div>
                                        <div class="col-lg-9">

                                            <div class="outer row">
                                                <div class="col-lg-12 ">
                                                    <div class="m_t">
                                                        Autoメール名人 基本パッケージ.開発版 1年ﾗｲｾﾝｽ 6.0.0
                                                    </div>
                                                </div>

                                            </div>

                                        </div>

                                    </div>
                                    <div class=" row row_data">
                                        <div class="col-lg-3">
                                            <div class="margin_t ">
                                                <span>略称</span>
                                            </div>


                                        </div>
                                        <div class="col-lg-9">

                                            <div class="outer row">
                                                <div class="col-lg-12 ">
                                                    <div class="m_t">Autoﾒｰﾙ名人 V0600.1LS</div>
                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                    <div class=" row row_data">
                                        <div class="col-lg-3">
                                            <div class="margin_t ">
                                                <span>品目群</span>
                                            </div>


                                        </div>
                                        <div class="col-lg-9">

                                            <div class="outer row">
                                                <div class="col-lg-12 ">
                                                    <div class="m_t">03 Autoメール名人</div>
                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                    <div class=" row row_data">
                                        <div class="col-lg-3">
                                            <div class="margin_t ">
                                                <span>製品区分</span>
                                            </div>


                                        </div>
                                        <div class="col-lg-9">

                                            <div class="outer row">
                                                <div class="col-lg-12 ">

                                                    <div class="m_t">01 製品</div>
                                                </div>

                                            </div>

                                        </div>

                                    </div>
                                    <div class=" row row_data">
                                        <div class="col-lg-3">
                                            <div class="margin_t ">
                                                <span>品目区分</span>
                                            </div>


                                        </div>
                                        <div class="col-lg-9">

                                            <div class="outer row">
                                                <div class="col-lg-12 ">

                                                    <div class="m_t">03 Autoメール名人 </div>

                                                </div>

                                            </div>

                                        </div>
                                    </div>
                                    <div class=" row row_data">
                                        <div class="col-lg-3">
                                            <div class="margin_t ">
                                                <span>販売形態</span>
                                            </div>


                                        </div>
                                        <div class="col-lg-9">

                                            <div class="outer row">
                                                <div class="col-lg-12 ">

                                                    <div class="m_t">1 1年ﾗｲｾﾝｽ</div>
                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                    <div class=" row row_data">
                                        <div class="col-lg-3">
                                            <div class="margin_t ">
                                                <span>バージョン</span>
                                            </div>


                                        </div>
                                        <div class="col-lg-9">

                                            <div class="outer row">
                                                <div class="col-lg-12 ">
                                                    <div class="m_t">6.0.0</div>
                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                    <div class=" row row_data">
                                        <div class="col-lg-3">
                                            <div class="margin_t ">
                                                <span>保守区分</span>
                                            </div>


                                        </div>
                                        <div class="col-lg-9">

                                            <div class="outer row">
                                                <div class="col-lg-12 ">
                                                    <div class="m_t">1 NULL</div>
                                                </div>

                                            </div>

                                        </div>

                                    </div>
                                    <div class=" row row_data">
                                        <div class="col-lg-3">
                                            <div class="margin_t ">
                                                <span>継続区分</span>
                                            </div>


                                        </div>
                                        <div class="col-lg-9">

                                            <div class="outer row">
                                                <div class="col-lg-12 ">
                                                    <div class="m_t">1 NULL</div>
                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                    <div class=" row row_data">
                                        <div class="col-lg-3">
                                            <div class="margin_t ">
                                                <span>新規VUP区分</span>
                                            </div>


                                        </div>

                                        <div class="col-lg-9">

                                            <div class="outer row">
                                                <div class="col-lg-12 ">

                                                    <div class="m_t">1 NULL</div>

                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                    <div class=" row row_data">
                                        <div class="col-lg-3">
                                            <div class="margin_t ">
                                                <span>商品サブCD区分</span>
                                            </div>


                                        </div>
                                        <div class="col-lg-9">

                                            <div class="outer row">
                                                <div class="col-lg-12 ">

                                                    <div class="m_t">1 有 000001</div>
                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                    <div class=" row row_data">
                                        <div class="col-lg-3">
                                            <div class="margin_t ">
                                                <span>入力区分１(商品名等)</span>
                                            </div>


                                        </div>

                                        <div class="col-lg-9">

                                            <div class="outer row">
                                                <div class="col-lg-12 ">
                                                    <div class="m_t"> 1 入力可</div>

                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                    <div class=" row row_data">
                                        <div class="col-lg-3">
                                            <div class="margin_t ">
                                                <span>仕入先</span>
                                            </div>


                                        </div>
                                        <div class="col-lg-9">

                                            <div class="outer row">
                                                <div class="col-lg-4 ">


                                                    <div class="m_t"> 000001</div>
                                                </div>
                                                <div class="col-lg-8 ">
                                                    <div>(株)AAA
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                    </div>


                                    <!-- end row data -->



                                </div>

                            </div>





                        </div>
                    </div>

                    <div class="row mt-1 mb-3">
                        <div class="col-lg-4">
                            <div class="tbl_product w-100">

                                <div class=" row row_data">
                                    <div class="col-lg-4">
                                        <div class="margin_t ">
                                            <span>基本販売価格</span>
                                        </div>


                                    </div>
                                    <div class="col-lg-8">

                                        <div class="outer row">
                                            <div class="col-lg-12 ">
                                                <div class="m_t">140,000</div>

                                            </div>

                                        </div>

                                    </div>

                                </div>

                                <div class=" row row_data">
                                    <div class="col-lg-4">
                                        <div class="margin_t ">
                                            <span>PB販売価格</span>
                                        </div>


                                    </div>
                                    <div class="col-lg-8">

                                        <div class="outer row">
                                            <div class="col-lg-12 ">
                                                <div class="m_t">98,000</div>
                                            </div>

                                        </div>

                                    </div>

                                </div>

                                <div class=" row row_data">
                                    <div class="col-lg-4">
                                        <div class="margin_t ">
                                            <span>営業粗利</span>
                                        </div>


                                    </div>
                                    <div class="col-lg-8">

                                        <div class="outer row">
                                            <div class="col-lg-12 ">
                                                <div class="m_t"></div>
                                            </div>

                                        </div>

                                    </div>

                                </div>

                                <div class=" row row_data">
                                    <div class="col-lg-4">
                                        <div class="margin_t ">
                                            <span>PB営業粗利</span>
                                        </div>


                                    </div>
                                    <div class="col-lg-8">

                                        <div class="outer row">
                                            <div class="col-lg-12 ">
                                                <div class="m_t"></div>
                                            </div>

                                        </div>

                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="tbl_product w-100">

                                <div class=" row row_data">
                                    <div class="col-lg-4">
                                        <div class="margin_t ">
                                            <span>仕入価格</span>
                                        </div>


                                    </div>
                                    <div class="col-lg-8">

                                        <div class="outer row">
                                            <div class="col-lg-12 ">
                                                <div class="m_t"></div>
                                            </div>

                                        </div>

                                    </div>

                                </div>


                                <div class=" row row_data">
                                    <div class="col-lg-4">
                                        <div class="margin_t ">
                                            <span>仕切(SE)</span>
                                        </div>


                                    </div>
                                    <div class="col-lg-8">

                                        <div class="outer row">
                                            <div class="col-lg-12 ">
                                                <div class="m_t"></div>
                                            </div>

                                        </div>

                                    </div>

                                </div>



                                <div class=" row row_data">
                                    <div class="col-lg-4">
                                        <div class="margin_t ">
                                            <span>仕切(研究所)</span>
                                        </div>


                                    </div>
                                    <div class="col-lg-8">

                                        <div class="outer row">
                                            <div class="col-lg-12 ">
                                                <div class="m_t">42000</div>
                                            </div>

                                        </div>

                                    </div>

                                </div>

                                <div class=" row row_data">
                                    <div class="col-lg-4">
                                        <div class="margin_t ">
                                            <span>仕切(出荷ｾﾝﾀｰ)</span>
                                        </div>


                                    </div>
                                    <div class="col-lg-8">

                                        <div class="outer row">
                                            <div class="col-lg-12 ">
                                                <div class="m_t">7000</div>
                                            </div>

                                        </div>

                                    </div>

                                </div>



                            </div>
                        </div>



                        <div class="col-lg-4">
                            <div class="tbl_product w-100">



                                <div class=" row row_data" style="margin-top: 90px;">
                                    <div class="col-lg-4">
                                        <div class="margin_t ">
                                            <span>価格設定区分</span>
                                        </div>


                                    </div>
                                    <div class="col-lg-8">

                                        <div class="outer row">
                                            <div class="col-lg-12 ">
                                                <div class="m_t">0 定価</div>
                                            </div>

                                        </div>

                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-1 mb-3">
                        <div class="col-lg-12">
                            <div class="tbl_product w-100">
                                <div class=" row row_data">
                                    <div class="col-lg-3">
                                        <div class="margin_t ">
                                            <span>入力区分２(単価等)</span>
                                        </div>


                                    </div>
                                    <div class="col-lg-5">

                                        <div class="outer row">
                                            <div class="col-lg-12 ">
                                                <div class="m_t">0 マスタ索引</div>
                                            </div>

                                        </div>

                                    </div>

                                </div>
                                <div class=" row row_data">
                                    <div class="col-lg-3">
                                        <div class="margin_t ">
                                            <span>上市開始日</span>
                                        </div>


                                    </div>
                                    <div class="col-lg-5">

                                        <div class="outer row">
                                            <div class="col-lg-12 ">
                                                <div class="m_t"></div>
                                            </div>

                                        </div>

                                    </div>

                                </div>
                                <div class=" row row_data">
                                    <div class="col-lg-3">
                                        <div class="margin_t ">
                                            <span>終売日</span>
                                        </div>


                                    </div>
                                    <div class="col-lg-5">

                                        <div class="outer row">
                                            <div class="col-lg-12 ">
                                                <div class="m_t"></div>
                                            </div>

                                        </div>

                                    </div>

                                </div>

                                <div class=" row row_data">
                                    <div class="col-lg-3">
                                        <div class="margin_t ">
                                            <span>製品仕入品区分
                                            </span>
                                        </div>


                                    </div>
                                    <div class="col-lg-5">

                                        <div class="outer row">
                                            <div class="col-lg-12 ">
                                                <div class="m_t">1 自社品</div>
                                            </div>

                                        </div>

                                    </div>

                                </div>



                                <div class=" row row_data">
                                    <div class="col-lg-3">
                                        <div class="margin_t ">
                                            <span>商品分類１

                                            </span>
                                        </div>


                                    </div>
                                    <div class="col-lg-5">

                                        <div class="outer row">
                                            <div class="col-lg-12 ">
                                                <div class="m_t">01 自社製品</div>

                                            </div>

                                        </div>

                                    </div>

                                </div>
                                <div class=" row row_data">
                                    <div class="col-lg-3">
                                        <div class="margin_t ">
                                            <span>商品分類2

                                            </span>
                                        </div>


                                    </div>
                                    <div class="col-lg-5">

                                        <div class="outer row">
                                            <div class="col-lg-12 ">
                                                <div class="m_t">03 Autoメール名人</div>
                                            </div>

                                        </div>

                                    </div>

                                </div>


                                <div class=" row row_data">
                                    <div class="col-lg-3">
                                        <div class="margin_t ">
                                            <span>商品分類3

                                            </span>
                                        </div>


                                    </div>
                                    <div class="col-lg-5">

                                        <div class="outer row">
                                            <div class="col-lg-12 ">
                                                <div class="m_t">99 製品</div>
                                            </div>

                                        </div>

                                    </div>

                                </div>
                                <div class=" row row_data">
                                    <div class="col-lg-3">
                                        <div class="margin_t ">
                                            <span>ﾎﾞﾘｭｰﾑﾗｲｾﾝｽ区分


                                            </span>
                                        </div>


                                    </div>
                                    <div class="col-lg-5">

                                        <div class="outer row">
                                            <div class="col-lg-12 ">
                                                <div class="m_t">1 ﾎﾞﾘｭｰﾑﾗｲｾﾝｽﾊﾟﾀｰﾝ①</div>

                                            </div>

                                        </div>

                                    </div>

                                </div>


                                <div class=" row row_data">
                                    <div class="col-lg-3">
                                        <div class="margin_t ">
                                            <span>ﾊﾞｰｼﾞｮﾝｱｯﾌﾟ区分



                                            </span>
                                        </div>


                                    </div>
                                    <div class="col-lg-5">

                                        <div class="outer row">
                                            <div class="col-lg-12 ">
                                                <div class="m_t">1 ﾒｼﾞｬｰ50％</div>



                                            </div>

                                        </div>

                                    </div>

                                </div>


                                <div class=" row row_data">
                                    <div class="col-lg-3">
                                        <div class="margin_t ">
                                            <span>最新ﾊﾞｰｼﾞｮﾝ区分</span>
                                        </div>

                                    </div>
                                    <div class="col-lg-5">

                                        <div class="outer row">
                                            <div class="col-lg-12 ">
                                                <div class="m_t"> 1 最新</div>

                                            </div>

                                        </div>

                                    </div>

                                </div>
                                <div class=" row row_data">
                                    <div class="col-lg-3">
                                        <div class="margin_t ">
                                            <span>前受請求区分</span>
                                        </div>

                                    </div>
                                    <div class="col-lg-5">

                                        <div class="outer row">
                                            <div class="col-lg-12 ">

                                                <div class="m_t">1 通常</div>
                                            </div>

                                        </div>

                                    </div>

                                </div>





                                <div class=" row row_data">
                                    <div class="col-lg-3">
                                        <div class="margin_t ">
                                            <span>税区分</span>
                                        </div>

                                    </div>
                                    <div class="col-lg-5">

                                        <div class="outer row">
                                            <div class="col-lg-12 ">
                                                <div class="m_t">1 通常1 10%</div>
                                            </div>

                                        </div>

                                    </div>

                                </div>


                                <div class=" row row_data">
                                    <div class="col-lg-3">
                                        <div class="margin_t ">
                                            <span>売上計上区分</span>
                                        </div>

                                    </div>
                                    <div class="col-lg-9">

                                        <div class="outer row">
                                            <div class="col-lg-7">

                                                <div class="m_t" style="width: 95%;">1 可</div>
                                            </div>
                                            <div class="col-lg-2">

                                                <div class="m_t">
                                                    保守作成区分</div>




                                            </div>
                                            <div class="col-lg-3 ">
                                                <div class="m_t">1 無し</div>

                                            </div>



                                        </div>

                                    </div>

                                </div>



                            </div>
                        </div>





                    </div>

                    <div class="row mt-1 mb-3">
                        <div class="col-lg-8">
                            <div class="tbl_product w-100">

                                <div class=" row row_data">
                                    <div class="col-lg-3">
                                        <div class="margin_t ">
                                            <span>得意先限定商品</span>
                                        </div>


                                    </div>
                                    <div class="col-lg-9">

                                        <div class="outer row">
                                            <div class="col-lg-4 ">
                                                <div class="m_t"></div>
                                            </div>
                                            <div class="col-lg-8 ">
                                                <div class="m_t"></div>
                                            </div>
                                        </div>

                                    </div>

                                </div>

                                <div class=" row row_data">
                                    <div class="col-lg-3">
                                        <div class="margin_t ">
                                            <span>保守商品CD</span>
                                        </div>


                                    </div>
                                    <div class="col-lg-9">

                                        <div class="outer row">
                                            <div class="col-lg-4 ">
                                                <div class="m_t"></div>
                                            </div>
                                            <div class="col-lg-8 ">
                                                <div class="m_t"></div>
                                            </div>
                                        </div>

                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>


                    <div class="row mt-1 mb-3">
                        <div class="col-lg-8">
                            <div class="tbl_product w-100">
                                <div class=" row row_data">
                                    <div class="col-lg-3">
                                        <div class="margin_t ">
                                            <span>サービス内容</span>
                                        </div>


                                    </div>
                                    <div class="col-lg-9">

                                        <div class="outer row">
                                            <div class="col-lg-12 ">
                                                <div class="m_t"></div>
                                            </div>

                                        </div>

                                    </div>

                                </div>
                                <div class=" row row_data">
                                    <div class="col-lg-3">
                                        <div class="margin_t ">
                                            <span>成果物</span>
                                        </div>


                                    </div>
                                    <div class="col-lg-9">

                                        <div class="outer row">
                                            <div class="col-lg-12 ">
                                                <div class="m_t"></div>
                                            </div>

                                        </div>

                                    </div>

                                </div>
                                <div class=" row row_data">
                                    <div class="col-lg-3">
                                        <div class="margin_t ">
                                            <span>工数目安</span>
                                        </div>


                                    </div>
                                    <div class="col-lg-9">

                                        <div class="outer row">
                                            <div class="col-lg-12 ">
                                                <div class="m_t"></div>
                                            </div>

                                        </div>

                                    </div>

                                </div>

                                <div class=" row row_data">
                                    <div class="col-lg-3">
                                        <div class="margin_t ">
                                            <span>サービス内容<br />
                                                （社内備考)</span>
                                        </div>


                                    </div>
                                    <div class="col-lg-9">

                                        <div class="outer row">
                                            <div class="col-lg-12 ">
                                                <div class="form-group">
                                                    <div class="m_t">
                                                        開発機能含む標準システム
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                    </div>

                                </div>



                                <div class=" row row_data">
                                    <div class="col-lg-3">
                                        <div class="margin_t ">
                                            <span>メーカー品番</span>
                                        </div>


                                    </div>
                                    <div class="col-lg-9">

                                        <div class="outer row">
                                            <div class="col-lg-12 ">
                                                <div class="m_t"></div>
                                            </div>

                                        </div>

                                    </div>

                                </div>
                                <div class=" row row_data">
                                    <div class="col-lg-3">
                                        <div class="margin_t ">
                                            <span>メーカー品名</span>
                                        </div>


                                    </div>
                                    <div class="col-lg-9">

                                        <div class="outer row">
                                            <div class="col-lg-12 ">
                                                <div class="m_t"></div>
                                            </div>

                                        </div>

                                    </div>

                                </div>

                                <div class=" row row_data">
                                    <div class="col-lg-3">
                                        <div class="margin_t ">
                                            <span>保守会社</span>
                                        </div>


                                    </div>
                                    <div class="col-lg-9">

                                        <div class="outer row">
                                            <div class="col-lg-4 ">
                                                <div class="m_t"></div>
                                            </div>
                                            <div class="col-lg-8 ">
                                                <div class="m_t"></div>
                                            </div>
                                        </div>

                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>



                </div>
                <div class="modal-footer">
                    <!--    <button type="button" class="btn btn-info" data-dismiss="modal"><i class="fas fa-save" style="margin-right: 5px;"></i>保存 </button> <button type="button" class="btn btn-info" data-dismiss="modal">キャンセル </button> -->
                </div>
            </div>
        </div>
    </div>
    <!-- moda1 2 finish here -->
    <!-- moda1 3 start here -->

    <div class="modal fade" data-keyboard="false" data-backdrop="static"  id="product_code_modal3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" style="max-width:950px;" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">商品マスタ(変更)</h5>
                    <button type="button" class="close" >
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="development_page_top_table heading_mt" style="margin:0 2px;">

                        <!--======================= button start ======================-->

                        <div class="row titlebr" style="margin-bottom: 15px;">
                            <div class="col-6">


                            </div>
                            <div class="col-6">
                                <table class="dev_tble_button" style="float: right;">
                                    <tbody>
                                        <tr class="marge_in">
                                            <td class="" style="padding-left: 0px!important;width: 70px!important;">
                                                <div>変更 (処理状況)

                                                </div>
                                            </td>

                                        </tr>
                                    </tbody>
                                </table>

                            </div>

                        </div>

                        <!--======================= button wrapper end ======================-->
                    </div>

                    <div class="row mt-1 mb-3">


                        <div class="col-lg-8">


                            <div class="tbl_emp1">
                                <div class="w-100">


                                    <div class=" row row_data">
                                        <div class="col-lg-3">
                                            <div class="margin_t ">
                                                <span>商品CD <span style="color: red;">※</span></span>
                                            </div>


                                        </div>
                                        <div class="col-lg-9">

                                            <div class="outer row">
                                                <div class="col-lg-12 ">
                                                    <div class="">
                                                        <input type="text" class="form-control" value="00335
">
                                                    </div>

                                                </div>

                                            </div>

                                        </div>

                                    </div>


                                    <div class=" row row_data">
                                        <div class="col-lg-3">
                                            <div class="margin_t ">
                                                <span>商品名</span>
                                            </div>


                                        </div>
                                        <div class="col-lg-9">

                                            <div class="outer row">
                                                <div class="col-lg-12 ">
                                                    <input type="text" class="form-control" value="Autoメール名人 基本パッケージ.開発版 1年ﾗｲｾﾝｽ 6.0.0
">
                                                </div>

                                            </div>

                                        </div>

                                    </div>
                                    <div class=" row row_data">
                                        <div class="col-lg-3">
                                            <div class="margin_t ">
                                                <span>略称</span>
                                            </div>


                                        </div>
                                        <div class="col-lg-9">

                                            <div class="outer row">
                                                <div class="col-lg-12 ">
                                                    <input type="text" class="form-control" value="Autoﾒｰﾙ名人 V0600.1LS
">
                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                    <div class=" row row_data">
                                        <div class="col-lg-3">
                                            <div class="margin_t ">
                                                <span>品目群</span>
                                            </div>


                                        </div>
                                        <div class="col-lg-9">

                                            <div class="outer row">
                                                <div class="col-lg-12 ">
                                                    <select class="form-control" id="">
                                                        <option>03 Autoメール名人</option>
                                                        <option></option>

                                                    </select>
                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                    <div class=" row row_data">
                                        <div class="col-lg-3">
                                            <div class="margin_t ">
                                                <span>製品区分</span>
                                            </div>


                                        </div>
                                        <div class="col-lg-9">

                                            <div class="outer row">
                                                <div class="col-lg-12 ">
                                                    <select class="form-control" id="">
                                                        <option>01 製品</option>
                                                        <option></option>

                                                    </select>
                                                </div>

                                            </div>

                                        </div>

                                    </div>
                                    <div class=" row row_data">
                                        <div class="col-lg-3">
                                            <div class="margin_t ">
                                                <span>品目区分</span>
                                            </div>


                                        </div>
                                        <div class="col-lg-9">

                                            <div class="outer row">
                                                <div class="col-lg-12 ">
                                                    <select class="form-control" id="">
                                                        <option>03 Autoメール名人</option>
                                                        <option></option>

                                                    </select>
                                                </div>

                                            </div>

                                        </div>

                                    </div>
                                    <div class=" row row_data">
                                        <div class="col-lg-3">
                                            <div class="margin_t ">
                                                <span>販売形態</span>
                                            </div>


                                        </div>
                                        <div class="col-lg-9">

                                            <div class="outer row">
                                                <div class="col-lg-12 ">
                                                    <select class="form-control" id="">
                                                        <option>1 1年ﾗｲｾﾝｽ</option>
                                                        <option></option>

                                                    </select>
                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                    <div class=" row row_data">
                                        <div class="col-lg-3">
                                            <div class="margin_t ">
                                                <span>バージョン</span>
                                            </div>


                                        </div>
                                        <div class="col-lg-9">

                                            <div class="outer row">
                                                <div class="col-lg-12 ">
                                                    <input type="text" class="form-control" value="6.0.0">
                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                    <div class=" row row_data">
                                        <div class="col-lg-3">
                                            <div class="margin_t ">
                                                <span>保守区分</span>
                                            </div>


                                        </div>
                                        <div class="col-lg-9">

                                            <div class="outer row">
                                                <div class="col-lg-12 ">
                                                    <select class="form-control" id="">
                                                        <option>1 NULL</option>
                                                        <option></option>

                                                    </select>
                                                </div>

                                            </div>

                                        </div>

                                    </div>
                                    <div class=" row row_data">
                                        <div class="col-lg-3">
                                            <div class="margin_t ">
                                                <span>継続区分</span>
                                            </div>


                                        </div>
                                        <div class="col-lg-9">

                                            <div class="outer row">
                                                <div class="col-lg-12 ">
                                                    <select class="form-control" id="">
                                                        <option>1 NULL</option>
                                                        <option></option>

                                                    </select>
                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                    <div class=" row row_data">
                                        <div class="col-lg-3">
                                            <div class="margin_t ">
                                                <span>新規VUP区分</span>
                                            </div>


                                        </div>
                                        <div class="col-lg-9">

                                            <div class="outer row">
                                                <div class="col-lg-12 ">
                                                    <select class="form-control" id="">
                                                        <option>1 NULL</option>
                                                        <option></option>

                                                    </select>
                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                    <div class=" row row_data">
                                        <div class="col-lg-3">
                                            <div class="margin_t ">
                                                <span>商品サブCD区分</span>
                                            </div>


                                        </div>
                                        <div class="col-lg-9">

                                            <div class="outer row">
                                                <div class="col-lg-12 ">
                                                    <select class="form-control" id="">
                                                        <option>1 有</option>
                                                        <option></option>

                                                    </select>
                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                    <div class=" row row_data">
                                        <div class="col-lg-3">
                                            <div class="margin_t ">
                                                <span>入力区分１(商品名等)</span>
                                            </div>


                                        </div>
                                        <div class="col-lg-9">

                                            <div class="outer row">
                                                <div class="col-lg-12 ">
                                                    <select class="form-control" id="">
                                                        <option>1 入力可</option>
                                                        <option></option>

                                                    </select>
                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                    <div class=" row row_data">
                                        <div class="col-lg-3">
                                            <div class="margin_t ">
                                                <span>仕入先</span>
                                            </div>


                                        </div>
                                        <div class="col-lg-9">

                                            <div class="outer row">
                                                <div class="col-lg-4 ">
                                                    <select class="form-control" id="">
                                                        <option>000001</option>
                                                        <option></option>

                                                    </select>
                                                </div>
                                                <div class="col-lg-8 ">
                                                    <div>(株)AAA</div>
                                                </div>
                                            </div>

                                        </div>

                                    </div>


                                    <!-- end row data -->

                                </div>

                            </div>
                        </div>





                    </div>
                    <div class="row mt-1 mb-3">
                        <div class="col-lg-4">
                            <div class="tbl_product w-100">

                                <div class=" row row_data">
                                    <div class="col-lg-4">
                                        <div class="margin_t ">
                                            <span>基本販売価格</span>
                                        </div>


                                    </div>
                                    <div class="col-lg-8">

                                        <div class="outer row">
                                            <div class="col-lg-12 ">
                                                <input type="text" class="form-control" value="140,000">
                                            </div>

                                        </div>

                                    </div>

                                </div>

                                <div class=" row row_data">
                                    <div class="col-lg-4">
                                        <div class="margin_t ">
                                            <span>PB販売価格</span>
                                        </div>


                                    </div>
                                    <div class="col-lg-8">

                                        <div class="outer row">
                                            <div class="col-lg-12 ">
                                                <input type="text" class="form-control" value="98,000">
                                            </div>

                                        </div>

                                    </div>

                                </div>

                                <div class=" row row_data">
                                    <div class="col-lg-4">
                                        <div class="margin_t ">
                                            <span>営業粗利</span>
                                        </div>


                                    </div>
                                    <div class="col-lg-8">

                                        <div class="outer row">
                                            <div class="col-lg-12 ">
                                                <input type="text" class="form-control" value="">
                                            </div>

                                        </div>

                                    </div>

                                </div>

                                <div class=" row row_data">
                                    <div class="col-lg-4">
                                        <div class="margin_t ">
                                            <span>PB営業粗利</span>
                                        </div>


                                    </div>
                                    <div class="col-lg-8">

                                        <div class="outer row">
                                            <div class="col-lg-12 ">
                                                <input type="text" class="form-control" value="">
                                            </div>

                                        </div>

                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="tbl_product w-100">

                                <div class=" row row_data">
                                    <div class="col-lg-4">
                                        <div class="margin_t ">
                                            <span>仕入価格</span>
                                        </div>


                                    </div>
                                    <div class="col-lg-8">

                                        <div class="outer row">
                                            <div class="col-lg-12 ">
                                                <input type="text" class="form-control" value="">
                                            </div>

                                        </div>

                                    </div>

                                </div>


                                <div class=" row row_data">
                                    <div class="col-lg-4">
                                        <div class="margin_t ">
                                            <span>仕切(SE)</span>
                                        </div>


                                    </div>
                                    <div class="col-lg-8">

                                        <div class="outer row">
                                            <div class="col-lg-12 ">
                                                <input type="text" class="form-control" value="">
                                            </div>

                                        </div>

                                    </div>

                                </div>



                                <div class=" row row_data">
                                    <div class="col-lg-4">
                                        <div class="margin_t ">
                                            <span>仕切(研究所)</span>
                                        </div>


                                    </div>
                                    <div class="col-lg-8">

                                        <div class="outer row">
                                            <div class="col-lg-12 ">
                                                <input type="text" class="form-control" value="42,000">
                                            </div>

                                        </div>

                                    </div>

                                </div>

                                <div class=" row row_data">
                                    <div class="col-lg-4">
                                        <div class="margin_t ">
                                            <span>仕切(出荷ｾﾝﾀｰ)</span>
                                        </div>


                                    </div>
                                    <div class="col-lg-8">

                                        <div class="outer row">
                                            <div class="col-lg-12 ">
                                                <input type="text" class="form-control" value="7,000">
                                            </div>

                                        </div>

                                    </div>

                                </div>



                            </div>
                        </div>



                        <div class="col-lg-4">
                            <div class="tbl_product w-100">



                                <div class=" row row_data" style="margin-top: 90px;">
                                    <div class="col-lg-4">
                                        <div class="margin_t ">
                                            <span>価格設定区分</span>
                                        </div>


                                    </div>
                                    <div class="col-lg-8">

                                        <div class="outer row">
                                            <div class="col-lg-12 ">
                                                <select class="form-control" id="">
                                                    <option>0 定価</option>
                                                    <option></option>

                                                </select>
                                            </div>

                                        </div>

                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-1 mb-3">
                        <div class="col-lg-12">
                            <div class="tbl_product w-100">
                                <div class=" row row_data">
                                    <div class="col-lg-3">
                                        <div class="margin_t ">
                                            <span>入力区分２(単価等)</span>
                                        </div>


                                    </div>
                                    <div class="col-lg-5">

                                        <div class="outer row">
                                            <div class="col-lg-12 ">
                                                <select class="form-control" id="">
                                                    <option>0 マスタ索引</option>
                                                    <option></option>

                                                </select>
                                            </div>

                                        </div>

                                    </div>

                                </div>
                                <div class=" row row_data">
                                    <div class="col-lg-3">
                                        <div class="margin_t ">
                                            <span>上市開始日</span>
                                        </div>


                                    </div>
                                    <div class="col-lg-5">

                                        <div class="outer row">
                                          <div class="col-lg-10 ">

            <input type="text" name='datepicker' class="form-control" value="" id="datepicker3" placeholder="">

            </div>
                                        <!--     <div class="col-lg-2 "> <span class="m_t fa fa-calendar"></span></div> -->


                                        </div>

                                    </div>

                                </div>
                                <div class=" row row_data">
                                    <div class="col-lg-3">
                                        <div class="margin_t ">
                                            <span>終売日</span>
                                        </div>


                                    </div>
                                    <div class="col-lg-5">

                                        <div class="outer row">
                                         <div class="col-lg-10 ">

            <input type="text" name='datepicker' class="form-control" value="" id="datepicker4" placeholder="">

            </div>
                                          <!--   <div class="col-lg-2 "> <span class=" m_t fa fa-calendar"></span></div> -->


                                        </div>

                                    </div>

                                </div>

                                <div class=" row row_data">
                                    <div class="col-lg-3">
                                        <div class="margin_t ">
                                            <span>製品仕入品区分
                                            </span>
                                        </div>


                                    </div>
                                    <div class="col-lg-5">

                                        <div class="outer row">
                                            <div class="col-lg-12 ">
                                                <select class="form-control" id="">
                                                    <option>1 自社品</option>
                                                    <option></option>

                                                </select>
                                            </div>

                                        </div>

                                    </div>

                                </div>



                                <div class=" row row_data">
                                    <div class="col-lg-3">
                                        <div class="margin_t ">
                                            <span>商品分類１

                                            </span>
                                        </div>


                                    </div>
                                    <div class="col-lg-5">

                                        <div class="outer row">
                                            <div class="col-lg-12 ">
                                                <select class="form-control" id="">
                                                    <option>01 自社製品</option>
                                                    <option></option>

                                                </select>
                                            </div>

                                        </div>

                                    </div>

                                </div>
                                <div class=" row row_data">
                                    <div class="col-lg-3">
                                        <div class="margin_t ">
                                            <span>商品分類2

                                            </span>
                                        </div>


                                    </div>
                                    <div class="col-lg-5">

                                        <div class="outer row">
                                            <div class="col-lg-12 ">
                                                <select class="form-control" id="">
                                                    <option>03 Autoメール名人</option>
                                                    <option></option>

                                                </select>
                                            </div>

                                        </div>

                                    </div>

                                </div>


                                <div class=" row row_data">
                                    <div class="col-lg-3">
                                        <div class="margin_t ">
                                            <span>商品分類3

                                            </span>
                                        </div>


                                    </div>
                                    <div class="col-lg-5">

                                        <div class="outer row">
                                            <div class="col-lg-12 ">
                                                <select class="form-control" id="">
                                                    <option>99 製品</option>
                                                    <option></option>

                                                </select>
                                            </div>

                                        </div>

                                    </div>

                                </div>
                                <div class=" row row_data">
                                    <div class="col-lg-3">
                                        <div class="margin_t ">
                                            <span>ﾎﾞﾘｭｰﾑﾗｲｾﾝｽ区分


                                            </span>
                                        </div>


                                    </div>
                                    <div class="col-lg-5">

                                        <div class="outer row">
                                            <div class="col-lg-12 ">
                                                <select class="form-control" id="">
                                                    <option>1 ﾎﾞﾘｭｰﾑﾗｲｾﾝｽﾊﾟﾀｰﾝ①


                                                    </option>
                                                    <option></option>

                                                </select>
                                            </div>

                                        </div>

                                    </div>

                                </div>


                                <div class=" row row_data">
                                    <div class="col-lg-3">
                                        <div class="margin_t ">
                                            <span>ﾊﾞｰｼﾞｮﾝｱｯﾌﾟ区分



                                            </span>
                                        </div>


                                    </div>
                                    <div class="col-lg-5">

                                        <div class="outer row">
                                            <div class="col-lg-12 ">
                                                <select class="form-control" id="">
                                                    <option>1 ﾒｼﾞｬｰ50％


                                                    </option>
                                                    <option></option>

                                                </select>
                                            </div>

                                        </div>

                                    </div>

                                </div>


                                <div class=" row row_data">
                                    <div class="col-lg-3">
                                        <div class="margin_t ">
                                            <span>最新ﾊﾞｰｼﾞｮﾝ区分</span>
                                        </div>

                                    </div>
                                    <div class="col-lg-5">

                                        <div class="outer row">
                                            <div class="col-lg-12 ">
                                                <select class="form-control" id="">
                                                    <option>1 最新</option>
                                                    <option></option>

                                                </select>
                                            </div>

                                        </div>

                                    </div>

                                </div>
                                <div class=" row row_data">
                                    <div class="col-lg-3">
                                        <div class="margin_t ">
                                            <span>前受請求区分</span>
                                        </div>

                                    </div>
                                    <div class="col-lg-5">

                                        <div class="outer row">
                                            <div class="col-lg-12 ">
                                                <select class="form-control" id="">
                                                    <option>1 通常



                                                    </option>
                                                    <option></option>

                                                </select>
                                            </div>

                                        </div>

                                    </div>

                                </div>





                                <div class=" row row_data">
                                    <div class="col-lg-3">
                                        <div class="margin_t ">
                                            <span>税区分</span>
                                        </div>

                                    </div>
                                    <div class="col-lg-5">

                                        <div class="outer row">
                                            <div class="col-lg-12 ">
                                                <select class="form-control" id="">
                                                    <option>1 通常1 10%




                                                    </option>
                                                    <option></option>

                                                </select>
                                            </div>

                                        </div>

                                    </div>

                                </div>


                                <div class=" row row_data">
                                    <div class="col-lg-3">
                                        <div class="margin_t ">
                                            <span>売上計上区分</span>
                                        </div>

                                    </div>
                                    <div class="col-lg-9">

                                        <div class="outer row">
                                            <div class="col-lg-7">
                                                <select class="form-control" id="" style="
    width: 95%;
">
                                                    <option>1 可</option>
                                                    <option>2 不可</option>

                                                </select>
                                            </div>
                                            <div class="col-lg-2">

                                                <div class="m_t text-right">
                                                    保守作成区分</div>




                                            </div>
                                            <div class="col-lg-3 ">
                                                <select class="form-control" id="">
                                                    <option>1 無し</option>
                                                    <option> 2 作る</option>


                                                </select>



                                            </div>
                                        </div>

                                    </div>

                                </div>
                            </div>
                        </div>





                    </div>

                    <div class="row mt-1 mb-3">
                        <div class="col-lg-8">
                            <div class="tbl_product w-100">

                                <div class=" row row_data">
                                    <div class="col-lg-3">
                                        <div class="margin_t ">
                                            <span>得意先限定商品</span>
                                        </div>


                                    </div>
                                    <div class="col-lg-9">

                                        <div class="outer row">
                                            <div class="col-lg-4 ">
                                                <input type="text" class="form-control" value="">
                                            </div>
                                            <div class="col-lg-8 ">

                                            </div>
                                        </div>

                                    </div>

                                </div>

                                <div class=" row row_data">
                                    <div class="col-lg-3">
                                        <div class="margin_t ">
                                            <span>保守商品CD</span>
                                        </div>


                                    </div>
                                    <div class="col-lg-9">

                                        <div class="outer row">
                                            <div class="col-lg-4 ">
                                                <select class="form-control" id="">
                                                    <option>1 可</option>
                                                    <option></option>

                                                </select>
                                            </div>
                                            <div class="col-lg-8 ">

                                            </div>
                                        </div>

                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>


                    <div class="row mt-1 mb-3">
                        <div class="col-lg-8">
                            <div class="tbl_product w-100">
                                <div class=" row row_data">
                                    <div class="col-lg-3">
                                        <div class="margin_t " style="
    margin-top: 28px;
">
                                            <span>サービス内容</span>
                                        </div>


                                    </div>
                                    <div class="col-lg-9">

                                        <div class="outer row">
                                            <div class="col-lg-12 ">
                                                <div class="form-group">

                                                    <textarea class="form-control" rows="5" id="" style="height: 62px;"></textarea>
                                                </div>
                                            </div>

                                        </div>

                                    </div>

                                </div>
                                <div class=" row row_data">
                                    <div class="col-lg-3">
                                        <div class="margin_t ">
                                            <span>成果物</span>
                                        </div>


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
                                        <div class="margin_t " style="
    margin-top: 28px;
">
                                            <span>工数目安</span>
                                        </div>


                                    </div>
                                    <div class="col-lg-9">

                                        <div class="outer row">
                                            <div class="col-lg-12 ">
                                                <div class="form-group">

                                                    <textarea class="form-control" rows="5" id="" style="height: 62px;"></textarea>
                                                </div>
                                            </div>

                                        </div>

                                    </div>

                                </div>

                                <div class=" row row_data">
                                    <div class="col-lg-3">
                                        <div class="margin_t " style="
    margin-top: 54px;
">
                                            <span>サービス内容</span><br />（社内備考)</span>
                                        </div>


                                    </div>
                                    <div class="col-lg-9">

                                        <div class="outer row">
                                            <div class="col-lg-12 ">
                                                <div class="form-group">

                                                    <textarea class="form-control" rows="5" id="" style="height: 115px;"></textarea>
                                                </div>
                                            </div>

                                        </div>

                                    </div>

                                </div>



                                <div class=" row row_data">
                                    <div class="col-lg-3">
                                        <div class="margin_t ">
                                            <span>メーカー品番</span>
                                        </div>


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
                                        <div class="margin_t " style="
    margin-top: 28px;
">
                                            <span>メーカー品名</span>
                                        </div>


                                    </div>
                                    <div class="col-lg-9">

                                        <div class="outer row">
                                            <div class="col-lg-12 ">
                                                <div class="form-group">

                                                    <textarea class="form-control" rows="5" id="" style="height: 62px;"></textarea>
                                                </div>
                                            </div>

                                        </div>

                                    </div>

                                </div>

                                <div class=" row row_data">
                                    <div class="col-lg-3">
                                        <div class="margin_t ">
                                            <span>保守会社</span>
                                        </div>


                                    </div>
                                    <div class="col-lg-9">

                                        <div class="outer row">
                                            <div class="col-lg-4 ">
                                                <select class="form-control" id="">
                                                    <option></option>
                                                    <option></option>

                                                </select>
                                            </div>
                                            <div class="col-lg-8 ">
                                                <div></div>
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
    <!-- moda1 3 finish here -->

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
                                            <span class="mt-1 text-left">商品CD</span>
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
                                            <span class="mt-1 text-left">商品名</span>
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
                                            <span class="mt-1 text-left">品目群CD</span>
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
                                            <span class="mt-1 text-left">製品区分</span>
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
                                            <span class="mt-1 text-left">品目区分</span>
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
                                            <span class="mt-1 text-left">販売形態</span>
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
                                            <span class="mt-1 text-left">バージョン</span>
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
                                            <span class="mt-1 text-left">保守区分</span>
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
                                            <span class="mt-1 text-left">継続区分</span>
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
                                            <span class="mt-1 text-left">新設VUP区分</span>
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
                                            <span class="mt-1 text-left">商品サブCD区分</span>
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
                                            <span class="mt-1 text-left">商品名略称</span>
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
                                            <span class="mt-1 text-left">入力区分１</span>
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
                                            <span class="mt-1 text-left">仕入先ｺｰﾄﾞ</span>
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
                                            <span class="mt-1 text-left">基本販売価格</span>
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
                                            <span class="mt-1 text-left">PB販売価格</span>
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
                                            <span class="mt-1 text-left">営業粗利</span>
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
                                            <span class="mt-1 text-left">PB営業粗利</span>
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
                                            <span class="mt-1 text-left">仕入価格</span>
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
                                            <span class="mt-1 text-left">仕切（SE）</span>
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
                                            <span class="mt-1 text-left">仕切（研究所）</span>
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
                                            <span class="mt-1 text-left">仕切（出荷ｾﾝﾀｰ）</span>
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
                                            <span class="mt-1 text-left">入力区分2</span>
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
                                            <span class="mt-1 text-left">製品仕入品区分</span>
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
                                            <span class="mt-1 text-left">商品分類1</span>
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
                                            <span class="mt-1 text-left">商品分類2</span>
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
                                            <span class="mt-1 text-left">商品分類２</span>
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
                                            <input type="tel" class="form-control" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                                        </td>
                                        <td class="text-left">
                                            <span class="mt-1 text-left">商品分類3</span>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <div class="custom-control custom-checkbox custom-control-inline">
                                                <input type="checkbox" id="th29" class="custom-control-input customCheckBox" >
                                                <label class="custom-control-label margin_btn_17" for="th29"></label>

                                            </div>
                                        </td>
                                        <td style="width:60px!important;">
                                            <input type="tel" class="form-control" value="0" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                                        </td>
                                        <td class="text-left">
                                            <span class="mt-1 text-left">ﾎﾞﾘｭｰﾑﾗｲｾﾝｽ区分</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="custom-control custom-checkbox custom-control-inline">
                                                <input type="checkbox" id="th30" class="custom-control-input customCheckBox" >
                                                <label class="custom-control-label margin_btn_17" for="th30"></label>
                                            </div>
                                        </td>
                                        <td style="width:60px!important;">
                                            <input type="tel" class="form-control" value="1" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                                        </td>
                                        <td class="text-left">
                                            <span class="mt-1 text-left">ﾊﾞｰｼﾞｮﾝｱｯﾌﾟ区分</span>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <div class="custom-control custom-checkbox custom-control-inline">
                                                <input type="checkbox" id="th31" class="custom-control-input customCheckBox" >
                                                <label class="custom-control-label margin_btn_17" for="th31"></label>
                                            </div>
                                        </td>
                                        <td style="width:60px!important;">
                                            <input type="tel" class="form-control" value="2" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                                        </td>
                                        <td class="text-left">
                                            <span class="mt-1 text-left">上市開始日</span>
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
                                            <input type="tel" class="form-control" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                                        </td>
                                        <td class="text-left">
                                            <span class="mt-1 text-left">終売日</span>
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
                                            <input type="tel" class="form-control" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                                        </td>
                                        <td class="text-left">
                                            <span class="mt-1 text-left">最新バージョン区分</span>
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
                                            <input type="tel" class="form-control" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                                        </td>
                                        <td class="text-left">
                                            <span class="mt-1 text-left">前受請求区分</span>
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
                                            <input type="tel" class="form-control" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                                        </td>
                                        <td class="text-left">
                                            <span class="mt-1 text-left">税区分</span>
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
                                            <input type="tel" class="form-control" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                                        </td>
                                        <td class="text-left">
                                            <span class="mt-1 text-left">売上計上区分</span>
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
                                            <input type="tel" class="form-control" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                                        </td>
                                        <td class="text-left">
                                            <span class="mt-1 text-left">サービス内容</span>
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
                                            <input type="tel" class="form-control" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                                        </td>
                                        <td class="text-left">
                                            <span class="mt-1 text-left">工数目安</span>
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
                                            <input type="tel" class="form-control" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                                        </td>
                                        <td class="text-left">
                                            <span class="mt-1 text-left">サービス内容（社内備考）</span>
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
                                            <input type="tel" class="form-control" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                                        </td>
                                        <td class="text-left">
                                            <span class="mt-1 text-left">保守作成区分</span>
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
                                                <input type="checkbox" id="th41" class="custom-control-input customCheckBox">
                                                <label class="custom-control-label margin_btn_17" for="th41"></label>
                                            </div>
                                        </td>
                                        <td style="width:60px!important;">
                                            <input type="tel" class="form-control" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                                        </td>
                                        <td class="text-left">
                                            <span class="mt-1 text-left">得意先限定商品</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="custom-control custom-checkbox custom-control-inline">
                                                <input type="checkbox" id="th42" class="custom-control-input customCheckBox">
                                                <label class="custom-control-label margin_btn_17" for="th42"></label>
                                            </div>
                                        </td>
                                        <td style="width:60px!important;">
                                            <input type="tel" class="form-control" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                                        </td>
                                        <td class="text-left">
                                            <span class="mt-1 text-left">保守商品CD</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="custom-control custom-checkbox custom-control-inline">
                                                <input type="checkbox" id="th43" class="custom-control-input customCheckBox">
                                                <label class="custom-control-label margin_btn_17" for="th43"></label>
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
                                                <input type="checkbox" id="th44" class="custom-control-input customCheckBox">
                                                <label class="custom-control-label margin_btn_17" for="th44"></label>
                                            </div>
                                        </td>
                                        <td style="width:60px!important;">
                                            <input type="tel" class="form-control" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                                        </td>
                                        <td class="text-left">
                                            <span class="mt-1 text-left">メーカー品番</span>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <div class="custom-control custom-checkbox custom-control-inline">
                                                <input type="checkbox" id="th45" class="custom-control-input customCheckBox">
                                                <label class="custom-control-label margin_btn_17" for="th45"></label>
                                            </div>
                                        </td>
                                        <td style="width:60px!important;">
                                            <input type="tel" class="form-control" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                                        </td>
                                        <td class="text-left">
                                            <span class="mt-1 text-left">メーカー品名</span>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <div class="custom-control custom-checkbox custom-control-inline">
                                                <input type="checkbox" id="th46" class="custom-control-input customCheckBox">
                                                <label class="custom-control-label margin_btn_17" for="th46"></label>
                                            </div>
                                        </td>
                                        <td style="width:60px!important;">
                                            <input type="tel" class="form-control" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                                        </td>
                                        <td class="text-left">
                                            <span class="mt-1 text-left">価格設定区分</span>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <div class="custom-control custom-checkbox custom-control-inline">
                                                <input type="checkbox" id="th47" class="custom-control-input customCheckBox">
                                                <label class="custom-control-label margin_btn_17" for="th47"></label>
                                            </div>
                                        </td>
                                        <td style="width:60px!important;">
                                            <input type="tel" class="form-control" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                                        </td>
                                        <td class="text-left">
                                            <span class="mt-1 text-left">保守会社CD</span>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <div class="custom-control custom-checkbox custom-control-inline">
                                                <input type="checkbox" id="th48" class="custom-control-input customCheckBox">
                                                <label class="custom-control-label margin_btn_17" for="th48"></label>
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
                                                <input type="checkbox" id="th49" class="custom-control-input customCheckBox">
                                                <label class="custom-control-label margin_btn_17" for="th49"></label>
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
                                                <input type="checkbox" id="th50" class="custom-control-input customCheckBox">
                                                <label class="custom-control-label margin_btn_17" for="th50"></label>
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
                                                <input type="checkbox" id="th51" class="custom-control-input customCheckBox">
                                                <label class="custom-control-label margin_btn_17" for="th51"></label>
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
                                                <input type="checkbox" id="th52" class="custom-control-input customCheckBox">
                                                <label class="custom-control-label margin_btn_17" for="th52"></label>
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
                                                <input type="checkbox" id="th53" class="custom-control-input customCheckBox">
                                                <label class="custom-control-label margin_btn_17" for="th53"></label>
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




  @include('layout.footer')

    <!-- <link href="//ajax.aspnetcdn.com/ajax/jquery.ui/1.8.9/themes/blitzer/jquery-ui.css" rel="stylesheet" type="text/css">-->
    <script src="{{ asset('js/jquery-3.4.1.min.js') }}"></script>
    <!--Bootstrap 4.x-->
    <script src="  {{ asset('js/bootstrap.min.js') }}"></script>

    <!--Jquery Map for mac operating system-->
    <script src=" {{ asset('js/select2.min.js') }}"></script>
    <script src=" {{ asset('js/jadatepicker.js') }}"></script>
    <!--    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>-->
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <!--   <script src="{{ asset('js/jquery.jpDatePicker.js') }}"></script> -->

    <script type="text/javascript">
        $("#productButton3").on("click", function() {
            $("#product_code_modal2").modal("hide");
            $('body').removeClass('modal-open');
            $('body').css('overflow-y', 'hidden');
            $('.modal-backdrop').remove();


        });

    </script>

    <script>
        $(document).ready(function() {
               $("#datepicker1").datepicker({

    showOn: "both",
      buttonText: "<i class='fa fa-calendar'></i>"

            });

            // $('.fa-calendar').click(function() {
            //     $("#datepicker1").focus();
            // });
        });

    </script>
    <script>
        $(document).ready(function() {
              $("#datepicker2").datepicker({

    showOn: "both",
      buttonText: "<i class='fa fa-calendar'></i>"

            });
            // $('.fa-calendar').click(function() {
            //     $("#datepicker2").focus();
            // });
        });

    </script>
    <script>
        $(document).ready(function() {
             $("#datepicker3").datepicker({

    showOn: "both",
      buttonText: "<i class='fa fa-calendar'></i>"

            });

            // $('.fa-calendar').click(function() {
            //     $("#datepicker3").focus();

            // });



        });

    </script>
    <script>
        $(document).ready(function() {
                   $("#datepicker4").datepicker({

    showOn: "both",
      buttonText: "<i class='fa fa-calendar'></i>"

            });


            // $('.fa-calendar').click(function() {
            //     $("#datepicker4").focus();
            // });



        });

    </script>

    <script>
        $(document).ready(function() {
            $(".calendar").datepicker();


            $('.fa-calendar').click(function() {
                $(".calendar").focus();
            });



        });

    </script>


</body>

</html>
