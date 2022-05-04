@section('menu-test3', 'ホーム')
@section('title', 'ホーム')
@include('dashboard.date_check_between')
<!DOCTYPE html>
<html lang="ja">
<head>
  {{-- <link href="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.css" rel="stylesheet" /> --}}
  {{-- Including Common Header Starts Here --}}
  @include('layouts.header')
  {{-- Including Common Header Ends Here--}}
  <link href="//ajax.aspnetcdn.com/ajax/jquery.ui/1.8.9/themes/blitzer/jquery-ui.css" rel="stylesheet" type="text/css">
  {{-- <script src="{{ asset('js/jquery-3.4.1.min.js') }}"></script> --}}
  <link href="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.css" rel="stylesheet" />

  <style type="text/css">
    .owl-buttons {
      display: block;
    }

    .owl-carousel:hover .owl-buttons {
      display: block;
    }

    .owl-item {
      text-align: center;
    }

    .owl-theme .owl-controls .owl-buttons div {
      background: transparent;
      color: #869791;
      font-size: 40px;
      /* line-height: 245px; */
      margin: 0;
      display: flex;
      align-items: center;
      /*  padding: 0 60px;*/
      position: absolute;
      top: 0;
    }

    .owl-theme .owl-controls .owl-buttons .owl-prev {
      /*  left: 0;*/
      left: -70px;
      padding-left: 20px;
    }

    .owl-theme .owl-controls .owl-buttons .owl-next {
      right: -70px;
      padding-right: 20px;
    }

    .fullpage_width1{
      margin-top: 0 !important;
    }

    .content-head-section{
      padding: 0;
      min-height: 0;
    }

    .content-head-section1{
      margin-top: 180px;
    }

    .tag-line{
      display: none;
    }

    .header-line{
      margin: -10px 0 25px;
      font-size: 12px;
      color: red;
    }

    .header-line span{
      font-size: 16px;
      color: #1b1b1b;
      font-weight: bold;
      margin-right: 40px;
    }

    .content-table-title{
      font-size: 13px;
      color: #2C66B5;
      font-weight: bold;
      letter-spacing: 1px;
      padding-bottom: 5px;
      border-bottom: 1px solid #2C66B5;
      margin-bottom: 10px;
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

    .btn-dashboard{
      border-radius: 30px !important;
    }

    .slider-item {
      width: 99%;
      height: 245px;
      padding: 15px;
      border: 1px solid #dee2e6;
      margin-bottom: 55px;
      /* margin-bottom: 150px; */
    }

    @media screen and (max-width: 1370px) {
      .slider-item img{
        height : 162px !important;
        width : 243px !important;
      }
      .slider-item, .owl-prev, .owl-next {
        height: 245px!important;
        padding: 15px!important;
        margin-bottom: 55px!important;
      }
    }

    .slider-item .title {
      width: 180px;
      color: #2C66B5;
      font-size: 14px;
      margin-bottom: 20px;
    }

    .page-head ul li:first-child{
      padding-right: 0;
      display: none;
    }
    .container-box{
      width:360px;
    }
    .container-box table{
      white-space:normal;
      word-break:break-all;
    }
    @media (max-width: 1800px){

.inner-top-content {
    margin-top: 183px !important;
}
}
  </style>


</head>

<body class="common-nav"  style="overflow-x:visible;">

  {{-- Navbar Starts Here --}}
  @include('layout.nav_fixed')
  {{-- Navbar Ends Here --}}

  <!--/.navbar-->


  <!-- partial -->

  <section>
    <div class="fullpage_width1" data-bind="nextFieldOnEnter:true">

      <div class="content-head-section1 ">
        <div class="container c_container">
          <!-- show success message -->
          @if(Session::has('success_msg'))
          <div class="row mb-2">
            <div class="col-12">
              <div class="alert alert-primary alert-dismissible">
                <button type="button" class="close dismissMe" data-dismiss="alert" autofocus style="background-color: white; outline: 0;" onclick="$('.button1').focus();">
                  &times;
                </button>
                <strong>{{session()->get('success_msg')}}</strong>
              </div>
            </div>
          </div>
          @endif

          <div class="row inner-top-content">
            <div class="col">
              <div class="header-line">
                <span>インフォメーション</span>
              </div>
            </div>
          </div>

          <?php
          $i = 0;
          $j = 0;
          $k = 0;
          ?>

          <div class="row">
            <div class="col-6">
            <div class="container-box">
              <div class="content-table-title">
                LAMUシステムに関するお知らせ
              </div>
              <table class="table dashbord-table">
                <tbody>
                  @foreach($dashboardComment as $dashboardCommentInfo)
                  @if($dashboardCommentInfo->yukouflag == 1)
                  <?php
                  $i++;
                  if($i>5){
                    break;
                  }
                  ?>
                  <tr>
                    <td>{!! $dashboardCommentInfo->created_date !!}</td>

                    <td style="padding-left: 5px !important;"><a href="{{route('noticeDetail',['id'=>$dashboardCommentInfo->syouhinbango,'notice_id'=>1,'bango'=>$bango])}}" target="_blank" style="white-space: normal !important; word-break: break-all !important;">
                      {!! mb_substr(strip_tags($dashboardCommentInfo->sitesyubetsu),0,30) !!}<?php if(mb_substr(strip_tags($dashboardCommentInfo->sitesyubetsu),31)){echo "...";}?>
                    </a>
                    <?php
                      $date_pre = strtotime(date('d-m-Y',strtotime('-2 week')));
                      $date_post = strtotime(date('d-m-Y'));
                      $target_date = strtotime($dashboardCommentInfo->created_date);
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
              @if($i>5)
              <div class="mt-2">
                <a href="{{ route('notice',['id'=>1,'bango'=>$bango]) }}" target="_blank" class="btn btn-info btn-dashboard button1">もっと見る</a>
              </div>
              @endif
              </div>
            </div>

            <div class="col-6">
            <div class="container-box">
              <div class="content-table-title">
                その他のお知らせ
              </div>
              <table class="table dashbord-table">
                <tbody>
                  @foreach($dashboardComment as $dashboardCommentInfo)
                  @if($dashboardCommentInfo->yukouflag == 2)
                  <?php
                  $j++;
                  if($j>5){
                    break;
                  }
                  ?>
                  <tr>
                    <td>{!! $dashboardCommentInfo->created_date !!}</td>
                    <td style="padding-left: 5px !important;"><a href="{{route('noticeDetail',['id'=>$dashboardCommentInfo->syouhinbango,'notice_id'=>2,'bango'=>$bango])}}" target="_blank" style="white-space: normal !important; word-break: break-all !important;">
                      {!! mb_substr(strip_tags($dashboardCommentInfo->sitesyubetsu),0,30) !!}<?php if(mb_substr(strip_tags($dashboardCommentInfo->sitesyubetsu),31)){echo "...";}?>
                    </a>
                    <?php
                      $date_pre = strtotime(date('d-m-Y',strtotime('-2 week')));
                      $date_post = strtotime(date('d-m-Y'));
                      $target_date = strtotime($dashboardCommentInfo->created_date);
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
              @if($j>5)
              <div class="mt-2">
                <a href="{{ route('notice',['id'=>2,'bango'=>$bango]) }}" target="_blank" class="btn btn-info btn-dashboard">もっと見る</a>
              </div>
              @endif
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col">
              <div class="header-line mt-5">
                <span>ダッシュボード</span>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-12">
              <div id="dashboard-slider">

                @foreach($dashboardComment as $dashboardCommentInfo)
                <?php
                      $path='uploads/other/dashboard/'.$dashboardCommentInfo->hanbaimode;
                      if(file_exists($path)==false){
                          continue;
                      }
                      if(substr($dashboardCommentInfo->hanbaimode, -4) == '.pdf' || $dashboardCommentInfo->hanbaimode == ""){
                        continue;
                      }
                ?>
                <div class="item">
                  <div class="slider-item">
                  <div style="width: 180px; margin: 0 auto;">
                  {{-- <div style="width: 50%;margin: 0 25%;"> --}}
                    <div class="title text-center">
                      {!! mb_substr(strip_tags($dashboardCommentInfo->sitesyubetsu),0,14) !!}<?php if(mb_substr(strip_tags($dashboardCommentInfo->sitesyubetsu),15)){echo "...";}?>
                    </div>
                  </div>

                    <img src="{{asset('uploads/other/dashboard/'.$dashboardCommentInfo->hanbaimode)}}" class="img-fluid" alt="Slider One">
                  </div>
                </div>

                @endforeach

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  {{-- Navbar Starts Here --}}
  @include('layout.footer_new')
  {{-- Navbar Ends Here --}}

  {{--@include('layouts.footer')--}}

  <!--Bootstrap 4.x-->
  <script src="{{ asset('js/bootstrap.min.js') }}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.js"></script>
  <!--Jquery Map for mac operating system-->
  <script src="{{ asset('js/select2.min.js') }}"></script>

  <script src="https://ajax.aspnetcdn.com/ajax/knockout/knockout-2.2.1.js" type="text/javascript"></script>
  {{-- Knockout - Enter to New Input Starts Here --}}
  <script>
    ko.bindingHandlers.nextFieldOnEnter = {
        init: function (element, valueAccessor, allBindingsAccessor) {
              $(element).on('keydown', 'input, textarea, select, button, a.btn, tr.trFocus', function (e) {
            var self = $(this),
              form = $(element),
              focusable, next;
            if (e.keyCode == 13 && !e.shiftKey) {
              focusable = form.find('input:not([ignore]), select, textarea, button:not([disabled]), a.btn, tr.trFocus').filter(':visible');
              var nextIndex = focusable.index(this) == focusable.length - 1 ? 0 : focusable.index(this) + 1;
              next = focusable.eq(nextIndex);
              next.focus();
              return false;
            }
            if (e.keyCode == 9) {
              e.preventDefault();
            }
          });
        }
      };
      ko.applyBindings({});
  </script>

  <script>
    $(document).ready(function() {

      $("#dashboard-slider").owlCarousel({
       navigation : true,
       rtl:true,
       loop:true,
      navigationText : ['<span class="fa-stack"><i class="fa fa-circle fa-stack-1x"></i><i class="fa fa-chevron-circle-left fa-stack-1x fa-inverse"></i></span>','<span class="fa-stack"><i class="fa fa-circle fa-stack-1x"></i><i class="fa fa-chevron-circle-right fa-stack-1x fa-inverse"></i></span>'],
          items : 4,
          itemsDesktop : [1199,4],
          itemsDesktopSmall : [979,4],
          itemsTablet: [767,4],
          itemsMobile: [480,4]
      });

    });
  </script>

  <script>
    // Focus on Alert Closing
    $(".dismissMe").keydown(function (e) {
      if (e.keyCode == 13) {
          $('.close').alert('close');
          // event.preventDefault();
          // $(".button1").click();
      }
      $('.button1').focus();
    });
  </script>
  <!-- Cache Brusting  for common js -->
    {{-- common.js link include starts here --}}
    @include('layouts.common_js')
    {{-- common.js link include ends here --}}
</body>

</html>
