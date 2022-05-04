
@section('title', 'サポート一覧・サポート依頼兼請書')
@section('menu-test1', 'ホーム >')
@section('menu-test3', '発注 >')
@section('menu-test5', 'サポート一覧・サポート依頼兼請書')
@section('tag-test', 'ここは、ガイドの文章が入ります。')

<!DOCTYPE html>
<html lang="ja">

<head>
  {{-- Including Common Header Links Start Here --}}
  @include('layouts.header')
  {{-- Including Common Header Links End Here--}}
  @include('purchase.supportInquiry.styles')
</head>



<body style="overflow-x:visible;" class="common-nav">
  <section>
    {{-- Navbar Starts Here --}}
    @include('layout.nav_fixed')
    {{-- Navbar Ends Here --}}
    @include('layout.custom_checkbox')
    <div class="fullpage_width1" data-bind="nextFieldOnEnter:true">
      {{-- First Part starts here --}}
      @include('purchase.supportInquiry.supportInquiryTopSearch')
      {{-- First Part Ends here --}}
     {{-- Second Part starts here --}}
     @include('purchase.supportInquiry.supportInquiryMainContent')
     {{-- Second Part Ends here --}}
      

    </div>
    {{-- Footer Starts Here --}}
    @include('layout.footer_new')
    {{-- Footer Ends Here --}}
  </section>


  @include('layout.bottom_link')
  {{-- Including Scripts Starts Here --}}
  @include('purchase.supportInquiry.script')
 {{-- Including Scripts Ends Here --}}
</body>

</html>