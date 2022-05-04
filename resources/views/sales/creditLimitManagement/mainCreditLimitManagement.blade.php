
@section('title', '与信限度チェック管理表')
@section('menu-test1', 'ホーム >')
@section('menu-test3', '売上請求 >')
@section('menu-test5', '与信限度チェック管理表')
<!DOCTYPE html>
<html lang="ja">

<head>
  {{-- Including Common Header Links Start Here --}}
  @include('layouts.header')
  {{-- Including Common Header Links End Here--}}
  @include('sales.creditLimitManagement.styles')
</head>



<body style="overflow-x:visible;" class="common-nav">
  <section>
    {{-- Navbar Starts Here --}}
    @include('layout.nav_fixed')
    {{-- Navbar Ends Here --}}
    @include('layout.custom_checkbox')
    <div class="fullpage_width1" data-bind="nextFieldOnEnter:true">
      {{-- First Part starts here --}}
      @include('sales.creditLimitManagement.creditLimitManagementTopSearch')
      {{-- First Part Ends here --}}
     {{-- Second Part starts here --}}
     @include('sales.creditLimitManagement.creditLimitManagementMainContent')
     {{-- Second Part Ends here --}}


    </div>
    <!-- Table Header Settings Modal Starts Here -->
    @include('master.common.table_settings_modal')
    <!-- Table Header Settings Modal Ends Here -->
    {{-- Footer Starts Here --}}
    @include('layout.footer_new')
    {{-- Footer Ends Here --}}
  </section>

  {{-- Including Common Footer Links Start Here --}}
  @include('layouts.footer')
  {{-- Including Common Footer Links End Here --}}
  {{-- Including Scripts Starts Here --}}
  @include('sales.creditLimitManagement.script')
 {{-- Including Scripts Ends Here --}}

  <!-- Hard reload js link -->
  <script type="text/javascript">
      var filecreditlimitmanagement = document.createElement("script");
      filecreditlimitmanagement.type = "text/javascript";
      filecreditlimitmanagement.src = "{{ asset('js/sales/creditLimitManagement/creditLimitManagement.js') }}?v=" + Math.floor((Math.random() * 500) + 1);
      document.getElementsByTagName("head")[0].appendChild(filecreditlimitmanagement);
  </script>
  <!-- Hard reload js link end -->
  <script>
      $(document).ready(function () {
          $('#openSettingModal').attr('onclick', "showTableSetting('{{route('creditLimitManagementTableSetting',$bango)}}')");
      });
  </script>
</body>

</html>
