
@section('title', '仕入実績明細')
@section('menu-test1', 'ホーム >')
@section('menu-test3', '仕入 >')
@section('menu-test5', '仕入実績明細')
<!DOCTYPE html>
<html lang="ja">

<head>
  {{-- Including Common Header Links Start Here --}}
  @include('layouts.header')
  {{-- Including Common Header Links End Here--}}
  @include('purchase.purchaseDetails.styles')
</head>



<body style="overflow-x:visible;" class="common-nav">
  <section>
    <input type="hidden" id="tableTypeDefinition" value="multipleTables">
    {{-- Navbar Starts Here --}}
    @include('layout.nav_fixed')
    {{-- Navbar Ends Here --}}
    @include('layout.custom_checkbox')
    <div class="fullpage_width1" data-bind="nextFieldOnEnter:true">
      {{-- First Part starts here --}}
      @include('purchase.purchaseDetails.purchaseDetailsTopSearch')
      {{-- First Part Ends here --}}
     {{-- Second Part starts here --}}
     @include('purchase.purchaseDetails.purchaseDetailsMainContent1')
     {{-- Second Part Ends here --}}
    {{-- Second Part starts here --}}
    @include('purchase.purchaseDetails.purchaseDetailsMainContent2')
    {{-- Second Part Ends here --}}

    </div>

    <!-- Table Header Settings Modal Starts Here -->
    @include('master.common.table_settings_modal')
    @include('master.common.table_settings_modal_2')
    <!-- Table Header Settings Modal Ends Here -->
    {{-- Footer Starts Here --}}
    @include('layout.footer_new')
    {{-- Footer Ends Here --}}
  </section>
  <!-- Start  modal  here-->
  {{--@include('purchase.purchaseDetails.modal')--}}
  <!-- end  modal  here-->

  {{-- Including Common Footer Links Start Here --}}
  @include('layouts.footer')
  {{-- Including Common Footer Links End Here --}}

  {{-- Including Scripts Starts Here --}}
  @include('purchase.purchaseDetails.script')
 {{-- Including Scripts Ends Here --}}

  <!-- Hard reload js link -->
  <script type="text/javascript">
      var filepurchasedetails = document.createElement("script");
      filepurchasedetails.type = "text/javascript";
      filepurchasedetails.src = "{{ asset('js/purchase/purchaseDetails/purchaseDetails.js') }}?v=" + Math.floor((Math.random() * 500) + 1);
      document.getElementsByTagName("head")[0].appendChild(filepurchasedetails);
  </script>

  <!-- Hard reload js link end -->
  <script>
      $(document).ready(function () {
          $('#openSettingModal').attr('onclick', "showTableSetting('{{route('purchaseDetailsTableSetting',$bango)}}')");
          $('#openSettingModal2').attr('onclick', "showTableSetting2('{{route('purchaseDetailsTableSetting2',$bango)}}')");
      });
  </script>
</body>

</html>
