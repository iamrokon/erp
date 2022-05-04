
@section('title', '支払履歴一覧')
@section('menu-test1', 'ホーム >')
@section('menu-test3', '仕入 >')
@section('menu-test5', '支払履歴一覧')
@section('tag-test', 'ここは、ガイドの文章が入ります。')
<!DOCTYPE html>
<html lang="ja">

<head>
  {{-- Including Common Header Links Start Here --}}
  @include('layouts.header')
  {{-- Including Common Header Links End Here--}}
  @include('purchase.paymentHistory.styles')
</head>



<body style="overflow-x:visible;" class="common-nav">
  <section>
    {{-- Navbar Starts Here --}}
    @include('layout.nav_fixed')
    {{-- Navbar Ends Here --}}
    @include('layout.custom_checkbox')
    <div class="fullpage_width1" data-bind="nextFieldOnEnter:true">
      {{-- First Part starts here --}}
      @include('purchase.paymentHistory.paymentHistoryTopSearch')
      {{-- First Part Ends here --}}
     {{-- Second Part starts here --}}
     @include('purchase.paymentHistory.paymentHistoryMainContent')
     {{-- Second Part Ends here --}}

    </div>
    {{-- Footer Starts Here --}}
    @include('layout.footer_new')
    {{-- Footer Ends Here --}}
  </section>

  <!-- Table Header Settings Modal Starts Here -->
  @include('master.common.table_settings_modal')
  <!-- Table Header Settings Modal Ends Here -->

  {{-- Including Common Footer Links Start Here --}}
  @include('layouts.footer')



  <!-- Hard reload js link starts here -->
  <script type="text/javascript">
    var paymentHistoryLink = document.createElement("script");
    paymentHistoryLink.type = "text/javascript";
    paymentHistoryLink.src = "{{ asset('js/purchase/paymentHistory/paymentHistory.js') }}?v=" + Math.floor((Math.random() * 500) + 1);
    document.getElementsByTagName("head")[0].appendChild(paymentHistoryLink);
  </script>
  <!-- Hard reload js link ends here -->


  {{-- Including Common Footer Links End Here --}}
  {{-- Including Scripts Starts Here --}}
  @include('purchase.paymentHistory.script')
 {{-- Including Scripts Ends Here --}}
 <script>
      $(document).ready(function () {
          $('#openSettingModal').attr('onclick', "showTableSetting('{{route('paymentHistoryTableSetting',$bango)}}')");
      });
  </script>
</body>

</html>
