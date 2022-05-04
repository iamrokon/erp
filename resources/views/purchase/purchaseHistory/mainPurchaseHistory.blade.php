@section('title', '仕入購入履歴一覧・仕入照会')
@section('menu-test1', 'ホーム >')
@section('menu-test3', '仕入 >')
@section('menu-test5', '仕入購入履歴一覧・仕入照会')
<!DOCTYPE html>
<html lang="ja">

<head>
  {{-- Including Common Header Links Start Here --}}
  @include('layouts.header')
  {{-- Including Common Header Links End Here--}}
  @include('purchase.purchaseHistory.styles')
</head>



<body style="overflow-x:visible;" class="common-nav">
  <section>
    {{-- Navbar Starts Here --}}
    @include('layout.nav_fixed')
    {{-- Navbar Ends Here --}}
    @include('layout.custom_checkbox')
    <div class="fullpage_width1" data-bind="nextFieldOnEnter:true">
      {{-- First Part starts here --}}
      @include('purchase.purchaseHistory.purchaseHistoryTopSearch')
      {{-- First Part Ends here --}}
     {{-- Second Part starts here --}}
     @include('purchase.purchaseHistory.purchaseHistoryMainContent')
     {{-- Second Part Ends here --}}
    <form action="{{route('purchaseHistoryInquiry')}}" method="POST" target="_blank" id="PurchaseInquiryForm">
        @csrf
        <input type="hidden" id="userId" name="userId" value="{{$bango}}">
        <input type="hidden" name="pNo" id="pNo" />
        <input type="hidden" name="cNo" id="cNo" />
        <input type="hidden" name="lNo" id="lNo" />
    </form>

    </div>
      <!-- Table Header Settings Modal Starts Here -->
      @include('master.common.table_settings_modal')
      <!-- Table Header Settings Modal Ends Here -->
    {{-- Footer Starts Here --}}
    @include('layout.footer_new')
    {{-- Footer Ends Here --}}
  </section>


  <!-- Supplier Modal start here -->
  @include('common.supplierModal_2')
  <!-- Supplier Modal end here -->


  @include('layout.bottom_link')

  {{-- common.js link include starts here --}}
  @include('layouts.common_js')
  {{-- common.js link include ends here --}}

  {{-- Including Scripts Starts Here --}}
  @include('purchase.purchaseHistory.script')
 {{-- Including Scripts Ends Here --}}

  <!-- Hard reload js link -->
  <script type="text/javascript">
      var filepurchasehistory = document.createElement("script");
      filepurchasehistory.type = "text/javascript";
      filepurchasehistory.src = "{{ asset('js/purchase/purchaseHistory/purchaseHistory.js') }}?v=" + Math.floor((Math.random() * 500) + 1);
      document.getElementsByTagName("head")[0].appendChild(filepurchasehistory);
  </script>
  <!-- Hard reload js link end -->
  <script>
      $(document).ready(function () {
          $('#openSettingModal').attr('onclick', "showTableSetting('{{route('purchaseHistoryTableSetting',$bango)}}')");
      });
  </script>
</body>

</html>
