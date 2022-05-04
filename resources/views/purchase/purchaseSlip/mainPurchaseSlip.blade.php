
@section('title', '定期仕入伝票入力')
@section('menu-test1', 'ホーム >')
@section('menu-test3', '仕入 >')
@section('menu-test5', '定期仕入伝票入力')
@section('tag-test', 'ここは、ガイドの文章が入ります。')
<!DOCTYPE html>
<html lang="ja">

<head>
  {{-- Including Common Header Links Start Here --}}
  @include('layouts.header')
  {{-- Including Common Header Links End Here--}}
  @include('purchase.purchaseSlip.styles')
  <meta name="csrf-token" content="{{ csrf_token() }}" />
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
      @include('purchase.purchaseSlip.purchaseSlipTopSearch')
      {{-- First Part Ends here --}}
     {{-- Second Part starts here --}}
     @include('purchase.purchaseSlip.purchaseSlipMainContent')
     {{-- Second Part Ends here --}}
   

    </div>
    
    {{-- Footer Starts Here --}}
    @include('layout.footer_new')
    {{-- Footer Ends Here --}}
  </section>

  @include('common.supplierModal_2')
  @include('purchase.purchaseSlip.delete_confirm_modal')
  @include('purchase.purchaseSlip.product.main')

  <!-- Table Header Settings Modal Starts Here -->
  @include('master.common.table_settings_modal')
  <!-- Table Header Settings Modal Ends Here -->
  
  {{-- Including Common Footer Links Start Here --}}
  @include('layouts.footer')
  {{-- Including Common Footer Links End Here --}}
  <!-- Hard reload js link starts here -->
  <script type="text/javascript">
    var purchaseSlipLink = document.createElement("script");
    purchaseSlipLink.type = "text/javascript";
    purchaseSlipLink.src = "{{ asset('js/purchase/purchaseSlip/purchase_slip.js') }}?v=" + Math.floor((Math.random() * 500) + 1);
    document.getElementsByTagName("head")[0].appendChild(purchaseSlipLink);
  </script>
  <script type="text/javascript">
    var purchaseSlipDetailLink = document.createElement("script");
    purchaseSlipDetailLink.type = "text/javascript";
    purchaseSlipDetailLink.src = "{{ asset('js/purchase/purchaseSlip/purchase_slip_detail.js') }}?v=" + Math.floor((Math.random() * 500) + 1);
    document.getElementsByTagName("head")[0].appendChild(purchaseSlipDetailLink);
  </script>
  <script type="text/javascript">
    var purchaseSlipDevLink = document.createElement("script");
    purchaseSlipDevLink.type = "text/javascript";
    purchaseSlipDevLink.src = "{{ asset('js/purchase/purchaseSlip/purchase_slip_dev.js') }}?v=" + Math.floor((Math.random() * 500) + 1);
    document.getElementsByTagName("head")[0].appendChild(purchaseSlipDevLink);
  </script>
  <script type="text/javascript">
    var filesupplier = document.createElement("script");
    filesupplier.type = "text/javascript";
    filesupplier.src = "{{ asset('js/purchase/purchaseSlip/supplier.js') }}?v=" + Math.floor((Math.random() * 500) +
        1);
    document.getElementsByTagName("head")[0].appendChild(filesupplier);
  </script>
  
  <script type="text/javascript">
      var filepro = document.createElement("script");
      filepro.type = "text/javascript";
      filepro.src = "{{ asset('js/purchase/purchaseSlip/product.js') }}?v=" + Math.floor((Math.random() * 500) + 1);
      document.getElementsByTagName("head")[0].appendChild(filepro);
  </script>
  <!-- Hard reload js link ends here -->
  {{-- Including Scripts Starts Here --}}
  @include('purchase.purchaseSlip.script')
 {{-- Including Scripts Ends Here --}}
 <script>
      $(document).ready(function () {
          $('#openSettingModal').attr('onclick', "showTableSetting('{{route('purchaseSlipTableSetting',$bango)}}')");
      });
  </script>
</body>

</html>