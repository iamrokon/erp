<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="msapplication-tap-highlight" content="no">
    <title></title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}">
    <link href="https://use.fontawesome.com/releases/v5.0.4/css/all.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/test_nav_new_styles.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/test_navbar_styles.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/login_styles.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/test_modal_styles.css') }}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.2.6/jquery.min.js"></script>
    <!--[if lt IE 9]>
    <script>
    document.createElement('bg_blue');
    document.createElement('dropdown-content');
    </script>
    <![endif]-->
    <style type="text/css">
        .rotate {
            -moz-transition: all 2s linear;
            -webkit-transition: all 2s linear;
            transition: all 2s linear;
        }

        .rotate.down {
            -moz-transform: rotate(180deg);
            -webkit-transform: rotate(180deg);
            transform: rotate(180deg);
        }

        /*.hide {
    display: none;
    }
    */
        .colorChange {
            color: #F4D10F !important;
        }

        .colorChange span {
            color: #F4D10F !important;
        }

        .hideIcon {
            display: none;
        }

        .showIcon {
            display: block;
        }

        .custom-menu-sidebar.mega-menu ul li a:hover {
            opacity: 1;
        }

        /*.custom-menu-sidebar.mega-menu ul li span{
        color: #fff !important;
     }*/
        .megamenu_li .change-icon {
            margin: 8px 6px;
            font-size: 12px;
            color: #444;
            transition: all 0.5s 0.25s;
            transform: rotate(0);
        }

        .megamenu_li.colorChange .change-icon {
            transform: rotate(135deg) !important;
            color: #ff9900 !important;
        }

        .overlay {
            position: relative;
        }

        .overlay:before {
            position: fixed;
            left: 0;
            right: 0;
            top: 0;
            bottom: 0;
            width: 100% !important;
            height: 100% !important;
            background: rgba(0, 0, 0, .5);
            z-index: 99;
            content: '';
            display: none;
        }

        .show:before {
            display: block;
        }

        .custom-menu-sidebar ul li a {
            color: #fff;
            border-bottom: 1px solid transparent;

            border-radius: 5px;
        }

        .custom-menu-sidebar ul.stander li a {
            padding: 7px 15px;
            background: #1e4d9b;
        }

        .custom-menu-sidebar .mega-menu {
            box-shadow: none;
        }

        /*.custom-menu-sidebar ul.stander li.inner a {
        padding: 3px 15px;
        background: #2C66B0;
        }*/
        /*.custom-menu-sidebar .megamenu_li a {
        background: #2C66B0;
        }*/
        .custom-menu-sidebar .megamenu_li .change-icon {
            color: #fff;
        }

        .custom-menu-sidebar ul.stander li div a:hover {
            background: #fff;

        }

        .custom-menu-sidebar ul.stander li div a {
            background: #2c66b0;
            /* border-bottom: 1px solid #1e4f9c;*/
            border-top: 1px solid #1e4f9c;

            /* margin-top: 5px;
          margin-bottom: 5px;*/
        }

        .custom-menu-sidebar ul.stander li div a {
            padding: 3px 15px;
        }

        .custom-menu-sidebar ul.stander li a {

            /* border-bottom: 1px solid #1e4f9c;*/
        }

        .custom-menu-sidebar ul.stander li a.logout {

            background: #2C66B0;
        }

        .megamenu_li.colorChange {
            background: #2c66b0 !important;
        }

        .custom-menu-sidebar .col-md-3 {
            -webkit-box-flex: 0;
            -webkit-flex: 0 0 25%;
            -ms-flex: 0 0 25%;
            flex: 0 0 100%;
            max-width: 100%;
            padding-left: 0px;
            padding-right: 0px;

        }

        a.avatar {
            margin-right: 5px;
        }

        /*.custom-menu-sidebar .cool-link-nav1-1::after{

        }*/
        /*.custom-menu-sidebar .cool-link-nav1-1:hover::after {
          width: 0;
        }*/
        /*.custom-menu-sidebar.mega-menu {
          /* width: 900px; */
        width: 250px;
        height: 100vh;
        background: #2C66B0;
        max-height: 100vh;
        }

        */ @media (min-width: 768px) {}

        @media (min-width: 1050px) {
            /*.custom-menu-sidebar.mega-menu {
           width: 900px;
          width: 300px;
          height: 100vh;
          background: #2C66B0;
          max-height: 100vh;
          }*/
        }
    </style>
</head>

<body>
    <script type="text/javascript">
        //<![CDATA[
    $(window).load(function () {
      $("#add_icon").click(function (e) {
        $("#mega_menu_container").show();
        e.stopPropagation();
      });
      $("#mega_menu_container").click(function (e) {
        e.stopPropagation();
      });
      $(document).click(function () {
        $("#mega_menu_container").hide();
        $("#add_icon").show();
        $("#sub_icon").hide();
        $("#hover_submenu1").hide();
        $(".megamenu_li").removeClass("colorChange");
        $("body").removeClass("overlay show");
        // $("#megamenu_li").toggleClass("colorChange");
        $(".megamenu_li").find('i').toggleClass("fa fa-plus fa fa-minus");
        $(".megamenu_li").find('i').removeClass('fa fa-minus').addClass(' fa fa-plus');
      });
      $(document).click(function () {
        $("#mega_menu_container").hide();
        $("#add_icon").show();
        $("#sub_icon").hide();
        $("#hover_submenu2").hide();
        $("#megamenu_li2").removeClass("colorChange");
        // $("#megamenu_li").toggleClass("colorChange");
        $("#megamenu_li2").find('i').toggleClass("fa fa-plus fa fa-minus");
        $("#megamenu_li2").find('i').removeClass('fa fa-minus').addClass(' fa fa-plus');
      });
      $(document).click(function () {
        $("#mega_menu_container").hide();
        $("#add_icon").show();
        $("#sub_icon").hide();
        $("#hover_submenu3").hide();
        $("#megamenu_li3").removeClass("colorChange");
        // $("#megamenu_li").toggleClass("colorChange");
        $("#megamenu_li3").find('i').toggleClass("fa fa-plus fa fa-minus");
        $("#megamenu_li3").find('i').removeClass('fa fa-minus').addClass(' fa fa-plus');
      });
      $(document).click(function () {
        $("#mega_menu_container").hide();
        $("#add_icon").show();
        $("#sub_icon").hide();
        $("#hover_submenu4").hide();
        $("#megamenu_li4").removeClass("colorChange");
        // $("#megamenu_li").toggleClass("colorChange");
        $("#megamenu_li4").find('i').toggleClass("fa fa-plus fa fa-minus");
        $("#megamenu_li4").find('i').removeClass('fa fa-minus').addClass(' fa fa-plus');
      });
      $(document).click(function () {
        $("#mega_menu_container").hide();
        $("#add_icon").show();
        $("#sub_icon").hide();
        $("#hover_submenu5").hide();
        $("#megamenu_li5").removeClass("colorChange");
        // $("#megamenu_li").toggleClass("colorChange");
        $("#megamenu_li5").find('i').toggleClass("fa fa-plus fa fa-minus");
        $("#megamenu_li5").find('i').removeClass('fa fa-minus').addClass(' fa fa-plus');
      });
      $(document).click(function () {
        $("#mega_menu_container").hide();
        $("#add_icon").show();
        $("#sub_icon").hide();
        $("#hover_submenu6").hide();
        $("#megamenu_li6").removeClass("colorChange");
        // $("#megamenu_li").toggleClass("colorChange");
        $("#megamenu_li6").find('i').toggleClass("fa fa-plus fa fa-minus");
        $("#megamenu_li6").find('i').removeClass('fa fa-minus').addClass(' fa fa-plus');
      });
      $(document).click(function () {
        $("#mega_menu_container").hide();
        $("#add_icon").show();
        $("#sub_icon").hide();
        $("#hover_submenu7").hide();
        $("#megamenu_li7").removeClass("colorChange");
        // $("#megamenu_li").toggleClass("colorChange");
        $("#megamenu_li7").find('i').toggleClass("fa fa-plus fa fa-minus");
        $("#megamenu_li7").find('i').removeClass('fa fa-minus').addClass(' fa fa-plus');
      });
      $(document).click(function () {
        $("#mega_menu_container").hide();
        $("#add_icon").show();
        $("#sub_icon").hide();
        $("#hover_submenu8").hide();
        $("#megamenu_li8").removeClass("colorChange");
        // $("#megamenu_li").toggleClass("colorChange");
        $("#megamenu_li8").find('i').toggleClass("fa fa-plus fa fa-minus");
        $("#megamenu_li8").find('i').removeClass('fa fa-minus').addClass(' fa fa-plus');
      });
      $(document).click(function () {
        $("#mega_menu_container").hide();
        $("#add_icon").show();
        $("#sub_icon").hide();
        $("#hover_submenu9").hide();
        $("#megamenu_li9").removeClass("colorChange");
        // $("#megamenu_li").toggleClass("colorChange");
        $("#megamenu_li9").find('i').toggleClass("fa fa-plus fa fa-minus");
        $("#megamenu_li9").find('i').removeClass('fa fa-minus').addClass(' fa fa-plus');
      });
      $(document).click(function () {
        $("#mega_menu_container").hide();
        $("#add_icon").show();
        $("#sub_icon").hide();
        $("#hover_submenu10").hide();
        $("#megamenu_li10").removeClass("colorChange");
        // $("#megamenu_li").toggleClass("colorChange");
        $("#megamenu_li10").find('i').toggleClass("fa fa-plus fa fa-minus");
        $("#megamenu_li10").find('i').removeClass('fa fa-minus').addClass(' fa fa-plus');
      });
      $(document).click(function () {
        $("#mega_menu_container").hide();
        $("#add_icon").show();
        $("#sub_icon").hide();
        $("#hover_submenu11").hide();
        $("#megamenu_li11").removeClass("colorChange");
        // $("#megamenu_li").toggleClass("colorChange");
        $("#megamenu_li11").find('i').toggleClass("fa fa-plus fa fa-minus");
        $("#megamenu_li11").find('i').removeClass('fa fa-minus').addClass(' fa fa-plus');
      });
      $(document).click(function () {
        $("#mega_menu_container").hide();
        $("#add_icon").show();
        $("#sub_icon").hide();
        $("#hover_submenu12").hide();
        $("#megamenu_li12").removeClass("colorChange");
        // $("#megamenu_li").toggleClass("colorChange");
        $("#megamenu_li12").find('i').toggleClass("fa fa-plus fa fa-minus");
        $("#megamenu_li12").find('i').removeClass('fa fa-minus').addClass(' fa fa-plus');
      });
      $(document).click(function () {
        $("#mega_menu_container").hide();
        $("#add_icon").show();
        $("#sub_icon").hide();
        $("#hover_submenu14").hide();
        $("#megamenu_li14").removeClass("colorChange");
        // $("#megamenu_li").toggleClass("colorChange");
        $("#megamenu_li14").find('i').toggleClass("fa fa-plus fa fa-minus");
        $("#megamenu_li14").find('i').removeClass('fa fa-minus').addClass(' fa fa-plus');
      });
      $(document).click(function () {
        $("#mega_menu_container").hide();
        $("#add_icon").show();
        $("#sub_icon").hide();
        $("#hover_submenu13").hide();
        $("#megamenu_li13").removeClass("colorChange");
        // $("#megamenu_li").toggleClass("colorChange");
        $("#megamenu_li13").find('i').toggleClass("fa fa-plus fa fa-minus");
        $("#megamenu_li13").find('i').removeClass('fa fa-minus').addClass(' fa fa-plus');
      });
      // end click section
    });
    </script>
    <script type="text/javascript">
        $(".fa-times").click(function () {
      $(this).toggleClass("rotate");
    })
    </script>
    <script type="text/javascript">
        // $(document).ready(function(){
    // $("button").click(function(){
    //         $(".mega-menu").show();
    //     });
    //    $("body").click(function(event) {
    //    if($(event.target).attr('class') != '1' && $(event.target).attr('class') != 'mega-menu'){
    //        $(".mega-menu").hide(1000);}
    //     });
    // });
    function showMenu() {
      //document.getElementById('add_icon').style.display = 'none';
      $('#add_icon').fadeOut(function () {
        $(this).css({
          // transition: ".3s",
          display: "none",
          // transform: "rotate(0deg)"
        });
      });
      $('#sub_icon').fadeIn(function () {
        $(this).css({
          // transition: ".3s",
          display: "block",
          // transform: "rotate(360deg)"
        });
      });
      document.getElementById('mega_menu_container').style.display = 'block';
      //document.getElementById('sub_icon').style.display = 'block';
      // document.getElementById('megamenu_li').style.color = "black";
    }
    function hideMenu() {
      var removeColor = document.getElementById("megamenu_li");
      removeColor.classList.remove("colorChange");
      $('#add_icon').fadeIn("", function () {
        $(this).css({
          // transition: ".3s",
          display: "block",
          // transform: "rotate(360deg)"
        });
      });
      $('#sub_icon').fadeOut(function () {
        $(this).css({
          // transition: ".3s",
          display: "none",
          // transform: "rotate(0deg)"
        });
      });
      //document.getElementById('add_icon').style.display = 'block';
      document.getElementById('mega_menu_container').style.display = 'none';
      //document.getElementById('sub_icon').style.display = 'none';
      // hiding data by clicking cross icon
      document.getElementById('hover_submenu1').style.display = 'none';
      document.getElementById('megamenu_li').style.color = "black !important";
      //document.getElementById("c_2").style.color = "black";
      document.getElementById('sub_icon_sub2').style.display = 'none';
      document.getElementById('add_icon_sub2').style.display = 'block';
      document.getElementById('hover_submenu2').style.display = 'none';
      //document.getElementById("c_3").style.color = "black";
      document.getElementById('sub_icon_sub3').style.display = 'none';
      document.getElementById('add_icon_sub3').style.display = 'block';
      document.getElementById('hover_submenu3').style.display = 'none';
      //document.getElementById("c_4").style.color = "black";
      document.getElementById('sub_icon_sub4').style.display = 'none';
      document.getElementById('add_icon_sub4').style.display = 'block';
      document.getElementById('hover_submenu4').style.display = 'none';
      //document.getElementById("c_5").style.color = "black";
      document.getElementById('sub_icon_sub5').style.display = 'none';
      document.getElementById('add_icon_sub5').style.display = 'block';
      document.getElementById('hover_submenu5').style.display = 'none';
      //document.getElementById("c_6").style.color = "black";
      document.getElementById('sub_icon_sub6').style.display = 'none';
      document.getElementById('add_icon_sub6').style.display = 'block';
      document.getElementById('hover_submenu6').style.display = 'none';
      //document.getElementById("c_7").style.color = "black";
      document.getElementById('sub_icon_sub7').style.display = 'none';
      document.getElementById('add_icon_sub7').style.display = 'block';
      document.getElementById('hover_submenu7').style.display = 'none';
      //document.getElementById("c_8").style.color = "black";
      document.getElementById('sub_icon_sub8').style.display = 'none';
      document.getElementById('add_icon_sub8').style.display = 'block';
      document.getElementById('hover_submenu8').style.display = 'none';
      //document.getElementById("c_9").style.color = "black";
      document.getElementById('sub_icon_sub9').style.display = 'none';
      document.getElementById('add_icon_sub9').style.display = 'block';
      document.getElementById('hover_submenu9').style.display = 'none';
      //document.getElementById("c_10").style.color = "black";
      document.getElementById('sub_icon_sub10').style.display = 'none';
      document.getElementById('add_icon_sub10').style.display = 'block';
      document.getElementById('hover_submenu10').style.display = 'none';
      //document.getElementById("c_11").style.color = "black";
      document.getElementById('sub_icon_sub11').style.display = 'none';
      document.getElementById('add_icon_sub11').style.display = 'block';
      document.getElementById('hover_submenu11').style.display = 'none';
      //document.getElementById("c_12").style.color = "black";
      document.getElementById('sub_icon_sub12').style.display = 'none';
      document.getElementById('add_icon_sub12').style.display = 'block';
      document.getElementById('hover_submenu12').style.display = 'none';
      //document.getElementById("c_13").style.color = "black";
      document.getElementById('sub_icon_sub13').style.display = 'none';
      document.getElementById('add_icon_sub13').style.display = 'block';
      document.getElementById('hover_submenu13').style.display = 'none';
    }
    // show submenu functions
    //     function showSubMenu1(){
    //  document.getElementById('add_icon_sub1').style.display = 'none';
    //        document.getElementById("c_1").style.color = "#ff9900";
    //    document.getElementById('hover_submenu1').style.display = 'block';
    //    document.getElementById('sub_icon_sub1').style.display = 'block';
    //  }
    //    function hideSubMenu1(){
    //   document.getElementById('add_icon_sub1').style.display = 'block';
    //         document.getElementById("c_1").style.color = "black";
    //    document.getElementById('hover_submenu1').style.display = 'none';
    //    document.getElementById('sub_icon_sub1').style.display = 'none';
    //  }
    //    function showSubMenu2(){
    //  document.getElementById('add_icon_sub2').style.display = 'none';
    //       document.getElementById("c_2").style.color = "#ff9900";
    //   document.getElementById('hover_submenu2').style.display = 'block';
    //   document.getElementById('sub_icon_sub2').style.display = 'block';
    // }
    //    function hideSubMenu2(){
    //  document.getElementById('add_icon_sub2').style.display = 'block';
    //     document.getElementById("c_2").style.color = "black";
    //   document.getElementById('hover_submenu2').style.display = 'none';
    //   document.getElementById('sub_icon_sub2').style.display = 'none';
    // }
    // // new function
    //    function showSubMenu3(){
    //  document.getElementById('add_icon_sub3').style.display = 'none';
    //    document.getElementById("c_3").style.color = "#ff9900";
    //   document.getElementById('hover_submenu3').style.display = 'block';
    //   document.getElementById('sub_icon_sub3').style.display = 'block';
    // }
    //    function hideSubMenu3(){
    //  document.getElementById('add_icon_sub3').style.display = 'block';
    //     document.getElementById("c_3").style.color = "black";
    //   document.getElementById('hover_submenu3').style.display = 'none';
    //   document.getElementById('sub_icon_sub3').style.display = 'none';
    // }
    //    function showSubMenu4(){
    //  document.getElementById('add_icon_sub4').style.display = 'none';
    //    document.getElementById("c_4").style.color = "#ff9900";
    //   document.getElementById('hover_submenu4').style.display = 'block';
    //   document.getElementById('sub_icon_sub4').style.display = 'block';
    // }
    //    function hideSubMenu4(){
    //  document.getElementById('add_icon_sub4').style.display = 'block';
    //       document.getElementById("c_4").style.color = "black";
    //   document.getElementById('hover_submenu4').style.display = 'none';
    //   document.getElementById('sub_icon_sub4').style.display = 'none';
    // }
    //    function showSubMenu5(){
    //  document.getElementById('add_icon_sub5').style.display = 'none';
    //       document.getElementById("c_5").style.color = "#ff9900";
    //   document.getElementById('hover_submenu5').style.display = 'block';
    //   document.getElementById('sub_icon_sub5').style.display = 'block';
    // }
    //    function hideSubMenu5(){
    //  document.getElementById('add_icon_sub5').style.display = 'block';
    //          document.getElementById("c_5").style.color = "black";
    //   document.getElementById('hover_submenu5').style.display = 'none';
    //   document.getElementById('sub_icon_sub5').style.display = 'none';
    // }
    //  function showSubMenu6(){
    //  document.getElementById('add_icon_sub6').style.display = 'none';
    //       document.getElementById("c_6").style.color = "#ff9900";
    //   document.getElementById('hover_submenu6').style.display = 'block';
    //   document.getElementById('sub_icon_sub6').style.display = 'block';
    // }
    //    function hideSubMenu6(){
    //  document.getElementById('add_icon_sub6').style.display = 'block';
    //          document.getElementById("c_6").style.color = "black";
    //   document.getElementById('hover_submenu6').style.display = 'none';
    //   document.getElementById('sub_icon_sub6').style.display = 'none';
    // }
    //  function showSubMenu7(){
    //  document.getElementById('add_icon_sub7').style.display = 'none';
    //       document.getElementById("c_7").style.color = "#ff9900";
    //   document.getElementById('hover_submenu7').style.display = 'block';
    //   document.getElementById('sub_icon_sub7').style.display = 'block';
    // }
    //    function hideSubMenu7(){
    //  document.getElementById('add_icon_sub7').style.display = 'block';
    //          document.getElementById("c_7").style.color = "black";
    //   document.getElementById('hover_submenu7').style.display = 'none';
    //   document.getElementById('sub_icon_sub7').style.display = 'none';
    // }
    //  function showSubMenu8(){
    //  document.getElementById('add_icon_sub8').style.display = 'none';
    //       document.getElementById("c_8").style.color = "#ff9900";
    //   document.getElementById('hover_submenu8').style.display = 'block';
    //   document.getElementById('sub_icon_sub8').style.display = 'block';
    // }
    //    function hideSubMenu8(){
    //  document.getElementById('add_icon_sub8').style.display = 'block';
    //          document.getElementById("c_8").style.color = "black";
    //   document.getElementById('hover_submenu8').style.display = 'none';
    //   document.getElementById('sub_icon_sub8').style.display = 'none';
    // }
    //  function showSubMenu9(){
    //  document.getElementById('add_icon_sub9').style.display = 'none';
    //       document.getElementById("c_9").style.color = "#ff9900";
    //   document.getElementById('hover_submenu9').style.display = 'block';
    //   document.getElementById('sub_icon_sub9').style.display = 'block';
    // }
    //    function hideSubMenu9(){
    //  document.getElementById('add_icon_sub9').style.display = 'block';
    //          document.getElementById("c_9").style.color = "black";
    //   document.getElementById('hover_submenu9').style.display = 'none';
    //   document.getElementById('sub_icon_sub9').style.display = 'none';
    // }
    //  function showSubMenu10(){
    //  document.getElementById('add_icon_sub10').style.display = 'none';
    //       document.getElementById("c_10").style.color = "#ff9900";
    //   document.getElementById('hover_submenu10').style.display = 'block';
    //   document.getElementById('sub_icon_sub10').style.display = 'block';
    // }
    //    function hideSubMenu10(){
    //  document.getElementById('add_icon_sub10').style.display = 'block';
    //          document.getElementById("c_10").style.color = "black";
    //   document.getElementById('hover_submenu10').style.display = 'none';
    //   document.getElementById('sub_icon_sub10').style.display = 'none';
    // }
    //  function showSubMenu11(){
    //  document.getElementById('add_icon_sub11').style.display = 'none';
    //       document.getElementById("c_11").style.color = "#ff9900";
    //   document.getElementById('hover_submenu11').style.display = 'block';
    //   document.getElementById('sub_icon_sub11').style.display = 'block';
    // }
    //    function hideSubMenu11(){
    //  document.getElementById('add_icon_sub11').style.display = 'block';
    //          document.getElementById("c_11").style.color = "black";
    //   document.getElementById('hover_submenu11').style.display = 'none';
    //   document.getElementById('sub_icon_sub11').style.display = 'none';
    // }
    //  function showSubMenu12(){
    //  document.getElementById('add_icon_sub12').style.display = 'none';
    //       document.getElementById("c_12").style.color = "#ff9900";
    //   document.getElementById('hover_submenu12').style.display = 'block';
    //   document.getElementById('sub_icon_sub12').style.display = 'block';
    // }
    //    function hideSubMenu12(){
    //  document.getElementById('add_icon_sub12').style.display = 'block';
    //          document.getElementById("c_12").style.color = "black";
    //   document.getElementById('hover_submenu12').style.display = 'none';
    //   document.getElementById('sub_icon_sub12').style.display = 'none';
    // }
    //  function showSubMenu13(){
    //  document.getElementById('add_icon_sub13').style.display = 'none';
    //       document.getElementById("c_13").style.color = "#ff9900";
    //   document.getElementById('hover_submenu13').style.display = 'block';
    //   document.getElementById('sub_icon_sub13').style.display = 'block';
    // }
    //    function hideSubMenu13(){
    //  document.getElementById('add_icon_sub13').style.display = 'block';
    //          document.getElementById("c_13").style.color = "black";
    //   document.getElementById('hover_submenu13').style.display = 'none';
    //   document.getElementById('sub_icon_sub13').style.display = 'none';
    // }
    </script>
    <header id="navigation" class="navbar-fixed-top animated-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 pr-0">
                    <div class="nav_left">
                        <div class="navbar-header">
                            <!-- /responsive nav button -->
                            <!-- logo -->
                            <h1 class="navbar-brand no-padding">
                                <span><a href="#"><img style="margin-top: 4px;" src="{{url('img')}}\test_logo.png"
                                            style="padding-top: 10px;" width="120" height="20" alt=""></a></span>
                                <!--  <span class="brand-text"><a href="{{url('/click')}}"></a></span> --><a href="#"
                                    class="mail-text" style="">
                                </a>
                            </h1>
                            <!-- /logo -->
                        </div>
                    </div>
                    <div class="nav_midd"><span class="display-span"></span> </div>
                    <!--           <div class="nav_midd"><span class="display-span">@yield('menu')</span>  </div> -->
                    <div class="nav_right">
                        <div class="mega_menu_content">
                            <ul class="exo-menu">
                                <!-- <li><a class="active" href="#"><i class="fa fa-home"></@yield('menu')i> Home</a></li> -->
                                <li class="mega-drop-down">
                                    <a class="avatar" href="#">
                                        <div data-toggle="modal" data-target="#employee_modal2" class="menu_div">
                                            <div class="hidd_wrap_m">
                                                <i class="fas fa-user-circle"
                                                    style="font-size: 20px;color: #14A0B1;"></i> ??????????????????
                                            </div>
                                        </div>
                                        <div class="icon_div"> <i id="add_icon" class="fa fa-bars  rotate"
                                                aria-hidden="true" onclick="showMenu();"
                                                style="float: right;margin-right: -1px;font-size: 18px;width: 100%;padding-top: 11px;margin-top: 2px;height: 100%;text-align: center;display: block;"></i>
                                            <i class="fa fa-close" aria-hidden="true" id="sub_icon"
                                                onclick="hideMenu();"
                                                style="   float: right;margin-right: -1px;font-size: 18px;width: 100%; padding: 10px 0;margin-top: 2px;height: 100%;text-align: center;display: none;"></i>
                                        </div>
                                    </a>
                                    <style>

                                    </style>
                                    <div class="animated fadeIn mega-menu custom-menu-sidebar" id="mega_menu_container"
                                        style="display: none;">
                                        <div class="mega-menu-wrap">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div style="padding: 5px 5px 0px;">
                                                        <ul class="stander">
                                                            <li>
                                                                <a id="megamenu_li" class="megamenu_li" href="#"
                                                                    style="color: #fff;">
                                                                    <i class="fa fa-bar-chart"
                                                                        aria-hidden="true"></i>&nbsp;??????
                                                                    <span>(????????????)</span>
                                                                    <span class="fa fa-plus change-icon"
                                                                        style="float: right;"></span>
                                                                    <!-- id="add_icon_sub1" -->
                                                                    <!-- <i class="fa fa-minus" id="sub_icon_sub1"  style="float: right; display: none;"></i> -->
                                                                </a>
                                                                <div id="hover_submenu1">
                                                                    <a href="#" class="cool-link-nav1-1">???????????? </a>
                                                                    <a href="#" class="cool-link-nav1-2">??????????????????????????? </a>
                                                                </div>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <!-- menu 1 end -->
                                                <!-- menu 2 -->
                                                <div class="col-md-3">
                                                    <div style="padding: 5px 5px 0px;">
                                                        <ul class="stander">
                                                            <li><a id="megamenu_li2" class="megamenu_li" href="#"> <i
                                                                        class="fa fa-cubes"
                                                                        aria-hidden="true"></i>&nbsp;
                                                                    ??????
                                                                    <span class="fa fa-plus change-icon"
                                                                        style="float: right;"></span>
                                                                    <!-- <i id="add_icon_sub2"class="fa fa-plus"  style="float: right;" ></i><i class="fa fa-minus" id="sub_icon_sub2"  style="float: right;display: none;"></i> -->
                                                                </a>
                                                                <div id="hover_submenu2">
                                                                    <a href="{{url('/order_entry')}}"
                                                                        class="cool-link-nav2-1">
                                                                        ????????????<span>(?????????)</span></a>
                                                                    <a href="{{url('/project_registration')}}"
                                                                        class="cool-link-nav2-2">????????????????????????
                                                                        <span>(??????)</span></a>
                                                                    <a href="{{url('/order_history_list')}}"
                                                                        class="cool-link-nav2-3">?????????????????????????????????<span>(??????)</span></a>
                                                                    <a href="{{url('/orderdata_capture')}}"
                                                                        class="cool-link-nav2-4">?????????????????????
                                                                        <span>(??????)</span></a>
                                                                    <a href="#"
                                                                        class="cool-link-nav2-5">UIS???????????????????????????<span>(????????????)</span></a>
                                                                    <a href="{{url('/salesacceptanceprocessing')}}"
                                                                        class="cool-link-nav2-6">??????????????????
                                                                        <span>(??????)</span></a>
                                                                    {{-- <a href="#" class="cool-link-nav2-7">?????????????????? <span>(?????????)</span></a> --}}
                                                                    {{-- <a href="{{url('/list_of_back_order')}}"
                                                                    class="cool-link-nav2-8">???????????????
                                                                    <span>(????????????)</span></a> --}}
                                                                    <a href="{{url('/list_of_back_order')}}"
                                                                        class="cool-link-nav2-10">?????????????????????
                                                                        <span>(??????)</span></a>
                                                                    {{-- <a href="{{url('/order_history_list')}}"
                                                                    class="cool-link-nav2-9">???????????????????????????
                                                                    <span>(?????????)</span></a> --}}
                                                                    <!-- </ul> -->
                                                                </div>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <!-- menu2 end -->
                                                <!-- menu3 start -->
                                                <div class="col-md-3">
                                                    <div style="padding: 5px 5px 0px;">
                                                        <ul class="stander">
                                                            <li><a id="megamenu_li3" class="megamenu_li" href="#">
                                                                    <i class="fa fa-handshake-o"
                                                                        aria-hidden="true"></i>&nbsp;
                                                                    ??????????????????
                                                                    <span class="fa fa-plus change-icon"
                                                                        style="float: right;"></span></a>
                                                                <div id="hover_submenu3">
                                                                    <a href="{{url('/enter_fixed_term_contract')}}"
                                                                        class="cool-link-nav3-1">????????????????????????
                                                                        <span>(??????)</span></a>
                                                                    <a href="{{url('/list_fixed_term_contracts')}}"
                                                                        class="cool-link-nav3-2">
                                                                        ????????????????????????<span>(??????)</span> </a>
                                                                    <a href="#"
                                                                        class="cool-link-nav3-3">???????????????????????????????????????<span>(????????????)</span></a>
                                                                    <a href="#"
                                                                        class="cool-link-nav3-4">????????????????????????????????????<span>(????????????)</span></a>
                                                                    <a href="#"
                                                                        class="cool-link-nav3-5">??????????????????UIS?????????????????????<span>(????????????)</span></a>
                                                                    <a href="#"
                                                                        class="cool-link-nav3-6">?????????????????????????????????<span>(????????????)</span></a>
                                                                    <a href="#"
                                                                        class="cool-link-nav3-7">???????????????<span>(????????????)</span></a>
                                                                    <a href="#"
                                                                        class="cool-link-nav3-8">??????????????????<span>(????????????)</span></a>
                                                                    <a href="#"
                                                                        class="cool-link-nav3-9">????????????????????????<span>(????????????)</span></a>
                                                                    <a href="#"
                                                                        class="cool-link-nav3-10">?????????????????????<span>(????????????)</span></a>
                                                                    {{-- <a href="{{url('/List_fixed-term_contracts')}}"
                                                                    class="cool-link-nav13">????????????????????????
                                                                    <span>(??????)</span> </a> --}}
                                                                    <!-- </ul> -->
                                                                </div>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <!-- menu3 end -->
                                                <!-- menu4 start -->
                                                <div class="col-md-3">
                                                    <div style="padding: 5px 5px 0px;">
                                                        <ul class="stander">
                                                            <li><a id="megamenu_li4" class="megamenu_li" href="#"><i
                                                                        class="fa fa-file-text-o"
                                                                        aria-hidden="true"></i>????????????
                                                                    <span class="fa fa-plus change-icon"
                                                                        style="float: right;"></span></a>
                                                                <div id="hover_submenu4">
                                                                    <!-- <ul> -->
                                                                    <!-- <li><a href="#"></a></li> -->
                                                                    <a href="#" class="cool-link-nav4-1">
                                                                        ??????????????????????????????<span>(????????????)</span></a>
                                                                    <a href="{{url('/sales_input')}}"
                                                                        class="cool-link-nav4-2">????????????<span>(?????????)</span></a>
                                                                    <a href="{{url('/delivery_note_issuance')}}"
                                                                        class="cool-link-nav4-3">???????????????
                                                                        <span>(??????)</span></a>
                                                                    <a href="#"
                                                                        class="cool-link-nav4-4">???????????????????????????????????????<span>(????????????)</span></a>
                                                                    <a href="{{url('/sales_history_list')}}"
                                                                        class="cool-link-nav4-5">?????????????????????????????????<span>(??????)</span></a>
                                                                    <a href="#"
                                                                        class="cool-link-nav4-6">?????????????????????<span>(????????????)</span></a>
                                                                    <a href="#"
                                                                        class="cool-link-nav4-7">???????????????????????????<span>(????????????)</span></a>
                                                                    <a href="#" class="cool-link-nav4-8">????????????
                                                                        <span>(????????????)</span></a>
                                                                    {{-- <a href="#" class="cool-link-nav4-8">????????????<span>(????????????)</span></a> --}}
                                                                    <a href="#"
                                                                        class="cool-link-nav4-9">????????????????????????<span>(????????????)</span></a>
                                                                    <a href="{{url('/billing_ledger')}}"
                                                                        class="cool-link-nav4-10">????????????<span>(??????)</span></a>
                                                                    <a href="#"
                                                                        class="cool-link-nav4-11">?????????????????????????????????<span>(????????????)</span></a>
                                                                    <a href="{{url('/deposit_input')}}"
                                                                        class="cool-link-nav4-12">????????????<span>(??????)</span></a>
                                                                    <a href="{{url('/payment_history_list_payment_inquiry')}}"
                                                                        class="cool-link-nav4-13">
                                                                        ?????????????????????????????????<span>(??????)</span></a>
                                                                    {{-- <a href="#" class="cool-link-nav18"> ?????????????????????<span>(????????????)</span></a> --}}
                                                                    <a href="{{url('/uncollected_list')}}"
                                                                        class="cool-link-nav4-14">???????????????<span>(????????????)</span></a>
                                                                    <a href="{{url('/customer_ledger')}}"
                                                                        class="cool-link-nav4-15">???????????????<span>(??????)</span></a>
                                                                    <a href="#"
                                                                        class="cool-link-nav4-16">??????????????????????????????<span>(????????????)</span></a>
                                                                    <a href="#"
                                                                        class="cool-link-nav4-17">???????????????????????????<span>(????????????)</span></a>
                                                                    <a href="#"
                                                                        class="cool-link-nav4-18">?????????????????????????????????<span>(????????????)</span></a>
                                                                    <a href="#"
                                                                        class="cool-link-nav4-19">??????????????????<span>(????????????)</span></a>
                                                                    <a href="#"
                                                                        class="cool-link-nav4-20">????????????????????????<span>(????????????)</span></a>
                                                                    <!-- </ul> -->
                                                                </div>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <!-- menu4 end -->
                                            </div>
                                            <!-- 2nd row menu start new  -->
                                            <div class="row">
                                                <!-- menu5 start -->
                                                <div class="col-md-3">
                                                    <div style="padding: 5px 5px 0px;">
                                                        <ul class="stander">
                                                            <li><a id="megamenu_li5" class="megamenu_li" href="#"><i
                                                                        class="fa fa-truck"
                                                                        aria-hidden="true"></i>??????<span>(????????????)</span>
                                                                    <span class="fa fa-plus change-icon"
                                                                        style="float: right;"></span></a>
                                                                <div id="hover_submenu5">
                                                                    <!-- <ul> -->
                                                                    <!-- <li><a href="#"></a></li> -->
                                                                    <a href="#" class="cool-link-nav5-1">
                                                                        ????????????</span></a>
                                                                    <a href="#"
                                                                        class="cool-link-nav5-2">?????????????????????????????????</span></a>
                                                                    <a href="#" class="cool-link-nav5-3">????????????</span></a>
                                                                    <a href="#"
                                                                        class="cool-link-nav5-4">???????????????????????????</span></a>
                                                                    <a href="#"
                                                                        class="cool-link-nav5-5">???????????????</span></a>
                                                                    <!-- </ul> -->
                                                                </div>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <!-- menu5 end -->
                                                <!-- menu6 start -->
                                                <div class="col-md-3">
                                                    <div style="padding: 5px 5px 0px;">
                                                        <ul class="stander">
                                                            <li><a id="megamenu_li6" class="megamenu_li" href="#"><i
                                                                        class="fa fa-money" aria-hidden="true"></i>??????
                                                                    <span class="fa fa-plus change-icon"
                                                                        style="float: right;"></span>
                                                                </a>
                                                                <div id="hover_submenu6">
                                                                    <a href="#" class="cool-link-nav6-1">
                                                                        ??????????????????????????????<span>(????????????)</span></a>
                                                                    <a href="#"
                                                                        class="cool-link-nav6-2">??????????????????<span>(????????????)</span></a>
                                                                    <a href="#"
                                                                        class="cool-link-nav6-3">?????????????????????????????????<span>(????????????)</span></a>
                                                                    <a href="{{url('/purchase_approval')}}"
                                                                        class="cool-link-nav6-4">????????????<span>(??????)</span></a>
                                                                    <a href="#"
                                                                        class="cool-link-nav6-5">???????????????????????????<span>(????????????)</span></a>
                                                                    <a href="#"
                                                                        class="cool-link-nav6-6">????????????<span>(????????????)</span></a>
                                                                    <a href="#"
                                                                        class="cool-link-nav6-7">??????????????????<span>(????????????)</span></a>
                                                                    <a href="#"
                                                                        class="cool-link-nav6-8">?????????????????????????????????<span>(????????????)</span></a>
                                                                    <a href="{{url('/payment_schedule_list')}}"
                                                                        class="cool-link-nav6-9">
                                                                        ??????????????????<span>(??????)</span></a>
                                                                    <a href="#"
                                                                        class="cool-link-nav6-10">?????????????????????<span>(????????????)</span></a>
                                                                    <a href="#"
                                                                        class="cool-link-nav6-11">????????????<span>(????????????)</span></a>
                                                                    <a href="{{url('/payment_history_list')}}"
                                                                        class="cool-link-nav6-12">?????????????????????????????????<span>(??????)</span></a>
                                                                    <a href="{{url('/supplier_ledger')}}"
                                                                        class="cool-link-nav6-13">???????????????????????????<span>(??????)</span></a>
                                                                    <a href=""
                                                                        class="cool-link-nav6-14">??????????????????????????????<span>(????????????)</span></a>
                                                                    <a href="#"
                                                                        class="cool-link-nav6-15">????????????????????????<span>(????????????)</span></a>
                                                                </div>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <!-- menu6 end -->
                                                <!-- menu7 start -->
                                                <div class="col-md-3">
                                                    <div style="padding: 5px 5px 0px;">
                                                        <ul class="stander">
                                                            <li><a id="megamenu_li7" class="megamenu_li" href="#"><i
                                                                        class="fa fa-jpy" aria-hidden="true"></i>
                                                                    ??????<span>(????????????)</span> <span
                                                                        class="fa fa-plus change-icon"
                                                                        style="float: right;"></span></a>
                                                                <div id="hover_submenu7">
                                                                    <a href="#" class="cool-link-nav7-1">
                                                                        ?????????????????????????????????</a>
                                                                    <a href="#" class="cool-link-nav7-2">????????????????????????</a>
                                                                </div>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <!-- menu7 end -->
                                                <!-- menu8 start -->
                                                <div class="col-md-3">
                                                    <div style="padding: 5px 5px 0px;">
                                                        <ul class="stander">
                                                            <li><a id="megamenu_li8" class="megamenu_li" href="#"><i
                                                                        class="fa fa-user-circle-o"></i>?????????
                                                                    <span class="fa fa-plus change-icon"
                                                                        style="float: right;"></span></a>
                                                                <div id="hover_submenu8">
                                                                    <a href="{{url('/company')}}"
                                                                        class="cool-link-nav8-1"> ???????????????
                                                                        <span>(??????)</span></a>
                                                                    <a href="{{url('/office')}}"
                                                                        class="cool-link-nav8-2">??????????????????<span>(??????)</span></a>
                                                                    <a href="{{url('/personal')}}"
                                                                        class="cool-link-nav8-3">???????????????<span>(??????)</span></a>
                                                                    <a href="{{url('/product')}}"
                                                                        class="cool-link-nav8-4">???????????????<span>(?????????)</span></a>
                                                                    <a href="{{url('/employee')}}"
                                                                        class="cool-link-nav8-5">???????????????<span>(??????)</span></a>
                                                                    <a href="{{url('/name')}}"
                                                                        class="cool-link-nav8-6">???????????????<span>(??????)</span></a>
                                                                    <!-- <a href="#">???????????????</a> -->
                                                                    <a href="{{url('/seq_numbering')}}"
                                                                        class="cool-link-nav8-7">??????????????????????????????<span>(??????)</span></a>
                                                                    {{-- <a href="{{url('/credit_management_master')}}"
                                                                    class="cool-link-nav8-8">???????????????????????????????????????<span>(?????????)</span></a>
                                                                    --}}
                                                                    <a href="{{url('/credit_management_sales_request')}}"
                                                                        class="cool-link-nav8-9">???????????????????????????<span>(??????)</span></a>
                                                                    <a href="{{url('/product_sub')}}"
                                                                        class="cool-link-nav8-10">?????????????????????<span>(??????)</span></a>
                                                                    <a href="{{url('/')}}"
                                                                        class="cool-link-nav8-11">?????????????????????<span>(??????)</span></a>
                                                                </div>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <!-- menu8 end -->
                                            </div>
                                            <!-- 2nd row menu end new  -->
                                            <!-- 3rd row menu start  -->
                                            <div class="row">
                                                <!-- menu9 start -->
                                                <div class="col-md-3">
                                                    <div style="padding: 5px 5px 0px;">
                                                        <ul class="stander">
                                                            <li><a id="megamenu_li9" class="megamenu_li" href="#"><i
                                                                        class="fa fa-tasks" aria-hidden="true"></i>????????????
                                                                    <span class="fa fa-plus change-icon"
                                                                        style="float: right;"></span></a>
                                                                <div id="hover_submenu9">
                                                                    <!-- <ul> -->
                                                                    <!-- <li><a href="#"></a></li> -->
                                                                    <a href="#" class="cool-link-nav9-1">
                                                                        ??????????????????<span>(????????????)</span> </a>
                                                                    <a href="#"
                                                                        class="cool-link-nav9-2">??????????????????<span>(????????????)</span></a>
                                                                    <a href="#"
                                                                        class="cool-link-nav9-3">????????????????????????<span>(????????????)</span></a>
                                                                    <a href="{{url('/farewell_SQL_statement')}}"
                                                                        class="cool-link-nav9-4"> ?????????????????????
                                                                        <span>(??????)</span></a>
                                                                    <a href="#"
                                                                        class="cool-link-nav9-5">?????????????????????????????????<span>(????????????)</span></a>
                                                                    <a href="#"
                                                                        class="cool-link-nav9-6">??????????????????????????????<span>(????????????)</span></a>
                                                                    <!-- </ul> -->
                                                                </div>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <!-- menu9 end -->
                                                <!-- menu10 start -->
                                                <div class="col-md-3">
                                                    <div style="padding: 5px 5px 0px;">
                                                        <ul class="stander">
                                                            <li><a id="megamenu_li10" class="megamenu_li" href="#"><i
                                                                        class="fa fa-folder-open"
                                                                        aria-hidden="true"></i>????????????<span>(????????????)</span>
                                                                    <span class="fa fa-plus change-icon"
                                                                        style="float: right;"></span></a>
                                                                <div id="hover_submenu10">
                                                                    <a href="#" class="cool-link-nav10-1"> ?????????????????? </a>
                                                                    <a href="#" class="cool-link-nav10-2">???????????????????????????</a>
                                                                    <!-- </ul> -->
                                                                </div>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <!-- menu10 end -->
                                                <!-- menu11 start -->
                                                <div class="col-md-3">
                                                    <div style="padding: 5px 5px 0px;">
                                                        <ul class="stander">
                                                            <li><a id="megamenu_li11" class="megamenu_li" href="#"><i
                                                                        class="fa fa-tasks" aria-hidden="true"></i>?????????
                                                                    <span class="fa fa-plus change-icon"
                                                                        style="float: right;"></span>
                                                                </a>
                                                                <div id="hover_submenu11">
                                                                    <a href="{{url('/lbook')}}"
                                                                        class="cool-link-nav11-1">
                                                                        ???????????????L-BOOK???<span>(??????)</span>
                                                                    </a>
                                                                    <a href="#" class="cool-link-nav11-2">?????????????????????L-INFO)
                                                                        <span>(????????????)</span> </a>
                                                                    <a href="#" class="cool-link-nav11-3">????????????????????????????????????
                                                                        <span>(????????????)</span></a>
                                                                    <a href="{{url('/dashboard_comments')}}"
                                                                        class="cool-link-nav11-4">?????????????????????<span>(??????)</span></a>
                                                                    <a href="#"
                                                                        class="cool-link-nav11-5">??????????????????<span>(????????????)</span></a>
                                                                    <a href="#"
                                                                        class="cool-link-nav11-6">???????????????<span>(????????????)</span></a>
                                                                    <a href="#"
                                                                        class="cool-link-nav11-7">????????????????????????<span>(????????????)</span></a>
                                                                    <a href="{{url('/authority_setting')}}"
                                                                        class="cool-link-nav11-8">????????????<span>(??????)</span></a>
                                                                    <a href="{{url('/authority_setting')}}"
                                                                        class="cool-link-nav11-9">?????????????????????<span>(????????????)</span></a>
                                                                </div>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <!-- menu11 end -->
                                                <!-- menu12 start -->
                                                {{-- <div class="col-md-3">
            <div style="padding: 5px 5px 0px;">
              <ul class="stander">
                <li ><a id="megamenu_li12" class="megamenu_li" href="#"><i class="fa fa-users" aria-hidden="true"></i>????????????<span style="color: red;">(????????????)</span>
                <span class="fa fa-plus change-icon" style="float: right;"></span></a>
                <div id="hover_submenu12">
                  <a href="#" class="cool-link-nav63">?????????L-INFO) </a>
                </div>
              </li>
            </ul>
          </div>
        </div> --}}
                                                <!-- menu12 end -->
                                                <div class="col-md-3">
                                                    <div style="padding: 5px 5px 0px;">
                                                        <ul class="stander">
                                                            <li><a class="logout" href="#"><i
                                                                        class="fas fa-sign-out-alt"></i>???????????????</i></a>
                                                                <div id="hover_submenu">
                                                                </div>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- 3rd row menu  -->
                                            <!-- 4th row menu start -->
                                            <div class="row">
                                                <!-- menu13 start -->
                                                {{-- <div class="col-md-3">
        <div style="padding: 5px 5px 0px;">
          <ul class="stander">
            <li ><a id="megamenu_li13" class="megamenu_li" href="#"><i class="fa fa-cogs" aria-hidden="true"></i>???????????? <span class="fa fa-plus change-icon" style="float: right;"></span></a>
            <div id="hover_submenu13">
              <a href="{{url('/farewell_SQL_statement')}}" class="cool-link-nav64">
                                                ?????????????????????<span style="color: red;">(??????)</span></a>
                                                <a href="#" class="cool-link-nav65">????????????????????????????????????<span
                                                        style="color: red;">(????????????)</span></a>
                                            </div>
                                </li>
                            </ul>
                        </div>
                    </div> --}}
                    <!-- menu13 end -->
                    <!-- menu14 start -->
                    {{-- <div class="col-md-3">
        <div style="padding: 5px 5px 0px;">
          <ul class="stander">
            <li ><a id="megamenu_li14" href="{{url('/message')}}"><i class="fa fa-commenting" aria-hidden="true"
                        style="margin-top:2px;"></i>message</a>
                    <div id="hover_submenu14">
                        <a href="{{url('/message')}}" class="cool-link-nav64">
                            ?????????????????????<span style="color: red;">(??????)</span></a>
                        <a href="#" class="cool-link-nav65">????????????????????????????????????<span style="color: red;">(????????????)</span></a>
                    </div>
                    </li>
                    </ul>
                </div>
            </div> --}}
            <!-- menu14 end -->
            <!-- menu15 start -->
            <!-- menu15 end -->
        </div>
        <!-- 4th row menu start -->
        </div>
        </div>
        </li>
        <!-- <li><a href="#"><i class="fa fa-envelope"></i> Contact</a>
<div class="contact">
</div>
</li> -->
        </ul>
        </div>
        </div>
        </div>
        <!--        hidden div -->
        <div class=" col-lg-12 col-sm-12 col-md-12 hidden_display">
            <div class="nav_midd_hidden"><span class="display-span">@yield('menu')</span> </div>
        </div>
        </div>
        </div>
    </header>
    <!-- ============================= moda1 2 start here ========================-->
    <div class="modal" data-keyboard="false" data-backdrop="static" id="employee_modal2" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" style="max-width: 900px !important;" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="exampleModalLabel">???????????????(??????)</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="development_page_top_table heading_mt" style="margin:11px;">
                        <!--======================= button start ======================-->
                        <div class="row titlebr" style="margin-bottom: 15px;">
                            <div class="col-lg-6" style="margin-left: -16px !important;"></div>
                            <div class="col-lg-6">
                                <table class="dev_tble_button" style="float: right;">
                                    <tbody>
                                        <tr class="marge_in">
                                            <td class="">
                                                <a class="btn btn-info scroll"
                                                    style="background-color: #3e6ec1!important;" data-toggle="modal"
                                                    data-target="#"><i class="fa fa-trash"
                                                        style="margin-right: 7px;"></i>??????</a>
                                            </td>
                                            <td class="">
                                                <a class="btn btn-info scroll" id="empButton3" data-toggle="modal"
                                                    data-target="#employee_modal3" style=""><i
                                                        class="fa fa-pencil-square-o" aria-hidden="true"
                                                        style="margin-right: 5px;"></i>???????????????</a>
                                            </td>
                                            <td class="" style="padding-left:10px!important;">
                                                <a class="btn btn-info " style=""><i class="" aria-hidden="true"
                                                        style="margin-right: 5px;"></i>??????????????????</a>
                                            </td>
                                            <td class="td_button_p">
                                                <a href="#" class="btn btn-info scroll" style=""><i class="fa fa-print"
                                                        aria-hidden="true" style="margin-right: 5px;"></i>??????</a>
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
                                                    <span>????????????(???) <span style="color: red;">???</span></span>
                                                </div>
                                            </div>
                                            <div class="col-lg-9">
                                                <div class="outer_t row" style="">
                                                    <div class="col-lg-3 ">
                                                        <div class="mt_d">
                                                            48
                                                        </div>
                                                    </div>
                                                    <div class="col-9 ">
                                                        <div class="outer_t row" style="">
                                                            <div class="col-3">
                                                                <div class=" mt_d" style="margin-top: 5px;">??????CD<span
                                                                        style="color: red;">???</span></div>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <div class="" style="margin-top: 5px;">001</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class=" row row_data">
                                            <div class="col-lg-2">
                                                <div class="margin_t ">
                                                    <span>?????????(???)</span>
                                                </div>
                                            </div>
                                            <div class="col-lg-9">
                                                <div class="outer_t row" style="">
                                                    <div class="col-lg-7 ">
                                                        <div class="mt_d">??????</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class=" row row_data">
                                            <div class="col-lg-2">
                                                <div class="margin_t ">
                                                    <span>?????????(???)</span>
                                                </div>
                                            </div>
                                            <div class="col-lg-9">
                                                <div class="outer_t row" style="">
                                                    <div class="col-lg-7 ">
                                                        <div class="mt_d">??????</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class=" row row_data">
                                            <div class="col-lg-2">
                                                <div class="margin_t ">
                                                    <span>??????CD</span>
                                                </div>
                                            </div>
                                            <div class="col-lg-9">
                                                <div class="outer_t row" style="">
                                                    <div class="col-lg-12 ">
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
                                                    <span>?????????</span>
                                                </div>
                                            </div>
                                            <div class="col-lg-9">
                                                <div class="outer row">
                                                    <div class="col-lg-12 ">
                                                        <div class="mt_d">01 ???????????????????????????????????????</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class=" row row_data">
                                            <div class="col-lg-3">
                                                <div class="margin_t ">
                                                    <span>???</span>
                                                </div>
                                            </div>
                                            <div class="col-lg-9">
                                                <div class="outer row">
                                                    <div class="col-lg-12 ">
                                                        <div class="mt_d">011 ???????????????????????????????????????
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class=" row row_data">
                                            <div class="col-lg-3">
                                                <div class="margin_t ">
                                                    <span>????????????
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col-lg-9">
                                                <div class="outer row">
                                                    <div class="col-lg-12 ">
                                                        <div class="mt_d">0111 ???1????????????</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class=" row row_data">
                                            <div class="col-lg-3">
                                                <div class="margin_t ">
                                                    <span>?????????
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col-lg-9">
                                                <div class="outer row">
                                                    <div class="col-lg-12 ">
                                                        <div class="mt_d">36 ??????</div>
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
                                                    <span>???????????????<span style="color: red;">???</span></span>
                                                </div>
                                            </div>
                                            <div class="col-lg-9">
                                                <div class="outer row">
                                                    <div class="col-lg-7 ">
                                                        <div class="mt_d">******</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class=" row row_data">
                                            <div class="col-lg-3">
                                                <div class="margin_t ">
                                                    <span>(?????????)</span>
                                                </div>
                                            </div>
                                            <div class="col-lg-9">
                                                <div class="outer row">
                                                    <div class="col-lg-7 ">
                                                        <div class="mt_d">******</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class=" row row_data">
                                            <div class="col-lg-3">
                                                <div class="margin_t ">
                                                    <span>??????CD
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="outer row" style="padding-left: 30px;">
                                                <div class="col-lg-6 ">
                                                    <div class="mt_d pr-m-15 pl-m-15">90</div>
                                                </div>
                                                <div class="col-6 ">
                                                    <div class="mt_d pl-m-15">?????????</div>
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
                                                        ????????????</span>
                                                </div>
                                            </div>
                                            <div class="col-lg-9">
                                                <div class="outer row">
                                                    <div class="col-12 ">
                                                        <div class="mt_d">090-0000-0000</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class=" row row_data">
                                            <div class="col-lg-3">
                                                <div class="margin_t ">
                                                    <span>????????????</span>
                                                </div>
                                            </div>
                                            <div class="col-lg-9">
                                                <div class="outer row">
                                                    <div class="col-lg-12 ">
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
                                                    <span>?????????????????????<span style="color: red;">???</span></span>
                                                </div>
                                            </div>
                                            <div class="col-lg-9">
                                                <div class="outer row">
                                                    <div class="col-lg-12 ">
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
                                                        (?????????)</span>
                                                </div>
                                            </div>
                                            <div class="col-lg-9">
                                                <div class="outer row">
                                                    <div class="col-lg-12 ">
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
                                                        ?????????1</span>
                                                </div>
                                            </div>
                                            <div class="col-lg-9">
                                                <div class="outer row">
                                                    <div class="col-lg-12 ">
                                                        <div class="mt_d"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class=" row row_data">
                                            <div class="col-lg-3">
                                                <div class="margin_t ">
                                                    <span>
                                                        ?????????2</span>
                                                </div>
                                            </div>
                                            <div class="col-lg-9">
                                                <div class="outer row">
                                                    <div class="col-lg-12 ">
                                                        <div class="mt_d"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class=" row row_data">
                                            <div class="col-lg-3">
                                                <div class="margin_t ">
                                                    <span>
                                                        ?????????3</span>
                                                </div>
                                            </div>
                                            <div class="col-lg-9">
                                                <div class="outer row">
                                                    <div class="col-lg-12 ">
                                                        <div class="mt_d"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class=" row row_data">
                                            <div class="col-lg-3">
                                                <div class="margin_t ">
                                                    <span>
                                                        ?????????4</span>
                                                </div>
                                            </div>
                                            <div class="col-lg-9">
                                                <div class="outer row">
                                                    <div class="col-lg-12 ">
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
                                                        ?????????1
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col-lg-9">
                                                <div class="outer row">
                                                    <div class="col-lg-12 ">
                                                        <div class="mt_d"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class=" row row_data">
                                            <div class="col-lg-3">
                                                <div class="margin_t ">
                                                    <span>
                                                        ?????????2
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col-lg-9">
                                                <div class="outer row">
                                                    <div class="col-lg-12 ">
                                                        <div></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class=" row row_data">
                                            <div class="col-lg-3">
                                                <div class="margin_t ">
                                                    <span>
                                                        ?????????3
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col-lg-9">
                                                <div class="outer row">
                                                    <div class="col-lg-12 ">
                                                        <div class="mt_d"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class=" row row_data">
                                            <div class="col-lg-3">
                                                <div class="margin_t ">
                                                    <span>
                                                        ?????????4
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col-lg-9">
                                                <div class="outer row">
                                                    <div class="col-lg-12 ">
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
                                                        ????????????
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col-lg-10">
                                                <div class="outer row" style="">
                                                    <div class="col-lg-12 ">
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
                                                        ??????????????? <span style="color: red;">???</span>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col-lg-10">
                                                <div class="outer row" style="">
                                                    <div class="col-lg-12 ">
                                                        <div class="mt_d">15</div>
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
    <!-- navbar starts here -->
    <script type="text/javascript">
        $(document).ready(function () {
      // $("#sub_icon_sub1").hide();
      $('#sub_icon').click(function () {
        $("#megamenu_li").find('i').removeClass('fa fa-minus').addClass(' fa fa-plus');
      });
    });
// .css('color', '#333')
    </script>
    <script type="text/javascript">
        $(document).ready(function () {
      $('#megamenu_li').click(function () {
        $("#hover_submenu1").toggle(
        );
        $("#megamenu_li").toggleClass("colorChange");
        $("#megamenu_li").find('i').toggleClass("fa fa-plus fa fa-minus");
      });
    });
    </script>
    <script type="text/javascript">
        $(document).ready(function () {
      $('.icon_div i').click(function () {
        $("body").toggleClass('overlay show');
      });
    });
    </script>
    <script type="text/javascript">
        //  $('body').on("click", function() {
//     $('body').removeClass('overlay');
// });
    </script>
    <!-- js for menu 2 -->
    <script type="text/javascript">
        $(document).ready(function () {
      $('#megamenu_li2').click(function () {
        $("#hover_submenu2").toggle(
        );
        $("#megamenu_li2").toggleClass("colorChange");
        $("#megamenu_li2").find('i').toggleClass("fa fa-plus fa fa-minus");
      });
    });
    </script>
    <!-- js for menu 3 -->
    <script type="text/javascript">
        $(document).ready(function () {
      $('#megamenu_li3').click(function () {
        $("#hover_submenu3").toggle(
        );
        $("#megamenu_li3").toggleClass("colorChange");
        $("#megamenu_li3").find('i').toggleClass("fa fa-plus fa fa-minus");
      });
    });
    </script>
    <!-- js for menu 4 -->
    <script type="text/javascript">
        $(document).ready(function () {
      $('#megamenu_li4').click(function () {
        $("#hover_submenu4").toggle(
        );
        $("#megamenu_li4").toggleClass("colorChange");
        $("#megamenu_li4").find('i').toggleClass("fa fa-plus fa fa-minus");
      });
    });
    </script>
    <!-- js for menu 5 -->
    <script type="text/javascript">
        $(document).ready(function () {
      $('#megamenu_li5').click(function () {
        $("#hover_submenu5").toggle(
        );
        $("#megamenu_li5").toggleClass("colorChange");
        $("#megamenu_li5").find('i').toggleClass("fa fa-plus fa fa-minus");
      });
    });
    </script>
    <!-- js for menu 6 -->
    <script type="text/javascript">
        $(document).ready(function () {
      $('#megamenu_li6').click(function () {
        $("#hover_submenu6").toggle(
        );
        $("#megamenu_li6").toggleClass("colorChange");
        $("#megamenu_li6").find('i').toggleClass("fa fa-plus fa fa-minus");
      });
    });
    </script>
    <!-- js for menu 7 -->
    <script type="text/javascript">
        $(document).ready(function () {
      $('#megamenu_li7').click(function () {
        $("#hover_submenu7").toggle(
        );
        $("#megamenu_li7").toggleClass("colorChange");
        $("#megamenu_li7").find('i').toggleClass("fa fa-plus fa fa-minus");
      });
    });
    </script>
    <!-- js for menu 8 -->
    <script type="text/javascript">
        $(document).ready(function () {
      $('#megamenu_li8').click(function () {
        $("#hover_submenu8").toggle(
        );
        $("#megamenu_li8").toggleClass("colorChange");
        $("#megamenu_li8").find('i').toggleClass("fa fa-plus fa fa-minus");
      });
    });
    </script>
    <!-- js for menu 9 -->
    <script type="text/javascript">
        $(document).ready(function () {
      $('#megamenu_li9').click(function () {
        $("#hover_submenu9").toggle(
        );
        $("#megamenu_li9").toggleClass("colorChange");
        $("#megamenu_li9").find('i').toggleClass("fa fa-plus fa fa-minus");
      });
    });
    </script>
    <!-- js for menu 10 -->
    <script type="text/javascript">
        $(document).ready(function () {
      $('#megamenu_li10').click(function () {
        $("#hover_submenu10").toggle(
        );
        $("#megamenu_li10").toggleClass("colorChange");
        $("#megamenu_li10").find('i').toggleClass("fa fa-plus fa fa-minus");
      });
    });
    </script>
    <!-- js for menu 11 -->
    <script type="text/javascript">
        $(document).ready(function () {
      $('#megamenu_li11').click(function () {
        $("#hover_submenu11").toggle(
        );
        $("#megamenu_li11").toggleClass("colorChange");
        $("#megamenu_li11").find('i').toggleClass("fa fa-plus fa fa-minus");
      });
    });
    </script>
    <!-- js for menu 12 -->
    <script type="text/javascript">
        $(document).ready(function () {
      $('#megamenu_li12').click(function () {
        $("#hover_submenu12").toggle(
        );
        $("#megamenu_li12").toggleClass("colorChange");
        $("#megamenu_li12").find('i').toggleClass("fa fa-plus fa fa-minus");
      });
    });
    </script>
    <!-- js for menu 13 -->
    <script type="text/javascript">
        $(document).ready(function () {
      $('#megamenu_li13').click(function () {
        $("#hover_submenu13").toggle(
        );
        $("#megamenu_li13").toggleClass("colorChange");
        $("#megamenu_li13").find('i').toggleClass("fa fa-plus fa fa-minus");
      });
    });
    </script>
    <!-- js for menu 13 -->
    <script type="text/javascript">
        $(document).ready(function () {
      $('#megamenu_li14').click(function () {
        $("#hover_submenu14").toggle(
        );
        $("#megamenu_li14").toggleClass("colorChange");
        $("#megamenu_li14").find('i').toggleClass("fa fa-plus fa fa-minus");
      });
    });
    </script>
    <script src="{{ asset('js/jquery-3.4.1.min.js') }}"></script>
    <!--Bootstrap 4.x-->
    <script src="  {{ asset('js/bootstrap.min.js') }}"></script>
    <!--Jquery Map for mac operating system-->
    <script src=" {{ asset('js/select2.min.js') }}"></script>
</body>

</html>