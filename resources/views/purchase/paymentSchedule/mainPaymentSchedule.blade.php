
@section('title', '支払予定一覧')
@section('menu-test1', 'ホーム >')
@section('menu-test3', '仕入 >')
@section('menu-test5', '支払予定一覧')
@section('tag-test', 'ここは、ガイドの文章が入ります。')
<!DOCTYPE html>
<html lang="ja">

<head>
  {{-- Including Common Header Links Start Here --}}
  @include('layouts.header')
  {{-- Including Common Header Links End Here--}}
  @include('purchase.paymentSchedule.styles')
</head>



<body style="overflow-x:visible;" class="common-nav">
  <section>
    {{-- Navbar Starts Here --}}
    @include('layout.nav_fixed')
    {{-- Navbar Ends Here --}}
    @include('layout.custom_checkbox')
    <div class="fullpage_width1" data-bind="nextFieldOnEnter:true">
      {{-- First Part starts here --}}
      @include('purchase.paymentSchedule.paymentScheduleTopSearch')
      {{-- First Part Ends here --}}
     {{-- Second Part starts here --}}
     @include('purchase.paymentSchedule.paymentScheduleMainContent')
     {{-- Second Part Ends here --}}

    </div>
    {{-- Footer Starts Here --}}
    @include('layout.footer_new')
    {{-- Footer Ends Here --}}
  </section>
  <!-- Supplier Modal start here -->
  @include('common.supplierModal_2')
  <!-- Supplier Modal end here -->

  <!-- Table Header Settings Modal Starts Here -->
  @include('master.common.table_settings_modal')
  <!-- Table Header Settings Modal Ends Here -->

  {{-- Including Common Footer Links Start Here --}}
  @include('layouts.footer')
  {{-- Including Common Footer Links End Here --}}
  {{-- common.js link include starts here --}}
  @include('layouts.common_js')
  {{-- common.js link include ends here --}}
  {{-- Including Scripts Starts Here --}}
  @include('purchase.paymentSchedule.script')
 {{-- Including Scripts Ends Here --}}
  <!-- Hard reload js link -->
  <script type="text/javascript">
      var filepaymentschedule = document.createElement("script");
      filepaymentschedule.type = "text/javascript";
      filepaymentschedule.src = "{{ asset('js/purchase/paymentSchedule/paymentSchedule.js') }}?v=" + Math.floor((Math.random() * 500) + 1);
      document.getElementsByTagName("head")[0].appendChild(filepaymentschedule);
  </script>
  <!-- Hard reload js link end -->
  <script>
      $(document).ready(function () {
          $('#openSettingModal').attr('onclick', "showTableSettingPaymentSchedule('{{route('paymentScheduleTableSetting',$bango)}}')");
          var key_type= {{isset($fsReqData['rd1'])?$fsReqData['rd1']:3}}
          $('#tableSetting').append('<input type="hidden" name="key_type" value="'+key_type+'">')
      });
  </script>
</body>

</html>
