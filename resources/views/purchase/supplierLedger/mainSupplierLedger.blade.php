@section('title', '仕入先元帳')
@section('menu-test1', 'ホーム >')
@section('menu-test3', '仕入 >')
@section('menu-test5', '仕入先元帳')
@section('tag-test', 'ここは、ガイドの文章が入ります。')
<!DOCTYPE html>
<html lang="ja">

<head>
	{{-- Including Common Header Links Start Here --}}
	@include('layouts.header')
	{{-- Including Common Header Links End Here--}}
    @include('purchase.supplierLedger.styles')

</head>

<body class="common-nav" style="overflow-x:visible;">
  <section>
  	{{-- Navbar Starts Here --}}
	@include('layout.nav_fixed')
	{{-- Navbar End Here --}}
    @include('layout.custom_checkbox')
    <div class="fullpage_width1" data-bind="nextFieldOnEnter:true">

        @php
        if(isset($supplierLedgerData)){
            $skip = 0;
            $old = array();
            if(session()->has('oldInput'.$bango)){
              $old = session()->get('oldInput'.$bango);
            }
            $current_page=$supplierLedgerData->currentPage();
            $per_page=$supplierLedgerData->perPage();
            $first_data= ($current_page - 1)*$per_page+1;
            $last_data=($current_page - 1)*$per_page+ sizeof($supplierLedgerData->items());
            $total=$supplierLedgerData->total();
            $lastPage=$supplierLedgerData->lastPage();
        }else{
            $current_page = 1;
            $per_page = 20;
            $first_data = 1;
            $last_data = 0;
            $total = 0;
            $lastPage = 1;
        }
        @endphp

      <form id="insertData" enctype="multipart/form-data">
        <input type="hidden" id="formSubmitButton" name="type" />
        <input type="hidden" id="csrf" value="{{ csrf_token() }}" name="_token">
        <input type="hidden" name="bango" id="userId" value="{{ $bango }}">
        <!-- <input type="hidden" name="source" value="paymentInput" />
        <input id='page_name' value='paymentInput' type='hidden' />
        <input id='_hikitasukko_val' type='hidden' /> -->
      </form>
		{{-- First Content / top part Starts Here --}}
		 @include('purchase.supplierLedger.supplierLedgerTopSearch')
		 {{-- First Content / top part End Here --}}
		 {{-- Second Content / body part Starts Here --}}
		 @include('purchase.supplierLedger.supplierLedgerMainContent')
		 {{-- Second Content / body part End Here --}}
	</div>
	 {{-- Footer Starts Here --}}
	 @include('layout.footer_new')
    {{-- Footer Ends Here --}}
	</section>
</body>
 <!-- Start  modal  here-->
  {{--@include('purchase.supplierLedger.modal')--}}
  <!-- end  modal  here-->
  <!-- Supplier Modal start here -->
  	@include('common.supplierModal_2')
	<!-- Supplier Modal end here -->

  <!-- Table Header Settings Modal Starts Here -->
  @include('master.common.table_settings_modal')
  <!-- Table Header Settings Modal Ends Here -->

   <!-- Including Common Footer Links Starts Here -->
   @include('layouts.footer')
  <!-- Including Common Footer Links Ends Here -->

   <!-- Start  script  here-->
  @include('purchase.supplierLedger.script')
  <!-- end  script  here-->
<!-- </form> -->
  <script type="text/javascript">
        var filecomm = document.createElement("script");
        filecomm.type = "text/javascript";
        filecomm.src = "{{ asset('js/common.js') }}?v=" + Math.floor((Math.random() * 500) + 1);
        document.getElementsByTagName("head")[0].appendChild(filecomm);
    </script>

  <script type="text/javascript">
      var fileSupplierLedger = document.createElement("script");
      fileSupplierLedger.type = "text/javascript";
      fileSupplierLedger.src = "{{ asset('js/purchase/supplierLedger/supplierLedger.js') }}?v=" + Math.floor((Math.random() * 500) + 1);
      document.getElementsByTagName("head")[0].appendChild(fileSupplierLedger);
  </script>

  <script>
      $(document).ready(function () {
          $('#openSettingModal').attr('onclick', "showTableSetting('{{route('supplierLedgerTableSetting',$bango)}}')");
      });
  </script>
</html>