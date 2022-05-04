
@section('title', '支払データ作成')
@section('menu-test1', 'ホーム >')
@section('menu-test3', '仕入 >')
@section('menu-test5', '支払データ作成')
@section('tag-test', 'ここは、ガイドの文章が入ります。')
<!DOCTYPE html>
<html lang="ja">

<head>
  {{-- Including Common Header Links Start Here --}}
  @include('layouts.header')
  {{-- Including Common Header Links End Here--}}
  @include('purchase.paymentDataCreation.styles')
</head>

<body style="overflow-x:visible;" class="common-nav">
  <section>
    {{-- Navbar Starts Here --}}
    @include('layout.nav_fixed')
    {{-- Navbar Ends Here --}}
    @include('layout.custom_checkbox')
    <form id="insertData" enctype="multipart/form-data">
    <div class="fullpage_width1" data-bind="nextFieldOnEnter:true">
      <div class="content-head-section custom-mb" style="padding: 13px 0 0;">
        <div class="container position-relative">
          <div class="error-div">
            @if (Session::has('success_msg'))
            <div class="row success-msg-box " id="session_msg" style="position: relative; z-index: 1;" >
              <div class="col-12">
                <div class="alert alert-primary alert-dismissible">
                  <button type="button" class="close dismissAlertMessage"  data-dismiss="alert" autofocus onclick="$('#categorikanri').focus();">
                  &times;</button>
                  <strong>{{ session()->pull('success_msg') }}</strong>
                </div>
              </div>
            </div>
          @endif
            <script>
              // Focus on Alert Closing
              $(".dismissMe").keydown(function(e) {
                  if (e.shiftKey && e.which == 13) {
                      $('.close').alert('close');
                      event.preventDefault();
                      document.getElementById("categorikanri").click();
                      $('#categorikanri').focus();
                  }
              });
            </script>
          
            {{-- Error Message Starts Here --}}
              <div class="row">
                <div class="col-12">
                  <div id="error_data" class="common_error mb-0"></div>
                </div>
              </div>
          </div>
          {{-- Error Message Ends Here --}}
          <input type="hidden" id="formSubmitButton" name="type" />
          <input type="hidden" id="csrf" value="{{ csrf_token() }}" name="_token">
          <input type="hidden" name="bango" id="userId" value="{{ $bango }}">
          <input type="hidden" name="userName" id="userName" value="{{$tantousya->name}}"> 
          <input type="hidden" id="confirm_status" name="confirm_status" value="0">
          <input type="hidden" name="source" value="paymentDataCreation" />
          <input id='page_name' value='paymentDataCreation' type='hidden' />
            {{-- First Part starts here --}}
            @include('purchase.paymentDataCreation.paymentDataCreationTopSearch')
            {{-- First Part Ends here --}}
          {{-- Second Part starts here --}}

          {{-- Second Part Ends here --}}
        </div>
      </div>
    </div>
    {{-- Footer Starts Here --}}
    @include('layout.footer_new')
    {{-- Footer Ends Here --}}
  </section>
  <!-- Start  modal  here-->
  <!-- end  modal  here-->

  {{-- Including Common Footer Links Start Here --}}
  @include('layouts.footer')
  {{-- Including Common Footer Links End Here --}}
  </form>
  {{-- Including Scripts Starts Here --}}
  @include('purchase.paymentDataCreation.script')
 {{-- Including Scripts Ends Here --}}
  <script type="text/javascript">
      var fileprod = document.createElement("script");
      fileprod.type = "text/javascript";
      fileprod.src = "{{ asset('js/purchase/paymentDataCreation/paymentDataCreation.js') }}?v=" + Math.floor((Math.random() * 500) + 1);
      document.getElementsByTagName("head")[0].appendChild(fileprod);
  </script>
</body>

</html>