<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="utf-8">
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="msapplication-tap-highlight" content="no">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
  <title>LAMUログイン</title>
  <link rel="icon" href="{{url('img')}}/logoicon.png" type="image/png" id="faviconInage">
  <link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap.min.css')}}">
  <link href="https://use.fontawesome.com/releases/v5.0.4/css/all.css" rel="stylesheet">

  <style>
    body {
      font-family: "Roboto", sans-serif;
      font-size: 13px;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh !important;
    }

    .field-icon {
      float: right;
      position: absolute;
      z-index: 2;
      right: 4px;
      top: 6px;
    }

    h3.sec-title {
      font-size: 22px;
    }

    .signin-wrapper {
      box-shadow: 0 0px 3px rgba(0, 0, 0, 0.19), 0 1px 2px rgba(0, 0, 0, 0.23);
    }

    .register-bg {
      background: #01509E;
    }

    .signin-box .form-control {
      border: 1px solid #E1E1E1 !important;
      font-size: 13px;
      border-radius: 4px !important;
    }

    .signin-box .form-control:focus {
      border-color: #01509E;
      /*    box-shadow: none;*/
    }

    .signin-box .btn {
      background: #01509E;
      color: #fff;
      font-size: 14px;
      border-radius: 4px !important;
    }

    .signin-box .btn:hover {
      background: #398BF7;
    }

    .signup-box {
      padding: 95px 0px;
    }

    .login-area {
      /* position: fixed; */
    }

    .nav_right {
      display: none;
    }

    .login-area .bg-white {
      background: #fff !important;
    }

    .heading {
      border-bottom: 1px solid rgba(255, 255, 255, 0.2);
    }

    h2.sec-title {
      font-size: 22px;
    }

    .heading {
      border-bottom: 2px solid #01509E;
    }

    .parent-row {
      width: 380px;
      margin: 0 auto;
    }


    header {
      top: 0;
      width: 100%;
      position: fixed;
      z-index: 999;
      background: #353A81;
      border-bottom: 5px solid #2C66B5;
    }

    .nav_left {
      width: 40%;
      float: left;
    }

    h1.navbar-brand a {
      color: white;
    }

    .footer-wrapper {
      width: 100%;
      border-bottom: 5px solid #2C66B5;
      z-index: 10;
      text-align: center;
      padding: 15px 0px 0px;
      position: absolute;
      bottom: 0;
    }

    .footer-wrapper p {
      font-size: 10px;
      color: #999;
      margin: 0;
      border-bottom: 5px solid #eeeeee;
      padding-bottom: 10px;
    }

    .btn {
      padding: 0 0.75rem;
      line-height: 26px;
    }

    .footer-wrapper img {
      height: 27px;
      margin-bottom: 12px;
    }

    .signin-box .form-control {
      border: 1px solid #E1E1E1 !important;
      font-size: 13px;
      border-radius: 4px !important;
    }

    .form-control:not(textarea) {
      padding: 0 !important;
      height: 28px !important;
    }

    @media (max-width: 1800px) and (min-width: 280px) {
      .footer-wrapper {
        /* min-width: 1140px; */
      }
    }

    .container {
      max-width: 1140px !important;
    }

    @media only screen and (max-width: 1200px) {
      .login-area {
        /* padding-top: 75px; */
      }
    }

    @media (max-width: 1800px) and (min-width: 280px) {
      .fullpage_width1 {
        /* margin-top: 140px; */
        /* min-width: 1140px; */
      }
    }
  </style>

</head>

<body style="overflow-x: hidden !important;">

  <!-- header -->
  <header id="navigation" class="navbar-fixed-top animated-header">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-12 pr-0">
          <div class="nav_left">
            <div class="navbar-header">
              <h1 class="navbar-brand no-padding">
                <span>
                  <a href="#">
                    <img style="margin-top: 4px;" src="{{url('img')}}\test_logo.png" style="padding-top: 10px;" width="94" height="20" alt="">
                  </a>
                </span>
              </h1>
            </div>
          </div>
        </div>
      </div>
    </div>
  </header>
  <!-- header  end-->

  {{-- Main Content Starts Here --}}
  <div class="fullpage_width1" data-bind="nextFieldOnEnter:true">
    <div class="login-area" style="overflow: visible;">
      <div class="container">
        <div class="parent-row">
          <form action="{{route('login')}}" method="POST" id="loginForm" class="form-horizontal" role="form">
            <input type="hidden" id="csrf" value="{{csrf_token()}}" name="_token" disabled>
            <div class="signin-wrapper signin-box bg-white pt-5 pb-5 pr-5 pl-5">
              <div class="heading pb-3">
                <h3 class="sec-title mb-0"><strong>ログイン</strong></h3>
              </div>
              <div class="signin-box pt-3 pb-3">
                <label>ID</label>
                <input type="text" class="form-control rounded-0 mb-3" maxlength="70" name="mail" autofocus>
                <label>パスワード</label>
                <div style="position: relative;">
                  <input class="form-control" type="password" minlength="6" maxlength="8" name="password" id="password-field" style="position: relative;">
                  <span toggle="#password-field" class="fa fa-fw field-icon toggle-password fa-eye" style="display: none;cursor:pointer;"></span>
                </div>
                <button href="#" type="submit" class="btn btn-block mb-4 mt-3 rounded-0" onclick="submitLogin();">
                  <i class="fas fa-sign-in-alt"></i>&nbsp;ログイン
                </button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  {{-- @include('layout.footer_new') --}}
  {{-- Main Content Ends Here --}}

  {{-- Footer Starts Here --}}
  <div class="footer-wrapper">
    <div>
      <img src="{{url('img')}}\footerlogo.png" alt="Footer Logo">
    </div>
    <p>All Rights Reserved.Copyright© USAC SYSTEM CO.LTD.</p>
  </div>
  {{-- Footer Ends Here --}}


  {{-- <script src=" {{ asset('js/jquery-3.4.1.min.js') }}"></script> --}}
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src=" {{ asset('js/bootstrap.min.js') }}"></script>

  {{-- Knockout - Enter to New Input Starts Here --}}
  @include('master.common.knockout')
  {{-- Knockout - Enter to New Input Ends Here --}}

  <script type="text/javascript">
    // Disable opening new browser window when Shift+Enter is pressed and logging in in the same tab.
    $("input, button").keydown(function(e){
      if (e.shiftKey && e.which == 13) {
        e.preventDefault(); // stop opening new window
        submitLogin(); // submit form to login
      }
    });

    // Submit Login Form
    function submitLogin() {
      document.getElementById('csrf').disabled = false;
      document.getElementById("loginForm").submit();
    }

    // Password Show/Hide
    $("#password-field").keyup(function () {
      if ($(this).val()) {
        $(".toggle-password").show();
      }
      else {
        $(".toggle-password").hide();
      }
    });

    $(".toggle-password").click(function () {
      $(this).toggleClass("fa-eye fa-eye-slash");
      var input = $($(this).attr("toggle"));
      if (input.attr("type") == "password") {
        input.attr("type", "text");
      } else {
        input.attr("type", "password");
      }
    });
    function test()
    {
      
    }

  </script>
  {{-- <script type="text/javascript">
    jQuery(function($){
      var e = function() {
          var e = (window.innerHeight > 0 ? window.innerHeight : this.screen.height) - 5;
          (e -= 224) < 1 && (e = 1), e > 224 && $(".fullpage_width1").css("min-height", e + "px")
      };
      $(window).ready(e), $(window).on("resize", e);
  });
  </script> --}}
</body>

</html>