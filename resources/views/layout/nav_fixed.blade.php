<?php
$check = \App\Helpers\Helper::getChildMenuAccessStatus($bango); ?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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

    .custom-menu-sidebar .megamenu_li .change-icon {
        color: #fff;
    }

    .custom-menu-sidebar ul.stander li div a:hover {
        background: #fff;
    }

    .custom-menu-sidebar ul.stander li div a {
        background: #2c66b0;
        border-top: 1px solid #1e4f9c;
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

</style>
<script type="text/javascript">
    //<![CDATA[
    $(window).on('load', function() {
        $("#add_icon").click(function(e) {
            $("#mega_menu_container").show();
            e.stopPropagation();
        });
        $("#mega_menu_container").click(function(e) {
            e.stopPropagation();
        });
        $(document).click(function() {
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
        $(document).click(function() {
            $("#mega_menu_container").hide();
            $("#add_icon").show();
            $("#sub_icon").hide();
            $("#hover_submenu2").hide();
            $("#megamenu_li2").removeClass("colorChange");
            // $("#megamenu_li").toggleClass("colorChange");
            $("#megamenu_li2").find('i').toggleClass("fa fa-plus fa fa-minus");
            $("#megamenu_li2").find('i').removeClass('fa fa-minus').addClass(' fa fa-plus');
        });
        $(document).click(function() {
            $("#mega_menu_container").hide();
            $("#add_icon").show();
            $("#sub_icon").hide();
            $("#hover_submenu3").hide();
            $("#megamenu_li3").removeClass("colorChange");
            // $("#megamenu_li").toggleClass("colorChange");
            $("#megamenu_li3").find('i').toggleClass("fa fa-plus fa fa-minus");
            $("#megamenu_li3").find('i').removeClass('fa fa-minus').addClass(' fa fa-plus');
        });
        $(document).click(function() {
            $("#mega_menu_container").hide();
            $("#add_icon").show();
            $("#sub_icon").hide();
            $("#hover_submenu4").hide();
            $("#megamenu_li4").removeClass("colorChange");
            // $("#megamenu_li").toggleClass("colorChange");
            $("#megamenu_li4").find('i').toggleClass("fa fa-plus fa fa-minus");
            $("#megamenu_li4").find('i').removeClass('fa fa-minus').addClass(' fa fa-plus');
        });
        $(document).click(function() {
            $("#mega_menu_container").hide();
            $("#add_icon").show();
            $("#sub_icon").hide();
            $("#hover_submenu5").hide();
            $("#megamenu_li5").removeClass("colorChange");
            // $("#megamenu_li").toggleClass("colorChange");
            $("#megamenu_li5").find('i').toggleClass("fa fa-plus fa fa-minus");
            $("#megamenu_li5").find('i').removeClass('fa fa-minus').addClass(' fa fa-plus');
        });
        $(document).click(function() {
            $("#mega_menu_container").hide();
            $("#add_icon").show();
            $("#sub_icon").hide();
            $("#hover_submenu6").hide();
            $("#megamenu_li6").removeClass("colorChange");
            // $("#megamenu_li").toggleClass("colorChange");
            $("#megamenu_li6").find('i').toggleClass("fa fa-plus fa fa-minus");
            $("#megamenu_li6").find('i').removeClass('fa fa-minus').addClass(' fa fa-plus');
        });
        $(document).click(function() {
            $("#mega_menu_container").hide();
            $("#add_icon").show();
            $("#sub_icon").hide();
            $("#hover_submenu7").hide();
            $("#megamenu_li7").removeClass("colorChange");
            // $("#megamenu_li").toggleClass("colorChange");
            $("#megamenu_li7").find('i').toggleClass("fa fa-plus fa fa-minus");
            $("#megamenu_li7").find('i').removeClass('fa fa-minus').addClass(' fa fa-plus');
        });
        $(document).click(function() {
            $("#mega_menu_container").hide();
            $("#add_icon").show();
            $("#sub_icon").hide();
            $("#hover_submenu8").hide();
            $("#megamenu_li8").removeClass("colorChange");
            // $("#megamenu_li").toggleClass("colorChange");
            $("#megamenu_li8").find('i').toggleClass("fa fa-plus fa fa-minus");
            $("#megamenu_li8").find('i').removeClass('fa fa-minus').addClass(' fa fa-plus');
        });
        $(document).click(function() {
            $("#mega_menu_container").hide();
            $("#add_icon").show();
            $("#sub_icon").hide();
            $("#hover_submenu9").hide();
            $("#megamenu_li9").removeClass("colorChange");
            // $("#megamenu_li").toggleClass("colorChange");
            $("#megamenu_li9").find('i').toggleClass("fa fa-plus fa fa-minus");
            $("#megamenu_li9").find('i').removeClass('fa fa-minus').addClass(' fa fa-plus');
        });
        $(document).click(function() {
            $("#mega_menu_container").hide();
            $("#add_icon").show();
            $("#sub_icon").hide();
            $("#hover_submenu10").hide();
            $("#megamenu_li10").removeClass("colorChange");
            // $("#megamenu_li").toggleClass("colorChange");
            $("#megamenu_li10").find('i').toggleClass("fa fa-plus fa fa-minus");
            $("#megamenu_li10").find('i').removeClass('fa fa-minus').addClass(' fa fa-plus');
        });
        $(document).click(function() {
            $("#mega_menu_container").hide();
            $("#add_icon").show();
            $("#sub_icon").hide();
            $("#hover_submenu11").hide();
            $("#megamenu_li11").removeClass("colorChange");
            // $("#megamenu_li").toggleClass("colorChange");
            $("#megamenu_li11").find('i').toggleClass("fa fa-plus fa fa-minus");
            $("#megamenu_li11").find('i').removeClass('fa fa-minus').addClass(' fa fa-plus');
        });
        $(document).click(function() {
            $("#mega_menu_container").hide();
            $("#add_icon").show();
            $("#sub_icon").hide();
            $("#hover_submenu12").hide();
            $("#megamenu_li12").removeClass("colorChange");
            // $("#megamenu_li").toggleClass("colorChange");
            $("#megamenu_li12").find('i').toggleClass("fa fa-plus fa fa-minus");
            $("#megamenu_li12").find('i').removeClass('fa fa-minus').addClass(' fa fa-plus');
        });
        $(document).click(function() {
            $("#mega_menu_container").hide();
            $("#add_icon").show();
            $("#sub_icon").hide();
            $("#hover_submenu14").hide();
            $("#megamenu_li14").removeClass("colorChange");
            // $("#megamenu_li").toggleClass("colorChange");
            $("#megamenu_li14").find('i').toggleClass("fa fa-plus fa fa-minus");
            $("#megamenu_li14").find('i').removeClass('fa fa-minus').addClass(' fa fa-plus');
        });
        $(document).click(function() {
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
    $(".fa-times").click(function() {
        $(this).toggleClass("rotate");
    })

</script>
<script type="text/javascript">
    function showMenu() {
        //document.getElementById('add_icon').style.display = 'none';
        $('#add_icon').fadeOut(function() {
            $(this).css({
                // transition: ".3s",
                display: "none",
                // transform: "rotate(0deg)"
            });
        });
        $('#sub_icon').fadeIn(function() {
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
        $('#add_icon').fadeIn("", function() {
            $(this).css({
                // transition: ".3s",
                display: "block",
                // transform: "rotate(360deg)"
            });
        });
        $('#sub_icon').fadeOut(function() {
            $(this).css({
                // transition: ".3s",
                display: "none",
                // transform: "rotate(0deg)"
            });
        });
        // //document.getElementById('add_icon').style.display = 'block';
        // document.getElementById('mega_menu_container').style.display = 'none';
        // //document.getElementById('sub_icon').style.display = 'none';
        // // hiding data by clicking cross icon
        // document.getElementById('hover_submenu1').style.display = 'none';
        // document.getElementById('megamenu_li').style.color = "black !important";
        // //document.getElementById("c_2").style.color = "black";
        // document.getElementById('sub_icon_sub2').style.display = 'none';
        // document.getElementById('add_icon_sub2').style.display = 'block';
        // document.getElementById('hover_submenu2').style.display = 'none';
        // //document.getElementById("c_3").style.color = "black";
        // document.getElementById('sub_icon_sub3').style.display = 'none';
        // document.getElementById('add_icon_sub3').style.display = 'block';
        // document.getElementById('hover_submenu3').style.display = 'none';
        // //document.getElementById("c_4").style.color = "black";
        // document.getElementById('sub_icon_sub4').style.display = 'none';
        // document.getElementById('add_icon_sub4').style.display = 'block';
        // document.getElementById('hover_submenu4').style.display = 'none';
        // //document.getElementById("c_5").style.color = "black";
        // document.getElementById('sub_icon_sub5').style.display = 'none';
        // document.getElementById('add_icon_sub5').style.display = 'block';
        // document.getElementById('hover_submenu5').style.display = 'none';
        // //document.getElementById("c_6").style.color = "black";
        // document.getElementById('sub_icon_sub6').style.display = 'none';
        // document.getElementById('add_icon_sub6').style.display = 'block';
        // document.getElementById('hover_submenu6').style.display = 'none';
        // //document.getElementById("c_7").style.color = "black";
        // document.getElementById('sub_icon_sub7').style.display = 'none';
        // document.getElementById('add_icon_sub7').style.display = 'block';
        // document.getElementById('hover_submenu7').style.display = 'none';
        // //document.getElementById("c_8").style.color = "black";
        // document.getElementById('sub_icon_sub8').style.display = 'none';
        // document.getElementById('add_icon_sub8').style.display = 'block';
        // document.getElementById('hover_submenu8').style.display = 'none';
        // //document.getElementById("c_9").style.color = "black";
        // document.getElementById('sub_icon_sub9').style.display = 'none';
        // document.getElementById('add_icon_sub9').style.display = 'block';
        // document.getElementById('hover_submenu9').style.display = 'none';
        // //document.getElementById("c_10").style.color = "black";
        // document.getElementById('sub_icon_sub10').style.display = 'none';
        // document.getElementById('add_icon_sub10').style.display = 'block';
        // document.getElementById('hover_submenu10').style.display = 'none';
        // //document.getElementById("c_11").style.color = "black";
        // document.getElementById('sub_icon_sub11').style.display = 'none';
        // document.getElementById('add_icon_sub11').style.display = 'block';
        // document.getElementById('hover_submenu11').style.display = 'none';
        // //document.getElementById("c_12").style.color = "black";
        // document.getElementById('sub_icon_sub12').style.display = 'none';
        // document.getElementById('add_icon_sub12').style.display = 'block';
        // document.getElementById('hover_submenu12').style.display = 'none';
        // //document.getElementById("c_13").style.color = "black";
        // document.getElementById('sub_icon_sub13').style.display = 'none';
        // document.getElementById('add_icon_sub13').style.display = 'block';
        // document.getElementById('hover_submenu13').style.display = 'none';
    }

</script>
<div class="">
    <!--fixed-container-->
    <header id="navigation" class="navbar-fixed-top animated-header" style="z-index: 1000 !important;">
        <div class="container-fluid custom-container">
            <div class="row">
                <div class="col-lg-12 pr-0">
                    <div class="nav_left">
                        <div class="navbar-header">
                            <!-- /responsive nav button -->
                            <!-- logo -->
                            <h1 class="navbar-brand no-padding">
                                <span>
                                    <a href="#" onclick="goToDashBoard()">
                                        <img src="{{ url('img') }}\test_logo.png"
                                            style="padding-top: 0px;" alt="">
                                    </a>
                                </span>
                            </h1>
                            <!-- /logo -->
                        </div>
                    </div>
                    <div class="nav_midd"><span class="display-span"></span></div>
                    <!--           <div class="nav_midd"><span class="display-span">@yield('menu')</span>  </div> -->
                    <div class="nav_right">
                        <div class="mega_menu_content">
                            <ul class="exo-menu">
                                <form action="{{ route('deru') }}" id="logOutForm" method="post">
                                    <input type="hidden" id="csrfForLogout" value="{{ csrf_token() }}" name="_token">
                                    <input type="hidden" name="logOutID" id="logOutID" value="{{ $bango }}">
                                </form>
                                <script type="text/javascript">
                                    function goLogout() {
                                        var id = document.getElementById('idBango').value;
                                        document.getElementById('logOutID').value = id;
                                        document.getElementById("logOutForm").submit();
                                    }

                                </script>
                                <li class="mega-drop-down">
                                    <a class="avatar" href="#">
                                        <div class="menu_div" id="viewUserDetail" data-id="{{ $bango }}"
                                            data-url="{{ route('masterDetail', [$bango]) }}">
                                            <div class="hidd_wrap_m">
                                                <i class="fas fa-user-circle "
                                                    style="font-size: 20px;color: #14A0B1;"></i>
                                               <span> {{ $tantousya->name }} </span>
                                            </div>
                                        </div>
                                        <div class="icon_div">
                                            <i id="add_icon" class="fa fa-bars rotate" aria-hidden="true"
                                                onclick="showMenu();"
                                                style="float: right;margin-right: -1px;font-size: 18px;width: 100%;padding-top: 12px;margin-top: 2px;height: 100%;text-align: center;display: block;"></i>
                                            <i class="fa fa-close" aria-hidden="true" id="sub_icon"
                                                onclick="hideMenu();"
                                                style="float: right;margin-right: -1px;font-size: 18px;width: 100%; padding: 10px 0;margin-top: 2px;height: 100%;text-align: center;display: none;"></i>
                                        </div>
                                    </a>

                                    <div class="animated fadeIn mega-menu custom-menu-sidebar" id="mega_menu_container"
                                        style="display: none;">
                                        <div class="mega-menu-wrap">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div class="parent-nav-list" style="padding: 5px 5px 0px;">
                                                        <ul class="stander">
                                                            @if (true)
                                                                <li>
                                                                    <a id="megamenu_li" class="megamenu_li" href="#"
                                                                        style="color: #fff;">
                                                                        <i class="fa fa-bar-chart"
                                                                            aria-hidden="true"></i>
                                                                        見積
                                                                        <span class="fa fa-plus change-icon"
                                                                            style="float: right;"></span>
                                                                    </a>
                                                                    <div id="hover_submenu1">
                                                                        @if ($check['01-01'] == 'GO')
                                                                           {{-- <div class="custom-menu-list">
                                                                             <a href="#" class="cool-link-nav1-1">見積入力 </a>
                                                                          </div> --}}
                                                                        @endif
                                                                        @if (isset($check['01-02']) && $check['01-02'] == 'GO')
                                                                        {{-- <div class="custom-menu-list">
                                                                          <a href="#" class="cool-link-nav1-2">見積一覧・見積照会 </a>
                                                                          </div> --}}
                                                                        @endif
                                                                    </div>
                                                                </li>
                                                            @endif
                                                        </ul>
                                                    </div>
                                                </div>
                                                <!-- menu 1 end -->
                                                <!-- menu 2 -->
                                                <div class="col-md-3">
                                                <div class="parent-nav-list" style="padding: 5px 5px 0px;">
                                                        <ul class="stander">
                                                            @if (true)
                                                                <li>
                                                                    <a id="megamenu_li2" class="megamenu_li" href="#">
                                                                        <i class="fa fa-cubes" aria-hidden="true"></i>
                                                                        受注
                                                                        <span class="fa fa-plus change-icon"
                                                                            style="float: right;"></span>
                                                                    </a>
                                                                    <div id="hover_submenu2">
                                                                        @if (isset($check['02-01']) && $check['02-01'] == 'GO')
                                                                        <div class="custom-menu-list">
                                                                            <a id="orderEntryReload"
                                                                                onclick="goToWebPage('{{ route('orderEntry') }}')"
                                                                                href="#"
                                                                                class="cool-link-nav2-1">受注入力</a>
                                                                        </div>
                                                                        @endif
                                                                        @if (isset($check['02-02']) && $check['02-02'] == 'GO')
                                                                        <div class="custom-menu-list">
                                                                          <a id="projectRegistrationReload"
                                                                                onclick="goToWebPage('{{ route('projectRegistration') }}')"
                                                                                href="#"
                                                                                class="cool-link-nav2-2">プロジェクト登録</a>
                                                                        </div>
                                                                        @endif
                                                                        @if (isset($check['02-03']) && $check['02-03'] == 'GO')
                                                                        <div class="custom-menu-list">
                                                                            <a id="orderHistoryReload"
                                                                                onclick="goToWebPage('{{ route('orderHistory') }}')"
                                                                                href="#"
                                                                                class="cool-link-nav2-3">受注履歴一覧・受注照会</a>
                                                                        </div>
                                                                        @endif
                                                                        @if (isset($check['02-04']) && $check['02-04'] == 'GO')
                                                                        {{-- <div class="custom-menu-list">
                                                                            <a href="{{ url('/order_data_capture') }}"
                                                                                class="cool-link-nav2-4">受注データ取込</a>
                                                                        </div> --}}
                                                                        @endif
                                                                        <!-- @if (\App\Helpers\Helper::getChildMenuAccessStatus($bango, '02-05')) <a href="#" class="cool-link-nav2-5">UIS出荷指示データ作成</a> @endif -->
                                                                        @if (isset($check['02-06']) && $check['02-06'] == 'GO')
                                                                        <div class="custom-menu-list">
                                                                            <a href="#"
                                                                                onclick="goToWebPage('{{ route('order.salesAcceptance') }}')"
                                                                                class="cool-link-nav2-6">売上検収処理</a>
                                                                        </div>
                                                                        @endif
                                                                        @if (isset($check['02-07']) && $check['02-07'] == 'GO')
                                                                        <div class="custom-menu-list">
                                                                            <a href="#"
                                                                                onclick="goToWebPage('{{ route('orderHistory2') }}')"
                                                                                class="cool-link-nav2-7">受注履歴一覧・受注照会２</a>
                                                                        </div>
                                                                        @endif
                                                                        <!-- <a href="#" class="cool-link-nav2-3">全社受注残</a> -->
                                                                        @if (isset($check['02-09']) && $check['02-09'] == 'GO')
                                                                        <div class="custom-menu-list">
                                                                            <a href="#" id="backOrderReload"
                                                                                onclick="goToWebPage('{{ route('backOrder') }}')"
                                                                                class="cool-link-nav2-9">月別受注残一覧</a>
                                                                        </div>
                                                                        @endif
                                                                        @if (isset($check['02-10']) && $check['02-10'] == 'GO')
                                                                            <div class="custom-menu-list">
                                                                                <a href="#" id="backlogList2Reload"
                                                                                   onclick="goToWebPage('{{ route('backlogList2') }}')"
                                                                                   class="cool-link-nav2-10">月別受注残一覧2</a>
                                                                            </div>
                                                                        @endif
                                                                        @if (isset($check['02-12']) && $check['02-12'] == 'GO')
                                                                            <div class="custom-menu-list">
                                                                                <a href="#" id="cancellationOfPreOrdersReload"
                                                                                   onclick="goToWebPage('{{ route('cancellationOfPreOrders') }}')"
                                                                                   class="cool-link-nav2-12">前受受注取消</a>
                                                                            </div>
                                                                        @endif
                                                                    </div>
                                                                </li>
                                                            @endif
                                                        </ul>
                                                    </div>
                                                </div>
                                                <!-- menu2 end -->
                                                <!-- menu3 start -->
                                                <div class="col-md-3">
                                                <div class="parent-nav-list" style="padding: 5px 5px 0px;">
                                                        <ul class="stander">
                                                            @if (true)
                                                                <li><a id="megamenu_li3" class="megamenu_li" href="#">
                                                                        <i class="fa fa-handshake-o"
                                                                            aria-hidden="true"></i>
                                                                        定期定額契約
                                                                        <span class="fa fa-plus change-icon"
                                                                            style="float: right;"></span>
                                                                    </a>
                                                                    <div id="hover_submenu3">
                                                                        <!-- <a href="#" class="cool-link-nav3-3">受注→定期定額契約データ作成</a> -->
                                                                        @if (isset($check['03-01']) && $check['03-01'] == 'GO')
                                                                            <div class="custom-menu-list">
                                                                                <a id="createData2Reload"
                                                                                   onclick="goToWebPage('{{ route('createData2') }}')"
                                                                                   href="#"
                                                                                   class="cool-link-nav3-1">受注→定期定額契約データ作成</a>
                                                                            </div>
                                                                        @endif
                                                                        @if (isset($check['03-02']) && $check['03-02'] == 'GO')
                                                                          <div class="custom-menu-list">
                                                                            <a id="flatRateEntryReload"
                                                                                onclick="goToWebPage('{{ route('flatRateEntry') }}')"
                                                                                href="#"
                                                                                class="cool-link-nav3-1">定期定額契約入力</a>
                                                                            </div>
                                                                        @endif
                                                                        @if (isset($check['03-03']) && $check['03-03'] == 'GO')
                                                                          <div class="custom-menu-list">
                                                                            <a id="fixedRateContractReload" href="#"
                                                                                onclick="goToWebPage('{{ route('fixedRateContract') }}')"
                                                                                class="cool-link-nav3-2">定期定額契約一覧・照会</a>
                                                                          </div>
                                                                        @endif
                                                                        @if (isset($check['03-04']) && $check['03-04'] == 'GO')
                                                                        <div class="custom-menu-list">
                                                                            <a id="createOrderReload"
                                                                                onclick="goToWebPage('{{ route('createOrder') }}')"
                                                                                href="#" class="cool-link-nav3-3">定期定額→受注データ作成 </a>
                                                                        </div>
                                                                        @endif
                                                                        @if (isset($check['03-05']) && $check['03-05'] == 'GO')
                                                                         <div class="custom-menu-list">
                                                                            <a id="changeInchargeOfFixedRateContractReload"
                                                                                onclick="goToWebPage('{{ route('changeInchargeOfFixedRateContract') }}')"
                                                                                href="#"
                                                                                class="cool-link-nav3-4">定期定額契約担当変更</a>
                                                                              </div>
                                                                        @endif
                                                                        @if (isset($check['03-06']) && $check['03-06'] == 'GO')
                                                                         <div class="custom-menu-list">
                                                                            <a id="changeInchargeOfInHouseWorkWithFixedRateContractReload"
                                                                                onclick="goToWebPage('{{ route('changeInchargeOfInHouseWorkWithFixedRateContract') }}')"
                                                                                href="#"
                                                                                class="cool-link-nav3-4">定期定額契約内作担当変更</a>
                                                                              </div>
                                                                        @endif
                                                                        @if (isset($check['03-07']) && $check['03-07'] == 'GO')
                                                                        {{-- <div class="custom-menu-list">
                                                                            <a href="#" class="cool-link-nav3-5">定期定額契約UIS連携データ作成</a>
                                                                              </div> --}}
                                                                        @endif
                                                                        @if (isset($check['03-08']) && $check['03-08'] == 'GO')
                                                                        {{-- <div class="custom-menu-list">
                                                                            <a href="#"class="cool-link-nav3-6">保守サービス登録確認書</a>
                                                                              </div> --}}
                                                                        @endif
                                                                        @if (isset($check['03-09']) && $check['03-09'] == 'GO')
                                                                        {{-- <div class="custom-menu-list">
                                                                            <a href="#" class="cool-link-nav3-7">保守契約書</a>
                                                                              </div> --}}
                                                                        @endif
                                                                        @if (isset($check['03-10']) && $check['03-10'] == 'GO')
                                                                        {{-- <div class="custom-menu-list">
                                                                            <a href="#" class="cool-link-nav3-8">保守更新案内</a>
                                                                              </div> --}}
                                                                        @endif
                                                                        @if (isset($check['03-11']) && $check['03-11'] == 'GO')
                                                                        {{-- <div class="custom-menu-list">
                                                                            <a href="#" class="cool-link-nav3-9">定期仕入伝票入力</a>
                                                                              </div> --}}
                                                                        @endif
                                                                        @if (isset($check['03-12']) && $check['03-12'] == 'GO')
                                                                        {{-- <div class="custom-menu-list">
                                                                            <a href="#" class="cool-link-nav3-10">定期仕入仮計上</a>
                                                                              </div> --}}
                                                                        @endif
                                                                        @if (isset($check['03-13']) && $check['03-13'] == 'GO')
                                                                        {{-- <div class="custom-menu-list">
                                                                            <a href="#" class="cool-link-nav3-11">定期定額自動更新</a>
                                                                              </div> --}}
                                                                        @endif
                                                                    </div>
                                                                </li>
                                                            @endif
                                                        </ul>
                                                    </div>
                                                </div>
                                                <!-- menu3 end -->
                                                <!-- menu4 start -->
                                                <div class="col-md-3">
                                                <div class="parent-nav-list" style="padding: 5px 5px 0px;">
                                                        <ul class="stander">
                                                            @if (true)
                                                                <li><a id="megamenu_li4" class="megamenu_li" href="#"><i
                                                                            class="fa fa-file-text-o"
                                                                            aria-hidden="true"></i>売上請求
                                                                        <span class="fa fa-plus change-icon"
                                                                            style="float: right;"></span>
                                                                    </a>
                                                                    <div id="hover_submenu4">
                                                                        @if (isset($check['04-01']) && $check['04-01'] == 'GO')
                                                                        <div class="custom-menu-list">
                                                                            <a id="salesSlipReload"
                                                                                onclick="goToWebPage('{{ route('sales_data_creation') }}')"
                                                                                href="#"
                                                                                class="cool-link-nav4-3">受注→売上データ作成
                                                                            </a>
                                                                        </div>

                                                                        @endif
                                                                        @if (isset($check['04-02']) && $check['04-02'] == 'GO')
                                                                        {{-- <div class="custom-menu-list">
                                                                            <a href="{{ url('/sales_input') }}" class="cool-link-nav4-2">売上入力</a>
                                                                              </div> --}}
                                                                        @endif
                                                                        @if (isset($check['04-03']) && $check['04-03'] == 'GO')
                                                                        <div class="custom-menu-list">
                                                                            <a id="salesSlipReload"
                                                                                onclick="goToWebPage('{{ route('salesSlip') }}')"
                                                                                href="#" class="cool-link-nav4-3">売上伝票発行
                                                                            </a>
                                                                          </div>
                                                                        @endif
                                                                        @if (isset($check['04-21']) && $check['04-21'] == 'GO')
                                                                        <div class="custom-menu-list">
                                                                            <a id="deliveryNoteReload"
                                                                                onclick="goToWebPage('{{ route('deliveryNote') }}')"
                                                                                href="#"
                                                                                class="cool-link-nav4-4">指定納品書(伝発名人クラウド）</a>
                                                                              </div>
                                                                        @endif
                                                                        @if (isset($check['04-04']) && $check['04-04'] == 'GO')
                                                                        <div class="custom-menu-list">
                                                                            <a id="salesHistoryReload"
                                                                                onclick="goToWebPage('{{ route('salesHistory') }}')"
                                                                                href="#"
                                                                                class="cool-link-nav2-3">売上履歴一覧・売上照会</a>
                                                                              </div>
                                                                        @endif
                                                                        @if (isset($check['04-15']) && $check['04-15'] == 'GO')
                                                                        <div class="custom-menu-list">
                                                                            <a id="billingDeadlineReload"
                                                                                onclick="goToWebPage('{{ route('billingDeadline') }}')"
                                                                                href="#"
                                                                                class="cool-link-nav4-9">請求締日処理</a>
                                                                              </div>
                                                                        @endif
                                                                        @if (isset($check['04-16']) && $check['04-16'] == 'GO')
                                                                        <div class="custom-menu-list">
                                                                            <a id="billingCancellationReload"
                                                                                onclick="goToWebPage('{{ route('billingCancellation') }}')"
                                                                                href="#"
                                                                                class="cool-link-nav4-9">請求締日取消</a>
                                                                              </div>
                                                                        @endif
                                                                        @if (isset($check['04-06']) && $check['04-06'] == 'GO')
                                                                        <div class="custom-menu-list">
                                                                            <a id="billingBalanceListReload"
                                                                                onclick="goToWebPage('{{ route('billingBalanceList') }}')"
                                                                                href="#"
                                                                                class="cool-link-nav4-9">請求残高一覧</a>
                                                                        </div>
                                                                        @endif
                                                                        @if (isset($check['04-07']) && $check['04-07'] == 'GO')
                                                                        <div class="custom-menu-list">
                                                                            <a id="invoiceDeadlineReload"
                                                                                onclick="goToWebPage('{{ route('invoiceDeadline') }}')"
                                                                                href="#"
                                                                                class="cool-link-nav4-9">請求書発行　締日</a>
                                                                              </div>
                                                                        @endif
                                                                        <!-- <a href="#" class="cool-link-nav4-9">得意先元帳（社外）</a> -->
                                                                        @if (isset($check['04-08']) && $check['04-08'] == 'GO')
                                                                        <div class="custom-menu-list">
                                                                            <a id="billingLedgerReload"
                                                                                onclick="goToWebPage('{{ route('billingLedger') }}')"
                                                                                href="#"
                                                                                class="cool-link-nav4-10">得意先元帳（社外）</a>
                                                                              </div>
                                                                        @endif

                                                                        @if (isset($check['04-09']) && $check['04-09'] == 'GO')
                                                                        <div class="custom-menu-list">
                                                                            <a id="unearnedSalesCancellation"
                                                                                onclick="goToWebPage('{{ route('unearnedSalesCancellation') }}')"
                                                                                href="#"
                                                                                class="cool-link-nav4-10">前受売上取消</a>
                                                                              </div>
                                                                        @endif

                                                                        @if (isset($check['04-10']) && $check['04-10'] == 'GO')
                                                                        <div class="custom-menu-list">
                                                                            <a href="#" id="depositInputReload"
                                                                                onclick="goToWebPage('{{ route('depositInput') }}')"
                                                                                class="cool-link-nav4-12">入金入力</a>
                                                                              </div>
                                                                        @endif
                                                                        @if (isset($check['04-11']) && $check['04-11'] == 'GO')
                                                                        <div class="custom-menu-list">
                                                                            <a id="depositHistoryReload"
                                                                                onclick="goToWebPage('{{ route('depositHistory') }}')"
                                                                                href="#"
                                                                                class="cool-link-nav2-3">入金履歴一覧</a>
                                                                              </div>
                                                                        @endif
                                                                        @if (isset($check['04-12']) && $check['04-12'] == 'GO')
                                                                        <div class="custom-menu-list">
                                                                            <a href="#" id="unpaidListReload"
                                                                                onclick="goToWebPage('{{ route('unpaidList') }}')"
                                                                                class="cool-link-nav4-14">未入金一覧</a>
                                                                              </div>
                                                                        @endif
                                                                        @if (isset($check['04-13']) && $check['04-13'] == 'GO')
                                                                        <div class="custom-menu-list">
                                                                            <a href="#" id="customerLedgerReload"
                                                                                onclick="goToWebPage('{{ route('customer_ledger') }}')"
                                                                                class="cool-link-nav4-15">得意先元帳(社内)</a>
                                                                              </div>
                                                                        @endif
                                                                        @if (isset($check['04-14']) && $check['04-14'] == 'GO')
                                                                        <div class="custom-menu-list">
                                                                            <a href="#"
                                                                                id="accountingDataCreationReload"
                                                                                onclick="goToWebPage('{{ route('accountingDataCreation') }}')"
                                                                                class="cool-link-nav4-16">売上→会計データ作成</a>
                                                                              </div>
                                                                        @endif

                                                                        @if (isset($check['04-17']) && $check['04-17'] == 'GO')
                                                                        <div class="custom-menu-list">
                                                                            <a href="#"
                                                                                id="salesCancellationReload"
                                                                                onclick="goToWebPage('{{ route('salesCancellation') }}')"
                                                                                class="cool-link-nav4-16">売上取消</a>
                                                                              </div>
                                                                        @endif

                                                                        @if (isset($check['04-18']) && $check['04-18'] == 'GO')
                                                                        {{-- <div class="custom-menu-list">
                                                                            <a href="#" class="cool-link-nav4-17">与信限度額確認一覧</a>
                                                                              </div> --}}
                                                                        @endif
                                                                        @if (isset($check['04-19']) && $check['04-19'] == 'GO')
                                                                        <div class="custom-menu-list">
                                                                            <a id="depositApplicationReload"
                                                                                onclick="goToWebPage('{{ route('depositApplication') }}')"
                                                                                href="#" class="cool-link-nav4-18">入金消込
                                                                            </a>
                                                                          </div>
                                                                        @endif
                                                                        @if (isset($check['04-20']) && $check['04-20'] == 'GO')
                                                                        <div class="custom-menu-list">
                                                                            <a id="accountListReload" onclick="goToWebPage('{{ route('accountList') }}')" href="#" class="cool-link-nav4-20">売掛残高一覧
                                                                            </a>
                                                                        </div>
                                                                        @endif
                                                                        @if (isset($check['04-22']) && $check['04-19'] == 'GO')
                                                                        <div class="custom-menu-list">
                                                                            <a id="depositHistoryListReload"
                                                                                onclick="goToWebPage('{{ route('depositHistoryList') }}')"
                                                                                href="#"
                                                                                class="cool-link-nav2-3">入金消込履歴一覧</a></div>
                                                                        @endif
                                                                        @if (isset($check['04-26']) && $check['04-26'] == 'GO')
                                                                            <div class="custom-menu-list">
                                                                                <a id="creditLimitManagementReload"
                                                                                   onclick="goToWebPage('{{ route('creditLimitManagement') }}')"
                                                                                   href="#"
                                                                                   class="cool-link-nav4-19">与信限度チェック管理表</a></div>
                                                                        @endif
                                                                        @if (isset($check['04-27']) && $check['04-27'] == 'GO')
                                                                        {{-- <div class="custom-menu-list">
                                                                            <a href="#" class="cool-link-nav4-19">前受請求履歴一覧</a>
                                                                          </div> --}}
                                                                        @endif
                                                                        @if (isset($check['04-28']) && $check['04-28'] == 'GO')
                                                                        <div class="custom-menu-list">
                                                                            <a id="billingDataCreatingReload"
                                                                                onclick="goToWebPage('{{ route('billingDataCreate') }}')"
                                                                                href="#"
                                                                                class="cool-link-nav2-3">入金消込SYS請求データ作成</a></div>
                                                                        @endif
                                                                        @if (isset($check['04-29']) && $check['04-29'] == 'GO')
                                                                        <div class="custom-menu-list">
                                                                            <a id="depositSysApplicationReload"
                                                                                onclick="goToWebPage('{{ route('depositSysApplication') }}')"
                                                                                href="#"
                                                                                class="cool-link-nav4-21">入金消込SYS消込データ取込</a></div>
                                                                        @endif
                                                                        @if (isset($check['04-30']) && $check['04-30'] == 'GO')
                                                                            <!-- <a href="#" class="cool-link-nav4-22">受注→発注データ作成</a> -->
                                                                            <div class="custom-menu-list">
                                                                            <a onclick="goToWebPage('{{ route('balanceUpdate') }}')"
                                                                                href="#"
                                                                                class="cool-link-nav4-23">売掛残高更新</a></div>
                                                                        @endif
                                                                        @if (isset($check['04-31']) && $check['04-31'] == 'GO')
                                                                        <div class="custom-menu-list">
                                                                            <a onclick="goToWebPage('{{ route('depositAccountingDataCreate') }}')"
                                                                                href="#"
                                                                                class="cool-link-nav4-24">入金→会計データ作成</a>
                                                                        </div>
                                                                        @endif
                                                                    </div>
                                                                </li>
                                                            @endif
                                                        </ul>
                                                    </div>
                                                </div>
                                                <!-- menu4 end -->
                                            </div>
                                            <!-- 2nd row menu start new  -->
                                            <div class="row">
                                                <!-- menu5 start -->
                                                <div class="col-md-3">
                                                <div class="parent-nav-list" style="padding: 5px 5px 0px;">
                                                        <ul class="stander">
                                                            @if (true)
                                                                <li>
                                                                    <a id="megamenu_li5" class="megamenu_li" href="#">
                                                                        <i class="fa fa-truck" aria-hidden="true"></i>
                                                                        発注
                                                                        <span class="fa fa-plus change-icon"
                                                                            style="float: right;"></span>
                                                                    </a>
                                                                    <div id="hover_submenu5">
                                                                        <!-- <a href="#" class="cool-link-nav5-1">
                                                                            UIS出荷指示データ作成</a> -->
                                                                        @if (isset($check['05-02']) && $check['05-02'] == 'GO')
                                                                        <div class="custom-menu-list">
                                                                            <a onclick="goToWebPage('{{ route('purchase') }}')"
                                                                              href="#"
                                                                              class="cool-link-nav5-1">発注入力</a></div>
                                                                        @endif
                                                                        @if (isset($check['05-03']) && $check['05-03'] == 'GO')
                                                                            <div class="custom-menu-list">
                                                                                <a id="purchaseOrderReload" onclick="goToWebPage('{{ route('purchaseOrder') }}')"
                                                                                   href="#"
                                                                                   class="cool-link-nav5-1">発注一覧・発注書</a></div>
                                                                        @endif

                                                                        @if (isset($check['05-06']) && $check['05-06'] == 'GO')
                                                                            <div class="custom-menu-list">
                                                                                <a onclick="goToWebPage('{{ route('supportEntry') }}')"
                                                                                   href="#"
                                                                                   class="cool-link-nav5-1">サポート入力 </a></div>
                                                                        @endif

                                                                        <!-- @if (\App\Helpers\Helper::getChildMenuAccessStatus($bango, '05-03')) <a href="#" class="cool-link-nav5-2">発注履歴一覧・発注照会</a> @endif -->
                                                                        <!-- <a href="#" class="cool-link-nav5-1"> 出荷入力</a> -->
                                                                        <!-- @if (\App\Helpers\Helper::getChildMenuAccessStatus($bango, '05-04')) <a href="#" class="cool-link-nav5-3">発注承認</a> @endif -->
                                                                        <!--  <a href="#" class="cool-link-nav5-1"> サポート入力</a> -->
                                                                        <!-- @if (\App\Helpers\Helper::getChildMenuAccessStatus($bango, '05-05')) <a href="#" class="cool-link-nav5-4">内作調整データ作成</a> @endif -->
                                                                        <!--  <a href="#" class="cool-link-nav5-1">
                                                                             発注一覧・発注書</a> -->
                                                                        <!-- @if (\App\Helpers\Helper::getChildMenuAccessStatus($bango, '05-06')) <a href="#" class="cool-link-nav5-5">作業指示書</a> @endif -->
                                                                        <!-- <a href="#" class="cool-link-nav5-1">
                                                                            出荷一覧・出荷指示書</a> -->

                                                                        @if (isset($check['05-07']) && $check['05-07'] == 'GO')
                                                                        <div class="custom-menu-list">
                                                                            <a id="supportReqConfirmationReload"
                                                                                onclick="goToWebPage('{{ route('supportReqConfirmation') }}')"
                                                                                href="#" class="cool-link-nav4-3">サポート一覧・サポート依頼兼請書
                                                                            </a>
                                                                          </div>
                                                                        @endif

                                                                    </div>
                                                                </li>
                                                            @endif
                                                        </ul>
                                                    </div>
                                                </div>
                                                <!-- menu5 end -->
                                                <!-- menu6 start -->
                                                <div class="col-md-3">
                                                <div class="parent-nav-list" style="padding: 5px 5px 0px;">
                                                        <ul class="stander">
                                                            @if (true)
                                                                <li>
                                                                    <a id="megamenu_li6" class="megamenu_li" href="#">
                                                                        <i class="fa fa-money" aria-hidden="true"></i>
                                                                        仕入
                                                                        <span class="fa fa-plus change-icon"
                                                                            style="float: right;"></span>
                                                                    </a>
                                                                    <div id="hover_submenu6">
                                                                        @if (isset($check['06-01']) && $check['06-01'] == 'GO')
                                                                        {{-- <div class="custom-menu-list">
                                                                            <a href="#"
                                                                                class="cool-link-nav6-1">発注→仕入データ作成</a></div> --}}
                                                                        @endif
                                                                        <!-- <a href="#"
                                                                           class="cool-link-nav6-15">仕入→会計データ作成</a> -->
                                                                        @if (isset($check['06-03']) && $check['06-03'] == 'GO')
                                                                        <div class="custom-menu-list">
                                                                            <a onclick="goToWebPage('{{ route('purchaseInput') }}')"
                                                                            href="#"
                                                                            class="cool-link-nav6-2">仕入購入入力</a></div>
                                                                        @endif
                                                                        @if (isset($check['06-04']) && $check['06-04'] == 'GO')
                                                                        <div class="custom-menu-list">
                                                                            <a  id="purchaseHistoryReload" onclick="goToWebPage('{{ route('purchaseHistory') }}')"
                                                                                href="#"
                                                                                class="cool-link-nav6-3">仕入履歴一覧・仕入照会</a></div>
                                                                        @endif
                                                                        @if (isset($check['06-05']) && $check['06-05'] == 'GO')
                                                                        <div class="custom-menu-list">
                                                                            <a id="purchaseRecordTransferReload" onclick="goToWebPage('{{ route('purchaseRecordTransfer') }}')"
                                                                                href="#"
                                                                                class="cool-link-nav6-4">仕入実績振替</a></div>
                                                                        @endif
                                                                        @if (isset($check['06-06']) && $check['06-06'] == 'GO')
                                                                        <div class="custom-menu-list">
                                                                            <a id="purchaseBalanceListReload" onclick="goToWebPage('{{ route('purchaseBalanceList') }}')"
                                                                                href="#"
                                                                                class="cool-link-nav6-5">買掛・購入残高一覧</a></div>
                                                                        @endif
                                                                        <!-- <a href="#" class="cool-link-nav6-15">購入残高一覧</a> -->
                                                                        @if (isset($check['06-07']) && $check['06-07'] == 'GO')
                                                                        <div class="custom-menu-list">
                                                                            <a id="supplierLedgerReload" onclick="goToWebPage('{{ route('supplierLedger') }}')"
                                                                              href="#"
                                                                              class="cool-link-nav6-6">仕入先元帳</a></div>
                                                                        @endif
                                                                        @if (isset($check['06-08']) && $check['06-08'] == 'GO')
                                                                        <div class="custom-menu-list">
                                                                            <a id="inventoryListReload" onclick="goToWebPage('{{ route('inventoryList') }}')"
                                                                              href="#"
                                                                              class="cool-link-nav6-6">在庫一覧</a></div>
                                                                        @endif
                                                                        @if (isset($check['06-09']) && $check['06-09'] == 'GO')
                                                                        <div class="custom-menu-list">
                                                                            <a id="paymentScheduleCalReload"
                                                                                onclick="goToWebPage('{{ route('paymentScheduleCal') }}')"
                                                                                href="#"
                                                                                class="cool-link-nav6-7">支払予定計算</a></div>
                                                                        @endif


                                                                        @if (isset($check['06-10']) && $check['06-10'] == 'GO')
                                                                            <div class="custom-menu-list">
                                                                                <a onclick="goToWebPage('{{ route('paymentScheduleRegistration') }}')"
                                                                                   href="#"
                                                                                   class="cool-link-nav5-1">支払予定登録 </a></div>
                                                                        @endif

                                                                        @if (isset($check['06-11']) && $check['06-11'] == 'GO')
                                                                        <div class="custom-menu-list">
                                                                            <a  id="paymentScheduleReload" onclick="goToWebPage('{{ route('paymentSchedule') }}')"
                                                                                href="#"
                                                                                class="cool-link-nav6-9">支払予定一覧</a></div>
                                                                        @endif
                                                                        @if (isset($check['06-12']) && $check['06-12'] == 'GO')
                                                                        <div class="custom-menu-list">
                                                                            <a href="#" onclick="goToWebPage('{{ route('paymentDataCreation') }}')"
                                                                                class="cool-link-nav6-10">支払データ作成</a></div>
                                                                        @endif
                                                                        @if (isset($check['06-13']) && $check['06-13'] == 'GO')
                                                                        <div class="custom-menu-list">
                                                                            <a href="#" onclick="goToWebPage('{{ route('paymentInput') }}')"
                                                                                class="cool-link-nav6-11">支払入力</a></div>
                                                                        @endif
                                                                        @if (isset($check['06-14']) && $check['06-14'] == 'GO')
                                                                        <div class="custom-menu-list">
                                                                            <a id="paymentHistoryReload" onclick="goToWebPage('{{ route('paymentHistory') }}')"
                                                                               href="#"
                                                                                class="cool-link-nav6-12"><!--支払履歴一覧・支払照会-->支払履歴一覧
                                                                            </a>
                                                                        </div>
                                                                        @endif
                                                                        @if (isset($check['06-15']) && $check['06-15'] == 'GO')
                                                                        <div class="custom-menu-list">
                                                                            <a  id="purchaseLedgerReload"
                                                                                onclick="goToWebPage('{{ route('purchaseLedger') }}')"
                                                                                href="#"
                                                                                class="cool-link-nav6-13">購入先元帳</a></div>
                                                                        @endif
                                                                        @if (isset($check['06-17']) && $check['06-17'] == 'GO')
                                                                        <div class="custom-menu-list">
                                                                            <a id="purchaseEndCalculationReload"
                                                                               onclick="goToWebPage('{{ route('purchaseEndCalculation') }}')"
                                                                               href="#"
                                                                               class="cool-link-nav6-14">仕入完了計算</a></div>
                                                                        @endif
                                                                        @if (isset($check['06-18']) && $check['06-18'] == 'GO')
                                                                        <div class="custom-menu-list">
                                                                            <a  id="purchaseRecordListReload"
                                                                                onclick="goToWebPage('{{ route('purchaseRecordList') }}')"
                                                                                href="#"
                                                                                class="cool-link-nav6-15">仕入実績一覧                                                                              </a></div>
                                                                        @endif
                                                                        <!--  <a href="#"
                                                                           class="cool-link-nav6-15">②仕入完了フラグ変更</a> -->
                                                                        @if (isset($check['06-20']) && $check['06-20'] == 'GO')
                                                                        <div class="custom-menu-list">
                                                                        <a id="purchaseConfirmationReload"
                                                                            onclick="goToWebPage('{{ route('purchaseConfirmation') }}')"
                                                                            href="#" class="cool-link-nav6-15">仕入購入確認</a>
                                                                        </div>
                                                                        @endif
                                                                        
                                                                        @if (isset($check['06-23']) && $check['06-23'] == 'GO')
                                                                            <div class="custom-menu-list">
                                                                                <a  id="purchaseDetailsReload" onclick="goToWebPage('{{ route('purchaseDetails') }}')"
                                                                                    href="#"
                                                                                    class="cool-link-nav6-9">仕入実績明細</a></div>
                                                                        @endif

                                                                        @if (isset($check['06-24']) && $check['06-24'] == 'GO')
                                                                        <div class="custom-menu-list">
                                                                        <a id="importPurchaseDataReload"
                                                                            onclick="goToWebPage('{{ route('importPurchaseData') }}')"
                                                                            href="#" class="cool-link-nav6-15">仕入購入データ取込</a>
                                                                        </div>
                                                                        @endif
                                                                        
                                                                        @if (isset($check['06-26']) && $check['06-26'] == 'GO')
                                                                        <div class="custom-menu-list">
                                                                        <a id="accountBalanceUpdateReload"
                                                                            onclick="goToWebPage('{{ route('accountBalanceUpdate') }}')"
                                                                            href="#" class="cool-link-nav6-15">買掛残高更新</a>
                                                                        </div>
                                                                        @endif

                                                                        @if (isset($check['06-29']) && $check['06-29'] == 'GO')
                                                                        <div class="custom-menu-list">
                                                                        <a id="purchaseSlipReload"
                                                                            onclick="goToWebPage('{{ route('purchaseSlip') }}')"
                                                                            href="#" class="cool-link-nav6-15">定期仕入伝票入力</a>
                                                                        </div>
                                                                        @endif

                                                                        @if (isset($check['06-30']) && $check['06-30'] == 'GO')
                                                                        <div class="custom-menu-list">
                                                                        <a id="purchaseCompletionCancellationReload"
                                                                            onclick="goToWebPage('{{ route('purchaseCompletionCancellation') }}')"
                                                                            href="#" class="cool-link-nav6-15">仕入完了取消画面</a>
                                                                        </div>
                                                                        @endif

                                                                        <!-- <a href="#"
                                                                           class="cool-link-nav6-15">担当別仕入完了一覧</a> -->
                                                                        <!-- <a href="#"
                                                                           class="cool-link-nav6-15">仕入実績明細一覧</a> -->
                                                                        <!--  <a href="#" class="cool-link-nav6-15">仕入予定一覧</a> -->
                                                                        <!-- <a href="#" class="cool-link-nav6-15">仕入購入入力（消費税）<br/></a> -->
                                                                    </div>
                                                                </li>
                                                            @endif
                                                        </ul>
                                                    </div>
                                                </div>
                                                <!-- menu6 end -->
                                                <!-- menu7 start -->
                                                <div class="col-md-3">
                                                <div class="parent-nav-list" style="padding: 5px 5px 0px;">
                                                        <ul class="stander">
                                                            @if (true)
                                                                <li>
                                                                    <a id="megamenu_li7" class="megamenu_li" href="#">
                                                                        <i class="fa fa-jpy" aria-hidden="true"></i>
                                                                        予算
                                                                        <span class="fa fa-plus change-icon"
                                                                            style="float: right;"></span>
                                                                    </a>
                                                                    <div id="hover_submenu7">
                                                                        @if (isset($check['07-01']) && $check['07-01'] == 'GO')
                                                                        {{-- <div class="custom-menu-list">
                                                                            <a href="#" class="cool-link-nav7-1">
                                                                                予算入力（受注・売上）</a></div> --}}
                                                                        @endif
                                                                        @if (isset($check['07-02']) && $check['07-02'] == 'GO')
                                                                        {{-- <div class="custom-menu-list">
                                                                            <a href="#"
                                                                                class="cool-link-nav7-2">ＣＳＶ→予算取込</a></div> --}}
                                                                        @endif
                                                                    </div>
                                                                </li>
                                                            @endif
                                                        </ul>
                                                    </div>
                                                </div>
                                                <!-- menu7 end -->
                                                <!-- menu8 start -->
                                                <div class="col-md-3">
                                                <div class="parent-nav-list" style="padding: 5px 5px 0px;">
                                                        <ul class="stander">
                                                            @if (true)
                                                                <li>
                                                                    <a id="megamenu_li8" class="megamenu_li" href="#">
                                                                        <i class="fa fa-user-circle-o"></i>
                                                                        マスタ
                                                                        <span class="fa fa-plus change-icon"
                                                                            style="float: right;"></span>
                                                                    </a>
                                                                    <div id="hover_submenu8">
                                                                        @if (isset($check['08-01']) && $check['08-01'] == 'GO')
                                                                        <div class="custom-menu-list">
                                                                            <a href="#" id="companyMasterReload"
                                                                                onclick="goToWebPage('{{ route('companyMaster') }}')"
                                                                                class="cool-link-nav8-1">会社マスタ</a></div>
                                                                        @endif
                                                                        @if (isset($check['08-02']) && $check['08-02'] == 'GO')
                                                                        <div class="custom-menu-list">
                                                                            <a href="#" id="officeMasterReload"
                                                                                onclick="goToWebPage('{{ route('officeMaster') }}')"
                                                                                class="cool-link-nav8-2">事業所マスタ</a></div>
                                                                        @endif
                                                                        @if (isset($check['08-03']) && $check['08-03'] == 'GO')
                                                                        <div class="custom-menu-list">
                                                                            <a href="#" id="personalReload"
                                                                                onclick="goToWebPage('{{ route('personal') }}')"
                                                                                class="cool-link-nav8-3">個人マスタ</a></div>
                                                                        @endif
                                                                        @if (isset($check['08-04']) && $check['08-04'] == 'GO')
                                                                        <div class="custom-menu-list">
                                                                            <a href="#" id="productMasterReload"
                                                                                onclick="goToWebPage('{{ route('productMaster') }}')"
                                                                                class="cool-link-nav8-4">商品マスタ</a></div>
                                                                        @endif
                                                                        @if (isset($check['08-05']) && $check['08-05'] == 'GO')
                                                                        <div class="custom-menu-list">
                                                                            <a href="#" id="employeeMasterReload"
                                                                                onclick="goToWebPage('{{ route('employeeMaster') }}')"
                                                                                class="cool-link-nav8-5">社員マスタ</a></div>
                                                                        @endif
                                                                        @if (isset($check['08-06']) && $check['08-06'] == 'GO')
                                                                        <div class="custom-menu-list">
                                                                            <a href="#" id="nameMasterReload"
                                                                                onclick="goToWebPage('{{ route('nameMaster') }}')"
                                                                                class="cool-link-nav8-6">名称マスタ</a></div>
                                                                        @endif
                                                                        @if (isset($check['08-10']) && $check['08-10'] == 'GO')
                                                                        <div class="custom-menu-list">
                                                                            <a href="#" id="seqNumberingMasterReload"
                                                                                onclick="goToWebPage('{{ route('seqNumberingMaster') }}')"
                                                                                class="cool-link-nav8-7">ＳＥＱ番号付番マスタ</a></div>
                                                                        @endif
                                                                        @if (isset($check['08-13']) && $check['08-13'] == 'GO')
                                                                        <div class="custom-menu-list">
                                                                            <a href="#" id="customerProductReload"
                                                                                onclick="goToWebPage('{{ route('customerProductManagement') }}')"
                                                                                class="cool-link-nav8-9">得意先別商品マスタ</a></div>
                                                                        @endif
                                                                        @if (isset($check['08-14']) && $check['08-14'] == 'GO')
                                                                        <div class="custom-menu-list">
                                                                            <a href="#" id="ProductSubMasterReload"
                                                                                onclick="goToWebPage('{{ route('ProductSubMaster') }}')"
                                                                                class="cool-link-nav8-10">商品サブマスタ</a></div>
                                                                        @endif
                                                                        @if (isset($check['08-15']) && $check['08-15'] == 'GO')
                                                                        <div class="custom-menu-list">
                                                                            <a href="#" id="productDescriptionReload"
                                                                                onclick="goToWebPage('{{ route('productDescription') }}')"
                                                                                class="cool-link-nav8-11">商品説明マスタ</a></div>
                                                                        @endif
                                                                    </div>
                                                                </li>
                                                            @endif
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
                                                <div class="parent-nav-list" style="padding: 5px 5px 0px;">
                                                        <ul class="stander">
                                                            @if (true)
                                                                <li>
                                                                    <a id="megamenu_li9" class="megamenu_li" href="#">
                                                                        <i class="fa fa-tasks" aria-hidden="true"></i>
                                                                        実績照会
                                                                        <span class="fa fa-plus change-icon"
                                                                            style="float: right;"></span>
                                                                    </a>
                                                                    <div id="hover_submenu9">
                                                                        @if (isset($check['09-01']) && $check['09-01'] == 'GO')
                                                                        {{-- <div class="custom-menu-list">
                                                                            <a href="#" class="cool-link-nav9-1">全社実績一覧
                                                                            </a>
                                                                          </div> --}}
                                                                        @endif
                                                                        @if (isset($check['09-02']) && $check['09-02'] == 'GO')
                                                                        {{-- <div class="custom-menu-list">
                                                                            <a href="#"
                                                                                class="cool-link-nav9-2">部門実績一覧</a>
                                                                              </div> --}}
                                                                        @endif
                                                                        @if (isset($check['09-03']) && $check['09-03'] == 'GO')
                                                                        {{-- <div class="custom-menu-list">
                                                                            <a href="#"
                                                                                class="cool-link-nav9-3">営業担当実績一覧</a>
                                                                              </div> --}}
                                                                        @endif
                                                                        @if (isset($check['09-04']) && $check['09-04'] == 'GO')
                                                                        {{-- <div class="custom-menu-list">
                                                                            <a href="{{ url('/farewell_SQL_statement') }}"
                                                                                class="cool-link-nav9-4">汎用データ出力</a>
                                                                              </div> --}}
                                                                        @endif
                                                                        @if (isset($check['09-05']) && $check['09-05'] == 'GO')
                                                                        {{-- <div class="custom-menu-list">
                                                                            <a href="#"
                                                                                class="cool-link-nav9-5">受注案件別進捗状況照会</a>
                                                                              </div> --}}
                                                                        @endif
                                                                        @if (isset($check['09-06']) && $check['09-06'] == 'GO')
                                                                        {{-- <div class="custom-menu-list">
                                                                            <a href="#"
                                                                                class="cool-link-nav9-6">パッケージ別受注照会</a>
                                                                              </div> --}}
                                                                        @endif
                                                                    </div>
                                                                </li>
                                                            @endif
                                                        </ul>
                                                    </div>
                                                </div>
                                                <!-- menu9 end -->
                                                <!-- menu10 start -->
                                                <div class="col-md-3">
                                                <div class="parent-nav-list" style="padding: 5px 5px 0px;">
                                                        <ul class="stander">
                                                            @if (true)
                                                                <li>
                                                                    <a id="megamenu_li10" class="megamenu_li" href="#">
                                                                        <i class="fa fa-folder-open"
                                                                            aria-hidden="true"></i>
                                                                        サポート
                                                                        <span class="fa fa-plus change-icon"
                                                                            style="float: right;"></span>
                                                                    </a>
                                                                    <div id="hover_submenu10">
                                                                        @if (isset($check['10-01']) && $check['10-01'] == 'GO')
                                                                        <div class="custom-menu-list">
                                                                            <a id="inhouseEntryReload"
                                                                                onclick="goToWebPage('{{ route('inhouseEntry') }}')"
                                                                                href="#"
                                                                                class="cool-link-nav10-1">内作調整入力</a>
                                                                              </div>
                                                                        @endif
                                                                        @if (isset($check['10-02']) && $check['10-02'] == 'GO')
                                                                        <div class="custom-menu-list">
                                                                            <a id="purchaseResultListReload"
                                                                                onclick="goToWebPage('{{ route('purchaseResultList') }}')"
                                                                                href="#"
                                                                                class="cool-link-nav10-1">外注仕入実績一覧</a>
                                                                              </div>
                                                                        @endif

                                                                        @if (isset($check['10-03']) && $check['10-03'] == 'GO')
                                                                        <div class="custom-menu-list">
                                                                            <a id="manPowerManagementDataCreation"
                                                                                onclick="goToWebPage('{{ route('manPowerManagementDataCreation') }}')"
                                                                                href="#"
                                                                                class="cool-link-nav10-1">工数管理データ作成</a>
                                                                              </div>
                                                                        @endif
                                                                        <!--  <a href="#" class="cool-link-nav10-3">内作調整履歴一覧・照会</a> -->
                                                                        <!-- <a href="#"
                                                                           class="cool-link-nav10-2">工数管理データ作成</a> -->
                                                                        <!-- <a href="#" class="cool-link-nav10-3">サポート入力</a> -->
                                                                    </div>
                                                                </li>
                                                            @endif
                                                        </ul>
                                                    </div>
                                                </div>
                                                <!-- menu10 end -->
                                                <!-- menu11 start -->
                                                <div class="col-md-3">
                                                <div class="parent-nav-list" style="padding: 5px 5px 0px;">
                                                        <ul class="stander">
                                                            @if (true)
                                                                <li>
                                                                    <a id="megamenu_li11" class="megamenu_li" href="#">
                                                                        <i class="fa fa-tasks" aria-hidden="true"></i>
                                                                        その他
                                                                        <span class="fa fa-plus change-icon"
                                                                            style="float: right;"></span>
                                                                    </a>
                                                                    <div id="hover_submenu11">
                                                                        @if (isset($check['11-01']) && $check['11-01'] == 'GO')
                                                                        <div class="custom-menu-list">
                                                                            <a href="#" id="lBookReload"
                                                                                onclick="goToWebPage('{{ route('lBook') }}')"
                                                                                class="cool-link-nav11-1">書類保管L-BOOK</a>
                                                                              </div>
                                                                        @endif
                                                                        @if (isset($check['11-02']) && $check['11-02'] == 'GO')
                                                                        {{-- <div class="custom-menu-list">
                                                                            <a href="#"
                                                                                class="cool-link-nav11-2">顧客情報登録（L-INFO)</a>
                                                                        </div> --}}
                                                                        @endif
                                                                        @if (isset($check['11-03']) && $check['11-03'] == 'GO')
                                                                        {{-- <div class="custom-menu-list">
                                                                            <a href="#"
                                                                                class="cool-link-nav11-3">考課システム　データ作成
                                                                            </a>
                                                                          </div> --}}
                                                                        @endif
                                                                        @if (isset($check['11-04']) && $check['11-04'] == 'GO')
                                                                          <div class="custom-menu-list">
                                                                            <a href="#" id="dashboardCommentReload"
                                                                                onclick="goToWebPage('{{ route('dashboardComment') }}')"
                                                                                class="cool-link-nav8-5">インフォメーション</a>
                                                                              </div>
                                                                        @endif
                                                                        <!-- <a href="#"
                                                                           class="cool-link-nav11-10">仕訳データ作成</a> -->
                                                                        <!-- <a href="{{ url('/dashboard_comments') }}" class="cool-link-nav11-4">インフォメーション</a> -->
                                                                        @if (isset($check['11-07']) && $check['11-07'] == 'GO')
                                                                        <div class="custom-menu-list">
                                                                            <a href="#" id="specifyOrderEntryReload"
                                                                                onclick="goToWebPage('{{ route('specifyOrderEntry') }}')"
                                                                                class="cool-link-nav11-1">受注入力可否指定</a>
                                                                              </div>
                                                                        @endif
                                                                        @if (isset($check['11-08']) && $check['11-08'] == 'GO')
                                                                        {{-- <div class="custom-menu-list">
                                                                            <a href="#"
                                                                                class="cool-link-nav11-5">組織変更</a>
                                                                        </div> --}}
                                                                        @endif
                                                                        @if (isset($check['11-09']) && $check['11-09'] == 'GO')
                                                                            <div class="custom-menu-list">
                                                                            <a href="#" id="allAccountingDataCreationReload"
                                                                                onclick="goToWebPage('{{ route('allAccountingDataCreation')}}')"
                                                                                class="cool-link-nav11-6">会計データ作成</a>
                                                                            </div>
                                                                        @endif
                                                                        @if (isset($check['11-10']) && $check['11-10'] == 'GO')
                                                                          <div class="custom-menu-list">

                                                                            <a href="#" onclick="goToWebPage('{{ route('grossProfitAdjustmentInput') }}')"
                                                                                class="cool-link-nav11-7">粗利調整入力
                                                                              </a>
                                                                          </div>
                                                                        @endif
                                                                        @if (isset($check['11-11']) && $check['11-11'] == 'GO')
                                                                        <div class="custom-menu-list">
                                                                            <a href="#"
                                                                                onclick="goToWebPage('{{ route('authority_setting') }}')"
                                                                                class="cool-link-nav11-8">権限設定</a>
                                                                              </div>
                                                                        @endif
                                                                        @if (isset($check['11-12']) && $check['11-12'] == 'GO')
                                                                        {{-- <div class="custom-menu-list">
                                                                            <a href="#"
                                                                                class="cool-link-nav11-9">フラグ変更処理</a>
                                                                              </div> --}}
                                                                        @endif
                                                                        @if (isset($check['11-13']) && $check['11-13'] == 'GO')
                                                                        <div class="custom-menu-list">
                                                                            <a href="#"
                                                                                onclick="goToWebPage('{{ route('query.show') }}')"
                                                                                class="cool-link-nav11-9">データベース</a>
                                                                              </div>
                                                                        @endif
                                                                        <!--  <a href="#" class="cool-link-nav11-10">月次更新</a> -->
                                                                    </div>
                                                                </li>
                                                            @endif
                                                        </ul>
                                                    </div>
                                                </div>
                                                <!-- menu11 end -->
                                                <div class="col-md-3" style="margin-bottom: 30px;">
                                                <div class="parent-nav-list" style="padding: 5px 10px 50px !important;">
                                                        <ul class="stander" style="border-bottom: 1px solid #1E4E9B !important;">
                                                            <li>
                                                                <a class="logout" href="#" onclick="goLogout();">
                                                                    <i class="fas fa-sign-out-alt"></i>ログアウト
                                                                </a>
                                                                <div id="hover_submenu"></div>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- 3rd row menu  -->
                                            <!-- 4th row menu start -->
                                            <div class="row">
                                            </div>
                                            <!-- 4th row menu end -->
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class=" col-lg-12 col-sm-12 col-md-12 hidden_display">
                    <div class="nav_midd_hidden"><span class="display-span">@yield('menu')</span></div>
                </div>
            </div>
        </div>
    </header>
    <section class="fixed-container">
        <div class="page-head-section">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <div class="page-head">
                            <ul>
                                {{-- <li><span class="display-span-test">@yield('title')</span></li> --}}
                                <li><span class="display-span-test">@yield('menu-test1')</span></li>
                                <li>@yield('menu-test3')</li>
                                <li>@yield('menu-test5')</li>
                            </ul>
                        </div>
                        <div id="confirmation_message"
                            style="display:inline-block;margin-left:30px;margin-top:4px;color: red;font-size:12px;">
                            @if (isset($backOrderConfirmation))
                                <p style="color: red;margin-bottom: 0px!important;font-size:12px!important;">
                                    {{ $backOrderConfirmation }}</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-head-section d-none">
            <div class="container">
                <div class="row">
                    <div class="col">
                        {{-- <div class="tag-line"> --}}
                        {{-- ここには、ガイドの文章が入ります。ここには、ガイドの文章が入ります。<br class="responsive res1" />ここには、ガイドの文章が入ります。ここには、ガイドの文章が入ります。<br --}}
                        {{-- class="responsive res2" />ここには、ガイドの文章が…（<span>つづきを読む</span>） --}}
                        {{-- </div> --}}
                        {{-- <div class="hover_message"></div> --}}
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<!-- ============================= moda1 2 start here ========================-->
{{-- employee_modal2 --}}
{{-- <div class="modal" data-keyboard="false" data-backdrop="static" id="" tabindex="-1" role="dialog"
  aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" style="max-width: 900px !important;" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h6 class="modal-title" id="exampleModalLabel">社員マスタ(詳細)</h6>
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
                      <a class="btn btn-info scroll" style="background-color: #3e6ec1!important;" data-toggle="modal"
                        data-target="#"><i class="fa fa-trash" style="margin-right: 7px;"></i>削除</a>
                    </td>
                    <td class="">
                      <a class="btn btn-info scroll" id="empButton3" data-toggle="modal" data-target="#employee_modal3"
                        style=""><i class="fa fa-pencil-square-o" aria-hidden="true"
                          style="margin-right: 5px;"></i>変更画面へ</a>
                    </td>
                    <td class="" style="padding-left:10px!important;">
                      <a class="btn btn-info " style=""><i class="" aria-hidden="true"
                          style="margin-right: 5px;"></i>データを戻す</a>
                    </td>
                    <td class="td_button_p">
                      <a href="#" class="btn btn-info scroll" style=""><i class="fa fa-print" aria-hidden="true"
                          style="margin-right: 5px;"></i>印刷</a>
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
                      <div class="outer_t row" style="">
                        <div class="col-lg-3 ">
                          <div class="mt_d">
                            48
                          </div>
                        </div>
                        <div class="col-9 ">
                          <div class="outer_t row" style="">
                            <div class="col-3">
                              <div class=" mt_d" style="margin-top: 5px;">社員CD<span style="color: red;">※</span></div>
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
                        <span>社員名(姓)</span>
                      </div>
                    </div>
                    <div class="col-lg-9">
                      <div class="outer_t row" style="">
                        <div class="col-lg-7 ">
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
                      <div class="outer_t row" style="">
                        <div class="col-lg-7 ">
                          <div class="mt_d">太郎</div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class=" row row_data">
                    <div class="col-lg-2">
                      <div class="margin_t ">
                        <span>給与CD</span>
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
                        <span>事業部</span>
                      </div>
                    </div>
                    <div class="col-lg-9">
                      <div class="outer row">
                        <div class="col-lg-12 ">
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
                      <div class="outer row">
                        <div class="col-lg-12 ">
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
                      <div class="outer row">
                        <div class="col-lg-12 ">
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
                      <div class="outer row">
                        <div class="col-lg-12 ">
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
                        <span>パスワード<span style="color: red;">※</span></span>
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
                        <span>(確認用)</span>
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
                        <span>権限CD
                        </span>
                      </div>
                    </div>
                    <div class="outer row" style="padding-left: 30px;">
                      <div class="col-lg-6 ">
                        <div class="mt_d pr-m-15 pl-m-15">90</div>
                      </div>
                      <div class="col-6 ">
                        <div class="mt_d pl-m-15">管理者</div>
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
                        <span>内線番号</span>
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
                        <span>メールアドレス<span style="color: red;">※</span></span>
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
                          (確認用)</span>
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
                          入力者1</span>
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
                          入力者2</span>
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
                          入力者3</span>
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
                          入力者4</span>
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
                          決裁者1
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
                          決裁者2
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
                          決裁者3
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
                          決裁者4
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
                          社員印影
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
                          権限レベル <span style="color: red;">※</span>
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
</div> --}}
<!-- ============================moda1 2 finish here ======================= -->
<!-- navbar starts here -->
<script type="text/javascript">
    $(document).ready(function() {
        // $("#sub_icon_sub1").hide();
        $('#sub_icon').click(function() {
            $("#megamenu_li").find('i').removeClass('fa fa-minus').addClass(' fa fa-plus');
        });
    });
    // .css('color', '#333')

</script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#megamenu_li').click(function() {
            $("#hover_submenu1").toggle();
            $("#megamenu_li").toggleClass("colorChange");
            $("#megamenu_li").find('i').toggleClass("fa fa-plus fa fa-minus");
        });
    });

</script>
<script type="text/javascript">
    $(document).ready(function() {
        $('.icon_div i').click(function() {
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
    $(document).ready(function() {
        $('#megamenu_li2').click(function() {
            $("#hover_submenu2").toggle();
            $("#megamenu_li2").toggleClass("colorChange");
            $("#megamenu_li2").find('i').toggleClass("fa fa-plus fa fa-minus");
        });
    });

</script>
<!-- js for menu 3 -->
<script type="text/javascript">
    $(document).ready(function() {
        $('#megamenu_li3').click(function() {
            $("#hover_submenu3").toggle();
            $("#megamenu_li3").toggleClass("colorChange");
            $("#megamenu_li3").find('i').toggleClass("fa fa-plus fa fa-minus");
        });
    });

</script>
<!-- js for menu 4 -->
<script type="text/javascript">
    $(document).ready(function() {
        $('#megamenu_li4').click(function() {
            $("#hover_submenu4").toggle();
            $("#megamenu_li4").toggleClass("colorChange");
            $("#megamenu_li4").find('i').toggleClass("fa fa-plus fa fa-minus");
        });
    });

</script>
<!-- js for menu 5 -->
<script type="text/javascript">
    $(document).ready(function() {
        $('#megamenu_li5').click(function() {
            $("#hover_submenu5").toggle();
            $("#megamenu_li5").toggleClass("colorChange");
            $("#megamenu_li5").find('i').toggleClass("fa fa-plus fa fa-minus");
        });
    });

</script>
<!-- js for menu 6 -->
<script type="text/javascript">
    $(document).ready(function() {
        $('#megamenu_li6').click(function() {
            $("#hover_submenu6").toggle();
            $("#megamenu_li6").toggleClass("colorChange");
            $("#megamenu_li6").find('i').toggleClass("fa fa-plus fa fa-minus");
        });
    });

</script>
<!-- js for menu 7 -->
<script type="text/javascript">
    $(document).ready(function() {
        $('#megamenu_li7').click(function() {
            $("#hover_submenu7").toggle();
            $("#megamenu_li7").toggleClass("colorChange");
            $("#megamenu_li7").find('i').toggleClass("fa fa-plus fa fa-minus");
        });
    });

</script>
<!-- js for menu 8 -->
<script type="text/javascript">
    $(document).ready(function() {
        $('#megamenu_li8').click(function() {
            $("#hover_submenu8").toggle();
            $("#megamenu_li8").toggleClass("colorChange");
            $("#megamenu_li8").find('i').toggleClass("fa fa-plus fa fa-minus");
        });
    });

</script>
<!-- js for menu 9 -->
<script type="text/javascript">
    $(document).ready(function() {
        $('#megamenu_li9').click(function() {
            $("#hover_submenu9").toggle();
            $("#megamenu_li9").toggleClass("colorChange");
            $("#megamenu_li9").find('i').toggleClass("fa fa-plus fa fa-minus");
        });
    });

</script>
<!-- js for menu 10 -->
<script type="text/javascript">
    $(document).ready(function() {
        $('#megamenu_li10').click(function() {
            $("#hover_submenu10").toggle();
            $("#megamenu_li10").toggleClass("colorChange");
            $("#megamenu_li10").find('i').toggleClass("fa fa-plus fa fa-minus");
        });
    });

</script>
<!-- js for menu 11 -->
<script type="text/javascript">
    $(document).ready(function() {
        $('#megamenu_li11').click(function() {
            $("#hover_submenu11").toggle();
            $("#megamenu_li11").toggleClass("colorChange");
            $("#megamenu_li11").find('i').toggleClass("fa fa-plus fa fa-minus");
        });
    });

</script>
<!-- js for menu 12 -->
<script type="text/javascript">
    $(document).ready(function() {
        $('#megamenu_li12').click(function() {
            $("#hover_submenu12").toggle();
            $("#megamenu_li12").toggleClass("colorChange");
            $("#megamenu_li12").find('i').toggleClass("fa fa-plus fa fa-minus");
        });
    });

</script>
<!-- js for menu 13 -->
<script type="text/javascript">
    $(document).ready(function() {
        $('#megamenu_li13').click(function() {
            $("#hover_submenu13").toggle();
            $("#megamenu_li13").toggleClass("colorChange");
            $("#megamenu_li13").find('i').toggleClass("fa fa-plus fa fa-minus");
        });
    });

</script>
<!-- js for menu 13 -->
<script type="text/javascript">
    $(document).ready(function() {
        $('#megamenu_li14').click(function() {
            $("#hover_submenu14").toggle();
            $("#megamenu_li14").toggleClass("colorChange");
            $("#megamenu_li14").find('i').toggleClass("fa fa-plus fa fa-minus");
        });
    });

</script>
{{-- <script src="{{ asset('js/jquery-3.4.1.min.js') }}"></script> --}}
{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> --}}
<form method="post" action="" id="navbarForm">
    <input type="hidden" id="csrfForEnter" value="{{ csrf_token() }}" name="_token">
    <input type="hidden" id="time_test" value="" name="time">
    <input type="hidden" id="idBango" name="userId" value="{{ $bango }}">
</form>
<script type="text/javascript">
    function goToWebPage(page) {
        var time = new Date().getTime();
        console.log(time)
        document.getElementById("time_test").value = time;
        document.getElementById("navbarForm").action = page;
        document.getElementById("navbarForm").submit();
    }

    function goToDashBoard() {
        document.getElementById("navbarForm").action = '{{ route('login') }}';
        document.getElementById("navbarForm").submit();
    }

</script>

@include('layout.user_detail.detailViewModal')

@include('layout.user_detail.detailEditModal')

<!-- Hard reload js link -->
<script type="text/javascript">
    var fileuser_default = document.createElement("script");
    fileuser_default.type = "text/javascript";
    fileuser_default.src = "{{ asset('js/user_default.js') }}?v=" + Math.floor((Math.random() * 500) + 1);
    document.getElementsByTagName("head")[0].appendChild(fileuser_default);

</script>
<!-- Hard reload js link end -->
{{-- </body>
</html> --}}
<script>
    //Keeping the footer in the bottom dynamically
    // jQuery(function($) {
    //     var e = function() {
    //         var e = (window.innerHeight > 0 ? window.innerHeight : this.screen.height) - 5;
    //         (e -= 67) < 1 && (e = 1), e > 67 && $(".fullpage_width1").css("min-height", e + "px")
    //     };
    //     $(window).ready(e), $(window).on("resize", e);
    // });

    jQuery(function($){
          var e = function() {
              var e = (window.innerHeight > 0 ? window.innerHeight : this.screen.height) - 5;
              (e -= 229) < 1 && (e = 1), e > 224 && $(".fullpage_width1").css("min-height", e + "px")
          };
          $(window).ready(e), $(window).on("resize", e);
      });

</script>
