@section('menu-test1', 'ホーム')
@section('menu-test3', '>　'.$title.'')
@section('title', 'ホーム')
@include('dashboard.date_check_between')
<!DOCTYPE html>
<html lang="ja">
<head>
<title>@yield('title')</title>
<meta charset="utf-8">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="msapplication-tap-highlight" content="no">
{{--<link rel="icon" href="{{url('img')}}/logoicon.png" type="image/png"> --}}
<link rel="icon" href="{{url('img')}}/logoicon.png" type="image/png" id="faviconInage">
<link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}">
<link href="https://use.fontawesome.com/releases/v5.0.4/css/all.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
<link rel="stylesheet" type="text/css" href="{{ asset('css/navbar_styles.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/pagination_styles.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/login_styles.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/modal_styles.css') }}">

<link rel="stylesheet" type="text/css" href="{{ asset('css/test_styles.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/test_styles_fixed.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/test_nav_new_styles_fixed.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/test_nav_new_styles.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/test_navbar_styles.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/test_modal_styles.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/test_new_styles.css') }}">

<link rel="stylesheet" type="text/css" href="{{ asset('css/datepicker.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/select2.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/custom_checkbox_radio.css') }}">

<!-- Hard reload css link -->
</head>

<body class="common-nav" style="overflow-x:visible;">

  @include('layout.nav_fixed')

  <style type="text/css">
    .container {
      max-width: 1140px !important;
    }

    .fullpage_width1{
      margin-top: 0 !important;
    }

    .content-head-section{
    	padding: 0;
      min-height: 0;
    }

    .content-head-section1{
    	margin-top: 135px
    }

    .tag-line{
      display: none;
    }

    .page-top-title{
      margin: 108px 0 25px;
      padding-bottom: 15px;
      border-bottom: 1px solid #2C66B5;
      margin-bottom: 30px;
      overflow: hidden;
    }

    .page-top-title ul{
      margin: 0;
      padding: 0;
    }

    .page-top-title ul li{
      list-style: none;
      float: left;
      padding-right: 30px;
      color: #2C66B5;
      font-size: 16px;
      font-weight: bold;
      letter-spacing: 1px;
    }

    .page-top-title ul li:last-child{
      padding-right: 0;
    }

    .page-top-title ul li a{
      padding: 0;
    }

    .page-top-title ul li a:hover{
      text-decoration: none;
    }

    .btn-dashboard{
      border-radius: 30px !important;
      font-size: 12px;
      line-height: 21px;
    }

    .page-date-line{
      font-size: 12px;
      font-weight: 700;
      margin-bottom: 13px;
      color: #1b1b1b;
    }

    .dashbord-table > tbody > tr > td{
      border: 0 !important;
      border-bottom: 1px solid #dee2e6 !important;
      padding: 5px 0 !important;
    }

    .dashbord-table > tbody > tr > td > a:hover{
      text-decoration: none;
      color: #17252a;
    }

    .table-td-new{
      background: #FF0000;
      padding: 0 5px;
      color: #fff;
      margin-left: 8px;
    }
		@media (max-width: 1800px){

.inner-top-content {
  margin-top: 183px !important;
}
}
  </style>

  <!--/.navbar-->


  <!-- partial -->

  <section>
    <div class="fullpage_width1">

      <div class="content-head-section1 inner-top-content">
        <div class="container">
          <div class="row">
            <div class="col">
              <div class="page-top-title">
              	<ul>
                 @if($notice_id == 1)
                 <li><a href="{{ route('notice',['id'=>1,'bango'=>$bango]) }}" style="color: #2C66B5;">LAMUシステムに関するお知らせ</a></li>
                 <li>|</li>
                 <li><a href="{{ route('notice',['id'=>2,'bango'=>$bango]) }}" style="color: #4591EE;">その他のお知らせ</a></li>
                 @else
                 <li><a href="{{ route('notice',['id'=>1,'bango'=>$bango]) }}" style="color: #4591EE;">LAMUシステムに関するお知らせ</a></li>
                 <li>|</li>
                 <li><a href="{{ route('notice',['id'=>2,'bango'=>$bango]) }}" style="color: #2C66B5;">その他のお知らせ</a></li>
                 @endif
                </ul>
              	<div class="float-right">
              		<a href="#" onclick="goToDashBoard()" class="btn bg-default text-white btn-dashboard">戻る</a>
              	</div>
              </div>
            </div>
          </div>

          @foreach($years as $year)
          <div class="row">
            <div class="col">
              <div class="page-date-line">
              	{{ $year->year }}年
              </div>

              <table class="table dashbord-table" style="margin-bottom: 30px!important;">
                <tbody>
                  @foreach($dashboardCommentNotice as $dashboardCommentNoticeInfo)
                  @if($year->year == $dashboardCommentNoticeInfo->year)
                  <tr>
                    <td>{!! $dashboardCommentNoticeInfo->created_date !!}</td>
                    <td><a href="{{route('noticeDetail',['id'=>$dashboardCommentNoticeInfo->syouhinbango,'notice_id'=>$dashboardCommentNoticeInfo->yukouflag,'bango'=>$bango])}}" target="_blank">{!! $dashboardCommentNoticeInfo->sitesyubetsu !!}</a>
                      <?php
                        $date_pre = strtotime(date('d-m-Y',strtotime('-2 week')));
                        $date_post = strtotime(date('d-m-Y'));
                        $target_date = strtotime($dashboardCommentNoticeInfo->created_date);
                        $date_exist = date_check_between($date_pre,$target_date,$date_post);
                      ?>
                    @if($date_exist)
                    <span class="table-td-new">New</span>
                    @endif
                    </td>
                  </tr>
                  @endif
                  @endforeach

                </tbody>
              </table>
            </div>
          </div>
          @endforeach

        </div>
      </div>
    </div>

  </section>

  {{-- Navbar Starts Here --}}
  @include('layout.footer_new')
  {{-- Navbar Ends Here --}}

      <!-- Including Common Footer Links Starts Here -->
      @include('layouts.footer')
    <!-- Including Common Footer Links Ends Here -->
  <!--Bootstrap 4.x-->
  <script src="  {{ asset('js/bootstrap.min.js') }}"></script>
  <!--Jquery Map for mac operating system-->
  <script src=" {{ asset('js/select2.min.js') }}"></script>

</body>

</html>
