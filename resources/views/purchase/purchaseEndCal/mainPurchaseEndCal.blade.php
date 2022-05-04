
@section('title', '仕入完了計算')
@section('menu-test1', 'ホーム >')
@section('menu-test3', ' 仕入 >')
@section('menu-test5', '仕入完了計算')
<!DOCTYPE html>
<html lang="ja">

<head>
  {{-- Including Common Header Links Start Here --}}
  @include('layouts.header')
  {{-- Including Common Header Links End Here--}}
  @include('purchase.purchaseEndCal.styles')
</head>



<body style="overflow-x:visible;" class="common-nav">
  <section>
    {{-- Navbar Starts Here --}}
    @include('layout.nav_fixed')
    {{-- Navbar Ends Here --}}
    @include('layout.custom_checkbox')
    <div class="fullpage_width1" data-bind="nextFieldOnEnter:true">
      {{-- First Part starts here --}}
      @include('purchase.purchaseEndCal.purchaseEndCalTopSearch')
      {{-- First Part Ends here --}}
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
  @include('purchase.purchaseEndCal.script')
 {{-- Including Scripts Ends Here --}}
  <!-- Hard reload js link -->
  <script type="text/javascript">
      var filepurchaseendcal = document.createElement("script");
      filepurchaseendcal.type = "text/javascript";
      filepurchaseendcal.src = "{{ asset('js/purchase/purchaseEndCalculation/purchaseEndCalculation.js') }}?v=" + Math.floor((Math.random() * 500) + 1);
      document.getElementsByTagName("head")[0].appendChild(filepurchaseendcal);
  </script>

  <!-- Hard reload js link end -->
</body>

</html>
