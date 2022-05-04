
@section('title', '買掛残高更新')
@section('menu-test1', 'ホーム >')
@section('menu-test3', '仕入 >')
@section('menu-test5', '買掛残高更新')
<!DOCTYPE html>
<html lang="ja">

<head>
  {{-- Including Common Header Links Start Here --}}
  @include('layouts.header')
  {{-- Including Common Header Links End Here--}}
  @include('purchase.accountBalanceUpdate.styles')
</head>



<body style="overflow-x:visible;" class="common-nav">
  <section>
    {{-- Navbar Starts Here --}}
    @include('layout.nav_fixed')
    {{-- Navbar Ends Here --}}
    @include('layout.custom_checkbox')
    <div class="fullpage_width1" data-bind="nextFieldOnEnter:true">
      <div class="content-head-section" style="padding: 13px 0 0;">
        <div class="container  position-relative">
          <div class="error-div">
          
            @if(Session::has('success_msg'))
            @php
            $success_msg = session()->get('success_msg');
            @endphp
            <div class="row success-msg-box " id="session_msg" style="position: relative; z-index: 1;" >
              <div class="col-12">
                <div class="alert alert-primary alert-dismissible">
                  <button type="button" class="close dismissAlertMessage"  data-dismiss="alert" autofocus onclick="$('#categorikanri').focus();">
                  &times;</button>
                  <strong>{{$success_msg}}</strong>
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
      {{-- First Part starts here --}}
      @include('purchase.accountBalanceUpdate.accountBalanceUpdateTopSearch')
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

  {{-- Including Common Footer Links Start Here --}}
  @include('layouts.footer')
  {{-- Including Common Footer Links End Here --}}
  
  {{-- Including Scripts Starts Here --}}
  @include('purchase.accountBalanceUpdate.script')
 {{-- Including Scripts Ends Here --}}
 
  <!-- Hard reload js link -->
  <script type="text/javascript">
    var fileord1 = document.createElement("script");
      fileord1.type = "text/javascript";
      fileord1.src = "{{ asset('js/purchase/account_balance_update/accountBalanceUpdate.js') }}?v=" + Math.floor((Math.random() * 500) + 1);
      document.getElementsByTagName("head")[0].appendChild(fileord1);
  </script>
 
</body>

</html>