@section('menu', '商品サブマスタ')
<!DOCTYPE html>
<html lang="ja" >
<head>
  <meta charset="utf-8">
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="msapplication-tap-highlight" content="no">
  <title>商品サブマスタ</title>
  <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}" >
  <link href="https://use.fontawesome.com/releases/v5.0.4/css/all.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="{{ asset('css/navbar_styles.css') }}" >
  <link rel="stylesheet" type="text/css" href="{{ asset('css/login_styles.css') }}" >
  <link rel="stylesheet" type="text/css" href="{{ asset('css/modal_styles.css') }}" >
  <link rel="stylesheet" type="text/css" href="{{ asset('css/product_styles.css') }}" >
  <link rel="stylesheet" type="text/css" href="{{ asset('css/pagination_styles.css') }}" >
  <link rel="stylesheet" type="text/css" href="{{ asset('css/datepicker.css') }}" >
  <script src=" {{ asset('js/common.js') }}"></script>
  <script src=" {{ asset('js/master/productSubMaster.js') }}"></script>
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

  .add_border {
  border: 2px solid #ff9900;
  padding: 0px;
}
.removeBorder {
  border: none;
  padding: 0px;
}
.product_supplier_content1_row,.product_supplier_content2_row{
cursor: pointer;

}

#cal_icon1,#cal_icon2,#cal_icon3,#cal_icon4{
  cursor: pointer;
}
.modal-open {
    overflow: hidden;
}
.modal {
  overflow: auto !important;

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


<!-- button table row  end -->

    <!-- pagination row starts here -->

  <div class="row">




</div>

<!-- pagination row end here -->
<!-- Large table row starts here -->
 @include('master.productSub.mainTableProductSub')

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


<script type="text/javascript">
  function resizeInput() {
    $(this).attr('size', $(this).val().length);
}

$('input[type="text"]')
    .keyup(resizeInput)
    .each(resizeInput);




</script>
<!-- Modal 1 start here -->

 @include('master.productSub.ProductSubRegistration')

<!-- ============================= moda1 2 start here ========================-->

  @include('master.productSub.ProductSubDetail')
<!-- ============================moda1 3 start here ======================= -->

  @include('master.productSub.ProductSubEdit')
<!-- ============================moda1 3 end here ======================= -->

<!-- col-12 div end -->
</div>
<!-- row div end -->
</div>

<!-- container-fluid div end -->
</div>

<!-- ============================new moda1 end here ======================= -->


@include('master.productSub.productSubSetting')

@include('master.productSub.atarashiPopUp')
@include('layout.footer')

<!-- <link href="//ajax.aspnetcdn.com/ajax/jquery.ui/1.8.9/themes/blitzer/jquery-ui.css" rel="stylesheet" type="text/css"> -->

<!--Bootstrap 4.x-->
<script src="{{ asset('js/jquery-3.4.1.min.js') }}"></script>
<script src="  {{ asset('js/bootstrap.min.js') }}"></script>

<!--Jquery Map for mac operating system-->
<script src=" {{ asset('js/select2.min.js') }}"></script>
<!-- <script src="  {{ asset('js/inputResize.js') }}"></script> -->
<script src="  {{ asset('js/datepicker.js') }}"></script>
<script src="  {{ asset('js/datepicker.ja-JP.js') }}"></script>
<script type="text/javascript">
    $("#choice_button").click(function() {


                //$("#initial_content").hide();
                  $("#product_supplier_content1").hide();
                  $("#product_supplier_content2").hide();
                  $("#product_supplier_content3").hide();
                    if ( $(".product_supplier_content1_row").hasClass("add_border") ) {
        $(".product_supplier_content1_row").removeClass('add_border');
    }

                if ( $(".product_supplier_content2_row").hasClass("add_border") ) {
        $(".product_supplier_content2_row").removeClass('add_border');
    }
                  if ( $(".product_supplier_content3_row").hasClass("add_border") ) {
        $(".product_supplier_content3_row").removeClass('add_border');
    }


            });

</script>
 <script type="text/javascript">

$("#productSubButton3").on("click", function(){
    $("#product_sub_modal2").modal("hide");
  $('body').removeClass('modal-open');
  $('body').css('overflow-y', 'hidden');
 $('.modal-backdrop').remove();


});

</script>


<script type="text/javascript">
    $(function () {
      $('#datepicker1_pr_sub').datepicker({
        language: 'ja-JP',
        format: 'yyyy-mm-dd',
        autoHide: true,
        zIndex: 2048,

      });

    });


</script>
<script type="text/javascript">

   $(document).on('click',"#cal_icon1",function(){
         $("#datepicker1_pr_sub").datepicker("show");
     });

</script>
<script type="text/javascript">
    $(function () {
      $('#datepicker2_pr_sub').datepicker({
        language: 'ja-JP',
        format: 'yyyy-mm-dd',
        autoHide: true,
        zIndex: 2048,

      });

    });


</script>
<script type="text/javascript">

   $(document).on('click',"#cal_icon2",function(){
         $("#datepicker2_pr_sub").datepicker("show");
     });

</script>

<script type="text/javascript">
    $(function () {
      $('#datepicker3_pr_sub').datepicker({
        language: 'ja-JP',
        format: 'yyyy-mm-dd',
        autoHide: true,
        zIndex: 2048,

      });

    });


</script>
<script type="text/javascript">

   $(document).on('click',"#cal_icon3",function(){
         $("#datepicker3_pr_sub").datepicker("show");
     });

</script>
<script type="text/javascript">
    $(function () {
      $('#datepicker4_pr_sub').datepicker({
        language: 'ja-JP',
        format: 'yyyy-mm-dd',
        autoHide: true,
        zIndex: 2048,

      });

    });


</script>
<script type="text/javascript">

   $(document).on('click',"#cal_icon4",function(){
         $("#datepicker4_pr_sub").datepicker("show");
     });

</script>



</body>
</html>
