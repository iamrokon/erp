
@section('title', '工数管理データ作成')
@section('menu-test1', 'ホーム >')
@section('menu-test3', 'サポート >')
@section('menu-test5', '工数管理データ作成')
<!DOCTYPE html>
<html lang="ja">

<head>
  {{-- Including Common Header Links Start Here --}}
  @include('layouts.header')
  {{-- Including Common Header Links End Here--}}
  @include('support.manPowerManagementDataCreation.styles')
</head>



<body style="overflow-x:visible;" class="common-nav">
  <section>
    {{-- Navbar Starts Here --}}
    @include('layout.nav_fixed')
    {{-- Navbar Ends Here --}}
    @include('layout.custom_checkbox')
    <div class="fullpage_width1" data-bind="nextFieldOnEnter:true">


      <div class="content-head-section">
        <div class="container position-relative">
          <div class="error-div">
            <div id="error_data" class="common_error"></div>

            <div class="row success-msg-box d-none " id="session_msg" style="position: relative; z-index: 1;" >
              <div class="col-12">
                <div class="alert alert-primary alert-dismissible">
                  <button type="button" class="close dismissAlertMessage"  data-dismiss="alert" autofocus onclick="$('#categorikanri').focus();">
                  &times;</button>
                  <strong>success message</strong>
                </div>
              </div>
            </div>
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
                  <div id="error_data" class="common_error d-none mb-0" style="color: red;position: relative;"></div>
                </div>
              </div>
            {{-- Error Message Ends Here --}}
          </div>
          {{-- First Part starts here --}}
          @include('support.manPowerManagementDataCreation.manPowerManagementDataCreationTopSearch')
          {{-- First Part Ends here --}}
        </div>
      </div>

     {{-- Second Part starts here --}}
  
     {{-- Second Part Ends here --}}


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
  {{-- Including Scripts Starts Here --}}
  @include('support.manPowerManagementDataCreation.script')
 {{-- Including Scripts Ends Here --}}
</body>

</html>