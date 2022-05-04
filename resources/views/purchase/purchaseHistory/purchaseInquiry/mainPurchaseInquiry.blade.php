

@section('title', '仕入購入履歴一覧・仕入照会')
@section('menu-test1', 'ホーム >')
@section('menu-test3', '仕入 >')
@section('menu-test5', '仕入購入履歴一覧・仕入照会')
@section('tag-test', 'ここは、ガイドの文章が入ります。')
<!DOCTYPE html>
<html lang="ja">

<head>
  {{-- Including Common Header Links Start Here --}}
  @include('layouts.header')
  {{-- Including Common Header Links End Here--}}
  @include('purchase.purchaseHistory.purchaseInquiry.styles')
 
</head>

<body  class="common-nav" style="overflow-x:visible;">
  <section>
    {{-- Navbar Starts Here --}}
    @include('layout.nav_fixed')
    {{-- Navbar Ends Here --}}
    @include('layout.custom_checkbox')
    <div class="fullpage_width1" data-bind="nextFieldOnEnter:true">
      {{-- First Part starts here --}}
      @include('purchase.purchaseHistory.purchaseInquiry.purchaseInquiryTopSearch')
      {{-- First Part Ends here --}}
     {{-- Second Part starts here --}}
     @include('purchase.purchaseHistory.purchaseInquiry.purchaseInquiryMainContent')
     {{-- Second Part Ends here --}}

    </div>
    {{-- Footer Starts Here --}}
    @include('layout.footer_new')
    {{-- Footer Ends Here --}}
  </section>


  <!-- Start  modal  here-->
  {{--@include('purchase.purchaseHistory.purchaseInquiry.modal')--}}
  <!-- end  modal  here-->


  <!-- Including Common Footer Links Start Here -->
  @include('layouts.footer')
  <!-- Including Common Footer Links End Here -->

  @include('layout.bottom_link')
  {{-- Including Scripts Starts Here --}}
  @include('purchase.purchaseHistory.purchaseInquiry.script')
 {{-- Including Scripts Ends Here --}}
</body>

</html>
