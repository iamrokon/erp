@section('title', '購入先元帳')
@section('menu-test1', 'ホーム >')
@section('menu-test3', '仕入 >')
@section('menu-test5', '購入先元帳')
@section('tag-test', 'ここは、ガイドの文章が入ります。')
<!DOCTYPE html>
<html lang="ja">

<head>
	{{-- Including Common Header Links Start Here --}}
	@include('layouts.header')
	{{-- Including Common Header Links End Here--}}
    @include('purchase.purchaseLedger.styles')

</head>

<body class="common-nav" style="overflow-x:visible;">
  <section>
  	{{-- Navbar Starts Here --}}
	@include('layout.nav_fixed')
	{{-- Navbar End Here --}}
    @include('layout.custom_checkbox')
    
    @php
    if(isset($purchaseLedgerInfo)){
        $skip = 0;
        $old = array();
        if(session()->has('oldInput'.$bango)){
          $old = session()->get('oldInput'.$bango);
        }
        $current_page = $purchaseLedgerInfo->currentPage();
        $per_page = $purchaseLedgerInfo->perPage();
        $first_data = ($current_page - 1)*$per_page+1;
        $last_data = ($current_page - 1)*$per_page+ sizeof($purchaseLedgerInfo->items());
        $total = $purchaseLedgerInfo->total();
        $lastPage = $purchaseLedgerInfo->lastPage() ;
    }else{
        $current_page = 1;
        $per_page = 20;
        $first_data = 1;
        $last_data = 0;
        $total = 0;
        $lastPage = 1;
    }
    @endphp
    
    <div class="fullpage_width1" data-bind="nextFieldOnEnter:true">
        {{-- First Content / top part Starts Here --}}
         @include('purchase.purchaseLedger.purchaseLedgerTopSearch')
         {{-- First Content / top part End Here --}}
         {{-- Second Content / body part Starts Here --}}
         @include('purchase.purchaseLedger.purchaseLedgerMainContent')
         {{-- Second Content / body part End Here --}}
	</div>
	 {{-- Footer Starts Here --}}
	 @include('layout.footer_new')
    {{-- Footer Ends Here --}}
	</section>
</body>
    <!-- Supplier Modal start here -->
    @include('common.supplierModal_2')
    <!-- Supplier Modal end here -->
    <!-- Table Header Settings Modal Starts Here -->
    @include('master.common.table_settings_modal')
    <!-- Table Header Settings Modal Ends Here -->
   <!-- Including Common Footer Links Starts Here -->
   @include('layouts.footer')
  <!-- Including Common Footer Links Ends Here -->

  <!-- Hard reload js link -->
  <script type="text/javascript">
    var fileord1 = document.createElement("script");
      fileord1.type = "text/javascript";
      fileord1.src = "{{ asset('js/purchase/purchase_ledger/purchaseLedger.js') }}?v=" + Math.floor((Math.random() * 500) + 1);
      document.getElementsByTagName("head")[0].appendChild(fileord1);
  </script>
  <script>
      $(document).ready(function () {
          $('#openSettingModal').attr('onclick', "showTableSetting('{{route('purchaseLedgerTableSetting',$bango)}}')");
      });
  </script>
   <!-- Start  script  here-->
  @include('purchase.purchaseLedger.script')
  <!-- end  script  here-->
</html>