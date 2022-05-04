@section('menu-test1', 'ホーム')
@section('menu-test3', '> '.$title.'')
@section('menu-test5', '> 詳細')
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

    .btn-dashboard{
      border-radius: 30px !important;
      font-size: 12px;
      line-height: 21px;
    }

    .page-top-title{
    	margin: 108px 0 25px;
      font-size: 16px;
	    color: #2C66B5;
	    font-weight: bold;
	    letter-spacing: 1px;
	    padding-bottom: 15px;
	    border-bottom: 1px solid #2C66B5;
	    margin-bottom: 30px;
    }

    /* .page-date-line, */
    .page-main-content{
    	/* border-bottom: 1px solid #dee2e6; */
    	margin-bottom: 70px;
    }

    .page-date-line .date{
    	font-size: 12px;
    	font-weight: 700;
    	margin-bottom: 13px;
    	color: #1b1b1b;
    }

    .page-date-line .date span{
    	background: #FF0000;
      padding: 0 5px;
      color: #fff;
      margin-left: 8px;
    }

    .page-date-line .line{
    	font-size: 15px;
    	font-weight: 700;
    	letter-spacing: .8px;
    	margin-bottom: 10px;
    }

    .header-line{
      font-size: 15px;
    	font-weight: 700;
    	letter-spacing: .8px;
    	color: #1b1b1b;
    	margin-bottom: 15px;
		text-align:left!important;
    }

    .header-line span{
    	font-size: 12px;
      color: red;
      margin-left: 30px;
      font-weight: 400;
    }

    /* .page-main-content{
    	padding-bottom: 15px;
    } */

    .main-content-img img{
    	margin-bottom: 15px;
    }

    .main-content-img .fig-title{
    	font-size: 10px;
    	color: #666;
    }

    .main-content ul{
    	margin: 0;
    	padding: 0;
    }

    .main-content ul li{
    	list-style: none;
    	padding-bottom: 8px;
    	color: #777;
    }

    .main-content-bottom{
    	margin-bottom: 130px;
    }

    .bottom-content ul{
    	margin: 0;
    	padding: 0;
    }

    .bottom-content ul li{
    	list-style: none;
    	padding-bottom: 8px;
    	color: #555;
    	font-size: 13px;
    }

    .bottom-content ul li i{
    	color: #2C66B5;
    }
		/* .main-content p{
			line-height: 70px;
		} */
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
								その他のお知らせ 詳細
              	<div class="float-right">
									@if($notice_id == 1)
              		<a href="{{ route('notice',['id'=>1,'bango'=>$bango]) }}" class="btn btn-info btn-dashboard">一覧へ</a>
									@else
              		<a href="{{ route('notice',['id'=>2,'bango'=>$bango]) }}" class="btn btn-info btn-dashboard">一覧へ</a>
									@endif
              		<a href="#" onclick="goToDashBoard()" class="btn bg-default text-white btn-dashboard">戻る</a>
              	</div>
              </div>
            </div>
          </div>

					<?php
						$data_found = 0;
						$x = 0;
					?>
					@foreach($dashboardCommentLowerData as $dashboardCommentDetailInfo)
					<?php
					if($dashboardCommentDetailInfo->syouhinbango == $id){
						$data_found = 1;
					}
					if($data_found == 0){
						continue;
					}
					$x++;
					if($x>5){
						break;
					}
					?>
          <div class="row">
            <div class="col">
              <div class="page-date-line">
              	<div class="date">
              		{!! $dashboardCommentDetailInfo->created_date !!}
                  <?php
                    $date_pre = strtotime(date('d-m-Y',strtotime('-2 week')));
                    $date_post = strtotime(date('d-m-Y'));
                    $target_date = strtotime($dashboardCommentDetailInfo->created_date);
                    $date_exist = date_check_between($date_pre,$target_date,$date_post);
                  ?>
                  @if($date_exist)
                  <span>New</span>
                  @endif
              	</div>

              </div>
            </div>
					</div>

          <div class="row">
          	<div class="col">
          		<div class="page-main-content">



									@if($x==1 || $x==3 || $x==5)
										<div class="row">
											<div class="col-6">
												<div class="header-line">
                                                    {!! $dashboardCommentDetailInfo->sitesyubetsu !!}
												</div>
											</div>
										</div>

										<div class="row">
										<?php
										$col_width = "col-6";
										if(substr($dashboardCommentDetailInfo->hanbaimode, -4) != '.pdf'){
										$col_width = "col-6";
										?>

										{{-- When no image hide the div starts here (Added by Shamiul) --}}
										@php
											$img_src = "{$dashboardCommentDetailInfo->hanbaimode}";
											$display_none = "style='display: none;'";
										@endphp
										{{-- When no image hide the div ends here --}}
										
											<div class="col-6" @php if($img_src == '') echo $display_none; @endphp>
												<div class="main-content-img">

													<img src="{{asset('uploads/other/dashboard/'.$dashboardCommentDetailInfo->hanbaimode)}}" class="img-fluid" style="width: 512px !important; height: 340px !important;">

												</div>
											</div>
											<?php } ?>
											<div class="<?php echo $col_width;?>">
												<div class="main-content" style="white-space: normal !important; word-break: break-all !important;">
													{!! $dashboardCommentDetailInfo->status !!}
													<?php
													if(substr($dashboardCommentDetailInfo->hanbaimode, -4) == '.pdf'){
														$new_hanbaimode = str_replace("_dc".$dashboardCommentDetailInfo->syouhinbango,"",$dashboardCommentDetailInfo->hanbaimode);
													?>
													<a href="{{asset('uploads/other/dashboard/'.$dashboardCommentDetailInfo->hanbaimode)}}" target="_blank">{{ $new_hanbaimode }}</a>
													<?php
													}
													?>

												</div>
											</div>
										</div>

										@else
										<div class="row">
											<div class="col-6">
												<div class="header-line  mt-4">
													{!! $dashboardCommentDetailInfo->sitesyubetsu !!}
												</div>
											</div>
										</div>

										<div class="row">
											<div class="col-6">
												<div class="main-content" style="white-space: normal !important; word-break: break-all !important;">
													{!! $dashboardCommentDetailInfo->status !!}
													<?php
													if(substr($dashboardCommentDetailInfo->hanbaimode, -4) == '.pdf'){
														$new_hanbaimode = str_replace("_dc".$dashboardCommentDetailInfo->syouhinbango,"",$dashboardCommentDetailInfo->hanbaimode);
													?>
													<a href="{{asset('uploads/other/dashboard/'.$dashboardCommentDetailInfo->hanbaimode)}}" target="_blank">{{ $new_hanbaimode }}</a>
													<?php
													}
													?>

												</div>
											</div>

											{{-- When no image hide the div starts here (Added by Shamiul) --}}
											@php
												$img_src_right = "{$dashboardCommentDetailInfo->hanbaimode}";
												$display_none = "style='display: none;'";
											@endphp
											{{-- When no image hide the div ends here --}}

											<div class="col-6" @php if($img_src_right == '') echo $display_none; echo $img_src_right; @endphp>
												<div class="main-content-img">

													<?php
													if(substr($dashboardCommentDetailInfo->hanbaimode, -4) != '.pdf'){
													?>
													<img src="{{asset('uploads/other/dashboard/'.$dashboardCommentDetailInfo->hanbaimode)}}" class="img-fluid" style="width: 512px !important; height: 340px !important;">
													<?php } ?>

												</div>
											</div>
										</div>
									@endif
			        </div>
          	</div>
          </div>
				@endforeach


        </div>
      </div>
    </div>
	{{-- Navbar Starts Here --}}
	@include('layout.footer_new')
	{{-- Navbar Ends Here --}}
  </section>
    <!-- Including Common Footer Links Starts Here -->
    @include('layouts.footer')
    <!-- Including Common Footer Links Ends Here -->
  <!--Bootstrap 4.x-->
  <script src="  {{ asset('js/bootstrap.min.js') }}"></script>
  <!--Jquery Map for mac operating system-->
  <script src=" {{ asset('js/select2.min.js') }}"></script>

</body>

</html>
