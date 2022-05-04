@section('menu', '会社マスタ')
<!DOCTYPE html>
<html lang="ja" >
<head>
  <meta charset="utf-8">
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="msapplication-tap-highlight" content="no">
  <title>会社マスタ</title>
  <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}" >
  <link href="https://use.fontawesome.com/releases/v5.0.4/css/all.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="{{ asset('css/navbar_styles.css') }}" >
  <link rel="stylesheet" type="text/css" href="{{ asset('css/login_styles.css') }}" >
  <link rel="stylesheet" type="text/css" href="{{ asset('css/modal_styles.css') }}" >
  <link rel="stylesheet" type="text/css" href="{{ asset('css/product_styles.css') }}" >
       <link rel="stylesheet" href="{{ asset('css/jquery.jpDatePicker.css') }}">
   <link rel="stylesheet" type="text/css" href="{{ asset('css/comp_styles.css') }}" >
       <link rel="stylesheet" type="text/css" href="{{ asset('css/pagination_styles.css') }}" >
          <!-- <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">-->

<link rel="stylesheet" type="text/css" href="{{ asset('css/datepicker.css') }}" >
  <script type="text/javascript">



</script>
<!-- [if IE]>

<style>
.nav-tabs .nav-link.active{
                     border-size:0px!important;
                      border:none!important;
}
</style>
<! [endif]-->

<style>

.chk-wrapper input[type=checkbox] + label {
  display: block;
  margin: 0.2em;
  cursor: pointer;
  padding: 0.2em;
}

.chk-wrapper input[type=checkbox] {
  display: none;
}

.chk-wrapper input[type=checkbox] + label:before {
    content: "\2714";
    border: 0.1em solid #000;
    border-radius: 0.2em;
    display: inline-block;
    width: 18px;
    height: 18px;
    padding-left: 0.2em;
    padding-bottom: 0.3em;
    margin-right: 0.2em;
    vertical-align: bottom;
    color: transparent;
    transition: .2s;
}

.chk-wrapper input[type=checkbox] + label:active:before {
  transform: scale(0);
}

.chk-wrapper input[type=checkbox]:checked + label:before {
  background-color: #3e6ec1!important;
  border-color: #3e6ec1!important;
  color: #fff;
}

.chk-wrapper input[type=checkbox]:disabled + label:before {
  transform: scale(1);
  border-color: #aaa;
}

.chk-wrapper input[type=checkbox]:checked:disabled + label:before {
  transform: scale(1);
background-color: #3e6ec1!important;
  border-color: #3e6ec1!important;
}



.custom-file-input::-webkit-file-upload-button {
  visibility: hidden;
}
.custom-file-input::before {
  content: '参照';
  display: inline-block;
  background: linear-gradient(top, #f9f9f9, #e3e3e3);
  border: 1px solid #999;
  border-radius: 3px;
  padding: 5px 8px;
  outline: none;
  white-space: nowrap;
  -webkit-user-select: none;
  cursor: pointer;
  text-shadow: 1px 1px #fff;
  font-weight: 700;
  font-size: 10pt;
}
.custom-file-input:hover::before {
  border-color: black;
}
.custom-file-input:active::before {
  background: -webkit-linear-gradient(top, #e3e3e3, #f9f9f9);
}

  .add_border {
  border: 2px solid #ff9900;
  padding: 0px;
}
.removeBorder {
  border: none;
  padding: 0px;
}
.comp_content1_row,.comp_content2_row,.comp_content3_row{
cursor: pointer;

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
  .ml-45{
margin-left: 45px;
  }
.m_t{
  margin-top: 7px;

}

/*.tbl_rounded tbody{
      display:block;
border: 1px solid #32859C;border-radius: 4px!important;
}
*/
@media screen and (-ms-high-contrast: active), (-ms-high-contrast: none) {
 .nav-tabs .nav-link.active{

border:0px!important;
}
}
.tbl_tab td{
    border: 1px solid  #29487d!important;
}

.tbl_tab td:first-child {
    border: none!important;
}
.nav-tabs .nav-link.active_nav{
    color: #55595c!important;

    border-color: #ddd #ddd transparent!important;
/*1px solid #c2d6d6 !important*/

}
.nav-tabs{
/*border-bottom: 0px!important;*/
}
.nav-tabs .nav-link:not(.active) {
    border-color: transparent !important;
}
.nav-tabs .nav-link {
    color: #55595c!important;


}
.nav-tabs .nav-link.active, .nav-tabs .nav-item.show .nav-link{
    background-color: #c2d6d6!important;


}


.tab-content > .active {
    display: block;
 border: 1px solid #29487d!important;


  }
.nav-tabs .nav-link.active{
  border-top: 1px solid #29487d!important;
   border-right: 1px solid #29487d!important;
    border-left: 1px solid #29487d!important;
  border-bottom:1px solid #fff!important;
}
.table > tbody > tr > td {
    border: 1px solid #29487d!important;
    color: #17252A;
}

.table-bordered td {
    border: 1px solid white!important;
}
.border{
border: 1px solid #29487d!important;

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

.chk-wrapper{
  float: left;
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
 .Red{
    border: 1px solid red!important;
    display: block;
    width: 100%;
    height: 30px;
    padding: 0.375rem 0.75rem;
 }
</style>



</head>

       <body style="">
  @include('layout.nav_test')
  <div class="container left_right_margin">

   <div class="row">
   <div class="col-lg-12">
  <!-- <section class=" display_section margin_b">
     <div class="row" >
        <div class="col-lg-12 ">
          <div style="margin: auto;width: 200px;">
            <h5 href="#" class=" textfnt "style="color: #405063;border-radius: 10px;box-sizing: border-box; width: 200px; text-align: center!important;border: 2px solid #405063;margin-top: 16px;" > 会社マスタ</h5>
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
    <div class="col-lg-2 col-6 col-sm-3 col-xs-6 pl-m mb-2 text-center"><a href="#" class="btn btn-info btn-m-view " style="width: 100%; background-color:#3e6ec1!important;">一覧</a></div>
 <!--  <div class="col-lg-2 col-6 col-sm-3 col-xs-6  pl-m mb-2 text-center"><a href="#" class="btn btn-info btn-m-view  "style="width: 100%;" data-toggle="modal" data-target="#product_code_modal">新規登録</a></div> -->
 <div class="col-lg-2 col-6 col-sm-3 col-xs-6 padd-0 mb-2 text-center"><a href="#" class="btn btn-info btn-m-view " style="width: 100%; background-color:#3e6ec1!important;"data-toggle="modal" data-target="#comp_modal1">新規登録</a></div>
  <!-- <div class="col-lg-2 col-6 col-sm-3 col-xs-6 pl-m mb-2 text-center"><a href="#" class="btn btn-info btn-m-view "style="width: 100%; background-color:#3e6ec1!important;">CSV作成</a></div> -->
 <div class="col-lg-2 col-sm-3 col-xs-6 col-6 pl-m mb-2 text-center " ><a href="#" class="btn btn-info btn-m-view"style="width: 100%; background-color:#3e6ec1!important;">EXCEL作成</a></div>

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
<!-- pagination row startshere -->
 <div class="row">

   @include('layout.pagi1_settings')
      @include('layout.pagi2_settings')

</div>


<!-- pagination row end here -->
<!-- Large table row starts here -->
  <div class="row">
  <div class="col-lg-12">


    <div style="overflow: hidden;">
<div class="table-responsive" style="padding-bottom: 10px;height: 388px;overflow:auto;">


<table class="table table-bordered table-striped">



      <thead class="thead-dark header text-center" id="myHeader">
                                                <tr>
                                                    <th scope="col"></th>
                                                    <th scope="col"></th>
           <th scope="col" ><span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1;  color: #fff;">会社CD</span></th>
  <th scope="col" ><span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1;  color: #fff;">会社名</span></th>
  <th scope="col" ><span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1;  color: #fff;">会社名略称</span></th>
  <th scope="col" ><span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1;  color: #fff;">会社名カナ</span></th>
  <th scope="col" ><span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1;  color: #fff;">入力区分</span></th>
  <th scope="col" ><span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1;  color: #fff;">帝国ﾃﾞｰﾀﾊﾞﾝｸ信用録PDF</span></th>
  <th scope="col" ><span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1;  color: #fff;">帝国ﾃﾞｰﾀﾊﾞﾝｸ取得年月日</span></th>
  <th scope="col" ><span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1;  color: #fff;">帝国ﾃﾞｰﾀﾊﾞﾝｸ企業CD</span></th>
  <th scope="col" ><span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1;  color: #fff;">帝国ﾃﾞｰﾀﾊﾞﾝｸ評点</span></th>
  <th scope="col" ><span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1;  color: #fff;">経済産業省業種区分１</span></th>
  <th scope="col" ><span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1;  color: #fff;">経済産業省業種区分2</span></th>
  <th scope="col" ><span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1;  color: #fff;">会社分類１</span></th>
  <th scope="col" ><span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1;  color: #fff;">社内備考（会社）</span></th>
  <th scope="col" ><span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1;  color: #fff;">即時区分</span></th>
  <th scope="col" ><span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1;  color: #fff;">請求締め日</span></th>
  <th scope="col" ><span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1;  color: #fff;">入金方法</span></th>
  <th scope="col" ><span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1;  color: #fff;">回収月 </span></th>
  <th scope="col" ><span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1;  color: #fff;">回収日</span></th>
  <th scope="col" ><span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1;  color: #fff;">回収日休日設定</span></th>


  <th scope="col" ><span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1;  color: #fff;">入金振込手数料設定</span></th>
  <th scope="col" ><span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1;  color: #fff;">与信限度額</span></th>
  <th scope="col" ><span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1;  color: #fff;">請求先CD</span></th>
  <th scope="col" ><span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1;  color: #fff;">請求書送付日</span></th>
  <th scope="col" ><span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1;  color: #fff;">請求書メール区分</span></th>
  <th scope="col" ><span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1;  color: #fff;">請求書メール宛先</span></th>
  <th scope="col" ><span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1;  color: #fff;">請求書UIS</span></th>
  <th scope="col" ><span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1;  color: #fff;">請求書郵送</span></th>
  <th scope="col" ><span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1;  color: #fff;">請求書郵送先</span></th>
  <th scope="col" ><span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1;  color: #fff;">請求税区分</span></th>
  <th scope="col" ><span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1;  color: #fff;">請求税端数区分</span></th>
  <th scope="col" ><span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1;  color: #fff;">専伝区分</span></th>
  <th scope="col" ><span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1;  color: #fff;">指定納品書帳票CD</span></th>
  <th scope="col" ><span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1;  color: #fff;">ユーザー区分</span></th>
  <th scope="col" ><span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1;  color: #fff;">データソース</span></th>
  <th scope="col" ><span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1;  color: #fff;">得意先分類１</span></th>
  <th scope="col" ><span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1;  color: #fff;">得意先分類２ </span></th>
   <th scope="col" ><span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1;  color: #fff;">得意先分類３</span></th>
  <th scope="col" ><span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1;  color: #fff;">得意先分類４ </span></th>
   <th scope="col" ><span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1;  color: #fff;">得意先分類５</span></th>
    <th scope="col" ><span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1;  color: #fff;">得意先分類６</span></th>
  <th scope="col" ><span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1;  color: #fff;">会社分類２</span></th>
   <th scope="col" ><span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1;  color: #fff;">会社分類３</span></th>
  <th scope="col" ><span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1;  color: #fff;">会社分類４</span></th>
   <th scope="col" ><span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1;  color: #fff;">会社分類５</span></th>
  <th scope="col" ><span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1;  color: #fff;">取引開始日 東直</span></th>
  <th scope="col" ><span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1;  color: #fff;">取引開始日 東流</span></th>
  <th scope="col" ><span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1;  color: #fff;">取引開始日 西直</span></th>
  <th scope="col" ><span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1;  color: #fff;">取引開始日 西流</span></th>
  <th scope="col" ><span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1;  color: #fff;">単価設定区分</span></th>
  <th scope="col" ><span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1;  color: #fff;">支払締め日</span></th>
  <th scope="col" ><span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1;  color: #fff;">支払月</span></th>
  <th scope="col" ><span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1;  color: #fff;">支払日</span></th>
  <th scope="col" ><span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1;  color: #fff;">支払日休日設定</span></th>
  <th scope="col" ><span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1;  color: #fff;">支払振込手数料設定</span></th>
  <th scope="col" ><span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1;  color: #fff;">支払方法</span></th>
  <th scope="col" ><span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1;  color: #fff;">振込銀行</span></th>
  <th scope="col" ><span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1;  color: #fff;">振込支店</span></th>
  <th scope="col" ><span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1;  color: #fff;">預金種別</span></th>
  <th scope="col" ><span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1;  color: #fff;">口座番号</span></th>
  <th scope="col" ><span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1;  color: #fff;">口座名義人</span></th>
  <th scope="col" ><span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1;  color: #fff;">仕向銀行</span></th>
  <th scope="col" ><span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1;  color: #fff;">仕向支店</span></th>
  <th scope="col" ><span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1;  color: #fff;">支払税区分</span></th>
  <th scope="col" ><span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1;  color: #fff;">支払税端数区分</span></th>
  <th scope="col" ><span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1;  color: #fff;">源泉区分</span></th>
  <th scope="col" ><span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1;  color: #fff;">支払先分類1 </span></th>
  <th scope="col" ><span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1;  color: #fff;">支払先分類2</span></th>
   <th scope="col" ><span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1;  color: #fff;">手形決済月</span></th>
  <th scope="col" ><span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1;  color: #fff;">手形決済日</span></th>
  <th scope="col" ><span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1;  color: #fff;">保守更新案内有無</span></th>
  <th scope="col" ><span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1;  color: #fff;">ライセンス証書有無</span></th>
  <th scope="col" ><span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1;  color: #fff;">検収条件</span></th>
  <th scope="col" ><span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1;  color: #fff;">法人マイナンバー</span></th>
  <th scope="col" ><span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1;  color: #fff;">会計取引先CD</span></th>
  <th scope="col" ><span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1;  color: #fff;">売上区分</span></th>
  <th scope="col" ><span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1;  color: #fff;">仕入区分</span></th>
 <!--  <th scope="col" ><span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1;  color: #fff;">データ有効区分</span></th> -->
  <th scope="col" ><span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1;  color: #fff;">会社名カナ入金消込用</span></th>
  <th scope="col" ><span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1;  color: #fff;">請求消費税計算区分</span></th>
  <th scope="col" ><span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1;  color: #fff;">仕入消費税計算区分</span></th>
  <th scope="col" ><span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1;  color: #fff;">登録年月日</span></th>
  <th scope="col" ><span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1;  color: #fff;">登録時刻</span></th>
  <th scope="col" ><span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1;  color: #fff;">更新年月日</span></th>
  <th scope="col" ><span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1;  color: #fff;">更新時刻</span></th>
  <th scope="col" ><span style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1;  color: #fff;">更新時端末IP </span></th>
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
     <!--    <td>
          <input type="text" class="form-control">
        </td> -->
      </tr>

 <!--      2nd row -->
   <tr>
      <td class="col-lg-2 col-sm-4 col-xs-6 col-6 mb-2 text-center"><a href="{{url('/office')}}" target="_blank" class="btn btn-warning btn-m-view " style="width: 100%;background-color: #87ceeb!important;border:1px solid #87ceeb!important;"><i class="fas fa-plus-circle" style="margin-right:5px;"></i>展開</a>
      </td>
      <td style="width:50px;">
      <a href="#" id="sequenceButton1" class="btn btn-info btn-m-view " style="width: 100%;" data-toggle="modal" data-target="#comp_modal2"><i class="fa fa-folder-open" aria-hidden="true" style="margin-right: 5px;"></i>詳細</a>
     </td>

        <td>123456</td>
        <td>株式会社ジョイアス・フーズ</td>
        <td>ジョイアス</td>
        <td>ジョイアスフーズ</td>
        <td></td>
        <td>0</td>
        <td></td>
        <td>ZZZ0011</td>
        <td>2019/11/19</td>
        <td>881234567</td>
        <td>11</td>
        <td>A 農業</td>
        <td>01 農業</td>
        <td></td>
        <td>02 ～1億円</td>
        <td></td>
        <td>04 資本金：～1億円</td>
        <td></td>
        <td>99</td>
        <td>1</td>
        <td>1</td>
        <td>1</td>
        <td>15</td>
        <td>1</td>
        <td>0</td>
        <td>10</td>
        <td>11</td>
        <td>1</td>
        <td></td>
        <td></td>
        <td></td>
        <td>123</td>
        <td>11234567898</td>
        <td>11</td>
        <td>1</td>
        <td>99874563211</td>
        <td>1</td>
        <td>4</td>
        <td></td>
        <td>1478</td>
        <td>1</td>
        <td></td>
        <td>1</td>
        <td>13134568</td>
        <td></td>
        <td>95159</td>
        <td>95478</td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td>1</td>
        <td>5</td>
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
        <td></td>
        <td></td>

      </tr>

 <!--      3rd row -->
    <tr>
      <td class="col-lg-2 col-sm-4 col-xs-6 col-6 mb-2 text-center"><a href="{{url('/office')}}" target="_blank" class="btn btn-warning btn-m-view " style="width: 100%;background-color: #87ceeb!important;border:1px solid #87ceeb!important;"><i class="fas fa-plus-circle" style="margin-right:5px;"></i>展開</a>
      </td>
      <td style="width:50px;">
      <a href="#" id="sequenceButton1" class="btn btn-info btn-m-view " style="width: 100%;" data-toggle="modal" data-target="#comp_modal2"><i class="fa fa-folder-open" aria-hidden="true" style="margin-right: 5px;"></i>詳細</a>
     </td>

        <td>234567</td>
        <td>アロン化成株式会社</td>
        <td>アロン</td>
        <td>アロンカセイ</td>
        <td></td>
        <td>0</td>
        <td></td>
        <td>ZZZ0012</td>
        <td>2019/11/19</td>
        <td>881234568</td>
        <td>22</td>
        <td>A 農業</td>
        <td>05 農業サービス業</td>
        <td>04 サービス業・他</td>
        <td>01 ～5000万円</td>
        <td></td>
        <td></td>
        <td></td>
        <td>88</td>
        <td>1</td>
        <td>1</td>
        <td>2</td>
        <td>20</td>
        <td>2</td>
        <td>1</td>
        <td>15</td>
        <td>11</td>
        <td>2</td>
        <td></td>
        <td></td>
        <td></td>
        <td>124</td>
        <td>22123456789</td>
        <td>12</td>
        <td>2</td>
        <td>77987654321</td>
        <td>2</td>
        <td>1</td>
        <td></td>
        <td>1236</td>
        <td>2</td>
        <td></td>
        <td>1</td>
        <td>46461236</td>
        <td></td>
        <td>65456</td>
        <td>65521</td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td>2</td>
        <td>4</td>
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
        <td></td>
        <td></td>

      </tr>

 <!--      4th row -->
   <tr>
      <td class="col-lg-2 col-sm-4 col-xs-6 col-6 mb-2 text-center"><a href="{{url('/office')}}" target="_blank" class="btn btn-warning btn-m-view " style="width: 100%;background-color: #87ceeb!important;border:1px solid #87ceeb!important;"><i class="fas fa-plus-circle" style="margin-right:5px;"></i>展開</a>
      </td>
      <td style="width:50px;">
      <a href="#" id="sequenceButton1" class="btn btn-info btn-m-view " style="width: 100%;" data-toggle="modal" data-target="#comp_modal2"><i class="fa fa-folder-open" aria-hidden="true" style="margin-right: 5px;"></i>詳細</a>
     </td>

        <td>345678</td>
        <td>株式会社ミスミグループ本社</td>
        <td>ミスミ</td>
        <td>ミスミグループホンシャ</td>
        <td></td>
        <td>0</td>
        <td></td>
        <td>ZZZ0013</td>
        <td>2019/11/19</td>
        <td>881234569</td>
        <td>33</td>
        <td>B 林業・狩猟業</td>
        <td>06 林業</td>
        <td>02 ～1億円</td>
        <td></td>
        <td></td>
        <td></td>
        <td>77</td>
        <td>1</td>
        <td>1</td>
        <td>1</td>
        <td>31</td>
        <td>3</td>
        <td>2</td>
        <td>20</td>
        <td>12</td>
        <td>1</td>
        <td></td>
        <td></td>
        <td></td>
        <td>135</td>
        <td>33123456789</td>
        <td>13</td>
        <td>1</td>
        <td>66547891231</td>
        <td>1</td>
        <td>4</td>
        <td></td>
        <td>1598</td>
        <td>3</td>
        <td></td>
        <td>2</td>
        <td>97978521</td>
        <td></td>
        <td>32123</td>
        <td>32658</td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td>3</td>
        <td>3</td>
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
        <td></td>
        <td></td>

      </tr>
   <tr>
      <td class="col-lg-2 col-sm-4 col-xs-6 col-6 mb-2 text-center"><a href="{{url('/office')}}" target="_blank" class="btn btn-warning btn-m-view " style="width: 100%;background-color: #87ceeb!important;border:1px solid #87ceeb!important;"><i class="fas fa-plus-circle" style="margin-right:5px;"></i>展開</a>
      </td>
     <td style="width:50px;">
      <a href="#" id="sequenceButton1" class="btn btn-info btn-m-view " style="width: 100%;" data-toggle="modal" data-target="#comp_modal2"><i class="fa fa-folder-open" aria-hidden="true" style="margin-right: 5px;"></i>詳細</a>
     </td>

        <td>456789</td>
        <td>株式会社寺岡製作所</td>
        <td>寺岡</td>
        <td>テラオカセイサクジョ</td>
        <td></td>
        <td>0</td>
        <td></td>
        <td>ZZZ0014</td>
        <td>2019/11/19</td>
        <td>881234560</td>
        <td>44</td>
        <td>B 林業・狩猟業</td>
        <td>07 狩猟業</td>
        <td></td>
        <td>03 ～3億円</td>
        <td></td>
        <td></td>
        <td></td>
        <td>66</td>
        <td>1</td>
        <td>1</td>
        <td>2</td>
        <td>31</td>
        <td>11</td>
        <td>3</td>
        <td>25</td>
        <td>12</td>
        <td>2</td>
        <td></td>
        <td></td>
        <td></td>
        <td>145</td>
        <td>44123456789</td>
        <td>14</td>
        <td>2</td>
        <td>14785236987</td>
        <td>2</td>
        <td>1</td>
        <td></td>
        <td>1679</td>
        <td>1</td>
        <td></td>
        <td>2</td>
        <td>36365987</td>
        <td></td>
        <td>78987</td>
        <td>78542</td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td>4</td>
        <td>2</td>
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
        <td></td>
        <td></td>

      </tr>

       <tr>
      <td class="col-lg-2 col-sm-4 col-xs-6 col-6 mb-2 text-center"><a href="{{url('/office')}}" target="_blank" class="btn btn-warning btn-m-view " style="width: 100%;background-color: #87ceeb!important;border:1px solid #87ceeb!important;"><i class="fas fa-plus-circle" style="margin-right:5px;"></i>展開</a>
      </td>
      <td style="width:50px;">
      <a href="#" id="sequenceButton1" class="btn btn-info btn-m-view " style="width: 100%;" data-toggle="modal" data-target="#comp_modal2"><i class="fa fa-folder-open" aria-hidden="true" style="margin-right: 5px;"></i>詳細</a>
     </td>

        <td>123457</td>
        <td>信州ハム株式会社</td>
        <td>信州</td>
        <td>シンシュウハム</td>
        <td></td>
        <td>0</td>
        <td></td>
        <td>ZZZ0015</td>
        <td>2019/11/19</td>
        <td>881234561</td>
        <td>55</td>
        <td>C 漁業</td>
        <td>08 漁業</td>
        <td></td>
        <td>04 ～5億円</td>
        <td></td>
        <td></td>
        <td></td>
        <td>55</td>
        <td>1</td>
        <td>1</td>
        <td>2</td>
        <td>31</td>
        <td>11</td>
        <td>1</td>
        <td>30</td>
        <td>12</td>
        <td>1</td>
        <td></td>
        <td></td>
        <td></td>
        <td>165</td>
        <td>55512354678</td>
        <td>15</td>
        <td>1</td>
        <td>25896314789</td>
        <td>1</td>
        <td>4</td>
        <td></td>
        <td>1897</td>
        <td>3</td>
        <td></td>
        <td>2</td>
        <td>48485632</td>
        <td></td>
        <td>74147</td>
        <td>74639</td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td>5</td>
        <td>1</td>
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
        <td></td>
        <td></td>

      </tr>

       <tr>
      <td class="col-lg-2 col-sm-4 col-xs-6 col-6 mb-2 text-center"><a href="{{url('/office')}}" target="_blank" class="btn btn-warning btn-m-view " style="width: 100%;background-color: #87ceeb!important;border:1px solid #87ceeb!important;"><i class="fas fa-plus-circle" style="margin-right:5px;"></i>展開</a>
      </td>
     <td style="width:50px;">
      <a href="#" id="sequenceButton1" class="btn btn-info btn-m-view " style="width: 100%;" data-toggle="modal" data-target="#comp_modal2"><i class="fa fa-folder-open" aria-hidden="true" style="margin-right: 5px;"></i>詳細</a>
     </td>

        <td>123458</td>
        <td>株式会社ジョイ</td>
        <td>ジョイアス</td>
        <td>ジョイアスフーズ</td>
        <td></td>
        <td>0</td>
        <td></td>
        <td>ZZZ0011</td>
        <td>2019/11/19</td>
        <td>881234567</td>
        <td>11</td>
        <td>C 漁業</td>
        <td>09 水産養殖業</td>
        <td></td>
        <td>05 ～10億円</td>
        <td></td>
        <td></td>
        <td></td>
        <td>99</td>
        <td>1</td>
        <td>1</td>
        <td>1</td>
        <td>15</td>
        <td>1</td>
        <td>0</td>
        <td>10</td>
        <td>11</td>
        <td>1</td>
        <td></td>
        <td></td>
        <td></td>
        <td>123</td>
        <td>11234567898</td>
        <td>11</td>
        <td>1</td>
        <td>99874563211</td>
        <td>1</td>
        <td>4</td>
        <td></td>
        <td>1478</td>
        <td>1</td>
        <td></td>
        <td>1</td>
        <td>13134568</td>
        <td></td>
        <td>95159</td>
        <td>95478</td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td>1</td>
        <td>5</td>
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
        <td></td>
        <td></td>

      </tr>

       <tr>
      <td class="col-lg-2 col-sm-4 col-xs-6 col-6 mb-2 text-center"><a href="{{url('/office')}}" target="_blank" class="btn btn-warning btn-m-view " style="width: 100%;background-color: #87ceeb!important;border:1px solid #87ceeb!important;"><i class="fas fa-plus-circle" style="margin-right:5px;"></i>展開</a>
      </td>
      <td style="width:50px;">
      <a href="#" id="sequenceButton1" class="btn btn-info btn-m-view " style="width: 100%;" data-toggle="modal" data-target="#comp_modal2"><i class="fa fa-folder-open" aria-hidden="true" style="margin-right: 5px;"></i>詳細</a>
     </td>

        <td>123459</td>
        <td>ロン化成株式会社</td>
        <td>アロン</td>
        <td>アロンカセイ</td>
        <td></td>
        <td>0</td>
        <td></td>
        <td>ZZZ0012</td>
        <td>2019/11/19</td>
        <td>881234568</td>
        <td>22</td>
        <td>D 鉱業</td>
        <td>10 金属鉱業</td>
        <td></td>
        <td>05 ～10億円</td>
        <td></td>
        <td></td>
        <td></td>
        <td>88</td>
        <td>1</td>
        <td>1</td>
        <td>1</td>
        <td>20</td>
        <td>2</td>
        <td>1</td>
        <td>15</td>
        <td>11</td>
        <td>2</td>
        <td></td>
        <td></td>
        <td></td>
        <td>124</td>
        <td>22123456789</td>
        <td>12</td>
        <td>2</td>
        <td>77987654321</td>
        <td>2</td>
        <td>1</td>
        <td></td>
        <td>1236</td>
        <td>2</td>
        <td></td>
        <td>1</td>
        <td>46461236</td>
        <td></td>
        <td>65456</td>
        <td>65521</td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td>2</td>
        <td>4</td>
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
        <td></td>
        <td></td>

      </tr>


       <tr>
      <td class="col-lg-2 col-sm-4 col-xs-6 col-6 mb-2 text-center"><a href="{{url('/office')}}" target="_blank" class="btn btn-warning btn-m-view " style="width: 100%;background-color: #87ceeb!important;border:1px solid #87ceeb!important;"><i class="fas fa-plus-circle" style="margin-right:5px;"></i>展開</a>
      </td>
      <td style="width:50px;">
      <a href="#" id="sequenceButton1" class="btn btn-info btn-m-view " style="width: 100%;" data-toggle="modal" data-target="#comp_modal2"><i class="fa fa-folder-open" aria-hidden="true" style="margin-right: 5px;"></i>詳細</a>
     </td>

        <td>123460</td>
        <td>株式会社ミスミ</td>
        <td>ミスミ</td>
        <td>ミスミグループホンシャ</td>
        <td></td>
        <td>0</td>
        <td></td>
        <td>ZZZ0013</td>
        <td>2019/11/19</td>
        <td>881234569</td>
        <td>33</td>
        <td>D 鉱業</td>
        <td>11 石炭・亜炭鉱業 </td>
        <td></td>
        <td>06 ～100億円</td>
        <td></td>
        <td></td>
        <td></td>
        <td>77</td>
        <td>1</td>
        <td>1</td>
        <td>1</td>
        <td>31</td>
        <td>3</td>
        <td>2</td>
        <td>20</td>
        <td>12</td>
        <td>1</td>
        <td></td>
        <td></td>
        <td></td>
        <td>135</td>
        <td>33123456789</td>
        <td>13</td>
        <td>1</td>
        <td>66547891231</td>
        <td>1</td>
        <td>4</td>
        <td></td>
        <td>1598</td>
        <td>3</td>
        <td></td>
        <td>2</td>
        <td>97978521</td>
        <td></td>
        <td>32123</td>
        <td>32658</td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td>3</td>
        <td>3</td>
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
        <td></td>
        <td></td>

      </tr>

       <tr>
      <td class="col-lg-2 col-sm-4 col-xs-6 col-6 mb-2 text-center"><a href="{{url('/office')}}" target="_blank" class="btn btn-warning btn-m-view " style="width: 100%;background-color: #87ceeb!important;border:1px solid #87ceeb!important;"><i class="fas fa-plus-circle" style="margin-right:5px;"></i>展開</a>
      </td>
      <td style="width:50px;">
      <a href="#" id="sequenceButton1" class="btn btn-info btn-m-view " style="width: 100%;" data-toggle="modal" data-target="#comp_modal2"><i class="fa fa-folder-open" aria-hidden="true" style="margin-right: 5px;"></i>詳細</a>
     </td>

        <td>123461</td>
        <td>株式会社寺岡</td>
        <td>寺岡</td>
        <td>テラオカセイサクジョ</td>
        <td></td>
        <td>0</td>
        <td></td>
        <td>ZZZ0014</td>
        <td>2019/11/19</td>
        <td>881234560</td>
        <td>44</td>
        <td>D 鉱業</td>
        <td>12 原油・天然ガス鉱業</td>
        <td></td>
        <td>07 100億円～</td>
        <td></td>
        <td></td>
        <td></td>
        <td>66</td>
        <td>1</td>
        <td>1</td>
        <td>2</td>
        <td>31</td>
        <td>11</td>
        <td>3</td>
        <td>25</td>
        <td>12</td>
        <td>2</td>
        <td></td>
        <td></td>
        <td></td>
        <td>145</td>
        <td>44123456789</td>
        <td>14</td>
        <td>2</td>
        <td>14785236987</td>
        <td>2</td>
        <td>1</td>
        <td></td>
        <td>1679</td>
        <td>1</td>
        <td></td>
        <td>2</td>
        <td>36365987</td>
        <td></td>
        <td>78987</td>
        <td>78542</td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td>4</td>
        <td>2</td>
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
        <td></td>
        <td></td>

      </tr>


       <tr>
      <td class="col-lg-2 col-sm-4 col-xs-6 col-6 mb-2 text-center"><a href="{{url('/office')}}" target="_blank" class="btn btn-warning btn-m-view " style="width: 100%;background-color: #87ceeb!important;border:1px solid #87ceeb!important;"><i class="fas fa-plus-circle" style="margin-right:5px;"></i>展開</a>
      </td>
     <td style="width:50px;">
      <a href="#" id="sequenceButton1" class="btn btn-info btn-m-view " style="width: 100%;" data-toggle="modal" data-target="#comp_modal2"><i class="fa fa-folder-open" aria-hidden="true" style="margin-right: 5px;"></i>詳細</a>
     </td>

        <td>123462</td>
        <td>ハム株式会社</td>
        <td>信州</td>
        <td>シンシュウハム</td>
        <td></td>
        <td>0</td>
        <td></td>
        <td>ZZZ0015</td>
        <td>2019/11/19</td>
        <td>881234561</td>
        <td>55</td>
        <td>D 鉱業</td>
        <td>13 非金属鉱業</td>
        <td></td>
        <td>03 ～3億円</td>
        <td></td>
        <td></td>
        <td></td>
        <td>55</td>
        <td>1</td>
        <td>1</td>
        <td>2</td>
        <td>31</td>
        <td>11</td>
        <td>0</td>
        <td>30</td>
        <td>12</td>
        <td>1</td>
        <td></td>
        <td></td>
        <td></td>
        <td>165</td>
        <td>55512354678</td>
        <td>15</td>
        <td>1</td>
        <td>25896314789</td>
        <td>1</td>
        <td>4</td>
        <td></td>
        <td>1897</td>
        <td>3</td>
        <td></td>
        <td>2</td>
        <td>48485632</td>
        <td></td>
        <td>74147</td>
        <td>74639</td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td>5</td>
        <td>1</td>
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
        <td></td>
        <td></td>

      </tr>

       <tr>
      <td class="col-lg-2 col-sm-4 col-xs-6 col-6 mb-2 text-center"><a href="{{url('/office')}}" target="_blank" class="btn btn-warning btn-m-view " style="width: 100%;background-color: #87ceeb!important;border:1px solid #87ceeb!important;"><i class="fas fa-plus-circle" style="margin-right:5px;"></i>展開</a>
      </td>
      <td style="width:50px;">
      <a href="#" id="sequenceButton1" class="btn btn-info btn-m-view " style="width: 100%;" data-toggle="modal" data-target="#comp_modal2"><i class="fa fa-folder-open" aria-hidden="true" style="margin-right: 5px;"></i>詳細</a>
     </td>

        <td>123456</td>
        <td>株式会社ジョイアス・フーズ</td>
        <td>ジョイアス</td>
        <td>ジョイアスフーズ</td>
        <td></td>
        <td>0</td>
        <td></td>
        <td>ZZZ0011</td>
        <td>2019/11/19</td>
        <td>881234567</td>
        <td>11</td>
        <td>E 建設業</td>
        <td>15 職別工事業</td>
        <td></td>
        <td>04 ～5億円</td>
        <td></td>
        <td></td>
        <td></td>
        <td>99</td>
        <td>1</td>
        <td>1</td>
        <td>1</td>
        <td>15</td>
        <td>1</td>
        <td>0</td>
        <td>10</td>
        <td>11</td>
        <td>1</td>
        <td></td>
        <td></td>
        <td></td>
        <td>123</td>
        <td>11234567898</td>
        <td>11</td>
        <td>1</td>
        <td>99874563211</td>
        <td>1</td>
        <td>4</td>
        <td></td>
        <td>1478</td>
        <td>1</td>
        <td></td>
        <td>1</td>
        <td>13134568</td>
        <td></td>
        <td>95159</td>
        <td>95478</td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td>1</td>
        <td>5</td>
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
        <td></td>
        <td></td>

      </tr>

       <tr>
      <td class="col-lg-2 col-sm-4 col-xs-6 col-6 mb-2 text-center"><a href="{{url('/office')}}" target="_blank" class="btn btn-warning btn-m-view " style="width: 100%;background-color: #87ceeb!important;border:1px solid #87ceeb!important;"><i class="fas fa-plus-circle" style="margin-right:5px;"></i>展開</a>
      </td>
      <td style="width:50px;">
      <a href="#" id="sequenceButton1" class="btn btn-info btn-m-view " style="width: 100%;" data-toggle="modal" data-target="#comp_modal2"><i class="fa fa-folder-open" aria-hidden="true" style="margin-right: 5px;"></i>詳細</a>
     </td>

        <td>234567</td>
        <td>アロン化成株式会社</td>
        <td>アロン</td>
        <td>アロンカセイ</td>
        <td></td>
        <td>0</td>
        <td></td>
        <td>ZZZ0012</td>
        <td>2019/11/19</td>
        <td>881234568</td>
        <td>22</td>
        <td>E 建設業</td>
        <td>16 総合工事業</td>
        <td></td>
        <td>05 ～10億円</td>
        <td></td>
        <td></td>
        <td></td>
        <td>88</td>
        <td>1</td>
        <td>1</td>
        <td>2</td>
        <td>20</td>
        <td>2</td>
        <td>1</td>
        <td>15</td>
        <td>11</td>
        <td>2</td>
        <td></td>
        <td></td>
        <td></td>
        <td>124</td>
        <td>22123456789</td>
        <td>12</td>
        <td>2</td>
        <td>77987654321</td>
        <td>2</td>
        <td>1</td>
        <td></td>
        <td>1236</td>
        <td>2</td>
        <td></td>
        <td>1</td>
        <td>46461236</td>
        <td></td>
        <td>65456</td>
        <td>65521</td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td>2</td>
        <td>4</td>
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
        <td></td>
        <td></td>

      </tr>

       <tr>
      <td class="col-lg-2 col-sm-4 col-xs-6 col-6 mb-2 text-center"><a href="{{url('/office')}}" target="_blank" class="btn btn-warning btn-m-view " style="width: 100%;background-color: #87ceeb!important;border:1px solid #87ceeb!important;"><i class="fas fa-plus-circle" style="margin-right:5px;"></i>展開</a>
      </td>
      <td style="width:50px;">
      <a href="#" id="sequenceButton1" class="btn btn-info btn-m-view " style="width: 100%;" data-toggle="modal" data-target="#comp_modal2"><i class="fa fa-folder-open" aria-hidden="true" style="margin-right: 5px;"></i>詳細</a>
     </td>

        <td>345678</td>
        <td>株式会社ミスミグループ本社</td>
        <td>ミスミ</td>
        <td>ミスミグループホンシャ</td>
        <td></td>
        <td>0</td>
        <td></td>
        <td>ZZZ0013</td>
        <td>2019/11/19</td>
        <td>881234569</td>
        <td>33</td>
        <td>E 建設業</td>
        <td>17 設備工事業</td>
        <td></td>
        <td>05 ～10億円</td>
        <td></td>
        <td></td>
        <td></td>
        <td>77</td>
        <td>1</td>
        <td>1</td>
        <td>1</td>
        <td>31</td>
        <td>3</td>
        <td>2</td>
        <td>20</td>
        <td>12</td>
        <td>1</td>
        <td></td>
        <td></td>
        <td></td>
        <td>135</td>
        <td>33123456789</td>
        <td>13</td>
        <td>1</td>
        <td>66547891231</td>
        <td>1</td>
        <td>4</td>
        <td></td>
        <td>1598</td>
        <td>3</td>
        <td></td>
        <td>2</td>
        <td>97978521</td>
        <td></td>
        <td>32123</td>
        <td>32658</td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td>3</td>
        <td>3</td>
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
        <td></td>
        <td></td>

      </tr>

       <tr>
      <td class="col-lg-2 col-sm-4 col-xs-6 col-6 mb-2 text-center"><a href="{{url('/office')}}" target="_blank" class="btn btn-warning btn-m-view " style="width: 100%;background-color: #87ceeb!important;border:1px solid #87ceeb!important;"><i class="fas fa-plus-circle" style="margin-right:5px;"></i>展開</a>
      </td>
     <td style="width:50px;">
      <a href="#" id="sequenceButton1" class="btn btn-info btn-m-view " style="width: 100%;" data-toggle="modal" data-target="#comp_modal2"><i class="fa fa-folder-open" aria-hidden="true" style="margin-right: 5px;"></i>詳細</a>
     </td>

        <td>456789</td>
        <td>株式会社寺岡製作所</td>
        <td>寺岡</td>
        <td>テラオカセイサクジョ</td>
        <td></td>
        <td>0</td>
        <td></td>
        <td>ZZZ0014</td>
        <td>2019/11/19</td>
        <td>881234560</td>
        <td>44</td>
        <td>F 製造業</td>
        <td>19 武器製造業</td>
        <td>01 製造業</td>
        <td>03 ～3億円</td>
        <td></td>
        <td></td>
        <td></td>
        <td>66</td>
        <td>1</td>
        <td>1</td>
        <td>2</td>
        <td>31</td>
        <td>11</td>
        <td>3</td>
        <td>25</td>
        <td>12</td>
        <td>2</td>
        <td></td>
        <td></td>
        <td></td>
        <td>145</td>
        <td>44123456789</td>
        <td>14</td>
        <td>2</td>
        <td>14785236987</td>
        <td>2</td>
        <td>1</td>
        <td></td>
        <td>1679</td>
        <td>1</td>
        <td></td>
        <td>2</td>
        <td>36365987</td>
        <td></td>
        <td>78987</td>
        <td>78542</td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td>4</td>
        <td>2</td>
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
        <td></td>
        <td></td>

      </tr>

       <tr>
      <td class="col-lg-2 col-sm-4 col-xs-6 col-6 mb-2 text-center"><a href="{{url('/office')}}" target="_blank" class="btn btn-warning btn-m-view " style="width: 100%;background-color: #87ceeb!important;border:1px solid #87ceeb!important;"><i class="fas fa-plus-circle" style="margin-right:5px;"></i>展開</a>
      </td>
      <td style="width:50px;">
      <a href="#" id="sequenceButton1" class="btn btn-info btn-m-view " style="width: 100%;" data-toggle="modal" data-target="#comp_modal2"><i class="fa fa-folder-open" aria-hidden="true" style="margin-right: 5px;"></i>詳細</a>
     </td>

        <td>123457</td>
        <td>信州ハム株式会社</td>
        <td>信州</td>
        <td>シンシュウハム</td>
        <td></td>
        <td>0</td>
        <td></td>
        <td>ZZZ0015</td>
        <td>2019/11/19</td>
        <td>881234561</td>
        <td>55</td>
        <td>F 製造業</td>
        <td>20 食料品・資料・飲料製造業</td>
        <td>01 製造業</td>
        <td>02 ～1億円</td>
        <td></td>
        <td></td>
        <td></td>
        <td>55</td>
        <td>1</td>
        <td>1</td>
        <td>2</td>
        <td>31</td>
        <td>11</td>
        <td>1</td>
        <td>30</td>
        <td>12</td>
        <td>1</td>
        <td></td>
        <td></td>
        <td></td>
        <td>165</td>
        <td>55512354678</td>
        <td>15</td>
        <td>1</td>
        <td>25896314789</td>
        <td>1</td>
        <td>4</td>
        <td></td>
        <td>1897</td>
        <td>3</td>
        <td></td>
        <td>2</td>
        <td>48485632</td>
        <td></td>
        <td>74147</td>
        <td>74639</td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td>5</td>
        <td>1</td>
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
        <td></td>
        <td></td>

      </tr>

       <tr>
      <td class="col-lg-2 col-sm-4 col-xs-6 col-6 mb-2 text-center"><a href="{{url('/office')}}" target="_blank" class="btn btn-warning btn-m-view " style="width: 100%;background-color: #87ceeb!important;border:1px solid #87ceeb!important;"><i class="fas fa-plus-circle" style="margin-right:5px;"></i>展開</a>
      </td>
      <td style="width:50px;">
      <a href="#" id="sequenceButton1" class="btn btn-info btn-m-view " style="width: 100%;" data-toggle="modal" data-target="#comp_modal2"><i class="fa fa-folder-open" aria-hidden="true" style="margin-right: 5px;"></i>詳細</a>
     </td>

        <td>123458</td>
        <td>株式会社ジョイ</td>
        <td>ジョイアス</td>
        <td>ジョイアスフーズ</td>
        <td></td>
        <td>0</td>
        <td></td>
        <td>ZZZ0011</td>
        <td>2019/11/19</td>
        <td>881234567</td>
        <td>11</td>
        <td>F 製造業</td>
        <td>21 たばこ製造業</td>
        <td>01 製造業</td>
        <td>01 ～5000万円</td>
        <td></td>
        <td></td>
        <td></td>
        <td>99</td>
        <td>1</td>
        <td>1</td>
        <td>1</td>
        <td>15</td>
        <td>1</td>
        <td>0</td>
        <td>10</td>
        <td>11</td>
        <td>1</td>
        <td></td>
        <td></td>
        <td></td>
        <td>123</td>
        <td>11234567898</td>
        <td>11</td>
        <td>1</td>
        <td>99874563211</td>
        <td>1</td>
        <td>4</td>
        <td></td>
        <td>1478</td>
        <td>1</td>
        <td></td>
        <td>1</td>
        <td>13134568</td>
        <td></td>
        <td>95159</td>
        <td>95478</td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td>1</td>
        <td>5</td>
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
        <td></td>
        <td></td>

      </tr>

       <tr>
      <td class="col-lg-2 col-sm-4 col-xs-6 col-6 mb-2 text-center"><a href="{{url('/office')}}" target="_blank" class="btn btn-warning btn-m-view " style="width: 100%;background-color: #87ceeb!important;border:1px solid #87ceeb!important;"><i class="fas fa-plus-circle" style="margin-right:5px;"></i>展開</a>
      </td>
      <td style="width:50px;">
      <a href="#" id="sequenceButton1" class="btn btn-info btn-m-view " style="width: 100%;" data-toggle="modal" data-target="#comp_modal2"><i class="fa fa-folder-open" aria-hidden="true" style="margin-right: 5px;"></i>詳細</a>
     </td>

        <td>123459</td>
        <td>ロン化成株式会社</td>
        <td>アロン</td>
        <td>アロンカセ</td>
        <td></td>
        <td>0</td>
        <td></td>
        <td>ZZZ0012</td>
        <td>2019/11/19</td>
        <td>881234568</td>
        <td>22</td>
        <td>F 製造業</td>
        <td>22 繊維工業</td>
        <td>01 製造業</td>
        <td>04 ～5億円</td>
        <td></td>
        <td></td>
        <td></td>
        <td>88</td>
        <td>1</td>
        <td>1</td>
        <td>1</td>
        <td>20</td>
        <td>2</td>
        <td>1</td>
        <td>15</td>
        <td>11</td>
        <td>2</td>
        <td></td>
        <td></td>
        <td></td>
        <td>124</td>
        <td>22123456789</td>
        <td>12</td>
        <td>2</td>
        <td>77987654321</td>
        <td>2</td>
        <td>1</td>
        <td></td>
        <td>1236</td>
        <td>2</td>
        <td></td>
        <td>1</td>
        <td>46461236</td>
        <td></td>
        <td>65456</td>
        <td>65521</td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td>2</td>
        <td>4</td>
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
        <td></td>
        <td></td>

      </tr>

      <tr>
      <td class="col-lg-2 col-sm-4 col-xs-6 col-6 mb-2 text-center"><a href="{{url('/office')}}" target="_blank" class="btn btn-warning btn-m-view " style="width: 100%;background-color: #87ceeb!important;border:1px solid #87ceeb!important;"><i class="fas fa-plus-circle" style="margin-right:5px;"></i>展開
</a>
      </td>
      <td style="width:50px;">
      <a href="#" id="sequenceButton1" class="btn btn-info btn-m-view " style="width: 100%;" data-toggle="modal" data-target="#comp_modal2"><i class="fa fa-folder-open" aria-hidden="true" style="margin-right: 5px;"></i>詳細</a>
     </td>

        <td>123460
</td>
        <td>株式会社ミスミ


</td>
        <td>ミスミ


</td>
        <td>ミスミグループホンシャ


</td>
        <td></td>
        <td>0</td>
        <td></td>
        <td>ZZZ0013
</td>
        <td>2019/11/19
</td>
        <td>881234569

</td>
        <td>33</td>
        <td>F 製造業

</td>
        <td>23 成人男子・少年服製造業


</td>
        <td>01 製造業


</td>
        <td>02 ～1億円


</td>
        <td></td>
        <td></td>
        <td></td>
        <td>77
</td>
        <td>1</td>
        <td>1</td>
        <td>1</td>
        <td>31</td>
        <td>3</td>
        <td>2</td>
        <td>20</td>
        <td>12</td>
        <td>2</td>
        <td></td>
        <td></td>
        <td></td>
        <td>135</td>
        <td>33123456789</td>
        <td>14</td>
        <td>2</td>
        <td>66547891231
</td>
        <td>1</td>
        <td>4</td>
        <td></td>
        <td>1598</td>
        <td>3</td>
        <td></td>
        <td>2</td>
        <td>97978521
</td>
        <td></td>
        <td>32123
</td>
        <td>32658

</td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td>3</td>
        <td>3</td>
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
        <td></td>
        <td></td>

      </tr>


 <tr>
      <td class="col-lg-2 col-sm-4 col-xs-6 col-6 mb-2 text-center"><a href="{{url('/office')}}" target="_blank" class="btn btn-warning btn-m-view " style="width: 100%;background-color: #87ceeb!important;border:1px solid #87ceeb!important;"><i class="fas fa-plus-circle" style="margin-right:5px;"></i>展開
</a>
      </td>
      <td style="width:50px;">
      <a href="#" id="sequenceButton1" class="btn btn-info btn-m-view " style="width: 100%;" data-toggle="modal" data-target="#comp_modal2"><i class="fa fa-folder-open" aria-hidden="true" style="margin-right: 5px;"></i>詳細</a>
     </td>

        <td>123461
</td>
        <td>株式会社寺岡

</td>
        <td>寺岡

</td>
        <td>テラオカセイサクジョ

</td>
        <td></td>
        <td>0</td>
        <td></td>
        <td>ZZZ0014
</td>
        <td>2019/11/19
</td>
        <td>881234560
</td>
        <td>44</td>
        <td>F 製造業
</td>
        <td>24 木材・木製品製造業

</td>
        <td>01 製造業

</td>
        <td>05 ～10億円

</td>
        <td></td>
        <td></td>
        <td></td>
        <td>66
</td>
        <td>1</td>
        <td>1</td>
        <td>2</td>
        <td>31</td>
        <td>11</td>
        <td>3</td>
        <td>25</td>
        <td>12</td>
        <td>2</td>
        <td></td>
        <td></td>
        <td></td>

        <td>145</td>
        <td>44123456789</td>
        <td>14</td>
        <td>2</td>
        <td>14785236987</td>
        <td>2</td>
        <td>1</td>
        <td></td>
        <td>1679</td>
        <td>1</td>
        <td></td>
        <td>2</td>
        <td>36365987</td>
        <td></td>
        <td>78987</td>
        <td>78542
</td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td>4</td>
        <td>2</td>
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
        <td></td>
        <td></td>

      </tr>



       <tr>
      <td class="col-lg-2 col-sm-4 col-xs-6 col-6 mb-2 text-center"><a href="{{url('/office')}}" target="_blank" class="btn btn-warning btn-m-view " style="width: 100%;background-color: #87ceeb!important;border:1px solid #87ceeb!important;"><i class="fas fa-plus-circle" style="margin-right:5px;"></i>展開
</a>
      </td>
     <td style="width:50px;">
      <a href="#" id="sequenceButton1" class="btn btn-info btn-m-view " style="width: 100%;" data-toggle="modal" data-target="#comp_modal2"><i class="fa fa-folder-open" aria-hidden="true" style="margin-right: 5px;"></i>詳細</a>
     </td>

        <td>123462
</td>
        <td>ハム株式会社
</td>
        <td>信州
</td>
        <td>シンシュウハム
</td>
        <td></td>
        <td>0</td>
        <td></td>
        <td>ZZZ0015
</td>
        <td>2019/11/19
</td>
        <td>881234561
</td>
        <td>55</td>
        <td>F 製造業
</td>
        <td>25 家具・装備品製造業
</td>
        <td>01 製造業
</td>
        <td>06 ～100億円
</td>
        <td></td>
        <td></td>
        <td></td>
        <td>55
</td>
        <td>1</td>
        <td>1</td>
        <td>2</td>
        <td>31</td>
        <td>11</td>
        <td>0</td>
        <td>30</td>
        <td>12</td>
        <td>1</td>
        <td></td>
        <td></td>
        <td></td>

        <td>165</td>
        <td>55512354678</td>
        <td>15</td>
        <td>1</td>
        <td>25896314789</td>
        <td>1</td>
        <td>4</td>
        <td></td>
        <td>1897</td>
        <td>3</td>
        <td></td>
        <td>2</td>
        <td>48485632</td>
        <td></td>
        <td>74147</td>
        <td>74639
</td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td>5</td>
        <td>1</td>
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

<div class="modal fade"  id="product_code_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" style="" role="document">
            <div class="modal-content">
                  <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">個人マスタ　　(登録)</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                <div class="modal-body">
                    <div class="development_page_top_table heading_mt" style="margin:0 2px;">

                        <!--=======================Modal 1 button start ======================-->

                        <div class="row titlebr" style="margin-bottom: 15px;">
  <div class="col-6">
    <table class="dev_tble_button">
      <tbody>
        <tr class="marge_in">
           <td class="" style="padding-left: 0px!important;width: 70px!important;">
              <a class="btn btn-info scroll" style="">戻る</a>
           </td>
           <td class="" style="padding-left: 10px!important;">
              <a class="btn btn-info scroll"style="" >登録</a>
           </td>
        </tr>
      </tbody>
    </table>

  </div>
  <div class="col-6">
    <table class="dev_tble_button">
      <tbody>
        <tr class="marge_in">
            <td class="td_button_p"></td>
            <td class="td_button_p">
              <span>更新者</span>
            </td>
            <td class="td_button_p"></td>
            <td class="td_button_p">
              <span>275</span>
            </td>
            <td class="td_button_p"></td>
            <td class="td_button_p">
             小川卓也
            </td>
        </tr>
      </tbody>
    </table>

  </div>
</div>
</div>

<!--=======================Modal 1 button wrapper end ======================-->


  <div class="table_wrap order_table">
  <!-- --------------- Modal 1 table 1 ------------------>
<div class="row">
  <div class="col-6">

    <table class="table table-striped table-bordered">
    <tbody>

       <tr class="thzero table_hover2 grid">
            <td class="raw_color" style="width: 106px!important;">個人ID</td>
            <td></td>
        </tr>


    </tbody>
  </table>

</div>
</div>
  <!-- ----------------- Modal 1 table 2 --------------------->

<div class="row">
  <div class="col-12">
    <table class="table table-striped table-bordered">
    <tbody>

       <tr class="thzero table_hover2 grid">
            <td class="raw_color" style="width: 106px!important;">会社ID</td>
            <td style="width: 106px!important;"></td>
            <td></td>
        </tr>
      <tr class="thzero table_hover2 grid">
            <td class="raw_color" style="width: 106px!important;">事業所ID</td>
            <td style="width: 106px!important;"></td>
            <td></td>
        </tr>
    </tbody>
  </table>
  <!------------------Modal 1 table 3------------->
   <table class="table table-striped table-bordered">
    <tbody>

       <tr class="thzero table_hover2 grid">
            <td class="raw_color" style="width: 106px!important;">部署</td>
            <td></td>
        </tr>
      <tr class="thzero table_hover2 grid">
            <td class="raw_color" style="width: 100px;">役職</td>
            <td></td>
        </tr>
        <tr class="thzero table_hover2 grid">
            <td class="raw_color" style="width: 100px;">個人名</td>
            <td></td>
        </tr>

    </tbody>
  </table>
</div>
</div>
<!------------------------Modal 1 table4-------------------------->
<div class="row">
  <div class="col-12">
    <table class="table table-striped table-bordered">
    <tbody>

       <tr class="thzero table_hover2 grid">
            <td class="raw_color" style="width: 106px!important;">入力区分
         </td>

            <td style="width: 70px!important;"><div class="">

              <select class="form-control" id="exampleFormControlSelect1">
                <option>1</option>
                <option>2</option>
                <option>3</option>
                <option>4</option>
                <option>5</option>
              </select>
            </div></td>
            <td></td>

        </tr>


    </tbody>
  </table>
</div>
</div>
  <!--------------------------Modal 1 table5------------------------->
  <div class="row">
  <div class="col-6">

    <table class="table table-striped table-bordered">
    <tbody>

       <tr class="thzero table_hover2 grid">
            <td class="raw_color" style="width: 106px!important;">メールアドレス</td>
            <td></td>
        </tr>


    </tbody>
  </table>

</div>
</div>
<!--------------------------Modal 1 table6------------------------->
 <div class="row">
  <div class="col-6">

    <table class="table table-striped table-bordered">
    <tbody>

        <tr class="thzero table_hover2 grid">
            <td class="raw_color" style="width: 106px!important;">TEL</td>
            <td></td>
        </tr>

        <tr class="thzero table_hover2 grid">
            <td class="raw_color" style="width: 106px!important;">FAX</td>
            <td></td>
        </tr>


    </tbody>
  </table>

</div>
</div>
<!--------------------------Modal 1 table7------------------------->
 <div class="row">
  <div class="col-6">

    <table class="table table-striped table-bordered">
    <tbody>

       <tr class="thzero table_hover2 grid">
            <td class="raw_color" style="width: 106px!important;">社内備考</td>
            <td></td>
        </tr>


    </tbody>
  </table>

</div>
</div>
<!--------------------------Modal 1 table8------------------------->
<div class="row">
  <div class="col-12">
    <table class="table table-striped table-bordered">
    <tbody>

       <tr class="thzero table_hover2 grid">
            <td class="raw_color" style="width: 106px!important;">案内停止フラグ
         </td>

            <td style="width: 70px!important;"><div class="">

              <select class="form-control" id="exampleFormControlSelect1">
                <option>1</option>
                <option>2</option>
                <option>3</option>
                <option>4</option>
                <option>5</option>
              </select>
            </div></td>
            <td></td>


        </tr>
           <tr class="thzero table_hover2 grid">
            <td class="raw_color" style="width: 106px!important;">キーマンフラグ
         </td>

            <td style="width: 70px!important;"><div class="">

              <select class="form-control" id="exampleFormControlSelect1">
                <option>1</option>
                <option>2</option>
                <option>3</option>
                <option>4</option>
                <option>5</option>
              </select>
            </div></td>
            <td></td>


        </tr>


    </tbody>
  </table>
</div>
</div>
<!--------------------------Modal 1 table9------------------------->
<div class="row">
  <div class="col-12">
    <table class="table table-striped table-bordered">
    <tbody>

       <tr class="thzero table_hover2 grid">
            <td class="raw_color" style="width: 106px!important;">贈り物フラグ１
         </td>

            <td style="width: 70px!important;"><div class="">

              <select class="form-control" id="exampleFormControlSelect1">
                <option>1</option>
                <option>2</option>
                <option>3</option>
                <option>4</option>
                <option>5</option>
              </select>
            </div></td>
            <td></td>


        </tr>
           <tr class="thzero table_hover2 grid">
            <td class="raw_color" style="width: 106px!important;">贈り物フラグ２
         </td>

            <td style="width: 70px!important;"><div class="">

              <select class="form-control" id="exampleFormControlSelect1">
                <option>1</option>
                <option>2</option>
                <option>3</option>
                <option>4</option>
                <option>5</option>
              </select>
            </div></td>
            <td></td>
            </tr>

             <tr class="thzero table_hover2 grid">
            <td class="raw_color" style="width: 106px!important;">贈り物フラグ３
         </td>

            <td style="width: 70px!important;"></td>
            <td></td>
             </tr>

              <tr class="thzero table_hover2 grid">
            <td class="raw_color" style="width: 106px!important;">贈り物フラグ４
         </td>

            <td style="width: 70px!important;"></td>
            <td></td>
            </tr>



    </tbody>
  </table>
</div>
</div>

<!--------------------------Modal 1 all table end------------------------->

    <div class="modal-footer">
                    <button type="button" class="btn btn-info" data-dismiss="modal">閉じる </button>
                </div>
            </div>
        </div>
    </div>

</div>
</div>
</div>


<!--===================================MODAL 1 END==============================-->

<!--===================================MODAL 2 START==============================-->



</div>


<!--------------------------Modal 3 comp1  table start------------------------->




<div class="modal fade"data-keyboard="false" data-backdrop="static" id="comp_modal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" style="max-width: 1050px;z-index: 1052;" role="document">
            <div class="modal-content">
                  <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">会社マスタ</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                      </button>
                    </div>
                <div class="modal-body">
                    <div class="development_page_top_table heading_mt" style="margin:0 2px;">

                        <!--=======================Modal 2 button start ======================-->

                        <div class="row titlebr" style="margin-bottom: 15px;">
                     <div class="col-lg-6"></div>
  <div class="col-lg-6">
    <table class="dev_tble_button" style="float: right;margin-right: 14px;">
      <tbody>
        <tr class="marge_in">
           <td class="" style="padding-left: 0px!important;width: 70px!important; ">
<!--                <a class="btn btn-info scroll" id="" style="background-color: #3e6ec1!important;"data-toggle="modal" data-target="#">変更
</a> -->

           </td>

        <td class="" style="padding-left: 10px!important;">

<a href="#" class="btn btn-info scroll" style="float: right;"><i class="fa fa-save" aria-hidden="true" style="margin-right: 5px;"></i>保存</a>


           </td>
                  <td class="" style="padding-left: 10px!important;">

             <a class="btn btn-info scroll" style="background-color: #3e6ec1!important;"data-toggle="modal" data-target="#"><i class="fa fa-print" style="margin-right: 7px;">
        </i>印刷
</a>


           </td>
        </tr>
      </tbody>
    </table>

  </div>

</div>
</div>

<!--=======================Modal 2 button wrapper end ======================-->


<div class="container h-100 py-2">
    <ul class="nav nav-tabs " id="myTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link  active show" id="common1-tab" data-toggle="tab" href="#common1" role="tab" aria-controls="common1" aria-selected="true"><b>共通</b>
</a>
        </li>
        <li class="nav-item">
            <a class="nav-link " id="sales_billing1_tab" data-toggle="tab" href="#sales_billing1" role="tab" aria-controls="sales_billing1" aria-selected="false"><b>売上・請求</b>
</a>
        </li>
        <li class="nav-item">
            <a class="nav-link " id="payment1-tab" data-toggle="tab" href="#payment1" role="tab" aria-controls="payment1" aria-selected="false"><b>仕入・支払</b>
</a>
        </li>

    </ul>

    <div class="tab-content">
        <div class="tab-pane h-100 p-3 border active show" id="common1" role="tabpanel" aria-labelledby="common1-tab">
 <div id="input_boxwrap_common1">

        <div class="row mt-1 mb-3">
        <div class="col-lg-12">
            <div class="tbl_product w-100" >
<div class=" row row_data">
<!--       <div class="col-lg-2">
       <div class="margin_t ">
          <span>会社ID <span style="color: red;">※</span></span>
     </div>

  </div> -->
<div class="col-lg-8">

    <div class="outer row">
<!--
           <div class="col-lg-4 d-none">
<input type="text" class="form-control" id="border_input" value="">
        </div> -->

           <div class="col-lg-3 col-md-3">
<div class="m_t">法人マイナンバー</div>
        </div>
  <div class="col-lg-3 col-md-3  ">

<input type="text"  class="input_field form-control" id="border_input" value="" placeholder="999999999">



        </div>
  <div class="col-lg-2 col-md-2">
<div class="m_t">新規 (処理状況)</div>



        </div>
 </div>

  </div>

  </div>


  <div class=" row row_data">
      <div class="col-lg-2 col-md-2">
   <div class="margin_t ">
  <span>会社名<span style="color: red;">※</span></span>
 </div>


  </div>
<div class="col-lg-10 col-md-10">

    <div class="outer row">
           <div class="col-lg-8 ">
          <input type="text" class=" input_field form-control" value="">
        </div>

 </div>

  </div>

  </div>

    <div class=" row row_data">
      <div class="col-lg-2 col-md-2">
   <div class="margin_t ">
  <span>会社名略称</span>
 </div>


  </div>
<div class="col-lg-10 col-md-10">

    <div class="outer row">
           <div class="col-lg-8 col-md-8">
          <input type="text" class=" input_field form-control" value="">
        </div>

 </div>

  </div>

  </div>

    <div class=" row row_data">
      <div class="col-lg-2 col-md-2">
   <div class="margin_t ">
  <span>会社名カナ</span>
 </div>


  </div>
<div class="col-lg-10 col-md-10">

    <div class="outer row">
           <div class="col-lg-8 col-md-8">
          <input type="text" class=" input_field form-control" value="">
        </div>

 </div>

  </div>

  </div>
    <div class=" row row_data">
      <div class="col-lg-2 col-md-2">
   <div class="margin_t ">
  <span>会社名カナ入金消込用
</span>
 </div>


  </div>
<div class="col-lg-10 col-md-10">

    <div class="outer row">
           <div class="col-lg-8 col-md-8">
          <input type="text" class=" input_field form-control" value="">
        </div>

 </div>

  </div>

  </div>

            </div>
          </div>
        </div>

  <div class="row mt-1 mb-3">
        <div class="col-lg-6 col-md-6">
            <div class="tbl_product w-100">


<div class=" row row_data">
      <div class="col-lg-3 col-md-3">
   <div class="margin_t ">
      <span>入力区分</span>
 </div>

  </div>
<div class="col-lg-9 col-md-9">

    <div class="outer row">
           <div class="col-lg-12 col-md-12  ">
<select class="form-control left_select ">
                      <option value="1">0 マスタ索引</option>
                      <option value="1">1 入力可</option>

                  </select>
        </div>

 </div>

  </div>

  </div>




            </div>
          </div>


                  <div class="col-lg-6 col-md-6">
            <div class="tbl_product w-100">


<div class=" row row_data">
      <div class="col-lg-3 col-md-3">
   <div class="margin_t ">
      <span>会計取引先CD</span>
 </div>

  </div>
<div class="col-lg-9 col-md-9">

    <div class="outer row">
           <div class="col-lg-12 col-md-12 ">
<input type="text" class="input_field form-control" value="" placeholder="未使用">
        </div>

 </div>

  </div>

  </div>




            </div>
          </div>
        </div>


          <div class="row mt-1 mb-3">
        <div class="col-lg-7 col-md-7">
            <div class="tbl_product w-100">


<div class=" row row_data">
      <div class="col-lg-4 col-md-4">
   <div class="margin_t ">
      <span>帝国ﾃﾞｰﾀﾊﾞﾝｸ信用録PDF</span>
 </div>

  </div>
<div class="col-lg-8 col-md-8 col-sm-8">

    <div class="outer row">
           <div class="col-lg-9 col-md-9">
<input type="text" class="input_field form-control" value="">
        </div>
      <div class="col-lg-3 col-md-3 pl-0 ">
     <!--    <button type="button" class="btn btn-info" style="margin-top: 2px;width: 100% background-color: #3e6ec1!important;"><i class="fa fa-search" aria-hidden="true" style="margin-right: 5px;"></i></button>
 -->

<div class="input-file-container">
    <input class="input-file" id="my-file" type="file">
    <label tabindex="0" for="my-file" class=" btn btn-info input-file-trigger"><i class="fa fa-search" aria-hidden="true" style="margin-right: 5px;"></i>参照</label>
  </div>


      </div>
 </div>

  </div>

  </div>
<div class=" row row_data">
      <div class="col-lg-4 col-md-4">
   <div class="margin_t ">
      <span>帝国ﾃﾞｰﾀﾊﾞﾝｸ取得年月日</span>
 </div>

  </div>
<div class="col-lg-8 col-md-8">

    <div class="outer row">
           <div class="col-lg-12 col-md-12 ">
    <div class="input-group">
      <input data-format="dd/MM/yyyy hh:mm:ss"id="datepicker1_com" type="text" class="input_field form-control"  autocomplete="off">
  <div class="input-group-append" style="margin-left: 10px;margin-top: 7px;">
<span id="cal_icon1_c" class="fa fa-calendar"></span>
  </div>
</div>
        </div>

 </div>

  </div>

  </div>

<div class=" row row_data">
      <div class="col-lg-4 col-md-4">
   <div class="margin_t ">
      <span>帝国ﾃﾞｰﾀﾊﾞﾝｸ企業CD</span>
 </div>

  </div>
<div class="col-lg-8 col-md-8 ">

    <div class="outer row">
           <div class="col-lg-12 col-md-12">
<input type="text" class="input_field form-control" value="">
        </div>

 </div>

  </div>

  </div>
<div class=" row row_data">
      <div class="col-lg-4 col-md-4">
   <div class="margin_t ">
      <span>帝国ﾃﾞｰﾀﾊﾞﾝｸ評点</span>
 </div>

  </div>
<div class="col-lg-8 col-md-8">

    <div class="outer row">
           <div class="col-lg-12 col-md-12">
<input type="text" class="input_field form-control" value="">
        </div>

 </div>

  </div>

  </div>

  <div class=" row row_data">
      <div class="col-lg-4 col-md-4">
   <div class="margin_t ">
      <span>経済産業省業種区分1
</span>
 </div>

  </div>
<div class="col-lg-8 col-md-8">

    <div class="outer row">
           <div class="col-lg-12 col-md-12  ">
<select class="form-control left_select ">
                      <option value="1">A 農業</option>
                      <option value="1">B 林業、狩. 猟業</option>
                      <option value="1">C 漁業</option>
                      <option value="1">D 鉱業</option>
                      <option value="1">E 建設業</option>
                      <option value="1">F 製造業</option>
                      <option value="1">G 卸売・小売業、飲食店</option>
                      <option value="1">H 金融・保険業</option>
                      <option value="1">I 不動産業</option>
                      <option value="1">J 運輸・通信業</option>
                      <option value="1">K 電機・ガス・水道・熱供給業</option>
                      <option value="1">L サービス業</option>
                      <option value="1">M 公務（他に分類されないもの）</option>
                      <option value="1">N 分類不能の産業</option>

                  </select>
        </div>

 </div>

  </div>

  </div>
    <div class=" row row_data">
      <div class="col-lg-4 col-md-4">
   <div class="margin_t ">
      <span>経済産業省業種区分2</span>
 </div>

  </div>
<div class="col-lg-8 col-md-8">

    <div class="outer row">
           <div class="col-lg-12 col-md-12 ">
<select class="form-control left_select ">
                      <option value="1">01 農業</option>
                      <option value="1">05 農業サービス業</option>
                      <option value="1">06 林業</option>
                      <option value="1">07 狩.猟業</option>
                      <option value="1">08 漁業</option>
                      <option value="1">09 水産養殖業</option>
                      <option value="1">10 金属鉱業</option>
                      <option value="1">11 石炭・亜炭鉱業</option>
                      <option value="1">12 原油・天然ガス鉱業</option>
                      <option value="1">13 非金属鉱業</option>
                      <option value="1">15 職別工事業</option>
                      <option value="1">16 総合工事業</option>
                      <option value="1">17 設備工事業</option>
                      <option value="1">19 武器製造業</option>
                      <option value="1">20食料品・資料・飲料製造業</option>
                      <option value="1">21 たばこ製造業</option>
                      <option value="1">22 繊維工業（衣類・その他の繊維製品を除く）</option>
                      <option value="1">23 成人男子・少年服製造業</option>
                      <option value="1">24 木材・木製品製造業</option>
                      <option value="1">25 家具・装備品製造業</option>
                        <option value="1">26 パルプ・紙・紙加工品製造業</option>
                      <option value="1">27 出版・印刷・同関連産業</option>
                      <option value="1">28 化学工業</option>
                      <option value="1">29 石油製品・石炭製品製造業</option>
                      <option value="1">30 ゴム製品製造業</option>
                      <option value="1">31 皮革・同製品・毛皮製造業</option>
                      <option value="1">32 窯業・土石製品製造業</option>
                      <option value="1">33 鉄鋼業・非鉄金属製造業</option>
                      <option value="1">34 金属製品製造業</option>
                      <option value="1">35 一般機械器具製造業</option>
                        <option value="1">36 電気機械器具製造業</option>
                      <option value="1">37 輸送用機械器具製造業</option>
                      <option value="1">38 精密機械・医療機械器具製造業</option>
                      <option value="1">39 その他の製造業</option>
                      <option value="1">40 卸売業（１）</option>
                      <option value="1">41 卸売業（２）</option>
                      <option value="1">42 代理商・仲立業</option>
                      <option value="1">43 各種商品小売業</option>
                      <option value="1">44 織物・衣服・身の回り品小売業</option>
                      <option value="1">45 飲食料品小売業</option>
                        <option value="1">46 飲食店</option>
                      <option value="1">47 自動車・自転車小売業</option>
                      <option value="1">48 家具・じゅう器・家庭用機械器具小売業</option>
                      <option value="1">49 その他の小売業</option>
                      <option value="1">50 銀行・信託業</option>
                      <option value="1">51 農林水産金融機関</option>
                      <option value="1">52 中小商工・庶民・住民等金融業</option>
                      <option value="1">53 補助的金融業・金融付帯業</option>
                      <option value="1">54 証券業・商品先物取引業</option>
                      <option value="1">55 保険業</option>
                        <option value="1">56 保険媒介代理業・保険サービス業</option>
                      <option value="1">57 投資業</option>
                      <option value="1">59 不動産業</option>
                      <option value="1">61 鉄道業</option>
                      <option value="1">62 道路旅客運送業</option>
                      <option value="1">63 道路貨物運送業</option>
                      <option value="1">64 水運業</option>
                      <option value="1">65 航空運輸業</option>
                      <option value="1">66 倉庫業</option>
                      <option value="1">67 運輸に付帯するサービス業</option>
                        <option value="1">68 郵便業・電気通信業</option>

                  </select>
        </div>

 </div>

  </div>

  </div>
            </div>
          </div>


                  <div class="col-lg-5 col-md-5">
            <div class="tbl_product w-100">


<div class=" row row_data">
      <div class="col-lg-3 col-md-3 ">
   <div class="margin_t ">
      <span>会社分類1</span>
 </div>

  </div>
<div class="col-lg-9 col-md-9 ">

    <div class="outer row">
           <div class="col-lg-12 col-md-12">
<select class="form-control left_select ">
                      <option value="1">01 製造業</option>
                      <option value="1">02 卸売業</option>
                      <option value="1">03 小売業</option>
                       <option value="1">04 サービス業・他</option>

                  </select>
        </div>

 </div>

  </div>

  </div>
<div class=" row row_data">
      <div class="col-lg-3 col-md-3">
   <div class="margin_t ">
      <span>会社分類2</span>
 </div>

  </div>
<div class="col-lg-9 col-md-9">

    <div class="outer row">
           <div class="col-lg-12 col-md-12">
<select class="form-control left_select ">
                      <option value="1">01 ～10億円</option>
                      <option value="1">02 10億円～100億円</option>
                      <option value="1">03 100億円～300億円</option>
                      <option value="1">04 300億円～1000億円</option>
                      <option value="1">05 1000億円～3000億円</option>
                      <option value="1">06 3000億円～</option>
                  </select>
        </div>

 </div>

  </div>

  </div>
<div class=" row row_data">
      <div class="col-lg-3 col-md-3">
   <div class="margin_t ">
      <span>会社分類3</span>
 </div>

  </div>
<div class="col-lg-9 col-md-9">

    <div class="outer row">
           <div class="col-lg-12 col-md-12">
<select class="form-control left_select ">
                      <option value="1">01 1～50人未満</option>
                      <option value="1">02 50～100人未満</option>
                      <option value="1">03 100～500人未満</option>
                      <option value="1">04 500～1000人未満</option>
                      <option value="1">05 1000～5000人未満</option>
                      <option value="1">06 5000人以上</option>
                  </select>
        </div>

 </div>

  </div>

  </div>
<div class=" row row_data">
      <div class="col-lg-3 col-md-3">
   <div class="margin_t ">
      <span>会社分類4</span>
 </div>

  </div>
<div class="col-lg-9 col-md-9">

    <div class="outer row">
           <div class="col-lg-12 col-md-12">
<select class="form-control left_select ">
                      <option value="1">01 ～1000万円</option>
                      <option value="1">02 ～3000万円</option>
                      <option value="1">03 ～1億円</option>
                       <option value="1">04 １億円超</option>
                  </select>
        </div>

 </div>

  </div>

  </div>
<div class=" row row_data">
      <div class="col-lg-3 col-md-3">
   <div class="margin_t ">
      <span>会社分類5</span>
 </div>

  </div>
<div class="col-lg-9 col-md-9">

    <div class="outer row">
           <div class="col-lg-12 col-md-12 ">
<div class="m_t">未使用</div>
        </div>

 </div>

  </div>

  </div>       </div>
          </div>
        </div>
         <div class="row mt-1 mb-3">
        <div class="col-lg-7 col-md-7">
            <div class="tbl_product w-100">


<div class=" row row_data">
      <div class="col-lg-4 col-md-4">
   <div class="margin_t ">
      <span>社内備考</span>
 </div>

  </div>
<div class="col-lg-8 col-md-8">

    <div class="outer row">
           <div class="col-lg-12 col-md-12 ">
<div class="">
  <textarea class="" rows="5" col="50" id="" style="width: 100%;"></textarea>
</div>
        </div>

 </div>

  </div>

  </div>

            </div>
          </div>


          <div class="col-lg-5 col-md-5">
            <div class="tbl_product w-100">

<div class=" row row_data">
      <div class="col-lg-2 col-md-2">
   <div class="margin_t ">
      <span>売 上</span>
 </div>

  </div>
<div class="col-lg-10 col-md-10">

    <div class="outer row">
           <div class="col-lg-3 col-md-3 ">
<input type="text" class="input_field form-control" value="">
        </div>

         <div class="col-lg-5 col-md-5 ">
<div class="m_t">0：なし、1：あり</div>
        </div>

 </div>

  </div>

  </div>
<div class=" row row_data">
      <div class="col-lg-2 col-md-2">
   <div class="margin_t ">
      <span>仕 入</span>
 </div>

  </div>
<div class="col-lg-10 col-md-10">

    <div class="outer row">
           <div class="col-lg-3 col-md-3 ">
<input type="text" class="input_field form-control" onkeydown="lastTab(event)" value="">
        </div>

         <div class="col-lg-5 col-md-5">
<div class="m_t">0：なし、1：あり</div>
        </div>

 </div>

  </div>

  </div>

            </div>
          </div>
        </div>

</div>

</div>


<!-- sales and billing tabbed menu -->

      <div class="tab-pane fade h-100 p-3 border" id="sales_billing1" role="tabpanel" aria-labelledby="sales_billing1_tab">

 <div id="input_boxwrap_sales_billing1">
  <div class="row mt-1 mb-3">
        <div class="col-lg-7 col-md-7 ">
            <div class="tbl_company w-100">

  <div class=" row row_data">
      <div class="col-lg-3 col-md-3">
     <div class="margin_t "><span>
即時区分</span></div>
  </div>
<div class="col-lg-4 col-md-4">


   <div>
<input type="text" class="input_field form-control" value="1">

    </div>
  </div>
  <div class="col-lg-2 col-md-2 d-none">
      <div class="m_t"></div>
  </div>
  <div class="col-lg-3 col-md-3">
      <div class="m_t">1：即時、2：締め日</div>
  </div>

  </div>

  <div class=" row row_data">
      <div class="col-lg-3 col-md-3 col-sm-3">
     <div class="margin_t "><span>
請求締め日</span></div>
  </div>
<div class="col-lg-9 col-md-9 col-sm-9">


   <div>
<select class="form-control left_select ">
                      <option value="0">01</option>
                      <option value="1">02</option>
                      <option value="2">03</option>
                      <option value="3">04</option>
                      <option value="4">05</option>
                      <option value="5">06</option>
                      <option value="6">07</option>
                      <option value="7">08</option>
                      <option value="8">09</option>
                      <option value="9">10</option>
                      <option value="10">11</option>
                      <option value="11">12</option>
                      <option value="12">13</option>
                      <option value="13">14</option>
                      <option value="14">15</option>
                      <option value="15">16</option>
                      <option value="16">17</option>
                      <option value="17">18</option>
                      <option value="18">19</option>
                      <option value="19">20</option>
                      <option value="20">21</option>
                      <option value="21">22</option>
                      <option value="22">23</option>
                      <option value="23">24</option>
                      <option value="24">25</option>
                      <option value="25">26</option>
                      <option value="26">27</option>
                      <option value="27">28</option>
                      <option value="28">29</option>
                      <option value="29">30</option>
                      <option value="30">31：月末</option>
                      </select>

    </div>
  </div>

<!--   <div class="col-lg-5 d-none">
      <div class="m_t"></div>
  </div> -->

  </div>
  <div class=" row row_data">
      <div class="col-lg-3 col-md-3">
     <div class="margin_t "><span>
入金方法</span></div>
  </div>
<div class="col-lg-9 col-md-9">


   <div>
<select class="form-control left_select ">
                      <option value="0">01 現金・小切手</option>
                      <option value="1">02 振込</option>
                      <option value="2">03 引落</option>
                      <option value="3">11 手形</option>


                      </select>

    </div>
  </div>

<!--   <div class="col-lg-5 d-none">
      <div class="m_t"></div>
  </div> -->

  </div>

  <div class=" row row_data">
      <div class="col-lg-3 col-md-3">
     <div class="margin_t "><span>
回収月</span></div>
  </div>
<div class="col-lg-4 col-md-4">


   <div>
<input type="text" class="input_field form-control" value="1">

    </div>
  </div>

  <div class="col-lg-5 col-md-5">
      <div class="m_t">0：当月、1：翌日、2：翌々月、</div>
   <div class="m_t">3：3か月、4：4か月</div>
  </div>

  </div>
    <div class=" row row_data">
      <div class="col-lg-3 col-md-3">
     <div class="margin_t "><span>
回収日</span></div>
  </div>
<div class="col-lg-4 col-md-4">


   <div>
<input type="text" class=" input_field form-control" value="1">

    </div>
  </div>

  <div class="col-lg-5 col-md-5">
      <div class="m_t"></div>
  </div>

  </div>


    <div class=" row row_data">
      <div class="col-lg-3 col-md-3">
     <div class="margin_t "><span>
回収日休日設定
</span></div>
  </div>
<div class="col-lg-4 col-md-4">


   <div>
<input type="text" class="input_field form-control" value="1">

    </div>
  </div>

  <div class="col-lg-5 col-md-5">
      <div class="m_t">1：翌営業日、2：前営業日</div>

  </div>

  </div>
      <div class=" row row_data">
      <div class="col-lg-3 col-md-3">
     <div class="margin_t "><span>
入金時手数料設定
</span></div>
  </div>
<div class="col-lg-4 col-md-4">


   <div>
<input type="text" class="input_field form-control" value="1">

    </div>
  </div>

  <div class="col-lg-5 col-md-5">
      <div class="m_t">1：自社、2：先方</div>

  </div>

  </div>

            </div>
          </div>

  <div class="col-lg-5 col-md-5">
    <div class="tbl_company w-100">

  <div class=" row row_data">
      <div class="col-lg-4 col-md-4">
     <div class="margin_t "><span>
保守更新案内有無</span></div>
  </div>
<div class="col-lg-4 col-md-4">

     <div>
          <input type="text" class="input_field form-control" value="1">
      </div>
  </div>

<div class="col-lg-4 col-md-4">
      <div class="m_t">1：有、2：無</div>
  </div>
  </div>


    <div class=" row row_data">
      <div class="col-lg-4 col-md-4">
     <div class="margin_t "><span>
ライセンス証書有無
</span></div>
  </div>
<div class="col-lg-4 col-md-4">

     <div>
          <input type="text" class="input_field form-control" value="1">
      </div>
  </div>

<div class="col-lg-4 col-md-4">
      <div class="m_t">1：有、2：無</div>
  </div>
  </div>

    <div class=" row row_data">
      <div class="col-lg-4 col-md-4">
     <div class="margin_t "><span>
検収条件
</span></div>
  </div>
<div class="col-lg-8 col-md-8">

     <div>
         <select class="form-control left_select ">
                      <option value="0">01 納品完了確認書 貴社捺印時</option>
                      <option value="1">02 作業完了確認書 貴社捺印時</option>
                      <option value="2">03 受入検査完了時</option>
                      <option value="3">04 先方の検収書</option>
                      <option value="4">05 納品時</option>
                      <option value="5">06 その他</option>

                      </select>
      </div>
  </div>

<!-- <div class="col-lg-4">
      <div class="m_t">1：有、2：無</div>
  </div> -->
  </div>
      <div class=" row row_data">
      <div class="col-lg-4 col-md-4">
     <div class="margin_t "><span>
与信限度額
</span></div>
  </div>
<div class="col-lg-4 col-md-4">

     <div>
          <input type="text" class="input_field form-control" value="1">
      </div>
  </div>

<div class="col-lg-4 col-md-4">
      <div class="m_t">百万円</div>
  </div>
  </div>

            </div>
          </div>
        </div>

<!-- 2nd tab1 row -->

  <div class="row mt-1 mb-3">
        <div class="col-lg-10 col-md-10">
            <div class="tbl_company w-100">

<div class=" row row_data">
      <div class="col-lg-3 col-md-3">
     <div class="margin_t "><span>請求先CD</span></div>
  </div>
<div class="col-lg-9 col-md-9">

    <div class="outer row">
     <div class="col-lg-6 col-md-6 ">

<div style="position:relative;"><input type="text" class="input_field form-control" style="" value="20011">

  </div>


<div class="box-dark" id="popup1_comp" style="bottom: 0;float: left;margin-top: 8px;position: absolute;right: 24px;top: 0px;" data-toggle="modal" data-target="#comp_modal4">

                      </div>

    </div>
   <div class="col-lg-6 col-md-6 d-none "></div>
    </div>
  </div>

  </div>
<div class=" row row_data">
      <div class="col-lg-3 col-md-3">
     <div class="margin_t "><span>請求書送付日</span></div>
  </div>
<div class="col-lg-9 col-md-9">

    <div class="outer row">
     <div class="col-lg-6 col-md-6 ">
<input type="text" class="input_field form-control" value="">

    </div>
 <div class="col-lg-6 col-md-6 d-none "></div>
    </div>
  </div>

  </div>

    <div class=" row row_data">
      <div class="col-lg-3 col-md-3">
     <div class="margin_t "><span>請求書メール区分</span></div>
  </div>
<div class="col-lg-9 col-md-9">

    <div class="outer row">
     <div class="col-lg-6 col-md-6 ">
<input type="text" class="input_field form-control" value="1">

    </div>
     <div class="col-lg-6 col-md-6 d-none "></div>
         <div class="col-lg-6 col-md-6 ">
<div class="m_t">1：PDFﾒｰﾙ送信、2：ﾒｰﾙ不要</div>

    </div>

    </div>
  </div>

  </div>

    <div class=" row row_data">
      <div class="col-lg-3 col-md-3">
     <div class="margin_t "><span>請求書メール宛先</span></div>
  </div>
<div class="col-lg-9 col-md-9">

    <div class="outer row">
     <div class="col-lg-6 col-md-6">
<input type="text" class="input_field form-control" value="">

    </div>


    </div>
  </div>

  </div>
      <div class=" row row_data">
      <div class="col-lg-3 col-md-3">
     <div class="margin_t "><span>請求書UIS</span></div>
  </div>
<div class="col-lg-9 col-md-9">

    <div class="outer row">
     <div class="col-lg-6 col-md-6 ">
<input type="text" class="input_field form-control" value="2">

    </div>
       <div class="col-lg-6 d-none "></div>
         <div class="col-lg-6 col-md-6 ">
<div class="m_t">1：PDF-UIS、2：UIS不要</div>

    </div>

    </div>
  </div>

  </div>

        <div class=" row row_data">
      <div class="col-lg-3 col-md-3">
     <div class="margin_t "><span>請求書郵送</span></div>
  </div>
<div class="col-lg-9 col-md-9">

    <div class="outer row">
     <div class="col-lg-6 col-md-3 ">
<input type="text" class="input_field -control" value="1">

    </div>
     <div class="col-lg-6 col-md-6none "></div>
         <div class="col-lg-6 col-md-6 ">
<div class="m_t">1：郵送、2：不要</div>

    </div>

    </div>
  </div>

  </div>

          <div class=" row row_data">
      <div class="col-lg-3 col-md-3">
     <div class="margin_t "><span>請求書郵送先</span></div>
  </div>
<div class="col-lg-9 col-md-9">

    <div class="outer row">
     <div class="col-lg-6 col-md-6">
<div style="position:relative;"><input type="text" class="form-control" style="" value="20011">

  </div>


<div class="box-dark" id="popup2_comp" style="bottom: 0;float: left;margin-top: 8px;position: absolute;right: 24px;top: 0px;" data-toggle="modal" data-target="#comp_modal4">

                      </div>

    </div>
  <div class="col-lg-6 col-md-6 d-none "></div>
      <div class="col-lg-6 col-md-6 "></div>
    </div>
  </div>

  </div>

            <div class=" row row_data">
      <div class="col-lg-3 col-md-3">
     <div class="margin_t "><span>請求税区分</span></div>
  </div>
<div class="col-lg-9 col-md-9">

    <div class="outer row">
     <div class="col-lg-6 col-md-6 ">
<select class="form-control left_select ">
                      <option value="0">00 対象外・非課税</option>
                      <option value="0">01 課税10％</option>
                      </select>

    </div>
  <div class="col-lg-6 col-md-6 d-none "></div>
      <div class="col-lg-6 col-md-6 "></div>
    </div>
  </div>

  </div>
            <div class=" row row_data">
      <div class="col-lg-3 col-md-3">
     <div class="margin_t "><span>請求税端数区分</span></div>
  </div>
<div class="col-lg-9 col-md-9 ">

    <div class="outer row">
     <div class="col-lg-6 col-md-6 ">
<select class="form-control left_select ">
                      <option value="0">1 四捨五入</option>
                      <option value="1">2 切り上げ</option>
                      <option value="2">3 切り下げ</option>
                      </select>

    </div>
   <div class="col-lg-6 col-md-6 d-none "></div>
      <div class="col-lg-6 col-md-6 "></div>
    </div>
  </div>

  </div>



          <div class=" row row_data">
      <div class="col-lg-3 col-md-3">
     <div class="margin_t "><span>請求消費税計算区分
</span></div>
  </div>
<div class="col-lg-9 col-md-9">

    <div class="outer row">
     <div class="col-lg-6 col-md-6 ">
<input type="text" class="input_field form-control" value="1">

    </div>
    <div class="col-lg-6 d-none "></div>
         <div class="col-lg-6 col-md-6 ">
<div class="m_t">1：伝票単位、2：明細単位</div>

    </div>

    </div>
  </div>

  </div>


    </div>
          </div>
        </div>
  <div class="row mt-1 mb-3">
        <div class="col-lg-7 col-md-7">
            <div class="tbl_company w-100">

<div class=" row row_data">
      <div class="col-lg-4 col-md-4">
     <div class="margin_t "><span>専伝区分</span></div>
  </div>
<div class="col-lg-8 col-md-8">

    <div class="outer row">
     <div class="col-lg-7 col-md-7 ">

      <input type="text" class="input_field form-control" value="01">

    </div>
      <div class="col-lg-5 col-md-5 ">

      <div class="m_t">1：有、2：無</div>

    </div>

    </div>
  </div>

  </div>
<div class=" row row_data">
      <div class="col-lg-4 col-md-4">
     <div class="margin_t "><span>指定納品書帳票CD
</span></div>
  </div>
<div class="col-lg-8 col-md-8">

    <div class="outer row">


  <div class="col-lg-6 col-md-6 ">
           <input type="text" class="input_field form-control" value="">

    </div>




    </div>
  </div>

  </div>
  <div class=" row row_data">
      <div class="col-lg-4 col-md-4">
     <div class="margin_t "><span>得意先分類1</span></div>
  </div>
<div class="col-lg-8 col-md-8">

    <div class="outer row">
     <div class="col-lg-12 col-md-12 ">

     <select class="form-control left_select ">
                      <option value="0">01 販売ランク NULL</option>
                      <option value="1">02 販売ランク A</option>
                      <option value="2">03 販売ランク B</option>
                      <option value="3">04 販売ランク C</option>
                      <option value="4">05 販売ランク D</option>
               </select>

    </div>


    </div>
  </div>

  </div>

    <div class=" row row_data">
      <div class="col-lg-4 col-md-4">
     <div class="margin_t "><span>得意先分類2</span></div>
  </div>
<div class="col-lg-8 col-md-8">

    <div class="outer row">
     <div class="col-lg-12 col-md-12 ">

     <select class="form-control left_select ">
                      <option value="0">01 深耕客</option>
                      <option value="1">02 発展客</option>
                      <option value="2">03 維持客</option>
                      <option value="3">04 管理客</option>
                      <option value="4">05 その他</option>
               </select>

    </div>
<!--         <div class="col-lg-5 d-none "></div> -->

    </div>
  </div>

  </div>
<div class=" row row_data">
      <div class="col-lg-3 col-md-3">
   <div class="margin_t ">
      <span>得意先分類3</span>
 </div>

  </div>
<div class="col-lg-9 col-md-9">

    <div class="outer row">
           <div class="col-lg-12 col-md-12 ">
<div class="m_t ml-45">未使用</div>
        </div>

 </div>

  </div>

  </div>

<div class=" row row_data">
      <div class="col-lg-3 col-md-3">
   <div class="margin_t ">
      <span>得意先分類4</span>
 </div>

  </div>
<div class="col-lg-9 col-md-9">

    <div class="outer row">
           <div class="col-lg-12 col-md-12 ">
<div class="m_t ml-45">未使用</div>
        </div>

 </div>

  </div>

  </div>
  <div class=" row row_data">
      <div class="col-lg-3 col-md-3">
   <div class="margin_t ">
      <span>得意先分類5</span>
 </div>

  </div>
<div class="col-lg-9 col-md-9">

    <div class="outer row">
           <div class="col-lg-12 col-md-12 ">
<div class="m_t ml-45">未使用</div>
        </div>

 </div>

  </div>

  </div>
  <div class=" row row_data">
      <div class="col-lg-3 col-md-3">
   <div class="margin_t ">
      <span>得意先分類6</span>
 </div>

  </div>
<div class="col-lg-9 col-md-9">

    <div class="outer row">
           <div class="col-lg-12 col-md-12 ">
<div class="m_t ml-45">未使用</div>
        </div>

 </div>

  </div>

  </div>

            </div>
          </div>


           <div class="col-lg-5 col-md-5">
            <div class="tbl_company w-100">

    <div class=" row row_data">
      <div class="col-lg-5 col-md-5">
     <div class="margin_t "><span>単価設定区分</span></div>
  </div>
<div class="col-lg-7 col-md-7">

    <div class="outer row">
     <div class="col-lg-12 col-md-12 ">

<select class="form-control left_select ">
                      <option value="0">01 商品Mの標準単価</option>
                      <option value="1">02 商品MのPB単価</option>
                      <option value="2">03 得商Mの単価</option>
                            <option value="2">04 得商MのPB単価</option>

               </select>

    </div>


    </div>
  </div>

  </div>
      <div class=" row row_data">
      <div class="col-lg-5 col-md-5">
     <div class="margin_t "><span>取引開始日 東直</span></div>
  </div>
<div class="col-lg-7 col-md-7">

    <div class="outer row">
     <div class="col-lg-12 col-md-12 ">

   <div class="input-group">
      <input data-format="dd/MM/yyyy hh:mm:ss"id="datepicker2_com" type="text" class="input_field form-control"  autocomplete="off">
  <div class="input-group-append" style="margin-left: 10px;margin-top: 7px;">
<span id="cal_icon2_c" class="fa fa-calendar"></span>
  </div>
</div>

    </div>


    </div>
  </div>

  </div>
    <!--   <div class=" row row_data">
      <div class="col-lg-5">
     <div class="margin_t "><span>取引開始日 東直</span></div>
  </div>
<div class="col-lg-7">

    <div class="outer row">
     <div class="col-lg-12 ">

<input type="text" class="form-control" value="">

    </div>


    </div>
  </div>

  </div> -->
               <div class=" row row_data">
      <div class="col-lg-5 col-md-5">
     <div class="margin_t "><span>取引開始日 東流</span></div>
  </div>
<div class="col-lg-7 col-md-7">

    <div class="outer row">
     <div class="col-lg-12 col-md-12 ">

    <div class="input-group">
      <input data-format="dd/MM/yyyy hh:mm:ss"id="datepicker3_com" type="text" class="input_field form-control"  autocomplete="off">
  <div class="input-group-append" style="margin-left: 10px;margin-top: 7px;">
<span id="cal_icon3_c" class="fa fa-calendar"></span>
  </div>
</div>

    </div>


    </div>
  </div>

  </div>

   <div class=" row row_data">
      <div class="col-lg-5 col-md-5">
     <div class="margin_t "><span>取引開始日 西直
</span></div>
  </div>
<div class="col-lg-7 col-md-7">

    <div class="outer row">
     <div class="col-lg-12 col-md-12 ">

    <div class="input-group">
      <input data-format="dd/MM/yyyy hh:mm:ss"id="datepicker4_com" type="text" class="input_field form-control"  autocomplete="off">
  <div class="input-group-append" style="margin-left: 10px;margin-top: 7px;">
<span id="cal_icon4_c" class="fa fa-calendar"></span>
  </div>
</div>

    </div>


    </div>
  </div>

  </div>
   <div class=" row row_data">
      <div class="col-lg-5 col-md-5">
     <div class="margin_t "><span>取引開始日 西流
</span></div>
  </div>
<div class="col-lg-7 col-md-7">

    <div class="outer row">
     <div class="col-lg-12 col-md-12 ">
    <div class="input-group">
      <input data-format="dd/MM/yyyy hh:mm:ss"id="datepicker5_com" type="text" class="input_field form-control" autocomplete="off">
  <div class="input-group-append" style="margin-left: 10px;margin-top: 7px;">
<span id="cal_icon5_c" class="fa fa-calendar"></span>
  </div>
</div>

    </div>


    </div>
  </div>

  </div>
   <div class=" row row_data">
      <div class="col-lg-5 col-md-5">
     <div class="margin_t "><span>ユーザー区分
</span></div>
  </div>
<div class="col-lg-7 col-md-7">

    <div class="outer row">
     <div class="col-lg-12 col-md-12 ">

<select class="form-control left_select ">
                      <option value="0">1 ﾕｰｻﾞｰ</option>
                      <option value="1">2 過去ﾕｰｻﾞｰ</option>
                      <option value="2">3 新規</option>
                      <option value="3">4 ﾊﾟｰﾄﾅｰ</option>
                     <option value="4">5 他</option>
               </select>

    </div>


    </div>
  </div>

  </div>

     <div class=" row row_data">
      <div class="col-lg-5 col-md-5">
     <div class="margin_t "><span>データソース
</span></div>
  </div>
<div class="col-lg-7 col-md-7">

    <div class="outer row">
     <div class="col-lg-12 col-md-12 ">

<select class="form-control left_select ">
                      <option value="">1 名刺交換</option>
                      <option value="">2 資料請求</option>
                      <option value="">3 2018春関西ITWEEK</option>
                      <option value="">4 2018春ITWEEK</option>
                     <option value="">5 2019春関西ITWEEK</option>
                      <option value="">6 2019春ITWEEK</option>
                      <option value="">7 USACｿﾘｭｰｼｮﾝﾌｪｱ2020</option>

                  </select>

    </div>


    </div>
  </div>

  </div>
   </div>
          </div>
        </div>

      </div>
<!-- 3rd tab1 row -->





      </div>
      <!-- sales and billing tabbed menu -->
        <div class="tab-pane fade h-100 p-3 border" id="payment1" role="tabpanel" aria-labelledby="payment1-tab">



  <div class="row mt-1 mb-3">
        <div class="col-lg-12 col-md-12">
            <div class="tbl_company w-100">


<div class=" row row_data">
      <div class="col-lg-2 col-md-2">
     <div class="margin_t "><span>支払締め日</span></div>
  </div>
<div class="col-lg-4 col-md-4">

    <div class="outer row">
     <div class="col-lg-12 col-md-12 ">

   <select class="form-control left_select ">
                      <option value="0">10 10日締</option>
                      <option value="1">15 15日締</option>
                      <option value="2">20 20日締</option>
                      <option value="3">25 25日締</option>
                      <option value="4">31 月末締</option>

                      </select>

    </div>

    </div>
  </div>

  <div class="col-lg-6 col-md-6">

    <div class="outer row">
     <div class="col-lg-12 col-md-12">

      <div class="m_t"></div>

    </div>

    </div>
  </div>

  </div>


<div class=" row row_data">
      <div class="col-lg-2 col-md-2">
     <div class="margin_t "><span>支払月</span></div>
  </div>
<div class="col-lg-4 col-md-4">

    <div class="outer row">
     <div class="col-lg-12 col-md-12 ">

      <input type="text" class="form-control" value="">

    </div>

    </div>
  </div>

  <div class="col-lg-6 col-md-6">

    <div class="outer row">
     <div class="col-lg-12 col-md-12 ">

      <div class="m_t">0：当月、1：翌日、2：翌々月、3：3か月、4：4か月</div>

    </div>

    </div>
  </div>

  </div>

     <div class=" row row_data">
      <div class="col-lg-2 col-md-2">
     <div class="margin_t "><span>支払日</span></div>
  </div>
<div class="col-lg-4 col-md-4">

    <div class="outer row">
     <div class="col-lg-12 col-md-12 ">

<select class="form-control left_select ">
                      <option value="0">1</option>
                      <option value="1">2</option>
                      <option value="2">3</option>
                      <option value="3">4</option>
                      <option value="4">5</option>
                       <option value="0">6</option>
                      <option value="1">7</option>
                      <option value="2">8</option>
                      <option value="3">9</option>
                      <option value="4">10</option>
                      <option value="0">11</option>
                      <option value="1">12</option>
                      <option value="2">13</option>
                      <option value="3">14</option>
                      <option value="4">15</option>
                       <option value="0">16</option>
                      <option value="1">17</option>
                      <option value="2">18</option>
                      <option value="3">19</option>
                      <option value="4">20</option>
                      <option value="0">21</option>
                      <option value="1">22</option>
                      <option value="2">23</option>
                      <option value="3">24</option>
                      <option value="4">25</option>
                       <option value="0">26</option>
                      <option value="1">27</option>
                      <option value="2">28</option>
                      <option value="3">29</option>
                      <option value="4">30</option>
                      </select>

    </div>

    </div>
  </div>

  <div class="col-lg-6 col-md-6">

    <div class="outer row">
     <div class="col-lg-12 col-md-12">

      <div class="m_t"></div>

    </div>

    </div>
  </div>

  </div>

     <div class=" row row_data">
      <div class="col-lg-2 col-md-2">
     <div class="margin_t "><span>支払日休日設定</span></div>
  </div>
<div class="col-lg-4 col-md-4">

    <div class="outer row">
     <div class="col-lg-12 col-md-12 ">

      <input type="text" class="form-control" value="">

    </div>

    </div>
  </div>

  <div class="col-lg-6 col-md-6">

    <div class="outer row">
     <div class="col-lg-12 col-md-12">

      <div class="m_t">1：翌営業日、2：前営業日</div>

    </div>

    </div>
  </div>

  </div>
     <div class=" row row_data">
      <div class="col-lg-2 col-md-2">
     <div class="margin_t "><span>支払振込手数料設定</span></div>
  </div>
<div class="col-lg-4 col-md-4">

    <div class="outer row">
     <div class="col-lg-12 col-md-12 ">

      <input type="text" class="form-control" value="">

    </div>

    </div>
  </div>

  <div class="col-lg-6 col-md-6">

    <div class="outer row">
     <div class="col-lg-12 col-md-12 ">

      <div class="m_t">1：自社、2：先方</div>

    </div>

    </div>
  </div>

  </div>

     <div class=" row row_data">
      <div class="col-lg-2 col-md-2">
     <div class="margin_t "><span>支払方法</span></div>
  </div>
<div class="col-lg-4 col-md-4">

    <div class="outer row">
     <div class="col-lg-12 col-md-12 ">

 <select class="form-control left_select ">
                      <option value="0">01 現金・小切手</option>
                      <option value="1">02 振込</option>
                      <option value="2">03 引落</option>
                      <option value="3">11 手形</option>

                     </select>

    </div>

    </div>
  </div>

  <div class="col-lg-6 col-md-6">

    <div class="outer row">
     <div class="col-lg-12 col-md-12 ">

      <div class="m_t"></div>

    </div>

    </div>
  </div>

  </div>

<div class=" row row_data">
      <div class="col-lg-2 col-md-2">
   <div class="margin_t ">
      <span>振込銀行</span>
 </div>

  </div>
<div class="col-lg-9 col-md-9">

    <div class="outer row">
           <div class="col-lg-12 col-md-12">
<div class="m_t">未使用</div>
        </div>

 </div>

  </div>

  </div>

<div class=" row row_data">
      <div class="col-lg-2 col-md-2">
   <div class="margin_t ">
      <span>振込支店</span>
 </div>

  </div>
<div class="col-lg-9 col-md-9">

    <div class="outer row">
           <div class="col-lg-12 col-md-12 ">
<div class="m_t">未使用</div>
        </div>

 </div>

  </div>

  </div>
<div class=" row row_data">
      <div class="col-lg-2 col-md-2">
   <div class="margin_t ">
      <span>預金種別</span>
 </div>

  </div>
<div class="col-lg-9 col-md-9">

    <div class="outer row">
           <div class="col-lg-12 col-md-12 ">
<div class="m_t">未使用</div>
        </div>

 </div>

  </div>

  </div>
  <div class=" row row_data">
      <div class="col-lg-2 col-md-2">
   <div class="margin_t ">
      <span>口座番号</span>
 </div>

  </div>
<div class="col-lg-9 col-md-9">

    <div class="outer row">
           <div class="col-lg-12 col-md-12 ">
<div class="m_t">未使用</div>
        </div>

 </div>

  </div>

  </div>
    <div class=" row row_data">
      <div class="col-lg-2 col-md-2">
   <div class="margin_t ">
      <span>口座名義人</span>
 </div>

  </div>
<div class="col-lg-9 col-md-9">

    <div class="outer row">
           <div class="col-lg-12 col-md-12 ">
<div class="m_t">未使用</div>
        </div>

 </div>

  </div>

  </div>
    <div class=" row row_data">
      <div class="col-lg-2 col-md-2">
   <div class="margin_t ">
      <span>仕向銀行</span>
 </div>

  </div>
<div class="col-lg-9 col-md-9">

    <div class="outer row">
           <div class="col-lg-12 col-md-12">
<div class="m_t">未使用</div>
        </div>

 </div>

  </div>

  </div>
    <div class=" row row_data">
      <div class="col-lg-2 col-md-2">
   <div class="margin_t ">
      <span>仕向支店</span>
 </div>

  </div>
<div class="col-lg-9 col-md-9">

    <div class="outer row">
           <div class="col-lg-12 col-md-12">
<div class="m_t">未使用</div>
        </div>

 </div>

  </div>

  </div>
<!--     <div class=" row row_data">
      <div class="col-lg-3">
   <div class="margin_t ">
      <span>を追加</span>
 </div>

  </div>
<div class="col-lg-9">

    <div class="outer row">
           <div class="col-lg-12 ">
<div class="m_t">未使用</div>
        </div>

 </div>

  </div>

  </div> -->


     <div class=" row row_data">
      <div class="col-lg-2 col-md-2">
     <div class="margin_t "><span>支払税区分</span></div>
  </div>
<div class="col-lg-4 col-md-4">

    <div class="outer row">
     <div class="col-lg-12 col-md-12 ">

<select class="form-control left_select ">
                      <option value="0">1 非課税・課税なし</option>
                      <option value="1">2 10％課税</option>

                     </select>

    </div>

    </div>
  </div>

  <div class="col-lg-6 col-md-6">

    <div class="outer row">
     <div class="col-lg-12 col-md-12 ">

      <div class="m_t"></div>

    </div>

    </div>
  </div>

  </div>

       <div class=" row row_data">
      <div class="col-lg-2 col-md-2">
     <div class="margin_t "><span>支払税端数区分</span></div>
  </div>
<div class="col-lg-4 col-md-4">

    <div class="outer row">
     <div class="col-lg-12 col-md-12">

<select class="form-control left_select ">
                      <option value="0">1 四捨五入</option>
                      <option value="1">2 切り上げ</option>
                      <option value="2">3 切り下げ</option>

                    </select>

    </div>

    </div>
  </div>

  <div class="col-lg-6 col-md-6">

    <div class="outer row">
     <div class="col-lg-12 col-md-12 ">

      <div class="m_t"></div>

    </div>

    </div>
  </div>

  </div>


       <div class=" row row_data">
      <div class="col-lg-2 col-md-2">
     <div class="margin_t "><span>源泉区分</span></div>
  </div>
<div class="col-lg-4 col-md-4">

    <div class="outer row">
     <div class="col-lg-12 col-md-12 ">

<input type="text" class="form-control" value="">

    </div>

    </div>
  </div>

  <div class="col-lg-6 col-md-6">

    <div class="outer row">
     <div class="col-lg-12 col-md-12 ">

      <div class="m_t">0：なし、1：あり</div>

    </div>

    </div>
  </div>

  </div>


         <div class=" row row_data">
      <div class="col-lg-2 col-md-2">
     <div class="margin_t "><span>
手形決済月</span></div>
  </div>
<div class="col-lg-4 col-md-4">

    <div class="outer row">
     <div class="col-lg-12 col-md-12 ">

<input type="text" class="form-control" value="">

    </div>

    </div>
  </div>

  <div class="col-lg-4 col-md-4">

    <div class="outer row">
     <div class="col-lg-12 col-md-12 ">

      <div class="m_t">0：当月、1：翌日、2：翌々月、3：3か月、4：4か月</div>

    </div>

    </div>
  </div>

  </div>

           <div class=" row row_data">
      <div class="col-lg-2 col-md-2">
     <div class="margin_t "><span>
手形決済日</span></div>
  </div>
<div class="col-lg-4 col-md-4">

    <div class="outer row">
     <div class="col-lg-12 col-md-12 ">

<select class="form-control left_select ">
                      <option value="0">01</option>
                      <option value="1">02</option>
                      <option value="2">03</option>
                      <option value="3">04</option>
                      <option value="4">05</option>
                      <option value="5">06</option>
                      <option value="6">07</option>
                      <option value="7">08</option>
                      <option value="8">09</option>
                      <option value="9">10</option>
                      <option value="10">11</option>
                      <option value="11">12</option>
                      <option value="12">13</option>
                      <option value="13">14</option>
                      <option value="14">15</option>
                      <option value="15">16</option>
                      <option value="16">17</option>
                      <option value="17">18</option>
                      <option value="18">19</option>
                      <option value="19">20</option>
                      <option value="20">21</option>
                      <option value="21">22</option>
                      <option value="22">23</option>
                      <option value="23">24</option>
                      <option value="24">25</option>
                      <option value="25">26</option>
                      <option value="26">27</option>
                      <option value="27">28</option>
                      <option value="28">29</option>
                      <option value="29">30</option>
                      <option value="30">31：月末</option>
                      </select>

    </div>

    </div>
  </div>

  <div class="col-lg-6">

    <div class="outer row">
     <div class="col-lg-12 ">

      <div class="m_t"></div>

    </div>

    </div>
  </div>

  </div>
  <div class=" row row_data">
      <div class="col-lg-2 col-md-2">
     <div class="margin_t "><span>
仕入消費税計算区分</span></div>
  </div>
<div class="col-lg-4 col-md-4">

    <div class="outer row">
     <div class="col-lg-12 col-md-12 ">

<input type="text" class="form-control" value="1">

    </div>

    </div>
  </div>

  <div class="col-lg-6">

    <div class="outer row">
     <div class="col-lg-12 col-md-12 ">

      <div class="m_t">1：伝票単位、2：明細単位</div>

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


    </div>








                <div class="modal-footer">

                </div>
                </div>

        </div>
   </div>






<!--------------------------Modal 3 comp 1 table end------------------------->



          <!-- save modal sarts here -->

<div class="modal fade"  id="save_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" style="max-width: 700px;" role="document">
            <div class="modal-content">
                  <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">会社マスタ</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                <div class="modal-body">

<h5>この内容で登録しますか？</h5>

                  <div class="col-12">
                   <div class="">
                <table class="w-100">

                  <tbody>

                  <tr style="background-color: #8DB4E2;">
                    <td colspan="2" style="text-align: center!important;">共通</td>
                  </tr>
            <tr>
                   <td>
                    <div class=" margin_t ">
                            <span>会社ID</span>
                     </div>
                    </td>
                      <td>
                      <div class="col-12 ">


                  <span>234567</span>

                      </div>
                    </td>


           </tr>
                       <tr>
                   <td>
                    <div class=" margin_t ">
                            <span> 法人マイナンバー</span>
                     </div>
                    </td>
                      <td>
                      <div class="col-12 ">


                  <span></span>

                      </div>
                    </td>


           </tr>
                       <tr>
                   <td>
                    <div class=" margin_t ">
                            <span>  処理状況</span>
                     </div>
                    </td>
                      <td>
                      <div class="col-12 ">


                  <span></span>

                      </div>
                    </td>


           </tr>


              <tr>
                   <td>
                    <div class=" margin_t ">
                            <span>  会社名</span>
                     </div>
                    </td>
                      <td>
                      <div class="col-12 ">


                  <span>アロン化成株式会社</span>

                      </div>
                    </td>


           </tr>



              <tr>
                   <td>
                    <div class=" margin_t ">
                            <span> 会社名略称 </span>
                     </div>
                    </td>
                      <td>
                      <div class="col-12 ">


                  <span>アロン</span>

                      </div>
                    </td>

           </tr>


              <tr>
                   <td>
                    <div class=" margin_t ">
                            <span> 会社名カナ </span>
                     </div>
                    </td>
                      <td>
                      <div class="col-12 ">


                  <span>アロンカセイ</span>

                      </div>
                    </td>

           </tr>
           <tr>
                   <td>
                    <div class=" margin_t ">
                            <span>会社名カナ入金消込用  </span>
                     </div>
                    </td>
                      <td>
                      <div class="col-12 ">


                  <span></span>

                      </div>
                    </td>

           </tr>
                     <tr>
                   <td>
                    <div class=" margin_t ">
                            <span> 入力区分 </span>
                     </div>
                    </td>
                      <td>
                      <div class="col-12 ">


                  <span>0</span>

                      </div>
                    </td>

           </tr>
                     <tr>
                   <td>
                    <div class=" margin_t ">
                            <span>会計取引先CD  </span>
                     </div>
                    </td>
                      <td>
                      <div class="col-12 ">


                  <span></span>

                      </div>
                    </td>

           </tr>
     <tr>
                   <td>
                    <div class=" margin_t ">
                            <span>帝国ﾃﾞｰﾀﾊﾞﾝｸ信用録PDF  </span>
                     </div>
                    </td>
                      <td>
                      <div class="col-12 ">


                  <span>ZZZ0012</span>

                      </div>
                    </td>


           </tr>

              <tr>
                   <td>
                    <div class=" margin_t ">
                            <span> 帝国ﾃﾞｰﾀﾊﾞﾝｸ取得年月日 </span>
                     </div>
                    </td>
                      <td>
                      <div class="col-12 ">


                  <span>20191119</span>

                      </div>
                    </td>


           </tr>

              <tr>
                   <td>
                    <div class=" margin_t ">
                            <span> 帝国ﾃﾞｰﾀﾊﾞﾝｸ企業ｺｰﾄﾞ </span>
                     </div>
                    </td>
                      <td>
                      <div class="col-12 ">


                  <span>881234568</span>

                      </div>
                    </td>


           </tr>

        <tr>
                   <td>
                    <div class=" margin_t ">
                            <span> 帝国ﾃﾞｰﾀﾊﾞﾝｸ評価点 </span>
                     </div>
                    </td>
                      <td>
                      <div class="col-12 ">


                  <span>22</span>

                      </div>
                    </td>


           </tr>
                   <tr>
                   <td>
                    <div class=" margin_t ">
                            <span> 経済産業省業種区分1 </span>
                     </div>
                    </td>
                      <td>
                      <div class="col-12 ">


                  <span>2345</span>

                      </div>
                    </td>


           </tr>
                   <tr>
                   <td>
                    <div class=" margin_t ">
                            <span> 経済産業省業種区分2 </span>
                     </div>
                    </td>
                      <td>
                      <div class="col-12 ">


                  <span>2</span>

                      </div>
                    </td>


           </tr>



           <tr>
                   <td>
                    <div class=" margin_t ">
                            <span> 会社分類1 </span>
                     </div>
                    </td>
                      <td>
                      <div class="col-12 ">


                  <span>製造業</span>

                      </div>
                    </td>


           </tr>

         <tr>
                   <td>
                    <div class=" margin_t ">
                            <span>会社分類2  </span>
                     </div>
                    </td>
                      <td>
                      <div class="col-12 ">


                  <span></span>

                      </div>
                    </td>


           </tr>
                  <tr>
                   <td>
                    <div class=" margin_t ">
                            <span>会社分類3 </span>
                     </div>
                    </td>
                      <td>
                      <div class="col-12 ">


                  <span></span>

                      </div>
                    </td>


           </tr>
                    <tr>
                   <td>
                    <div class=" margin_t ">
                            <span>会社分類4  </span>
                     </div>
                    </td>
                      <td>
                      <div class="col-12 ">


                  <span></span>

                      </div>
                    </td>


           </tr>
                    <tr>
                   <td>
                    <div class=" margin_t ">
                            <span>会社分類5  </span>
                     </div>
                    </td>
                      <td>
                      <div class="col-12 ">


                  <span></span>

                      </div>
                    </td>


           </tr>
         <tr>
                   <td>
                    <div class=" margin_t ">
                            <span> 社内備考 </span>
                     </div>
                    </td>
                      <td>
                      <div class="col-12 ">


                  <span>88</span>

                      </div>
                    </td>


           </tr>

           <tr>
                   <td>
                    <div class=" margin_t ">
                            <span> 売上 </span>
                     </div>
                    </td>
                      <td>
                      <div class="col-12 ">


                  <span>1</span>

                      </div>
                    </td>


           </tr>


<tr>
                   <td>
                    <div class=" margin_t ">
                            <span> 仕入 </span>
                     </div>
                    </td>
                      <td>
                      <div class="col-12 ">


                  <span>0</span>

                      </div>
                    </td>


           </tr>

  <tr style="background-color: #8DB4E2;">
                    <td colspan="2"style="text-align: center!important;">売上・請求</td>
                  </tr>
<tr>
                   <td>
                    <div class=" margin_t ">
                            <span>  即時区分</span>
                     </div>
                    </td>
                      <td>
                      <div class="col-12 ">


                  <span>1</span>

                      </div>
                    </td>


           </tr>
           <tr>
                   <td>
                    <div class=" margin_t ">
                            <span> 請求締め日 </span>
                     </div>
                    </td>
                      <td>
                      <div class="col-12 ">


                  <span>20</span>

                      </div>
                    </td>


           </tr>
           <tr>
                   <td>
                    <div class=" margin_t ">
                            <span> 入金方法 </span>
                     </div>
                    </td>
                      <td>
                      <div class="col-12 ">


                  <span>2</span>

                      </div>
                    </td>


           </tr>
           <tr>
                   <td>
                    <div class=" margin_t ">
                            <span>回収月  </span>
                     </div>
                    </td>
                      <td>
                      <div class="col-12 ">


                  <span>1</span>

                      </div>
                    </td>


           </tr>
           <tr>
                   <td>
                    <div class=" margin_t ">
                            <span>回収日  </span>
                     </div>
                    </td>
                      <td>
                      <div class="col-12 ">


                  <span>15</span>

                      </div>
                    </td>


           </tr>

           <tr>
                   <td>
                    <div class=" margin_t ">
                            <span> 回収日休日設定 </span>
                     </div>
                    </td>
                      <td>
                      <div class="col-12 ">


                  <span>11</span>

                      </div>
                    </td>


           </tr>
           <tr>
                   <td>
                    <div class=" margin_t ">
                            <span>入金時手数料設定  </span>
                     </div>
                    </td>
                      <td>
                      <div class="col-12 ">


                  <span>2</span>

                      </div>
                    </td>


           </tr>
           <tr>
                   <td style="width: 339px;padding-right: 6px;">
                    <div class=" margin_t ">
                            <span>保守更新案内有無  </span>
                     </div>
                    </td>
                      <td>
                      <div class="col-12 ">


                  <span></span>

                      </div>
                    </td>


           </tr>

           <tr>
                   <td style="width: 339px;padding-right: 6px;">
                    <div class=" margin_t ">
                            <span>検収条件  </span>
                     </div>
                    </td>
                      <td>
                      <div class="col-12 ">


                  <span></span>

                      </div>
                    </td>


           </tr>
           <tr>
                   <td>
                    <div class=" margin_t ">
                            <span>与信限度額  </span>
                     </div>
                    </td>
                      <td>
                      <div class="col-12 ">


                  <span></span>

                      </div>
                    </td>


           </tr>


<tr>
                   <td>
                    <div class=" margin_t ">
                            <span> 124　百万円 </span>
                     </div>
                    </td>
                      <td>
                      <div class="col-12 ">


                  <span></span>

                      </div>
                    </td>


           </tr>


<tr>
                   <td>
                    <div class=" margin_t ">
                            <span> 請求先 </span>
                     </div>
                    </td>
                      <td>
                      <div class="col-12 ">


                  <span>22123456789</span>

                      </div>
                    </td>


           </tr>


          <tr>
                   <td>
                    <div class=" margin_t ">
                            <span>請求書送付日  </span>
                     </div>
                    </td>
                      <td>
                      <div class="col-12 ">


                  <span>12</span>

                      </div>
                    </td>


           </tr>
            <tr>
                   <td>
                    <div class=" margin_t ">
                            <span> 請求書メール区分 </span>
                     </div>
                    </td>
                      <td>
                      <div class="col-12 ">


                  <span>2</span>

                      </div>
                    </td>


           </tr>
            <tr>
                   <td>
                    <div class=" margin_t ">
                            <span> 請求書メール宛先 </span>
                     </div>
                    </td>
                      <td>
                      <div class="col-12 ">


                  <span>77987654321</span>

                      </div>
                    </td>


           </tr>
            <tr>
                   <td>
                    <div class=" margin_t ">
                            <span> 請求書UIS </span>
                     </div>
                    </td>
                      <td>
                      <div class="col-12 ">


                  <span>2</span>

                      </div>
                    </td>


           </tr>
            <tr>
                   <td>
                    <div class=" margin_t ">
                            <span> 請求書郵送 </span>
                     </div>
                    </td>
                      <td>
                      <div class="col-12 ">


                  <span>1</span>

                      </div>
                    </td>


           </tr>
            <tr>
                   <td>
                    <div class=" margin_t ">
                            <span> 請求書郵送先 </span>
                     </div>
                    </td>
                      <td>
                      <div class="col-12 ">


                  <span></span>

                      </div>
                    </td>


           </tr>
            <tr>
                   <td>
                    <div class=" margin_t ">
                            <span>請求税区分  </span>
                     </div>
                    </td>
                      <td>
                      <div class="col-12 ">


                  <span>1236</span>

                      </div>
                    </td>


           </tr>
            <tr>
                   <td>
                    <div class=" margin_t ">
                            <span>  </span>
                     </div>
                    </td>
                      <td>
                      <div class="col-12 ">


                  <span></span>

                      </div>
                    </td>


           </tr>
            <tr>
                   <td>
                    <div class=" margin_t ">
                            <span> 請求税端数区分 </span>
                     </div>
                    </td>
                      <td>
                      <div class="col-12 ">


                  <span>2</span>

                      </div>
                    </td>


           </tr>
            <tr>
                   <td style="padding-right: 6px;">
                    <div class=" margin_t ">
                            <span> 請求消費税計算区分 </span>
                     </div>
                    </td>
                      <td>
                      <div class="col-12 ">


                  <span></span>

                      </div>
                    </td>


           </tr>
            <tr>
                   <td style="padding-right: 6px:">
                    <div class=" margin_t ">
                            <span> 専伝区分 </span>
                     </div>
                    </td>
                      <td>
                      <div class="col-12 ">


                  <span>1</span>

                      </div>
                    </td>


           </tr>
            <tr>
                   <td>
                    <div class=" margin_t ">
                            <span> 指定納品書帳票コード </span>
                     </div>
                    </td>
                      <td>
                      <div class="col-12 ">


                  <span>46461236</span>

                      </div>
                    </td>


           </tr>


                  <tr>
                   <td>
                    <div class=" margin_t ">
                            <span>単価設定区分  </span>
                     </div>
                    </td>
                      <td>
                      <div class="col-12 ">


                  <span></span>

                      </div>
                    </td>


           </tr>
                  <tr>
                   <td>
                    <div class=" margin_t ">
                            <span> 得意先分類1 </span>
                     </div>
                    </td>
                      <td>
                      <div class="col-12 ">


                  <span>65456</span>

                      </div>
                    </td>


           </tr>
                  <tr>
                   <td>
                    <div class=" margin_t ">
                            <span> 得意先分類2 </span>
                     </div>
                    </td>
                      <td>
                      <div class="col-12 ">


                  <span>65521</span>

                      </div>
                    </td>


           </tr>
                 <tr>
                   <td>
                    <div class=" margin_t ">
                            <span> 得意先分類3 </span>
                     </div>
                    </td>
                      <td>
                      <div class="col-12 ">


                  <span></span>

                      </div>
                    </td>


           </tr>
                      <tr>
                   <td>
                    <div class=" margin_t ">
                            <span> 得意先分類4 </span>
                     </div>
                    </td>
                      <td>
                      <div class="col-12 ">


                  <span></span>

                      </div>
                    </td>


           </tr>
                      <tr>
                   <td>
                    <div class=" margin_t ">
                            <span> 得意先分類5 </span>
                     </div>
                    </td>
                      <td>
                      <div class="col-12 ">


                  <span></span>

                      </div>
                    </td>


           </tr>
                      <tr>
                   <td>
                    <div class=" margin_t ">
                            <span> 得意先分類6 </span>
                     </div>
                    </td>
                      <td>
                      <div class="col-12 ">


                  <span></span>

                      </div>
                    </td>


           </tr>
                  <tr>
                   <td>
                    <div class=" margin_t ">
                            <span> ユーザー区分 </span>
                     </div>
                    </td>
                      <td>
                      <div class="col-12 ">


                  <span>2</span>

                      </div>
                    </td>


           </tr>
                  <tr>
                   <td>
                    <div class=" margin_t ">
                            <span> データソース </span>
                     </div>
                    </td>
                      <td>
                      <div class="col-12 ">


                  <span>4</span>

                      </div>
                    </td>


           </tr>
                  <tr>
                   <td>
                    <div class=" margin_t ">
                            <span> 取引先開始日　東直 </span>
                     </div>
                    </td>
                      <td>
                      <div class="col-12 ">


                  <span></span>

                      </div>
                    </td>


           </tr>
                  <tr>
                   <td>
                    <div class=" margin_t ">
                            <span>取引先開始日　東流  </span>
                     </div>
                    </td>
                      <td>
                      <div class="col-12 ">


                  <span></span>

                      </div>
                    </td>


           </tr>
                  <tr>
                   <td>
                    <div class=" margin_t ">
                            <span> 取引先開始日　西直 </span>
                     </div>
                    </td>
                      <td>
                      <div class="col-12 ">


                  <span></span>

                      </div>
                    </td>


           </tr>
                  <tr>
                   <td>
                    <div class=" margin_t ">
                            <span>取引先開始日　西流  </span>
                     </div>
                    </td>
                      <td>
                      <div class="col-12 ">


                  <span></span>

                      </div>
                    </td>


           </tr>
             <tr style="background-color: #8DB4E2;">
                    <td colspan="2" style="text-align: center!important;">仕入・支払</td>
                  </tr>


                  <tr>
                   <td>
                    <div class=" margin_t ">
                            <span> 支払締め日</span>
                     </div>
                    </td>
                      <td>
                      <div class="col-12 ">


                  <span></span>

                      </div>
                    </td>


           </tr>
                         <tr>
                   <td>
                    <div class=" margin_t ">
                            <span> 支払月 </span>
                     </div>
                    </td>
                      <td>
                      <div class="col-12 ">


                  <span></span>

                      </div>
                    </td>


           </tr>
                         <tr>
                   <td>
                    <div class=" margin_t ">
                            <span> 支払日 </span>
                     </div>
                    </td>
                      <td>
                      <div class="col-12 ">


                  <span></span>

                      </div>
                    </td>


           </tr>
                         <tr>
                   <td>
                    <div class=" margin_t ">
                            <span> 支払休日設定 </span>
                     </div>
                    </td>
                      <td>
                      <div class="col-12 ">


                  <span></span>

                      </div>
                    </td>


           </tr>
                         <tr>
                   <td>
                    <div class=" margin_t ">
                            <span> 支払振込手数料設定 </span>
                     </div>
                    </td>
                      <td>
                      <div class="col-12 ">


                  <span></span>

                      </div>
                    </td>


           </tr>
                         <tr>
                   <td>
                    <div class=" margin_t ">
                            <span>支払方法  </span>
                     </div>
                    </td>
                      <td>
                      <div class="col-12 ">


                  <span></span>

                      </div>
                    </td>


           </tr>

                  <tr>
                   <td>
                    <div class=" margin_t ">
                            <span>振込銀行  </span>
                     </div>
                    </td>
                      <td>
                      <div class="col-12 ">


                  <span></span>

                      </div>
                    </td>


           </tr>
                  <tr>
                   <td>
                    <div class=" margin_t ">
                            <span> 振込支店 </span>
                     </div>
                    </td>
                      <td>
                      <div class="col-12 ">


                  <span></span>

                      </div>
                    </td>


           </tr>
                  <tr>
                   <td>
                    <div class=" margin_t ">
                            <span>  預金種別</span>
                     </div>
                    </td>
                      <td>
                      <div class="col-12 ">


                  <span></span>

                      </div>
                    </td>


           </tr>
                  <tr>
                   <td>
                    <div class=" margin_t ">
                            <span> 口座番号 </span>
                     </div>
                    </td>
                      <td>
                      <div class="col-12 ">


                  <span></span>

                      </div>
                    </td>


           </tr>
                  <tr>
                   <td>
                    <div class=" margin_t ">
                            <span>口座名義人  </span>
                     </div>
                    </td>
                      <td>
                      <div class="col-12 ">


                  <span></span>

                      </div>
                    </td>


           </tr>



      <tr>
                   <td>
                    <div class=" margin_t ">
                            <span>  仕向銀行 </span>
                     </div>
                    </td>
                      <td>
                      <div class="col-12 ">


                  <span></span>

                      </div>
                    </td>


           </tr>
                 <tr>
                   <td>
                    <div class=" margin_t ">
                            <span> 仕向支店 </span>
                     </div>
                    </td>
                      <td>
                      <div class="col-12 ">


                  <span></span>

                      </div>
                    </td>


           </tr>
                 <tr>
                   <td>
                    <div class=" margin_t ">
                            <span>支払税区分  </span>
                     </div>
                    </td>
                      <td>
                      <div class="col-12 ">


                  <span></span>

                      </div>
                    </td>


           </tr>
                 <tr>
                   <td>
                    <div class=" margin_t ">
                            <span> 支払税端数区分 </span>
                     </div>
                    </td>
                      <td>
                      <div class="col-12 ">


                  <span></span>

                      </div>
                    </td>


           </tr>
                 <tr>
                   <td>
                    <div class=" margin_t ">
                            <span> 源泉区分 </span>
                     </div>
                    </td>
                      <td>
                      <div class="col-12 ">


                  <span></span>

                      </div>
                    </td>


           </tr>
                 <tr>
                   <td>
                    <div class=" margin_t ">
                            <span> 手形決済月 </span>
                     </div>
                    </td>
                      <td>
                      <div class="col-12 ">


                  <span></span>

                      </div>
                    </td>


           </tr>
                 <tr>
                   <td>
                    <div class=" margin_t ">
                            <span> 手形決済日 </span>
                     </div>
                    </td>
                      <td>
                      <div class="col-12 ">


                  <span></span>

                      </div>
                    </td>


           </tr>
                 <tr>
                   <td>
                    <div class=" margin_t ">
                            <span>仕入消費税計算区分  </span>
                     </div>
                    </td>
                      <td>
                      <div class="col-12 ">


                  <span></span>

                      </div>
                    </td>


           </tr>





                </tbody></table>
              </div>
      </div>
                </div>



           <div class="modal-footer">

                </div>
                </div>

        </div>
    </div>




<!--==================================checkbox modal sales billing==============================-->
 <div class="modal fade" data-backdrop="static" id="checkbox_modal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true"style="z-index: 1055!important;">
        <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 1050px!important;">
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


  <div class="table_wrap">
<div class=" page4_table_design mt-2  table_hover  table-head-only">
                                        <table class="table table-striped table-bordered" id="table-basic">
                                            <thead class="thead-dark header text-center" id="myHeader">
                                                <tr>

                                                    <th scope="col"style="background-color: #c2d6d6!important;color: #17252A;"> 番号</th>
                                                    <th scope="col"style="background-color: #c2d6d6!important;color: #17252A;">会社名</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                <tr class="table_hover2 gridAlternada">

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
<table class="table table-bordered">

        <thead class="thead-dark header text-center" id="myHeader">
                                                <tr>

                                                    <th scope="col"style="background-color: #c2d6d6!important;color: #17252A;"> 番号</th>
                                                    <th scope="col"style="background-color: #c2d6d6!important;color: #17252A;">事務所名</th>
                                                   <th scope="col"style="background-color: #c2d6d6!important;color: #17252A;">住所</th>
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
 </div>
 </div>
<!-- 2nd modal content end -->

<!-- 3rd modal content  -->
   <div class="row" >
    <div class="col-lg-6">


                  <h4 style="margin-bottom: 15px; margin-top: 10px;">個人マスタ</h4>





<div style="width: 99%;">
<table class="table table-bordered">

        <thead class="thead-dark header text-center" id="myHeader">
                                                <tr>

                                                    <th scope="col"style="background-color: #c2d6d6!important;color: #17252A;"> 番号</th>
                                                    <th scope="col"style="background-color: #c2d6d6!important;color: #17252A;">氏名</th>
                                                   <th scope="col"style="background-color: #c2d6d6!important;color: #17252A;">部署</th>
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



                          <table class="table table-striped table-bordered" id="table-basic">

                                <tbody>

                                  <tr>
                                       <td style="width: 112px;background-color: #c2d6d6!important;">番号</td>
                                      <td style="width: 300px;"> 11</td>

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



<script type="text/javascript">


$(function()
{
  $('#chkCodeudor').click(function()
        {
            if ($('#chkCodeudor').is(":checked")) {
                $('#checkbox_modal').modal('show');
            }else {
                $('#checkbox_modal').modal('hide');
            }
        });

});


$(function()
{

  $('#chkCodeudor1').click(function()
        {
            if ($('#chkCodeudor1').is(":checked")) {
                $('#checkbox_modal2').modal('show');
            }else {
                $('#checkbox_modal2').modal('hide');
            }
        });

});




</script>
<!--------------------------Modal 3 comp1  table start------------------------->



<!--===================================MODAL 2 END==============================-->





<!-- </div> -->


<div class="modal fade" data-keyboard="false" data-backdrop="static"id="comp_modal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" style="max-width: 1050px;z-index: 1052;" role="document">
            <div class="modal-content">
                  <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">会社マスタ</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                      </button>
                    </div>
                <div class="modal-body">
                    <div class="development_page_top_table heading_mt" style="margin:0 2px;">

                        <!--=======================Modal 2 button start ======================-->

                        <div class="row titlebr" style="margin-bottom: 15px;">
                     <div class="col-lg-6"></div>
  <div class="col-lg-6">
    <table class="dev_tble_button" style="float: right;margin-right: 14px;">
      <tbody>
        <tr class="marge_in">


                   <td class="" style="padding-right: 10px!important;">

             <a class="btn btn-info scroll" style="background-color: #3e6ec1!important;"data-toggle="modal" data-target="#"><i class="fa fa-trash" style="margin-right: 7px;">
        </i>削除
</a>


           </td>
           <td class="" style="padding-left: 0px!important;width: 70px!important; ">
               <a class="btn btn-info scroll" id="comp_button3" style="background-color: #3e6ec1!important;"data-toggle="modal" data-target="#comp_modal3"> <i class="fa fa-pencil-square-o" aria-hidden="true" style="margin-right: 5px;"></i>変更画面へ</a></td>

        <td class="" style="padding-left: 10px!important;">

             <a class="btn btn-info scroll" style="background-color: #3e6ec1!important;"data-toggle="modal" data-target="#"><i class="fa fa-print" style="margin-right: 7px;">
        </i>印刷
</a>


           </td>
        </tr>
      </tbody>
    </table>

  </div>

</div>
</div>

<!--=======================Modal 2 button wrapper end ======================-->


<div class="container h-100 py-2">
    <ul class="nav nav-tabs " id="myTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link  active show" id="common2-tab" data-toggle="tab" href="#common2" role="tab" aria-controls="common2" aria-selected="true"><b>共通</b>
</a>
        </li>
        <li class="nav-item">
            <a class="nav-link " id="sales_billing2_tab" data-toggle="tab" href="#sales_billing2" role="tab" aria-controls="sales_billing2" aria-selected="false"><b>売上・請求</b>
</a>
        </li>
        <li class="nav-item">
            <a class="nav-link " id="payment2-tab" data-toggle="tab" href="#payment2" role="tab" aria-controls="payment2" aria-selected="false"><b>仕入・支払</b>
</a>
        </li>

    </ul>

    <div class="tab-content">
        <div class="tab-pane h-200 p-3 border active show" id="common2" role="tabpanel" aria-labelledby="common2-tab">


        <div class="row mt-1 mb-3">
        <div class="col-lg-12 col-md-12">
            <div class="tbl_product w-100">
<div class=" row row_data">
      <div class="col-lg-2 col-md-2">
       <div class="margin_t ">
          <span>会社CD <span style="color: red;">※</span></span>
     </div>

  </div>
<div class="col-lg-8 col-md-8">

    <div class="outer row">
           <div class="col-lg-4 col-md-4">
<div class="m_t">12345</div>
        </div>

          <div class="col-lg-3 col-md-3 ">
<div class="m_t">法人マイナンバー</div>



        </div>
  <div class="col-lg-3 col-md-4 ">

<div class="m_t">999999999</div>

        </div>

 </div>

  </div>

  </div>


  <div class=" row row_data">
      <div class="col-lg-2 col-md-2">
   <div class="margin_t ">
  <span>会社名<span style="color: red;">※</span></span>
 </div>


  </div>
<div class="col-lg-10 col-md-10">

    <div class="outer row">
           <div class="col-lg-12 col-md-12">

          <div class="m_t">株式会社ジョイアス・フーズ</div>
        </div>

 </div>

  </div>

  </div>

    <div class=" row row_data">
      <div class="col-lg-2 col-md-2">
   <div class="margin_t ">
  <span>会社名略称</span>
 </div>


  </div>
<div class="col-lg-10 col-md-10">

    <div class="outer row">
           <div class="col-lg-12 col-md-12 ">
          <div class="m_t">ジョイアス</div>
        </div>

 </div>

  </div>

  </div>

    <div class=" row row_data">
      <div class="col-lg-2 col-md-2">
   <div class="margin_t ">
  <span>会社名カナ</span>
 </div>


  </div>
<div class="col-lg-10 col-md-10">

    <div class="outer row">
           <div class="col-lg-12 ">

          <div class="m_t">ジョイアスフーズ</div>
        </div>

 </div>

  </div>

  </div>
    <div class=" row row_data">
      <div class="col-lg-2 col-md-2">
   <div class="margin_t ">
  <span>会社名カナ入金消込用
</span>
 </div>


  </div>
<div class="col-lg-10 col-md-10">

    <div class="outer row">
           <div class="col-lg-12 col-md-12 ">

          <div class="m_t"></div>
        </div>

 </div>

  </div>

  </div>

            </div>
          </div>
     </div>

  <div class="row mt-1 mb-3">
        <div class="col-lg-6 col-md-6">
            <div class="tbl_product w-100">


<div class=" row row_data">
      <div class="col-lg-3 col-md-3">
   <div class="margin_t ">
      <span>入力区分</span>
 </div>

  </div>
<div class="col-lg-9 col-md-9">

    <div class="outer row">
           <div class="col-lg-12 col-md-12 ">
<div class="m_t">0</div>
        </div>

 </div>

  </div>

  </div>




            </div>
          </div>


                  <div class="col-lg-6 col-md-6">
            <div class="tbl_product w-100">


<div class=" row row_data">
      <div class="col-lg-3">
   <div class="margin_t ">
      <span>会計取引先CD</span>
 </div>

  </div>
<div class="col-lg-9 col-md-9">

    <div class="outer row">
           <div class="col-lg-12 col-md-12 ">
            <div class="m_t">未使用</div>

        </div>

 </div>

  </div>

  </div>




            </div>
          </div>
        </div>


          <div class="row mt-1 mb-3">
        <div class="col-lg-7 col-md-7">
            <div class="tbl_product w-100">


<div class=" row row_data">
      <div class="col-lg-4 col-md-4">
   <div class="margin_t ">
      <span>帝国ﾃﾞｰﾀﾊﾞﾝｸ信用録PDF</span>
 </div>

  </div>
<div class="col-lg-8 col-md-8">

    <div class="outer row">
           <div class="col-lg-12 col-md-12 ">
   <div class="m_t">ZZZ0011</div> <div></div>
        </div>

 </div>

  </div>

  </div>
<div class=" row row_data">
      <div class="col-lg-4 col-md-4">
   <div class="margin_t ">
      <span>帝国ﾃﾞｰﾀﾊﾞﾝｸ取得年月日</span>
 </div>

  </div>
<div class="col-lg-8 col-md-8">

    <div class="outer row">
           <div class="col-lg-12 col-md-12 ">
   <div class="m_t">20191119</div>
        </div>

 </div>

  </div>

  </div>

<div class=" row row_data">
      <div class="col-lg-4 col-md-4">
   <div class="margin_t ">
      <span>帝国ﾃﾞｰﾀﾊﾞﾝｸ企業CD</span>
 </div>

  </div>
<div class="col-lg-8 col-md-8">

    <div class="outer row">
           <div class="col-lg-12 col-md-12 ">
   <div class="m_t">881234567</div>
        </div>

 </div>

  </div>

  </div>
<div class=" row row_data">
      <div class="col-lg-4 col-md-4">
   <div class="margin_t ">
      <span>帝国ﾃﾞｰﾀﾊﾞﾝｸ評点</span>
 </div>

  </div>
<div class="col-lg-8 col-md-8">

    <div class="outer row">
           <div class="col-lg-12 col-md-12 ">
   <div class="m_t">11</div>
        </div>

 </div>

  </div>

  </div>

  <div class=" row row_data">
      <div class="col-lg-4 col-md-4">
   <div class="margin_t ">
      <span>経済産業省業種区分2</span>
 </div>

  </div>
<div class="col-lg-8 col-md-8">

    <div class="outer row">
           <div class="col-lg-12 col-md-12">
   <div class="m_t">A 農業</div>
        </div>

 </div>

  </div>

  </div>
    <div class=" row row_data">
      <div class="col-lg-4 col-md-4">
   <div class="margin_t ">
      <span>経済産業省業種区分2</span>
 </div>

  </div>
<div class="col-lg-8 col-md-8">

    <div class="outer row">
           <div class="col-lg-12 col-md-12">

                  <div class="m_t">農業</div>
        </div>

 </div>

  </div>

  </div>
            </div>
          </div>


                  <div class="col-lg-5 col-md-5">
            <div class="tbl_product w-100">


<div class=" row row_data">
      <div class="col-lg-3 col-md-3">
   <div class="margin_t ">
      <span>会社分類1</span>
 </div>

  </div>
<div class="col-lg-9 col-md-9">

    <div class="outer row">
           <div class="col-lg-12 col-md-12 ">
<div class="m_t">製造業</div>
        </div>

 </div>

  </div>

  </div>
<div class=" row row_data">
      <div class="col-lg-3 col-md-3">
   <div class="margin_t ">
      <span>会社分類2</span>
 </div>

  </div>
<div class="col-lg-9 col-md-9">

    <div class="outer row">
           <div class="col-lg-12 col-md-12">
<div class="m_t">01～5000万円</div>
        </div>

 </div>

  </div>

  </div>
<div class=" row row_data">
      <div class="col-lg-3 col-md-3">
   <div class="margin_t ">
      <span>会社分類3</span>
 </div>

  </div>
<div class="col-lg-9 col-md-9">

    <div class="outer row">
           <div class="col-lg-12 col-md-12 ">
<div class="m_t">1～50人未満</div>
        </div>

 </div>

  </div>

  </div>
<div class=" row row_data">
      <div class="col-lg-3 col-md-3">
   <div class="margin_t ">
      <span>会社分類4</span>
 </div>

  </div>
<div class="col-lg-9 col-md-9">

    <div class="outer row">
           <div class="col-lg-12 col-md-12 ">
<div class="m_t">資本金：～1000万円</div>
        </div>

 </div>

  </div>

  </div>
<div class=" row row_data">
      <div class="col-lg-3 col-md-3">
   <div class="margin_t ">
      <span>会社分類5</span>
 </div>

  </div>
<div class="col-lg-9 col-md-9">

    <div class="outer row">
           <div class="col-lg-12 col-md-12 ">
<div class="m_t"> 未使用</div>
        </div>

 </div>

  </div>

  </div>       </div>
          </div>
        </div>
         <div class="row mt-1 mb-3">
        <div class="col-lg-6 col-md-6">
            <div class="tbl_product w-100">


<div class=" row row_data">
      <div class="col-lg-3 col-md-3">
   <div class="margin_t ">
      <span>社内備考</span>
 </div>

  </div>
<div class="col-lg-9 col-md-9">

    <div class="outer row">
           <div class="col-lg-12 col-md-12">
              <div class="m_t">
                 99
              </div>
        </div>

 </div>

  </div>

  </div>

            </div>
          </div>


          <div class="col-lg-6 col-md-6">
            <div class="tbl_product w-100">

<div class=" row row_data">
      <div class="col-lg-2 col-md-2">
   <div class="margin_t ">
      <span>売 上</span>
 </div>

  </div>
<div class="col-lg-9 col-md-9">

    <div class="outer row">
           <div class="col-lg-2 col-md-2 ">
<div class="m_t">1</div>
        </div>
   <!-- <div class="col-lg-4 ">
        <div class="m_t">あり</div>
    </div> -->
         <div class="col-lg-6 col-md-6">
<div class="m_t">0：なし、1：あり</div>
        </div>

 </div>

  </div>

  </div>

 <div class=" row row_data">
      <div class="col-lg-2 col-md-2">
   <div class="margin_t ">
      <span>仕 入</span>
 </div>

  </div>
<div class="col-lg-9 col-md-9">

    <div class="outer row">
           <div class="col-lg-2 col-md-2">
<div class="m_t">1</div>
        </div>

<!--   <div class="col-lg-4 ">
<div class="m_t">あり</div>
  </div> -->
         <div class="col-lg-6 col-md-6">
<div class="m_t">0：なし、1：あり</div>
        </div>

 </div>

  </div>

  </div>
            </div>
          </div>
        </div>



</div>


<!-- sales and billing tabbed menu -->


<div class="tab-pane fade h-100 p-3 border" id="sales_billing2" role="tabpanel" aria-labelledby="sales_billing2_tab">


  <div class="row mt-1 mb-3">
        <div class="col-lg-7 col-md-7 ">
            <div class="tbl_company w-100">

  <div class=" row row_data">
      <div class="col-lg-3 col-md-3">
     <div class="margin_t "><span>
即時区分</span></div>
  </div>
<div class="col-lg-4 col-md-4">


   <div>
<div class="m_t">1 即時</div>

    </div>
  </div>
  <div class="col-lg-2 col-md-2 d-none">
      <div class="m_t"></div>
  </div>
  <div class="col-lg-3 col-md-3">
      <div>1：即時、2：締め日</div>
  </div>

  </div>

  <div class=" row row_data">
      <div class="col-lg-3 col-md-3">
     <div class="margin_t "><span>
請求締め日</span></div>
  </div>
<div class="col-lg-9 col-md-9">

<div class="m_t">01</div>

</div>

<!--   <div class="col-lg-5 d-none">
      <div class="m_t"></div>
  </div> -->

  </div>
  <div class=" row row_data">
      <div class="col-lg-3 col-md-3">
     <div class="margin_t "><span>
入金方法</span></div>
  </div>
<div class="col-lg-9 col-md-9">

  <div class="m_t">01 現金・小切手</div>

  </div>

<!--   <div class="col-lg-5 d-none">
      <div class="m_t"></div>
  </div> -->

  </div>

  <div class=" row row_data">
      <div class="col-lg-3 col-md-3">
     <div class="margin_t "><span>
回収月</span></div>
  </div>
<div class="col-lg-4 col-md-4">

   <div class="m_t">1 翌月</div>
  </div>

  <div class="col-lg-5 col-md-5">
      <div class="m_t">0：当月、1：翌日、2：翌々月、</div>
   <div class="m_t">3：3か月、4：4か月</div>
  </div>

  </div>
    <div class=" row row_data">
      <div class="col-lg-3 col-md-3">
     <div class="margin_t "><span>
回収日</span></div>
  </div>
<div class="col-lg-4 col-md-4">


   <div class="m_t">
1

    </div>
  </div>

  <div class="col-lg-5 col-md-5">
      <div class="m_t"></div>
  </div>

  </div>


    <div class=" row row_data">
      <div class="col-lg-3 col-md-3">
     <div class="margin_t "><span>
回収日休日設定
</span></div>
  </div>
<div class="col-lg-4 col-md-4">

   <div class="m_t">1 翌営業日 </div>
  </div>

  <div class="col-lg-5 col-md-5">
      <div class="m_t">1：翌営業日、2：前営業日</div>

  </div>

  </div>
      <div class=" row row_data">
      <div class="col-lg-3 col-md-3">
     <div class="margin_t "><span>
入金時手数料設定
</span></div>
  </div>
<div class="col-lg-4 col-md-4">


   <div class="m_t">1 自社</div>
  </div>

  <div class="col-lg-5 col-md-5">
      <div class="m_t">1：自社、2：先方</div>

  </div>

  </div>

            </div>
          </div>

  <div class="col-lg-5 col-md-5">
    <div class="tbl_company w-100">

  <div class=" row row_data">
      <div class="col-lg-4 col-md-4">
     <div class="margin_t "><span>
保守更新案内有無</span></div>
  </div>
<div class="col-lg-4 col-md-4">

     <div class="m_t">1 有</div>
  </div>

<div class="col-lg-4 col-md-4">
      <div class="m_t">1：有、2：無</div>
  </div>
  </div>


    <div class=" row row_data">
      <div class="col-lg-4 col-md-4">
     <div class="margin_t "><span>
ライセンス証書有無
</span></div>
  </div>
<div class="col-lg-4 col-md-4">
 <div class="m_t">1 有</div>
  </div>

<div class="col-lg-4 col-md-4">
      <div class="m_t">1：有、2：無</div>
  </div>
  </div>

    <div class=" row row_data">
      <div class="col-lg-4 col-md-4">
     <div class="margin_t "><span>
検収条件
</span></div>
  </div>
<div class="col-lg-8 col-md-8">
 <div class="m_t">01納品完了確認書 貴社捺印時
</div>
  </div>


  </div>
      <div class=" row row_data">
      <div class="col-lg-4 col-md-4">
     <div class="margin_t "><span>
与信限度額
</span></div>
  </div>
<div class="col-lg-4 col-md-4">

      <div class="m_t">
         1
      </div>
  </div>

<div class="col-lg-4 col-md-4">
      <div class="m_t">百万円</div>
  </div>
  </div>

            </div>
          </div>
        </div>

<!-- 2nd tab1 row -->

  <div class="row mt-1 mb-3">
        <div class="col-lg-10 col-md-10">
            <div class="tbl_company w-100">

<div class=" row row_data">
      <div class="col-lg-3 col-md-3">
     <div class="margin_t "><span>請求先CD
</span></div>
  </div>
<div class="col-lg-9 col-md-9">

    <div class="outer row">
     <div class="col-lg-6 col-md-6 ">
            <div class="m_t">

      </div>


    </div>
   <div class="col-lg-6 col-md-6 d-none "></div>
    </div>
  </div>

  </div>
<div class=" row row_data">
      <div class="col-lg-3 col-md-3">
     <div class="margin_t "><span>請求書送付日</span></div>
  </div>
<div class="col-lg-9 col-md-9">

    <div class="outer row">
     <div class="col-lg-6 col-md-6 ">
        <div class="m_t">

      </div>


    </div>
 <div class="col-lg-6 col-md-6 d-none "></div>
    </div>
  </div>

  </div>

    <div class=" row row_data">
      <div class="col-lg-3 col-md-3">
     <div class="margin_t "><span>請求書メール区分</span></div>
  </div>
<div class="col-lg-9 col-md-9">

    <div class="outer row">
     <div class="col-lg-4 col-md-4">
  <div class="m_t">
      1 PDFﾒｰﾙ送信

      </div>

    </div>
<!--      <div class="col-lg-6 d-none "></div> -->
         <div class="col-lg-8 col-md-8 ">
<div class="m_t">1：PDFﾒｰﾙ送信、2：ﾒｰﾙ不要</div>

    </div>

    </div>
  </div>

  </div>

    <div class=" row row_data">
      <div class="col-lg-3 col-md-3">
     <div class="margin_t "><span>請求書メール宛先</span></div>
  </div>
<div class="col-lg-9 col-md-9">

    <div class="outer row">
     <div class="col-lg-6 col-md-6 ">
  <div class="m_t">

      </div>

    </div>


    </div>
  </div>

  </div>
      <div class=" row row_data">
      <div class="col-lg-3 col-md-3">
     <div class="margin_t "><span>請求書UIS</span></div>
  </div>
<div class="col-lg-9 col-md-9">

    <div class="outer row">
     <div class="col-lg-4 col-md-4 ">
  <div class="m_t">2 UIS不要</div>

    </div>
  <!--      <div class="col-lg-6 d-none "></div> -->
         <div class="col-lg-8 col-md-8 ">
<div class="m_t">1：PDF-UIS、2：UIS不要</div>

    </div>

    </div>
  </div>

  </div>

        <div class=" row row_data">
      <div class="col-lg-3 col-md-3">
     <div class="margin_t "><span>請求書郵送</span></div>
  </div>
<div class="col-lg-9 col-md-9">

    <div class="outer row">
     <div class="col-lg-4 col-md-4">
  <div class="m_t"> 1 郵送 </div>

    </div>
<!--      <div class="col-lg-6 d-none "></div> -->
         <div class="col-lg-8 col-md-8">
<div class="m_t">1：郵送、2：不要</div>

    </div>

    </div>
  </div>

  </div>

          <div class=" row row_data">
      <div class="col-lg-3 col-md-3">
     <div class="margin_t "><span>請求書郵送先</span></div>
  </div>
<div class="col-lg-9 col-md-9">

    <div class="outer row">
     <div class="col-lg-4 col-md-4">
  <div class="m_t">

      </div>

    </div>
<!--   <div class="col-lg-6 d-none "></div> -->
      <div class="col-lg-8 col-md-8"></div>
    </div>
  </div>

  </div>

            <div class=" row row_data">
      <div class="col-lg-3 col-md-3">
     <div class="margin_t "><span>請求税区分</span></div>
  </div>
<div class="col-lg-9 col-md-9">

    <div class="outer row">
     <div class="col-lg-4 col-md-4 ">
        <div class="m_t">
         00 対象外・非課税
      </div>


    </div>
<!--   <div class="col-lg-6 d-none "></div> -->
      <div class="col-lg-8 col-md-8 "></div>
    </div>
  </div>

  </div>
            <div class=" row row_data">
      <div class="col-lg-3 col-md-3">
     <div class="margin_t "><span>請求税端数区分</span></div>
  </div>
<div class="col-lg-9 col-md-9">

    <div class="outer row">
     <div class="col-lg-4 col-md-4">
       <div class="m_t">
1 四捨五入
      </div>

    </div>
<!--    <div class="col-lg-6 d-none "></div> -->
      <div class="col-lg-8 col-md-8 "></div>
    </div>
  </div>

  </div>



 <div class=" row row_data">
      <div class="col-lg-3 col-md-3">
     <div class="margin_t "><span>請求消費税計算区分
</span></div>
  </div>
<div class="col-lg-9 col-md-9">

    <div class="outer row">
     <div class="col-lg-4 col-md-4 ">
       <div class="m_t">1 伝票単位 </div>

    </div>
<!--     <div class="col-lg-6 d-none "></div> -->
         <div class="col-lg-8 col-md-8 ">
<div class="m_t">&nbsp;1：伝票単位、2：明細単位</div></div>

    </div>
  </div>

  </div>


    </div>
          </div>
        </div>
  <div class="row mt-1 mb-3">
        <div class="col-lg-7 col-md-7">
            <div class="tbl_company w-100">

<div class=" row row_data">
      <div class="col-lg-4 col-md-4">
     <div class="margin_t "><span>専伝区分</span></div>
  </div>
<div class="col-lg-8 col-md-8">

    <div class="outer row">
     <div class="col-lg-7 col-md-7 ">
      <div class="m_t"> 1 有 </div>


    </div>
      <div class="col-lg-5 col-md-5 ">

      <div class="m_t">1：有、2：無</div>

    </div>

    </div>
  </div>

  </div>
<div class=" row row_data">
      <div class="col-lg-4 col-md-4">
     <div class="margin_t "><span>指定納品書帳票CD
</span></div>
  </div>
<div class="col-lg-8 col-md-8">

    <div class="outer row">
     <div class="col-lg-7 col-md-7 ">

   <div class="m_t">  </div>

    </div>


    </div>
  </div>

  </div>
  <div class=" row row_data">
      <div class="col-lg-4 col-md-4">
     <div class="margin_t "><span>得意先分類1</span></div>
  </div>
<div class="col-lg-8 col-md-8">

    <div class="outer row">
     <div class="col-lg-7 col-md-7">
                 <div class="m_t"> 01 販売ランク NULL </div>


    </div>
     <div class="col-lg-5 col-md-5 d-none "></div>

    </div>
  </div>

  </div>

    <div class=" row row_data">
      <div class="col-lg-4 col-md-4">
     <div class="margin_t "><span>得意先分類2</span></div>
  </div>
<div class="col-lg-8 col-md-4">

    <div class="outer row">
     <div class="col-lg-7 col-md-7 ">
  <div class="m_t"> </div>

    </div>
        <div class="col-lg-5 col-md-5 d-none "></div>

    </div>
  </div>

  </div>


<div class=" row row_data">
      <div class="col-lg-3 col-md-3">
   <div class="margin_t ">
      <span>得意先分類3</span>
 </div>

  </div>
<div class="col-lg-9 col-md-9">

    <div class="outer row">
           <div class="col-lg-12 col-md-12">
<div class="m_t ml-45">未使用</div>
        </div>

 </div>

  </div>

  </div>

<div class=" row row_data">
      <div class="col-lg-3 col-md-3">
   <div class="margin_t ">
      <span>得意先分類4</span>
 </div>

  </div>
<div class="col-lg-9 col-md-9">

    <div class="outer row">
           <div class="col-lg-12 col-md-12 ">
<div class="m_t ml-45">未使用</div>
        </div>

 </div>

  </div>

  </div>
  <div class=" row row_data">
      <div class="col-lg-3 col-md-3">
   <div class="margin_t ">
      <span>得意先分類5</span>
 </div>

  </div>
<div class="col-lg-9 col-md-9">

    <div class="outer row">
           <div class="col-lg-12 col-md-12">
<div class="m_t ml-45">未使用</div>
        </div>

 </div>

  </div>

  </div>
  <div class=" row row_data">
      <div class="col-lg-3 col-md-3">
   <div class="margin_t ">
      <span>得意先分類6</span>
 </div>

  </div>
<div class="col-lg-9 col-md-9">

    <div class="outer row">
           <div class="col-lg-12 col-md-12 ">
<div class="m_t ml-45">未使用</div>
        </div>

 </div>

  </div>

  </div>

            </div>
          </div>


           <div class="col-lg-5 col-md-5">
            <div class="tbl_company w-100">

    <div class=" row row_data">
      <div class="col-lg-5 col-md-5">
     <div class="margin_t "><span>単価設定区分</span></div>
  </div>
<div class="col-lg-7 col-md-7">

    <div class="outer row">
     <div class="col-lg-12 col-md-12">
                 <div class="m_t"> 01 商品Mの標準単価 </div>

    </div>


    </div>
  </div>

  </div>
      <div class=" row row_data">
      <div class="col-lg-5 col-md-5">
     <div class="margin_t "><span>取引開始日 東直</span></div>
  </div>
<div class="col-lg-7 col-md-7">

    <div class="outer row">
     <div class="col-lg-12 col-md-12 ">
<div class="m_t"> </div>

    </div>


    </div>
  </div>

  </div>
     <!--  <div class=" row row_data">
      <div class="col-lg-5">
     <div class="margin_t "><span>取引開始日 東直</span></div>
  </div>
<div class="col-lg-7">

    <div class="outer row">
     <div class="col-lg-12 ">

<div class="m_t"> </div>

    </div>


    </div>
  </div>

  </div> -->
               <div class=" row row_data">
      <div class="col-lg-5 col-md-5">
     <div class="margin_t "><span>取引開始日 東流</span></div>
  </div>
<div class="col-lg-7 col-md-7">

    <div class="outer row">
     <div class="col-lg-12 col-md-12 ">

<div class="m_t"> </div>

    </div>


    </div>
  </div>

  </div>

   <div class=" row row_data">
      <div class="col-lg-5 col-md-5">
     <div class="margin_t "><span>取引開始日 西直
</span></div>
  </div>
<div class="col-lg-7 col-md-7">

    <div class="outer row">
     <div class="col-lg-12 col-md-12 ">

<div class="m_t"> </div>

    </div>


    </div>
  </div>

  </div>
   <div class=" row row_data">
      <div class="col-lg-5 col-md-5">
     <div class="margin_t "><span>取引開始日 西流
</span></div>
  </div>
<div class="col-lg-7 col-md-7">

    <div class="outer row">
     <div class="col-lg-12 col-md-12">

<div class="m_t"> </div>

    </div>


    </div>
  </div>

  </div>
   <div class=" row row_data">
      <div class="col-lg-5 col-md-5">
     <div class="margin_t "><span>ユーザー区分
</span></div>
  </div>
<div class="col-lg-7 col-md-7">

    <div class="outer row">
     <div class="col-lg-12 col-md-12 ">
            <div class="m_t">ﾕｰｻﾞｰ </div>


    </div>


    </div>
  </div>

  </div>

     <div class=" row row_data">
      <div class="col-lg-5 col-md-5">
     <div class="margin_t "><span>データソース
</span></div>
  </div>
<div class="col-lg-7 col-md-7">

    <div class="outer row">
     <div class="col-lg-12 col-md-12 ">
       <div class="m_t">資料請求 </div>

    </div>


    </div>
  </div>

  </div>
   </div>
          </div>
        </div>
<!-- 3rd tab1 row -->





      </div>

      <!-- sales and billing tabbed menu -->
        <div class="tab-pane fade h-100 p-3 border" id="payment2" role="tabpanel" aria-labelledby="payment2-tab">



  <div class="row mt-1 mb-3">
        <div class="col-lg-12 col-md-12">
            <div class="tbl_company w-100">


<div class=" row row_data">
      <div class="col-lg-2 col-md-2">
     <div class="margin_t "><span>支払締め日</span></div>
  </div>
<div class="col-lg-4 col-md-4">

    <div class="outer row">
     <div class="col-lg-12 col-md-12 ">
          <div class="m_t">10 10日締 </div>

    </div>

    </div>
  </div>

  <div class="col-lg-6 col-md-6">

    <div class="outer row">
     <div class="col-lg-12 col-md-12">

      <div class="m_t"></div>

    </div>

    </div>
  </div>

  </div>


<div class=" row row_data">
      <div class="col-lg-2 col-md-2">
     <div class="margin_t "><span>支払月</span></div>
  </div>
<div class="col-lg-4 col-md-4">

    <div class="outer row">
     <div class="col-lg-12 col-md-12 ">

<div class="m_t"> 0 当月</div>

    </div>

    </div>
  </div>

  <div class="col-lg-6 col-md-6">

    <div class="outer row">
     <div class="col-lg-12 col-md-12 ">

      <div class="m_t">0：当月、1：翌日、2：翌々月、3：3か月、4：4か月</div>

    </div>

    </div>
  </div>

  </div>

     <div class=" row row_data">
      <div class="col-lg-2 col-md-2">
     <div class="margin_t "><span>支払日</span></div>
  </div>
<div class="col-lg-4 col-md-4">

    <div class="outer row">
     <div class="col-lg-12 col-md-12 ">

<div class="m_t"> </div>

    </div>

    </div>
  </div>

  <div class="col-lg-6 col-md-6">

    <div class="outer row">
     <div class="col-lg-12 col-md-12 ">

      <div class="m_t"></div>

    </div>

    </div>
  </div>

  </div>

     <div class=" row row_data">
      <div class="col-lg-2 col-md-2">
     <div class="margin_t "><span>支払日休日設定</span></div>
  </div>
<div class="col-lg-4 col-md-4">

    <div class="outer row">
     <div class="col-lg-12 col-md-12">

     <div class="m_t">1 翌営業日 </div>

    </div>

    </div>
  </div>

  <div class="col-lg-6 col-md-6">

    <div class="outer row">
     <div class="col-lg-12 col-md-12 ">

      <div class="m_t">1：翌営業日、2：前営業日</div>

    </div>

    </div>
  </div>

  </div>
     <div class=" row row_data">
      <div class="col-lg-2 col-md-2">
     <div class="margin_t "><span>支払振込手数料設定</span></div>
  </div>
<div class="col-lg-4 col-md-4">

    <div class="outer row">
     <div class="col-lg-12 col-md-12 ">

      <div class="m_t">1 自社 </div>

    </div>

    </div>
  </div>

  <div class="col-lg-6 col-md-6">

    <div class="outer row">
     <div class="col-lg-12 col-md-12 ">

      <div class="m_t">1：自社、2：先方</div>

    </div>

    </div>
  </div>

  </div>

     <div class=" row row_data">
      <div class="col-lg-2 col-md-2">
     <div class="margin_t "><span>支払方法</span></div>
  </div>
<div class="col-lg-4 col-md-4">

    <div class="outer row">
     <div class="col-lg-12 col-md-12">
               <div class="m_t"> 現金・小切手</div>


    </div>

    </div>
  </div>

  <div class="col-lg-6 col-md-6">

    <div class="outer row">
     <div class="col-lg-12 col-md-12 ">

      <div class="m_t"></div>

    </div>

    </div>
  </div>

  </div>



  <div class=" row row_data">
      <div class="col-lg-2 col-md-2">
   <div class="margin_t ">
      <span>振込銀行</span>
 </div>

  </div>
<div class="col-lg-9 col-md-9">

    <div class="outer row">
           <div class="col-lg-12 col-md-12 ">
<div class="m_t">未使用</div>
        </div>

 </div>

  </div>

  </div>

<div class=" row row_data">
      <div class="col-lg-2 col-md-2">
   <div class="margin_t ">
      <span>振込支店</span>
 </div>

  </div>
<div class="col-lg-9 col-md-9">

    <div class="outer row">
           <div class="col-lg-12 col-md-12">
<div class="m_t">未使用</div>
        </div>

 </div>

  </div>

  </div>
<div class=" row row_data">
      <div class="col-lg-2 col-md-2">
   <div class="margin_t ">
      <span>預金種別</span>
 </div>

  </div>
<div class="col-lg-9 col-md-9">

    <div class="outer row">
           <div class="col-lg-12 col-md-12 ">
<div class="m_t">未使用</div>
        </div>

 </div>

  </div>

  </div>
  <div class=" row row_data">
      <div class="col-lg-2 col-md-2">
   <div class="margin_t ">
      <span>口座番号</span>
 </div>

  </div>
<div class="col-lg-9 col-md-9">

    <div class="outer row">
           <div class="col-lg-12 col-md-12 ">
<div class="m_t">未使用</div>
        </div>

 </div>

  </div>

  </div>
    <div class=" row row_data">
      <div class="col-lg-2 col-md-2">
   <div class="margin_t ">
      <span>口座名義人</span>
 </div>

  </div>
<div class="col-lg-9 col-md-9">

    <div class="outer row">
           <div class="col-lg-12 col-md-12">
<div class="m_t">未使用</div>
        </div>

 </div>

  </div>

  </div>
    <div class=" row row_data">
      <div class="col-lg-2 col-md-2">
   <div class="margin_t ">
      <span>仕向銀行</span>
 </div>

  </div>
<div class="col-lg-9 col-md-9">

    <div class="outer row">
           <div class="col-lg-12 col-md-12">
<div class="m_t">未使用</div>
        </div>

 </div>

  </div>

  </div>
    <div class=" row row_data">
      <div class="col-lg-2 col-md-2">
   <div class="margin_t ">
      <span>仕向支店</span>
 </div>

  </div>
<div class="col-lg-9 col-md-9">

    <div class="outer row">
           <div class="col-lg-12 col-md-12 ">
<div class="m_t">未使用</div>
        </div>

 </div>

  </div>

  </div>
     <div class=" row row_data">
      <div class="col-lg-2 col-md-2">
     <div class="margin_t "><span>支払税区分</span></div>
  </div>
<div class="col-lg-4 col-md-4">

    <div class="outer row">
     <div class="col-lg-12 col-md-12 ">
                 <div class="m_t"> 非課税・課税なし</div>


    </div>

    </div>
  </div>

  <div class="col-lg-6 col-md-6">

    <div class="outer row">
     <div class="col-lg-12 col-md-12">

      <div class="m_t"></div>

    </div>

    </div>
  </div>

  </div>

       <div class=" row row_data">
      <div class="col-lg-2 col-md-2">
     <div class="margin_t "><span>支払税端数区分</span></div>
  </div>
<div class="col-lg-4 col-md-4">

    <div class="outer row">
     <div class="col-lg-12 col-md-12 ">
      <div class="m_t">四捨五入</div>


    </div>

    </div>
  </div>

  <div class="col-lg-6 col-md-6">

    <div class="outer row">
     <div class="col-lg-12 col-md-12 ">

      <div class="m_t"></div>

    </div>

    </div>
  </div>

  </div>


       <div class=" row row_data">
      <div class="col-lg-2 col-md-2">
     <div class="margin_t "><span>源泉区分</span></div>
  </div>
<div class="col-lg-4 col-md-4">

    <div class="outer row">
     <div class="col-lg-12 col-md-12 ">
         <div class="m_t">0 なし</div>


    </div>

    </div>
  </div>

  <div class="col-lg-6 col-md-6">

    <div class="outer row">
     <div class="col-lg-12 col-md-12 ">

      <div class="m_t">0：なし、1：あり</div>

    </div>

    </div>
  </div>

  </div>


         <div class=" row row_data">
      <div class="col-lg-2 col-md-2">
     <div class="margin_t "><span>
手形決済月</span></div>
  </div>
<div class="col-lg-4 col-md-4">

    <div class="outer row">
     <div class="col-lg-12 col-md-12 ">

   <div class="m_t">0 当月</div>

    </div>

    </div>
  </div>

  <div class="col-lg-6 col-md-6">

    <div class="outer row">
     <div class="col-lg-12 col-md-12 ">

      <div class="m_t">0：当月、1：翌日、2：翌々月、3：3か月、4：4か月</div>

    </div>

    </div>
  </div>

  </div>

           <div class=" row row_data">
      <div class="col-lg-2">
     <div class="margin_t "><span>
手形決済日</span></div>
  </div>
<div class="col-lg-4 col-md-4">

    <div class="outer row">
     <div class="col-lg-12 col-md-12 ">

   <div class="m_t"></div>

    </div>

    </div>
  </div>

  <div class="col-lg-6 col-md-6">

    <div class="outer row">
     <div class="col-lg-12 col-md-12 ">

      <div class="m_t"></div>

    </div>

    </div>
  </div>

  </div>
  <div class=" row row_data">
      <div class="col-lg-2 col-md-2">
     <div class="margin_t "><span>
仕入消費税計算区分</span></div>
  </div>
<div class="col-lg-4 col-md-4">

    <div class="outer row">
     <div class="col-lg-12 col-md-12 ">

   <div class="m_t">1 伝票単位</div>

    </div>

    </div>
  </div>

  <div class="col-lg-6 col-md-6">

    <div class="outer row">
     <div class="col-lg-12 col-md-12 ">

      <div class="m_t">1：伝票単位、2：明細単位</div>

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


    </div>








                <div class="modal-footer">

                </div>
                </div>

        </div>
   </div>

<!--===================================MODAL 2 END==============================-->


<!--===================================MODAL 3 Start==============================-->


<div class="modal fade" data-keyboard="false" data-backdrop="static" id="comp_modal3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" style="max-width: 1050px;z-index: 1052;" role="document">
            <div class="modal-content">
                  <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">会社マスタ</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                      </button>
                    </div>
                <div class="modal-body">
                    <div class="development_page_top_table heading_mt" style="margin:0 2px;">

                        <!--=======================Modal 2 button start ======================-->

                        <div class="row titlebr" style="margin-bottom: 15px;">
                     <div class="col-lg-6 "></div>
  <div class="col-lg-6">
    <table class="dev_tble_button" style="float: right;margin-right: 14px;">
      <tbody>
        <tr class="marge_in">
           <td class="" style="padding-left: 0px!important;width: 70px!important; ">
<!--                <a class="btn btn-info scroll" id="" style="background-color: #3e6ec1!important;"data-toggle="modal" data-target="#">変更
</a>
 -->
           </td>

        <td class="" style="padding-left: 10px!important;">

<a href="#" class="btn btn-info scroll" style="float: right;"><i class="fa fa-save" aria-hidden="true" style="margin-right: 5px;"></i>保存</a>
           </td>
        <td class="" style="padding-left: 10px!important;">

             <a class="btn btn-info scroll" style="background-color: #3e6ec1!important;" data-toggle="modal" data-target="#"><i class="fa fa-print" style="margin-right: 7px;">
        </i>印刷
</a>


           </td>
        </tr>
      </tbody>
    </table>

  </div>

</div>
</div>

<!--=======================Modal 2 button wrapper end ======================-->


<div class="container h-100 py-2">
    <ul class="nav nav-tabs " id="myTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link  active show" id="common3-tab" data-toggle="tab" href="#common3" role="tab" aria-controls="common3" aria-selected="true"><b>共通</b>
</a>
        </li>
        <li class="nav-item">
            <a class="nav-link " id="sales_billing3_tab" data-toggle="tab" href="#sales_billing3" role="tab" aria-controls="sales_billing3" aria-selected="false"><b>売上・請求</b>
</a>
        </li>
        <li class="nav-item">
            <a class="nav-link " id="payment3-tab" data-toggle="tab" href="#payment3" role="tab" aria-controls="payment3" aria-selected="false"><b>仕入・支払</b>
</a>
        </li>

    </ul>
    <div class="tab-content">
        <div class="tab-pane h-100 p-3 border active show" id="common3" role="tabpanel" aria-labelledby="common3-tab">
 <div id="input_boxwrap_common3">

        <div class="row mt-1 mb-3">
        <div class="col-lg-12 col-md-12">
            <div class="tbl_product w-100">
<div class=" row row_data">
      <div class="col-lg-2 col-md-2 ">
       <div class="margin_t ">
         <span>会社CD <span style="color: red;">※</span></span>
     </div>

  </div>
<div class="col-lg-8 col-md-8 ">

    <div class="outer row">

           <div class="col-lg-4 col-md-4">
<input type="text" class="input_field form-control" id="border_input" value="1234" readonly="" style="border:none!important;outline: 0!important;">
        </div>

           <div class="col-lg-3 col-md-3 ">
<div>法人マイナンバー</div>
        </div>
  <div class="col-lg-3 col-md-3  ">

<input type="text" class="input_field form-control" id="border_input" value="" placeholder="999999999">



        </div>
  <div class="col-lg-2 col-md-2">
<div>変更 (処理状況)</div>



        </div>
 </div>

  </div>
  </div>


  <div class=" row row_data">
      <div class="col-lg-2 col-md-2 ">
   <div class="margin_t ">
  <span>会社名<span style="color: red;">※</span></span>
 </div>


  </div>
<div class="col-lg-10 col-md-10">

    <div class="outer row">
           <div class="col-lg-8 col-md-8 ">
          <input type="text" class="input_field form-control" value=" ジョイアスフーズ">
        </div>

 </div>

  </div>

  </div>

    <div class=" row row_data">
      <div class="col-lg-2 col-md-2 ">
   <div class="margin_t ">
  <span>会社名略称</span>
 </div>


  </div>
<div class="col-lg-10 col-md-10">

    <div class="outer row">
           <div class="col-lg-8 col-md-8  ">
          <input type="text" class="input_field form-control" value="ジョイアス">
        </div>

 </div>

  </div>

  </div>

    <div class=" row row_data">
      <div class="col-lg-2 col-md-2">
   <div class="margin_t ">
  <span>会社名カナ</span>
 </div>


  </div>
<div class="col-lg-10 col-md-2">

    <div class="outer row">
           <div class="col-lg-8 col-md-8">
          <input type="text" class="input_field form-control" value="  ジョイアスフーズ">
        </div>

 </div>

  </div>

  </div>
    <div class=" row row_data">
      <div class="col-lg-2 col-md-2">
   <div class="margin_t ">
  <span>会社名カナ入金消込用
</span>
 </div>


  </div>
<div class="col-lg-10 col-md-10 ">

    <div class="outer row">
           <div class="col-lg-8 col-md-8  ">
          <input type="text" class="input_field form-control" value="">
        </div>

 </div>

  </div>

  </div>

            </div>
          </div>
        </div>

  <div class="row mt-1 mb-3">
        <div class="col-lg-6 col-md-6">
            <div class="tbl_product w-100">


<div class=" row row_data">
      <div class="col-lg-3 col-md-3">
   <div class="margin_t ">
      <span>入力区分</span>
 </div>

  </div>
<div class="col-lg-9 col-md-9  ">

    <div class="outer row">
           <div class="col-lg-12 col-md-12 ">
<select class="form-control left_select ">
                      <option value="1">0 マスタ索引</option>
                      <option value="1">1 入力可</option>

                  </select>
        </div>

 </div>

  </div>

  </div>




            </div>
          </div>


                  <div class="col-lg-6 col-md-6">
            <div class="tbl_product w-100">


<div class=" row row_data">
      <div class="col-lg-3 col-md-3">
   <div class="margin_t ">
      <span>会計取引先CD</span>
 </div>

  </div>
<div class="col-lg-9 col-md-9 ">

    <div class="outer row">
           <div class="col-lg-12 col-md-12 ">
<input type="text" class="input_field form-control" value="" placeholder="未使用">
        </div>

 </div>

  </div>

  </div>




            </div>
          </div>
        </div>


          <div class="row mt-1 mb-3">
        <div class="col-lg-7 col-md-7">
            <div class="tbl_product w-100">


<div class=" row row_data">
      <div class="col-lg-4 col-md-4">
   <div class="margin_t ">
      <span>帝国ﾃﾞｰﾀﾊﾞﾝｸ信用録PDF</span>
 </div>

  </div>
<div class="col-lg-8 col-md-8">

    <div class="outer row">
           <div class="col-lg-9 col-md-9 ">
<input type="text" class="input_field form-control" value="">
        </div>
      <div class="col-lg-3 pl-0 col-md-3 ">
     <div class="input-file-container">
    <input class="input-file" id="my-file" type="file">
    <label tabindex="0" for="my-file" class=" btn btn-info input-file-trigger"><i class="fa fa-search" aria-hidden="true" style="margin-right: 5px;"></i>参照</label>
  </div>

      </div>
 </div>

  </div>

  </div>
<div class=" row row_data">
      <div class="col-lg-4 col-md-4">
   <div class="margin_t ">
      <span>帝国ﾃﾞｰﾀﾊﾞﾝｸ取得年月日</span>
 </div>

  </div>
<div class="col-lg-8 col-md-8">

    <div class="outer row">
           <div class="col-lg-12 col-md-12 ">
    <div class="input-group">
      <input data-format="dd/MM/yyyy hh:mm:ss"id="datepicker6_com" type="text" class="input_field form-control"  autocomplete="off">
  <div class="input-group-append" style="margin-left: 10px;margin-top: 7px;">
<span id="cal_icon6_c" class="fa fa-calendar"></span>
  </div>
</div>
        </div>

 </div>

  </div>

  </div>

<div class=" row row_data">
      <div class="col-lg-4 col-md-4 ">
   <div class="margin_t ">
      <span>帝国ﾃﾞｰﾀﾊﾞﾝｸ企業CD</span>
 </div>

  </div>
<div class="col-lg-8 col-md-8">

    <div class="outer row">
           <div class="col-lg-12 col-md-12  ">
<input type="text" class="input_field form-control" value="">
        </div>

 </div>

  </div>

  </div>
<div class=" row row_data">
      <div class="col-lg-4  col-md-4">
   <div class="margin_t ">
      <span>帝国ﾃﾞｰﾀﾊﾞﾝｸ評点</span>
 </div>

  </div>
<div class="col-lg-8 col-md-8">

    <div class="outer row">
           <div class="col-lg-12 col-md-12 ">
<input type="text" class="input_field form-control" value="">
        </div>

 </div>

  </div>

  </div>

  <div class=" row row_data">
      <div class="col-lg-4 col-md-4">
   <div class="margin_t ">
      <span>経済産業省業種区分１</span>
 </div>

  </div>
<div class="col-lg-8 col-md-8 ">

    <div class="outer row">
           <div class="col-lg-12 col-md-12  ">
<select class="form-control left_select ">
                      <option value="1">A 農業</option>
                      <option value="1">B 林業、狩. 猟業</option>
                      <option value="1">C 漁業</option>
                      <option value="1">D 鉱業</option>
                      <option value="1">E 建設業</option>
                      <option value="1">F 製造業</option>
                      <option value="1">G 卸売・小売業、飲食店</option>
                      <option value="1">H 金融・保険業</option>
                      <option value="1">I 不動産業</option>
                      <option value="1">J 運輸・通信業</option>
                      <option value="1">K 電機・ガス・水道・熱供給業</option>
                      <option value="1">L サービス業</option>
                      <option value="1">M 公務（他に分類されないもの）</option>
                      <option value="1">N 分類不能の産業</option>

                  </select>
        </div>

 </div>

  </div>

  </div>
    <div class=" row row_data">
      <div class="col-lg-4 col-md-4">
   <div class="margin_t ">
      <span>経済産業省業種区分2</span>
 </div>

  </div>
<div class="col-lg-8 col-md-8 ">

    <div class="outer row">
           <div class="col-lg-12 col-md-12  ">
<select class="form-control left_select ">
                      <option value="1">01 農業</option>
                      <option value="1">05 農業サービス業</option>
                      <option value="1">06 林業</option>
                      <option value="1">07 狩.猟業</option>
                      <option value="1">08 漁業</option>
                      <option value="1">09 水産養殖業</option>
                      <option value="1">10 金属鉱業</option>
                      <option value="1">11 石炭・亜炭鉱業</option>
                      <option value="1">12 原油・天然ガス鉱業</option>
                      <option value="1">13 非金属鉱業</option>
                      <option value="1">15 職別工事業</option>
                      <option value="1">16 総合工事業</option>
                      <option value="1">17 設備工事業</option>
                      <option value="1">19 武器製造業</option>
                      <option value="1">20食料品・資料・飲料製造業</option>
                      <option value="1">21 たばこ製造業</option>
                      <option value="1">22 繊維工業（衣類・その他の繊維製品を除く）</option>
                      <option value="1">23 成人男子・少年服製造業</option>
                      <option value="1">24 木材・木製品製造業</option>
                      <option value="1">25 家具・装備品製造業</option>
                        <option value="1">26 パルプ・紙・紙加工品製造業</option>
                      <option value="1">27 出版・印刷・同関連産業</option>
                      <option value="1">28 化学工業</option>
                      <option value="1">29 石油製品・石炭製品製造業</option>
                      <option value="1">30 ゴム製品製造業</option>
                      <option value="1">31 皮革・同製品・毛皮製造業</option>
                      <option value="1">32 窯業・土石製品製造業</option>
                      <option value="1">33 鉄鋼業・非鉄金属製造業</option>
                      <option value="1">34 金属製品製造業</option>
                      <option value="1">35 一般機械器具製造業</option>
                        <option value="1">36 電気機械器具製造業</option>
                      <option value="1">37 輸送用機械器具製造業</option>
                      <option value="1">38 精密機械・医療機械器具製造業</option>
                      <option value="1">39 その他の製造業</option>
                      <option value="1">40 卸売業（１）</option>
                      <option value="1">41 卸売業（２）</option>
                      <option value="1">42 代理商・仲立業</option>
                      <option value="1">43 各種商品小売業</option>
                      <option value="1">44 織物・衣服・身の回り品小売業</option>
                      <option value="1">45 飲食料品小売業</option>
                        <option value="1">46 飲食店</option>
                      <option value="1">47 自動車・自転車小売業</option>
                      <option value="1">48 家具・じゅう器・家庭用機械器具小売業</option>
                      <option value="1">49 その他の小売業</option>
                      <option value="1">50 銀行・信託業</option>
                      <option value="1">51 農林水産金融機関</option>
                      <option value="1">52 中小商工・庶民・住民等金融業</option>
                      <option value="1">53 補助的金融業・金融付帯業</option>
                      <option value="1">54 証券業・商品先物取引業</option>
                      <option value="1">55 保険業</option>
                        <option value="1">56 保険媒介代理業・保険サービス業</option>
                      <option value="1">57 投資業</option>
                      <option value="1">59 不動産業</option>
                      <option value="1">61 鉄道業</option>
                      <option value="1">62 道路旅客運送業</option>
                      <option value="1">63 道路貨物運送業</option>
                      <option value="1">64 水運業</option>
                      <option value="1">65 航空運輸業</option>
                      <option value="1">66 倉庫業</option>
                      <option value="1">67 運輸に付帯するサービス業</option>
                        <option value="1">68 郵便業・電気通信業</option>

                  </select>
        </div>

 </div>

  </div>

  </div>
            </div>
          </div>


                  <div class="col-lg-5 col-md-5">
            <div class="tbl_product w-100">


<div class=" row row_data">
      <div class="col-lg-3  col-md-3">
   <div class="margin_t ">
      <span>会社分類1</span>
 </div>

  </div>
<div class="col-lg-9 col-md-9 ">

    <div class="outer row">
           <div class="col-lg-12 col-md-12  ">
<select class="form-control left_select ">
                      <option value="1">01 製造業</option>
                      <option value="1">02 卸売業</option>
                      <option value="1">03 小売業</option>
                       <option value="1">04 サービス業・他</option>

                  </select>
        </div>

 </div>

  </div>

  </div>
<div class=" row row_data">
      <div class="col-lg-3 col-md-3">
   <div class="margin_t ">
      <span>会社分類2</span>
 </div>

  </div>
<div class="col-lg-9 col-md-9 ">

    <div class="outer row">
           <div class="col-lg-12 col-md-12  ">
<select class="form-control left_select ">
                      <option value="1">01 ～10億円</option>
                      <option value="1">02 10億円～100億円</option>
                      <option value="1">03 100億円～300億円</option>
                      <option value="1">04 300億円～1000億円</option>
                      <option value="1">05 1000億円～3000億円</option>
                      <option value="1">06 3000億円～</option>
                  </select>
        </div>

 </div>

  </div>

  </div>
<div class=" row row_data">
      <div class="col-lg-3 col-md-3 ">
   <div class="margin_t ">
      <span>会社分類3</span>
 </div>

  </div>
<div class="col-lg-9 col-md-9 ">

    <div class="outer row">
           <div class="col-lg-12 col-md-12 ">
<select class="form-control left_select ">
                      <option value="1">01 1～50人未満</option>
                      <option value="1">02 50～100人未満</option>
                      <option value="1">03 100～500人未満</option>
                      <option value="1">04 500～1000人未満</option>
                      <option value="1">05 1000～5000人未満</option>
                      <option value="1">06 5000人以上</option>
                  </select>
        </div>

 </div>

  </div>

  </div>
<div class=" row row_data">
      <div class="col-lg-3 col-md-3">
   <div class="margin_t ">
      <span>会社分類4</span>
 </div>

  </div>
<div class="col-lg-9 col-md-9 ">

    <div class="outer row">
           <div class="col-lg-12 col-md-12 ">
<select class="form-control left_select ">
                      <option value="1">01 ～1000万円</option>
                      <option value="1">02 ～3000万円</option>
                      <option value="1">03 ～1億円</option>
                       <option value="1">04 １億円超</option>
                  </select>
        </div>

 </div>

  </div>

  </div>
<div class=" row row_data">
      <div class="col-lg-3 col-md-3 ">
   <div class="margin_t ">
      <span>会社分類5</span>
 </div>

  </div>
<div class="col-lg-9 col-md-9">

    <div class="outer row">
           <div class="col-lg-12 col-md-12 ">
<div>未使用</div>
        </div>

 </div>

  </div>

  </div>       </div>
          </div>
        </div>
         <div class="row mt-1 mb-3">
        <div class="col-lg-7 col-md-7">
            <div class="tbl_product w-100">


<div class=" row row_data">
      <div class="col-lg-4 col-md-4">
   <div class="margin_t ">
      <span>社内備考</span>
 </div>

  </div>
<div class="col-lg-8 col-md-8">

    <div class="outer row">
           <div class="col-lg-12 col-md-12 ">
<div class="">
  <textarea class="" rows="5" col="50" id="" style="width: 100%;"></textarea>
</div>
        </div>

 </div>

  </div>

  </div>

            </div>
          </div>


          <div class="col-lg-5 col-md-5">
            <div class="tbl_product w-100">

<div class=" row row_data">
      <div class="col-lg-2 col-md-2">
   <div class="margin_t ">
      <span>売 上</span>
 </div>

  </div>
<div class="col-lg-10 col-md-10">

    <div class="outer row">
           <div class="col-lg-3 col-md-3 ">
<input type="text" class="input_field form-control" value="">
        </div>

         <div class="col-lg-5 col-md-5  ">
<div class="m_t">0：なし、1：あり</div>
        </div>

 </div>

  </div>

  </div>
<div class=" row row_data">
      <div class="col-lg-2 col-md-2">
   <div class="margin_t ">
      <span>仕 入</span>
 </div>

  </div>
<div class="col-lg-10 col-md-10">

    <div class="outer row">
           <div class="col-lg-3 col-md-3 ">
<input type="text" class="input_field form-control" value="">
        </div>

         <div class="col-lg-5 col-md-5">
<div class="m_t">0：なし、1：あり</div>
        </div>

 </div>

  </div>

  </div>

            </div>
          </div>
        </div>
</div>


</div>


<!-- sales and billing tabbed menu -->

<div class="tab-pane fade h-100 p-3 border" id="sales_billing3" role="tabpanel" aria-labelledby="sales_billing3_tab">

 <div id="input_boxwrap_sales_billing3">
  <div class="row mt-1 mb-3">
        <div class="col-lg-7 col-md-5 ">
            <div class="tbl_company w-100">

  <div class=" row row_data">
      <div class="col-lg-3 col-md-3">
     <div class="margin_t "><span>
即時区分</span></div>
  </div>
<div class="col-lg-4 col-md-4 ">


   <div>
<input type="text" class="input_field form-control" value="1">

    </div>
  </div>
  <div class="col-lg-2 col-md-4 d-none">
      <div class="m_t"></div>
  </div>
  <div class="col-lg-3 col-md-3">
      <div>1：即時、2：締め日</div>
  </div>

  </div>

  <div class=" row row_data">
      <div class="col-lg-3 col-md-3">
     <div class="margin_t "><span>
請求締め日</span></div>
  </div>
<div class="col-lg-9 col-md-9">


   <div>
<select class="form-control left_select ">
                      <option value="0">01</option>
                      <option value="1">02</option>
                      <option value="2">03</option>
                      <option value="3">04</option>
                      <option value="4">05</option>
                      <option value="5">06</option>
                      <option value="6">07</option>
                      <option value="7">08</option>
                      <option value="8">09</option>
                      <option value="9">10</option>
                      <option value="10">11</option>
                      <option value="11">12</option>
                      <option value="12">13</option>
                      <option value="13">14</option>
                      <option value="14">15</option>
                      <option value="15">16</option>
                      <option value="16">17</option>
                      <option value="17">18</option>
                      <option value="18">19</option>
                      <option value="19">20</option>
                      <option value="20">21</option>
                      <option value="21">22</option>
                      <option value="22">23</option>
                      <option value="23">24</option>
                      <option value="24">25</option>
                      <option value="25">26</option>
                      <option value="26">27</option>
                      <option value="27">28</option>
                      <option value="28">29</option>
                      <option value="29">30</option>
                      <option value="30">31：月末</option>
                      </select>

    </div>
  </div>

<!--   <div class="col-lg-5 d-none">
      <div class="m_t"></div>
  </div> -->

  </div>
  <div class=" row row_data">
      <div class="col-lg-3  col-md-3">
     <div class="margin_t "><span>
入金方法</span></div>
  </div>
<div class="col-lg-9 col-md-9">


   <div>
<select class="form-control left_select ">
                      <option value="0">01 現金・小切手</option>
                      <option value="1">02 振込</option>
                      <option value="2">03 引落</option>
                      <option value="3">11 手形</option>


                      </select>

    </div>
  </div>

 <!--  <div class="col-lg-5 d-none">
      <div></div>
  </div> -->

  </div>

  <div class=" row row_data">
      <div class="col-lg-3  col-md-3">
     <div class="margin_t "><span>
回収月</span></div>
  </div>
<div class="col-lg-4 col-md-4">


   <div>
<input type="text" class="input_field form-control" value="1">

    </div>
  </div>

  <div class="col-lg-5 col-md-5">
      <div>0：当月、1：翌日、2：翌々月、</div>
   <div class="m_t">3：3か月、4：4か月</div>
  </div>

  </div>
    <div class=" row row_data">
      <div class="col-lg-3  col-md-3">
     <div class="margin_t "><span>
回収日</span></div>
  </div>
<div class="col-lg-4 col-md-4">


   <div>
<input type="text" class="input_field form-control" value="1">

    </div>
  </div>

  <div class="col-lg-5 col-md-5">
      <div class="m_t"></div>
  </div>

  </div>


    <div class=" row row_data">
      <div class="col-lg-3  col-md-3">
     <div class="margin_t "><span>
回収日休日設定
</span></div>
  </div>
<div class="col-lg-4 col-md-4">


   <div>
<input type="text" class="input_field form-control" value="1">

    </div>
  </div>

  <div class="col-lg-5 col-md-5">
      <div>1：翌営業日、2：前営業日</div>

  </div>

  </div>
      <div class=" row row_data">
      <div class="col-lg-3 col-md-3">
     <div class="margin_t "><span>
入金時手数料設定

</span></div>
  </div>
<div class="col-lg-4 col-md-4">


   <div>
<input type="text" class="input_field form-control" value="1">

    </div>
  </div>

  <div class="col-lg-5 col-md-5">
      <div class="m_t">1：自社、2：先方</div>

  </div>

  </div>

            </div>
          </div>

  <div class="col-lg-5 col-md-5">
    <div class="tbl_company w-100">

  <div class=" row row_data">
      <div class="col-lg-4 col-md-4">
     <div class="margin_t "><span>
保守更新案内有無</span></div>
  </div>
<div class="col-lg-4 col-md-4">

     <div>
          <input type="text" class="input_field form-control" value="1">
      </div>
  </div>

<div class="col-lg-4 col-md-4">
      <div class="m_t">1：有、2：無</div>
  </div>
  </div>


    <div class=" row row_data">
      <div class="col-lg-4 col-md-4">
     <div class="margin_t "><span>
ライセンス証書有無
</span></div>
  </div>
<div class="col-lg-4 col-md-4">

     <div>
          <input type="text" class="input_field form-control" value="1">
      </div>
  </div>

<div class="col-lg-4 col-md-4">
      <div class="m_t">1：有、2：無</div>
  </div>
  </div>

    <div class=" row row_data">
      <div class="col-lg-4 col-md-4">
     <div class="margin_t "><span>
検収条件
</span></div>
  </div>
<div class="col-lg-8 col-md-8">

     <div>
        <select class="form-control left_select ">
                      <option value="0">01 納品完了確認書 貴社捺印時</option>
                      <option value="1">02 作業完了確認書 貴社捺印時</option>
                      <option value="2">03 受入検査完了時</option>
                      <option value="3">04 先方の検収書</option>
                      <option value="4">05 納品時</option>
                      <option value="5">06 その他</option>

                      </select>
      </div>
  </div>


  </div>
      <div class=" row row_data">
      <div class="col-lg-4 col-md-4">
     <div class="margin_t "><span>
与信限度額
</span></div>
  </div>
<div class="col-lg-4 col-md-4">

     <div>
          <input type="text" class="input_field form-control" value="1">
      </div>
  </div>

<div class="col-lg-4 col-md-4">
      <div class="m_t">百万円</div>
  </div>
  </div>

            </div>
          </div>
        </div>

<!-- 2nd tab1 row -->

  <div class="row mt-1 mb-3">
        <div class="col-lg-10 col-md-10">
            <div class="tbl_company w-100">

<div class=" row row_data">
      <div class="col-lg-3 col-md-3">
     <div class="margin_t "><span>請求先CD</span></div>
  </div>
<div class="col-lg-9 col-md-9">

    <div class="outer row">
     <div class="col-lg-6 col-md-6 ">

    <div style="position:relative;"><input type="text" class="input_field form-control" style="" value="20011">

  </div>


<div class="box-dark" id="popup3_comp" style="bottom: 0;float: left;margin-top: 8px;position: absolute;right: 24px;top: 0px;" data-toggle="modal" data-target="#comp_modal4">

                      </div>

    </div>
   <div class="col-lg-6 col-md-6 d-none "></div>
    </div>
  </div>

  </div>
<div class=" row row_data">
      <div class="col-lg-3 col-md-3">
     <div class="margin_t "><span>請求書送付日</span></div>
  </div>
<div class="col-lg-9 col-md-9">

    <div class="outer row">
     <div class="col-lg-6 col-md-6 ">
<input type="text" class="input_field form-control" value="">

    </div>
 <div class="col-lg-6 col-md-6 d-none "></div>
    </div>
  </div>

  </div>

    <div class=" row row_data">
      <div class="col-lg-3 col-md-3">
     <div class="margin_t "><span>請求書メール区分</span></div>
  </div>
<div class="col-lg-9 col-md-9">

    <div class="outer row">
     <div class="col-lg-6 col-md-6">
<input type="text" class="input_field form-control" value="1">

    </div>
     <div class="col-lg-6 col-md-6 d-none "></div>
         <div class="col-lg-6 col-md-6 ">
<div class="m_t">1：PDFﾒｰﾙ送信、2：ﾒｰﾙ不要</div>

    </div>

    </div>
  </div>

  </div>

    <div class=" row row_data">
      <div class="col-lg-3 col-md-3">
     <div class="margin_t "><span>請求書メール宛先</span></div>
  </div>
<div class="col-lg-9 col-md-9">

    <div class="outer row">
     <div class="col-lg-6 col-md-6 ">
<input type="text" class="input_field form-control" value="">

    </div>


    </div>
  </div>

  </div>
      <div class=" row row_data">
      <div class="col-lg-3 col-md-3">
     <div class="margin_t "><span>請求書UIS</span></div>
  </div>
<div class="col-lg-9 col-md-9">

    <div class="outer row">
     <div class="col-lg-6 col-md-6 ">
<input type="text" class="input_field form-control" value="2">

    </div>
       <div class="col-lg-6 col-md-6 d-none "></div>
         <div class="col-lg-6 col-md-6 ">
<div class="m_t">1：PDF-UIS、2：UIS不要</div>

    </div>

    </div>
  </div>

  </div>

        <div class=" row row_data">
      <div class="col-lg-3 col-md-3">
     <div class="margin_t "><span>請求書郵送</span></div>
  </div>
<div class="col-lg-9 col-md-9">

    <div class="outer row">
     <div class="col-lg-6 col-md-6">
<input type="text" class="input_field form-control" value="1">

    </div>
     <div class="col-lg-6 col-md-6 d-none "></div>
         <div class="col-lg-6 col-md-6 ">
<div class="m_t">1：郵送、2：不要</div>

    </div>

    </div>
  </div>

  </div>

          <div class=" row row_data">
      <div class="col-lg-3 col-md-3">
     <div class="margin_t "><span>請求書郵送先</span></div>
  </div>
<div class="col-lg-9 col-md-9">

    <div class="outer row">
     <div class="col-lg-6 col-md-6 ">
<div style="position:relative;"><input type="text" class="input_field form-control" style="" value="20011">

  </div>


<div class="box-dark" id="popup4_comp" style="bottom: 0;float: left;margin-top: 8px;position: absolute;right: 24px;top: 0px;" data-toggle="modal" data-target="#comp_modal4">

                      </div>

    </div>
  <div class="col-lg-6 col-md-6 d-none "></div>
      <div class="col-lg-6 col-md-6 "></div>
    </div>
  </div>

  </div>

            <div class=" row row_data">
      <div class="col-lg-3 col-md-3">
     <div class="margin_t "><span>請求税区分</span></div>
  </div>
<div class="col-lg-9 col-md-9">

    <div class="outer row">
     <div class="col-lg-6 col-md-6 ">
<select class="form-control left_select ">
                      <option value="0">00 対象外・非課税</option>
                      <option value="0">01 課税10％</option>
                      </select>

    </div>
  <div class="col-lg-6 col-md-6 d-none "></div>
      <div class="col-lg-6 col-md-6 "></div>
    </div>
  </div>

  </div>
            <div class=" row row_data">
      <div class="col-lg-3 col-md-3">
     <div class="margin_t "><span>請求税端数区分</span></div>
  </div>
<div class="col-lg-9 col-md-9">

    <div class="outer row">
     <div class="col-lg-6 col-md-6 ">
<select class="form-control left_select ">
                      <option value="0">1 四捨五入</option>
                      <option value="1">2 切り上げ</option>
                      <option value="2">3 切り下げ</option>
                      </select>
    </div>
   <div class="col-lg-6 col-md-6 d-none "></div>
      <div class="col-lg-6 col-md-6 "></div>
    </div>
  </div>

  </div>



          <div class=" row row_data">
      <div class="col-lg-3 col-md-3">
     <div class="margin_t "><span>請求消費税計算区分
</span></div>
  </div>
<div class="col-lg-9 col-md-9">

    <div class="outer row">
     <div class="col-lg-6 col-md-6 ">
<input type="text" class="input_field form-control" value="1">

    </div>
    <div class="col-lg-6 col-md-6 d-none "></div>
         <div class="col-lg-6 col-md-6 ">
<div class="m_t">1：伝票単位、2：明細単位</div>

    </div>

    </div>
  </div>

  </div>


    </div>
          </div>
        </div>
  <div class="row mt-1 mb-3">
        <div class="col-lg-7 col-md-7">
            <div class="tbl_company w-100">

<div class=" row row_data">
      <div class="col-lg-4 col-md-4">
     <div class="margin_t "><span>専伝区分</span></div>
  </div>
<div class="col-lg-8 col-md-8">

    <div class="outer row">
     <div class="col-lg-7 col-md-7 ">

      <input type="text" class="input_field form-control" value="01">

    </div>
      <div class="col-lg-5 col-md-5 ">

      <div class="m_t">1：有、2：無</div>

    </div>

    </div>
  </div>

  </div>
<div class=" row row_data">
      <div class="col-lg-4 col-md-4">
     <div class="margin_t "><span>指定納品書帳票CD
</span></div>
  </div>
<div class="col-lg-8 col-md-8">

    <div class="outer row">
     <div class="col-lg-6 col-md-6 ">
           <input type="text" class="input_field form-control" value="">

    </div>


    </div>
  </div>

  </div>
  <div class=" row row_data">
      <div class="col-lg-4 col-md-4">
     <div class="margin_t "><span>得意先分類1</span></div>
  </div>
<div class="col-lg-8 col-md-8">

    <div class="outer row">
     <div class="col-lg-12 col-md-12 ">

<select class="form-control left_select ">
                      <option value="0">01 販売ランク NULL</option>
                      <option value="1">02 販売ランク A</option>
                      <option value="2">03 販売ランク B</option>
                      <option value="3">04 販売ランク C</option>
                      <option value="4">05 販売ランク D</option>
               </select>

    </div>


    </div>
  </div>

  </div>

    <div class=" row row_data">
      <div class="col-lg-4 col-md-4">
     <div class="margin_t "><span>得意先分類2</span></div>
  </div>
<div class="col-lg-8 col-md-8">

    <div class="outer row">
     <div class="col-lg-12 col-md-12 ">

<select class="form-control left_select ">
                      <option value="0">01 深耕客</option>
                      <option value="1">02 発展客</option>
                      <option value="2">03 維持客</option>
                      <option value="3">04 管理客</option>
                      <option value="4">05 その他</option>
               </select>
    </div>


    </div>
  </div>

  </div>
  <div class=" row row_data">
      <div class="col-lg-3 col-md-3">
   <div class="margin_t ">
      <span>得意先分類3</span>
 </div>

  </div>
<div class="col-lg-9 col-md-9">

    <div class="outer row">
           <div class="col-lg-12 col-md-12">
<div class="m_t ml-45">未使用</div>
        </div>

 </div>

  </div>

  </div>

<div class=" row row_data">
      <div class="col-lg-3 col-md-3">
   <div class="margin_t ">
      <span>得意先分類4</span>
 </div>

  </div>
<div class="col-lg-9 col-md-9">

    <div class="outer row">
           <div class="col-lg-12 col-md-12">
<div class="m_t ml-45">未使用</div>
        </div>

 </div>

  </div>

  </div>
  <div class=" row row_data">
      <div class="col-lg-3 col-md-3">
   <div class="margin_t ">
      <span>得意先分類5</span>
 </div>

  </div>
<div class="col-lg-9 col-md-9">

    <div class="outer row">
           <div class="col-lg-12 col-md-12 ">
<div class="m_t ml-45">未使用</div>
        </div>

 </div>

  </div>

  </div>
  <div class=" row row_data">
      <div class="col-lg-3 col-md-3">
   <div class="margin_t ">
      <span>得意先分類6</span>
 </div>

  </div>
<div class="col-lg-9 col-md-9">

    <div class="outer row">
           <div class="col-lg-12 col-md-12">
<div class="m_t ml-45">未使用</div>
        </div>

 </div>

  </div>

  </div>


            </div>
          </div>


           <div class="col-lg-5 col-md-5">
            <div class="tbl_company w-100">

    <div class=" row row_data">
      <div class="col-lg-5 col-md-5">
     <div class="margin_t "><span>単価設定区分</span></div>
  </div>
<div class="col-lg-7 col-md-7">

    <div class="outer row">
     <div class="col-lg-12 col-md-12 ">

<select class="form-control left_select ">
                      <option value="0">01 商品Mの標準単価</option>
                      <option value="1">02 商品MのPB単価</option>
                      <option value="2">03 得商Mの単価</option>
                            <option value="2">04 得商MのPB単価</option>

               </select>

    </div>


    </div>
  </div>

  </div>
      <div class=" row row_data">
      <div class="col-lg-5 col-md-5">
     <div class="margin_t "><span>取引開始日 東直</span></div>
  </div>
<div class="col-lg-7 col-md-7">

    <div class="outer row">
     <div class="col-lg-12 col-md-12">

    <div class="input-group">
      <input data-format="dd/MM/yyyy hh:mm:ss"id="datepicker7_com" type="text" class="input_field form-control">
  <div class="input-group-append" style="margin-left: 10px;margin-top: 7px;">
<span id="cal_icon7_c" class="fa fa-calendar"></span>
  </div>
</div>

    </div>


    </div>
  </div>

  </div>
   <!--    <div class=" row row_data">
      <div class="col-lg-5">
     <div class="margin_t "><span>取引開始日 東直</span></div>
  </div>
<div class="col-lg-7">

    <div class="outer row">
     <div class="col-lg-12 ">

<input type="text" class="form-control" value="">

    </div>


    </div>
  </div>

  </div> -->
               <div class=" row row_data">
      <div class="col-lg-5 col-md-5">
     <div class="margin_t "><span>取引開始日 東流</span></div>
  </div>
<div class="col-lg-7 col-md-7">

    <div class="outer row">
     <div class="col-lg-12  col-md-12 ">

    <div class="input-group">
      <input data-format="dd/MM/yyyy hh:mm:ss"id="datepicker8_com" type="text" class="input_field form-control">
  <div class="input-group-append" style="margin-left: 10px;margin-top: 7px;">
<span id="cal_icon8_c" class="fa fa-calendar"></span>
  </div>
</div>

    </div>


    </div>
  </div>

  </div>
   <div class=" row row_data">
      <div class="col-lg-5 col-md-5">
     <div class="margin_t "><span>取引開始日 西直
</span></div>
  </div>
<div class="col-lg-7 col-md-7">

    <div class="outer row">
     <div class="col-lg-12 col-md-12 ">

    <div class="input-group">
      <input data-format="dd/MM/yyyy hh:mm:ss"id="datepicker9_com" type="text" class="input_field form-control">
  <div class="input-group-append" style="margin-left: 10px;margin-top: 7px;">
<span id="cal_icon9_c" class="fa fa-calendar"></span>
  </div>
</div>

    </div>


    </div>
  </div>

  </div>
   <div class=" row row_data">
      <div class="col-lg-5 col-md-5">
     <div class="margin_t "><span>取引開始日 西流
</span></div>
  </div>
<div class="col-lg-7 col-md-7">

    <div class="outer row">
     <div class="col-lg-12 col-md-12 ">

    <div class="input-group">
      <input data-format="dd/MM/yyyy hh:mm:ss"id="datepicker10_com" type="text" class="input_field form-control">
  <div class="input-group-append" style="margin-left: 10px;margin-top: 7px;">
<span id="cal_icon10_c" class="fa fa-calendar"></span>
  </div>
</div>

    </div>


    </div>
  </div>

  </div>
   <div class=" row row_data">
      <div class="col-lg-5 col-md-5">
     <div class="margin_t "><span>ユーザー区分
</span></div>
  </div>
<div class="col-lg-7 col-md-7">

    <div class="outer row">
     <div class="col-lg-12 col-md-12 ">

<select class="form-control left_select ">
                      <option value="0">1 ﾕｰｻﾞｰ</option>
                      <option value="1">2 過去ﾕｰｻﾞｰ</option>
                      <option value="2">3 新規</option>
                      <option value="3">4 ﾊﾟｰﾄﾅｰ</option>
                     <option value="4">5 他</option>
               </select>

    </div>


    </div>
  </div>

  </div>

     <div class=" row row_data">
      <div class="col-lg-5 col-md-5">
     <div class="margin_t "><span>データソース
</span></div>
  </div>
<div class="col-lg-7 col-md-7">

    <div class="outer row">
     <div class="col-lg-12 col-md-12 ">

<select class="form-control left_select ">
                      <option value="">1 名刺交換</option>
                      <option value="">2 資料請求</option>
                      <option value="">3 2018春関西ITWEEK</option>
                      <option value="">4 2018春ITWEEK</option>
                     <option value="">5 2019春関西ITWEEK</option>
                      <option value="">6 2019春ITWEEK</option>
                      <option value="">7 USACｿﾘｭｰｼｮﾝﾌｪｱ2020</option>

                  </select>


    </div>


    </div>
  </div>

  </div>
   </div>
          </div>
        </div>
<!-- 3rd tab1 row -->

</div>



      </div>
      <!-- sales and billing tabbed menu -->
        <div class="tab-pane fade h-100 p-3 border" id="payment3" role="tabpanel" aria-labelledby="payment3-tab">

 <div id="input_boxwrap_payment3">

  <div class="row mt-1 mb-3">
        <div class="col-lg-12 col-md-12">
            <div class="tbl_company w-100">


<div class=" row row_data">
      <div class="col-lg-2 col-md-2 ">
     <div class="margin_t "><span>支払締め日</span></div>
  </div>
<div class="col-lg-4 col-md-4">

    <div class="outer row">
     <div class="col-lg-12 col-md-12 ">

 <select class="form-control left_select ">
                      <option value="0">10 10日締</option>
                      <option value="1">15 15日締</option>
                      <option value="2">20 20日締</option>
                      <option value="3">25 25日締</option>
                      <option value="4">31 月末締</option>

                      </select>

    </div>

    </div>
  </div>

  <div class="col-lg-6 col-md-6">

    <div class="outer row">
     <div class="col-lg-12 col-md-12 ">

      <div class="m_t"></div>

    </div>

    </div>
  </div>

  </div>


<div class=" row row_data">
      <div class="col-lg-2 col-md-2">
     <div class="margin_t "><span>支払月</span></div>
  </div>
<div class="col-lg-4 col-md-4">

    <div class="outer row">
     <div class="col-lg-12 col-md-12 ">

      <input type="text" class=" input_field form-control" value="">

    </div>

    </div>
  </div>

  <div class="col-lg-6 col-md-6">

    <div class="outer row">
     <div class="col-lg-12 col-md-12 ">

      <div class="m_t">0：当月、1：翌日、2：翌々月、3：3か月、4：4か月</div>

    </div>

    </div>
  </div>

  </div>

     <div class=" row row_data">
      <div class="col-lg-2 col-md-2">
     <div class="margin_t "><span>支払日</span></div>
  </div>
<div class="col-lg-4 col-md-4">

    <div class="outer row">
     <div class="col-lg-12 col-md-12 ">

<select class="form-control left_select ">
                      <option value="0">1</option>
                      <option value="1">2</option>
                      <option value="2">3</option>
                      <option value="3">4</option>
                      <option value="4">5</option>
                       <option value="0">6</option>
                      <option value="1">7</option>
                      <option value="2">8</option>
                      <option value="3">9</option>
                      <option value="4">10</option>
                      <option value="0">11</option>
                      <option value="1">12</option>
                      <option value="2">13</option>
                      <option value="3">14</option>
                      <option value="4">15</option>
                       <option value="0">16</option>
                      <option value="1">17</option>
                      <option value="2">18</option>
                      <option value="3">19</option>
                      <option value="4">20</option>
                      <option value="0">21</option>
                      <option value="1">22</option>
                      <option value="2">23</option>
                      <option value="3">24</option>
                      <option value="4">25</option>
                       <option value="0">26</option>
                      <option value="1">27</option>
                      <option value="2">28</option>
                      <option value="3">29</option>
                      <option value="4">30</option>
                      </select>

    </div>

    </div>
  </div>

  <div class="col-lg-6 col-md-6">

    <div class="outer row">
     <div class="col-lg-12 col-md-12 ">

      <div class="m_t"></div>

    </div>

    </div>
  </div>

  </div>

     <div class=" row row_data">
      <div class="col-lg-2 col-md-2">
     <div class="margin_t "><span>支払日休日設定</span></div>
  </div>
<div class="col-lg-4 col-md-4">

    <div class="outer row">
     <div class="col-lg-12 col-md-12 ">

      <input type="text" class="input_field form-control" value="">

    </div>

    </div>
  </div>

  <div class="col-lg-6 col-md-6">

    <div class="outer row">
     <div class="col-lg-12 col-md-12 ">

      <div class="m_t">1：翌営業日、2：前営業日</div>

    </div>

    </div>
  </div>

  </div>
     <div class=" row row_data">
      <div class="col-lg-2 col-md-2">
     <div class="margin_t "><span>支払振込手数料設定</span></div>
  </div>
<div class="col-lg-4 col-md-4">

    <div class="outer row">
     <div class="col-lg-12 col-md-12 ">

      <input type="text" class="input_field form-control" value="">

    </div>

    </div>
  </div>

  <div class="col-lg-6 col-md-6">

    <div class="outer row">
     <div class="col-lg-12 col-md-12 ">

      <div class="m_t">1：自社、2：先方</div>

    </div>

    </div>
  </div>

  </div>

     <div class=" row row_data">
      <div class="col-lg-2 col-md-2">
     <div class="margin_t "><span>支払方法</span></div>
  </div>
<div class="col-lg-4 col-md-4">

    <div class="outer row">
     <div class="col-lg-12 col-md-12 ">

<select class="form-control left_select ">
                      <option value="0">01 現金・小切手</option>
                      <option value="1">02 振込</option>
                      <option value="2">03 引落</option>
                      <option value="3">11 手形</option>

                     </select>

    </div>

    </div>
  </div>

  <div class="col-lg-6 col-md-6">

    <div class="outer row">
     <div class="col-lg-12 col-md-12 ">

      <div class="m_t"></div>

    </div>

    </div>
  </div>

  </div>


<div class=" row row_data">
      <div class="col-lg-2 col-md-2">
   <div class="margin_t ">
      <span>振込銀行</span>
 </div>

  </div>
<div class="col-lg-9 col-md-9">

    <div class="outer row">
           <div class="col-lg-12 col-md-12 ">
<div class="m_t">未使用</div>
        </div>

 </div>

  </div>

  </div>

<div class=" row row_data">
      <div class="col-lg-2 col-md-2">
   <div class="margin_t ">
      <span>振込支店</span>
 </div>

  </div>
<div class="col-lg-9 col-md-9">

    <div class="outer row">
           <div class="col-lg-12 col-md-12 ">
<div class="m_t">未使用</div>
        </div>

 </div>

  </div>

  </div>
<div class=" row row_data">
      <div class="col-lg-2 col-md-2">
   <div class="margin_t ">
      <span>預金種別</span>
 </div>

  </div>
<div class="col-lg-9 col-md-9">

    <div class="outer row">
           <div class="col-lg-12 col-md-12 ">
<div class="m_t">未使用</div>
        </div>

 </div>

  </div>

  </div>
  <div class=" row row_data">
      <div class="col-lg-2 col-md-2">
   <div class="margin_t ">
      <span>口座番号</span>
 </div>

  </div>
<div class="col-lg-9 col-md-9">

    <div class="outer row">
           <div class="col-lg-12  col-md-12">
<div class="m_t">未使用</div>
        </div>

 </div>

  </div>

  </div>
    <div class=" row row_data">
      <div class="col-lg-2 col-md-2">
   <div class="margin_t ">
      <span>口座名義人</span>
 </div>

  </div>
<div class="col-lg-9 col-md-9">

    <div class="outer row">
           <div class="col-lg-12 col-md-12 ">
<div class="m_t">未使用</div>
        </div>

 </div>

  </div>

  </div>
    <div class=" row row_data">
      <div class="col-lg-2 col-md-2">
   <div class="margin_t ">
      <span>仕向銀行</span>
 </div>

  </div>
<div class="col-lg-9 col-md-9">

    <div class="outer row">
           <div class="col-lg-12  col-md-12">
<div class="m_t">未使用</div>
        </div>

 </div>

  </div>

  </div>
    <div class=" row row_data">
      <div class="col-lg-2 col-md-2">
   <div class="margin_t ">
      <span>仕向支店</span>
 </div>

  </div>
<div class="col-lg-9 col-md-9">

    <div class="outer row">
           <div class="col-lg-12  col-md-12">
<div class="m_t">未使用</div>
        </div>

 </div>

  </div>

  </div>

     <div class=" row row_data">
      <div class="col-lg-2 col-md-2">
     <div class="margin_t "><span>支払税区分</span></div>
  </div>
<div class="col-lg-4 col-md-4">

    <div class="outer row">
     <div class="col-lg-12 col-md-12">

<select class="form-control left_select ">
                      <option value="0">1 非課税・課税なし</option>
                      <option value="1">2 10％課税</option>

                     </select>

    </div>

    </div>
  </div>

  <div class="col-lg-6 col-md-6">

    <div class="outer row">
     <div class="col-lg-12 col-md-12 ">

      <div class="m_t"></div>

    </div>

    </div>
  </div>

  </div>

       <div class=" row row_data">
      <div class="col-lg-2 col-md-2">
     <div class="margin_t "><span>支払税端数区分</span></div>
  </div>
<div class="col-lg-4 col-md-4">

    <div class="outer row">
     <div class="col-lg-12 col-md-12 ">
<select class="form-control left_select ">
                      <option value="0">1 四捨五入</option>
                      <option value="1">2 切り上げ</option>
                      <option value="2">3 切り下げ</option>

                    </select>

    </div>

    </div>
  </div>

  <div class="col-lg-6 col-md-6">

    <div class="outer row">
     <div class="col-lg-12 col-md-12 ">

      <div class="m_t"></div>

    </div>

    </div>
  </div>

  </div>


       <div class=" row row_data">
      <div class="col-lg-2 col-md-2">
     <div class="margin_t "><span>源泉区分</span></div>
  </div>
<div class="col-lg-4 col-md-4">

    <div class="outer row">
     <div class="col-lg-12 col-md-12">

<input type="text" class=" input_field form-control" value="">

    </div>

    </div>
  </div>

  <div class="col-lg-6 col-md-6">

    <div class="outer row">
     <div class="col-lg-12 col-md-12">

      <div class="m_t">0：なし、1：あり</div>

    </div>

    </div>
  </div>

  </div>


         <div class=" row row_data">
      <div class="col-lg-2 col-md-2">
     <div class="margin_t "><span>
手形決済月</span></div>
  </div>
<div class="col-lg-4 col-md-4">
  <div class="outer row">
     <div class="col-lg-12 col-md-12 ">

<input type="text" class=" input_field form-control" value="">

    </div>

    </div>
  </div>

  <div class="col-lg-6 col-md-6">

    <div class="outer row">
     <div class="col-lg-12 col-md-12 ">

      <div class="m_t">0：当月、1：翌日、2：翌々月、3：3か月、4：4か月</div>

    </div>

    </div>
  </div>

  </div>

           <div class=" row row_data">
      <div class="col-lg-2 col-md-2">
     <div class="margin_t "><span>
手形決済日</span></div>
  </div>
<div class="col-lg-4 col-md-4">

    <div class="outer row">
     <div class="col-lg-12 col-md-12 ">

<select class="form-control left_select ">
                      <option value="0">01</option>
                      <option value="1">02</option>
                      <option value="2">03</option>
                      <option value="3">04</option>
                      <option value="4">05</option>
                      <option value="5">06</option>
                      <option value="6">07</option>
                      <option value="7">08</option>
                      <option value="8">09</option>
                      <option value="9">10</option>
                      <option value="10">11</option>
                      <option value="11">12</option>
                      <option value="12">13</option>
                      <option value="13">14</option>
                      <option value="14">15</option>
                      <option value="15">16</option>
                      <option value="16">17</option>
                      <option value="17">18</option>
                      <option value="18">19</option>
                      <option value="19">20</option>
                      <option value="20">21</option>
                      <option value="21">22</option>
                      <option value="22">23</option>
                      <option value="23">24</option>
                      <option value="24">25</option>
                      <option value="25">26</option>
                      <option value="26">27</option>
                      <option value="27">28</option>
                      <option value="28">29</option>
                      <option value="29">30</option>
                      <option value="30">31：月末</option>
                      </select>

    </div>

    </div>
  </div>

  <div class="col-lg-6 col-md-6">

    <div class="outer row">
     <div class="col-lg-12 col-md-12 ">

      <div class="m_t"></div>

    </div>

    </div>
  </div>

  </div>
  <div class=" row row_data">
      <div class="col-lg-2 col-md-2">
     <div class="margin_t "><span>
仕入消費税計算区分</span></div>
  </div>
<div class="col-lg-4 col-md-4">

    <div class="outer row">
     <div class="col-lg-12 col-md-12 ">

<input type="text" class=" input_field form-control" value="1">

    </div>

    </div>
  </div>

  <div class="col-lg-6 col-md-6">

    <div class="outer row">
     <div class="col-lg-12 col-md-12 ">

      <div class="m_t">1：伝票単位、2：明細単位</div>

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


    </div>
    </div>
                <div class="modal-footer">

                </div>
                </div>

        </div>
   </div>

<!--===================================MODAL 3 End==============================-->
<div class="modal fade"data-keyboard="false" data-backdrop="static" id="setting_display_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 1050px;">
                    <div  class="modal-content">
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

  <div class="col-lg-4 col-md-6 col-sm-6">
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
                                                <span class="mt-1 text-left">会社名 </span>
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
                                                <span class="mt-1 text-left">会社名略称 </span>
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
                                                <span class="mt-1 text-left">会社名カナ</span>
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
                                                <span class="mt-1 text-left">入力区分</span>
                                            </td>
                                        </tr>
                                          <tr>
                                            <td>
                                                <div class="custom-control custom-checkbox custom-control-inline">
                                                    <input type="checkbox" id="th6" class="custom-control-input customCheckBox ">
                                                    <label class="custom-control-label margin_btn_17" for="th6"></label>
                                                </div>
                                            </td>
                                               <td style="width:60px!important;">
                                                <input type="tel" class="form-control" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                                            </td>
                                            <td class="text-left">
                                                <span class="mt-1 text-left">帝国ﾃﾞｰﾀﾊﾞﾝｸ信用録PDF</span>
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
                                                <span class="mt-1 text-left">帝国ﾃﾞｰﾀﾊﾞﾝｸ取得年月日</span>
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
                                                <span class="mt-1 text-left">帝国ﾃﾞｰﾀﾊﾞﾝｸ企業ｺｰﾄﾞ</span>
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
                                                <span class="mt-1 text-left">帝国ﾃﾞｰﾀﾊﾞﾝｸ評点</span>
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
                                                <span class="mt-1 text-left">帝国ﾃﾞｰﾀﾊﾞﾝｸ業種区分１</span>
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
                                                <span class="mt-1 text-left">帝国ﾃﾞｰﾀﾊﾞﾝｸ業種区分２</span>
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
                                                <span class="mt-1 text-left">会社分類１</span>
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
                                                <span class="mt-1 text-left">社内備考（会社）</span>
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
                                                <span class="mt-1 text-left">即時区分</span>
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
                                                <span class="mt-1 text-left">請求締め日</span>
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
                                                <span class="mt-1 text-left">入金方法</span>
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
                                                <span class="mt-1 text-left">回収月 </span>
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
                                                <span class="mt-1 text-left">回収日</span>
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
                                                <span class="mt-1 text-left">回収日休日設定</span>
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
                                                <span class="mt-1 text-left">入金振込手数料設定</span>
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
                                                <input type="tel" class="form-control" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                                            </td>
                                            <td class="text-left">
                                                <span class="mt-1 text-left">与信限度額</span>
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
                                                <span class="mt-1 text-left">請求先CD</span>
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
                                                <span class="mt-1 text-left">請求書送付日</span>
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
                                                <span class="mt-1 text-left">請求書メール区分</span>
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
                                                <span class="mt-1 text-left">請求書メール宛先</span>
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
                                                <span class="mt-1 text-left">請求書UIS</span>
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
                                                <span class="mt-1 text-left">請求書郵送</span>
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
                                                <span class="mt-1 text-left">請求書郵送先</span>
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
                                                <input type="tel" class="form-control" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                                            </td>
                                            <td class="text-left">
                                                <span class="mt-1 text-left">請求税区分</span>
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
                                                <input type="tel" class="form-control" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                                            </td>
                                            <td class="text-left">
                                                <span class="mt-1 text-left">請求税端数区分</span>
                                            </td>
                                        </tr>


                                </tbody>
                            </table>
                        </div>
</div>

<div class="col-lg-4 col-md-6 col-sm-6">
                <div class="table-responsive setting_header">
                            <table class="table table-striped  table-bordered">
                                <tbody class="">

<tr>
                                            <td>
                                                <div class="custom-control custom-checkbox custom-control-inline">
                                                    <input type="checkbox" id="th31" class="custom-control-input customCheckBox">
                                                    <label class="custom-control-label margin_btn_17" for="th31" ></label>
                                                </div>
                                            </td>
                                               <td style="width:60px!important;">
                                                <input type="tel" class="form-control" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                                            </td>
                                            <td class="text-left">
                                                <span class="mt-1 text-left">専伝区分</span>
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
                                                <span class="mt-1 text-left">指定納品書帳票CD</span>
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
                                                <span class="mt-1 text-left">ユーザー区分</span>
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
                                                <span class="mt-1 text-left">データソース</span>
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
                                                <span class="mt-1 text-left">得意先分類１</span>
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
                                                <span class="mt-1 text-left">得意先分類２ </span>
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
                                                <span class="mt-1 text-left">得意先分類３</span>
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
                                                <span class="mt-1 text-left">得意先分類４</span>
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
                                                <span class="mt-1 text-left">得意先分類５</span>
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
                                                <span class="mt-1 text-left">得意先分類６</span>
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
                                                <input type="tel" class="form-control" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                                            </td>
                                            <td class="text-left">
                                                <span class="mt-1 text-left">会社分類２</span>
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
                                                <span class="mt-1 text-left">会社分類３</span>
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
                                                <span class="mt-1 text-left">会社分類4</span>
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
                                                <span class="mt-1 text-left">会社分類5</span>
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
                                                <span class="mt-1 text-left">取引開始日 東直</span>
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
                                                <span class="mt-1 text-left">取引開始日 東流</span>
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
                                                <span class="mt-1 text-left">取引開始日 西直</span>
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
                                                <span class="mt-1 text-left">取引開始日 西流</span>
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
                                                <span class="mt-1 text-left">単価設定区分</span>
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
                                                <span class="mt-1 text-left">支払締め日</span>
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
                                                <span class="mt-1 text-left">支払月</span>
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
                                                <span class="mt-1 text-left">支払日</span>
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
                                                <span class="mt-1 text-left">支払日休日設定</span>
                                            </td>
                                        </tr>
                                        <tr>
                                        <td>
                                                <div class="custom-control custom-checkbox custom-control-inline">
                                                    <input type="checkbox" id="th54" class="custom-control-input customCheckBox">
                                                    <label class="custom-control-label margin_btn_17" for="th54"></label>
                                                </div>
                                            </td>
                                               <td style="width:60px!important;">
                                                <input type="tel" class="form-control" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                                            </td>
                                            <td class="text-left">
                                                <span class="mt-1 text-left">支払振込手数料設定 </span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="custom-control custom-checkbox custom-control-inline">
                                                    <input type="checkbox" id="th55" class="custom-control-input customCheckBox">
                                                    <label class="custom-control-label margin_btn_17" for="th55"></label>
                                                </div>
                                            </td>
                                               <td style="width:60px!important;">
                                                <input type="tel" class="form-control" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                                            </td>
                                            <td class="text-left">
                                                <span class="mt-1 text-left">支払方法</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="custom-control custom-checkbox custom-control-inline">
                                                    <input type="checkbox" id="th56" class="custom-control-input customCheckBox">
                                                    <label class="custom-control-label margin_btn_17" for="th56"></label>
                                                </div>
                                            </td>
                                               <td style="width:60px!important;">
                                                <input type="tel" class="form-control" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                                            </td>
                                            <td class="text-left">
                                                <span class="mt-1 text-left">振込銀行</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="custom-control custom-checkbox custom-control-inline">
                                                    <input type="checkbox" id="th57" class="custom-control-input customCheckBox">
                                                    <label class="custom-control-label margin_btn_17" for="th57"></label>
                                                </div>
                                            </td>
                                               <td style="width:60px!important;">
                                                <input type="tel" class="form-control" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                                            </td>
                                            <td class="text-left">
                                                <span class="mt-1 text-left">振込支店</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="custom-control custom-checkbox custom-control-inline">
                                                    <input type="checkbox" id="th58" class="custom-control-input customCheckBox">
                                                    <label class="custom-control-label margin_btn_17" for="th58"></label>
                                                </div>
                                            </td>
                                               <td style="width:60px!important;">
                                                <input type="tel" class="form-control" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                                            </td>
                                            <td class="text-left">
                                                <span class="mt-1 text-left">預金種別</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="custom-control custom-checkbox custom-control-inline">
                                                    <input type="checkbox" id="th59" class="custom-control-input customCheckBox">
                                                    <label class="custom-control-label margin_btn_17" for="th59"></label>
                                                </div>
                                            </td>
                                               <td style="width:60px!important;">
                                                <input type="tel" class="form-control" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                                            </td>
                                            <td class="text-left">
                                                <span class="mt-1 text-left">口座番号</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="custom-control custom-checkbox custom-control-inline">
                                                    <input type="checkbox" id="th60" class="custom-control-input customCheckBox">
                                                    <label class="custom-control-label margin_btn_17" for="th60"></label>
                                                </div>
                                            </td>
                                               <td style="width:60px!important;">
                                                <input type="tel" class="form-control" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                                            </td>
                                            <td class="text-left">
                                                <span class="mt-1 text-left">口座名義人</span>
                                            </td>
                                        </tr>


                                </tbody>
                            </table>
                        </div>
</div>


<div class="col-lg-4 col-md-6 col-sm-6">
                <div class="table-responsive setting_header">
                            <table class="table table-striped  table-bordered">
                                <tbody class="">
               <tr>
                                            <td>
                                                <div class="custom-control custom-checkbox custom-control-inline">
                                                    <input type="checkbox" id="th61" class="custom-control-input customCheckBox">
                                                    <label class="custom-control-label margin_btn_17" for="th61"></label>
                                                </div>
                                            </td>
                                               <td style="width:60px!important;">
                                                <input type="tel" class="form-control" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                                            </td>
                                            <td class="text-left">
                                                <span class="mt-1 text-left">仕向銀行</span>
                                            </td>
                                        </tr>

                                                 <tr>
                                            <td>
                                                <div class="custom-control custom-checkbox custom-control-inline">
                                                    <input type="checkbox" id="th62" class="custom-control-input customCheckBox">
                                                    <label class="custom-control-label margin_btn_17" for="th62"></label>
                                                </div>
                                            </td>
                                               <td style="width:60px!important;">
                                                <input type="tel" class="form-control" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                                            </td>
                                            <td class="text-left">
                                                <span class="mt-1 text-left">仕向支店</span>
                                            </td>
                                        </tr>

                                                 <tr>
                                            <td>
                                                <div class="custom-control custom-checkbox custom-control-inline">
                                                    <input type="checkbox" id="th63" class="custom-control-input customCheckBox">
                                                    <label class="custom-control-label margin_btn_17" for="th63"></label>
                                                </div>
                                            </td>
                                               <td style="width:60px!important;">
                                                <input type="tel" class="form-control" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                                            </td>
                                            <td class="text-left">
                                                <span class="mt-1 text-left">支払税区分</span>
                                            </td>
                                        </tr>

                                                 <tr>
                                            <td>
                                                <div class="custom-control custom-checkbox custom-control-inline">
                                                    <input type="checkbox" id="th64" class="custom-control-input customCheckBox">
                                                    <label class="custom-control-label margin_btn_17" for="th64"></label>
                                                </div>
                                            </td>
                                               <td style="width:60px!important;">
                                                <input type="tel" class="form-control" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                                            </td>
                                            <td class="text-left">
                                                <span class="mt-1 text-left">支払税端数区分</span>
                                            </td>
                                        </tr>

                                                 <tr>
                                            <td>
                                                <div class="custom-control custom-checkbox custom-control-inline">
                                                    <input type="checkbox" id="th65" class="custom-control-input customCheckBox">
                                                    <label class="custom-control-label margin_btn_17" for="th65"></label>
                                                </div>
                                            </td>
                                               <td style="width:60px!important;">
                                                <input type="tel" class="form-control" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                                            </td>
                                            <td class="text-left">
                                                <span class="mt-1 text-left">源泉区分</span>
                                            </td>
                                        </tr>


                                        <tr>
                                            <td>
                                                <div class="custom-control custom-checkbox custom-control-inline">
                                                    <input type="checkbox" id="th66" class="custom-control-input customCheckBox">
                                                    <label class="custom-control-label margin_btn_17" for="th66"></label>
                                                </div>
                                            </td>
                                               <td style="width:60px!important;">
                                                <input type="tel" class="form-control" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                                            </td>
                                            <td class="text-left">
                                                <span class="mt-1 text-left">支払先分類1</span>
                                            </td>
                                        </tr>

                                                 <tr>
                                            <td>
                                                <div class="custom-control custom-checkbox custom-control-inline">
                                                    <input type="checkbox" id="th67" class="custom-control-input customCheckBox">
                                                    <label class="custom-control-label margin_btn_17" for="th67"></label>
                                                </div>
                                            </td>
                                               <td style="width:60px!important;">
                                                <input type="tel" class="form-control" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                                            </td>
                                            <td class="text-left">
                                                <span class="mt-1 text-left">支払先分類2</span>
                                            </td>
                                        </tr>


                                                 <tr>
                                            <td>
                                                <div class="custom-control custom-checkbox custom-control-inline">
                                                    <input type="checkbox" id="th68" class="custom-control-input customCheckBox">
                                                    <label class="custom-control-label margin_btn_17" for="th68"></label>
                                                </div>
                                            </td>
                                               <td style="width:60px!important;">
                                                <input type="tel" class="form-control" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                                            </td>
                                            <td class="text-left">
                                                <span class="mt-1 text-left">手形決済月</span>
                                            </td>
                                        </tr>


                                                 <tr>
                                            <td>
                                                <div class="custom-control custom-checkbox custom-control-inline">
                                                    <input type="checkbox" id="th69" class="custom-control-input customCheckBox">
                                                    <label class="custom-control-label margin_btn_17" for="th69"></label>
                                                </div>
                                            </td>
                                               <td style="width:60px!important;">
                                                <input type="tel" class="form-control" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                                            </td>
                                            <td class="text-left">
                                                <span class="mt-1 text-left">手形決済日</span>
                                            </td>
                                        </tr>


                                                 <tr>
                                            <td>
                                                <div class="custom-control custom-checkbox custom-control-inline">
                                                    <input type="checkbox" id="th70" class="custom-control-input customCheckBox">
                                                    <label class="custom-control-label margin_btn_17" for="th70"></label>
                                                </div>
                                            </td>
                                               <td style="width:60px!important;">
                                                <input type="tel" class="form-control" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                                            </td>
                                            <td class="text-left">
                                                <span class="mt-1 text-left">保守更新案内有無</span>
                                            </td>
                                        </tr>


                                        <tr>
                                            <td>
                                                <div class="custom-control custom-checkbox custom-control-inline">
                                                    <input type="checkbox" id="th71" class="custom-control-input customCheckBox">
                                                    <label class="custom-control-label margin_btn_17" for="th71"></label>
                                                </div>
                                            </td>
                                               <td style="width:60px!important;">
                                                <input type="tel" class="form-control" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                                            </td>
                                            <td class="text-left">
                                                <span class="mt-1 text-left">ライセンス証書有無</span>
                                            </td>
                                        </tr>
                                                 <tr>
                                            <td>
                                                <div class="custom-control custom-checkbox custom-control-inline">
                                                    <input type="checkbox" id="th72" class="custom-control-input customCheckBox">
                                                    <label class="custom-control-label margin_btn_17" for="th72"></label>
                                                </div>
                                            </td>
                                               <td style="width:60px!important;">
                                                <input type="tel" class="form-control" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                                            </td>
                                            <td class="text-left">
                                                <span class="mt-1 text-left">検収条件</span>
                                            </td>
                                        </tr>
                                                 <tr>
                                            <td>
                                                <div class="custom-control custom-checkbox custom-control-inline">
                                                    <input type="checkbox" id="th73" class="custom-control-input customCheckBox">
                                                    <label class="custom-control-label margin_btn_17" for="th73"></label>
                                                </div>
                                            </td>
                                               <td style="width:60px!important;">
                                                <input type="tel" class="form-control" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                                            </td>
                                            <td class="text-left">
                                                <span class="mt-1 text-left">法人マイナンバー </span>
                                            </td>
                                        </tr>
                                <tr>
                                            <td>
                                                <div class="custom-control custom-checkbox custom-control-inline">
                                                    <input type="checkbox" id="th74" class="custom-control-input customCheckBox">
                                                    <label class="custom-control-label margin_btn_17" for="th74"></label>
                                                </div>
                                            </td>
                                               <td style="width:60px!important;">
                                                <input type="tel" class="form-control" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                                            </td>
                                            <td class="text-left">
                                                <span class="mt-1 text-left">会計取引先CD</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="custom-control custom-checkbox custom-control-inline">
                                                    <input type="checkbox" id="th75" class="custom-control-input customCheckBox">
                                                    <label class="custom-control-label margin_btn_17" for="th75"></label>
                                                </div>
                                            </td>
                                               <td style="width:60px!important;">
                                                <input type="tel" class="form-control" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                                            </td>
                                            <td class="text-left">
                                                <span class="mt-1 text-left">売上区分</span>
                                            </td>
                                        </tr>
                                       <tr>
                                            <td>
                                                <div class="custom-control custom-checkbox custom-control-inline">
                                                    <input type="checkbox" id="th76" class="custom-control-input customCheckBox">
                                                    <label class="custom-control-label margin_btn_17" for="th76"></label>
                                                </div>
                                            </td>
                                               <td style="width:60px!important;">
                                                <input type="tel" class="form-control" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                                            </td>
                                            <td class="text-left">
                                                <span class="mt-1 text-left">仕入区分</span>
                                            </td>
                                        </tr>




                                         <tr>
                                            <td>
                                                <div class="custom-control custom-checkbox custom-control-inline">
                                                    <input type="checkbox" id="th78" class="custom-control-input customCheckBox">
                                                    <label class="custom-control-label margin_btn_17" for="th78"></label>
                                                </div>
                                            </td>
                                               <td style="width:60px!important;">
                                                <input type="tel" class="form-control" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                                            </td>
                                            <td class="text-left">
                                                <span class="mt-1 text-left">会社名カナ入金消込用</span>
                                            </td>
                                        </tr>

                                         <tr>
                                            <td>
                                                <div class="custom-control custom-checkbox custom-control-inline">
                                                    <input type="checkbox" id="th79" class="custom-control-input customCheckBox">
                                                    <label class="custom-control-label margin_btn_17" for="th79"></label>
                                                </div>
                                            </td>
                                               <td style="width:60px!important;">
                                                <input type="tel" class="form-control" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                                            </td>
                                            <td class="text-left">
                                                <span class="mt-1 text-left">請求消費税計算区分</span>
                                            </td>
                                        </tr>

                                         <tr>
                                            <td>
                                                <div class="custom-control custom-checkbox custom-control-inline">
                                                    <input type="checkbox" id="th80" class="custom-control-input customCheckBox">
                                                    <label class="custom-control-label margin_btn_17" for="th80"></label>
                                                </div>
                                            </td>
                                               <td style="width:60px!important;">
                                                <input type="tel" class="form-control" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                                            </td>
                                            <td class="text-left">
                                                <span class="mt-1 text-left">仕入消費税計算区分</span>
                                            </td>
                                        </tr>
                                       <tr>
                                            <td>
                                                <div class="custom-control custom-checkbox custom-control-inline">
                                                    <input type="checkbox" id="th81" class="custom-control-input customCheckBox">
                                                    <label class="custom-control-label margin_btn_17" for="th81"></label>
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
                                                    <input type="checkbox" id="th82" class="custom-control-input customCheckBox">
                                                    <label class="custom-control-label margin_btn_17" for="th82"></label>
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
                                                    <input type="checkbox" id="th83" class="custom-control-input customCheckBox">
                                                    <label class="custom-control-label margin_btn_17" for="th83"></label>
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
                                                    <input type="checkbox" id="th84" class="custom-control-input customCheckBox">
                                                    <label class="custom-control-label margin_btn_17" for="th84"></label>
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
                                                    <input type="checkbox" id="th85" class="custom-control-input customCheckBox">
                                                    <label class="custom-control-label margin_btn_17" for="th85"></label>
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
                                                    <input type="checkbox" id="th86" class="custom-control-input customCheckBox">
                                                    <label class="custom-control-label margin_btn_17" for="th86"></label>
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
<!--
pop up modal start -->

    <div class="modal fade" data-backdrop="static" id="comp_modal4" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 600px!important;">
            <div class="modal-content">

                 <div class="modal-header">
                    <h5 class="modal-title">請求先検索</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>

                <div class="modal-body">

 <div class="row">
        <div class="col-lg-12">

                        <h4 style="margin-bottom: 15px;margin-top: 10px;">会社マスタ</h4>
  <div style="margin-bottom: 5px;">
  <table class="table" style="border: none!important;width: auto;">
    <tbody>
      <tr>

         <td style=" border: none!important;width: 40px!important;">ｶﾅ/名称</td>
         <td style=" border: none!important;"><input type = "text" class = "form-control" id = "" placeholder = "ｻﾝﾌﾟﾙ"></td>
        <td style=" border: none!important;"><button type="button" id="comp_search_button" class="btn btn-info btn_search" data-toggle="modal" data-target="#" style="margin-top: 2px;" >検索

      </button></td>
      </tr>

    </tbody>
   </table>
</div>


  <div class="table_wrap">
<div class=" page4_table_design mt-2  table_hover  table-head-only">


<div id="initial_content_comp1" style="display: none;">

<table class="table table-striped " id="table-basic">
                                            <thead class="thead-dark header text-center" id="myHeader">
                                                <tr>

                                                    <th scope="col" style="background-color: #c2d6d6!important;color: #17252A; border-top: 1px solid #29487d!important;">会社CD</th>
                                                    <th scope="col" style="background-color: #c2d6d6!important;color: #17252A; border-top: 1px solid #29487d!important;">会社名</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                <tr class="comp_content1_row table_hover2 gridAlternada">
                                               <!--      <td scope="row">
                                                      <div class="radio">
                                                        <label style="margin-left: 11px;margin-top: 6px;margin-bottom: 0px;"><input type="radio" name="optradio"></label>
                                                      </div>
                                                    </td> -->
                                                    <td style="width: 50px; text-align: center;">123456 </td>
                                                    <td> 株式会社サンプル </td>

                                                </tr>
                                                <tr class=" comp_content1_row comp_content1_row table_hover2 grid">

                                                    <td style="width: 50px; text-align: center;">234567 </td>
                                                    <td>アロン化成株式会社
 </td>

                                                </tr>
                                                <tr class="comp_content1_row table_hover2 gridAlternada ">

                                                    <td style="width: 50px; text-align: center;">456789</td>
                                                    <td>株式会社寺岡製作所
</td>

                                                </tr>
                                            </tbody>
                                        </table>

</div>

   <div id="office_master_content_comp2" style="display: none;">

<!-- 2nd modal content -->
                       <h4 style="margin-bottom: 15px;margin-top: 15px;">事業所マスタ</h4>

<div style="width: 99%;">
<table class="table table-striped ">

        <thead class="thead-dark header text-center" id="myHeader">
                                                <tr>

                                                    <th scope="col"style="background-color: #c2d6d6!important;color: #17252A;border-top: 1px solid #29487d!important;">事業所CD</th>
                                                    <th scope="col"style="background-color: #c2d6d6!important;color: #17252A;border-top: 1px solid #29487d!important;">事業所名</th>

                                                </tr>
                                            </thead>
                                            <tbody>

                                            <tr class="comp_content2_row">

                                            <td style="width:50px;text-align: center;">01</td>

                                            <td>東京本社</td>




                                            </tr>

                    <tr class="comp_content2_row">

                        <td style="width:50px;text-align: center;">02</td>


                       <td>大阪支店
                            </td>
                   </tr>

                    <tr class="comp_content2_row">

                        <td style="width:50px;text-align: center;">03</td>


                       <td>福岡支店
                            </td>
                   </tr>
                      </tbody>
                     </table>
                      </div>


           </div>










<!-- 2nd modal content end -->

    <!-- 3rd modal content  -->

                                    </div>
 </div>

 </div>
 </div>
<div class="row">
<div class="col-lg-6">

<div id="personal_master_content_comp3" style="display: none;">

  <h4 style="margin-bottom: 15px; margin-top: 10px;">個人マスタ</h4>

<div style="width: 99%;">
<table class="table table-striped ">

        <thead class="thead-dark header text-center" id="myHeader">
                                                <tr>

                                                    <th scope="col" style="background-color: #c2d6d6!important;color: #17252A;border-top: 1px solid #29487d!important;">個人CD</th>
                                                    <th scope="col" style="background-color: #c2d6d6!important;color: #17252A;border-top: 1px solid #29487d!important;">名称</th>

                                                </tr>
                                            </thead>
    <tbody>

   <tr class="comp_content3_row">

        <td style="width:50px;text-align: center;">001</td>

      <td>山田太郎</td>




      </tr>

         <tr class="comp_content3_row">

        <td style="width:50px;text-align: center;">002</td>


      <td>佐藤一郎</td>


      </tr>

    </tbody>
  </table>
</div>

</div>




</div>

<div class="col-lg-6">


<div id="last_content_comp3" style="display: none;">

  <h4 style="margin-bottom: 15px; margin-top: 10px;">個人マスタ</h4>

<div style="width: 99%;">
<table class="table table-striped ">


    <tbody>

   <tr class="">

        <td style="width:50px;text-align: center;background-color: #c2d6d6!important;color: #17252A;border-top: 1px solid #29487d!important;">個人CD</td>

      <td style="border-top: 1px solid #29487d!important;">001</td>

      </tr>
   <tr class="">

        <td style="width:50px;text-align: center;background-color: #c2d6d6!important;color: #17252A;">部</td>

      <td>経営企画部</td>

      </tr>
   <tr class="">

        <td style="width:50px;text-align: center;background-color: #c2d6d6!important;color: #17252A;">グループ</td>

      <td>システム</td>

      </tr>

         <tr class="">

        <td style="width:50px;text-align: center;background-color: #c2d6d6!important;color: #17252A;">氏名</td>

      <td>山田太郎</td>

      </tr>
      <tr class="">

        <td style="width:50px;text-align: center;background-color: #c2d6d6!important;color: #17252A;">メールアドレス</td>

      <td><a href="#" style="color:blue;" >sample@xxx.co.jp</a></td>

      </tr>
            <tr class="">

        <td style="width:50px;text-align: center;background-color: #c2d6d6!important;color: #17252A;">電話番号</td>

      <td>03-4567-9100</td>

      </tr>
    </tbody>
  </table>
</div>

</div>


</div>



</div>




<!-- 4th modal content end  -->
                              <!-- modal content enddd   -->

                </div>
                <div class="modal-footer">
                     <button type="button" id="choice_button" class="btn btn-info"  data-dismiss="modal"> <i class="fa fa-hand-paper-o" aria-hidden="true" style="margin-right: 5px;" ></i>選択

</button>
                </div>
            </div>
        </div>
    </div>


<!-- pop up modal end -->

 <script type="text/javascript">

                             $(function(){
                                      $('#comp_search_button').click(function(){

                                  // $(this).addClass('add_border');

                                       $("#initial_content_comp1").show();


                                         });

                                     });

         </script>


        <script type="text/javascript">

                                         $(function(){
                                      $('.comp_content1_row').click(function(){
                                         //e.preventDefault();
                            //$(this).removeClass('active')
                               $(this).addClass('add_border');
                                        // $(this).css('border', "solid 2px red");
                                       $("#office_master_content_comp2").show();

                                         // $(this).closest('td').find("#office_master_content_div").toggle();
                                         });
                                          });

                       </script>
          <script type="text/javascript">

                                         $(function(){
                                      $('.comp_content2_row').click(function(){
                                         //e.preventDefault();
                            //$(this).removeClass('active')
                               $(this).addClass('add_border');
                                        // $(this).css('border', "solid 2px red");
                                       $("#personal_master_content_comp3").show();

                                         // $(this).closest('td').find("#office_master_content_div").toggle();
                                         });
                                          });

                       </script>

          <script type="text/javascript">

                                         $(function(){
                                      $('.comp_content3_row').click(function(){
                                         //e.preventDefault();
                            //$(this).removeClass('active')
                               $(this).addClass('add_border');
                                        // $(this).css('border', "solid 2px red");
                                       $("#last_content_comp3").show();

                                         // $(this).closest('td').find("#office_master_content_div").toggle();
                                         });
                                          });

                       </script>
   <script type="text/javascript">
    $("#choice_button").click(function() {


                //$("#initial_content").hide();
                  $("#initial_content_comp1").hide();
                  $("#office_master_content_comp2").hide();
                  $("#personal_master_content_comp3").hide();
$("#last_content_comp3").hide();

                    if ( $(".comp_content1_row").hasClass("add_border") ) {
        $(".comp_content1_row").removeClass('add_border');
    }

                if ( $(".comp_content2_row").hasClass("add_border") ) {
        $(".comp_content2_row").removeClass('add_border');
    }
                  if ( $(".comp_content3_row").hasClass("add_border") ) {
        $(".comp_content3_row").removeClass('add_border');
    }


            });

</script>
   <script type="text/javascript">
    $("#popup2_comp").click(function() {


                //$("#initial_content").hide();
                  $("#initial_content_comp1").hide();
                  $("#office_master_content_comp2").hide();
                  $("#personal_master_content_comp3").hide();
$("#last_content_comp3").hide();

                    if ( $(".comp_content1_row").hasClass("add_border") ) {
        $(".comp_content1_row").removeClass('add_border');
    }

                if ( $(".comp_content2_row").hasClass("add_border") ) {
        $(".comp_content2_row").removeClass('add_border');
    }
                  if ( $(".comp_content3_row").hasClass("add_border") ) {
        $(".comp_content3_row").removeClass('add_border');
    }


            });

</script>






           <script type="text/javascript">
  $(document).ready(function(){
    $("#btnMsgShowHide").click(function(){
      $("#msgDivShowHide").toggle();
            $("#border_input").toggleClass("Red");

             $("#border_input").removeClass('form-control').addClass('Red');
    });
  });
</script>

@include('layout.footer')

<!-- <link href="//ajax.aspnetcdn.com/ajax/jquery.ui/1.8.9/themes/blitzer/jquery-ui.css" rel="stylesheet" type="text/css"> -->
<script src="{{ asset('js/jquery-3.4.1.min.js') }}"></script>
<!--Bootstrap 4.x-->
<script src="  {{ asset('js/bootstrap.min.js') }}"></script>
<!--   <script src="{{ asset('js/jquery.jpDatePicker.js') }}"></script> -->
<!--Jquery Map for mac operating system-->
<script src=" {{ asset('js/select2.min.js') }}"></script>
   <!--  <script src=" {{ asset('js/jadatepicker.js') }}"></script>-->
<script src="  {{ asset('js/datepicker.js') }}"></script>
<script src="  {{ asset('js/datepicker.ja-JP.js') }}"></script>
    <!--    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>-->
    <!-- <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>-->
<!-- <script>
            $(document).ready(function () {
        $('#dateButton').jpDatePicker({ format:'YYYY/MM/DD' }, 'dateShow');
    });
    function dateValidate(date, id) {
        if(document.getElementById("dateShow") && id == 'dateShow'){
            document.getElementById("dateShow").value = date;
            // addOrderIssueDateValidator();
        }
    }
          </script>

<script>
            $(document).ready(function () {
        $('#dateButton2').jpDatePicker({ format:'YYYY/MM/DD' }, 'dateShow2');
    });
    function dateValidate2(date, id) {
        if(document.getElementById("dateShow2") && id == 'dateShow2'){
            document.getElementById("dateShow2").value = date;
            // addOrderIssueDateValidator();
        }
    }
          </script> -->








 <script type="text/javascript">

$("#comp_button3").on("click", function(){
    $("#comp_modal2").modal("hide");
  $('body').removeClass('modal-open');
  $('body').css('overflow-y', 'hidden');
 $('.modal-backdrop').remove();


});

</script>
<script type="text/javascript">
    $(function () {
      $('#datepicker1_com').datepicker({
        language: 'ja-JP',
        format: 'yyyy-mm-dd',
        autoHide: true,
        zIndex: 2048,

      });

    });


</script>
<script type="text/javascript">

   $(document).on('click',"#cal_icon1_c",function(){
         $("#datepicker1_com").datepicker("show");
     });

</script>
<script type="text/javascript">
    $(function () {
      $('#datepicker2_com').datepicker({
        language: 'ja-JP',
        format: 'yyyy-mm-dd',
        autoHide: true,
        zIndex: 2048,

      });

    });


</script>
<script type="text/javascript">

   $(document).on('click',"#cal_icon2_c",function(){
         $("#datepicker2_com").datepicker("show");
     });

</script>


<script type="text/javascript">
    $(function () {
      $('#datepicker3_com').datepicker({
        language: 'ja-JP',
        format: 'yyyy-mm-dd',
        autoHide: true,
        zIndex: 2048,

      });

    });


</script>
<script type="text/javascript">

   $(document).on('click',"#cal_icon3_c",function(){
         $("#datepicker3_com").datepicker("show");
     });

</script>

<script type="text/javascript">
    $(function () {
      $('#datepicker4_com').datepicker({
        language: 'ja-JP',
        format: 'yyyy-mm-dd',
        autoHide: true,
        zIndex: 2048,

      });

    });


</script>
<script type="text/javascript">

   $(document).on('click',"#cal_icon4_c",function(){
         $("#datepicker4_com").datepicker("show");
     });

</script>
<script type="text/javascript">
    $(function () {
      $('#datepicker5_com').datepicker({
        language: 'ja-JP',
        format: 'yyyy-mm-dd',
        autoHide: true,
        zIndex: 2048,

      });

    });


</script>
<script type="text/javascript">

   $(document).on('click',"#cal_icon5_c",function(){
         $("#datepicker5_com").datepicker("show");
     });

</script>
<script type="text/javascript">
    $(function () {
      $('#datepicker6_com').datepicker({
        language: 'ja-JP',
        format: 'yyyy-mm-dd',
        autoHide: true,
        zIndex: 2048,

      });

    });


</script>
<script type="text/javascript">

   $(document).on('click',"#cal_icon6_c",function(){
         $("#datepicker6_com").datepicker("show");
     });

</script>

<script type="text/javascript">
    $(function () {
      $('#datepicker7_com').datepicker({
        language: 'ja-JP',
        format: 'yyyy-mm-dd',
        autoHide: true,
        zIndex: 2048,

      });

    });


</script>
<script type="text/javascript">

   $(document).on('click',"#cal_icon7_c",function(){
         $("#datepicker7_com").datepicker("show");
     });

</script>
<script type="text/javascript">
    $(function () {
      $('#datepicker8_com').datepicker({
        language: 'ja-JP',
        format: 'yyyy-mm-dd',
        autoHide: true,
        zIndex: 2048,

      });

    });


</script>
<script type="text/javascript">

   $(document).on('click',"#cal_icon8_c",function(){
         $("#datepicker8_com").datepicker("show");
     });

</script>

<script type="text/javascript">
    $(function () {
      $('#datepicker9_com').datepicker({
        language: 'ja-JP',
        format: 'yyyy-mm-dd',
        autoHide: true,
        zIndex: 2048,

      });

    });


</script>
<script type="text/javascript">

   $(document).on('click',"#cal_icon9_c",function(){
         $("#datepicker9_com").datepicker("show");
     });

</script>
<script type="text/javascript">
    $(function () {
      $('#datepicker10_com').datepicker({
        language: 'ja-JP',
        format: 'yyyy-mm-dd',
        autoHide: true,
        zIndex: 2048,

      });

    });


</script>
<script type="text/javascript">

   $(document).on('click',"#cal_icon10_c",function(){
         $("#datepicker10_com").datepicker("show");
     });

</script>
<!-- <script>
$(document).ready(function(){
    $("#setting_modal_button").click(function(){
        $("#setting_display_modal").modal({
            backdrop: 'static',
            keyboard: false
        });
    });
});
</script> -->



<script type="text/javascript">


var currentBoxNumber = 0;
$("#input_boxwrap_common1").keypress(function (event) {
    if (event.keyCode == 13) {
        textboxes = $("input.input_field");
        currentBoxNumber = textboxes.index(event.target);
        if (textboxes[currentBoxNumber + 1] != null) {
            nextBox = textboxes[currentBoxNumber + 1];
            nextBox.focus();
            nextBox.select();
            event.preventDefault();
            return false;
        }
    }
});

</script>





<script type="text/javascript">


var currentBoxNumber = 0;
$("#input_boxwrap_sales_billing1").keypress(function (event) {
    if (event.keyCode == 13) {
        textboxes = $("input.input_field");
        currentBoxNumber = textboxes.index(event.target);
        if (textboxes[currentBoxNumber + 1] != null) {
            nextBox = textboxes[currentBoxNumber + 1];
            nextBox.focus();
            nextBox.select();
            event.preventDefault();
            return false;
        }
    }
});

</script>

<script type="text/javascript">


var currentBoxNumber = 0;
$("#input_boxwrap_payment1").keypress(function (event) {
    if (event.keyCode == 13) {
        textboxes = $("input.input_field");
        currentBoxNumber = textboxes.index(event.target);
        if (textboxes[currentBoxNumber + 1] != null) {
            nextBox = textboxes[currentBoxNumber + 1];
            nextBox.focus();
            nextBox.select();
            event.preventDefault();
            return false;
        }
    }
});

</script>



<script type="text/javascript">


var currentBoxNumber = 0;
$("#input_boxwrap_common2").keypress(function (event) {
    if (event.keyCode == 13) {
        textboxes = $("input.input_field");
        currentBoxNumber = textboxes.index(event.target);
        if (textboxes[currentBoxNumber + 1] != null) {
            nextBox = textboxes[currentBoxNumber + 1];
            nextBox.focus();
            nextBox.select();
            event.preventDefault();
            return false;
        }
    }
});

</script>





<script type="text/javascript">


var currentBoxNumber = 0;
$("#input_boxwrap_sales_billing2").keypress(function (event) {
    if (event.keyCode == 13) {
        textboxes = $("input.input_field");
        currentBoxNumber = textboxes.index(event.target);
        if (textboxes[currentBoxNumber + 1] != null) {
            nextBox = textboxes[currentBoxNumber + 1];
            nextBox.focus();
            nextBox.select();
            event.preventDefault();
            return false;
        }
    }
});

</script>

<script type="text/javascript">


var currentBoxNumber = 0;
$("#input_boxwrap_payment2").keypress(function (event) {
    if (event.keyCode == 13) {
        textboxes = $("input.input_field");
        currentBoxNumber = textboxes.index(event.target);
        if (textboxes[currentBoxNumber + 1] != null) {
            nextBox = textboxes[currentBoxNumber + 1];
            nextBox.focus();
            nextBox.select();
            event.preventDefault();
            return false;
        }
    }
});

</script>

<script type="text/javascript">


var currentBoxNumber = 0;
$("#input_boxwrap_common3").keypress(function (event) {
    if (event.keyCode == 13) {
        textboxes = $("input.input_field");
        currentBoxNumber = textboxes.index(event.target);
        if (textboxes[currentBoxNumber + 1] != null) {
            nextBox = textboxes[currentBoxNumber + 1];
            nextBox.focus();
            nextBox.select();
            event.preventDefault();
            return false;
        }
    }
});

</script>





<script type="text/javascript">


var currentBoxNumber = 0;
$("#input_boxwrap_sales_billing3").keypress(function (event) {
    if (event.keyCode == 13) {
        textboxes = $("input.input_field");
        currentBoxNumber = textboxes.index(event.target);
        if (textboxes[currentBoxNumber + 1] != null) {
            nextBox = textboxes[currentBoxNumber + 1];
            nextBox.focus();
            nextBox.select();
            event.preventDefault();
            return false;
        }
    }
});

</script>

<script type="text/javascript">


var currentBoxNumber = 0;
$("#input_boxwrap_payment3").keypress(function (event) {
    if (event.keyCode == 13) {
        textboxes = $("input.input_field");
        currentBoxNumber = textboxes.index(event.target);
        if (textboxes[currentBoxNumber + 1] != null) {
            nextBox = textboxes[currentBoxNumber + 1];
            nextBox.focus();
            nextBox.select();
            event.preventDefault();
            return false;
        }
    }
});



      function lastTab(event)
      {
        if (event.keyCode==13)
        {
          document.getElementById("border_input").focus();
          event.preventDefault();
        }
      }
      document.onkeydown = function (event) {
        if(event.shiftKey && event.keyCode == 13)
        {
          return false;
        }
      }



</script>





</body>
</html>