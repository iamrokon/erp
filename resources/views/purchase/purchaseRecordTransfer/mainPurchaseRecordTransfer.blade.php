
@section('title', '仕入実績振替')
@section('menu-test1', 'ホーム >')
@section('menu-test3', '仕入 >')
@section('menu-test5', '仕入実績振替')
@section('tag-test', 'ここは、ガイドの文章が入ります。')
<!DOCTYPE html>
<html lang="ja">

<head>
  {{-- Including Common Header Links Start Here --}}
  @include('layouts.header')
  {{-- Including Common Header Links End Here--}}
  @include('purchase.purchaseRecordTransfer.styles')
</head>



<body style="overflow-x:visible;" class="common-nav">
  <section>
    {{-- Navbar Starts Here --}}
    @include('layout.nav_fixed')
    {{-- Navbar Ends Here --}}
    @include('layout.custom_checkbox')
    <div class="fullpage_width1" data-bind="nextFieldOnEnter:true">
      {{-- First Part starts here --}}
      @include('purchase.purchaseRecordTransfer.purchaseRecordTransferTopSearch')
      {{-- First Part Ends here --}}
     {{-- Second Part starts here --}}
     @include('purchase.purchaseRecordTransfer.purchaseRecordTransferMainContent1')
     {{-- Second Part Ends here --}}
        {{-- Second Part starts here --}}
        @include('purchase.purchaseRecordTransfer.purchaseRecordTransferMainContent2')
        {{-- Second Part Ends here --}}

    </div>
    {{-- Footer Starts Here --}}
    @include('layout.footer_new')
    {{-- Footer Ends Here --}}
  </section>
  <!-- Start  modal  here-->
  @include('purchase.purchaseRecordTransfer.modal')
  <!-- end  modal  here-->

  {{-- Including Common Footer Links Start Here --}}
  @include('layouts.footer')
  {{-- Including Common Footer Links End Here --}}

  {{-- Including Scripts Starts Here --}}
  @include('purchase.purchaseRecordTransfer.script')
 {{-- Including Scripts Ends Here --}}
 <script type="text/javascript">
    var fileord1 = document.createElement("script");
      fileord1.type = "text/javascript";
     fileord1.src = "{{ asset('js/purchase/purchase_record_transfer/purchaseRecordTransfer.js') }}?v=" + Math.floor((Math.random() * 500) + 1);
      document.getElementsByTagName("head")[0].appendChild(fileord1);
  </script>
</body>

</html>