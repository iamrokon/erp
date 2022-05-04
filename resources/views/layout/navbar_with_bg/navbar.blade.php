<!DOCTYPE html>
<html lang="ja" >
<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="msapplication-tap-highlight" content="no">
    <title></title>
  <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}" >
    <link href="https://use.fontawesome.com/releases/v5.0.4/css/all.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="{{ asset('css/navbar_styles.css') }}" >
<link rel="stylesheet" type="text/css" href="{{ asset('css/login_styles.css') }}" >
<link rel="stylesheet" type="text/css" href="{{ asset('css/modal_styles.css') }}" >

<!--[if lt IE 9]>
<script>
  document.createElement('bg_blue');
  document.createElement('dropdown-content');
</script>
<![endif]-->
<style type="text/css">



.topnav {
  overflow: hidden;
/*  background-color: #3C6BBC;*/
}

.topnav a {
  float: left;
  display: block;
  color: #f2f2f2;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
  font-size: 14px;
}

/*.active {
  background-color: #4CAF50;
  color: white;
}*/

.topnav .icon {
  display: none;
}

.dropdown {
  float: left;
  overflow: hidden;
}

.dropdown .dropbtn {
  font-size: 14px;
  border: none;
  outline: none;
  color: white;
  padding: 14px 16px;

  font-family: inherit;
  margin: 0;
}

.dropdown-content {
  display: none;
  position: absolute;
background-color: #c2ddef;
  min-width: 160px;
/*  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);*/
  z-index: 1;
}

.dropdown-content a {
  float: none;
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
  text-align: left;
}

.topnav a:hover, .dropdown:hover .dropbtn {
background-color: #2B4B82;
  color: white;
}

.dropdown-content a:hover {
background-color: #2B4B82;
  color: white;
}

.dropdown:hover .dropdown-content {
  display: block;
}
#top_navbar_hidden_res{
  display: none;
}

 @media screen and (-ms-high-contrast: none), (-ms-high-contrast: active) {


.ml-5_res{
  margin-left: 2rem!important;
}
        }





.ml-5_res{
  margin-left: 3rem;
}

@media screen and (min-width: 1200px) {

 .ml-5_res{
margin-left: 2rem!important;
}

}

@media screen and (min-width: 1024px) {

 .ml-5_res{
float: left!important;
}

}

/*@media screen, all and (min-width: 768px) {

.ml-5_res{
margin-left: 4rem!important;
}
}*/
@media screen and (max-width: 1024px) {
  .topnav a:not(:first-child), .dropdown .dropbtn {
    display: none;
  }
  .topnav a.icon {
    float: right;
    display: block;
  }
}

@media screen and (max-width: 1024px) {

#top_navbar_hidden_res{
  display:block;
}

  .topnav.responsive {position: relative;/*background-color:#29487d;*/}
  .topnav.responsive .icon {
    position: absolute;
    right: 0;
    top: 0;
  }
  .topnav.responsive a {
    float: none;
    display: block;
    text-align: left;
  }
  .topnav.responsive .dropdown {float: none;}
  .topnav.responsive .dropdown-content {position: relative;}
  .topnav.responsive .dropdown .dropbtn {
    display: block;
    width: 100%;
    text-align: left;
   background-color: #3e6ec1;
  }
 .topnav.responsive .dropdown .dropbtn:hover{
  background-color: #2B4B82!important;
 }

  #cssmenu{
    display: none;
  }
}

.active {
 background-image:linear-gradient(right top, #29487d, #3e6ec1 55%, #29487d);
    background-image:-webkit-linear-gradient(right top, #29487d, #3e6ec1 55%, #29487d);
     background-image:-ms-linear-gradient(right top, #29487d, #3e6ec1 55%, #29487d);
  color: white;
}


.bg_blue {
/* background-color: #29487d;*/
 outline: 0;
}
</style>

</head>
<body>


<!-- navbar starts here -->

<div class="topnav" id="top_navbar_hidden_res">

  <div class="active" style="width: 100%;height: 51px;"><a href="http://127.0.0.1:8000/click" style="color: white; text-decoration: none;">
       ユーザックシステム株式会社
      </a>
<a href="javascript:void(0);" style="font-size:15px;" class="icon" onclick="myFunction()">   <i class="fa fa-bars"></i></a>

  </div>
<div class="bg_blue" style="width: 100%;height: auto;">
<!--===================== first li Estimates =====================-->
  <div class="dropdown">
    <button class="dropbtn"><i class="fa fa-bar-chart" aria-hidden="true"></i>&nbsp;<span> 見積</span>
      <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-content">
    <a class="" href="#" title=""><span> 見積入力</span></a>

    </div>
  </div>
     <!--=====================1st li end =====================-->
        <!--===================== 2nd li Orders =====================-->
  <div class="dropdown">
    <button class="dropbtn"> <i class="fa fa-cubes" aria-hidden="true"></i>&nbsp; <span>受注</span>
      <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-content">


  <div class="row">
   <div class="col-6">


    <a class=""href="{{url('/orderentry')}}" title=""><span> 受注入力(PB)・受注票</span></a>
          <a href="{{url('/orderinquery')}}" title=""><span>受注照会(PB)</span></a>
           <a href="{{url('/orderdata_capture')}}" title=""><span>受注データ取込</span></a>
           <a  href="" title=""><span>UIS出荷指示データ作成</span></a>


   </div>
  <div class="col-6">

       <a href="{{url('/sales_acceptance_process')}}" title=""><span>売上検収処理</span></a>
           <a href="" title=""><span>売上検収票</span></a>
           <a  href="#" title=""><span>受注案件別進捗状況照会</span></a>
          <a  href="#" title=""><span>パッケージ別受注照会</span></a>

   </div>
   </div>


    </div>
  </div>
     <!--===================== 2nd li end=====================-->
    <!--===================== 3rd li Agreement=====================-->
  <div class="dropdown">
    <button class="dropbtn">   <i class="fas fa-handshake" aria-hidden="true"></i>&nbsp;
                       <span class=" ">契約</span>
      <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-content">


  <div class="row">
   <div class="col-6">

    <a href="#"class="" title=""><span>定期定額契約データ作成 </span></a>
    <a href="#"  title=""><span>定期定額契約入力</span></a>
    <a href="#" title=""><span>定期定額契約照会</span></a>
    <a href="#" title=""><span>定期定額契約受注データ作成</span></a>

   </div>
  <div class="col-6">

        <a href="#" title=""><span>定期定額契約発注データ作成</span></a>
         <a href="#" title=""><span>定期定額契約担当変更処理</span></a>


   </div>
   </div>


    </div>
  </div>
           <!--=====================End of 3rd li Agreement=====================-->

     <!--===================== 4th li Sales Request =====================-->
  <div class="dropdown">
    <button class="dropbtn"><i class="fa fa-file-text-o" aria-hidden="true"></i>&nbsp;
                 <span class=" ">売上請求</span>
      <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-content">


  <div class="row">
   <div class="col-6">

    <a href="#" title=""><span>売上データ作成</span></a>
    <a href="#" title=""><span>売上入力</span></a>
    <a href="#" title=""><span>納品書</span></a>
    <a href="#" title=""><span>売上照会</span></a>
    <a href="#" title=""><span>売上承認（営業・上司）</span></a>
    <a href="#" title=""><span>請求一覧表</span></a>

    <a href="#"class="cool-link" title=""><span>請求書</span></a>

   </div>
  <div class="col-6">

    <a href="#"  title=""><span>入金入力</span></a>
    <a href="#"  title=""><span>得意先元帳</span></a>
    <a href="#"  title=""><span>売上データ会計連携</span></a>
    <a href="#"  title=""><span>売上請求締め日更新</span></a>
    <a href="#"  title=""><span>組織変更処理</span></a>
    <a href="#" title=""><span>与信限度額確認表</span></a>


   </div>
   </div>


    </div>
  </div>
       <!--=====================End of 4th li Sales Request =====================-->


      <!--===================== 5th li Ordering =====================-->
  <div class="dropdown">
    <button class="dropbtn"><i class="fa fa-file-text-o" aria-hidden="true"></i>&nbsp;
                 <span class=" ">売上請求</span>
      <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-content">


  <div class="row">

  <div class="col-12">

        <a href="#" title=""><span>発注データ作成</span></a>
            <a href="#" title=""><span>発注入力</span></a>
            <a href="#" title=""><span>発注照会・発注書</span></a>
            <a href="#" title=""><span>発注承認（営業・上司）</span></a>
            <a href="#" title=""><span>サポート依頼データ作成</span></a>
            <a href="#" title=""><span>社内サポート依頼書</span></a>
            <a href="#" title=""><span>社内発注データ工数管理連携</span></a>


   </div>
   </div>


    </div>
  </div>

       <!--=====================End of 5th li Ordering =====================-->

 <!--=====================6th li Purchase =====================-->
     <div class="dropdown">
    <button class="dropbtn">  <i class="fa fa-money" aria-hidden="true"></i>&nbsp;
   <span class=" ">仕入</span>
      <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-content">


  <div class="row">

  <div class="col-12">

    <a href="#" title=""><span>仕入データ作成</span></a>
        <a href="#" title=""><span>仕入データ作成</span></a>
        <a href="#" title=""><span>仕入予定消込入力（購入入力）</span></a>
        <a href="#" ><span>仕入照会</span></a>
        <a href="#" title=""><span>仕入承認（営業・上司）</span></a>
        <a href="#" title=""><span>支払予定表</span></a>
        <a href="#"title=""><span>支払入力</span></a>
        <a href="#" title=""><span>仕入先元帳</span></a>

        <a href="#" title=""><span>仕入データ会計連携</span></a>


   </div>
   </div>


    </div>
  </div>
  <!--=====================End of 6th li Purchase =====================-->

  <!--=====================7th li budget =====================-->

     <div class="dropdown">
    <button class="dropbtn"> <i class="fa fa-jpy" aria-hidden="true"></i>&nbsp;
 <span class=" ">予算</span>
      <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-content">


  <div class="row">

  <div class="col-12">

        <a href="#" title=""><span>予算入力（受注・売上）</span></a>
        <a href="#" title=""><span>予算取込</span></a>


   </div>
   </div>


    </div>
  </div>

           <!--=====================End of 7th li budget =====================-->

                 <!--===================== 8th li Master =====================-->
                <div class="dropdown">
    <button class="dropbtn">
      <i class="fas fa-user-circle"></i>&nbsp; <span class=" ">マスタ</span>
      <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-content">


  <div class="row">

  <div class="col-6">

     <a href="#" title=""><span>会社マスタ </span></a>
      <a href="{{url('/office')}}" title=""><span>事業者マスタ</span></a>
      <a href="{{url('/personal')}}" title=""><span>担当者マスタ</span></a>
      <a href="{{url('/product')}}" title=""><span>商品マスタ</span></a>
      <a href="{{url('/employee')}}" title=""><span>社員マスタ</span></a>
      <a href="#" title=""><span>名称マスタ</span></a>
      <a href="#" title=""><span>組織マスタ</span></a>


   </div>

     <div class="col-6">

        <a href="#" title=""><span>郵便番号住所マスタ</span></a>

        <a href="#" title=""><span>ＳＥＱ番号付番マスタ</span></a>
        <a href="#" title="" ><span>売上請求先別与信管理マスタ</span></a>
        <a href="#" title=""><span>得意先別商品単価マスタ</span></a>
        <a href="#" title=""><span>商品サブマスタ</span></a>
        <a href="#" title=""><span>業種マスタ</span></a>


   </div>
   </div>


    </div>
  </div>
    <!--=====================End of 8th li Master =====================-->


    <!--===================== 9th li Sales management =====================-->

     <div class="dropdown">
    <button class="dropbtn"> <i class="fab fa-cc-mastercard"></i>&nbsp;
   <span class=" ">売上管理</span>
      <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-content">


  <div class="row">

  <div class="col-12">

     <a href="#"class="cool-link" title=""><span>全社売上実績表（予算・前年対比） </span></a>
        <a href="#" title=""><span>組織別売上実績表（予算・前年対比）</span></a>
        <a href="#" title=""><span>営業担当者別売上実績表（予算・前年対比）</span></a>

   </div>
   </div>


    </div>
  </div>
          <!--=====================End of 9th li Sales management =====================-->


               <!--===================== 10th li Support =====================-->

     <div class="dropdown">
    <button class="dropbtn"> <i class="fa fa-tasks" aria-hidden="true"></i>&nbsp;
                 <span class=" ">サポート</span>
      <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-content">


  <div class="row">

  <div class="col-12">

  <a href="#" title=""><span>内作調整入力 </span></a>
 <a href="#" title=""><span>作業指示書</span></a>

   </div>
   </div>


    </div>
  </div>
 <!--=====================End of 10th li Support =====================-->

<!--===================== 11th li Document storage =====================-->

     <div class="dropdown">
    <button class="dropbtn">   <i class="fa fa-folder-open" aria-hidden="true"></i>&nbsp;
               <span class=" ">書類保管</span>
      <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-content">


  <div class="row">

  <div class="col-12">

        <a href="#" title=""><span>書類保管（L-BOOK） </span></a>
                    <a href="#" title=""><span>売上伝票請求書検索</span></a>

   </div>
   </div>


    </div>
  </div>
                <!--=====================End of 11th li Document storage =====================-->
 <!--================== 12th li Customer information =================-->

      <div class="dropdown">
    <button class="dropbtn">    <i class="fa fa-users" aria-hidden="true"></i>&nbsp;
                   <span class=" ">顧客情報</span>
      <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-content">


  <div class="row">

  <div class="col-12">
   <a href="#" title=""><span>顧客情報登録（L-INFO) </span></a>

   </div>
   </div>


    </div>
  </div>
  <!--================== End of 12th li Customer information =================-->
  <!--================== 13th li System =================-->
      <div class="dropdown">
    <button class="dropbtn">    <i class="fa fa-cog" aria-hidden="true"></i>&nbsp;
                   <span class=" ">システム</span>
      <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-content">


  <div class="row">

  <div class="col-12">
 <a href="#" title=""><span>SQL文データ抽出 </span></a>

   </div>
   </div>


    </div>
  </div>

    <!--================== End of 13th li System =================-->
    <!--==================================14 li for log out==================================-->

  <a href="#about">  <i class="fas fa-sign-out-alt"></i>&nbsp;
              <span>ログアウト </span></a>
 <!--==================================end 14th li for log out==================================-->
  </div>
</div>

<script>
function myFunction() {
  var x = document.getElementById("top_navbar_hidden_res");
  if (x.className === "topnav") {
    x.className += " responsive";
  } else {
    x.className = "topnav";
  }
}
</script>
<!-- <nav class="navbar">
        <span class="navbar-toggle" id="js-navbar-toggle">
            <i class="fas fa-bars"></i>
        </span>
        <a href="#" class="logo">logo</a>
        <ul class="main-nav" id="js-menu">
            <li>
                <a href="#" class="nav-links">Home</a>
            </li>
            <li>
                <a href="#" class="nav-links">Products</a>
            </li>
            <li>
                <a href="#" class="nav-links">About Us</a>
            </li>
            <li>
                <a href="#" class="nav-links">Contact Us</a>
            </li>
            <li>
                <a href="#" class="nav-links">Blog</a>
            </li>
        </ul>
    </nav> -->
<div class="margin_b header_area22">



            <div class="row " style="width: 100% ;font-size:16px;margin: 0;">


                <section class="" style="width: 100%; ">
                    <div id="cssmenu" class="">
                        <div class="row header_area22 ">
                            <div class="col-md-2 col-xs-12">
                                <div href="#" class="mt-3 ">
                                  <a href="{{url('/click')}}" style="color: white; text-decoration: none;">
                                    ユーザックシステム株式会社
                                      </a>
                                </div>
                            </div>
                            <div class="col-md-10 col-xs-12">

                              <div class="ml-5_res">
                                <ul class="backgroundul_menu ">

                                  <!--===================== first li Estimates =====================-->

                                  <li class="first_li cool-link  ">

                                    <a type="button" href="index.html" class="font_color m_0 ">
                                      <div class="">
           <i class="fa fa-bar-chart" aria-hidden="true"></i>&nbsp;
                                       <span>見積</span>


                                     </div>
                                   </a>
                                   <ul class="ul_left22">
                                    <div class="widthli">
                                   </a>
                                      <div class="row menu_hover_pad" style="background-color: #29487d;">
                                        <div class="col-md-12" style="background-color:#29487d;">
                                          <a  href="#" title=""><span> 見積入力</span></a>


                                        </div>
                                      </div>
                                    </div>
                                  </ul>

                                </li>
                      <!--=====================1st li end =====================-->


                <!--===================== 2nd li Orders =====================-->

                <li class="first_li cool-link  ">

                    <a type="button" href="#" class="font_color m_0 ">
                        <div class="">
      <i class="fa fa-cubes" aria-hidden="true"></i>&nbsp;
                         <span>受注</span>

                        </div>
                    </a>
                     <ul class="ul_left22">
                        <div class="widthli">
                            <div class="row menu_hover_pad" style="background-color: #29487d;">
                                <div class="col-md-12" style="background-color: #29487d;">
                                    <a href="{{url('/orderentry')}}" title=""><span> 受注入力(PB)・受注票</span></a>
                                     <a  href="{{url('/orderinquery')}}" title=""><span>受注照会(PB)</span></a>
                                     <a  href="{{url('/orderdata_capture')}}" title=""><span>受注データ取込</span></a>
                                    <a  href="" title=""><span>UIS出荷指示データ作成</span></a>
                                    <a href="{{url('/sales_acceptance_process')}}" title=""><span>売上検収処理</span></a>
                                        <a href="" title=""><span>売上検収票</span></a>
                                          <a  href="#" title=""><span>受注案件別進捗状況照会</span></a>
                                             <a  href="#" title=""><span>パッケージ別受注照会</span></a>


                                </div>
                            </div>
                        </div>
                    </ul>


                   </li>
                   <!--===================== 2nd li end=====================-->


                     <!--===================== 3rd li Agreement=====================-->
                     <li class=" secound_li cool-link "><a href="#" class="font_color m_0 ">

                 <i class="fas fa-handshake" aria-hidden="true"></i>&nbsp;
                       <span class=" ">契約</span>

                     </a>
                     <ul class="ul_left22">
                      <div class="widthli" style="width:181px;">
                        <div class="row menu_hover_pad" style="background-color: #29487d;">
                          <div class="col-md-12" style="background-color: #29487d;">
                            <a href="#" title=""><span>定期定額契約データ作成 </span></a>
                            <a href="#"  title=""><span>定期定額契約入力</span></a>
                            <a href="#" title=""><span>定期定額契約照会</span></a>
                            <a href="#" title=""><span>定期定額契約受注データ作成</span></a>
                            <a href="#" title=""><span>定期定額契約発注データ作成</span></a>
                            <a href="#" title=""><span>定期定額契約担当変更処理</span></a>

                          </div>
                        </div>
                      </div>
                    </ul>
                  </li>
            <!--=====================End of 3rd li Agreement=====================-->


          <!--===================== 4th li Sales Request =====================-->
                <li class=" secound_li cool-link "><a href="#" class="font_color m_0 ">
                <i class="fa fa-file-text-o" aria-hidden="true"></i>&nbsp;
                 <span class=" ">売上請求</span>

               </a>
               <ul class="ul_left22">
                <div class="widthli" style="width:308px;">
                  <div class="row menu_hover_pad" style="background-color: #29487d;">
                    <div class="col-md-6" style="background-color: #29487d;">
                      <a href="#" title=""><span>売上データ作成</span></a>
                      <a href="#" title=""><span>売上入力</span></a>
                      <a href="#" title=""><span>納品書</span></a>
                      <a href="#" title=""><span>売上照会</span></a>
                      <a href="#" title=""><span>売上承認（営業・上司）</span></a>
                      <a href="#" title=""><span>請求一覧表</span></a>

                      <a href="#" title=""><span>請求書</span></a>

                    </div>
                       <div class="col-md-6" style="background-color: #29487d;">
                      <a href="#"  title=""><span>入金入力</span></a>
                      <a href="#"  title=""><span>得意先元帳</span></a>
                      <a href="#"  title=""><span>売上データ会計連携</span></a>
                      <a href="#"  title=""><span>売上請求締め日更新</span></a>
                      <a href="#"  title=""><span>組織変更処理</span></a>
                      <a href="#" title=""><span>与信限度額確認表</span></a>



                    </div>
                  </div>
                </div>
              </ul>
            </li>

             <!--=====================End of 4th li Sales Request =====================-->


      <!--===================== 5th li Ordering =====================-->
     <li class=" secound_li cool-link "><a href="#" class="font_color m_0 ">
        <i class="fa fa-truck" aria-hidden="true"></i>&nbsp;

       <span class=" ">発注</span>

     </a>
     <ul class="ul_left22">
      <div class="widthli">
        <div class="row menu_hover_pad" style="background-color: #29487d;">
          <div class="col-md-12" style="background-color: #29487d;">
            <a href="#" title=""><span>発注データ作成</span></a>
            <a href="#" title=""><span>発注入力</span></a>
            <a href="#" title=""><span>発注照会・発注書</span></a>
            <a href="#" title=""><span>発注承認（営業・上司）</span></a>
            <a href="#" title=""><span>サポート依頼データ作成</span></a>
            <a href="#" title=""><span>社内サポート依頼書</span></a>
            <a href="#" title=""><span>社内発注データ工数管理連携</span></a>
          </div>
        </div>
      </div>
    </ul>
  </li>

 <!--=====================End of 5th li Ordering =====================-->


 <!--=====================6th li Purchase =====================-->
 <li class=" secound_li cool-link "><a href="#" class="font_color m_0 ">

  <i class="fa fa-money" aria-hidden="true"></i>&nbsp;
   <span class=" ">仕入</span>

 </a>
 <ul class="ul_left22">
  <div class="widthli" style="width:191px;">
    <div class="row menu_hover_pad" style="background-color: #29487d;">
      <div class="col-md-12" style="background-color: #29487d;">
        <a href="#" title=""><span>仕入データ作成</span></a>
        <a href="#" title=""><span>仕入データ作成</span></a>
        <a href="#" title=""><span>仕入予定消込入力（購入入力）</span></a>
        <a href="#" ><span>仕入照会</span></a>
        <a href="#" title=""><span>仕入承認（営業・上司）</span></a>
        <a href="#"title=""><span>支払予定表</span></a>
        <a href="#" title=""><span>支払入力</span></a>
        <a href="#" title=""><span>仕入先元帳</span></a>

        <a href="#" title=""><span>仕入データ会計連携</span></a>

       </div>
      </div>
     </div>
    </ul>
  </li>

  <!--=====================End of 6th li Purchase =====================-->


<!--=====================7th li budget =====================-->

<li class=" secound_li cool-link "><a href="#" class="font_color m_0 ">

<i class="fa fa-jpy" aria-hidden="true"></i>&nbsp;
 <span class=" ">予算</span>

</a>
<ul class="ul_left22">
  <div class="widthli">
    <div class="row menu_hover_pad" style="background-color: #29487d;">
      <div class="col-md-12" style="background-color: #29487d;">
        <a href="#" title=""><span>予算入力（受注・売上）</span></a>
        <a href="#" title=""><span>予算取込</span></a>

     </div>
    </div>
  </div>
</ul>
</li>

         <!--=====================End of 7th li budget =====================-->



                 <!--===================== 8th li Master =====================-->

                 <li class=" secound_li cool-link "><a href="#" class="font_color m_0 ">

                        <i class="fas fa-user-circle"></i>&nbsp;
                   <span class=" ">マスタ</span>

                 </a>
                 <ul class="ul_left22">
                  <div class="widthli"style="width:310px;">
                    <div class="row menu_hover_pad" style="background-color: #29487d;">
                      <div class="col-md-5" style="background-color: #29487d;">
                        <a href="#" title=""><span>会社マスタ </span></a>
                        <a href="{{url('/office')}}" title=""><span>事業者マスタ</span></a>
                        <a href="{{url('/personal')}}" title=""><span>担当者マスタ</span></a>
                        <a href="{{url('/product')}}" title=""><span>商品マスタ</span></a>
                        <a href="{{url('/employee')}}" title=""><span>社員マスタ</span></a>
                        <a href="#" title=""><span>名称マスタ</span></a>
                        <a href="#" title=""><span>組織マスタ</span></a>
                      </div>
                         <div class="col-md-7" style="background-color: #29487d;">
                        <a href="#" title=""><span>郵便番号住所マスタ</span></a>

                        <a href="#" title=""><span>ＳＥＱ番号付番マスタ</span></a>
                        <a href="{{url('/credit')}}" title="" ><span>売上請求先別与信管理マスタ</span></a>
                        <a href="#" title=""><span>得意先別商品単価マスタ</span></a>
                        <a href="#" title=""><span>商品サブマスタ</span></a>
                        <a href="#" title=""><span>業種マスタ</span></a>

                      </div>
                    </div>
                  </div>
                </ul>
              </li>


       <!--=====================End of 8th li Master =====================-->


    <!--===================== 9th li Sales management =====================-->

  <li class=" secound_li cool-link "><a href="#" class="font_color m_0 ">

 <i class="fab fa-cc-mastercard"></i>&nbsp;
   <span class=" ">売上管理</span>

 </a>
 <ul class="ul_left22">
  <div class="widthli" style="width:255px;">
    <div class="row menu_hover_pad" style="background-color: #29487d;">
      <div class="col-md-12" style="background-color: #29487d;">
        <a href="#" title=""><span>全社売上実績表（予算・前年対比） </span></a>
        <a href="#" title=""><span>組織別売上実績表（予算・前年対比）</span></a>
        <a href="#" title=""><span>営業担当者別売上実績表（予算・前年対比）</span></a>

      </div>
    </div>
  </div>
</ul>
</li>

       <!--=====================End of 9th li Sales management =====================-->


               <!--===================== 10th li Support =====================-->
               <li class=" secound_li cool-link "><a href="#" class="font_color m_0 ">

 <i class="fa fa-tasks" aria-hidden="true"></i>&nbsp;
                 <span class=" ">サポート</span>

               </a>
               <ul class="ul_left22">
                <div class="widthli">
                  <div class="row menu_hover_pad" style="background-color:#29487d">
                    <div class="col-md-12" style="background-color: #29487d">
                      <a href="#" title=""><span>内作調整入力 </span></a>
                      <a href="#" title=""><span>作業指示書</span></a>

                    </div>
                  </div>
                </div>
              </ul>
            </li>

       <!--=====================End of 10th li Support =====================-->



          <!--===================== 11th li Document storage =====================-->

             <li class=" secound_li cool-link "><a href="#" class="font_color m_0 ">

         <i class="fa fa-folder-open" aria-hidden="true"></i>&nbsp;
               <span class=" ">書類保管</span>

             </a>
             <ul class="ul_left22">
              <div class="widthli">
                <div class="row menu_hover_pad" style="background-color: #29487d;">
                  <div class="col-md-12" style="background-color: #29487d;">
                    <a href="#" title=""><span>書類保管（L-BOOK） </span></a>
                    <a href="#" title=""><span>売上伝票請求書検索</span></a>

                  </div>
                </div>
              </div>
            </ul>
          </li>

      <!--=====================End of 11th li Document storage =====================-->


              <!--================== 12th li Customer information =================-->

                  <li class=" secound_li cool-link "><a href="#" class="font_color m_0 ">

        <i class="fa fa-users" aria-hidden="true"></i>&nbsp;
                   <span class=" ">顧客情報</span>

                 </a>
                 <ul class="ul_left22">
                  <div class="widthli">
                    <div class="row menu_hover_pad" style="background-color: #29487d;">
                      <div class="col-md-12" style="background-color: #29487d;">
                        <a href="#" title=""><span>顧客情報登録（L-INFO) </span></a>
                      </div>
                    </div>
                  </div>
                </ul>
              </li>

       <!--==================End of 12th li Customer information =================-->


                <!--================== 13th li System =================-->

                  <li class=" secound_li cool-link "><a href="#" class="font_color m_0 ">

       <i class="fa fa-cog" aria-hidden="true"></i>&nbsp;
                   <span class=" ">システム</span>

                 </a>
                 <ul class="ul_left22">
                  <div class="widthli">
                    <div class="row menu_hover_pad" style="background-color:#29487d;">
                      <div class="col-md-12" style="background-color:#29487d;  ">
                        <a class="" href="#" title=""style=""><span>SQL文データ抽出 </span></a>
                      </div>
                    </div>
                  </div>
                </ul>
              </li>
                  <!--========================End of 13th li System ========================-->


            <!--==================================14 li for log out==================================-->
            <li class="last fifth_li"><a href="#" class="font_color m_0 ">
    <i class="fas fa-sign-out-alt"></i>&nbsp;
              <span>ログアウト </span>

            </a>

          </li>


      <!--==================================end 14th li for log out==================================-->
                                </ul>
                              </div>
                            </div>

                        </div>
                        <!--==================================col end==================================-->
                    </div>
                </section>
            </div>
        </div>

<!-- navbar ends here -->









            <!--/.navbar-->
    <!-- partial -->


        <script src="{{ asset('js/jquery-3.4.1.min.js') }}"></script>
    <!--Bootstrap 4.x-->
    <script src="  {{ asset('js/bootstrap.min.js') }}"></script>

    <!--Jquery Map for mac operating system-->
    <script src=" {{ asset('js/select2.min.js') }}"></script>


</body>
</html>
